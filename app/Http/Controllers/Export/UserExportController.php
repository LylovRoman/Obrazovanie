<?php

namespace App\Http\Controllers\Export;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class UserExportController extends Controller
{
    public function csv()
    {
        return Excel::download(new UsersExport(), 'users.csv');
    }

    public function xls()
    {
        return Excel::download(new UsersExport(), 'users.xls');
    }

    public function pdf()
    {
        $users = User::all();

        return PDF::loadView('pdf.users', compact('users'))->download('users.pdf');
    }
}
