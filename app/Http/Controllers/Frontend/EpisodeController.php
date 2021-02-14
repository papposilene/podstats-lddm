<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Episode;
use App\EpisodeHasTrack;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $episodes = Episode::all();
        return view('public.episode.index',
            compact(
                'episodes'
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
        $episode = Episode::findOrFail($uuid);
        return view('public.episode.show',
            compact(
                'episode'
            )
        );
    }
}
