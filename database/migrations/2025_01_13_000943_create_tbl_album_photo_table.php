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
        Schema::create('tbl_album_photo', function (Blueprint $table) {
            $table->bigIncrements('id_album_photo');

            $table->unsignedBigInteger('album_id');
            $table->foreign('album_id')
                ->references('id_album')
                ->on('tbl_album')
                ->onDelete('cascade');

            $table->unsignedBigInteger('photo_id');
            $table->foreign('photo_id')
                ->references('id_photo')
                ->on('tbl_photo')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_album_photo');
    }
};
