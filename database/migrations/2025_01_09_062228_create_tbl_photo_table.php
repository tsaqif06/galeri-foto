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
        Schema::create('tbl_photo', function (Blueprint $table) {
            $table->bigIncrements('id_photo');
            $table->unsignedBigInteger('user_id');
            $table->string('file_name', 200);
            $table->string('file_path', 255);
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id_user')->on('tbl_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_photo');
    }
};
