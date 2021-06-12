<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Parkio1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('login',40);
            $table->char('password',32);
            $table->char('type',1);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('destination', function (Blueprint $table) {
            $table->increments('id');
            $table->string('block',20);
            $table->string('apartament',20);
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('visitor_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description',45);
            $table->smallInteger('time');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('gate', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description',45);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('vehicle', function (Blueprint $table) {
            $table->increments('id');
            $table->string('driver_name');
            $table->char('cpf',14)->nullable();
            $table->char('plate',10);
            $table->string('model',80)->nullable();
            $table->string('color',45)->nullable();
            $table->smallInteger('time');
            $table->timestamps();
            $table->timestamp('left_at')->nullable();
            $table->enum('score',['G','B'])->nullable();
            $table->integer('destination_id')->unsigned();
            $table->integer('visitor_category_id')->unsigned();
            $table->integer('gate_id')->unsigned();
            $table->integer('user_in_id')->unsigned();
            $table->integer('user_out_id')->unsigned()->nullable();
            $table->foreign('destination_id')->references('id')->on('destination');
            $table->foreign('visitor_category_id')->references('id')->on('visitor_category');
            $table->foreign('gate_id')->references('id')->on('gate');
            $table->foreign('user_in_id')->references('id')->on('user');
            $table->foreign('user_out_id')->references('id')->on('user');
        });

        Schema::create('delay', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->smallInteger('time');
            $table->timestamps();
            $table->integer('vehicle_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('vehicle_id')->references('id')->on('vehicle');
            $table->foreign('user_id')->references('id')->on('user');
        });

        Schema::create('complain', function (Blueprint $table) {
            $table->increments('id');
            $table->char('plate',10);
            $table->text('description');
            $table->timestamps();
            $table->integer('vehicle_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('vehicle_id')->references('id')->on('vehicle');
            $table->foreign('user_id')->references('id')->on('user');
        });

        Schema::create('block_manager_has_destination', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('destination_id')->unsigned();
            $table->primary(['user_id','destination_id']);
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('destination_id')->references('id')->on('destination');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('destination');
        Schema::dropIfExists('visitor_category');
        Schema::dropIfExists('gate');
        Schema::dropIfExists('vehicle');
        Schema::dropIfExists('delay');
        Schema::dropIfExists('complain');
        Schema::dropIfExists('block_manager_has_destination');
    }
}
