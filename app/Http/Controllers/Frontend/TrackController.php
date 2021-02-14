<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Contact;
use App\EpisodeHasTrack;
use App\Game;
use App\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
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
            $tracks = Track::search($query)
                ->orderBy('title', 'asc')
                ->paginate(30);
        }
        else
        {
            $tracks = Track::orderBy('title', 'asc')
                ->paginate(30);
        }
        
        $totalContacts = Contact::count();
        $totalGames = Game::count();
        $totalTracks = Track::count();
        
        return view('public.track.index',
            compact(
                'tracks',
                'totalContacts',
                'totalGames',
                'totalTracks'
            )
        );
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function types($type)
    {
        $type = $type;
        $tracks = EpisodeHasTrack::where('track_type', $type)
            ->paginate(30);
        
        $totalContacts = Contact::count();
        $totalGames = Game::count();
        $totalTracks = Track::count();
        
        return view('public.track.type',
            compact(
                'type',
                'tracks',
                'totalContacts',
                'totalGames',
                'totalTracks'
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
        $track = Track::findOrFail($uuid);
        
        return view('public.track.show',
            compact(
                'track'
            )
        );
    }
}
