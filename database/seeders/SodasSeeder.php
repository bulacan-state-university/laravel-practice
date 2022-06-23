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
                'color' => 'Dark Brown'
            ],
            [
                'name' => 'Pepsi',
                'color' => 'Blue'
            ]
        ]);
    }
}
