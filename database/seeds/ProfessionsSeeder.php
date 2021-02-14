<?php

use App\Profession;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProfessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Drop the table
        DB::table('professions')->delete();
        // Seed the table
        // File professions.json is stored in ./database/data/professions
        $jsonFile = File::get('database/data/professions/professions.json');
        $jsonData = json_decode($jsonFile);
        
        foreach ($jsonData as $data)
        {   
            // Profession: creation...
            Profession::create([
                'profession'    => json_decode(json_encode($data->profession, JSON_FORCE_OBJECT), true)
            ]);
            // Profession: created!
        }
    }
}
