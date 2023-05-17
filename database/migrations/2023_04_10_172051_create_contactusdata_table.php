<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactusdata', function (Blueprint $table) {
            $table->id();
            $table->string('contact_us_heading');
            $table->string('company_name');
            $table->string('address');
            $table->string('mobile_number');
            $table->string('phone_number');
            $table->string('email');
            $table->string('whatsapp_number');
            $table->tinyInteger('map_visibility');
            $table->string('contact_us_data_position');
            $table->string('contact_us_form_position');
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
        Schema::dropIfExists('contactusdata');
    }
};
