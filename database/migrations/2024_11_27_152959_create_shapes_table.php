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
        Schema::create('shapes', function (Blueprint $table) {
       $table->bigIncrements('id');
       $table->unsignedBigInteger('user_id')->nullable(); 
        $table->string('shape_type');
        $table->json('dimensions');
        $table->unsignedBigInteger('material_id');
        $table->double('area')->nullable();
        $table->double('volume')->nullable();
        $table->double('weight')->nullable();
        $table->timestamps();

       // إضافة المفاتيح الخارجية
       $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
       $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
   });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shapes');
    }
};
