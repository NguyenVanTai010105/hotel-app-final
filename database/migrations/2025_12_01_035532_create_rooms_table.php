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
    Schema::create('rooms', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Tên phòng
        $table->string('slug')->unique(); // Đường dẫn thân thiện (VD: phong-deluxe)
        $table->string('type'); // Single, Double, Suite
        $table->integer('capacity'); // Sức chứa
        $table->decimal('price', 10, 2); // Giá
        $table->text('description')->nullable(); // Mô tả
        $table->string('status')->default('available'); // Trạng thái
        $table->string('image')->nullable(); // Link ảnh
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
