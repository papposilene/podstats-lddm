<?php

namespace App\Http\Controllers\API;

use App\Contact;
use App\Country;
use App\GameHasStaff;
use App\Http\Controllers\Controller;
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
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        $search = $request->get('q');
        $result = Contact::where('uname', 'LIKE', '%'. $search. '%')
			->orWhere('fname', 'LIKE', '%'. $search. '%')
			->orWhere('mname', 'LIKE', '%'. $search. '%')
			->orWhere('lname', 'LIKE', '%'. $search. '%')
			->orderBy('uname', 'asc')->get();
        return response()->json($result);
    }
    
    /**
     * Return a json with info on consoles of a contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function consoles($uuid, Request $request)
    {
        $consoles = array();
        
        $contact = Contact::findOrFail($uuid);

        $data['uuid'] = $contact->uuid;
        $data['uname'] = $contact->uname;
        $data['gender'] = $contact->gender;
        $data['fname'] = $contact->fname;
        $data['mname'] = $contact->mname;
        $data['lname'] = $contact->lname;

        foreach($contact->hasGames as $games)
        {
            foreach($games->hasGame->hasConsoles as $g_hc)
            {
                if (!array_key_exists($g_hc->name, $consoles))
                {
                    $consoles[$g_hc->name] = 0;
                }
                (int) $consoles[$g_hc->name]++;
            }
        }
        
        arsort($consoles);
        
        $count = $request->get('count');
        if ((int) $count)
        {
            $consoles = array_slice($consoles, 0, $count);
        }
        
        $data['chart']['labels'] = array_keys($consoles);
        $data['chart']['data'] = array_values($consoles);
        
        $result = $data;
        
        return response()->json($result);
    }
    
    /**
     * Return a json with info on genres of a contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function countries(Request $request)
    {
        $cca3 = $request->get('cca3');
        $countries = array();
        
        if ($cca3)
        {
            $country = Country::where('cca3', $cca3)->first();
            
            $data['uuid'] = $country->uuid;
            $data['cca3'] = $country->cca3;
            $data['country'] = $country->name_eng_common;
            
            $contacts = Contact::where('lives_at', $country->uuid)->get();
            $data['contacts'] = count($contacts);
        }
        else
        {
            $contacts = Contact::all();
            foreach($contacts as $contact)
            {
                if ($contact->lives_at)
                {
                    if (!array_key_exists($contact->livesAt->name_eng_common, $countries))
                    {
                        $countries[$contact->livesAt->name_eng_common] = 0;
                    }
                    (int) $countries[$contact->livesAt->name_eng_common]++;
                    }
                else
                {
                    if (!array_key_exists('Unknown', $countries))
                    {
                        $countries['Unknown'] = 0;
                    }
                    (int) $countries['Unknown']++;
                }
            }
        
            arsort($countries);
        
            $count = $request->get('count');
            if ((int) $count)
            {
                $countries = array_slice($countries, 0, $count);
            }
        
            $data['chart']['labels'] = array_keys($countries);
            $data['chart']['data'] = array_values($countries);
            
        }
        
        $result = $data;
        
        return response()->json($result);
    }

    /**
     * Return a json with info on genres of a contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function genders()
    {
        $genders = array();
        
        $contacts = Contact::all();

        $genders['band'] = 0;
        $genders['feminine'] = 0;
        $genders['masculine'] = 0;
        $genders['neutral'] = 0;
        $genders['unknown'] = 0;

        foreach($contacts as $contact)
        {
            (int) $genders[$contact->gender]++;
        }
        
        $data['chart']['labels'] = array_keys($genders);
        $data['chart']['data'] = array_values($genders);
        
        $result = $data;
        
        return response()->json($result);
    }
    
    /**
     * Return a json with info on genres of a contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function genres($uuid, Request $request)
    {
        $genres = array();
        
        $contact = Contact::findOrFail($uuid);

        $data['uuid'] = $contact->uuid;
        $data['uname'] = $contact->uname;
        $data['gender'] = $contact->gender;
        $data['fname'] = $contact->fname;
        $data['mname'] = $contact->mname;
        $data['lname'] = $contact->lname;

        foreach($contact->hasGames as $games)
        {
            foreach($games->hasGame->hasGenres as $g_hg)
            {
                if (!array_key_exists($g_hg->genre, $genres))
                {
                    $genres[$g_hg->genre] = 0;
                }
                (int) $genres[$g_hg->genre]++;
            }
        }
        
        arsort($genres);
        
        $count = $request->get('count');
        if ((int) $count)
        {
            $genres = array_slice($genres, 0, $count);
        }
        
        $data['chart']['labels'] = array_keys($genres);
        $data['chart']['data'] = array_values($genres);
        
        $result = $data;
        
        return response()->json($result);
    }
    
    /**
     * Return a json with info on studios of a contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function studios($uuid, Request $request)
    {
        $studios = array();
        
        $contact = Contact::findOrFail($uuid);

        $data['uuid'] = $contact->uuid;
        $data['uname'] = $contact->uname;
        $data['gender'] = $contact->gender;
        $data['fname'] = $contact->fname;
        $data['mname'] = $contact->mname;
        $data['lname'] = $contact->lname;

        foreach($contact->hasGames as $games)
        {
            $studio = $games->hasGame->createdBy->studio;
            if (!array_key_exists($studio, $studios))
            {
                $studios[$studio] = 0;
            }
            (int) $studios[$studio]++;
        }
        
        arsort($studios);
        
        $count = $request->get('count');
        if ((int) $count)
        {
            $genres = array_slice($studios, 0, $count);
        }
        
        $data['chart']['labels'] = array_keys($studios);
        $data['chart']['data'] = array_values($studios);
        
        $result = $data;
        
        return response()->json($result);
    }

}