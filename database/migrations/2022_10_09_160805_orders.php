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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bundle_id');
            $table->unsignedBigInteger('order_status_id');
            $table->unsignedBigInteger('asist_by')->nullable();
            $table->json('account_info');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('bundle_id')->references('id')->on('bundles');
            $table->foreign('order_status_id')->references('id')->on('order_statuses');
            $table->foreign('asist_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
