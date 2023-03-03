<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTacosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tacos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num_homologation');
            $table->string('marque');
            $table->string('type');
            $table->string('num_serie');
            $table->date('date_validation');
            $table->date('date_expiration');
            $table->foreignId('vehicle_id')->constrained();
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
        Schema::dropIfExists('tacos');
    }
}
