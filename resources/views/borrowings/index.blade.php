<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Borrowings') }}
            </h2>
            <a href="{{ route('borrowings.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                {{ __('Borrow a Book') }}
            </a>
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
                                    @if(Auth::user()->role === 'admin')
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Member
                                    </th>
                                    @endif
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Book
                                    </th>
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Borrow Date
                                    </th>
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Return Date
                                    </th>
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($borrowings as $borrowing)
                                    <tr>
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            {{ $borrowing->borrowing_id }}
                                        </td>
                                        @if(Auth::user()->role === 'admin')
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            {{ $borrowing->user->full_name }}
                                        </td>
                                        @endif
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            {{ $borrowing->book->title }}
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            {{ $borrowing->borrow_date }}
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            {{ $borrowing->return_date ?? 'Not returned yet' }}
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            <span class="{{ $borrowing->status === 'borrowed' ? 'text-yellow-600' : 'text-green-600' }}">
                                                {{ $borrowing->status }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('borrowings.show', $borrowing) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                                
                                                @if($borrowing->status === 'borrowed')
                                                    <form action="{{ route('borrowings.return', $borrowing) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-green-600 hover:text-green-900">Return</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ Auth::user()->role === 'admin' ? 7 : 6 }}" class="py-4 px-4 border-b border-gray-200 text-center">
                                            No borrowings found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $borrowings->links() }}
                    </div>
                </div>
            </div>
</x-app-layout>
