<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEgiRequest;
use App\Http\Requests\UpdateEgiRequest;
use App\Models\Competence;
use App\Models\CompetenceSubCompetence;
use App\Models\Egi;
use App\Models\SubCompetence;
use App\Models\SubEgi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class EgiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Egi::with('competences')->get();
        return view('pages.databank.index', compact('datas'));
    }
    public function isRomanNumeral($str)
    {
        return preg_match('/^[IVXLCDM]+$/', $str);
    }
    public function importData(Request $request)
    {

        $subCompetences = SubCompetence::all();
        if ($request->file('excel') == null) {
            Alert::error('Error', 'File not found');
            return redirect()->back();
        }
        if (!in_array($request->file('excel')->getClientOriginalExtension(), ['xlsx', 'xls', 'csv'])) {
            Alert::error('Error', 'Please upload file in .xlsx, .xls or .csv format');
            return redirect()->back();
        }
        $rawFile = Excel::toArray([], $request->file('excel'));
        $amount = [];
        foreach ($rawFile as $key => $rawOut) {
            unset($rawOut[0]);
            $filteredData = array_filter($rawOut, function ($row) {
                return !empty(array_filter($row, function ($item) {
                    return !is_null($item) && $item !== '';
                }));
            });

            $rawOut = $filteredData;

            $currentCompetence = null;
            $competences = Competence::where('egi_id', $key + 1)->get();


            // Loop through the parsed data
            foreach ($rawOut as $row) {
                $key = $row[0];
                $name = $row[1];

                if (preg_match('/\d/', $key)) {
                    // Find the competence by name
                    // $name = ucwords(strtolower($name));
                    // trim name
                    $name = trim($name);
                    $normalize = function ($str) {
                        return strtolower(preg_replace('/\s+/', ' ', preg_replace('/[^a-zA-Z0-9]/', '', $str)));
                    };

                    $subCompetence = $subCompetences->filter(function ($item) use ($name, $normalize) {
                        return $normalize($item->name) === $normalize($name);
                    })->first();

                    // Prepare the data to be saved
                    if ($currentCompetence && $subCompetence) {
                        $data = [
                            'competence_id' => $currentCompetence->id,
                            'sub_competence_id' => $subCompetence->id,
                            'code' => $key,
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                        $datas[] = [
                            'competence_id' => $currentCompetence->id,
                            'sub_competence_id' => $subCompetence->id,
                            'code' => $key,
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                        $amount[] = $data;
                    } else {

                        dd($currentCompetence, $key, $subCompetence ? $subCompetence->name : null, $name);
                    }
                } else {
                    $currentCompetence = $competences->firstWhere('code', $key);

                    // Find the subcompetence by name
                }
            }
        }
        CompetenceSubCompetence::insert($datas);

        Alert::success('Success', 'New data has been created');
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
    public function store(StoreEgiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Egi $databank)
    {
        $data = $databank;
        $competenceSubCompetence = CompetenceSubCompetence::whereHas('competence', function ($query) use ($data) {
            $query->where('egi_id', $data->id);
        })->get();
        $competences = Competence::where('egi_id', $data->id)->with('competence_sub_competences')->get();
        $subEgis = SubEgi::where('egi_id', $data->id)->get();
        return view('pages.databank.show', compact('data', 'competences', 'subEgis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Egi $egi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEgiRequest $request, Egi $egi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Egi $egi)
    {
        //
    }
}
