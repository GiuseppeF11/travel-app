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
                'file_path' => 'https://quieventi.it/wp-content/uploads/2023/09/qui-eventi-regioni-d-europa-roma-eterna-1.jpg',
            ],
            [
                'travel_id' => 1, // Viaggio a Roma
                'file_path' => 'https://tourismmedia.italia.it/is/image/mitur/1600X1000_storia_e_curiosita_su_roma_1-1?wid=800&hei=500&fit=constrain,1&fmt=webp',
            ],
            [
                'travel_id' => 1, // Viaggio a Roma
                'file_path' => 'https://www.ilcorrieredelgiorno.it/wp-content/uploads/2023/01/CdG-colosseo-tricolore.jpg',
            ],
            [
                'travel_id' => 2, // Escursione nelle Dolomiti
                'file_path' => 'https://images.lonelyplanetitalia.it/static/places/dolomiti-4680.jpg?q=90&p=2400%7C1350%7Cmax&s=861d0159260ed39666265ae8a61eb3a0',
            ],
            [
                'travel_id' => 2, // Escursione nelle Dolomiti
                'file_path' => 'https://www.gedistatic.it/content/gedi/img/huffingtonpost/2020/07/01/180049005-3f7cc25e-2cbe-4775-b7ca-3fd89f1b7e23.jpeg',
            ],
            [
                'travel_id' => 2, // Escursione nelle Dolomiti
                'file_path' => 'https://static2-viaggi.corriereobjects.it/wp-content/uploads/2015/06/dolomiti.jpg?v=1696346714',
            ],
            [
                'travel_id' => 3, // Vacanza al mare in Sardegna
                'file_path' => 'https://www.estateinsardegna.it/wp-content/uploads/2024/01/la-pelosa-stintino3.jpeg.webp',
            ],
            [
                'travel_id' => 3, // Vacanza al mare in Sardegna
                'file_path' => 'https://content.skyscnr.com/m/46d2bafcbe21ca44/original/Cala-Goloritze-Sardegna-GettyImages-894583274.jpg',
            ],
            [
                'travel_id' => 3, // Vacanza al mare in Sardegna
                'file_path' => 'https://www.italia.it/content/dam/tdh/it/interests/sardegna/paesaggi-di-sardegna/media/1600X1000_sardegna_paesaggi_hero.jpg',
            ],
        ];

        foreach ($photos as $photo) {
            Photo::create($photo);
        }
    }
}
