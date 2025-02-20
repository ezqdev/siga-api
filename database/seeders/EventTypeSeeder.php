<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('event_types')->insert(
            [
                'name' => 'Tipo de evento 1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('event_types')->insert(
            [
                'name' => 'Tipo de evento 2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('event_types')->insert(
            [
                'name' => 'Tipo de evento 3',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

    }
}
