<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->uuid('information_id');
            $table->foreign('information_id')->references('id')->on('informations')->onDelete('cascade');
            $table->string('payment');
            $table->string('total');
            $table->uuid('coupon_id')->nullable();
            $table->foreign('coupon_id')->references('id')->on('coupon_user')->onDelete('cascade');
            $table->timestamp('date_order')->nullable();
            $table->timestamp('date_finish')->nullable();
            $table->string('status')->default(\App\Enums\OrderStatusEnum::CONFIRM);
            $table->string('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
