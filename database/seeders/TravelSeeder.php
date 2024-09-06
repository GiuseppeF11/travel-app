<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Travel;
use Illuminate\Support\Facades\DB;

class TravelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $travels = [
            [
                'user_id' => 1,
                'title' => 'Viaggio a Roma',
                'start_date' => '2024-08-01',
                'end_date' => '2024-08-07',
                'location' => 'Roma, Italia',
                'description' => 'Un viaggio storico alla scoperta dell\'antica Roma e delle sue meraviglie.',
                'img_file' => 'https://cdn-imgix.headout.com/microbrands-content-image/image/8434f824dff2a1f05b0b91e0c09c83da-AdobeStock_119146497.jpg?auto=format&w=814.9333333333333&h=458.4&q=90&ar=16%3A9&crop=faces',
            ],
            [
                'user_id' => 1,
                'title' => 'Escursione nelle Dolomiti',
                'start_date' => '2024-09-15',
                'end_date' => '2024-09-22',
                'location' => 'Dolomiti, Italia',
                'description' => 'Una settimana di escursioni e relax tra le montagne più belle del mondo.',
                'img_file' => 'https://static2-viaggi.corriereobjects.it/wp-content/uploads/2015/06/dolomiti.jpg?v=1696346714',
            ],
            [
                'user_id' => 2,
                'title' => 'Vacanza al mare in Sardegna',
                'start_date' => '2024-07-10',
                'end_date' => '2024-07-20',
                'location' => 'Sardegna, Italia',
                'description' => 'Spiagge incantevoli e mare cristallino per un\'esperienza indimenticabile.',
                'img_file' => 'https://www.cagliarimag.com/wp-content/uploads/2023/07/mare-sardegna.jpg',
            ],
        ];

        foreach ($travels as $travel) {
            Travel::create($travel);
        }
    }
}
