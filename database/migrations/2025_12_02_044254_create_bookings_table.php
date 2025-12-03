<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->index(); // phòng (post)
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('guest_name');
            $table->string('guest_email');
            $table->string('guest_phone')->nullable();
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('guests')->default(1);
            $table->decimal('total_price', 10, 2)->default(0);
            $table->enum('status', ['pending','confirmed','cancelled','checked_in','checked_out'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();

            // Nếu muốn enforce FK, bỏ comment 2 dòng dưới (chú ý kiểu id phải khớp)
            // $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
