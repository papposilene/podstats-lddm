<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DetailHasType;
use App\Episode;
use App\ItemHasDetail;
use App\Podcast;
use App\User;
use App\Http\Requests\DeletePodcast;
use App\Http\Requests\StorePodcast;
use App\Http\Requests\UpdatePodcast;
use App\Http\Requests\StoreDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PodcastController extends Controller
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
        $podcasts = Podcast::orderBy('name', 'asc')->get();
        return view('admin.podcast.admin',
            compact('podcasts')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePodcast $request)
    {
        $validated = $request->validated();
        
        $podcast = new Podcast;
        $podcast->name          = $request->input('podcast_name');
        $podcast->began_on      = $request->input('podcast_beganOn');
        $podcast->ended_on      = $request->input('podcast_endedOn');
        $podcast->description   = $request->input('podcast_description');
        $podcast->cover         = $request->file('podcast_cover')->store('public/podcasts');
        $podcast->save();
        
        $podcast_has_detail = new ItemHasDetail;
        $podcast_has_detail->item_uuid = $podcast->uuid;
        $podcast_has_detail->item_model = 'podcast';
        $podcast_has_detail->data = $request->input('podcast_source');
        $podcast_has_detail->type = 'link';
        $podcast_has_detail->save();
		
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
        $podcast = Podcast::findOrFail($uuid);
        $detailTypes = DetailHasType::all();
        return view('admin.podcast.show',
            compact(
                'detailTypes',
                'podcast'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePodcast $request)
    {
        $validated = $request->validated();
        
        $podcast = Podcast::findOrFail($request->input('podcast_uuid'));
        $podcast->name          = $request->input('podcast_name');
        $podcast->began_on      = $request->input('podcast_beganOn');
        $podcast->ended_on      = $request->input('podcast_endedOn');
        $podcast->description   = $request->input('podcast_description');
        if($request->file('podcast_cover'))
        {
            $podcast->cover     = $request->file('podcast_cover')->store('public/podcasts');
        }
        $podcast->save();
        
        if($request->input('source_uuid'))
        {
            $podcast_has_detail = ItemHasDetail::findOrFail($request->input('source_uuid'));
            $podcast_has_detail->item_model = 'podcast';
            $podcast_has_detail->data = $request->input('podcast_source');
            $podcast_has_detail->type = 'link';
            $podcast_has_detail->save();
        }
        else
        {
            $podcast_has_detail = new ItemHasDetail;
            $podcast_has_detail->item_uuid = $podcast->uuid;
            $podcast_has_detail->item_model = 'podcast';
            $podcast_has_detail->data = $request->input('podcast_source');
            $podcast_has_detail->type = 'link';
            $podcast_has_detail->save();
        }
        
        return redirect()->route('admin.podcast.show', ['uuid' => $request->input('podcast_uuid')]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detail(StoreDetail $request)
    {
        $validated = $request->validated();
        
        $chdetail = ContactHasDetail::updateOrInsert(
            [
                [
                    'entity_uuid' => $request->input('uuid')
                ],
                [
                    'type' => $request->input('type'),
                    'data' => $request->input('data'),
                ]
            ]);
		
        return redirect()->route('admin.podcast.show', ['uuid' => $request->input('podcast_uuid')]);
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
        
        $podcast = Podcast::findOrFail($request->input('podcast_uuid'));
        $podcast->delete();
        
        return redirect()->route('admin.podcast.index');
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
            Podcast::withTrashed()->where('uuid', $uuid)->restore();
        }
        return redirect()->route('admin.podcast.index');
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
            Podcast::withTrashed()->where('uuid', $uuid)->forceDelete();
        }
        return redirect()->route('admin.podcast.index');
    }
}
