<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Buku') }}
            </h2>
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('books.create') }}"
                   class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                    {{ __('Tambah Buku') }}
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

        {{-- FILTER BAR --}}
        <form method="GET" action="{{ route('books.index') }}"
              class="flex flex-col sm:flex-row items-start sm:items-center bg-white p-4 rounded shadow space-y-2 sm:space-y-0 sm:space-x-2">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari judul, penulis atau ISBN..."
                class="flex-1 border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500"
            />

            <select name="availability"
                    class="border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Semua Status</option>
                <option value="available"  {{ request('availability')=='available' ? 'selected':'' }}>
                    Tersedia
                </option>
                <option value="unavailable" {{ request('availability')=='unavailable' ? 'selected':'' }}>
                    Habis
                </option>
            </select>

            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                Terapkan
            </button>
        </form>

        {{-- FLASH NOTIFICATIONS --}}
        @if(session('success'))
            <div class="p-4 mb-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="p-4 mb-4 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        {{-- TABLE --}}
        <div class="bg-white shadow sm:rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ISBN</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul Buku</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Penulis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tahun</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tersisa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($books as $book)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $book->book_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $book->isbn }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $book->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $book->author }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $book->year_published }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($book->quantity_available > 0)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $book->quantity_available }}
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    {{ $book->quantity_available }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex space-x-2">
                                <a href="{{ route('books.show', $book) }}"
                                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                    Lihat
                                </a>

                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('books.edit', $book) }}"
                                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-yellow-600 rounded-md hover:bg-yellow-700">
                                        Edit
                                    </a>

                                    <form action="{{ route('books.destroy', $book) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </form>
                                @endif

                                @if(Auth::user()->role === 'member' && $book->quantity_available > 0)
                                    <a href="{{ route('borrowings.create', ['book_id' => $book->book_id]) }}"
                                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">
                                        Pinjam Buku
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada buku ditemukan.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="p-4">
                {{ $books->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
