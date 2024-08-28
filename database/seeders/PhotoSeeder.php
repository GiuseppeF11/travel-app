<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Photo;
use App\Models\Travel;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $photos = [
            [
                'travel_id' => 1, // Viaggio a Roma
                'file_path' => 'https://images.pexels.com/photos/2577274/pexels-photo-2577274.jpeg?cs=srgb&dl=pexels-pawan-yadav-1321878-2577274.jpg&fm=jpg',
            ],
            [
                'travel_id' => 1, // Viaggio a Roma
                'file_path' => 'https://images.pexels.com/photos/2577274/pexels-photo-2577274.jpeg?cs=srgb&dl=pexels-pawan-yadav-1321878-2577274.jpg&fm=jpg',
            ],
            [
                'travel_id' => 1, // Viaggio a Roma
                'file_path' => 'https://images.pexels.com/photos/2577274/pexels-photo-2577274.jpeg?cs=srgb&dl=pexels-pawan-yadav-1321878-2577274.jpg&fm=jpg',
            ],
            [
                'travel_id' => 2, // Escursione nelle Dolomiti
                'file_path' => 'https://images.pexels.com/photos/2577274/pexels-photo-2577274.jpeg?cs=srgb&dl=pexels-pawan-yadav-1321878-2577274.jpg&fm=jpg
                ',
            ],
            [
                'travel_id' => 2, // Escursione nelle Dolomiti
                'file_path' => 'https://images.pexels.com/photos/2577274/pexels-photo-2577274.jpeg?cs=srgb&dl=pexels-pawan-yadav-1321878-2577274.jpg&fm=jpg',
            ],
            [
                'travel_id' => 2, // Escursione nelle Dolomiti
                'file_path' => 'https://images.pexels.com/photos/2577274/pexels-photo-2577274.jpeg?cs=srgb&dl=pexels-pawan-yadav-1321878-2577274.jpg&fm=jpg',
            ],
            [
                'travel_id' => 3, // Vacanza al mare in Sardegna
                'file_path' => 'https://images.pexels.com/photos/2577274/pexels-photo-2577274.jpeg?cs=srgb&dl=pexels-pawan-yadav-1321878-2577274.jpg&fm=jpg',
            ],
            [
                'travel_id' => 3, // Vacanza al mare in Sardegna
                'file_path' => 'https://images.pexels.com/photos/2577274/pexels-photo-2577274.jpeg?cs=srgb&dl=pexels-pawan-yadav-1321878-2577274.jpg&fm=jpg',
            ],
            [
                'travel_id' => 3, // Vacanza al mare in Sardegna
                'file_path' => 'https://images.pexels.com/photos/2577274/pexels-photo-2577274.jpeg?cs=srgb&dl=pexels-pawan-yadav-1321878-2577274.jpg&fm=jpg',
            ],
        ];

        foreach ($photos as $photo) {
            Photo::create($photo);
        }
    }
}
