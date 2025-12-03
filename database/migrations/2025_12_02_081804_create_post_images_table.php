<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('post_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->string('path'); // đường dẫn lưu trong storage/app/public/...
            $table->string('alt')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_images');
    }
};
