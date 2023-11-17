<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordRequest;
use App\Models\Record;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== "admin"){
            $records = Auth::user()->records();
        } else {
            $records = Record::query();
        }

        if (isset($_REQUEST['program']) && $_REQUEST['program']){
            $records = $records->where("program", $_REQUEST['program']);
        }
        if (isset($_REQUEST['category']) && $_REQUEST['category']){
            $records = $records->where("category", $_REQUEST['category']);
        }
        if (isset($_REQUEST['profession']) && $_REQUEST['profession']){
            $records = $records->where("profession", $_REQUEST['profession']);
        }
        if (isset($_REQUEST['duration']) && $_REQUEST['duration']){
            $records = $records->where("duration", $_REQUEST['duration']);
        }
        if (isset($_REQUEST['form']) && $_REQUEST['form']){
            $records = $records->where("form", $_REQUEST['form']);
        }
        if (isset($_REQUEST['course']) && $_REQUEST['course']){
            $records = $records->where("course", $_REQUEST['course']);
        }

        $records = $records->where("report_id", Record::getReportId())->with('user')->get();

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

        foreach ($records as $record){
            $sum['KCP'] += $record->KCP;
            $sum['students_all'] += $record->students_all;
            $sum['students_federal'] += $record->students_federal;
            $sum['students_subject'] += $record->students_subject;
            $sum['students_target'] += $record->students_target;
            $sum['students_paid'] += $record->students_paid;
            $sum['students_foreigner'] += $record->students_foreigner;
            $sum['students_orphan'] += $record->students_orphan;
            $sum['students_without_care'] += $record->students_without_care;
            $sum['need'] += $record->need;
            $sum['provided'] += $record->provided;
            $sum['refused'] += $record->refused;
            $sum['release'] += $record->release;
            $sum['GIA'] += $record->GIA;
            $sum['interim_certification'] += $record->interim_certification;
            $sum['basic_level'] += $record->basic_level;
            $sum['professional_level'] += $record->professional_level;
        }

        $report = Report::query()->find(Record::getReportId())->first();

        return view('records.index', compact(['records', 'report', 'sum']));
    }
    public function create()
    {
        return view('records.create');
    }

    public function store(RecordRequest $request)
    {
        Record::create($validated = $request->validated());

        return redirect()->route(  'records.index')->with('success', 'Создана запись.');
    }

    public function show(Record $record)
    {
        $report = Report::query()->find(Record::getReportId())->first();

        $record->with('user');

        return view('records.show', compact(['record', 'report']));
    }

    public function edit(Record $record)
    {
        $record->with('user');

        return view('records.edit', compact('record'));
    }

    public function update(RecordRequest $request, Record $record)
    {
        $record->update($request->validated());

        return redirect()->route('records.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(Record $record)
    {
        $record->delete();
        return redirect()->route('records.index')->with('success', 'Запись удалена.');
    }
}
