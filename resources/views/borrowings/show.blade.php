<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Peminjaman  Buku') }}
            </h2>
            <a href="{{ route('borrowings.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                {{ __('Kembali') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">Nomor Peminjam #{{ $borrowing->borrowing_id }}</h3>
                        <p class="text-sm text-gray-600">
                            Status: 
                            <span class="{{ $borrowing->status === 'borrowed' ? 'text-yellow-600' : 'text-green-600' }}">
                                {{ $borrowing->status }}
                            </span>
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">Informasi Peminjam Buku</h4>
                            <div class="bg-gray-50 p-4 rounded">
                                @if(Auth::user()->role === 'admin')
                                <p class="mb-2">
                                    <span class="font-medium">Member:</span> 
                                    {{ $borrowing->user->full_name }} ({{ $borrowing->user->username }})
                                </p>
                                @endif
                                <p class="mb-2">
                                    <span class="font-medium">Buku:</span> 
                                    {{ $borrowing->book->title }}
                                </p>
                                <p class="mb-2">
                                    <span class="font-medium">ISBN:</span> 
                                    {{ $borrowing->book->isbn }}
                                </p>
                                <p class="mb-2">
                                    <span class="font-medium">Tanggal Dipinjam:</span> 
                                    {{ $borrowing->borrow_date }}
                                </p>
                                <p class="mb-2">
                                    <span class="font-medium">Tanggal Dikembalikan:</span> 
                                    {{ $borrowing->return_date ?? 'Belum Dikembalikan' }}
                                </p>
                            </div>
                            
                            @if($borrowing->status === 'borrowed' || $borrowing->status === 'overdue')
                            <div class="mt-6">
                                <form action="{{ route('borrowings.return', $borrowing) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                        Kembalikan Buku
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                        
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">Detail Buku</h4>
                            <div class="bg-gray-50 p-4 rounded">
                                <p class="mb-2">
                                    <span class="font-medium">Judul:</span> 
                                    {{ $borrowing->book->title }}
                                </p>
                                <p class="mb-2">
                                    <span class="font-medium">Penulis:</span> 
                                    {{ $borrowing->book->author ?? 'Not specified' }}
                                </p>
                                <p class="mb-2">
                                    <span class="font-medium">Tahun Terbit:</span> 
                                    {{ $borrowing->book->year_published ?? 'Not specified' }}
                                </p>
                                <p class="mb-2">
                                    <span class="font-medium">Jumlah Buku:</span> 
                                    <span class="{{ $borrowing->book->quantity_available > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        Tersedia {{ $borrowing->book->quantity_available }}
                                    </span>
                                </p>
                            </div>
                            
                            <div class="mt-6">
                                <a href="{{ route('books.show', $borrowing->book) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    Lihat Detail Buku
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>