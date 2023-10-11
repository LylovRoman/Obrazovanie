<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class ReportsExport implements FromQuery
{
    use Exportable;

    public function query()
    {
        return Report::all();
    }
}
