<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Buku') }}
            </h2>
            <a href="{{ route('books.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                {{ __('Kembali') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $book->title }}</h3>
                        <p class="text-sm text-gray-600">ISBN: {{ $book->isbn }}</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">Informasi Buku</h4>
                            <div class="bg-gray-50 p-4 rounded">
                                <p class="mb-2"><span class="font-medium">Penulis:</span> {{ $book->author ?? 'Not specified' }}</p>
                                <p class="mb-2"><span class="font-medium">Tahun dibuat:</span> {{ $book->year_published ?? 'Not specified' }}</p>
                                <p class="mb-2">
                                    <span class="font-medium">Sisa Buku:</span> 
                                    <span class="{{ $book->quantity_available > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        Tersedia {{ $book->quantity_available }}
                                    </span>
                                </p>
                            </div>
                            
                            <div class="mt-6 flex space-x-4">
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('books.edit', $book) }}" 
                                        class="inline-flex items-center px-4 py-2 bg-emerald-500 text-white rounded-lg transition-all duration-300 hover:bg-emerald-600 hover:shadow-lg transform hover:-translate-y-0.5">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit Buku
                                    </a>
                                    
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-rose-500 text-white rounded-lg transition-all duration-300 hover:bg-rose-600 hover:shadow-lg transform hover:-translate-y-0.5">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus Buku
                                        </button>
                                    </form>
                                @endif

                                @if(Auth::user()->role === 'member' && $book->quantity_available > 0)
                                    <a href="{{ route('borrowings.create', ['book_id' => $book->book_id]) }}" 
                                        class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg transition-all duration-300 hover:bg-blue-600 hover:shadow-lg transform hover:-translate-y-0.5">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Pinjam buku ini
                                    </a>
                                @endif
                            </div>
                        </div>
                        
                        @if(Auth::user()->role === 'admin')
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">Riwayat Buku di Pinjam</h4>
                            <div class="bg-gray-50 p-4 rounded max-h-80 overflow-y-auto">
                                @php
                                    $borrowings = $book->borrowings()->with('user')->latest('borrow_date')->take(10)->get();
                                @endphp
                                
                                @if($borrowings->count() > 0)
                                    <ul class="divide-y divide-gray-200">
                                        @foreach($borrowings as $borrowing)
                                            <li class="py-2">
                                                <p class="text-sm">
                                                    <span class="font-medium">{{ $borrowing->user->full_name }}</span>
                                                    <span>Status:</span> 
                                                    <span class="
                                                        @if($borrowing->status === 'borrowed') text-yellow-600
                                                        @elseif($borrowing->status === 'overdue') text-red-600
                                                        @else text-green-600
                                                        @endif font-medium">
                                                        @if($borrowing->status === 'borrowed')
                                                            Sedang Dipinjam
                                                        @elseif($borrowing->status === 'overdue')
                                                            Terlambat Dikembalikan
                                                        @else
                                                            Sudah Dikembalikan
                                                        @endif
                                                    </span>
                                                    <br>
                                                    <span class="text-gray-600">
                                                        Dipinjam: {{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}
                                                        @if($borrowing->return_date)
                                                            <br>Dikembalikan: {{ \Carbon\Carbon::parse($borrowing->return_date)->format('d M Y') }}
                                                        @endif
                                                    </span>
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-gray-600">Tidak ada riwayat peminjaman pada buku ini.</p>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>