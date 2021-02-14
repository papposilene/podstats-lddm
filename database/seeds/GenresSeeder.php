<?php

use App\Genre;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Drop the table
        DB::table('videogames_genres')->delete();
        // Seed the table
        // File professions.json is stored in ./database/data/games
        $jsonFile = File::get('database/data/games/genres.json');
        $jsonData = json_decode($jsonFile);
        
        foreach ($jsonData as $data)
        {   
            // Genre: creation...
            Genre::create([
                'genre'    => $data->genre
            ]);
            // Genre: created!
        }
    }
}
