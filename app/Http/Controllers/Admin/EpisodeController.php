<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Episode;
use App\EpisodeHasStaff;
use App\EpisodeHasTrack;
use App\ItemHasDetail;
use App\Podcast;
use App\Profession;
use App\User;
use App\Imports\EpisodesImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteEpisode;
use App\Http\Requests\StoreEpisode;
use App\Http\Requests\UpdateEpisode;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class EpisodeController extends Controller
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
        $episodes = Episode::orderBy('aired_on', 'desc')->paginate(25);
        return view('admin.episode.admin',
            compact(
                'episodes'
            )
        );
    }

    /**
     * Store a newly created episode.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEpisode $request)
    {
        $validated = $request->validated();
        
        $episode = new Episode;
        $episode->podcast_uuid  = $request->input('podcast_uuid');
        $episode->season        = $request->input('season_id');
        $episode->id            = $request->input('episode_id');
        $episode->title         = $request->input('episode_title');
        $episode->duration      = $request->input('episode_duration');
        $episode->aired_on      = $request->input('episode_airedOn');
        $episode->description   = (!empty($request->input('episode_description')) ? $request->input('episode_description') : null);
        $episode->save();
		
		if($request->input('episode_source'))
		{
            $item_has_detail = new ItemHasDetail;
            $item_has_detail->item_uuid = $episode->uuid;
            $item_has_detail->item_model = 'episode';
            $item_has_detail->data = $request->input('episode_source');
            $item_has_detail->type = 'link';
            $item_has_detail->save();
		}
		
        return redirect()->route('admin.podcast.index');
    }
    
    /**
     * Create a link between an episode and a contact
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function staff(StoreEpisodeStaff $request)
    {
        $validated = $request->validated();
        
        if($request->input('contact_uname') && empty($request->input('contact_uuid')))
        {
            $contact = new Contact;
            $contact->uname = $request->input('contact_uname');
            $contact->save();
        }
        else
        {
            $contact = Contact::findOrFail($request->input('contact_uuid'));
        }
        
        $podcast = Podcast::findOrFail($request->input('podcast_uuid'));
        $episode = Episode::findOrFail($request->input('episode_uuid'));
        $profession = Profession::findOrFail($request->input('profession_uuid'));
        
        $episode_has_staff = new EpisodeHasStaff;
        $episode_has_staff->podcast_uuid    = $podcast->uuid;
        $episode_has_staff->episode_uuid    = $episode->uuid;
        $episode_has_staff->contact_uuid    = $contact->uuid;
        $episode_has_staff->profession_uuid = $profession->uuid;
        $episode_has_staff->save();
		
        return redirect()->route('admin.episode.show', ['uuid' => $episode->uuid]);
    }
    
    /**
     * Import a file in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $podcast    = Podcast::findOrFail($request->input('podcast_uuid'));
        $importFile = $request->file('importedFile');
        Excel::import(new EpisodesImport($podcast), $importFile);
        
        return redirect()->back();
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $episode = Episode::findOrFail($uuid);
        $professions = Profession::all();
        $trackLastId = EpisodeHasTrack::where('episode_uuid', $uuid)->orderBy('track_id', 'desc')->count();
        return view('admin.episode.show',
            compact(
                'episode',
                'professions',
                'trackLastId'
            )
        );
    }

    /**
     * Update the episode.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEpisode $request)
    {
        $validated = $request->validated();
        
        $episode = Episode::findOrFail($request->input('episode_uuid'));
        $episode->season        = $request->input('season_id');
        $episode->id            = $request->input('episode_id');
        $episode->title         = $request->input('episode_title');
        $episode->duration      = $request->input('episode_duration');
        $episode->aired_on      = $request->input('episode_airedOn');
        $episode->description   = (!empty($request->input('episode_description')) ? $request->input('episode_description') : null);
        $episode->save();
        
        if($request->input('source_uuid'))
        {
            $episode_has_detail = ItemHasDetail::findOrFail($request->input('source_uuid'));
            $episode_has_detail->item_model = 'episode';
            $episode_has_detail->data = $request->input('episode_source');
            $episode_has_detail->type = 'link';
            $episode_has_detail->save();
        }
        else
        {
            $episode_has_detail = new ItemHasDetail;
            $episode_has_detail->item_uuid = $episode->uuid;
            $episode_has_detail->item_model = 'episode';
            $episode_has_detail->data = $request->input('episode_source');
            $episode_has_detail->type = 'link';
            $episode_has_detail->save();
        }
		
        return redirect()->route('admin.episode.show', ['uuid' => $episode->uuid]);
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(DeletePodcast $request)
    {
        $validated = $request->validated();
        $episode = Episode::findOrFail($request->input('episode_uuid'));
        $episode->delete();
        
        return redirect()->route('admin.episode.index');
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
            Episode::withTrashed()->where('uuid', $uuid)->restore();
        }
        return redirect()->route('admin.episode.index');
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
            Episode::withTrashed()->where('uuid', $uuid)->forceDelete();
        }
        return redirect()->route('admin.episode.index');
    }
}
