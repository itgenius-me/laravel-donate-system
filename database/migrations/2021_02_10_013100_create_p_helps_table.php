<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePHelpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_helps', function (Blueprint $table) {
            $table->id();
            $table->string('email', 191)->comment('email user');
            $table->double('amount')->default(0)->comment('amount of provide help');
            $table->string('type', 191)->comment('type of currency(1: local, 2: cripto)');
            $table->integer('status')->default(0)->comment('status of provide help(0: unconfirmed, 1:confirmed)');
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
        Schema::dropIfExists('p_helps');
    }
}
