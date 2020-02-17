<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('title');
           
            $table->integer('price')->default(0);
            $table->integer('delivery_price')->default(0);
            $table->integer('status')->default(1);

            /**
             * status
             * 
             * 1 -> new
             * 
             * 2 -> in proogess
             * 
             * 3 -> done
             * 
             * 4 -> indelivery
             * 
             * 5- evulate
             */
            $table->string('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->double('rate')->default(2.5);
            $table->string('review')->nullable();
            $table->bigInteger('client_id')->unsigned()->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            $table->bigInteger('delivery_id')->unsigned()->nullable();
            $table->foreign('delivery_id')->references('id')->on('deliveries')->onDelete('cascade');

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
