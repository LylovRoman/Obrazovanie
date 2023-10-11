<?php

namespace App\Http\Controllers\Export;

use App\Exports\ReportsExport;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ReportExportController extends Controller
{
    public function csv()
    {
        return Excel::download(new ReportsExport(), 'reports.csv');
    }

    public function xls()
    {
        return Excel::download(new ReportsExport(), 'reports.xls');
    }

    public function pdf()
    {
        $reports = Report::all();

        return PDF::loadView('pdf.reports', compact('reports'))->download('reports.pdf');
    }
}
