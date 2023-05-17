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
        Schema::table('velocity_meta_data', function (Blueprint $table) {
            //

            $table->Text('about_heading');
            $table->Text('about_sub_heading');
            $table->Text('about_para');
            $table->longText('about_images');
            $table->Text('button_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('velocity_meta_data', function (Blueprint $table) {
            //
        });
    }
};
