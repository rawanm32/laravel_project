<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('carts', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->uuid('cookie_id');
        $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
        $table->integer('quantity')->default(1);
        $table->foreignId('book_id')->constrained('books')->cascadeOnDelete();
        $table->timestamps();
        
        // ⬇️⬇️⬇️ أضف هذه الأسطر المهمة ⬇️⬇️⬇️
        $table->unique(['user_id', 'book_id']); // للمستخدمين المسجلين
        $table->unique(['cookie_id', 'book_id']); // للزوار
    });
}
};