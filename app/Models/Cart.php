<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;
class Cart extends Model
{
    //
    public $incrementing = false;
    protected $fillable = [
        'cookie_id',
        'user_id',
        'quantity',
        'book_id',
    ];
    // protected static function booted()
    // {
    //     static::creating(function(Cart $cart){
    //           $cart->id = Str::uuid();
    //     });
    // }
    protected static function booted()
    {
       static::observe(CartObserver::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'anonymous',
        ]);
    }
  
 
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    
    // Accessor للحصول على الإجمالي
    public function getTotalAttribute()
    {
        return $this->quantity * ($this->book->price ?? 0);
    }
}
