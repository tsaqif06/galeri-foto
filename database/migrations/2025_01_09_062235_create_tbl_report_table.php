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
        Schema::create('tbl_report', function (Blueprint $table) {
            $table->bigIncrements('id_report');
            $table->unsignedBigInteger('photo_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('reason_id');
            $table->timestamps();

            $table->foreign('photo_id')->references('id_photo')->on('tbl_photo')->onDelete('cascade');
            $table->foreign('user_id')->references('id_user')->on('tbl_user')->onDelete('cascade');
            $table->foreign('reason_id')->references('id_report_reason')->on('tbl_report_reason')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_report');
    }
};