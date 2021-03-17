<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PercentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('percent')->delete();

        \DB::table('percent')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'percent' => '10% First',
                    'order' => 1,
                    'value' => 0.1,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s'),
                ),
            1 =>
                array (
                    'id' => 2,
                    'percent' => '40% First',
                    'order' => 2,
                    'value' => 0.1,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s'),
                ),
            2 =>
                array (
                    'id' => 3,
                    'percent' => '40% Second',
                    'order' => 3,
                    'value' => 0.1,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s'),
                ),
            3 =>
                array (
                    'id' => 4,
                    'percent' => '10% Second(All)',
                    'order' => 4,
                    'value' => 0.1,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s'),
                ),
        ));
    }
}
