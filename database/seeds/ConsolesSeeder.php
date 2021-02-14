<?php

use App\Country;
use App\Console;
use App\Manufacturer;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ConsolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Drop the table
        DB::table('manufacturers')->delete();
        DB::table('consoles')->delete();
        // Seed the table
        // File consoles.json is stored in ./database/data/consoles
        $jsonFile = File::get('database/data/consoles/consoles.json');
        $jsonData = json_decode($jsonFile);
		
        foreach ($jsonData as $data)
        {
            $ma_company = $data->ma_company;
            $ma_country = $data->ma_country;
            $co_type = $data->co_type;
            $co_generation = (filled($data->co_generation) ? $data->co_generation : null);
            $co_name = $data->co_name;
            $co_released_on = (filled($data->co_released_on) ? $data->co_released_on : null);
            
            // Manufacturer: check and creation...
            $country = Country::where('cca3', $ma_country)->first();
            $manufacturer = Manufacturer::firstOrCreate(
                [
                    'company' => $ma_company
                ],
                [
                    'country_uuid' => $country->uuid
                ]);
            // Manufacturer: created!
            
            // Console: creation...
            Console::create([
                'manufacturer_uuid' => $manufacturer->uuid,
                'type'              => $co_type,
                'generation'        => $co_generation,
                'name'              => $co_name,
                'released_on'       => $co_released_on
            ]);
            // Console: created!
        }
    }
}