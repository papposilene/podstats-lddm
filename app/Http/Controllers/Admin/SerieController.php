<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\GameHasSerie;
use App\Serie;
use App\User;
use App\Http\Requests\DeleteSerie;
use App\Http\Requests\StoreSerie;
use App\Http\Requests\StoreSerieGameAdd;
use App\Http\Requests\StoreSerieGameLink;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class SerieController extends Controller
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
    public function index($saga = null, Request $request)
    {
        if($request->filled('q'))
        {
            $query = $request->input('q');
            $series = Serie::search($query)
                ->orderBy('serie', 'asc')
                ->paginate(25);
        }
        else
        {
            $series = Serie::orderBy('serie', 'asc')
                ->paginate(25);
        }
		
        return view('admin.serie.index', 
			compact(
				'series'
			)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSerie $request)
    {
        $validated = $request->validated();
        
        $serie = new Serie;
        $serie->serie = $request->input('serie_name');
        $serie->save();
        
        return redirect()->route('admin.serie.show', ['uuid' => $serie->uuid]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $serie = Serie::findOrFail($uuid);
        return view('admin.serie.show',
            compact(
                'serie'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(StoreSerieGameAdd $request)
    {
        $validated = $request->validated();
        
        $serie_has_game = new GameHasSerie;
        $serie_has_game->serie_uuid = $request->input('serie_uuid');
        $serie_has_game->game_order = $request->input('game_order');
        $serie_has_game->game_title = $request->input('game_title');
        $serie_has_game->save();
        
        return redirect()->back();
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function game(StoreSerieGameLink $request)
    {
        $validated = $request->validated();
        
        $serie_has_game = GameHasSerie::findOrFail($request->input('serie_uuid'));
        $serie_has_game->game_uuid = $request->input('game_uuid');
        $serie_has_game->save();
        
        return redirect()->back();
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteSerie $request)
    {
        $validated = $request->validated();
		if (auth()->user()->can('delete')) {
			$serie = Serie::findOrFail($request->input('serie_uuid'));
			$serie->delete();
		}
        
        return redirect()->route('admin.serie.index');
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
            Serie::withTrashed()->where('uuid', $uuid)->restore();
        }
        return redirect()->route('admin.serie.index');
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
            Serie::withTrashed()->where('uuid', $uuid)->forceDelete();
        }
        return redirect()->route('admin.serie.index');
    }
}
