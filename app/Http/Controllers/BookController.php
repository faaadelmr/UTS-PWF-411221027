<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = Book::query()
            // cari di title, author, isbn (dikelompokkan)
            ->when($request->filled('search'), function ($q) use ($request) {
                $term = '%'.$request->search.'%';
                $q->where(function ($sub) use ($term) {
                    $sub->where('title', 'like', $term)
                        ->orWhere('author', 'like', $term)
                        ->orWhere('isbn', 'like', $term);
                });
            })
            // filter availability
            ->when($request->availability === 'available', fn($q) => $q->where('quantity_available', '>', 0))
            ->when($request->availability === 'unavailable', fn($q) => $q->where('quantity_available', '<=', 0))
            ->orderByDesc('book_id')
            ->paginate(10);

        return view('books.index', compact('books'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'isbn' => 'required|string|max:20|unique:books',
                'title' => 'required|string|max:150',
                'author' => 'nullable|string|max:100',
                'year_published' => 'nullable|numeric|min:1900|max:' . date('Y'),
                'quantity_available' => 'required|numeric|min:0',
            ]);

            Book::create($validated);

            return redirect()->route('books.index')
                ->with('success', 'Buku berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Failed to create book: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create book: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        try {
            $validated = $request->validate([
                'isbn' => 'required|string|max:20|unique:books,isbn,' . $book->book_id . ',book_id',
                'title' => 'required|string|max:150',
                'author' => 'nullable|string|max:100',
                'year_published' => 'nullable|numeric|min:1900|max:' . date('Y'),
                'quantity_available' => 'required|numeric|min:0',
            ]);

            $book->update($validated);

            return redirect()->route('books.index')
                ->with('success', 'Bukuu berhasil diperbarui.');;
        } catch (\Exception $e) {
            Log::error('Failed to update book: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update book: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        try {
            // Check if book has active borrowings
            $activeBorrowings = $book->borrowings()->where('status', 'borrowed')->count();
            
            if ($activeBorrowings > 0) {
                return back()->with('error', 'Buku tidak dapat dihapus karena memiliki peminjaman aktif.');
            }
            
            $book->delete();

            return redirect()->route('books.index')
                ->with('success', 'Buku berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Failed to delete book: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete book: ' . $e->getMessage());
        }
    }
}
