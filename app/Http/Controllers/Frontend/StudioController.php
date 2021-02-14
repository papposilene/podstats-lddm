<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Console;
use App\Country;
use App\Game;
use App\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('cca3'))
        {
            $cca3 = $request->input('cca3');
            $country = Country::where('cca3', $cca3)->firstOrFail();
            $studios = Studio::where('country_uuid', $country->uuid)
                ->orderBy('studio', 'asc')
                ->paginate(30);
        }
        elseif($request->filled('q'))
        {
            $query = $request->input('q');
            $studios = Studio::search($query)
                ->orderBy('studio', 'asc')
                ->paginate(30);
        }
        else
        {
            $studios = Studio::has('hasGames')->orderBy('studio', 'asc')
                ->paginate(30);
        }
        
        $totalConsoles = Console::count();
        $totalGames = Game::count();
        $totalStudios = Studio::count();
        
        return view('public.studio.index',
            compact(
                'studios',
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
        $studio = Studio::findOrFail($uuid);
        $games = Game::where('studio_uuid', $studio->uuid)->orderBy('released_on', 'desc')->paginate(30);
        $totalGames = Game::count();
        
        return view('public.studio.show',
            compact(
                'studio',
                'games',
                'totalGames'
            )
        );
    }
}
