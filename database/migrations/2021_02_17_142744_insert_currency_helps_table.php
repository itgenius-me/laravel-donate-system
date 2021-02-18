<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertCurrencyHelpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('g_helps', function (Blueprint $table) {
            $table->string('currency', 100)->nullable()->comment('')->after('amount');
        });
        //
        Schema::table('p_helps', function (Blueprint $table) {
            $table->string('currency', 100)->nullable()->comment('')->after('amount');
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
