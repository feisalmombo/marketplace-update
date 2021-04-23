<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanProductSubmitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_product_submits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('loan_amount');
            $table->integer('loan_type_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('loan_type_id')->references('id')
            ->on('loan_types')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('loan_product_submits');
    }
}
