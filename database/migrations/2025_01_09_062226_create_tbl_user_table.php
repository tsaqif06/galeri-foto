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
        Schema::create('tbl_user', function (Blueprint $table) {
            $table->bigIncrements('id_user');
            $table->string('name', 50);
            $table->string('email', 80)->unique();
            $table->string('password', 200);
            $table->unsignedBigInteger('role_id');
            $table->string('stripe_account_id', 50)->nullable();
            $table->timestamps();

            $table->foreign('role_id')->references('id_role')->on('tbl_role')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_user');
    }
};
