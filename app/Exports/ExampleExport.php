<?php

namespace App\Exports;

use App\Example;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExampleExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Example::all();
    }
}
