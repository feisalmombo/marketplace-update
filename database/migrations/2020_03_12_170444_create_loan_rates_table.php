<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('loan_type_id')->unsigned();
            $table->integer('duration_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('loanpurpose_type_id')->unsigned()->nullable();
            $table->double('interest_rate', 12, 2)->nullable();
            $table->double('minimum_net_salary', 12, 2)->nullable();
            $table->double('minimum_amount', 12, 2)->nullable();
            $table->double('maxmum_amount', 12, 2)->nullable();
            $table->double('turn_around_time', 12, 2)->nullable();
            $table->double('facility_rate', 12, 2)->nullable();
            $table->double('insurance_rate', 12, 2)->nullable();
            $table->double('loan_processing_rate', 12, 2)->nullable();
            $table->text('eligibility');
            $table->boolean('loan_option')->default(false);
            $table->string('loan_purchase')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('loan_type_id')->references('id')->on('loan_types')->onDelete('cascade');
            $table->foreign('duration_id')->references('id')->on('durations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')
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
        Schema::dropIfExists('loan_rates');
    }
}
