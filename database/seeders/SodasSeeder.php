<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SodasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sodas')->truncate();
        DB::table('sodas')->insert([
            [
                'name' => 'Coke',
                'flavor' => 'Dark Brown'
            ],
            [
                'name' => 'Pepsi',
                'flavor' => 'Blue'
            ]
        ]);
    }
}
