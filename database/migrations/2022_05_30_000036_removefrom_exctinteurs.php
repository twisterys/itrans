<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovefromExctinteurs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exctinteurs', function (Blueprint $table) {
            $table->dropColumn('poids');
            $table->dropColumn('type_extinteur');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exctinteurs', function (Blueprint $table) {
            
        });
    }
}
