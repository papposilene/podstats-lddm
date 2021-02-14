<?php

namespace App\Http\Controllers\API;

use App\Console;
use App\GameHasConsole;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsoleController extends Controller
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
        $result = Console::where('name', 'LIKE', '%'. $search. '%')->orderBy('name', 'asc')->get();
        return response()->json($result);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json()
    {
        $result = Console::all();
        return response()->json($result);
    }

    /**
     * Return a json with stats on consoles.
     *
     * @return \Illuminate\Http\Response
     */
    public function consoles(Request $request)
    {
        $stats = array();
        $consoles = GameHasConsole::all();
        
        foreach($consoles as $console)
        {
            if (!array_key_exists($console->hasConsole->name, $stats))
            {
                $stats[$console->hasConsole->name] = 0;
            }
            (int) $stats[$console->hasConsole->name]++;
        }
        
        arsort($stats);
        
        $count = $request->get('count');
        if ((int) $count)
        {
            $stats = array_slice($stats, 0, $count);
        }
        
        $data['chart']['labels'] = array_keys($stats);
        $data['chart']['data'] = array_values($stats);
        
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
            $consoles = Console::all();
            
            // Retrieve data for all episodes
            foreach($consoles as $console)
            {            
                foreach($console->hasGames as $games)
                {
                    foreach($games->hasGenres as $g_hg)
                    {
                        if (!array_key_exists($g_hg->hasGenre->genre, $genres))
                        {
                            $genres[$g_hg->hasGenre->genre] = 0;
                        }
                        (int) $genres[$g_hg->hasGenre->genre]++;
                    }
                }
            }
        }
        elseif ($uuid)
        {
            $console = Console::findOrFail($uuid);
            
            $data['uuid'] = $console->uuid;
            $data['name'] = $console->name;
            $data['company_uuid'] = $console->byManufacturer->uuid;
            $data['company_name'] = $console->byManufacturer->company;
            $data['company_country'] = $console->byManufacturer->locatedAt->name_eng_common;
        
            foreach($console->hasGames as $games)
            {
                foreach($games->hasGenres as $g_hg)
                {
                    if (!array_key_exists($g_hg->hasGenre->genre, $genres))
                    {
                        $genres[$g_hg->hasGenre->genre] = 0;
                    }
                    (int) $genres[$g_hg->hasGenre->genre]++;
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
     * Return a json with info on consoles.
     *
     * @return \Illuminate\Http\Response
     */
    public function types($uuid = 'all')
    {
        $types = array();
        $types['Arcade'] = 0;
        $types['Handheld'] = 0;
        $types['Home'] = 0;
        $types['Micro'] = 0;
        $types['Computer'] = 0;
        $types['Hybrid'] = 0;
        
        if($uuid === 'all')
        {
            $consoles = Console::all();
            foreach($consoles as $console)
            {
                if ($console->type)
                {
                    (int) $types[ucfirst($console->type)]++;
                }
                else
                {
                    if (!array_key_exists('Unknown', $types))
                    {
                        $types['Unknown'] = 0;
                    }
                    (int) $types['Unknown']++;
                }
            }
        }
        elseif ($uuid)
        {
            $console = Console::findOrFail($uuid);
            
            $data['uuid'] = $console->uuid;
            $data['name'] = $console->name;
            $data['company_uuid'] = $console->byManufacturer->uuid;
            $data['company_name'] = $console->byManufacturer->company;
            $data['company_country'] = $console->byManufacturer->locatedAt->name_eng_common;
        
            if ($console->type)
            {
                (int) $types[ucfirst($console->type)]++;
            }
            else
            {
                if (!array_key_exists('Unknown', $types))
                {
                    $types['Unknown'] = 0;
                }
                (int) $types['Unknown']++;
            }
        }
        else
        {
            abort(404);
        }
        
        $data['chart']['labels'] = array_keys($types);
        $data['chart']['data'] = array_values($types);
        
        $result = $data;
        
        return response()->json($result);
    }
}