<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->string('order_number')->unique();
            $table->uuid('user_id');
            $table->enum('status', ['order placed','order confirm','delivered', 'cancelled'])->default('order placed');
            $table->integer('sub_total');
            $table->integer('grand_total');
            $table->integer('item_count');

            $table->string('shipping_fullname');
            $table->string('shipping_address');
            $table->string('shipping_phone');
            $table->string('notes')->nullable();

            $table->timestamps();
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
}
