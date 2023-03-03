<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransitairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transitaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom',30);
            $table->string('ice',30)->nullable();
            $table->string('numero',30)->nullable();
            $table->string('email',30)->nullable();
            $table->string('adress',40)->nullable();
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
        Schema::dropIfExists('transitaires');
    }
}
