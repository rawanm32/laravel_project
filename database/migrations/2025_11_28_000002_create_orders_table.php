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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()
                ->constrained('users')
                ->cascadeOnDelete();
            $table->string('order_number')->unique();
            $table->enum('status', ['pending', 'processing', 'completed', 'declined', 'cancelled'])
                ->default('pending');
            $table->enum('payment_status', ['pending', 'paid', 'failed'])
                ->default('pending');
            $table->string('payment_method'); // cash, card, bankٍٍ
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('shipping', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->string('currency', 3)->default('USD');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('country', 2);
            $table->string('postal_code')->nullable(); // تم تغيير zip_code إلى postal_code
            $table->text('notes')->nullable();    
            $table->timestamps();
            $table->index('order_number');
            $table->index('status');
            $table->index('payment_status');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};