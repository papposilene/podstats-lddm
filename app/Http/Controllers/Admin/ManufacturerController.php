<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Manufacturer;
use App\User;
use App\Http\Requests\DeleteManufacturer;
use App\Http\Requests\StoreManufacturer;
use App\Http\Requests\UpdateManufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
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
            $manufacturers = Manufacturer::search($query)
                ->orderBy('company', 'asc')
                ->paginate(25);
        }
        else
        {
            $manufacturers = Manufacturer::orderBy('company', 'asc')
                ->paginate(25);
        }
        
        return view('admin.manufacturer.admin',
            compact(
                'manufacturers'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreManufacturer $request)
    {
        $validated = $request->validated();
        
        $manufacturer = new Manufacturer;
        $manufacturer->company = $request->input('company_name');
        $manufacturer->country_uuid = $request->input('country_uuid');
        $manufacturer->save();
        return redirect()->route('admin.manufacturer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $manufacturer = Manufacturer::findOrFail($uuid);
        return view('admin.manufacturer.show',
			compact(
				'manufacturer'
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
    public function update(UpdateManufacturer $request)
    {
        $validated = $request->validated();
        
        $manufacturer = new Manufacturer;
        $manufacturer->company = strtolower($request->input('company'));
        $manufacturer->save();
        return redirect()->route('admin.manufacturer.index');
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteManufacturer $request)
    {
        $validated = $request->validated();
        
        $manufacturer = Manufacturer::findOrFail($request->input('manufacturer_uuid'));
        $manufacturer->delete();
        
        return redirect()->route('admin.manufacturer.index');
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
            Manufacturer::withTrashed()->where('uuid', $uuid)->restore();
        }
        return redirect()->route('admin.manufacturer.index');
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
            Manufacturer::withTrashed()->where('uuid', $uuid)->forceDelete();
        }
        return redirect()->route('admin.manufacturer.index');
    }
}

