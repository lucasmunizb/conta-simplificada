<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('id_user_payer');
            $table->foreign('id_user_payer')->references('id')->on('users');
            $table->unsignedBigInteger('id_user_payee');
            $table->foreign('id_user_payee')->references('id')->on('users');
            $table->enum('transfer_status', ['failed', 'approved','requested']);
            $table->decimal('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
