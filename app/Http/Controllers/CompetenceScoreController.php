<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompetence_scoreRequest;
use App\Http\Requests\UpdateCompetence_scoreRequest;
use App\Models\Competence_score;
use App\Models\CompetenceSubCompetence;
use App\Models\SubCompetence;
use App\Models\SubEgi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $scores = [];
        foreach ($rawFile as $key => $rawOut) {
            unset($rawOut[0]);
            $competenceSubCompetence = CompetenceSubCompetence::whereHas('competence', function ($query) use ($key) {
                $query->where('egi_id', $key + 1);
            })->get();


            foreach ($competenceSubCompetence as $in => $value) {
                try {
                    foreach ($rawOut[$in + 1] as $index => $row) {
                        $scores[] = [
                            'competence_sub_competence_id' => $value->id,
                            'score' => $row ?? 0,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                } catch (\Throwable $th) {
                    dd($th,  $value, $rawOut, $competenceSubCompetence);
                }
            }
        }
        DB::table('competence_scores')->insert($scores);
        Alert::success("Success", "Data has been added");
        return redirect()->back();
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
