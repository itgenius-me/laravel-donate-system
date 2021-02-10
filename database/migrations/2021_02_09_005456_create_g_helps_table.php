<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGHelpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_helps', function (Blueprint $table) {
            $table->id();
            $table->string('email', 191)->comment('email user');
            $table->double('amount')->default(0)->comment('amount of get help');
            $table->double('confirmed_amount')->nullable()->default(0)->comment('confirmed amount received');
            $table->string('type', 191)->comment('type of currency(1: local, 2: cripto)');
            $table->integer('status')->default(0)->comment('status of get help(0: unconfirmed, 1:confirmed)');
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
        Schema::dropIfExists('g_helps');
    }
}
