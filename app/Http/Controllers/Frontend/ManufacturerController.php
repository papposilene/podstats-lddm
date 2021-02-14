<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Console;
use App\Country;
use App\Game;
use App\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
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
            $manufacturers = Manufacturer::where('country_uuid', $country->uuid)
                ->orderBy('company', 'asc')
                ->paginate(30);
        }
        elseif($request->filled('q'))
        {
            $query = $request->input('q');
            $manufacturers = Manufacturer::search($query)
                ->orderBy('company', 'asc')
                ->paginate(30);
        }
        else
        {
            $manufacturers = Manufacturer::has('hasConsoles')->orderBy('company', 'asc')
                ->paginate(30);
        }
        
        $totalConsoles = Console::count();
        $totalGames = Game::count();
        $totalManufacturers = Manufacturer::count();
        return view('public.manufacturer.index',
            compact(
                'manufacturers',
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
        $manufacturer = Manufacturer::findOrFail($uuid);
        $totalGames = 0;
        foreach($manufacturer->hasConsoles as $console)
        {
            $totalGames += count($console->hasGames);
        }
        return view('public.manufacturer.show',
            compact(
                'manufacturer',
                'totalGames'
            )
        );
    }
}
