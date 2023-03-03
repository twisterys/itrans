<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssuranceMarchandisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assurance_marchandises', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->date('date')->nullable();
            $table->date('expiration')->nullable();
            $table->string('assureur')->nullable();
            $table->string('police')->nullable();
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
        Schema::dropIfExists('assurance_marchandises');
    }
}
