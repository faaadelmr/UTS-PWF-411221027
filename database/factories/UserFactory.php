<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 * @method \App\Models\User create(array $attributes = [])
 */
class UserFactory extends Factory
{
    protected static ?string $password;
    protected $model = User::class;

    /**
     * Define the model's default state.
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->unique()->userName(),
            'password_hash' => static::$password ??= Hash::make('password'), // Default password 'password'
            'full_name' => fake()->name(),
            'role' => 'member', // Default role is member
            'status' => 'active', // Default status is active
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
 }

