<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaSchema extends Migration
{
    /**
    # Create a migration that creates all tables for the following user stories

    For an example on how a UI for an api using this might look like, please try to book a show at https://in.bookmyshow.com/.
    To not introduce additional complexity, please consider only one cinema.

    Please list the tables that you would create including keys, foreign keys and attributes that are required by the user stories.

    ## User Stories

     **Movie exploration**
     * As a user I want to see which films can be watched and at what times
     * As a user I want to only see the shows which are not booked out

     **Show administration**
     * As a cinema owner I want to run different films at different times
     * As a cinema owner I want to run multiple films at the same time in different locations

     **Pricing**
     * As a cinema owner I want to get paid differently per show
     * As a cinema owner I want to give different seat types a percentage premium, for example 50 % more for vip seat

     **Seating**
     * As a user I want to book a seat
     * As a user I want to book a vip seat/couple seat/super vip/whatever
     * As a user I want to see which seats are still available
     * As a user I want to know where I'm sitting on my ticket
     * As a cinema owner I dont want to configure the seating for every show
     */
    public function up()
    {
      Schema::create('owners', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->string('email')->unique();
          $table->timestamp('email_verified_at')->nullable();
          $table->string('password');
          $table->rememberToken();
          $table->timestamps();
      });

      Schema::create('seats', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->string('type');
          $table->integer('total')->unsigned();
          $table->integer('price')->unsigned();
          $table->timestamps();
      });

      Schema::create('cinemas', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->integer('owner_id')->unsigned();
          $table->foreign('owner_id')->references('id')->on('owners');
          $table->integer('seat_id')->unsigned();
          $table->foreign('seat_id')->references('id')->on('seats');
          $table->timestamps();
      });

      Schema::create('films', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->integer('cinema_id')->unsigned();
          $table->foreign('cinema_id')->references('id')->on('cinemas');
          $table->integer('user_id')->unsigned();
          $table->foreign('user_id')->references('id')->on('users');
          $table->timestamps();
      });

      throw new \Exception('implement in coding task 4, you can ignore this exception if you are just running the initial migrations.');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
