<?php

namespace App\Http\Controllers\API;

use App\Manufacturer;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManufacturerController extends Controller
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
        $result = Manufacturer::where('company', 'LIKE', '%'. $search. '%')->orderBy('company', 'asc')->get();
        return response()->json($result);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json()
    {
        $result = Manufacturer::all();
        return response()->json($result);
    }
    
    /**
     * Display a listing in a GEOJson format.
     *
     * @return \Illuminate\Http\Response
     */
    public function geojson()
    {
        $manufacturers = Manufacturer::all();
        $original_data = json_decode($manufacturers, true);
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
                    'company' => $value['company'],
                    'consoles' => $value['consoles'],
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
     * Return a json with info on consoles.
     *
     * @return \Illuminate\Http\Response
     */
    public function consoles($uuid = 'all')
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
            $manufacturers = Manufacturer::all();
            
            // Retrieve data for all episodes
            foreach($manufacturers as $manufacturer)
            {            
                foreach($manufacturer->hasConsoles as $console)
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
        }
        elseif ($uuid)
        {
            $manufacturer = Manufacturer::findOrFail($uuid);
            
            $data['uuid'] = $manufacturer->uuid;
            $data['company'] = $manufacturer->company;
            $data['country'] = $manufacturer->locatedAt->name_eng_common;
        
            foreach($manufacturer->hasConsoles as $console)
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
        else
        {
            abort(404);
        }
        
        $data['chart']['labels'] = array_keys($types);
        $data['chart']['data'] = array_values($types);
        
        $result = $data;
        
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
        
        $manufacturers = Manufacturer::all();

        foreach($manufacturers as $manufacturer)
        {
            if ($manufacturer->locatedAt)
            {
                (int) $continents[$manufacturer->locatedAt->region]++;
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
    
}