<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Welcome, {{ Auth::user()->full_name }}!</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @if(Auth::user()->role === 'admin')
                            @php
                                $totalBooks = \App\Models\Book::count();
                                $totalAvailableBooks = \App\Models\Book::sum('quantity_available');
                                $totalBorrowings = \App\Models\Borrowing::count();
                                $activeBorrowings = \App\Models\Borrowing::where('status', 'borrowed')->count();
                            @endphp
                            
                            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                                <h4 class="font-medium text-green-800 mb-2">Total Books</h4>
                                <p class="text-2xl font-bold text-green-600">{{ $totalBooks }}</p>
                                <p class="text-sm text-green-700 mt-1">{{ $totalAvailableBooks }} copies available</p>
                            </div>
                            
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                <h4 class="font-medium text-blue-800 mb-2">Total Borrowings</h4>
                                <p class="text-2xl font-bold text-blue-600">{{ $totalBorrowings }}</p>
                                <p class="text-sm text-blue-700 mt-1">{{ $activeBorrowings }} active borrowings</p>
                            </div>
                            
                            <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                                <h4 class="font-medium text-purple-800 mb-2">Recent Activity</h4>
                                @php
                                    $recentActivity = \App\Models\Borrowing::with(['user', 'book'])
                                        ->latest('borrow_date')
                                        ->take(3)
                                        ->get();
                                @endphp
                                
                                @if($recentActivity->count() > 0)
                                    <ul class="text-sm">
                                        @foreach($recentActivity as $activity)
                                            <li class="mb-1">
                                                <span class="text-purple-700">{{ $activity->user->full_name }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-sm text-gray-500">No recent activity</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
