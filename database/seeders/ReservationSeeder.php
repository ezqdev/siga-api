<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reservations')->insert(
            [
                'user_id'=> 1,
                'space_id'=> 1,
                'reservation_date' => '2024/10/20',
                'start_date' => '2024/10/20',
                'end_date' => '2024/10/20',
                'start_time' => '8:00:00',
                'end_time' => '9:00:00',
                'status' => 1,
                'uploaded_job'=>'Solcitud_1234',
                'reservation_details' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sollicitudin ultrices condimentum.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('reservations')->insert(
            [
                'user_id'=> 2,
                'space_id'=> 2,
                'reservation_date' => '2024/10/25',
                'start_date' => '2024/10/25',
                'end_date' => '2024/10/28',
                'start_time' => '8:00:00',
                'end_time' => '9:00:00',
                'status' => 'aprobado',
                'uploaded_job'=>'Solcitud_1234',
                'reservation_details' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sollicitudin ultrices condimentum.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
    }
}
