<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@mail.com',
            'user_name' => 'user@mail.com',
            'password' => Hash::make('1234'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
