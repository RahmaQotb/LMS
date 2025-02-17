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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('drive_url')->nullable();
            $table->string('google_form_url')->nullable();
            $table->string('youtube_url')->nullable();
            // $table->enum('status', ['قيد المعالجة', 'مقبول', 'مرفوض'])->default('قيد المعالجة');        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
