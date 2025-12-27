<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->string('transaction_id')->unique(); // Stripe Payment Intent ID
            $table->string('payment_method')->default('stripe'); // stripe, paypal, etc
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('USD');
            $table->enum('status', ['pending', 'processing', 'completed', 'failed', 'refunded'])->default('pending');
            $table->text('stripe_response')->nullable(); // JSON response من Stripe
            $table->string('customer_email')->nullable();
            $table->string('receipt_url')->nullable(); // رابط الفاتورة من Stripe
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
            
            $table->index('transaction_id');
            $table->index('order_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
