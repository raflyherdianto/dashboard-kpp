<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

use function Pest\Laravel\call;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = User::all();
        return view('pages.users.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            unset($data['password_confirmation']);
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('user', 'public');
            }
            User::create($data);
            Alert::success('Success', 'User has been created');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            if ($user->image && $request->hasFile('image')) {
                Storage::delete('public/' . $user->image);
                $data['image'] = $request->file('image')->store('user', 'public');
            }
            if ($request->has('password')) {
                $data['password'] = Hash::make($data['password']);
                unset($data['password_confirmation']);
            } else {
                unset($data['password']);
                unset($data['password_confirmation']);
            }
            $user->update($data);
            Alert::success('Success', 'User has been updated');
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            if ($user->image) {
                Storage::delete('public/' . $user->image);
            }
            $user->delete();
            Alert::success('Success', 'User has been deleted');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
    }
}
