<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Game;
use App\GameHasGenre;
use App\Genre;
use App\Studio;
use Illuminate\Http\Request;

class GenreController extends Controller
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
            $genres = Genre::search($query)
                ->orderBy('genre', 'asc')
                ->paginate(30);
        }
        else
        {
            $genres = Genre::has('hasGames')->orderBy('genre', 'asc')
                ->paginate(30);
        }
        
        $totalGames = Game::count();
        $totalGenres = Genre::count();
        $totalStudios = Studio::count();
        
        return view('public.genre.index',
            compact(
                'genres',
                'totalGames',
                'totalGenres',
                'totalStudios'
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
        $genre = Genre::findOrFail($uuid);
        $games = GameHasGenre::where('genre_uuid', $uuid)->paginate(30);
        $totalGames = Game::count();
        $totalGenres = Genre::count();
        $totalStudios = Studio::count();
        return view('public.genre.show',
            compact(
                'games',
                'genre',
                'totalGames',
                'totalGenres',
                'totalStudios'
            )
        );
    }
}
