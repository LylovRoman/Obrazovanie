<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvalidRequest;
use App\Models\Invalid;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class InvalidController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== "admin"){
            $invalids = Auth::user()->invalids()->where("report_id", Invalid::getReportId())->with('user')->get();
        } else {
            $invalids = Invalid::query()->where("report_id", Invalid::getReportId())->with('user')->get();
        }

        $sum['KCP'] = 0;
        $sum['students_all'] = 0;
        $sum['students_federal'] = 0;
        $sum['students_subject'] = 0;
        $sum['students_target'] = 0;
        $sum['students_paid'] = 0;
        $sum['students_foreigner'] = 0;
        $sum['students_orphan'] = 0;
        $sum['students_without_care'] = 0;
        $sum['need'] = 0;
        $sum['provided'] = 0;
        $sum['refused'] = 0;
        $sum['release'] = 0;
        $sum['GIA'] = 0;
        $sum['interim_certification'] = 0;
        $sum['basic_level'] = 0;
        $sum['professional_level'] = 0;

        foreach ($invalids as $invalid){
            $sum['KCP'] += $invalid->KCP;
            $sum['students_all'] += $invalid->students_all;
            $sum['students_federal'] += $invalid->students_federal;
            $sum['students_subject'] += $invalid->students_subject;
            $sum['students_target'] += $invalid->students_target;
            $sum['students_paid'] += $invalid->students_paid;
            $sum['students_foreigner'] += $invalid->students_foreigner;
            $sum['students_orphan'] += $invalid->students_orphan;
            $sum['students_without_care'] += $invalid->students_without_care;
            $sum['need'] += $invalid->need;
            $sum['provided'] += $invalid->provided;
            $sum['refused'] += $invalid->refused;
            $sum['release'] += $invalid->release;
            $sum['GIA'] += $invalid->GIA;
            $sum['interim_certification'] += $invalid->interim_certification;
            $sum['basic_level'] += $invalid->basic_level;
            $sum['professional_level'] += $invalid->professional_level;
        }

        $report = Report::query()->find(Invalid::getReportId())->first();

        return view('invalids.index', compact(['invalids', 'report', 'sum']));
    }
    public function create()
    {
        return view('invalids.create');
    }

    public function store(InvalidRequest $request)
    {
        Invalid::create($validated = $request->validated());

        return redirect()->route(  'invalids.index')->with('success', 'Создана запись.');
    }

    public function show(Invalid $invalid)
    {
        $report = Report::query()->find(Invalid::getReportId())->first();

        $invalid->with('user');

        return view('invalids.show', compact(['invalid', 'report']));
    }

    public function edit(Invalid $invalid)
    {
        $invalid->with('user');

        return view('invalids.edit', compact('invalid'));
    }

    public function update(InvalidRequest $request, Invalid $invalid)
    {
        $invalid->update($request->validated());

        return redirect()->route('invalids.index')->with('success', 'Invalid updated successfully.');
    }

    public function destroy(Invalid $invalid)
    {
        $invalid->delete();
        return redirect()->route('invalids.index')->with('success', 'Запись удалена.');
    }
}
