<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request ;

class Role extends Model
{
    //
    protected $fillable = [
        'name',
        
    ];
    public static function createWithAbilities($request)
    {
        $role = Role::create([
            'name' => $request->name,
        ]);
        foreach ($request->abilities as $ability => $value) {
            RoleAbility::create([
                'role_id' => $role->id,
                'ability' => $ability,
                'type' => $value
            ]);
        }
        return $role;
    }
    public  function updateWithAbilities(Request $request)
    {
        $this->update([
            'name' => $request->post('name'),
        ]);
        foreach ($request->post('abilities') as $ability => $value) {
            RoleAbility::updateOrCreate([
                'role_id' => $this->id,
                'ability' => $ability,
            ],[
                'type' => $value,
            ]);
        }
        return $this;
    }
    public function abilities()
    {
        return $this->hasMany(RoleAbility::class);
    }
    
}
