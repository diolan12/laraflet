<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Multi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('multis')->insert([
            [
                'name' => 'JF01',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'name' => 'JF22',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ]
        ]);
    }
}