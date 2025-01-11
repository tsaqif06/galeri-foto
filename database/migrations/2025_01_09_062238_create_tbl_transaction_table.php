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
        Schema::create('tbl_transaction', function (Blueprint $table) {
            $table->bigIncrements('id_transaction');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_photo');
            $table->decimal('amount', 10, 2);
            $table->unsignedBigInteger('status_id');
            $table->string('payment_status', 50);
            $table->string('stripe_payment_id', 50)->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('cascade');
            $table->foreign('id_photo')->references('id_photo')->on('tbl_photo')->onDelete('cascade');
            $table->foreign('status_id')->references('id_status')->on('tbl_transaction_status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_transaction');
    }
};
