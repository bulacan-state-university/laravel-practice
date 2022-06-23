<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SodaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sodas')->truncate();
        DB::table('sodas')->insert([[

            'name' => 'coke',
            'color' => 'red'

        ],
        [

            'name' => 'pepsi',
            'color' => 'blue'

        ]
    ]);
    }
}
