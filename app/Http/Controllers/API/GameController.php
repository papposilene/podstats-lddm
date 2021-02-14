<?php

namespace App\Http\Controllers\API;

use App\Episode;
use App\Game;
use App\GameHasGenre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GameController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        $search = $request->get('q');
        $result = Game::where('title', 'LIKE', '%'. $search. '%')->get();
        return response()->json($result);
    }
    
    /**
     * Return a json with info on genres of video games.
     *
     * @return \Illuminate\Http\Response
     */
    public function genres($uuid = 'all', Request $request)
    {
        $genres = array();
        $season = (int) $request->get('season');
        
        if($uuid === 'all')
        {
            // Retrieve informations for a specified season
            if ($season && $season !== 0)
            {
                $data['season'] = $season;
                $episodes = Episode::where('season', $season)->get();
                foreach($episodes as $episode)
                {
                    foreach($episode->hasTracklist as $track)
                    {
                        // Retrieve data for all episodes
                        foreach($track->hasGame->hasGenres as $genre)
                        {                
                            if (!array_key_exists($genre->genre, $genres))
                            {
                                $genres[$genre->genre] = 0;
                            }
                            (int) $genres[$genre->genre]++;
                        }
                    }
                }
            }
            else
            {
                $games = GameHasGenre::all();
                
                // Retrieve data for all episodes
                foreach($games as $game)
                {                
                    if (!array_key_exists($game->hasGenre->genre, $genres))
                    {
                        $genres[$game->hasGenre->genre] = 0;
                    }
                    (int) $genres[$game->hasGenre->genre]++;
                }
            }
        }
        elseif ($uuid)
        {
            $game = Game::findOrFail($uuid);
            
            $data['uuid'] = $game->uuid;
            $data['name'] = $game->title;
            $data['studio_uuid'] = $game->studio_uuid;
            $data['studio_name'] = $game->createdBy->studio;
            $data['studio_country'] = $game->createdBy->locatedAt->name_eng_common;
        
            foreach($game->hasGenres as $g_hg)
            {
                if (!array_key_exists($g_hg->genre, $genres))
                {
                    $genres[$g_hg->genre] = 0;
                }
                (int) $genres[$g_hg->genre]++;
            }
        }
        else
        {
            abort(404);
        }
        
        arsort($genres);
        
        $count = $request->get('count');
        if ((int) $count)
        {
            $genres = array_slice($genres, 0, $count);
        }
        
        $data['chart']['labels'] = array_keys($genres);
        $data['chart']['data'] = array_values($genres);
        
        $result = $data;
        
        return response()->json($result);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json()
    {
        $result = Game::all();
        return response()->json($result);
    }
    
    /**
     * Return a json with info on modes of video games.
     *
     * @return \Illuminate\Http\Response
     */
    public function modes($uuid = 'all', Request $request)
    {
        $modes = array();
        $modes['Single'] = 0;
        $modes['Multi'] = 0;
        $modes['Cooperative'] = 0;
        $modes['Unknown'] = 0;
        
        $season = (int) $request->get('season');
        
        if($uuid === 'all')
        {
            // Retrieve informations for a specified season
            if ($season && $season !== 0)
            {
                $data['season'] = $season;
                $episodes = Episode::where('season', $season)->get();
                foreach($episodes as $episode)
                {
                    foreach($episode->hasTracklist as $track)
                    {
                        $modes_json = json_decode($track->hasGame->mode, true);
                        if($modes_json)
                        {
                            foreach($modes_json as $mode)
                            {
                                if (!array_key_exists(ucfirst($mode), $modes))
                                {
                                    $modes[ucfirst($mode)] = 0;
                                }
                               (int) $modes[ucfirst($mode)]++;
                            }
                        }
                        else
                        {
                            (int) $modes['Unknown']++;
                        }
                    }
                }
            }
            else
            {
                $games = Game::all();
                foreach($games as $game)
                {
                    $modes_json = json_decode($game->mode, true);
                    if($modes_json)
                    {
                    foreach($modes_json as $mode)
                        {
                            if (!array_key_exists(ucfirst($mode), $modes))
                            {
                                $modes[ucfirst($mode)] = 0;
                            }
                            (int) $modes[ucfirst($mode)]++;
                        }
                    }
                    else
                    {
                        (int) $modes['Unknown']++;
                    }
                }
            }
        }
        elseif ($uuid)
        {
            $game = Game::findOrFail($uuid);
            
            $data['uuid'] = $game->uuid;
            $data['title'] = $game->title;
            $data['studio_uuid'] = $game->createdBy->uuid;
            $data['studio_name'] = $game->createdBy->studio;
            $data['studio_country'] = $game->createdBy->locatedAt->name_eng_common;
        
            $modes_json = json_decode($game->mode, true);
            foreach($modes_json as $mode)
            {
                if (!array_key_exists($mode, $modes))
                {
                    $modes[$mode] = 0;
                }
                (int) $modes[$mode]++;
            }
        }
        else
        {
            abort(404);
        }
        
        arsort($modes);
        
        $data['chart']['labels'] = array_keys($modes);
        $data['chart']['data'] = array_values($modes);
        
        $result = $data;
        
        return response()->json($result);
    }

}