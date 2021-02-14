<?php

namespace App\Http\Controllers;

use App\Console;
use App\Contact;
use App\Episode;
use App\Game;
use App\Genre;
use App\ItemHasDetail;
use App\Manufacturer;
use App\Podcast;
use App\Profession;
use App\Studio;
use App\Track;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $podcasts = Podcast::all();
        return view('public.index',
            compact(
                'podcasts'
            )
        );
    }
    
    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function api()
    {
        return view('public.api');
    }
    
    /**
     * Show the about page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about()
    {
        $consoles = Console::all();
        $contacts = Contact::all();
        $episodes = Episode::all();
        $games = Game::all();
        $genres = Genre::all();
        $manufacturers = Manufacturer::all();
        $podcasts = Podcast::all();
        $professions = Profession::all();
        $sources = ItemHasDetail::all();
        $studios = Studio::all();
        $tracks = Track::all();

        return view('public.about',
            compact(
                'consoles',
                'contacts',
                'episodes',
                'games',
                'genres',
                'manufacturers',
                'podcasts',
                'professions',
                'sources',
                'studios',
                'tracks'
            )
        );
    }
}
