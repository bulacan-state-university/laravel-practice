<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
[
    'name' => 'user1 example',
    'email' => 'example@sample.com',
    'email_verified_at' => Carbon::now(),
    'password' => Hash::make('password')
],
[
    'name' => 'user2 example',
    'email' => 'example2@sample.com',
    'email_verified_at' => Carbon::now(),
    'password' => Hash::make('password')
]
        ]);
    }
}
