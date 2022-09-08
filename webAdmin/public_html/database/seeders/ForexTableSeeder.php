<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ForexTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $j = 1;
        for ($i = 0; $i < 20; $i++) {

            DB::table('forexes')->insert([
                'symbol' => 'ERUSD_' . $j,
                'type' => 'forex_type_' . $j,
                'tp' => '123.1' . $j,
                'sl' => '123.1' . $j,
                'lot' => '123.1' . $j,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $j++;
        }
    }
}
