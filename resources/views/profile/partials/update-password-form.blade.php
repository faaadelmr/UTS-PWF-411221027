<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Ganti Kata Sandi') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Pastikan kata sandi Anda aman dan mudah diingat.') }}
        </p>
    </header>

    <!-- Notifikasi Sukses atau Gagal -->
    @if (session('status') === 'password-updated')
        <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 rounded">
            {{ __('Kata sandi berhasil diubah.') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 font-medium text-sm text-red-600 bg-red-100 p-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6" id="password-form">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" :value="__('Kata Sandi Saat Ini')" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Kata sandi Baru')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi Baru')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button type="button" onclick="confirmPasswordUpdate()">{{ __('Simpan') }}</x-primary-button>
        </div>
    </form>

    <!-- Modal Konfirmasi -->
    <div id="passwordConfirmationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Konfirmasi Pembaruan Kata Sandi') }}</h3>
            <p class="text-gray-600 mb-6">{{ __('Apakah kamu yakin untuk mengubah kata sandi? kata sandi yang baru akan dibutuhkan untuk masuk ke sistem.') }}</p>
            <div class="flex justify-end gap-4">
                <button type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300" onclick="closePasswordModal()">
                    {{ __('Batal') }}
                </button>
                <button type="button" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700" onclick="submitPasswordForm()">
                    {{ __('Ya, Ganti Kata Sandi') }}
                </button>
            </div>
        </div>
    </div>

    <script>
        function confirmPasswordUpdate() {
            document.getElementById('passwordConfirmationModal').classList.remove('hidden');
            document.getElementById('passwordConfirmationModal').classList.add('flex');
        }

        function closePasswordModal() {
            document.getElementById('passwordConfirmationModal').classList.remove('flex');
            document.getElementById('passwordConfirmationModal').classList.add('hidden');
        }

        function submitPasswordForm() {
            document.getElementById('password-form').submit();
        }
    </script>
</section>
