<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Buku') }}
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

                    <form action="{{ route('books.update', $book) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="isbn" class="block text-gray-700 text-sm font-bold mb-2">ISBN:</label>
                            <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $book->isbn) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('isbn') border-red-500 @enderror" required>
                            @error('isbn')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Judul:</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror" required>
                            @error('title')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="author" class="block text-gray-700 text-sm font-bold mb-2">Penulis:</label>
                            <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('author') border-red-500 @enderror">
                            @error('author')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="year_published" class="block text-gray-700 text-sm font-bold mb-2">Tahun Terbit:</label>
                            <input type="number" name="year_published" id="year_published" value="{{ old('year_published', $book->year_published) }}" min="1900" max="{{ date('Y') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('year_published') border-red-500 @enderror">
                            @error('year_published')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="quantity_available" class="block text-gray-700 text-sm font-bold mb-2">Buku Tersedia:</label>
                            <input type="number" name="quantity_available" id="quantity_available" value="{{ old('quantity_available', $book->quantity_available) }}" min="0" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('quantity_available') border-red-500 @enderror" required>
                            @error('quantity_available')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Pebaharui
                            </button>
                            <a href="{{ route('books.index') }}" class="text-gray-600 hover:text-gray-800">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
