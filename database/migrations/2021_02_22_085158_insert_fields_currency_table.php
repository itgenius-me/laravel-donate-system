<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertFieldsCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('currencies', function (Blueprint $table) {
            $table->string('continent', 100)->nullable()->comment('Europe')->after('id');
            $table->string('capital', 100)->nullable()->comment('Minsk')->after('id');
            $table->string('population', 100)->nullable()->comment('9685000')->after('id');
            $table->string('country_name', 100)->nullable()->comment('Belarus')->after('id');
            $table->string('country_code', 100)->nullable()->comment('BY')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
