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
        Schema::create('tbl_like', function (Blueprint $table) {
            $table->bigIncrements('id_like');
            $table->unsignedBigInteger('id_photo');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_photo')->references('id_photo')->on('tbl_photo')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_like');
    }
};
