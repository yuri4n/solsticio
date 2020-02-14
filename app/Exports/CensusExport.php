<?php

namespace App\Exports;

use App\Census;
use Maatwebsite\Excel\Concerns\FromCollection;

class CensusExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Census::all();
    }
}
