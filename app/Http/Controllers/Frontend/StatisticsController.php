<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Console;
use App\Contact;
use App\Country;
use App\Episode;
use App\EpisodeHasStaff;
use App\EpisodeHasTrack;
use App\Game;
use App\Genre;
use App\ItemHasDetail;
use App\Manufacturer;
use App\Podcast;
use App\Profession;
use App\Studio;
use App\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StatisticsController extends Controller
{
    /**
     * Display the statistics for the specified resource.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function contacts()
    {   
        $contacts = Contact::all();
        $episodes = EpisodeHasStaff::all();
        $top20 = EpisodeHasStaff::selectRaw('count(*) AS contact_count, contact_uuid')->orderBy('contact_count', 'desc')->groupBy('contact_uuid')->skip(3)->limit(20)->get();
        // On retire les trois premiers résultats parce que ce seront nécessairement les tenanciers du podcast
        
        return view('public.statistics.contact',
            compact(
                'contacts',
                'episodes',
                'top20'
            )
        );
    }
    
    public function countries()
    {   
        $countries = Country::orderBy('cca3', 'asc')->get();
        $contacts = Contact::all();
        $manufacturers = Manufacturer::all();
        $studios = Studio::all();
        
        $countries_has_contacts = array();
        $continents_has_contact = array();
        $continents_has_contacts['Africa'] = 0;
        $continents_has_contacts['Americas'] = 0;
        $continents_has_contacts['Antarctic'] = 0;
        $continents_has_contacts['Asia'] = 0;
        $continents_has_contacts['Europe'] = 0;
        $continents_has_contacts['Oceania'] = 0;
        $regions_has_contacts = array();
        $regions_has_contacts['Africa']['Eastern Africa'] = 0;
        $regions_has_contacts['Africa']['Middle Africa'] = 0;
        $regions_has_contacts['Africa']['Northern Africa'] = 0;
        $regions_has_contacts['Africa']['Southern Africa'] = 0;
        $regions_has_contacts['Africa']['Western Africa'] = 0;
        $regions_has_contacts['Americas']['Caribbean'] = 0;
        $regions_has_contacts['Americas']['Central America'] = 0;
        $regions_has_contacts['Americas']['North America'] = 0;
        $regions_has_contacts['Americas']['South America'] = 0;
        $regions_has_contacts['Asia']['Central Asia'] = 0;
        $regions_has_contacts['Asia']['Eastern Asia'] = 0;
        $regions_has_contacts['Asia']['South-Eastern Asia'] = 0;
        $regions_has_contacts['Asia']['Southern Asia'] = 0;
        $regions_has_contacts['Asia']['Western Asia'] = 0;
        $regions_has_contacts['Europe']['Eastern Europe'] = 0;
        $regions_has_contacts['Europe']['Central Europe'] = 0;
        $regions_has_contacts['Europe']['Northern Europe'] = 0;
        $regions_has_contacts['Europe']['Southern Europe'] = 0;
        $regions_has_contacts['Europe']['Western Europe'] = 0;
        $regions_has_contacts['Oceania']['Australia and New Zealand'] = 0;
        $regions_has_contacts['Oceania']['Melanesia'] = 0;
        $regions_has_contacts['Oceania']['Micronesia'] = 0;
        $regions_has_contacts['Oceania']['Polynesia'] = 0;
        
        foreach($countries as $country)
        {
            $contactsLiveAt = Contact::where('lives_at', $country->uuid)->get();
            foreach($contactsLiveAt as $contact)
            {
                // Pays
                if (!array_key_exists($country->cca3, $countries_has_contacts))
                {
                    $countries_has_contacts[$country->cca3] = 0;
                }
                (int) $countries_has_contacts[$country->cca3]++;
                
                // Continents
                (int) $continents_has_contacts[$country->region]++;
                
                // Regions
                (int) $regions_has_contacts[$country->region][$country->subregion]++;
            }            
        }
        
        //dd($countries_has_contacts);
        //dd($continents_has_contacts);
        //dd($regions_has_contacts);
        
        return view('public.statistics.country',
            compact(
                'countries',
                'contacts',
                'countries_has_contacts',
                'continents_has_contacts',
                'regions_has_contacts',
                'manufacturers',
                'studios'
            )
        );
    }
    
    public function episodes()
    {   
        $podcast = Podcast::first();
        $episodes = Episode::where('podcast_uuid', $podcast->uuid)->orderBy('id', 'desc')->get();
        $seasons = Episode::where('podcast_uuid', $podcast->uuid)->selectRaw('count(*) AS season_id, season')->orderBy('season', 'desc')->groupBy('season')->get();
        $durations = Episode::where('podcast_uuid', $podcast->uuid)->orderBy('duration')->get();
        $consoles = Console::all();
        $contacts = Contact::all();
        $games = Game::all();
        $tracks = Track::all();
        
        return view('public.statistics.episode',
            compact(
                'consoles',
                'contacts',
                'durations',
                'episodes',
                'games',
                'podcast',
                'seasons',
                'tracks'
            )
        );
    }
    
    public function seasons($season = 0)
    {
        
        if ($season === 0)
        {
            $podcast = Podcast::first();
            $seasons = Episode::where('podcast_uuid', $podcast->uuid)->orderBy('season', 'asc')->selectRaw('count(*) AS season_id, season')->groupBy('season')->get();
            
            return view('public.statistics.seasons',
                compact(
                    'seasons'
                )
            );
        }
        else
        {
            $podcast = Podcast::first();
            $episodes = Episode::where([['podcast_uuid', $podcast->uuid], ['season', $season]])->orderBy('id', 'desc')->get();
            $durations = Episode::where([['podcast_uuid', $podcast->uuid], ['season', $season]])->orderBy('duration')->get();
            $contacts = Contact::all();
            
            $season_has_consoles = array();
            $season_has_contacts = array();
            $season_has_games = array();
            $season_has_tracks = array();
            
            $i = 1;
            $season_has_consoles[0] = 0;
            $season_has_contacts[0] = 0; 
            $season_has_games[0] = 0;
            $season_has_tracks[0] = 0;
            foreach($episodes as $episode)
            {
                // Create an array with all the contacts for a season.
                $contacts = EpisodeHasStaff::where('episode_uuid', $episode->uuid)->get();
                $season_has_contacts[$i] = null;
                foreach($contacts as $contact)
                {
                    $inStaff = ['Producer', 'Producteur', 'Host', 'Animateur'];
                    $isStaff = $contact->hasProfession->profession;
                    if (Str::of($isStaff)->contains($inStaff))
                    {
                        continue;
                    }
                    $season_has_contacts[$i]++;
                }
                $season_has_contacts[0] += $season_has_contacts[$i];
                    
                // Create an array with all the games for a season.
                $episode_has_data = EpisodeHasTrack::where('episode_uuid', $episode->uuid)->get();
                $season_has_games[$i] = 0;
                foreach($episode_has_data as $game)
                {
                    $season_has_games[$i]++;
                }
                $season_has_games[0] += $season_has_games[$i];
            
                $i++;
            }
        
            //dd($season_has_consoles);
            //dd($season_has_contacts);
            //dd($season_has_games['season1']);
        
            return view('public.statistics.season',
                compact(
                    'contacts',
                    'durations',
                    'episodes',
                    'podcast',
                    'season',
                    'season_has_consoles',
                    'season_has_contacts',
                    'season_has_games'
                )
            );
        }
    }
    
    public function games()
    {
        $games = Game::all();
        $top20Games = EpisodeHasTrack::selectRaw('count(*) AS game_count, game_uuid')->orderBy('game_count', 'desc')->groupBy('game_uuid')->skip(1)->limit(20)->get();
        // On retire les trois premiers résultats parce que ce sera nécessairement le Untitled Game.
        
        return view('public.statistics.game',
            compact(
                'games',
                'top20Games'
            )
        );
    }
    
    public function manufacturers()
    {   
        abort(404);
        
        return view('public.statistics.manufacturer',
            compact(
                'tracks'
            )
        );
    }
    
    public function studios()
    {
        $studios = Studio::all();
        $games = Game::all();
        $top20Studios = Game::whereNotNull('studio_uuid')->selectRaw('count(*) AS studio_count, studio_uuid')->orderBy('studio_count', 'desc')->groupBy('studio_uuid')->limit(20)->get();
        
        return view('public.statistics.studio',
            compact(
                'games',
                'studios',
                'top20Studios'
            )
        );
    }
    
    public function tracks()
    {   
        abort(404);
        
        return view('public.statistics.track',
            compact(
                'tracks'
            )
        );
    }
}
