<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRaportRequest;
use App\Http\Requests\UpdateRaportRequest;
use App\Models\Raport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

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

                $user = User::where('nrp', $dataUser['nrp'])->first();
                if (!$user) {
                    dd($dataUser);
                }

                $remainingData = array_slice($rawFile, 15);
            }
        }
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
