<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendces', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->string('name')->default('name');
            $table->string('attendance')->default();
            $table->string('withdrawal')->nullable();  /// انصراف
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
        Schema::dropIfExists('attendces');
    }
}
