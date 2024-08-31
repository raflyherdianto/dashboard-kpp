<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHistoryPelatihanRequest;
use App\Http\Requests\UpdateHistoryPelatihanRequest;
use App\Models\Department;
use App\Models\HistoryPelatihan;
use App\Models\Pelatihan;
use App\Models\Site;
use App\Models\SubEgi;
use PhpOffice\PhpSpreadsheet\Shared\Date;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;


class HistoryPelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = HistoryPelatihan::all();

        return view('pages.history-pelatihan.index', compact('datas'));
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
        $mekaniks = User::role('Mekanik')->get();
        $instrukturs = User::role('Instruktur')->get();
        $pelatihans = Pelatihan::all();
        $sites = Site::all();
        $departments = Department::all();
        $subEgis = SubEgi::all();
        $rawFile = Excel::toArray([], $request->file('excel'))[0];
        unset($rawFile[0]);
        $datas = [];
        $lowercaseDepartments = $departments->map(function ($department) {
            $department->name = strtolower($department->name);
            return $department;
        });
        foreach ($rawFile as $key => $value) {
            dd($value[9], $subEgis);
            $datas[] = [
                // 'mekanik_id' => $mekaniks->where('nrp', $value[0])->first()->id,
                'site_id' => $sites->where('name', $value[2])->first()->id,
                'department_id' => $departments->filter(function ($department) use ($value) {
                    return stripos(strtolower($department->name), strtolower($value[3])) !== false;
                })->first()->id,
                'location' => $value[5],
                'pelatihan_id' => $pelatihans->where('name', $value[6])->first()->id,
                'start_date' => Date::excelToDateTimeObject($value[7])->format('Y-m-d'),
                'end_date' =>  Date::excelToDateTimeObject($value[8])->format('Y-m-d'),
                // 'sub_egi_id' => $subEgis->filter(function ($subEgi) use ($value) {
                //     return stripos(strtolower($subEgi->name), strtolower('%' . $value[9] . '%')) !== false;
                // })->first()->id,
                'instruktur_id' => $value[10] == null ? null : $instrukturs->where('name', $value[10])->first()->id,
                'status' => $value[11]
            ];

            dd($datas);
        }
        $scores = [];
        Alert::success("Success", "Data has been added");
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mekaniks = User::role('Mekanik')->get();
        $instrukturs = User::role('Instruktur')->get();
        $pelatihans = Pelatihan::all();
        $sites = Site::all();
        $departments = Department::all();
        $locations = ['TC KPP', 'UT', 'Trakindo', 'BINA PERTIWI', 'BANDO', 'IPJ', 'RANT', 'RANTAU', 'PCNS', 'LDSO'];
        return view('pages.history-pelatihan.create', compact(
            'mekaniks',
            'instrukturs',
            'pelatihans',
            'sites',
            'departments',
            'locations'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHistoryPelatihanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HistoryPelatihan $historyPelatihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HistoryPelatihan $historyPelatihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHistoryPelatihanRequest $request, HistoryPelatihan $historyPelatihan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistoryPelatihan $historyPelatihan)
    {
        //
    }
}
