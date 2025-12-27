<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Translatable;
class Author extends Model
{
    
    use HasFactory, Translatable;
    
    protected $fillable = [
        'name',
        'bio',
        'image', 
        'status',
    ];
      public function books()
    {
        return $this->hasMany(Book::class);
    }
    
    public function getTranslatableAttributes(): array
    {
        return ['name', 'bio'];
    }
}
