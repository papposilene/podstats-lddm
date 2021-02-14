<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Console;
use App\Contact;
use App\DetailHasType;
use App\Game;
use App\GameHasConsole;
use App\GameHasGenre;
use App\GameHasStaff;
use App\Genre;
use App\Profession;
use App\Studio;
use App\User;
use App\Http\Requests\DeleteGame;
use App\Http\Requests\StoreGame;
use App\Http\Requests\UpdateGame;
use Illuminate\Http\Request;

class GameController extends Controller
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
            $games = Game::search($query)
                ->orderBy('title', 'asc')
                ->paginate(25);
        }
        else
        {
            $games = Game::orderBy('title', 'asc')
                ->paginate(25);
        }
		
        return view('admin.game.admin',
            compact(
                'games'
            )
        );
    }
    
    /**
     * Create a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $consoles = Console::orderBy('name', 'asc')->get();
        $games = Game::orderBy('created_at', 'desc')->limit(10)->get();
        $genres = Genre::orderBy('genre', 'asc')->get();
        $professions = Profession::all();
        $studios = Studio::orderBy('studio', 'asc')->get();
        return view('admin.game.create',
            compact(
                'consoles',
                'games',
                'genres',
                'professions',
                'studios'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGame $request)
    {
        $validated = $request->validated();
        
        // Create a new game
        $game = new Game;
        $game->studio_uuid  = $request->input('studio_uuid');
        $game->title        = $request->input('game_title');
        $game->released_on  = $request->input('game_releasedOn');
        $game->mode         = json_encode($request->input('game_mode'));
        $game->save();
        
        // Create a new relation between a game and some genres
        $genres = $request->input('genres');
        foreach($genres as $genre)
        {
            $game_has_genre = new GameHasGenre;
            $game_has_genre->game_uuid = $game->uuid;
            $game_has_genre->genre_uuid = $genre;
            $game_has_genre->save();
        }
        
        // Create a new relation between a game and some consoles
        $consoles = $request->input('consoles');
        foreach($consoles as $console)
        {
            $game_has_console = new GameHasConsole;
            $game_has_console->game_uuid = $game->uuid;
            $game_has_console->console_uuid = $console;
            $game_has_console->save();
        }
        
        return redirect()->route('admin.game.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $game = Game::findOrFail($uuid);
        $listSources = DetailHasType::orderBy('type', 'asc')->get();
        $professions = Profession::all();
        return view('admin.game.show',
            compact(
                'game',
                'listSources',
                'professions'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $game = Game::findOrFail($uuid);
        $consoles = Console::orderBy('name', 'asc')->get();
        $games = Game::orderBy('created_at', 'desc')->limit(10)->get();
        $genres = Genre::orderBy('genre', 'asc')->get();
        $professions = Profession::all();
        $studios = Studio::orderBy('studio', 'asc')->get();
        return view('admin.game.edit',
            compact(
                'game',
                'consoles',
                'games',
                'genres',
                'professions',
                'studios'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGame $request)
    {
        $validated = $request->validated();
        
        // Update a game
        $game = Game::findOrFail($request->input('game_uuid'));
        $game->studio_uuid  = $request->input('studio_uuid');
        $game->title        = $request->input('game_title');
        $game->released_on  = $request->input('game_releasedOn');
        $game->mode         = json_encode($request->input('modes'));
        $game->save();
        
        // Create a new relation between a game and some genres
        $genres = $request->input('genres');
        foreach($genres as $genre)
        {
            $game_has_genre = GameHasGenre::updateOrCreate(
                [
                    'game_uuid' => $game->uuid,
                    'genre_uuid' => $genre
                ]
            );
        }
        
        // Create a new relation between a game and some consoles
        $consoles = $request->input('consoles');
        foreach($consoles as $console)
        {
            $game_has_console = GameHasConsole::updateOrCreate(
                [
                    'game_uuid' => $game->uuid,
                    'console_uuid' => $console
                ]
            );
        }
        
        $game->save();
        
        return redirect()->route('admin.game.show', ['uuid' => $game->uuid]);
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteGame $request)
    {
        $validated = $request->validated();
        $game = Game::findOrFail($request->input('game_uuid'));
        $game->delete();
        
        return redirect()->route('admin.game.index');
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
            Game::withTrashed()->where('uuid', $uuid)->restore();
        }
        return redirect()->route('admin.game.index');
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
            Game::withTrashed()->where('uuid', $uuid)->forceDelete();
        }
        return redirect()->route('admin.game.index');
    }
}
