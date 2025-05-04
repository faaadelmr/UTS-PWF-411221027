<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Peminjaman Buku') }}
            </h2>
            <a href="{{ route('borrowings.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                {{ __('Buat Peminjaman') }}
            </a>
        </div>
    </x-slot>

    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- Filter Status --}}
        <form method="GET" action="{{ route('borrowings.index') }}" class="flex items-center space-x-2">
            <label for="status" class="text-gray-700 font-medium">Filter Status:</label>
            <select name="status" id="status"
                class="block w-48 px-3 py-2 border border-gray-300 bg-white rounded-md text-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                onchange="this.form.submit()">
                <option value="" {{ request('status')=='' ? 'selected' : '' }}>Semua</option>
                <option value="borrowed" {{ request('status')=='borrowed' ? 'selected' : '' }}>Aktif</option>
                <option value="returned" {{ request('status')=='returned' ? 'selected' : '' }}>Dikembalikan</option>
                <option value="overdue" {{ request('status')=='overdue' ? 'selected' : '' }}>Terlambat</option>
            </select>
            @if(request()->filled('status'))
                <a href="{{ route('borrowings.index') }}"
                   class="text-sm text-gray-500 hover:text-gray-700">Reset</a>
            @endif
        </form>

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

                <h3 class="text-lg font-medium text-gray-900 mb-4">Daftar Peminjaman Buku</h3>
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                @if(Auth::user()->role === 'admin')
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                @endif
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Buku</th>
                                @if(Auth::user()->role === 'admin')
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                                @endif
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kembali</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($borrowings as $borrowing)
                                <tr>
                                    @if(Auth::user()->role === 'admin')
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $borrowing->borrowing_id }}
                                    </td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $borrowing->book->title }}
                                    </td>
                                    @if(Auth::user()->role === 'admin')
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $borrowing->user->full_name }}
                                    </td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $borrowing->borrow_date }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $borrowing->return_date ?? 'Not returned yet' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($borrowing->status === 'borrowed')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Aktif
                                            </span>
                                        @elseif($borrowing->status === 'returned')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Dikembalikan
                                            </span>
                                        @elseif($borrowing->status === 'overdue')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Terlambat
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('borrowings.show', $borrowing) }}"
                                               class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                                Lihat
                                            </a>
                                            @if(in_array($borrowing->status, ['borrowed','overdue']))
                                                <form action="{{ route('borrowings.return', $borrowing) }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">
                                                        Kembalikan
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ Auth::user()->role === 'admin' ? 7 : 5 }}" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Tidak ada buku yang dipinjam.
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
    </div>
</x-app-layout>
