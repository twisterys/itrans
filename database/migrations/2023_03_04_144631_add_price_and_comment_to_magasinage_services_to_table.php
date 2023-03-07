<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceAndCommentToMagasinageServicesToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('magasinage_services', function (Blueprint $table) {
            $table->decimal('price');
            $table->string('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('magasinage_services', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('comment');
        });
    }
}
