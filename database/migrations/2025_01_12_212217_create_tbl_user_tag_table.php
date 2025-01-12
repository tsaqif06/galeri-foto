<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_user_tag', function (Blueprint $table) {
            $table->bigIncrements('id_user_tag');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id_user')->on('tbl_user')->onDelete('cascade');
            $table->foreign('tag_id')->references('id_tag')->on('tbl_tag')->onDelete('cascade');

            $table->unique(['user_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_user_tag');
    }
};
