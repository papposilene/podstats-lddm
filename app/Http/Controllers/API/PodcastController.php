<?php

namespace App\Http\Controllers\API;

use App\Podcast;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PodcastController extends Controller
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
        $result = Podcast::where('name', 'LIKE', '%'. $search. '%')->get();
        return response()->json($result);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json()
    {
        $result = Podcast::all();
        return response()->json($result);
    }
}