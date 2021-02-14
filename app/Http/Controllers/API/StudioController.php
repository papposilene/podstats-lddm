<?php

namespace App\Http\Controllers\API;

use App\Studio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudioController extends Controller
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
        $result = Studio::where('studio', 'LIKE', '%'. $search. '%')->orderBy('studio', 'asc')->get();
        return response()->json($result);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json()
    {
        $result = Studio::all();
        return response()->json($result);
    }
    
    /**
     * Return a json with continents (lives_at) of manufacturers.
     *
     * @return \Illuminate\Http\Response
     */
    public function continents()
    {
        $continents = array();
        $continents['Africa'] = 0;
        $continents['Americas'] = 0;
        $continents['Antarctic'] = 0;
        $continents['Asia'] = 0;
        $continents['Europe'] = 0;
        $continents['Oceania'] = 0;
        
        $studios = Studio::all();

        foreach($studios as $studio)
        {
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
     * Return a json with info on genres of video games.
     *
     * @return \Illuminate\Http\Response
     */
    public function genres($uuid = 'all', Request $request)
    {
        $genres = array();
        
        if($uuid === 'all')
        {
            $studios = Studio::all();
            
            // Retrieve data for all episodes
            foreach($studios as $studio)
            {            
                foreach($studio->hasGames as $games)
                {
                    foreach($games->hasGenres as $g_hg)
                    {
                        if (!array_key_exists($g_hg->genre, $genres))
                        {
                            $genres[$g_hg->genre] = 0;
                        }
                        (int) $genres[$g_hg->genre]++;
                    }
                }
            }
        }
        elseif ($uuid)
        {
            $studio = Studio::findOrFail($uuid);
            
            $data['uuid'] = $studio->uuid;
            $data['name'] = $studio->studio;
            $data['country'] = $studio->locatedAt->name_eng_common;
        
            foreach($studio->hasGames as $games)
            {
                foreach($games->hasGenres as $g_hg)
                {
                    if (!array_key_exists($g_hg->genre, $genres))
                    {
                        $genres[$g_hg->genre] = 0;
                    }
                    (int) $genres[$g_hg->genre]++;
                }
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
     * Display a listing in a GEOJson format.
     *
     * @return \Illuminate\Http\Response
     */
    public function geojson()
    {
        $studios = Studio::all();
        $original_data = json_decode($studios, true);
        $features = array();

        foreach($original_data as $key => $value) {
            $features[] = array(
                'type' => 'Feature',
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array(
                        (float) $value['country']['lat'],
                        (float) $value['country']['lng']
                    )
                ),
                'properties' => array(
                    'studio' => $value['studio'],
                    'games' => $value['games'],
                    'region' => $value['country']['region'],
                    'subregion' => $value['country']['subregion'],
                    'cca2' => $value['country']['cca2'],
                    'cca3' => $value['country']['cca3'],
                    'name_common' => $value['country']['name_common'],
                    'name_official' => $value['country']['name_official'],
                    'flag' => $value['country']['flag'],
                ),
            );
        };   

        $allfeatures = array('type' => 'FeatureCollection', 'features' => $features);
        return json_encode($allfeatures, JSON_PRETTY_PRINT);
    }
    
    /**
     * Return a json with info on modes of video games.
     *
     * @return \Illuminate\Http\Response
     */
    public function modes($uuid = 'all')
    {
        $modes = array();
        
        if($uuid === 'all')
        {
            $studios = Studio::all();
            
            // Retrieve data for all episodes
            foreach($studios as $studio)
            {            
                foreach($studio->hasGames as $game)
                {
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
            }
        }
        elseif ($uuid)
        {
            $studio = Studio::findOrFail($uuid);
            
            $data['uuid'] = $studio->uuid;
            $data['name'] = $studio->studio;
            $data['country'] = $studio->locatedAt->name_eng_common;
        
            foreach($studio->hasGames as $game)
            {
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