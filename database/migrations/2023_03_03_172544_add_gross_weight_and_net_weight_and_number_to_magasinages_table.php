<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGrossWeightAndNetWeightAndNumberToMagasinagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('magasinages', function (Blueprint $table) {
            $table->decimal('gross_weight')->nullable();
            $table->decimal('net_weight')->nullable();
            $table->integer('number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('magasinages', function (Blueprint $table) {
            $table->dropColumn('gross_weight');
            $table->dropColumn('net_weight');
            $table->dropColumn('number');
        });
    }
}
