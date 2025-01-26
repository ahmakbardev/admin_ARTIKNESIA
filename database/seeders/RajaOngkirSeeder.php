<?php

namespace Database\Seeders;

use App\Models\MasterCity;
use App\Models\MasterProvince;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class RajaOngkirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apiKey = '2f187fd20546b492f85a0654595a89d4';
        $baseUrl = 'https://api.rajaongkir.com/starter';

        // Fetch provinces with retry logic
        $provinceResponse = Http::withHeaders(['key' => $apiKey])
            ->retry(3, 1000) // Retry 3 times with 1000ms (1 second) delay
            ->get("$baseUrl/province");

        if ($provinceResponse->failed()) {
            $this->command->error('Failed to fetch provinces. Exiting...');
            return;
        }

        $provinces = $provinceResponse->json()['rajaongkir']['results'];

        foreach ($provinces as $provinceData) {
            $province = MasterProvince::firstOrCreate(
                ['id' => $provinceData['province_id']],
                ['name' => $provinceData['province']]
            );

            // Fetch cities for this province with retry logic
            $cityResponse = Http::withHeaders(['key' => $apiKey])
                ->retry(3, 1000) // Retry 3 times with 1000ms delay
                ->get("$baseUrl/city", [
                    'province' => $province->id,
                ]);

            if ($cityResponse->failed()) {
                $this->command->warn("Failed to fetch cities for province ID {$province->id}. Skipping...");
                continue;
            }

            $cities = $cityResponse->json()['rajaongkir']['results'];

            foreach ($cities as $cityData) {
                MasterCity::firstOrCreate(
                    ['id' => $cityData['city_id']],
                    [
                        'name' => $cityData['city_name'],
                        'province_id' => $province->id,
                    ]
                );
            }
        }

        $this->command->info('Provinces and cities have been seeded successfully!');
    }
}
