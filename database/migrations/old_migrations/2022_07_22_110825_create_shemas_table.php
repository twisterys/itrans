<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shemas', function (Blueprint $table) {
            $table->id();
            $table->string('nom',255)->nullable();
            $table->integer('start_from')->nullable();
            $table->string('prefix',255)->nullable();
            $table->string('suffix',255)->nullable();
            $table->string('template',255)->nullable();
            $table->longText('footer')->nullable();
            $table->integer('letterscount')->nullable();
            $table->integer('current')->nullable();
            $table->string('type')->nullable();
            $table->date('date')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('shemas');
    }
}
