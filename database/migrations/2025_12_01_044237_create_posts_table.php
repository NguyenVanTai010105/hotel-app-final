<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // cập nhật dữ liệu cũ trước: published -> available, draft -> unavailable
        DB::table('posts')->where('status', 'published')->update(['status' => 'available']);
        DB::table('posts')->where('status', 'draft')->update(['status' => 'unavailable']);

        // đổi default nếu cột tồn tại
        Schema::table('posts', function (Blueprint $table) {
            // change() yêu cầu doctrine/dbal; nếu không có, ta fallback bằng raw SQL
            // Try to change via SQL for MySQL and SQLite
            $driver = config('database.default');
            if ($driver === 'mysql') {
                DB::statement("ALTER TABLE `posts` MODIFY `status` VARCHAR(255) NOT NULL DEFAULT 'available'");
            } else {
                // for sqlite / others - cannot alter easily; leave as is
            }
        });
    }

    public function down()
    {
        // revert: available -> published, unavailable -> draft
        DB::table('posts')->where('status', 'available')->update(['status' => 'published']);
        DB::table('posts')->where('status', 'unavailable')->update(['status' => 'draft']);

        // revert default (try for mysql)
        $driver = config('database.default');
        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE `posts` MODIFY `status` VARCHAR(255) NOT NULL DEFAULT 'draft'");
        }
    }
};
