<?php

use App\Contact;
use App\ContactDetail;
use App\Profession;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Drop the table
        DB::table('contacts')->delete();
        DB::table('contacts_details')->delete();
        // Seed the table
        // File contacts.json is stored in ./database/data/contacts
        $jsonFile = File::get('database/data/contacts/contacts.json');
        $jsonData = json_decode($jsonFile);
		
        foreach ($jsonData as $data)
        {
            $gender         = (filled($data->gender) ? strtolower($data->gender) : 'neutral');
            $profession     = (filled($data->profession) ? Str::slug($data->profession, '_') : null);
            $title          = Title::where('ltitle', 'like', "%$data->title%")->first();
            $uname          = (filled($data->uname) ? addslashes($data->uname) : null);
            
            // Profession: check and creation...
            Profession::insertOrIgnore(['profession' => $profession]);
            // Profession: created!
            
            // Contact : creation...
            Contact::create([
                'gender'        => $gender,
                'profession'    => $profession,
                'title'         => $title->uuid,
                'uname'         => $uname
            ]);
            // Contact: created!
        }
    }
}
