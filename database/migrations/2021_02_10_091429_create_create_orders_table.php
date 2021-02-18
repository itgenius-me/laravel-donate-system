<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('create_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('gh_id')->default(0)->comment('id of get help');
            $table->string('gh_email', 191)->comment('email user of get help');

            $table->integer('ph_id')->default(0)->comment('id of provide help');
            $table->string('ph_email', 191)->comment('email user of provide help');
            $table->integer('ph_order_type')->default(0)->comment('1: 10% first, 2: 40% first, 3: 40% second, 4: 10% second');

            $table->string('currency', 191)->comment('BRL, NGN, TRX, XRP, etc');
            $table->double('match_order_amount')->comment('paid amount to get help');
            $table->integer('status')->default(0)->comment('status of order(0: pending, 1:confirmed, 2: reject)');

            $table->string('proof_attachment', 191)->comment('Attached Proof of Payment');
            $table->dateTime('expired_date')->comment('the date that will be expired');
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
        Schema::dropIfExists('create_orders');
    }
}
