<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMekanikRequest;
use App\Http\Requests\UpdateMekanikRequest;
use App\Models\Mekanik;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

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
        Mekanik::create($data);
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
        //
    }
}
