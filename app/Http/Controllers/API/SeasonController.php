<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Country;
use App\Episode;
use App\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SeasonController extends Controller
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
     * Return a json with info on genres of video games.
     *
     * @return \Illuminate\Http\Response
     */
    public function months($season)
    {
        $i = 1;
        $j = 1;
        $labels = array();
        $datasets = array();
        $episodes = Episode::where('season', $season)->orderBy('id', 'asc')->get();
        
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
        
        $data['season'] = $season;
        
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

        foreach ($episodes as $episode)
        {
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
        
        $data['chart']['labels'] = array_values($labels['labels']);
        $data['chart']['datasets'] = array_values($datasets);
        
        $result = $data;
        
        return response()->json($result);
    }
    
    /**
     * Return a json with info on genres of video games.
     *
     * @return \Illuminate\Http\Response
     */
    public function stats($season)
    {
        $i = 1;
        $j = 1;
        $labels = array();
        $datasets = array();
        $episodes = Episode::where('season', $season)->orderBy('id', 'asc')->get();
        
        $data['season'] = $season;
        
        foreach ($episodes as $episode)
        {
            $labels['labels'][$i] = $episode->title;
            
            $datasets['contacts']['label'] = 'Contacts';
            $datasets['contacts']['data'][$i] = 0;
            foreach ($episode->hasContacts as $staff)
            {
                // Skip hosts' and producers' podcast.
                $inStaff = ['Producer', 'Producteur', 'Host', 'Animateur'];
                $isStaff = $staff->hasProfession->profession;
                if (Str::of($isStaff)->contains($inStaff))
                {
                    continue;
                }
                
                (int) $datasets['contacts']['data'][$i]++;
            }
            
            (int) $datasets['tracks']['data'][$i] = count($episode->hasTracklist);
            
            $i++;
        }
        
        foreach ($episodes as $episode)
        {
            $datasets['tracks']['label'] = 'Tracks';
            $datasets['tracks']['data'][$j] = 0;
            
            (int) $datasets['tracks']['data'][$j] = count($episode->hasTracklist);
            
            $j++;
        }
        
        $data['chart']['labels'] = array_values($labels['labels']);
        $data['chart']['datasets'] = array_values($datasets);
        
        $result = $data;
        
        return response()->json($result);
    }
}
