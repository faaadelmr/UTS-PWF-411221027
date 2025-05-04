<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Peminjaman Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h3 class="text-lg font-medium text-gray-900 mb-4">Form Peminjaman Buku</h3>
                    <form action="{{ route('borrowings.store') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label for="book" class="block text-sm font-medium text-gray-700">Pilih Buku</label>
                            <select id="book" name="book_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md @error('book_id') border-red-500 @enderror" required>
                                <option value="">Pilih Buku</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->book_id }}" {{ old('book_id', request()->get('book_id')) == $book->book_id ? 'selected' : '' }}>
                                        {{ $book->title }} (Tersedia {{ $book->quantity_available }})
                                    </option>
                                @endforeach
                            </select>
                            @error('book_id')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        @if(Auth::user()->role === 'admin')
                        <div>
                            <label for="member" class="block text-sm font-medium text-gray-700">Peminjam</label>
                            <select id="member" name="member_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md @error('member_id') border-red-500 @enderror" required>
                                <option value="">Pilih Member</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->member_id }}" {{ old('member_id') == $member->member_id ? 'selected' : '' }}>
                                        {{ $member->full_name }} (ID: {{ $member->member_id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('member_id')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="borrow-date" class="block text-sm font-medium text-gray-700">Tanggal Pinjam</label>
                                <input type="date" name="borrow_date" id="borrow-date" value="{{ old('borrow_date', date('Y-m-d')) }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('borrow_date') border-red-500 @enderror" required>
                                @error('borrow_date')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="return-date" class="block text-sm font-medium text-gray-700">Tanggal Kembali</label>
                                <input type="date" name="return_date" id="return-date" value="{{ old('return_date', date('Y-m-d', strtotime('+7 days'))) }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('return_date') border-red-500 @enderror" required>
                                @error('return_date')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <a href="{{ route('borrowings.index') }}" class="mr-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
