<?php

namespace App\Imports;

use App;
use App\Album;
use App\Contact;
use App\ContactHasTrack;
use App\Episode;
use App\EpisodeHasStaff;
use App\EpisodeHasTrack;
use App\ItemHasDetail;
use App\Game;
use App\GameHasStaff;
use App\Podcast;
use App\Profession;
use App\Studio;
use App\Track;
use App\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class TracksImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    public function  __construct(Podcast $podcast, Episode $episode)
    {
        $this->podcast = $podcast;
        $this->episode = $episode;
    }
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $podcast = Podcast::where('name', $row['podcast'])->firstOrFail();
            $episode = Episode::where('id', $row['episode'])->firstOrFail();
            
            $track_id = (!empty($row['track_order']) ? $row['track_order'] : null);
            $game_title = (!empty($row['game_title']) ? $row['game_title'] : null);
            $track_author = (!empty($row['track_author']) ? $row['track_author'] : null);
            $track_title = (!empty($row['track_title']) ? $row['track_title'] : null);
            $track_date = (!empty($row['track_date']) ? $row['track_date'] : '0000-00-00');
            $track_duration = (!empty($row['track_duration']) ? $row['track_duration'] : '00:00:00');
            $track_mbid = (!empty($row['track_mbid']) ? $row['track_mbid'] : null);
            $track_source = (!empty($row['track_source']) ? $row['track_source'] : null);
            $track_type = (!empty($row['track_type']) ? $row['track_type'] : null);
            $profession = (!empty($row['track_guest']) ? $row['track_guest'] : null);
            
            // Create the track
            $track = Track::create(
                [
                    'title' => $track_title
                ],
                [
                    'released_on' => $track_date,
                    'duration' => $track_duration,
                    'mbid' => $track_mbid
                ]);
            
            $game = Game::firstOrCreate(
                [
                    'title' => $game_title
                ]);
            
            // Create and link the author to the profession and episode
            $authors = explode(', ', $track_author);
            foreach($authors as $quidam)
            {
                $people = explode(':', $quidam);
                
                $findProfession = $people[0];
                $findContact = $people[1];
                
                $profession = Profession::where('profession', 'LIKE', '%' . $findProfession . '%')->first();
                $contact = Contact::firstOrCreate(
                    [
                        'uname'         => $findContact
                    ]);

                ContactHasTrack::firstOrCreate(
                    [
                        'contact_uuid'  => $contact->uuid,
                        'track_uuid'    => $track->uuid
                    ]);

                EpisodeHasStaff::firstOrCreate(
                    [
                        'podcast_uuid'      => $podcast->uuid,
                        'episode_uuid'      => $episode->uuid,
                        'contact_uuid'      => $contact->uuid,
                        'profession_uuid'   => $profession->uuid
                    ]);
                
                GameHasStaff::firstOrCreate(
                    [
                        'game_uuid'         => $game->uuid,
                        'contact_uuid'      => $contact->uuid,
                        'profession_uuid'   => $profession->uuid
                    ]);
                
                // Create the relationship between the track and the source
                if($track_source)
                {
                    $has_source = ItemHasDetail::where('data', $track_source)->first();
                    if(empty($has_source))
                    {
                        $track_has_detail = new ItemHasDetail;
                        $track_has_detail->item_uuid     = $track->uuid;
                        $track_has_detail->item_model    = 'album';
                        $track_has_detail->data          = $track_source;
                        $track_has_detail->type          = 'link';
                        $track_has_detail->save();
                    }
                }
            }
            
            EpisodeHasTrack::firstOrCreate(
                [
                    'podcast_uuid'  => $podcast->uuid,
                    'episode_uuid'  => $episode->uuid,
                    'game_uuid'     => $game->uuid,
                    'track_uuid'    => $track->uuid,
                    'track_id'      => $track_id,
                    'track_type'    => $track_type,
                ]);
            // Links finished.
		}
    }
    
    public function chunkSize(): int
    {
        return 100;
    }
    
}
