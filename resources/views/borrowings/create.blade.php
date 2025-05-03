<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrow a Book') }}
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

                    <form action="{{ route('borrowings.store') }}" method="POST">
                        @csrf
                        
                        @if(Auth::user()->role === 'admin')
                        <div class="mb-4">
                            <label for="member_id" class="block text-gray-700 text-sm font-bold mb-2">Member:</label>
                            <select name="member_id" id="member_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('member_id') border-red-500 @enderror" required>
                                <option value="">Select a member</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->member_id }}" {{ old('member_id') == $member->member_id ? 'selected' : '' }}>
                                        {{ $member->full_name }} ({{ $member->username }})
                                    </option>
                                @endforeach
                            </select>
                            @error('member_id')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif
                        
                        <div class="mb-4">
                            <label for="book_id" class="block text-gray-700 text-sm font-bold mb-2">Book:</label>
                            <select name="book_id" id="book_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('book_id') border-red-500 @enderror" required>
                                <option value="">Select a book</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->book_id }}" {{ old('book_id', request()->get('book_id')) == $book->book_id ? 'selected' : '' }}>
                                        {{ $book->title }} ({{ $book->quantity_available }} available)
                                    </option>
                                @endforeach
                            </select>
                            @error('book_id')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="borrow_date" class="block text-gray-700 text-sm font-bold mb-2">Borrow Date:</label>
                            <input type="date" name="borrow_date" id="borrow_date" value="{{ old('borrow_date', date('Y-m-d')) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('borrow_date') border-red-500 @enderror" required>
                            @error('borrow_date')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Borrow Book
                            </button>
                            <a href="{{ route('borrowings.index') }}" class="text-gray-600 hover:text-gray-800">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>