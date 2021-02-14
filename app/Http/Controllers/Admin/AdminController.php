<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Activity;
use App\Console;
use App\Contact;
use App\Episode;
use App\Game;
use App\Genre;
use App\ItemHasDetail;
use App\Manufacturer;
use App\Podcast;
use App\Profession;
use App\Serie;
use App\Studio;
use App\Track;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consoles = Console::all();
        $contacts = Contact::all();
        $episodes = Episode::all();
        $games = Game::all();
        $genres = Genre::all();
        $manufacturers = Manufacturer::all();
        $podcasts = Podcast::all();
        $professions = Profession::all();
        $series = Serie::all();
        $sources = ItemHasDetail::all();
        $studios = Studio::all();
        $tracks = Track::all();
        $user = User::findOrFail(Auth::id());
        return view('admin.index',
            compact(
                'consoles',
                'contacts',
                'episodes',
                'games',
                'genres',
                'manufacturers',
                'podcasts',
                'professions',
                'series',
                'sources',
                'studios',
                'tracks',
                'user'
            )
        );
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function activity()
    {
        $activities = Activity::orderByDesc('id')->paginate(21);
        return view('admin.activity', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
