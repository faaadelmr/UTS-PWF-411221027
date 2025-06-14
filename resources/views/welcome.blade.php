<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Web Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('library.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-gray-50 bg-pattern">
    <!-- Hero Section -->
    <div class="pt-24 pb-12 md:pt-32 md:pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight">
                        <span class="text-red-600">Kelola Peminjaman Buku</span> dengan Mudah dan Efisien
                    </h1>
                    <p class="mt-4 text-xl text-gray-600 max-w-3xl">
                        Aplikasi web sederhana powerful untuk mengelola data peminjaman buku di perpustakaan. Tingkatkan efisiensi dan akurasi pencatatan data.
                    </p>
                    <div class="mt-8 flex flex-col sm:flex-row justify-center md:justify-start gap-4">
                        <a href="/register" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                            Daftar Sekarang
                        </a>
                        <a href="/login" class="bg-white hover:bg-gray-100 text-red-600 font-bold py-3 px-8 rounded-lg shadow-lg border border-red-600 transition duration-300 ease-in-out">
                            <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                        </a>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="shadow-2xl rounded-lg overflow-hidden">
                            <svg class="w-full h-auto max-w-md" viewBox="0 0 600 400" xmlns="http://www.w3.org/2000/svg">
                                <!-- Dashboard Mockup -->
                                <rect x="0" y="0" width="600" height="400" fill="#fef2f2" rx="6"></rect>
                                
                                <!-- Top Bar -->
                                <rect x="0" y="0" width="600" height="50" fill="#FF0000" rx="6 6 0 0"></rect>
                                <text x="60" y="30" fill="white" font-size="18" font-weight="bold">Perpustakaan Web Management</text>
                                <circle cx="30" cy="25" r="15" fill="white"></circle>
                                <path d="M25,20 L35,20 M25,25 L35,25 M25,30 L35,30" stroke="#FF0000" stroke-width="2"></path>
                                
                                <!-- Sidebar -->
                                <rect x="0" y="50" width="150" height="350" fill="#f1f5f9"></rect>
                                <rect x="15" y="70" width="120" height="40" rx="5" fill="#dbeafe"></rect>
                                <text x="50" y="95" fill="#64748b" font-size="14">Dashboard</text>
                                
                                <rect x="15" y="120" width="120" height="40" rx="5" fill="white"></rect>
                                <text x="50" y="145" fill="#64748b" font-size="14">Buku</text>
                                
                                <rect x="15" y="170" width="120" height="40" rx="5" fill="white"></rect>
                                <text x="50" y="195" fill="#64748b" font-size="14">Peminjaman</text>
                                
                                <rect x="15" y="220" width="120" height="40" rx="5" fill="white"></rect>
                                <text x="50" y="245" fill="#64748b" font-size="14">Anggota</text>
                                
                                
                                <!-- Main Content -->
                                <rect x="170" y="70" width="410" height="80" rx="5" fill="white" stroke="#e2e8f0" stroke-width="1"></rect>
                                <text x="190" y="95" fill="#334155" font-size="14" font-weight="bold">Total Peminjaman</text>
                                <text x="190" y="130" fill="#FF0000" font-size="24" font-weight="bold">1,245</text>
                                <path d="M500,80 L520,100 L540,85 L560,115" stroke="#3b82f6" stroke-width="2" fill="none"></path>
                                
                                <rect x="170" y="160" width="200" height="170" rx="5" fill="white" stroke="#e2e8f0" stroke-width="1"></rect>
                                <text x="190" y="185" fill="#334155" font-size="14" font-weight="bold">Peminjaman Terbaru</text>
                                <line x1="190" y1="200" x2="350" y2="200" stroke="#e2e8f0" stroke-width="1"></line>
                                
                                <text x="190" y="225" fill="#64748b" font-size="12">Sherlock Holmes</text>
                                <text x="310" y="225" fill="#334155" font-size="12">Hari ini</text>
                                
                                <text x="190" y="255" fill="#64748b" font-size="12">Harry Potter</text>
                                <text x="310" y="255" fill="#334155" font-size="12">Kemarin</text>
                                
                                <text x="190" y="285" fill="#64748b" font-size="12">The Great Gatsby</text>
                                <text x="310" y="285" fill="#334155" font-size="12">3 hari lalu</text>
                                
                                <text x="190" y="315" fill="#64748b" font-size="12">To Kill a Mockingbird</text>
                                <text x="310" y="315" fill="#334155" font-size="12">5 hari lalu</text>
                                
                                <rect x="380" y="160" width="200" height="170" rx="5" fill="white" stroke="#e2e8f0" stroke-width="1"></rect>
                                <text x="400" y="185" fill="#334155" font-size="14" font-weight="bold">Status Buku</text>
                                
                                <!-- Pie Chart -->
                                <circle cx="480" cy="250" r="60" fill="#dbeafe"></circle>
                                <path d="M480,250 L480,190 A60,60 0 0,1 534,232 z" fill="#FFC0CB"></path>
                                <path d="M480,250 L534,232 A60,60 0 0,1 480,310 z" fill="#FF0000"></path>
                                
                                <circle cx="425" cy="310" r="5" fill="#dbeafe"></circle>
                                <text x="435" y="315" fill="#64748b" font-size="12">Tersedia (65%)</text>
                                
                                <circle cx="425" cy="285" r="5" fill="#FF0000"></circle>
                                <text x="435" y="290" fill="#64748b" font-size="12">Dipinjam (25%)</text>
                                
                                <circle cx="425" cy="260" r="5" fill="#FFC0CB"></circle>
                                <text x="435" y="265" fill="#64748b" font-size="12">Terlambat (10%)</text>
                            </svg>
                        </div>
                        <!-- Decorative elements -->
                        <div class="absolute -bottom-4 -right-4 z-[-1] w-64 h-64 bg-red-100 rounded-full opacity-70"></div>
                        <div class="absolute -top-4 -left-4 z-[-1] w-32 h-32 bg-yellow-100 rounded-full opacity-70"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Fitur Utama Perpustakaan Web Management
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Solusi sederhana untuk pengelolaan peminjaman buku perpustakaan.
                </p>
            </div>

            <div class="mt-12">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="pt-6">
                        <div class="flow-root bg-gray-50 rounded-lg px-6 pb-8 h-full">
                            <div class="-mt-6">
                                <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-red-500 rounded-md shadow-lg">
                                        <i class="fas fa-book text-white text-xl"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Manajemen Buku</h3>
                                <p class="mt-5 text-base text-gray-500">
                                    Catat dan kelola informasi buku dengan mudah. Tambah, edit, dan hapus data buku dengan cepat.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="flow-root bg-gray-50 rounded-lg px-6 pb-8 h-full">
                            <div class="-mt-6">
                                <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-red-500 rounded-md shadow-lg">
                                        <i class="fas fa-exchange-alt text-white text-xl"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Transaksi Peminjaman</h3>
                                <p class="mt-5 text-base text-gray-500">
                                    Catat transaksi peminjaman dan pengembalian buku dengan cepat dan akurat. Pantau batas waktu pengembalian.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="flow-root bg-gray-50 rounded-lg px-6 pb-8 h-full">
                            <div class="-mt-6">
                                <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-red-500 rounded-md shadow-lg">
                                        <i class="fas fa-users text-white text-xl"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Data Anggota</h3>
                                <p class="mt-5 text-base text-gray-500">
                                    Kelola data anggota perpustakaan dengan efisien. Lihat riwayat peminjaman dan status keanggotaan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="flow-root bg-gray-50 rounded-lg px-6 pb-8 h-full">
                            <div class="-mt-6">
                                <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-red-500 rounded-md shadow-lg">
                                        <i class="fas fa-chart-bar text-white text-xl"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Laporan & Statistik</h3>
                                <p class="mt-5 text-base text-gray-500">
                                    Dapatkan laporan dan statistik peminjaman buku untuk membantu pengambilan keputusan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Screenshot Section -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Interface yang Sederhana dan Intuitif
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Dirancang untuk kemudahan penggunaan tanpa mengorbankan fungsionalitas
                </p>
            </div>

            <div class="mt-12">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                    <div class="bg-white p-6 rounded-lg shadow-md overflow-hidden">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Daftar Peminjaman Buku</h3>
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Buku</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Laskar Pelangi</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ahmad Fajar</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">01/05/2025</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Aktif</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Bumi Manusia</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Siti Aminah</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">28/04/2025</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Aktif</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Filosofi Teras</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Budi Santoso</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">25/04/2025</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Akan Jatuh Tempo</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Laut Bercerita</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dewi Lestari</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20/04/2025</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Terlambat</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md overflow-hidden">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Form Peminjaman Buku</h3>
                        <form class="space-y-4">
                            <div>
                                <label for="book" class="block text-sm font-medium text-gray-700">Pilih Buku</label>
                                <select id="book" name="book" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                    <option>Harry Potter dan Batu Bertuah</option>
                                    <option>Negeri 5 Menara</option>
                                    <option>Perahu Kertas</option>
                                    <option>Bumi</option>
                                    <option>Pulang</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="member" class="block text-sm font-medium text-gray-700">Peminjam</label>
                                <select id="member" name="member" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                    <option>Rina Marlina (ID: 20230001)</option>
                                    <option>Joko Susilo (ID: 20230015)</option>
                                    <option>Anita Wijaya (ID: 20230022)</option>
                                    <option>Rudi Hermawan (ID: 20230030)</option>
                                </select>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="borrow-date" class="block text-sm font-medium text-gray-700">Tanggal Pinjam</label>
                                    <input type="date" name="borrow-date" id="borrow-date" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                
                                <div>
                                    <label for="return-date" class="block text-sm font-medium text-gray-700">Tanggal Kembali</label>
                                    <input type="date" name="return-date" id="return-date" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="button" class="mr-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300">
                                    Batal
                                </button>
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="flex justify-center items-center mb-4">
                    <i class="fas fa-book-reader text-red-400 text-2xl mr-2"></i>
                    <span class="font-bold text-xl text-red-400">Perpustakaan Web Management</span>
                </div>
                <p class="text-gray-400 text-base">
                    Kelola Peminjaman Buku dengan Mudah dan Efisien
                </p>
                <p class="mt-4 text-center text-base text-gray-400">
                    &copy; 2025 Fadel Muhamad Rifai - 411221027.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>