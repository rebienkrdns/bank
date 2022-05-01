<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id_origin');
            $table->foreign('account_id_origin')->references('id')->on('accounts');
            $table->unsignedInteger('account_id_destination')->nullable();
            $table->foreign('account_id_destination')->references('id')->on('accounts');
            $table->decimal('transaction', 13, 2);
            $table->decimal('value', 13, 2);
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
