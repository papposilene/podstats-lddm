<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Console;
use App\User;
use App\Http\Requests\DeleteConsole;
use App\Http\Requests\StoreConsole;
use App\Http\Requests\UpdateConsole;
use Illuminate\Http\Request;

class ConsoleController extends Controller
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
            $consoles = Console::search($query)
                ->orderBy('released_on', 'desc')
                ->paginate(25);
        }
        else
        {
            $consoles = Console::orderBy('released_on', 'desc')
                ->paginate(25);
        }
        
        return view('admin.console.admin',
            compact(
                'consoles'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConsole $request)
    {
        $validated = $request->validated();
        
        $console = new Console;
        $console->name               = $request->input('console_name');
        $console->manufacturer_uuid  = $request->input('manufacturer_uuid');
        $console->type               = $request->input('console_type');
        $console->generation         = $request->input('console_generation');
        $console->released_on        = $request->input('console_releasedOn');
        $console->save();
        
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
        $console = Console::findOrFail($uuid);
        return view('admin.console.show',
            compact(
                'console'
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConsole $request)
    {
        $validated = $request->validated();
        
        $console = Console::findOrFail($request->input('console_uuid'));
        $console->name               = $request->input('console_name');
        $console->manufacturer_uuid  = $request->input('manufacturer_uuid');
        $console->type               = $request->input('console_type');
        $console->generation         = $request->input('console_generation');
        $console->released_on        = $request->input('console_releasedOn');
        $console->save();
        
        return redirect()->route('admin.console.show', ['uuid' => $console->uuid]);
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteConsole $request)
    {
        $validated = $request->validated();
        
        $console = Console::findOrFail($request->input('console_uuid'));
        $console->delete();
        
        return redirect()->route('admin.console.index');
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
            Console::withTrashed()->where('uuid', $uuid)->restore();
        }
        return redirect()->route('admin.console.index');
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
            Console::withTrashed()->where('uuid', $uuid)->forceDelete();
        }
        return redirect()->route('admin.console.index');
    }
}
