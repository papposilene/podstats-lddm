<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Contact;
use App\ContactHasTrack;
use App\Episode;
use App\EpisodeHasStaff;
use App\EpisodeHasTrack;
use App\ItemHasDetail;
use App\Game;
use App\GameHasStaff;
use App\Podcast;
use App\Studio;
use App\Track;
use App\User;
use App\Imports\TracksImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteTrack;
use App\Http\Requests\StoreTrack;
use App\Http\Requests\UpdateTrack;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class TrackController extends Controller
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
    public function index(Request $request)
    {
        if($request->filled('q'))
        {
            $query = $request->input('q');
            $tracks = Track::search($query)
                ->orderBy('released_on', 'asc')
                ->paginate(25);
        }
        else
        {
            $tracks = Track::orderBy('released_on', 'asc')
                ->paginate(25);
        }
        
        return view('admin.track.admin',
            compact(
                'tracks'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrack $request)
    {
        $validated = $request->validated();
        
        $track = new Track;
        $track->title = $request->input('track_title');
        $track->released_on = (!empty($request->input('track_date')) ? $request->input('track_date') : null);
        $track->duration = (!empty($request->input('track_duration')) ? $request->input('track_duration') : null);
        $track->mbid = (!empty($request->input('track_mbid')) ? $request->input('track_mbid') : null);
        $track->save();
		
		// Create the artist if not already in the database
		if($request->input('contact_uname') && empty($request->input('contact_uuid')))
        {
            $contact = new Contact;
            $contact->uname         = $request->input('contact_uname');
            $contact->save();
        }
        else
        {
            $contact = Contact::findOrFail($request->input('contact_uuid'));
        }
        
        // Create the relationship between the artist and the track
        $author_has_track = new ContactHasTrack;
        $author_has_track->contact_uuid = $contact->uuid;
        $author_has_track->track_uuid   = $track->uuid;
        $author_has_track->save();
        
        // Create the studio if not already in the database
		if($request->input('studio_name') && empty($request->input('studio_uuid')))
        {
            $studio = new Studio;
            $studio->studio        = $request->input('studio_name');
            $studio->save();
        }
        else
        {
            $studio = Studio::findOrFail($request->input('studio_uuid'));
        }
		
		// Create the game if not already in the database
		if($request->input('game_title') && empty($request->input('game_uuid')))
        {
            $game = new Game;
            $game->studio_uuid  = $studio->uuid;
            $game->title        = $request->input('game_title');
            $game->save();
        }
        else
        {
            $game = Game::findOrFail($request->input('game_uuid'));
        }
        
        // Create the relationship between the track and the source
        if($request->input('track_source'))
        {
            $track_has_detail = new ItemHasDetail;
            $track_has_detail->item_uuid     = $contact->uuid;
            $track_has_detail->data          = $request->input('track_source');
            $track_has_detail->type          = 'link';
            $track_has_detail->save();
        }
        
        // Create the relationship between the episode and the track
        $podcast = Podcast::findOrFail($request->input('podcast_uuid'));
        $episode = Episode::findOrFail($request->input('episode_uuid'));
        $episode_has_track = new EpisodeHasTrack;
        $episode_has_track->podcast_uuid = $podcast->uuid;
        $episode_has_track->episode_uuid = $episode->uuid;
        $episode_has_track->game_uuid = $game->uuid;
        $episode_has_track->track_uuid = $track->uuid;
        $episode_has_track->track_id = $request->input('track_id');
        $episode_has_track->track_type = $request->input('track_type');
        $episode_has_track->save();
        
        // Create the relationship between the artist and the episode
        $episode_has_staff = new EpisodeHasStaff;
        $episode_has_staff->podcast_uuid = $podcast->uuid;
        $episode_has_staff->episode_uuid = $episode->uuid;
        $episode_has_staff->contact_uuid = $contact->uuid;
        $episode_has_staff->profession_uuid = $request->input('profession_uuid');
        $episode_has_staff->save();
        
        // Create the relationship between the artist and the game
        $game_has_staff = new GameHasStaff;
        $game_has_staff->game_uuid = $game->uuid;
        $game_has_staff->contact_uuid = $contact->uuid;
        $game_has_staff->profession_uuid = $request->input('profession_uuid');
        $game_has_staff->save();
        
        return redirect()->route('admin.episode.show', ['uuid' => $episode->uuid]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $podcast    = Podcast::findOrFail($request->input('podcast_uuid'));
        $episode    = Episode::findOrFail($request->input('episode_uuid'));
        $importFile = $request->file('importedFile');
        Excel::import(new TracksImport($podcast, $episode), $importFile);
        
        return redirect()->back();
    }
    
    /**
     * Show the specified resource.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $track = Track::findOrFail($uuid);
        return view('admin.track.show',
            compact(
                'track'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $track = Track::findOrFail($uuid);
        return view('admin.track.edit',
            compact(
                'track'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrack $request)
    {
        $validated = $request->validated();
        
        $track = Track::findOrFail($request->input('track_uuid'));
        $track->title = $request->input('track_title');
        $track->released_on = (!empty($request->input('track_date')) ? $request->input('track_date') : null);
        $track->duration = (!empty($request->input('track_duration')) ? $request->input('track_duration') : null);
        $track->mbid = (!empty($request->input('track_mbid')) ? $request->input('track_mbid') : null);
        $track->save();
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteTrack $request)
    {
        $validated = $request->validated();
        
        $uuid = $request->input('track_uuid');
        
        $contact_has_track = ContactHasTrack::where('track_uuid', $uuid)->first();
        $contact_has_track->delete();
        
        $episode_has_track = EpisodeHasTrack::where('track_uuid', $uuid)->first();
        $episode_has_track->delete();
        
        $item_has_detail = ItemHasDetail::where('item_uuid', $uuid)->first();
        $item_has_detail->delete();
        
        $track = Track::findOrFail($uuid);
        $track->delete();
        
        return redirect()->route('admin.track.index');
    }
    
    /**
     * Restore the specified resource from storage.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function restore($uuid)
    {
        if (auth()->user()->can('restore')) {
            Track::withTrashed()->where('uuid', $uuid)->restore();
        }
        return redirect()->route('admin.track.index');
    }

    /**
     * Destroy the specified resource from storage.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        if (auth()->user()->can('destroy')) {
            Track::withTrashed()->where('uuid', $uuid)->forceDelete();
        }
        return redirect()->route('admin.track.index');
    }
}
