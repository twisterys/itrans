<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenralFraisIdToTypeFrais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('type_frais', function (Blueprint $table) {
            $table->unsignedBigInteger('general_frais_id')->nullable();
            $table->foreign('general_frais_id')->references('id')->on('general_frais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('type_frais', function (Blueprint $table) {
            //
        });
    }
}
