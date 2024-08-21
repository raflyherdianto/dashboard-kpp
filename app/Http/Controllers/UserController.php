<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Department;
use App\Models\GlWali;
use App\Models\Position;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $datas = User::with(['position', 'department', 'site', 'wali', 'mekanik'])->get();
        return view('pages.users.index', compact('datas'));
    }

    public function importData(Request $request)
    {
        try {
            if ($request->file('excel') == null) {
                Alert::error('Error', 'File not found');
                return redirect()->back();
            }
            if (!in_array($request->file('excel')->getClientOriginalExtension(), ['xlsx', 'xls', 'csv'])) {
                Alert::error('Error', 'Please upload file in .xlsx, .xls or .csv format');
                return redirect()->back();
            }

            $positions = Position::all();
            $departments = Department::all();
            $sites = Site::all();
            $rawFile = Excel::toArray([], $request->file('excel'))[0];
            unset($rawFile[0]);

            foreach ($rawFile as $key => $value) {
                $position = $positions->firstWhere('name', $value[5]);
                $site = $sites->firstWhere('name', $value[6]);
                $department = $departments->firstWhere('name', $value[7]);
                $email = strtolower(str_replace(" ", "", $value[1])) . "@gmail.com";
                $existingUser = User::where('email', $email)->first();

                if ($existingUser) {
                    continue;
                }

                $data = [
                    'nrp' => $value[0],
                    'name' => $value[1],
                    'email' => $email,
                    'password' => Hash::make('password'),
                    'status' => $value[2],
                    'grade' => $value[3],
                    'promotion_date' => Date::excelToDateTimeObject($value[4])->format('Y-m-d'),
                    'position_id' => $position->id ?? null,
                    'site_id' => $site->id ?? null,
                    'department_id' => $department->id ?? null,
                    'education' => trim($value[8])
                ];

                User::create($data)->assignRole('Mekanik');
            }

            Alert::success('Success', 'Data has been imported');
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            Alert::error('Error', 'An error occurred while importing data: ' . $th->getMessage());
            return redirect()->route('users.index');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::all();
        $departments = Department::all();
        $sites = Site::all();
        $roles = Role::all();
        return view('pages.users.create', compact('positions', 'departments', 'sites', 'roles'));
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
            $role = $data['role'];
            unset($data['role']);
            if($role == 'Gl Wali'){
                $user = User::create($data)->assignRole($role);
                GlWali::create([
                    'wali_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }else {
                User::create($data)->assignRole($role);
            }
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
            if($user->roles[0]->name){
                $glwali = GlWali::where('wali_id', $user->id)->first();
                $glwali->delete();
            }
            $user->delete();
            Alert::success('Success', 'User has been deleted');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
    }
}
