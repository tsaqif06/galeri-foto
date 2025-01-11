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
        Schema::create('tbl_photo_tag', function (Blueprint $table) {
            $table->bigIncrements('id_photo_tag');
            $table->unsignedBigInteger('photo_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->foreign('photo_id')->references('id_photo')->on('tbl_photo')->onDelete('cascade');
            $table->foreign('tag_id')->references('id_tag')->on('tbl_tag')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_photo_tag');
    }
};
