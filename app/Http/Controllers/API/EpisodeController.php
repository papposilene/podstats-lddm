<?php

namespace App\Http\Controllers\API;

use App\Country;
use App\Episode;
use App\EpisodeHasStaff;
use App\EpisodeHasTrack;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EpisodeController extends Controller
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
    public function json($eid, $type)
    {
        $i = 0;
        $j = 0;
        
        $episode = Episode::where('id', $eid)->firstOrFail();
        
        $data['uuid'] = $episode->uuid;
        $data['podcast_uuid'] = $episode->podcast_uuid;
        $data['podcast_name'] = $episode->inPodcast->name;
        $data['season'] = $episode->season;
        $data['number'] = $episode->id;
        $data['aired_on'] = $episode->aired_on->format('d/m/Y');
        $data['duration'] = $episode->duration->format('H:m:i');

        foreach($episode->hasTracklist as $track)
        {
            foreach($track->hasComposers as $author)
            {
                $data['track'][$i]['author'][$j]['uuid'] = $author->composedBy->uuid;
                $data['track'][$i]['author'][$j]['pseudo'] = $author->composedBy->uname;
                $data['track'][$i]['author'][$j]['gender'] = $author->composedBy->gender;
                $data['track'][$i]['author'][$j]['lives_at'] = ($author->composedBy->livesAt ? $author->composedBy->livesAt->name_eng_common : 'unknown');
                $data['track'][$i]['author'][$j]['born_on'] = ($author->composedBy->born_on ? $author->composedBy->born_on->format('d/m/Y') : '00/00/0000');
                $data['track'][$i]['author'][$j]['died_on'] = ($author->composedBy->died_on ? $author->composedBy->died_on->format('d/m/Y') : '00/00/0000');
                
                $j++;
            }
            $data['track'][$i]['title'] = $track->hasTrack->title;
            $data['track'][$i]['game']['uuid'] = $track->hasGame->uuid;
            $data['track'][$i]['game']['title'] = $track->hasGame->title;
            $data['track'][$i]['game']['released_on'] = $track->hasGame->released_on->format('d/m/Y');
            $i++;
            $j = 0;
        }
        
        $result = $data;
        
        return response()->json($result);
    }
    
    /**
     * Return a json with continents (lives_at) of contacts.
     *
     * @return \Illuminate\Http\Response
     */
    public function continents($eid = 0, Request $request)
    {
        $continents = array();
        $continents['Africa'] = 0;
        $continents['Americas'] = 0;
        $continents['Antarctic'] = 0;
        $continents['Asia'] = 0;
        $continents['Europe'] = 0;
        $continents['Oceania'] = 0;
        
        $season = (int) $request->get('season');
        
        if($eid === 0)
        {
            if ($season && $season !== 0)
            {
                $episodes = Episode::where('season', $season)->get();
            }
            else
            {
                $episodes = Episode::all();
            }
            
            // Retrieve data for all episodes
            foreach($episodes as $episode)
            {
                $staffs = EpisodeHasStaff::where('episode_uuid', $episode->uuid)->get();
                foreach($staffs as $staff)
                {
                    // Skip hosts' and producers' podcast.
                    $inStaff = ['Producer', 'Producteur', 'Host', 'Animateur'];
                    $isStaff = $staff->hasProfession->profession;
                    if (Str::of($isStaff)->contains($inStaff))
                    {
                        continue;
                    }
                    
                    if (!empty($staff->hasContact->livesAt))
                    {
                        (int) $continents[$staff->hasContact->livesAt->region]++;
                    }
                    else
                    {
                        if (!array_key_exists('Unknown', $continents))
                        {
                            $continents['Unknown'] = 0;
                        }
                        (int) $continents['Unknown']++;
                    }
                }
            }
        }
        elseif ($eid)
        {
            $episode = Episode::where('id', $eid)->firstOrFail();
            $staffs = EpisodeHasStaff::where('episode_uuid', $episode->uuid)->get();
            
            $data['uuid'] = $episode->uuid;
            $data['podcast_uuid'] = $episode->podcast_uuid;
            $data['podcast_name'] = $episode->inPodcast->name;
            $data['season'] = $episode->season;
            $data['number'] = $episode->id;
            $data['title'] = $episode->title;
            $data['aired_on'] = $episode->aired_on->format('d/m/Y');
            $data['duration'] = $episode->duration->format('H:m:i');
        
            foreach($staffs as $staff)
            {                
                // Skip hosts' and producers' podcast.
                $inStaff = ['Producer', 'Producteur', 'Host', 'Animateur'];
                $isStaff = $staff->hasProfession->profession;
                if (Str::of($isStaff)->contains($inStaff))
                {
                    continue;
                }
                
                if ($staff->hasContact->livesAt)
                {
                    (int) $continents[$staff->hasContact->livesAt->region]++;
                }
                else
                {
                    if (!array_key_exists('Unknown', $continents))
                    {
                        $continents['Unknown'] = 0;
                    }
                    (int) $continents['Unknown']++;
                }
            }
        }
        else
        {
            abort(404);
        }
        
        $data['chart']['labels'] = array_keys($continents);
        $data['chart']['data'] = array_values($continents);
        
        $result = $data;
        
        return response()->json($result);
    }
    
    /**
     * Return a json with genders of contacts.
     *
     * @return \Illuminate\Http\Response
     */
    public function genders($eid = 0, Request $request)
    {
        $gender['band'] = 0;
        $gender['feminine'] = 0;
        $gender['masculine'] = 0;
        $gender['neutral'] = 0;
        $gender['unknown'] = 0;
        
        $season = (int) $request->get('season');
        
        if($eid === 0)
        {
            if ($season && $season !== 0)
            {
                $episodes = Episode::where('season', $season)->get();
            }
            else
            {
                $episodes = Episode::all();
            }
            
            // Retrieve data for all episodes
            foreach($episodes as $episode)
            {
                $tracks = EpisodeHasTrack::where('episode_uuid', $episode->uuid)->get();
                
                foreach($tracks as $track)
                {
                    foreach($track->hasComposers as $author)
                    {
                        if ('band' === $author->composedBy->gender)
                        {
                            $gender['band']++;
                        }
                        elseif ('feminine' === $author->composedBy->gender)
                        {
                            $gender['feminine']++;
                        }
                        elseif ('masculine' === $author->composedBy->gender)
                        {
                            $gender['masculine']++;
                        }
                        elseif ('neutral' === $author->composedBy->gender)
                        {
                            $gender['neutral']++;
                        }
                        else
                        {
                            $gender['unknown']++;
                        }
                    }
                }
            }
        }
        elseif ($eid)
        {
            $episode = Episode::where('id', $eid)->firstOrFail();
            $tracks = EpisodeHasTrack::where('episode_uuid', $episode->uuid)->get();
            
            $data['uuid'] = $episode->uuid;
            $data['podcast_uuid'] = $episode->podcast_uuid;
            $data['podcast_name'] = $episode->inPodcast->name;
            $data['season'] = $episode->season;
            $data['number'] = $episode->id;
            $data['title'] = $episode->title;
            $data['aired_on'] = $episode->aired_on->format('d/m/Y');
            $data['duration'] = $episode->duration->format('H:m:i');
        
            foreach($tracks as $track)
            {
                foreach($track->hasComposers as $author)
                {
                    if ('band' === $author->composedBy->gender)
                    {
                        $gender['band']++;
                    }
                    elseif ('feminine' === $author->composedBy->gender)
                    {
                        $gender['feminine']++;
                    }
                    elseif ('masculine' === $author->composedBy->gender)
                    {
                        $gender['masculine']++;
                    }
                    elseif ('neutral' === $author->composedBy->gender)
                    {
                        $gender['neutral']++;
                    }
                    else
                    {
                        $gender['unknown']++;
                    }
                }
            }
        }
        else
        {
            abort(404);
        }
        
        $data['chart']['labels'] = array_keys($gender);
        $data['chart']['data'] = array_values($gender);
        
        $result = $data;
        
        return response()->json($result);
    }

    /**
     * Return a json with info on genres of video games.
     *
     * @return \Illuminate\Http\Response
     */
    public function genres($eid, Request $request)
    {
        $genres = array();
        
        if ($eid)
        {
            $episode = Episode::where('id', $eid)->firstOrFail();
            $tracks = EpisodeHasTrack::where('episode_uuid', $episode->uuid)->get();
            
            $data['uuid'] = $episode->uuid;
            $data['podcast_uuid'] = $episode->podcast_uuid;
            $data['podcast_name'] = $episode->inPodcast->name;
            $data['season'] = $episode->season;
            $data['number'] = $episode->id;
            $data['title'] = $episode->title;
            $data['aired_on'] = $episode->aired_on->format('d/m/Y');
            $data['duration'] = $episode->duration->format('H:m:i');
            
            foreach($tracks as $track)
            {
                foreach($track->hasGame->hasGenres as $genre)
                {
                    if (!array_key_exists($genre->genre, $genres))
                    {
                        $genres[$genre->genre] = 0;
                    }
                    (int) $genres[$genre->genre]++;
                }
            }
        }
        else
        {
            abort(404);
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
     * Return a json with info on genres of video games.
     *
     * @return \Illuminate\Http\Response
     */
    public function months($eid = 0)
    {
        $i = 1;
        $j = 1;
        $labels = array();
        $datasets = array();
        
        $labels['labels']['January'] = ucfirst(__('app.january'));
        $labels['labels']['February'] = ucfirst(__('app.february'));
        $labels['labels']['March'] = ucfirst(__('app.march'));
        $labels['labels']['April'] = ucfirst(__('app.april'));
        $labels['labels']['May'] = ucfirst(__('app.may'));
        $labels['labels']['June'] = ucfirst(__('app.june'));
        $labels['labels']['July'] = ucfirst(__('app.july'));
        $labels['labels']['August'] = ucfirst(__('app.august'));
        $labels['labels']['September'] = ucfirst(__('app.september'));
        $labels['labels']['October'] = ucfirst(__('app.october'));
        $labels['labels']['November'] = ucfirst(__('app.november'));
        $labels['labels']['December'] = ucfirst(__('app.december'));
        
        $months_array = [
            0 => 'January',
            1 => 'February',
            2 => 'March',
            3 => 'April',
            4 => 'May',
            5 => 'June',
            6 => 'July',
            7 => 'August',
            8 => 'September',
            9 => 'October',
            10 => 'November',
            11 => 'December',
        ];
        
        // Number of birth month for each month
        $datasets['contacts_birth']['label'] = 'Contacts (birth month)';
        $datasets['contacts_birth']['data'][0] = 0;
        $datasets['contacts_birth']['data'][1] = 0;
        $datasets['contacts_birth']['data'][2] = 0;
        $datasets['contacts_birth']['data'][3] = 0;
        $datasets['contacts_birth']['data'][4] = 0;
        $datasets['contacts_birth']['data'][5] = 0;
        $datasets['contacts_birth']['data'][6] = 0;
        $datasets['contacts_birth']['data'][7] = 0;
        $datasets['contacts_birth']['data'][8] = 0;
        $datasets['contacts_birth']['data'][9] = 0;
        $datasets['contacts_birth']['data'][10] = 0;
        $datasets['contacts_birth']['data'][11] = 0;
        
        // Number of death month for each month
        $datasets['contacts_death']['label'] = 'Contacts (death month)';
        $datasets['contacts_death']['data'][0] = 0;
        $datasets['contacts_death']['data'][1] = 0;
        $datasets['contacts_death']['data'][2] = 0;
        $datasets['contacts_death']['data'][3] = 0;
        $datasets['contacts_death']['data'][4] = 0;
        $datasets['contacts_death']['data'][5] = 0;
        $datasets['contacts_death']['data'][6] = 0;
        $datasets['contacts_death']['data'][7] = 0;
        $datasets['contacts_death']['data'][8] = 0;
        $datasets['contacts_death']['data'][9] = 0;
        $datasets['contacts_death']['data'][10] = 0;
        $datasets['contacts_death']['data'][11] = 0;
        
        // Number of games for each month
        $datasets['games']['label'] = 'Games (release month)';
        $datasets['games']['data'][0] = 0;
        $datasets['games']['data'][1] = 0;
        $datasets['games']['data'][2] = 0;
        $datasets['games']['data'][3] = 0;
        $datasets['games']['data'][4] = 0;
        $datasets['games']['data'][5] = 0;
        $datasets['games']['data'][6] = 0;
        $datasets['games']['data'][7] = 0;
        $datasets['games']['data'][8] = 0;
        $datasets['games']['data'][9] = 0;
        $datasets['games']['data'][10] = 0;
        $datasets['games']['data'][11] = 0;
        
        if ($eid === 0)
        {
            $episodes = Episode::all();
            
            // Retrieve data for all episodes
            foreach($episodes as $episode)
            {
                $tracks = EpisodeHasTrack::where('episode_uuid', $episode->uuid)->get();
                
                // Pour les mois de naissance
                foreach ($episode->hasContacts as $contact)
                {
                    // Skip hosts' and producers' podcast.
                    $inStaff = ['Producer', 'Producteur', 'Host', 'Animateur'];
                    $isStaff = $contact->hasProfession->profession;
                    if (Str::of($isStaff)->contains($inStaff))
                    {
                        continue;
                    }
                    
                    // On cherche quelle est la clé du mois, puis on fait +1.
                    // Déjà les mois de naissance
                    if (!$contact->hasContact->born_on)
                    {
                        continue;
                    }
                    else
                    {
                        $month_key = array_search($contact->hasContact->born_on->format('F'), $months_array);
                        (int) $datasets['contacts_birth']['data'][$month_key]++;
                    }
                    
                    // Ensuite les mois de décès
                    if (!$contact->hasContact->died_on)
                    {
                        continue;
                    }
                        else
                    {
                        $month_key = array_search($contact->hasContact->died_on->format('F'), $months_array);
                        (int) $datasets['contacts_death']['data'][$month_key]++;
                    }
                }
            
                // Pour les jeux vidéo
                foreach ($episode->hasTracklist as $track)
                {
                    if (!$track->hasGame->released_on)
                    {
                        continue;
                    }
                
                    // On cherche quelle est la clé du mois, puis on fait +1.
                    $month_key = array_search($track->hasGame->released_on->format('F'), $months_array);
                    (int) $datasets['games']['data'][$month_key]++;
                }
            
                $i++;
            }
        }
        elseif ($eid)
        {
            $episode = Episode::where('id', $eid)->firstOrFail();
            $tracks = EpisodeHasTrack::where('episode_uuid', $episode->uuid)->get();
            
            $data['uuid'] = $episode->uuid;
            $data['podcast_uuid'] = $episode->podcast_uuid;
            $data['podcast_name'] = $episode->inPodcast->name;
            $data['season'] = $episode->season;
            $data['number'] = $episode->id;
            $data['title'] = $episode->title;
            $data['aired_on'] = $episode->aired_on->format('d/m/Y');
            $data['duration'] = $episode->duration->format('H:m:i');

            // Pour les mois de naissance
            foreach ($episode->hasContacts as $contact)
            {
                // Skip hosts' and producers' podcast.
                $inStaff = ['Producer', 'Producteur', 'Host', 'Animateur'];
                $isStaff = $contact->hasProfession->profession;
                if (Str::of($isStaff)->contains($inStaff))
                {
                    continue;
                }
                
                // On cherche quelle est la clé du mois, puis on fait +1.
                // Déjà les mois de naissance
                if (!$contact->hasContact->born_on)
                {
                    continue;
                }
                else
                {
                    $month_key = array_search($contact->hasContact->born_on->format('F'), $months_array);
                    (int) $datasets['contacts_birth']['data'][$month_key]++;
                }
                
                // Ensuite les mois de décès
                if (!$contact->hasContact->died_on)
                {
                    continue;
                }
                else
                {
                    $month_key = array_search($contact->hasContact->died_on->format('F'), $months_array);
                    (int) $datasets['contacts_death']['data'][$month_key]++;
                }
            }
            
            // Pour les jeux vidéo
            foreach ($episode->hasTracklist as $track)
            {
                if (!$track->hasGame->released_on)
                {
                    continue;
                }
                
                // On cherche quelle est la clé du mois, puis on fait +1.
                $month_key = array_search($track->hasGame->released_on->format('F'), $months_array);
                (int) $datasets['games']['data'][$month_key]++;
            }
            
            $i++;
        }
        else
        {
            abort(404);
        }
        
        $data['chart']['labels'] = array_values($labels['labels']);
        $data['chart']['datasets'] = array_values($datasets);
        
        $result = $data;
        
        return response()->json($result);
    }

}