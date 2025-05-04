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


    private function updateOverdueStatus()
    {
        // Mencari semua peminjaman yang sudah lewat tanggal pengembalian
        $overdueBorrowings = Borrowing::where('status', 'borrowed')
            ->whereDate('return_date', '<', now()->toDateString())
            ->get();
        
        // pembaruan status peminjaman
        foreach ($overdueBorrowings as $borrowing) {
            $borrowing->status = 'overdue';
            $borrowing->save();
        }
    }

    public function create()
    {
        $books = Book::where('quantity_available', '>', 0)->get();
        
        if (Auth::user()->role === 'admin') {
            $members = User::where('role', 'member')->get();
            return view('borrowings.create', compact('books', 'members'));
        }
        
        return view('borrowings.create', compact('books'));
    }

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
            
            // cek apakah buku tersedia
            if ($book->quantity_available <= 0) {
                throw new \Exception('Book is not available for borrowing.');
            }
            
            // membuat peminjaman baru
            Borrowing::create([
                'member_id' => $memberId,
                'book_id' => $book->book_id,
                'borrow_date' => $validated['borrow_date'],
                'return_date' => $validated['return_date'],
                'status' => 'borrowed',
            ]);
            
            // update jumlah buku yang tersedia
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

    public function returnBook(Borrowing $borrowing)
    {
        try {
            DB::beginTransaction();
            
            // cek apakah peminjaman milik user yang sedang login
            if (Auth::user()->role !== 'admin' && $borrowing->member_id !== Auth::user()->member_id) {
                throw new \Exception('Unauthorized action.');
            }
            
            // cek apakah peminjaman sudah dikembalikan
            if ($borrowing->status === 'returned') {
                throw new \Exception('Book is already returned.');
            }
            
            // update status peminjaman
            $borrowing->status = 'returned';
            $borrowing->return_date = now();
            $borrowing->save();
            
            // update jumlah buku yang tersedia
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
    
    public function show(Borrowing $borrowing)
    {
        // cek apakah peminjaman milik user yang sedang login
        if (Auth::user()->role !== 'admin' && $borrowing->member_id !== Auth::user()->member_id) {
            return redirect()->route('borrowings.index')
                ->with('error', 'Unauthorized action.');
        }
        
        return view('borrowings.show', compact('borrowing'));
    }
}
