<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'payment_status',
        'payment_method',
        'subtotal',
        'tax',
        'shipping',
        'total',
        'currency',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'shipping' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest',
        ]);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getStatusLabelAttribute()
    {
        return [
            'pending' => 'قيد الانتظار',
            'processing' => 'قيد المعالجة',
            'completed' => 'مكتمل',
            'declined' => 'مرفوض',
            'cancelled' => 'ملغي',
        ][$this->status] ?? $this->status;
    }

    public function getPaymentStatusLabelAttribute()
    {
        return [
            'pending' => 'قيد الانتظار',
            'paid' => 'مدفوع',
            'failed' => 'فشل',
        ][$this->payment_status] ?? $this->payment_status;
    }
    
    public function getPaymentMethodLabelAttribute()
    {
        return [
            'cash' => 'الدفع عند الاستلام',
            'card' => 'بطاقة ائتمان',
            'bank' => 'تحويل بنكي',
        ][$this->payment_method] ?? $this->payment_method;
    }
}