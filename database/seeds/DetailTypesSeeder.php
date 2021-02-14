<?php

use App\DetailHasType;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DetailTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Drop the table
        DB::table('detail_has_types')->delete();
        // Seed the table
        // File details_types.json is stored in ./database/data/contacts
        $jsonFile = File::get('database/data/contacts/details_types.json');
        $jsonData = json_decode($jsonFile);
		
        foreach ($jsonData as $data)
        {
            // Type: creation...
            DetailHasType::create([
                'type'          => strtolower($data->type),
                'icon'          => strtolower($data->icon)
            ]);
            // Type: created!
        }
    }
}
