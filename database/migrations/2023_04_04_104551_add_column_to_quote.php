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
        Schema::create('quote', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->Text('name');
            $table->Text('email');
            $table->string('phone');
            $table->string('quantity');
            $table->Text('country');
            $table->string('pincode');
            $table->Text('locationtype');
            $table->Text('message_body');
            $table->date('date');
            $table->Text('company_name');
            $table->Text('pcurrency');
            $table->Text('quotestatus');
            $table->string('pid');
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
        Schema::table('quote', function (Blueprint $table) {
            //
        });
    }
};
