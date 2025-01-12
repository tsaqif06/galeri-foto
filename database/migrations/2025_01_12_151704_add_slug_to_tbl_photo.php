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
        Schema::table('tbl_photo', function (Blueprint $table) {
            $table->string('slug', 255)->unique()->after('file_name'); // Tambahkan slug setelah file_name
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_photo', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
