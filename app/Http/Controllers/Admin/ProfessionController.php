<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Profession;
use App\User;
use App\Http\Requests\DeleteProfession;
use App\Http\Requests\DeleteStaff;
use App\Http\Requests\StoreProfession;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProfessionController extends Controller
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
            $professions = Profession::search($query)
                ->orderBy('profession', 'asc')
                ->paginate(25);
        }
        else
        {
            $professions = Profession::orderBy('profession', 'asc')
                ->paginate(25);
        }
		
        return view('admin.profession.admin', 
			compact(
				'professions'
			)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfession $request)
    {
        $validated = $request->validated();
        
        $translations = [];
        foreach($request->input('profession') as $profession)
        {
            $translations = Arr::add($translations, $profession['lang'], $profession['name']);
        }
        
        $profession = new Profession;
        $profession->setTranslations('profession', $translations);
        $profession->save();
        
        return redirect()->route('admin.profession.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $profession = Profession::findOrFail($uuid);
        return view('admin.profession.show',
            compact(
                'profession'
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
    public function update(UpdateProfession $request)
    {
        $validated = $request->validated();
        
        $profession = Profession::findOrFail($request->input('profession_uuid'));
        $profession->setTranslation('profession', $request->input('lang'), $request->input('profession'));
        $profession->save();
        
        return redirect()->route('admin.profession.index');
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteProfession $request)
    {
        $validated = $request->validated();
		if (auth()->user()->can('delete')) {
			$profession = Profession::findOrFail($request->input('profession_uuid'));
			$profession->delete();
		}
        
        return redirect()->route('admin.profession.index');
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
            Profession::withTrashed()->where('uuid', $uuid)->restore();
        }
        return redirect()->route('admin.profession.index');
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
            Profession::withTrashed()->where('uuid', $uuid)->forceDelete();
        }
        return redirect()->route('admin.profession.index');
    }
}
