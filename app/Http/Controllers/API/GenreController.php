<?php

namespace App\Http\Controllers\API;

use App\Genre;
use App\GameHasGenre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenreController extends Controller
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
        $result = Genre::where('genre', 'LIKE', '%'. $search. '%')->orderBy('genre', 'asc')->get();
        return response()->json($result);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json()
    {
        $result = Genre::all();
        return response()->json($result);
    }
    
    /**
     * Return a json with continents (lives_at) of contacts.
     *
     * @return \Illuminate\Http\Response
     */
    public function continents($uuid)
    {
        $continents = array();
        $continents['Africa'] = 0;
        $continents['Americas'] = 0;
        $continents['Antarctic'] = 0;
        $continents['Asia'] = 0;
        $continents['Europe'] = 0;
        $continents['Oceania'] = 0;
    
        $genre = Genre::findOrFail($uuid);
        $games = GameHasGenre::where('genre_uuid', $genre->uuid)->get();

        $data['uuid'] = $genre->uuid;
        $data['genre'] = $genre->genre;
        
        foreach($games as $game)
        {
            $studio = $game->hasGame->createdBy;
            if ($studio->locatedAt)
            {
                (int) $continents[$studio->locatedAt->region]++;
            }
            else
            {
                if (!array_key_exists('Unknown', $continents))
                {
                    $continents['Unknown'] = 0;
                }
                (int) $continents['Unknown']++;
            }
        }
        
        $data['chart']['labels'] = array_keys($continents);
        $data['chart']['data'] = array_values($continents);
        
        $result = $data;
        
        return response()->json($result);
    }
    
    /**
     * Return a json with info on modes of video games.
     *
     * @return \Illuminate\Http\Response
     */
    public function modes($uuid)
    {
        $modes = array();
        $modes['Single'] = 0;
        $modes['Multi'] = 0;
        $modes['Cooperative'] = 0;
        $modes['Unknown'] = 0;

        $genre = Genre::findOrFail($uuid);
        $games = GameHasGenre::where('genre_uuid', $genre->uuid)->get();

        $data['uuid'] = $genre->uuid;
        $data['genre'] = $genre->genre;

        foreach($games as $game)
        {
            $modes_json = json_decode($game->hasGame->mode, true);
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
        
        arsort($modes);
        
        $data['chart']['labels'] = array_keys($modes);
        $data['chart']['data'] = array_values($modes);
        
        $result = $data;
        
        return response()->json($result);
    }

}