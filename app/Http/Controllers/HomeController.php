<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function home()
    {
        $usersByGrade = User::role('Mekanik')
            ->select('grade', \DB::raw('count(*) as total'))
            ->whereNotNull('grade')
            ->groupBy('grade')
            ->orderBy('grade', 'asc') // Order by 'grade' in ascending order
            ->get();

        $users = User::role('Mekanik')->with(['position', 'department', 'site', 'roles'])->get();
        $grades = $usersByGrade->pluck('grade')->all();
        $amounts = $usersByGrade->pluck('total')->all();
        return view('welcome', compact('grades', 'amounts', 'users'));
    }
}
