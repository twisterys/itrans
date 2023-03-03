<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnsFromTechnicalVisits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('technical_visits', function (Blueprint $table) {
            $table->dropColumn('vignette');
            $table->dropColumn('visit_disque');
            $table->dropColumn('date_last_visit');
            $table->string('ref')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('technical_visits', function (Blueprint $table) {
            //
        });
    }
}
