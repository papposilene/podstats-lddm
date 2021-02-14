<?php

use App\Country;
use App\Studio;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StudiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Drop the table
        DB::table('studios')->delete();
        // Seed the table
        // File studios.json is stored in ./database/data/studios
        $jsonFile = File::get('database/data/studios/studios.json');
        $jsonData = json_decode($jsonFile);
		
        foreach ($jsonData as $data)
        {
            $st_studio = $data->st_studio;
            $st_country = $data->st_country;
            $country = Country::where('cca3', $st_country)->first();
            
            // Studio: creation...
            Studio::create([
                'studio' => $st_studio,
                'country_uuid' => $country->uuid
            ]);
            // Studio: created!
        }
    }
}