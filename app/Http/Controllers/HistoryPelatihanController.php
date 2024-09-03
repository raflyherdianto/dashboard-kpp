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
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;


class HistoryPelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = HistoryPelatihan::with(['mekanik.roles', 'instruktur', 'site', 'department', 'pelatihan'])->get();
        return view('pages.history-pelatihan.index', compact('datas'));
    }

    private function replaceIndonesianMonthNames($dateString)
    {
        $indonesianMonths = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $englishMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        return str_replace($indonesianMonths, $englishMonths, $dateString);
    }

    public function importData(Request $request)
    {
        // Your existing importData logic...
        if ($request->file('excel') == null) {
            Alert::error('Error', 'File not found');
            return redirect()->back();
        }
        if (!in_array($request->file('excel')->getClientOriginalExtension(), ['xlsx', 'xls', 'csv'])) {
            Alert::error('Error', 'Please upload file in .xlsx, .xls or .csv format');
            return redirect()->back();
        }

        $pelatihans = Pelatihan::all();
        $sites = Site::all();
        $departments = Department::all();
        $rawFile = Excel::toArray([], $request->file('excel'))[0];
        unset($rawFile[0]);
        $datas = [];

        foreach ($rawFile as $key => $value) {
            // Cek Mekanik secara langsung di database
            $mekanik = User::where('nrp', $value[0])->whereHas('roles', function ($q) {
                $q->where('name', 'Mekanik');
            })->first();

            if ($mekanik == null) {
                $mekanik = User::create([
                    'nrp' => $value[0],
                    'name' => $value[1],
                    'email' => strtolower(str_replace(" ", "", $value[1])) . rand(1000, 9999) . "@gmail.com",
                    'password' => Hash::make('password'),
                ])->assignRole('Mekanik');
            }

            // Cek Instruktur secara langsung di database
            if ($value[10] != null) {
                $instruktur = User::where('name', $value[10])->whereHas('roles', function ($q) {
                    $q->where('name', 'Instruktur');
                })->first();

                if ($instruktur == null) {
                    // Generate unique NRP
                    do {
                        $randomNrp = Str::random(5) . mt_rand(100, 999);
                    } while (User::where('nrp', $randomNrp)->exists());

                    $instruktur = User::create([
                        'nrp' => $randomNrp,
                        'name' => $value[10],
                        'email' => strtolower(str_replace(" ", "", $value[10])) . rand(1000, 9999) . "@gmail.com",
                        'password' => Hash::make('password'),
                    ])->assignRole('Instruktur');
                }
            } else {
                $instruktur = null;
            }

            $pelatihan = Pelatihan::where('name', 'LIKE', '%' . $value[6] . '%')->first();

            if (is_numeric($value[7])) {
                $startDate = Date::excelToDateTimeObject($value[7])->format('Y-m-d');
            } else {
                $startDate = Carbon::parse($this->replaceIndonesianMonthNames($value[7]))->format('Y-m-d');
            }

            // Handle end date
            if (is_numeric($value[8])) {
                $endDate = Date::excelToDateTimeObject($value[8])->format('Y-m-d');
            } else {
                $endDate = Carbon::parse($this->replaceIndonesianMonthNames($value[8]))->format('Y-m-d');
            }

            try {
                $datas[] = [
                    'mekanik_id' => $mekanik->id,
                    'site_id' => $sites->where('name', $value[2])->first()->id ?? null,
                    'department_id' => ($departments->filter(function ($department) use ($value) {
                        return stripos(strtolower($department->name), strtolower($value[3])) !== false;
                    })->first()->id ?? null) ?: null,
                    'location' => $value[5],
                    'pelatihan_id' => $pelatihan->id ?? null,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'sub_egi' => $value[9] == null ? null : $value[9],
                    'instruktur_id' => $instruktur->id ?? null,
                    'status' => strtoupper($value[11])
                ];
            } catch (\Throwable $th) {
                dd($th, $value, $departments, $pelatihan);
            }
        }

        HistoryPelatihan::insert($datas);
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
        $data = $request->all();
        $mekanik = User::where('nrp', $request->mekanik_id)->first();
        $instruktur = User::where('nrp', $request->instruktur_id)->first();
        $pelatihan = Pelatihan::where('name', $request->pelatihan_id)->first();
        $data['mekanik_id'] = $mekanik->id;
        $data['instruktur_id'] = $instruktur->id;
        $data['pelatihan_id'] = $pelatihan->id;
        unset($data['_token']);
        HistoryPelatihan::create($data);
        Alert::success("Success", "Data has been added");
        return redirect()->route('history-pelatihan.index');
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
        $mekaniks = User::role('Mekanik')->get();
        $instrukturs = User::role('Instruktur')->get();
        $pelatihans = Pelatihan::all();
        $sites = Site::all();
        $departments = Department::all();
        $data = $historyPelatihan;
        $locations = ['TC KPP', 'UT', 'Trakindo', 'BINA PERTIWI', 'BANDO', 'IPJ', 'RANT', 'RANTAU', 'PCNS', 'LDSO'];

        return view('pages.history-pelatihan.edit', compact(
            'mekaniks',
            'instrukturs',
            'pelatihans',
            'sites',
            'departments',
            'locations',
            'data'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHistoryPelatihanRequest $request, HistoryPelatihan $historyPelatihan)
    {
        $data = $request->all();
        $mekanik = User::where('nrp', $request->mekanik_id)->first();
        $instruktur = User::where('nrp', $request->instruktur_id)->first();
        $pelatihan = Pelatihan::where('name', $request->pelatihan_id)->first();
        $data['mekanik_id'] = $mekanik->id;
        $data['instruktur_id'] = $instruktur->id;
        $data['pelatihan_id'] = $pelatihan->id;
        unset($data['_token']);
        unset($data['_method']);
        $historyPelatihan->update($data);
        Alert::success("Success", "Data has been updated");
        return redirect()->route('history-pelatihan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistoryPelatihan $historyPelatihan)
    {
        try {
            $historyPelatihan->delete();
            Alert::success("Success", "Data has been deleted");
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error("Error", $th->getMessage());
            return redirect()->back();
        }
    }
}
