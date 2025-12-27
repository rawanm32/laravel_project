<?php

namespace App\Models;

use App\Concerns\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;


class Admin extends User  // user calss ويضيف امور متعلقة بعمليات تسجيل الدخول
{
    //
    use HasFactory , Notifiable, HasRoles;
    protected $fillable = [
       'name',
       'email',
       'password',
       'phone_number',
        'super_admin',
        'status',
    ];
    
    protected $casts = [
        'super_admin' => 'boolean',
    ];

    /**
     * Helper to check if admin is active.
     */
    public function isActive()
    {
        return $this->status === 'active';
    }
}
