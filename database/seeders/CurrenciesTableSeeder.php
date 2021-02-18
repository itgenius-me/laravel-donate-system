<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('currencies')->insert([
            'currency' => "BRL",
            'type' => 1,
        ]);
        DB::table('currencies')->insert([
            'currency' => "NGN",
            'type' => 1,
        ]);
        DB::table('currencies')->insert([
            'currency' => "TRX",
            'type' => 2,
        ]);
        DB::table('currencies')->insert([
            'currency' => "XRP",
            'type' => 2,
        ]);
    }
}
