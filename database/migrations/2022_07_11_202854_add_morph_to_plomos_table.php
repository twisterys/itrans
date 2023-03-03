<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMorphToPlomosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plomos', function (Blueprint $table) {
            $table->timestamp('used_at')->nullable();
            $table->string('traiter_de')->nullable();
            $table->string('traiter_a')->nullable();
            $table->boolean('defaillante')->default(0);
            $table->nullableMorphs('havePlomos');
            $table->text('commentaire')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plomos', function (Blueprint $table) {
            $table->dropColumn('used_at');
            $table->dropColumn('traiter_de');
            $table->dropColumn('traiter_a');
            $table->dropColumn('defaillante');
            $table->dropColumn('commentaire');
            $table->dropMorphs('havePlomos');
        });
    }
}
