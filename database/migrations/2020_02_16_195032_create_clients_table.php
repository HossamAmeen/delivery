<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
      
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('phone');
            $table->string('phone2')->nullable();
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('job')->nullable();
            $table->boolean('is_block')->default(0);
            $table->string('block_reason')->nullable()->default("he is not good");

            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // $table->bigInteger('user_id')->unsigned()->nullable();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('clients');
    }
}
