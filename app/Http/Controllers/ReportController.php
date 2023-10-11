<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Models\Educational;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $users = User::all();


        if ($user->role === "admin") {
            $reports = Report::all();
        } else {
            $reports = Report::query()->where("user_id", $user->id)->get();
        }


        return view('reports.index', compact(['reports', 'users']));
    }
    public function create()
    {
        $users = User::query()->where('role', 'user')->get();
        return view('reports.create', compact('users'));
    }
    public function store(ReportRequest $request)
    {
        $validated = $request->validated();

        $report = Report::query()->create([
                'name' => $validated['name'],
                'user_id' => $validated['user_id']
        ]);

        $text = "Это новый отчёт.";
        file_put_contents(resource_path('views/reports/contents/content' . $report->id . '.blade.php'), $text);

        return redirect()->route('reports.index');
    }

    public function show(Report $report)
    {
        $report->with('user');
        return view('reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        $users = User::query()->where('role', 'user')->get();

        return view('reports.edit', compact(['report', 'users']));
    }
    public function update(ReportRequest $request, Report $report)
    {
        $validated = $request->validated();

        $report->update([
            'name' => $validated['name'],
            'user_id' => $validated['user_id']
        ]);

        return redirect()->route('reports.index');
    }
    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->route('reports.index');
    }
}
