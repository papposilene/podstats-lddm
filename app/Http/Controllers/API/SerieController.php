<?php

namespace App\Http\Controllers\API;

use App\Serie;
use App\GameHasSerie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SerieController extends Controller
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
    public function json()
    {
        $result = Serie::all();
        return response()->json($result);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        $i = 0;
        $option = (bool) $request->get('s');
        $search = $request->get('q');
        $series = Serie::where('serie', 'LIKE', '%'. $search. '%')
            ->orderBy('serie', 'asc')->get();
        foreach ($series as $serie)
        {
            foreach ($serie->hasGames as $game)
            {
                if ($option === true && $game->game_uuid)
                {
                    continue;
                }
                
                $result[$i]['uuid'] = $game->uuid;
                $result[$i]['serie'] = $serie->serie . ': ' . $game->game_order . ', ' . $game->game_title;
                $i++;
            }
        }
        return response()->json($result);
    }

}