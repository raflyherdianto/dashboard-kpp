<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompetence_scoreRequest;
use App\Http\Requests\UpdateCompetence_scoreRequest;
use App\Models\Competence_score;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class CompetenceScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function importData(Request $request)
    {
        if ($request->file('excel') == null) {
            Alert::error('Error', 'File not found');
            return redirect()->back();
        }
        if (!in_array($request->file('excel')->getClientOriginalExtension(), ['xlsx', 'xls', 'csv'])) {
            Alert::error('Error', 'Please upload file in .xlsx, .xls or .csv format');
            return redirect()->back();
        }
        $rawFile = Excel::toArray([], $request->file('excel'));
        dd($rawFile);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompetence_scoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Competence_score $competence_score)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competence_score $competence_score)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompetence_scoreRequest $request, Competence_score $competence_score)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competence_score $competence_score)
    {
        //
    }
}
