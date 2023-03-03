<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagasinagePlomosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('magasinage_plomos'))
        {
            echo "Table magasinage plomos deja existe".PHP_EOL ;
        } else {
            Schema::create('magasinage_plomos', function (Blueprint $table) {
                $table->id();
                $table->foreignId('magasinage_id')->constrained();
                $table->foreignId('plomos_id')->constrained();
                $table->string('num_serie');
                $table->timestamps();
            });
        }
    
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magasinage_plomos');
    }
}
