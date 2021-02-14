<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Game;
use App\Studio;
use App\User;
use App\Http\Requests\DeleteStudio;
use App\Http\Requests\StoreStudio;
use App\Http\Requests\UpdateStudio;
use Illuminate\Http\Request;

class StudioController extends Controller
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
            $studios = Studio::search($query)
                ->orderBy('studio', 'asc')
                ->paginate(25);
        }
        else
        {
            $studios = Studio::orderBy('studio', 'asc')
                ->paginate(25);
        }
        
        return view('admin.studio.admin',
            compact(
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
    public function store(StoreStudio $request)
    {
        $validated = $request->validated();
        
        $studio = new Studio;
        $studio->studio         = $request->input('studio_name');
        $studio->country_uuid   = $request->input('country_uuid');
        $studio->save();
        return redirect()->route('admin.studio.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $studio = Studio::findOrFail($uuid);
        return view('admin.studio.show',
            compact(
                'studio'
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudio $request)
    {
        $validated = $request->validated();
        
        $console = Console::findOrFail($request->input('console_uuid'));
        $console->name               = $request->input('console_name');
        $console->manufacturer_uuid  = $request->input('manufacturer_uuid');
        $console->type               = $request->input('console_type');
        $console->generation         = $request->input('console_generation');
        $console->released_on        = $request->input('console_releasedOn');
        $console->save();
        return redirect()->route('admin.studio.index');
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteStudio $request)
    {
        $validated = $request->validated();
        
        $studio = Studio::findOrFail($request->input('studio_uuid'));
        $studio->delete();
        
        return redirect()->route('admin.studio.index');
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
            Studio::withTrashed()->where('uuid', $uuid)->restore();
        }
        return redirect()->route('admin.studio.index');
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
            Studio::withTrashed()->where('uuid', $uuid)->forceDelete();
        }
        return redirect()->route('admin.studio.index');
    }
}
