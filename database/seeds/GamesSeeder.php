<?php

use App\Game;
use App\Studio;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Drop the table
        DB::table('games')->delete();
        // Seed the table
        // File games.json is stored in ./database/data/games
        $jsonFile = File::get('database/data/studios/games.json');
        $jsonData = json_decode($jsonFile);
		
        foreach ($jsonData as $data)
        {
            $st_studio = $data->st_studio;
            $ga_released_on = $data->ga_released_on;
            $ga_title = $data->ga_title;
            
            // Game: creation...
            $game = Game::create([
                'studio' => $st_studio,
                'countr_uuid' => $country->uuid
            ]);
            // Game: created!
			
			// GameHasConsoles: creation...
            GameHasConsoles::create([
                'game_uuid' => $game->uuid,
                'console_uuid' => $console->uuid
            ]);
            // GameHasConsoles: created!
        }
    }
}