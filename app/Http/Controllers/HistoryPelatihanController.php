<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHistoryPelatihanRequest;
use App\Http\Requests\UpdateHistoryPelatihanRequest;
use App\Models\Department;
use App\Models\HistoryPelatihan;
use App\Models\Pelatihan;
use App\Models\Site;
use App\Models\User;

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
