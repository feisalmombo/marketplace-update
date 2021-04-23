<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('date_of_birth')->nullable();
            $table->string('government_id_number')->nullable();
            $table->string('city')->nullable();
            $table->string('password');
            $table->string('activiti')->nullable();
            $table->timestamps();
            $table->string('status')->nullable();
            $table->text('bank_name')->nullable();
            $table->string('profile_image_path')->nullable();
            $table->string('applied_status')->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('loanrates_id')->unsigned()->nullable();
            $table->rememberToken();

            $table->foreign('product_id')->references('id')
            ->on('products')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
