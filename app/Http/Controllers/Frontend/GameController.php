<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Console;
use App\Game;
use App\GameHasSerie;
use App\Studio;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->filled('q'))
        {
            $query = $request->input('q');
            $games = Game::search($query)
                ->orderBy('title', 'asc')
                ->paginate(30);
        }
        else
        {
            $games = Game::orderBy('title', 'asc')
                ->paginate(30);
        }
        
        $totalConsoles = Console::count();
        $totalGames = Game::count();
        $totalStudios = Studio::count();
        
        return view('public.game.index',
            compact(
                'games',
                'totalConsoles',
                'totalGames',
                'totalStudios'
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $game = Game::findOrFail($uuid);
        $series = GameHasSerie::all();
        return view('public.game.show',
            compact(
                'game',
                'series'
            )
        );
    }
}
