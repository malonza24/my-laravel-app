<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ParentGuardian extends Authenticatable
{
    use Notifiable;

    protected $table = 'parents';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'id_number',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'email_verified_at' => 'datetime',
    ];

    public function children()
    {
        return $this->hasMany(Child::class, 'parent_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'parent_id');
    }

    public function isBlocked(): bool
    {
        return $this->status === 'blocked';
    }
}