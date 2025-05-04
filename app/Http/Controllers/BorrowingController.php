<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Load relasi book & user
        $query = Borrowing::with(['book', 'user']);

        // Jika role member, batasi hanya milik member tersebut
        if (Auth::user()->role === 'member') {
            $query->where('member_id', Auth::user()->member_id);
        }

        // Filter by status jika ada query string ?status=
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Urutkan dari tanggal pinjam terbaru
        $borrowings = $query
            ->orderBy('borrow_date', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('borrowings.index', compact('borrowings'));
    }



    /**
     * Update status for overdue borrowings
     */
    private function updateOverdueStatus()
    {
        // Find all active borrowings where return_date is in the past
        $overdueBorrowings = Borrowing::where('status', 'borrowed')
            ->whereDate('return_date', '<', now()->toDateString())
            ->get();
        
        // Update their status to overdue
        foreach ($overdueBorrowings as $borrowing) {
            $borrowing->status = 'overdue';
            $borrowing->save();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::where('quantity_available', '>', 0)->get();
        
        if (Auth::user()->role === 'admin') {
            $members = User::where('role', 'member')->get();
            return view('borrowings.create', compact('books', 'members'));
        }
        
        return view('borrowings.create', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            if (Auth::user()->role === 'admin') {
                $validated = $request->validate([
                    'member_id' => 'required|exists:users,member_id',
                    'book_id' => 'required|exists:books,book_id',
                    'borrow_date' => 'required|date',
                    'return_date' => 'required|date|after_or_equal:borrow_date',
                ]);
                
                $memberId = $validated['member_id'];
            } else {
                $validated = $request->validate([
                    'book_id' => 'required|exists:books,book_id',
                    'borrow_date' => 'required|date',
                    'return_date' => 'required|date|after_or_equal:borrow_date',
                ]);
                
                $memberId = Auth::user()->member_id;
            }
            
            $book = Book::findOrFail($validated['book_id']);
            
            // Check if book is available
            if ($book->quantity_available <= 0) {
                throw new \Exception('Book is not available for borrowing.');
            }
            
            // Create borrowing record
            Borrowing::create([
                'member_id' => $memberId,
                'book_id' => $book->book_id,
                'borrow_date' => $validated['borrow_date'],
                'return_date' => $validated['return_date'],
                'status' => 'borrowed',
            ]);
            
            // Update book quantity
            $book->quantity_available -= 1;
            $book->save();
            
            DB::commit();
            
            return redirect()->route('borrowings.index')
                ->with('success', 'Buku berhasil dipinjam.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to borrow book: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to borrow book: ' . $e->getMessage());
        }
    }

    /**
     * Return a borrowed book.
     */
    public function returnBook(Borrowing $borrowing)
    {
        try {
            DB::beginTransaction();
            
            // Check if the borrowing belongs to the current user or user is admin
            if (Auth::user()->role !== 'admin' && $borrowing->member_id !== Auth::user()->member_id) {
                throw new \Exception('Unauthorized action.');
            }
            
            // Check if the book is already returned
            if ($borrowing->status === 'returned') {
                throw new \Exception('Book is already returned.');
            }
            
            // Update borrowing status
            $borrowing->status = 'returned';
            $borrowing->return_date = now();
            $borrowing->save();
            
            // Update book quantity
            $book = $borrowing->book;
            $book->quantity_available += 1;
            $book->save();
            
            DB::commit();
            
            return redirect()->route('borrowings.index')
                ->with('success', 'Buku Telah berhasil dikembalikan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to return book: ' . $e->getMessage());
            return back()->with('error', 'Failed to return book: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrowing $borrowing)
    {
        // Check if the borrowing belongs to the current user or user is admin
        if (Auth::user()->role !== 'admin' && $borrowing->member_id !== Auth::user()->member_id) {
            return redirect()->route('borrowings.index')
                ->with('error', 'Unauthorized action.');
        }
        
        return view('borrowings.show', compact('borrowing'));
    }
}
