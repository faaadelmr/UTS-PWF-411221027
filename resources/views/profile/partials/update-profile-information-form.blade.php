<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profil Informasi') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Perbaharui informasi profil Anda. Tekan tombol 'Simpan' untuk menyimpan perubahan.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Notifikasi Sukses atau Gagal -->
    @if (session('status') === 'profile-updated')
        <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 rounded">
            {{ __('Profil berhasil diperbarui.') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 font-medium text-sm text-red-600 bg-red-100 p-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" id="profile-form">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="username" :value="__('Nama Akun')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autofocus autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="full_name" :value="__('Nama Panjang')" />
            <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full" :value="old('full_name', $user->full_name)" required autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button type="button" onclick="confirmUpdate()">{{ __('Simpan') }}</x-primary-button>
        </div>
    </form>

    <!-- Modal Konfirmasi -->
    <div id="confirmationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Konfirmasi Update Profil') }}</h3>
            <p class="text-gray-600 mb-6">{{ __('Apakah Anda yakin ingin memperbarui profil Anda?') }}</p>
            <div class="flex justify-end gap-4">
                <button type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300" onclick="closeModal()">
                    {{ __('Batal') }}
                </button>
                <button type="button" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700" onclick="submitForm()">
                    {{ __('Ya, Perbarui') }}
                </button>
            </div>
        </div>
    </div>

    <script>
        function confirmUpdate() {
            document.getElementById('confirmationModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('confirmationModal').classList.add('hidden');
        }

        function submitForm() {
            document.getElementById('profile-form').submit();
        }
    </script>
</section>
