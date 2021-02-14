<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Console;
use App\Country;
use App\Game;
use App\GameHasConsole;
use App\GameHasGenre;
use App\Manufacturer;
use Illuminate\Http\Request;

class ConsoleController extends Controller
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
            $consoles = Console::where('country_uuid', $country->uuid)
                ->orderBy('name', 'asc')
                ->paginate(30);
        }
        elseif($request->filled('q'))
        {
            $query = $request->input('q');
            $consoles = Console::search($query)
                ->orderBy('name', 'asc')
                ->paginate(30);
        }
        else
        {
            $consoles = Console::has('hasGames')->orderBy('name', 'asc')
                ->paginate(30);
        }
        
        $totalConsoles = Console::count();
        $totalGames = Game::count();
        $totalManufacturers = Manufacturer::count();
        return view('public.console.index',
            compact(
                'consoles',
                'totalConsoles',
                'totalGames',
                'totalManufacturers'
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
        $console = Console::findOrFail($uuid);
        $games = GameHasConsole::where('console_uuid', $console->uuid)->paginate(30);
        
        return view('public.console.show',
            compact(
                'console',
                'games'
            )
        );
    }
}
