<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contact;
use App\DetailHasType;
use App\PodcastHasStaff;
use App\Profession;
use App\User;
use App\Http\Requests\StoreContact;
use App\Http\Requests\StoreStaff;
use App\Http\Requests\UpdateContact;
use App\Http\Requests\DeleteContact;
use Illuminate\Http\Request;

class ContactController extends Controller
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
            $contacts = Contact::search($query)
                ->orderBy('lname', 'asc')
                ->paginate(25);
        }
        else
        {
            $contacts = Contact::orderBy('lname', 'asc')
                ->paginate(25);
        }
        
        return view('admin.contact.admin',
            compact(
                'contacts'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lastContacts = Contact::orderBy('created_at', 'desc')->limit(10)->get();
		return view('admin.contact.create',
			compact(
				'lastContacts'
			)
		);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContact $request)
    {
        $validated = $request->validated();
        
        $contact = new Contact;
        $contact->uname         = $request->input('contact_uname');
        $contact->gender        = $request->input('contact_gender');
        $contact->fname         = $request->input('contact_fname');
        $contact->mname         = $request->input('contact_mname');
        $contact->lname         = $request->input('contact_lname');
        $contact->lives_at      = $request->input('contact_livesAt');
        $contact->born_on       = $request->input('contact_bornOn');
        $contact->born_at       = $request->input('contact_bornAt');
        $contact->died_on       = $request->input('contact_diedOn');
        $contact->died_at       = $request->input('contact_diedAt');
        $contact->biography     = $request->input('contact_biography');
        $contact->save();
        
        return redirect()->route('admin.contact.show', ['uuid' => $contact->uuid]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function staff(StoreStaff $request)
    {
        $validated = $request->validated();
        
        $staff = new PodcastHasStaff;
        $staff->podcast_uuid    = $request->input('podcast_uuid');
        $staff->contact_uuid    = $request->input('contact_uuid');
        $staff->profession_uuid = $request->input('profession_uuid');
        $staff->save();
        return redirect()->route('admin.contact.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $listProfessions = Profession::all();
        $listSources = DetailHasType::orderBy('type', 'asc')->get();
        $contact = Contact::findOrFail($uuid);
        return view('admin.contact.show',
            compact(
                'listProfessions',
                'listSources',
                'contact'
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
        $contact = Contact::findOrFail($uuid);
        return view('admin.contact.edit',
            compact(
                'contact'
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
    public function update(UpdateContact $request)
    {
        $validated = $request->validated();
        
        $contact = Contact::findOrFail($request->input('contact_uuid'));
        $contact->uname         = $request->input('contact_uname');
        $contact->gender        = $request->input('contact_gender');
        $contact->fname         = $request->input('contact_fname');
        $contact->mname         = $request->input('contact_mname');
        $contact->lname         = $request->input('contact_lname');
        $contact->lives_at      = $request->input('contact_livesAt');
        $contact->born_on       = $request->input('contact_bornOn');
        $contact->born_at       = $request->input('contact_bornAt');
        $contact->died_on       = $request->input('contact_diedOn');
        $contact->died_at       = $request->input('contact_diedAt');
        $contact->biography     = $request->input('contact_biography');
        $contact->save();
        
        return redirect()->route('admin.contact.show', ['uuid' => $contact->uuid]);
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteContact $request)
    {
        $validated = $request->validated();
        $contact = Contact::findOrFail($request->input('contact_uuid'));
        $contact->delete();
        
        return redirect()->route('admin.contact.index');
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
            Contact::withTrashed()->where('uuid', $uuid)->restore();
        }
        return redirect()->route('admin.contact.index');
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
            Contact::withTrashed()->where('uuid', $uuid)->forceDelete();
        }
        return redirect()->route('admin.contact.index');
    }
}
