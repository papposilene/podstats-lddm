<?php

namespace App\Imports;

use App;
use App\Contact;
use App\ItemHasDetail;
use App\Episode;
use App\EpisodeHasStaff;
use App\Podcast;
use App\Profession;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class EpisodesImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    public function  __construct(Podcast $podcast)
    {
        $this->podcast = $podcast;
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
            $season         = (!empty($row['season']) ? $row['season'] : '0');
            $id             = (!empty($row['episode_id']) ? $row['episode_id'] : null);
            $title          = (!empty($row['episode_title']) ? $row['episode_title'] : null);
            $staff          = (!empty($row['episode_staff']) ? $row['episode_staff'] : null);
            $aired_on       = (!empty($row['episode_date']) ? $row['episode_date'] : '0000-00-00');
            $duration       = (!empty($row['episode_duration']) ? $row['episode_duration'] : '00:00:00');
            $description    = (!empty($row['episode_description']) ? $row['episode_description'] : null);
            $source         = (!empty($row['episode_source']) ? $row['episode_source'] : null);
            
            $podcast        = Podcast::where('name', $row['podcast'])->firstOrFail();
            
            // Create the episode
            $episode = Episode::firstOrCreate(
                [
                    'podcast_uuid'  => $podcast->uuid,
                    'title'         => $title,
                    'id'            => $id
                ],
                [
                    'season'        => $season,
                    'aired_on'      => $aired_on,
                    'duration'      => $duration,
                    'description'   => $description
                ]
            );
            
            // Create the relation between the episode and the staff (host producer, guest, etc.)
            $staffs = explode(', ', $staff);
            foreach($staffs as $quidam)
            {
                $people = explode(':', $quidam);
                
                $findProfession = $people[0];
                $findContact = $people[1];
                
                $profession = Profession::where('profession', 'LIKE', '%' . $findProfession . '%')->first();
                
                $contact = Contact::firstOrCreate(
                    [
                        'uname'         => $findContact
                    ]);
                
                EpisodeHasStaff::create(
                    [
                        'podcast_uuid'      => $podcast->uuid,
                        'episode_uuid'      => $episode->uuid,
                        'contact_uuid'      => $contact->uuid,
                        'profession_uuid'   => $profession->uuid
                    ]);
            }
            
            // Create the relation between the episode and the source
            $item_has_detail = new ItemHasDetail;
            $item_has_detail->item_uuid = $episode->uuid;
            $item_has_detail->item_model = 'episode';
            $item_has_detail->data = $source;
            $item_has_detail->type = 'link';
            $item_has_detail->save();
            
        }
    }
    
    public function chunkSize(): int
    {
        return 100;
    }
    
}
