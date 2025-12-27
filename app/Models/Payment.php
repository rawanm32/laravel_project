<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'transaction_id',
        'payment_method',
        'amount',
        'currency',
        'status',
        'stripe_response',
        'customer_email',
        'receipt_url',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'stripe_response' => 'array',
        'paid_at' => 'datetime',
    ];

    // Relations
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Accessors
    public function getStatusLabelAttribute()
    {
        return [
            'pending' => 'قيد الانتظار',
            'processing' => 'قيد المعالجة',
            'completed' => 'مكتمل',
            'failed' => 'فشل',
            'refunded' => 'مسترد',
        ][$this->status] ?? $this->status;
    }
}