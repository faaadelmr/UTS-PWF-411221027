<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Books') }}
            </h2>
            @if(Auth::user()->role === 'admin')
            <a href="{{ route('books.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                {{ __('Add New Book') }}
            </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ISBN
                                    </th>
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Author
                                    </th>
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Year
                                    </th>
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Available
                                    </th>
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($books as $book)
                                    <tr>
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            {{ $book->book_id }}
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            {{ $book->isbn }}
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            {{ $book->title }}
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            {{ $book->author }}
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            {{ $book->year_published }}
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            <span class="{{ $book->quantity_available > 0 ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $book->quantity_available }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('books.show', $book) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                                
                                                @if(Auth::user()->role === 'admin')
                                                    <a href="{{ route('books.edit', $book) }}" class="text-green-600 hover:text-green-900">Edit</a>
                                                    
                                                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                    </form>
                                                @endif
                                                
                                                @if(Auth::user()->role === 'member' && $book->quantity_available > 0)
                                                    <a href="{{ route('borrowings.create', ['book_id' => $book->book_id]) }}" class="text-green-600 hover:text-green-900">Borrow</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-4 px-4 border-b border-gray-200 text-center">
                                            No books found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>