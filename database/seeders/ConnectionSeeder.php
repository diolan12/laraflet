<?php

namespace Database\Seeders;

use cbschuld\UuidBase58;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConnectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('connections')->insert([
            [
                'uuid' => UuidBase58::id(),
                'from' => 1,
                'to' => 2
            ]
        ]);
    }
    
}
