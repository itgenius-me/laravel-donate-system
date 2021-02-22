<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePercentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('percent', function (Blueprint $table) {
            $table->id();
            $table->string('percent', 100);
            $table->integer('order');
            $table->integer('value')->default(0)->comment('10% => 0.1, 20% => 0.2, ...');
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
        Schema::dropIfExists('percent');
    }
}
