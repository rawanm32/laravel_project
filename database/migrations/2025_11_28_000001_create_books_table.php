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
        Schema::create('books', function (Blueprint $table) {
   $table->id();
            
          
            $table->foreignId('category_id')
                  ->nullable() 
                  ->constrained('categories')
                  ->nullOnDelete(); 

         
            $table->foreignId('author_id')
                  ->nullable() 
                  ->constrained('authors') 
                  ->nullOnDelete(); 

            $table->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade');

            
            $table->string('title', 255); 
            $table->string('slug', 255)->unique(); 
            $table->text('description')->nullable(); 
            $table->integer('pages')->nullable(); 
            $table->year('publication_year')->nullable(); 
            $table->decimal('price', 8, 2)->default(0); 

      
            $table->decimal('compare_price', 8, 2)->nullable();
            
        
            $table->string('image')->nullable();
            
              $table->string('book_url')->nullable();
            $table->enum('status', ['available', 'unavailable'])->default('available');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
