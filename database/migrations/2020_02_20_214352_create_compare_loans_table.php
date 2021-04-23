<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompareLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compare_loans', function (Blueprint $table) {
            $table->increments('id');
            $table->text('loan_purpose');
            $table->string('loan_amount');
            $table->string('city');
            $table->string('work_station');
            $table->string('net_salary');
            $table->string('occupation');
            $table->string('time_current_job');
            $table->string('continuous_employment_time');
            $table->string('other_loans');
            $table->string('email_address');
            $table->string('phone_number');
            $table->integer('loan_type_id')->unsigned();
            $table->timestamps();

            $table->foreign('loan_type_id')->references('id')
            ->on('loan_types')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compare_loans');
    }
}
