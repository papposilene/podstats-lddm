<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DetailHasType;
use App\ItemHasDetail;
use App\User;
use App\Http\Requests\StoreSource;
use App\Http\Requests\UpdateSource;
use App\Http\Requests\DeleteSource;
use App\Http\Requests\StoreSourceType;
use App\Http\Requests\UpdateSourceType;
use Illuminate\Http\Request;

class SourceController extends Controller
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
        if($request->filled('uuid'))
        {
            $uuid = $request->input('uuid');
            $sources = ItemHasDetail::where('item_uuid', $uuid)
                ->orderBy('type', 'asc')
                ->paginate(25);
        }
        elseif($request->filled('q'))
        {
            $query = $request->input('q');
            $sources = ItemHasDetail::search($query)
                ->orderBy('type', 'asc')
                ->paginate(25);
        }
        else
        {
            $sources = ItemHasDetail::orderBy('type', 'asc')
                ->paginate(25);
        }
        
        $listSources = DetailHasType::orderBy('type', 'asc')->get();
        return view('admin.source.admin',
            compact(
                'listSources',
                'sources'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeType(StoreSourceType $request)
    {
        $validated = $request->validated();
        
        $detail_has_type = new DetailHasType;
        $detail_has_type->icon  = $request->input('source_icon');
        $detail_has_type->type  = $request->input('source_type');
        $detail_has_type->save();
        
        return redirect()->back();
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSource $request)
    {
        $validated = $request->validated();
        
        $source = new ItemHasDetail;
        $source->item_uuid  = $request->input('item_uuid');
        $source->item_model = $request->input('item_model');
        $source->type       = $request->input('source_type');
        $source->data       = $request->input('source_data');
        $source->save();
        
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
        $listSources = DetailHasType::orderBy('type', 'asc')->get();
        $source = ItemHasDetail::findOrFail($uuid);
        return view('admin.source.show',
            compact(
                'listSources',
                'source'
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
        $source = ItemHasDetail::findOrFail($uuid);
        return view('admin.source.edit',
            compact(
                'source'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSource $request)
    {
        $validated = $request->validated();
        
        $source = ItemHasDetail::findOrFail($request->input('source_uuid'));
        $source->item_uuid  = $request->input('item_uuid');
        $source->item_model = $request->input('item_model');
        $source->type       = $request->input('source_type');
        $source->data       = $request->input('source_data');
        $source->save();
        
        return redirect()->back();
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteSource $request)
    {
        $validated = $request->validated();
        $contact = ItemHasDetail::findOrFail($request->input('source_uuid'));
        $contact->delete();
        
        return redirect()->route('admin.source.index');
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
            ItemHasDetail::withTrashed()->where('uuid', $uuid)->restore();
        }
        return redirect()->route('admin.source.index');
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
            ItemHasDetail::withTrashed()->where('uuid', $uuid)->forceDelete();
        }
        return redirect()->route('admin.source.index');
    }
}
