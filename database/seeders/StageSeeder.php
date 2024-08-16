<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stage;
use App\Models\Travel;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Prendi alcuni viaggi esistenti
        $travels = Travel::take(3)->get();

        foreach ($travels as $travel) {
            // Definisci un array di tappe per ogni viaggio
            $stages = [
                [
                    'stage_start_date' => $travel->start_date->addDays(0),
                    'stage_end_date' => $travel->start_date->addDays(1),
                    'start_time' => '09:00:00',
                    'end_time' => '12:00:00',
                    'title' => 'Prima Tappa - ' . $travel->title,
                    'description' => 'Questa è la descrizione della prima tappa del viaggio: ' . $travel->title,
                ],
                [
                    'stage_start_date' => $travel->start_date->addDays(1),
                    'stage_end_date' => $travel->start_date->addDays(2),
                    'start_time' => '14:00:00',
                    'end_time' => '17:00:00',
                    'title' => 'Seconda Tappa - ' . $travel->title,
                    'description' => 'Questa è la descrizione della seconda tappa del viaggio: ' . $travel->title,
                ],
                [
                    'stage_start_date' => $travel->start_date->addDays(2),
                    'stage_end_date' => $travel->end_date,
                    'start_time' => '10:00:00',
                    'end_time' => '15:00:00',
                    'title' => 'Terza Tappa - ' . $travel->title,
                    'description' => 'Questa è la descrizione della terza tappa del viaggio: ' . $travel->title,
                ],
            ];

            // Seed delle tappe usando un ciclo for
            foreach ($stages as $stage) {
                Stage::create([
                    'travel_id' => $travel->id,
                    'stage_start_date' => $stage['stage_start_date'],
                    'stage_end_date' => $stage['stage_end_date'],
                    'start_time' => $stage['start_time'],
                    'end_time' => $stage['end_time'],
                    'title' => $stage['title'],
                    'description' => $stage['description'],
                ]);
            }
        }
    }
}
