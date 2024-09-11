<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Members;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(Request $request)
    {
        $datas = Members::all();
        return view('index', compact('datas'));
    }

    public function login()
    {
        $users_active_count = User::where('employee_status', 'ACTIVE')
            ->where('id', '!=', '1')
            ->get()->count();
        $users_inactive_count = User::where('employee_status', 'INACTIVE')
            ->where('id', '!=', '1')
            ->get()->count();

        return view('index', compact('users_active_count', 'users_inactive_count'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
