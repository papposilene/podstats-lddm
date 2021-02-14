<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Genre;
use App\User;
use App\Http\Requests\DeleteGenre;
use App\Http\Requests\StoreGenre;
use App\Http\Requests\UpdateGenre;
use Illuminate\Http\Request;

class GenreController extends Controller
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
            $genres = Genre::search($query)
                ->orderBy('genre', 'asc')
                ->paginate(25);
        }
        else
        {
            $genres = Genre::orderBy('genre', 'asc')
                ->paginate(25);
        }
		
        return view('admin.genre.admin', 
			compact(
				'genres'
			)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGenre $request)
    {
        $validated = $request->validated();
        
        $genre = new Genre;
        $genre->genre = $request->input('genre_name');
        $genre->save();
        
        return redirect()->route('admin.genre.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $genre = Genre::findOrFail($uuid);
        return view('admin.genre.show',
            compact(
                'genre'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGenre $request)
    {
        //
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteGenre $request)
    {
        $validated = $request->validated();
		if (auth()->user()->can('delete')) {
			$genre = Genre::findOrFail($request->input('genre_uuid'));
			$genre->delete();
		}
        
        return redirect()->route('admin.genre.index');
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
            Genre::withTrashed()->where('uuid', $uuid)->restore();
        }
        return redirect()->route('admin.genre.index');
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
            Genre::withTrashed()->where('uuid', $uuid)->forceDelete();
        }
        return redirect()->route('admin.genre.index');
    }
}
