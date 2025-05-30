<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        checkRole('super-admin');

        $users = User::with('company')->get();

        $roleCounts = $users->groupBy('role')->map(fn($group) => $group->count());

        return view('superadmin.dashboard', [
            'users' => $users,
            'totalUsers' => $users->count(),
            'totalCompanies' => Company::count(),
            'roleLabels' => $roleCounts->keys(),
            'roleCounts' => $roleCounts->values(),
        ]);


    }
}
