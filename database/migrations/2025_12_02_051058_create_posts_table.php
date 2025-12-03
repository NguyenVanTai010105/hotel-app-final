<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // nếu chưa dùng user thì nullable
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('featured_image')->nullable(); // một ảnh đại diện
            $table->string('status')->default('available'); // available / unavailable
            $table->integer('capacity')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            // nếu bạn có bảng users uncomment hoặc tạo FK sau
            // $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
