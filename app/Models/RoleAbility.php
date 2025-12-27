<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleAbility extends Model
{
    protected $fillable = [
        'role_id',
        'ability',
        'type',
    ];

    // بما أنها جدول وسيط، غالباً لا نحتاج لوقت الإنشاء والتحديث
    public $timestamps = false;

    /**
     * العلاقة العكسية مع الدور
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}