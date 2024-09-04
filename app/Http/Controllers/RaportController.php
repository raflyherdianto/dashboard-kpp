<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRaportRequest;
use App\Http\Requests\UpdateRaportRequest;
use App\Models\Competence;
use App\Models\CompetenceSubCompetence;
use App\Models\Department;
use App\Models\Egi;
use App\Models\Raport;
use App\Models\RaportDetail;
use App\Models\Site;
use App\Models\SubCompetence;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use RealRashid\SweetAlert\Facades\Alert;

class RaportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Raport::all();
        return view('pages.raport.index', compact('datas'));
    }

    public function importData(Request $request)
    {
        if ($request->excel) {
            $excels = $request->excel;
            foreach ($excels as $excel) {
                $rawFile = Excel::toArray([], $excel)[0];
                unset($rawFile[0]);
                unset($rawFile[1]);

                $dataUserRows = array_slice($rawFile, 0, 13);

                $dataUser = [];
                $grade = null;

                for ($i = 0; $i < count($dataUserRows); $i++) {
                    $cleanedRow = array_filter($dataUserRows[$i], function ($value) {
                        return !is_null($value);
                    });

                    if (in_array('GRADE', $cleanedRow)) {
                        $gradeRow = array_filter($rawFile[$i + 3], function ($value) {
                            return !is_null($value);
                        });
                        if (isset($gradeRow[7])) {
                            $grade = $gradeRow[7];
                        }
                    }

                    if (count($cleanedRow) > 0) {
                        if (isset($cleanedRow[1]) && isset($cleanedRow[6])) {
                            $key = strtolower($cleanedRow[1]);
                            $value = $cleanedRow[6];
                            $dataUser[$key] = $value;
                        }
                    }
                }

                if ($grade) {
                    $dataUser['grade'] = $grade;
                }





                $remainingData = array_slice($rawFile, 14);
                unset($remainingData[0]);
                foreach ($remainingData as $index => $row) {
                    if (isset($row[8]) && $row[8] === 'TOTAL') {
                        unset($remainingData[$index]);
                    }
                }
                $cleanedData = [];

                foreach ($remainingData as $row) {
                    if (count(array_filter($row, function ($value) {
                        return !is_null($value);
                    })) === 0) {
                        continue;
                    }

                    $data = [
                        'nrp' => isset($row[1]) ? $row[1] : null,
                        'egi' => isset($row[2]) ? $row[2] : null,
                        'competence' => isset($row[5]) ? $row[5] : null,
                        'sub_competence' => isset($row[9]) ? $row[9] : null,
                        'tahun' => isset($row[11]) ? $row[11] : null,
                        'poin' => isset($row[13]) ? $row[13] : null,
                    ];

                    if (count(array_filter($data, function ($value) {
                        return !is_null($value);
                    })) > 0) {
                        $cleanedData[] = $data;
                    }
                }
                $userSite = Site::where('name', $dataUser['jobsite'])->first();
                $userSection = Department::where('name', $dataUser['section'])->first();
                if (!$userSite || !$userSection) {
                    Alert::error('Error', 'Site or Section not found');
                    return redirect()->back();
                }
                $user = User::where('nrp', $dataUser['nrp'])->first();
                $processedUserData = [
                    'mekanik_id' => $user->id,
                    'grade' => $dataUser['grade'],
                    'site_id' => $userSite->id,
                    'section_id' => $userSection->id,
                    'year' => $dataUser['tahun'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]; // !CLEAR
                $raport = Raport::create($processedUserData);
                $datas = [];
                foreach ($cleanedData as $key => $value) {
                    try {
                        $egi = Egi::where('name', 'like', '%' . $value['egi'] . '%')->first();
                        if (!$egi) {
                            Alert::error('Error', 'Egi not found');
                            return redirect()->back();
                        }
                        // Cek apakah kompetensi mengandung '&'
                        $competenceValue = $value['competence'];
                        if ($competenceValue == 'REMOVE INSTALL') {
                            $competenceValue = 'REMOVE';
                        }
                        $competence = Competence::where('name', 'LIKE', '%' . $competenceValue . '%')
                            ->where('egi_id', $egi->id)
                            ->first();
                        $competenceSubCompetence = CompetenceSubCompetence::where('competence_id', $competence->id)->get();
                        $subCompetenceQuery = SubCompetence::where('name', $value['sub_competence'])->first();
                        if (!$subCompetenceQuery) {
                            $subCompetenceQuery = SubCompetence::create([
                                'name' => $value['sub_competence'],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                        $subCompetence = $competenceSubCompetence->where('sub_competence_id', $subCompetenceQuery->id)->first();
                        $datas[] = [
                            'raport_id' => $raport->id,
                            'egi_id' => $egi->id,
                            'competence_id' => $competence->id,
                            'sub_competence_id' => $subCompetenceQuery->id,
                            'year' => $value['tahun'],
                            'point' => $value['poin'],
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    } catch (\Throwable $th) {
                        dd($value, $th);
                    }
                }
                RaportDetail::insert($datas);
            }
        }
        Alert::success('Success', 'Data has been saved');
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
    public function store(StoreRaportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Raport $raport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Raport $raport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRaportRequest $request, Raport $raport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Raport $raport)
    {
        //
    }
}
