<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Category extends Model
{
    use HasFactory, Translatable;
    
    protected $fillable = [
        'name',
        'description', 
        'status',
           'translations'
    ];
    
    public function books()
    {
        return $this->hasMany(Book::class);
    }
    
    public function getTranslatableAttributes(): array
    {
        return ['name', 'description'];
    }
}


