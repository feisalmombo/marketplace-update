<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanRequestApprovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_request_approves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('borrower_id')->unsigned()->nullable();
            $table->text('loan_requests_description')->nullable();
            $table->text('loan_requests_status')->nullable();
            $table->timestamps();


            $table->foreign('product_id')->references('id')
            ->on('products')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('borrower_id')->references('id')
            ->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_request_approves');
    }
}
