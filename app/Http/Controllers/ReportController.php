<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Models\Educational;
use App\Models\Record;
use App\Models\Report;
use App\Models\ReportUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === "admin"){
            $reports = Report::with('users')->get();
        } else {
            $reports = Auth::user()->reports()->with('users')->get();
        }


        return view('reports.index', compact('reports'));
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
            'name' => $validated['name']
        ]);

        $report_user = [];

        foreach ($validated['user_ids'] as $user_id) {
            $report_user[] = [
                'user_id' => $user_id,
                'report_id' => $report->id
            ];
        }

        ReportUser::query()->insert($report_user);

        return redirect()->route('reports.index');
    }

    public function show(Report $report)
    {
        $recordTypes = [Record::class];
        foreach ($recordTypes as $recordType){
            if ($recordType::getReportId() === $report->id){
                return redirect()->route($recordType::getTableName() . '.index');
            }
        }
        return redirect()->route('reports.index');
    }

    public function edit(Report $report)
    {
        $users = User::query()->where('role', 'user')->get();

        $selectIds = [];

        foreach (Report::query()->with("users")->find($report->id)->users as $user){
            $selectIds[] = $user->id;
        }

        return view('reports.edit', compact(['report', 'users', 'selectIds']));
    }
    public function update(ReportRequest $request, Report $report)
    {
        $validated = $request->validated();

        $report->update([
            'name' => $validated['name']
        ]);

        $report_user = [];

        foreach ($validated['user_ids'] as $user_id) {
            $report_user[] = [
                'user_id' => $user_id,
                'report_id' => $report->id
            ];
        }

        ReportUser::query()->where('report_id', $report->id)->delete();
        ReportUser::query()->insert($report_user);

        return redirect()->route('reports.index');
    }
    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->route('reports.index');
    }
}
