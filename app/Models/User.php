<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'member_id';

    public $timestamps = false; // Add this line to disable timestamps

    protected $fillable = [
        'username',
        'password_hash',
        'full_name',
        'role',
        'status'
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}
