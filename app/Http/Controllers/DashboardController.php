<?php

namespace App\Http\Controllers;

use App\Models\department as Department;
use App\Models\EmpPosition;
use App\Models\EmpStatus;
use App\Models\Outlet;
use App\Models\Uploads;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $hak_akses = HelperController::hak_akses();
        // dd($hak_akses);

    }
    public function index(Request $request)
    {
        return view('index');
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
