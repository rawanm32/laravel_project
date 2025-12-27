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
        Schema::create('role_user', function (Blueprint $table) {
           // authorizable_id
           // authorizable_type is the type of [admin user ]
             $table->morphs('authorizable');
            $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete();
            $table->unique(['authorizable_id', 'role_id','authorizable_type']); 
       //     ممنوع التكرار هون لانو اليوزر رقم واحد ما بصير ياخد اكثر من رول نفسه
       // muhammed : admin adminstrator writer
       // adminstrator : muhammed ali ahmed
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
