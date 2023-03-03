<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToPersonalExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personal_expenses', function (Blueprint $table) {
            $table->string('type_frais')->nullable()->change();
            $table->decimal('montant')->nullable()->change();
            $table->string('devise')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personal_expenses', function (Blueprint $table) {
            //
        });
    }
}
