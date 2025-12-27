<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; 
use App\Traits\Translatable;
class Book extends Model
{
    use Translatable;
    
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'author_id',
        'description',
        'pages',
        'publication_year',
        'price',
        'compare_price',
        'image',
        'book_url',
        'status',
        'user_id',
    ];
 
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

  
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('paid_at')
            ->withTimestamps();
    }
    public function getTranslatableAttributes(): array
    {
        return ['title', 'description'];
    }

}
