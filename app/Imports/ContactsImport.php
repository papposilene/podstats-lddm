<?php

namespace App\Imports;

use App\Contact;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class ContactsImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {

            $uuid       = Uuid::import($row['uuid']);
            $uname      = $row['uname'];
            $gender     = (!empty($row['gender']) ? $row['gender'] : null);
            $fname      = (!empty($row['fname']) ? $row['fname'] : null);
            $mname      = (!empty($row['mname']) ? $row['mname'] : null);
            $lname      = (!empty($row['lname']) ? $row['lname'] : null);
            $profession = (!empty($row['profession']) ? $row['profession'] : $name);
            
            Contact::updateOrCreate(
                [
                    'uuid'          => $uuid,
                ],
                [
                    'uname'         => $uname,
                    'gender'        => $gender,
                    'fname'         => $fname,
                    'mname'         => $mname,
                    'lname'         => $lname,
                    //'created_at'     => now(),
                    //'updated_at'     => now(),
                    //'deleted_at'     => now(),
            ]);
        }
    }
    
    public function chunkSize(): int
    {
        return 100;
    }
    
}
