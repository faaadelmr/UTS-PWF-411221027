<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Book Details') }}
            </h2>
            <a href="{{ route('books.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                {{ __('Back to Books') }}
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
                            <h4 class="font-medium text-gray-700 mb-2">Book Information</h4>
                            <div class="bg-gray-50 p-4 rounded">
                                <p class="mb-2"><span class="font-medium">Author:</span> {{ $book->author ?? 'Not specified' }}</p>
                                <p class="mb-2"><span class="font-medium">Year Published:</span> {{ $book->year_published ?? 'Not specified' }}</p>
                                <p class="mb-2">
                                    <span class="font-medium">Availability:</span> 
                                    <span class="{{ $book->quantity_available > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $book->quantity_available }} copies available
                                    </span>
                                </p>
                            </div>
                            
                            <div class="mt-6 flex space-x-4">
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('books.edit', $book) }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                        Edit Book
                                    </a>
                                    
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                            Delete Book
                                        </button>
                                    </form>
                                @endif
                                
                                @if(Auth::user()->role === 'member' && $book->quantity_available > 0)
                                    <a href="{{ route('borrowings.create', ['book_id' => $book->book_id]) }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                        Borrow This Book
                                    </a>
                                @endif
                            </div>
                        </div>
                        
                        @if(Auth::user()->role === 'admin')
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">Borrowing History</h4>
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
                                                    <span class="{{ $borrowing->status === 'borrowed' ? 'text-yellow-600' : 'text-green-600' }}">
                                                        {{ $borrowing->status === 'borrowed' ? 'borrowed' : 'returned' }}
                                                    </span> 
                                                    on {{ $borrowing->borrow_date }}
                                                    @if($borrowing->return_date)
                                                        and returned on {{ $borrowing->return_date }}
                                                    @endif
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-gray-600">No borrowing history for this book.</p>
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