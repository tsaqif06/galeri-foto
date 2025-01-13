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
        Schema::table('tbl_album', function (Blueprint $table) {
            $table->enum('visibility', ['public', 'private'])->default('public')->after('description');
        });

        Schema::table('tbl_photo', function (Blueprint $table) {
            $table->enum('visibility', ['public', 'private'])->default('public')->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_album', function (Blueprint $table) {
            $table->dropColumn('visibility');
        });

        Schema::table('tbl_photo', function (Blueprint $table) {
            $table->dropColumn('visibility');
        });
    }
};
