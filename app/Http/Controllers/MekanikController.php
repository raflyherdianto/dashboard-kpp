<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMekanikRequest;
use App\Http\Requests\UpdateMekanikRequest;
use App\Models\Mekanik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;


class MekanikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreMekanikRequest $request)
    {
        $user = User::where('nrp', $request->mekanik)->first();
        $data = [
            'gl_wali_id' => $request->gl_wali_id,
            'status' => $request->status,
            'section' => strtoupper($request->section),
            'grade' => $request->grade,
            'mekanik_id' => $user->id,
        ];
        $data = Mekanik::create($data);
        Alert::success('Success', 'New data has been created');
        return redirect()->back();
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
        $rawFile = Excel::toArray([], $request->file('excel'))[0];
        unset($rawFile[0]);
        $datas = [];
        foreach ($rawFile as $key => $value) {
            $glwali = User::where('name', $value[6])->first();
            $mekanik_id = User::where('nrp', $value[1])->first();
            if (!$mekanik_id) {
                $user = User::create([
                    'nrp' => $value[1],
                    'name' => $value[2],
                    'email' => strtolower(str_replace(" ", "", $value[2])) . rand(1000, 9999) . "@gmail.com",
                    'password' => Hash::make('password'),
                    'grade' => $value[3]
                ])->assignRole('Mekanik');
            }
            $data = [
                'gl_wali_id' => $glwali->wali[0]->id,
                'mekanik_id' => $mekanik_id->id ?? $user->id,
                'grade' => $value[3],
                'status' => $value[4],
                'section' => $value[5],
            ];

            $datas[] = $data;
        }
        Mekanik::insert($datas);
        Alert::success('Success', 'New data has been created');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Mekanik $mekanik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mekanik $mekanik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMekanikRequest $request, Mekanik $mekanik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mekanik $mekanik)
    {
        $mekanik->delete();
        Alert::success('Success', 'Data has been deleted');
        return redirect()->back();
    }
}
