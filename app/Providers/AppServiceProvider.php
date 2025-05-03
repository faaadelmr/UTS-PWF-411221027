<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('current_password', function ($attribute, $value, $parameters, $validator) {
            $user = auth()->user();
            
            // Log untuk debugging
            Log::info('Validating current password for user: ' . $user->username);
            
            // Periksa password terhadap password_hash
            $result = Hash::check($value, $user->password_hash);
            
            Log::info('Password validation result: ' . ($result ? 'success' : 'failed'));
            
            return $result;
        });
        
        // Tambahkan pesan error kustom
        Validator::replacer('current_password', function ($message, $attribute, $rule, $parameters) {
            return 'The current password is incorrect.';
        });
    }
}
