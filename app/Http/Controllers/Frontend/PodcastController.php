<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Podcast;
use App\Episode;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $podcasts = Podcast::all();
        return view('public.podcast.index',
            compact(
                'podcasts'
            ));
    }

    /**
     * Display the specified resource.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $podcast = Podcast::findOrFail($uuid);
        $episodes = Episode::where('podcast_uuid', $uuid)->orderBy('id', 'desc')->paginate(30);
        return view('public.podcast.show',
            compact(
                'podcast',
                'episodes'
            )
        );
    }
}
