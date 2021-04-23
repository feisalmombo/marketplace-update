<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('institution_name');
            $table->integer('institution_type_id')->unsigned();
            $table->string('institution_logo')->nullable();
            $table->string('institution_street_city')->nullable();
            $table->string('institution_contact_email');
            $table->string('institution_contact_phone_number');
            $table->string('institution_social_media_links')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_code')->nullable();
            $table->timestamps();

            $table->foreign('institution_type_id')->references('id')
            ->on('institution_types')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
