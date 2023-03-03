<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('n_douane');
            $table->unsignedBigInteger('type');
            $table->foreign('type')->references('id')->on('type_clients');
            $table->date('date_prem_relation');
            $table->string('email');
            $table->string('mobile_1');
            $table->string('mobile_2')->nullable();
            $table->text('autre_info')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
