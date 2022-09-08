<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('1234'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
