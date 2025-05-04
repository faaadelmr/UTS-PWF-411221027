<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Add Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-red-500 to-indigo-600 overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <h3 class="text-2xl font-bold mb-2">Selamat datang, {{ Auth::user()->full_name }}!</h3>
                    <p class="opacity-90">{{ now()->format('l, d F Y') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                @if(Auth::user()->role === 'admin')
                @php
                $totalBooks = \App\Models\Book::count();
                $totalAvailableBooks = \App\Models\Book::sum('quantity_available');
                $totalBorrowings = \App\Models\Borrowing::count();
                $activeBorrowings = \App\Models\Borrowing::where('status', 'borrowed')->count();
                $returnedBorrowings = \App\Models\Borrowing::where('status', 'returned')->count();
                $overdueBorrowings = \App\Models\Borrowing::where('status', 'overdue')->count();
            @endphp
            
                    
                    <!-- Total Books Card -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-green-500 hover:shadow-lg transition-shadow">
                        <div class="p-5">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Total Judul Buku</p>
                                    <h4 class="text-2xl font-bold text-gray-800">{{ $totalBooks }}</h4>
                                    <p class="text-sm text-green-600 mt-1">{{ $totalAvailableBooks }} Buku Tersedia</p>
                                </div>
                                <div class="bg-green-100 p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Total Borrowings Card -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
                        <div class="p-5">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Total Buku Dipinjam</p>
                                    <h4 class="text-2xl font-bold text-gray-800">{{ $totalBorrowings }}</h4>
                                    <p class="text-sm text-blue-600 mt-1">{{ $activeBorrowings }} Sedang aktif dipinjam</p>
                                </div>
                                <div class="bg-blue-100 p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Return Status Card -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-purple-500 hover:shadow-lg transition-shadow">
                        <div class="p-5">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Status Pengembalian</p>
                                    <h4 class="text-2xl font-bold text-gray-800">{{ $returnedBorrowings }}</h4>
                                    <p class="text-sm text-purple-600 mt-1">Buku dikembalikan</p>
                                </div>
                                <div class="bg-purple-100 p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Overdue Status Card -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-red-500 hover:shadow-lg transition-shadow">
                        <div class="p-5">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Buku Terlambat di Kembalikan</p>
                                    <h4 class="text-2xl font-bold text-gray-800">{{ $overdueBorrowings }}</h4>
                                    <p class="text-sm text-red-600 mt-1">Perlu perhatian</p>
                                </div>
                                <div class="bg-red-100 p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Borrowing Trends Chart -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Data Peminjaman Terkini</h3>
                        <canvas id="borrowingTrendsChart" height="250"></canvas>
                    </div>
                </div>
                
                <!-- Return Status Chart -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Grafik Status Peminjaman</h3>
                        <canvas id="returnStatusChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-5">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktifitas Peminjamanan Terakhir</h3>
                    
                    @if(Auth::user()->role === 'admin')
                        @php
                            $recentActivity = \App\Models\Borrowing::with(['user', 'book'])
                                ->latest('borrow_date')
                                ->take(5)
                                ->get();
                        @endphp
                        
                        @if($recentActivity->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($recentActivity as $activity)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                                            <span class="text-indigo-800 font-medium">{{ substr($activity->user->full_name, 0, 1) }}</span>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $activity->user->full_name }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $activity->book->title ?? 'Buku Tidak Diketahui' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($activity->borrow_date)->format('d M Y') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($activity->status == 'borrowed')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Dipinjam</span>
                                                    @elseif($activity->status == 'returned')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Dikembalikan</span>
                                                    @elseif($activity->status == 'overdue')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Terlambat</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500">Tidak ada Aktifitas peminjaman.</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Initialization Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sample data - in a real app, you would fetch this from the backend
            @php
            // Get real borrowing data for the last 7 days
            $dailyLabels = [];
            $dailyData = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = \Carbon\Carbon::now()->subDays($i);
                $dailyLabels[] = $date->format('D');
                $dailyData[] = \App\Models\Borrowing::whereDate('borrow_date', $date->format('Y-m-d'))->count();
            }

            // Get real borrowing data for the last 4 weeks
            $weeklyLabels = [];
            $weeklyData = [];
            for ($i = 3; $i >= 0; $i--) {
                $startDate = \Carbon\Carbon::now()->subWeeks($i)->startOfWeek();
                $endDate = \Carbon\Carbon::now()->subWeeks($i)->endOfWeek();
                $weeklyLabels[] = 'Week ' . (4 - $i);
                $weeklyData[] = \App\Models\Borrowing::whereBetween('borrow_date', [$startDate, $endDate])->count();
            }

            // Get real borrowing data for the last 6 months
            $monthlyLabels = [];
            $monthlyData = [];
            for ($i = 5; $i >= 0; $i--) {
                $date = \Carbon\Carbon::now()->subMonths($i);
                $monthlyLabels[] = $date->format('M');
                $monthlyData[] = \App\Models\Borrowing::whereYear('borrow_date', $date->year)
                    ->whereMonth('borrow_date', $date->month)
                    ->count();
            }
        @endphp

            // Borrowing Trends Chart
            const trendsCtx = document.getElementById('borrowingTrendsChart').getContext('2d');
            const trendsChart = new Chart(trendsCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($dailyLabels) !!},
                    datasets: [{
                        label: 'Daily',
                        data: {!! json_encode($dailyData) !!},
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Return Status Chart
            const statusCtx = document.getElementById('returnStatusChart').getContext('2d');
            const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Dikembalikan', 'Dipinjam', 'Belum Dikembalikan'],
                datasets: [{
                    data: [{{ $returnedBorrowings }}, {{ $activeBorrowings }}, {{ $overdueBorrowings }}],
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: [
                        'rgba(16, 185, 129, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(239, 68, 68, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                },
                cutout: '65%'
            }
        });

            // Add buttons to switch between daily, weekly, monthly views
            const timeframeButtons = document.createElement('div');
            timeframeButtons.className = 'flex gap-2 mb-4';
            timeframeButtons.innerHTML = `
                <button class="px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-md active" data-timeframe="daily">Harian</button>
                <button class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md" data-timeframe="weekly">Mingguan</button>
                <button class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md" data-timeframe="monthly">Bulanan</button>
            `;

            document.getElementById('borrowingTrendsChart').parentElement.insertBefore(timeframeButtons, document.getElementById('borrowingTrendsChart'));

            // Data for different timeframes
            const chartData = {
                daily: {
                    labels: {!! json_encode($dailyLabels) !!},
                    data: {!! json_encode($dailyData) !!}
                },
                weekly: {
                    labels: {!! json_encode($weeklyLabels) !!},
                    data: {!! json_encode($weeklyData) !!}
                },
                monthly: {
                    labels: {!! json_encode($monthlyLabels) !!},
                    data: {!! json_encode($monthlyData) !!}
                }
            };

            // Add click handlers for timeframe buttons
            timeframeButtons.querySelectorAll('button').forEach(button => {
                button.addEventListener('click', (e) => {
                    // Update active button state
                    timeframeButtons.querySelectorAll('button').forEach(b => {
                        b.classList.remove('text-blue-600', 'bg-blue-50');
                        b.classList.add('text-gray-600');
                    });
                    e.target.classList.remove('text-gray-600');
                    e.target.classList.add('text-blue-600', 'bg-blue-50');

                    // Update chart data
                    const timeframe = e.target.dataset.timeframe;
                    trendsChart.data.labels = chartData[timeframe].labels;
                    trendsChart.data.datasets[0].data = chartData[timeframe].data;
                    trendsChart.update();
                });
            });
        });
    </script>
</x-app-layout>