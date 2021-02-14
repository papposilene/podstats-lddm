<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Contact;
use App\Country;
use App\ContactHasTrack;
use App\GameHasStaff;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('cca3'))
        {
            $cca3 = $request->input('cca3');
            $country = Country::where('cca3', $cca3)->firstOrFail();
            $contacts = Contact::where('lives_at', $country->uuid)
                ->orderBy('uname', 'asc')
                ->paginate(30);
        }
        elseif ($request->filled('gender'))
        {
            $gender = $request->input('gender');
            $contacts = Contact::where('gender', $gender)
                ->orderBy('uname', 'asc')
                ->paginate(30);
        }
        elseif($request->filled('q'))
        {
            $query = $request->input('q');
            $contacts = Contact::search($query)
                ->orderBy('uname', 'asc')
                ->paginate(30);
        }
        else
        {
            $contacts = Contact::orderBy('uname', 'asc')
                ->paginate(30);
        }
        
        $deadContacts = Contact::whereNotNull('died_at')->count();
        $totalContacts = Contact::count();
        
        
        return view('public.contact.index',
            compact(
                'contacts',
                'deadContacts',
                'totalContacts'
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
        $contact = Contact::findOrFail($uuid);
        
        return view('public.contact.show',
            compact(
                'contact'
            )
        );
    }
}
