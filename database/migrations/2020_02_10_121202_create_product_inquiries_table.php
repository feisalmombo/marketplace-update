<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_inquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->integer('product_id')->unsigned()->nullable();
            $table->string('product_inquiries_status')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('product_inquiries');
    }
}
