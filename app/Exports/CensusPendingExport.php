<?php

namespace Solsticio\Exports;

use Solsticio\Census;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;

class CensusPendingExport implements FromQuery
{
    public function __construct(String $status)
    {
        $this->status = $status;
    }

    public function query()
    {
        return Census::query()->whereStatus('status', $this->status);
    }
}
