<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGlWaliRequest;
use App\Http\Requests\UpdateGlWaliRequest;
use App\Models\GlWali;
use App\Models\User;

class GlWaliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = GlWali::with('mekaniks', 'user')->get();
        return view('pages.glwali.index', compact('datas'));
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
    public function store(StoreGlWaliRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GlWali $glwali)
    {
        $data = $glwali;
        $mekanikIds = $data->mekaniks->pluck('mekanik_id')->toArray();
        $mekaniks = User::role('Mekanik')
            ->whereNotIn('id', $mekanikIds)
            ->get();
        return view('pages.glwali.show', compact('data', 'mekaniks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GlWali $glWali)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGlWaliRequest $request, GlWali $glWali)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GlWali $glWali)
    {
        //
    }
}
