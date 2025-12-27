<?php

namespace App\Concerns;

use App\Models\Role;

trait HasRoles
{
    // العلاقة بين الرول واليوزرس ميني تو ميني
    //     العلاقة بين الرول  والادمنز ميني تو ميني
    // مارح نستخدم علاقة ةbelongsTo many لا
    // لانو ماعنا foreignId key
// رح نستخدم المورف
        public function roles()
        {
            return $this->morphToMany(Role::class,'authorizable','role_user');
        }
        public function hasAbility($ability) // فحص الصلاحيات
        {         
            
            return $this->roles()->whereHas('abilities',function ($q) use ($ability){
                $q->where('ability','=',$ability) // prodcts.view
                ->where('type','=','allow');
            })->exists();
        }
}