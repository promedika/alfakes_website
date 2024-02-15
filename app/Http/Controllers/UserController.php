<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->id == 1) {
            // return view('user.index', compact('users', 'emp_stats', 'jabatans', 'levels', 'grades', 'divisions', 'departments', 'provinces', 'area_outlets'));
            return view('user.index');
        } else {
            return redirect('error.404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::User()->role == 0 || Auth::User()->role == 1) {
            $users = User::where('employee_status', 'ACTIVE')->get();
            $emp_stats = EmpStatus::where('status_delete', '!=', 1)->get();
            $jabatans = Jabatan::where('status_delete', '!=', 1)->get();
            $levels = Level::where('status_delete', '!=', 1)->get();
            $grades = GradeCategory::where('status_delete', '!=', 1)->get();
            $divisions = Division::where('status_delete', '!=', 1)->get();
            $departments = Department::where('status_delete', '!=', 1)->get();
            $provinces = Province::pluck('name', 'code');

            $area_outlets = Outlet::all();

            return view('user.create', compact('users', 'emp_stats', 'jabatans', 'levels', 'grades', 'divisions', 'departments', 'provinces', 'area_outlets'));
        } else {
            return redirect('error.404');
        }
    }

    public function hris_custom_date($str_date)
    {
        if (is_null($str_date) || empty($str_date) || !isset($str_date) || $str_date == '') {
            return null;
        }

        $date = explode('/', $str_date);
        $day = $date[0];
        $month = date('m', strtotime($date[1]));
        $year = $date[2];

        $custom_date = $year . '-' . $month . '-' . $day;

        return $custom_date;
    }

    public function hris_length_of_service($start_date)
    {
        // dd(date('Y-m-d'));
        $firstDate = date_create(date('Y-m-d', strtotime($start_date)));
        $endDate = date_create(date('Y-m-d'));

        $difDate = date_diff($firstDate, $endDate);

        $return = $difDate->y . ' Year ' . $difDate->m . ' Month ' . $difDate->d . ' Day';
        return $return;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required',
            'nik' => 'required',
            'phone' => 'required',
            'password' => 'required',
        ]);

        $check_nik = User::where('nik', $request->nik)->get();
        $check_phone = User::where('phone', $request->phone)->get();

        // if (count($check_nik) > 0 || count($check_phone) > 0) {
        if (count($check_nik) > 0) {
            $return['message'] = 'Employee Already Exist!';
            $return['url'] = route('dashboard.user.create');
        } else {
            $user = new user();

            $user->nik = $request->nik;
            $user->nik_ktp = $request->nik_ktp;
            $user->fullname = $request->fullname;
            $user->phone = $request->phone;
            $user->birth_date = $this->hris_custom_date($request->birth_date);
            $user->password = Hash::make($request->password);
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->golongan_darah = $request->golongan_darah;
            $user->marital_status = $request->marital_status;
            $user->education_level = $request->education_level;
            $user->role = $request->role;
            $user->address = $request->address;
            $user->domisili = $request->domisili;

            $user->join_date = $this->hris_custom_date($request->join_date);
            $user->employment_status = $request->employment_status;
            $user->start_date = $this->hris_custom_date($request->start_date);
            $user->end_date = $this->hris_custom_date($request->end_date);
            $user->jabatan = $request->jabatan;
            $user->organization_unit = $request->organization_unit;
            $user->job_title = $request->job_title;
            $user->job_status = $request->job_status;

            $user->level = $request->level;
            $user->grade_category = $request->grade_category;
            $user->work_location = $request->work_location;
            $user->employee_status = $request->employee_status;
           if (count($request->direct_supervisor) > 1 || count($request->immediate_manager) > 1) {
                $user->direct_supervisor = $request->direct_supervisor[0] ?? null;
                $user->direct_supervisor2 = $request->direct_supervisor[1] ?? null;
                $user->direct_supervisor3 = $request->direct_supervisor[2] ?? null;
            
                $user->immediate_manager = $request->immediate_manager[0]?? null;
                $user->immediate_manager2 = $request->immediate_manager[1] ?? null;
                $user->immediate_manager3 = $request->immediate_manager[2] ?? null;
            } else {
                $user->direct_supervisor = $request->direct_supervisor[0] ?? null;
                $user->immediate_manager = $request->immediate_manager[0] ?? null;
            }
            $user->termination_date = $this->hris_custom_date($request->termination_date);
            $user->terminate_reason = $request->terminate_reason;
            $user->resignation = $request->resignation;
            $user->area = $request->area;
            $user->area2 = $request->area2;
            $user->area3 = $request->area3;
            $user->kota = $request->kota;
            $user->division = $request->division;
            $user->department = $request->department;
            $user->status_delete = 1;
            $user->approved_by = 0;
            $user->read_policy = 0;
            $user->status = 'Waiting';
            $user->function = $request->function;
            $user->immediate_position = $request->immediate_position;
            $user->employment_start_date_immediate = $this->hris_custom_date($request->employment_start_date_immediate);
            $user->employment_end_date_immediate = $this->hris_custom_date($request->employment_end_date_immediate);

            $user->length_of_service = $this->hris_length_of_service($user->join_date);

            $user->created_by = Auth::User()->id;
            $user->updated_by = Auth::User()->id;
            $emergencies_arr = null;
            try {
                $user->save();
                DB::table('employment_status_check')->insert([
                    'user_id' => $user->id,
                    'employment_status_new' => $request->employment_status,
                    'employment_status_old' => $request->employment_status,
                    'employment_end_date_new' => $this->hris_custom_date($request->end_date),
                    'employment_end_date_old' => $this->hris_custom_date($request->end_date),
                    'employment_start_date_new' => $this->hris_custom_date($request->start_date),
                    'employment_start_date_old' => $this->hris_custom_date($request->start_date),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                    'status_approve' => 'Waiting',
                ]);

                if (count($request->emergency_name) > 0) {
                    $emergencies_arr = [];
                    foreach ($request->emergency_name as $k => $v) {
                        $emergencies = new Emergencies();
                        $emergencies->user_id = $user->id;
                        $emergencies->name = $v;
                        $emergencies->contact = $request->emergency_contact[$k];
                        $emergencies->relationship = $request->emergency_relationship[$k];
                        $emergencies->address = $request->emergency_address[$k];
                        $emergencies->created_by = Auth::User()->id;
                        $emergencies->updated_by = Auth::User()->id;
                        $emergencies->save();

                        $emergencies_arr[] = $emergencies;
                    }
                }

                $return['message'] = 'Waiting Approved By Direct Supervisor';
                $return['url'] = route('dashboard.users.index');
            } catch (Exception $e) {
                // dd($e->getMessage());
                $return['message'] = 'Failed';
            }
        }

        $data_baru_user['user'] = [$user];
        $data_baru_emergencies['emergency_user'] = $emergencies_arr;
        $data_baru = array_merge($data_baru_user, $data_baru_emergencies);

        DB::table('notification')->insert([
            // 'id' => $request->id,
            'user_id' => Auth::User()->id,
            'link' => $user->id, //link = nik yang melakukan add data
            'message' => 'Create User',
            'appraiser' => Auth::User()->direct_supervisor, //appraiser = direct_supervisor yang melakukan add data
            'appraiser2' => Auth::User()->immediate_manager, //appraiser = direct_supervisor yang melakukan add data
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => Auth::User()->id, // id yang melakukan add data
            // 'approved_by' => 0,
            'status_approve' => 'Waiting',
            'data_baru' => json_encode($data_baru),

        ]);

        return $return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datas = DB::table('users')
            ->leftJoin('emp_statuses', 'emp_statuses.id', '=', 'users.employment_status')
            ->leftJoin('levels', 'levels.id', '=', 'users.level')
            ->leftJoin('grade_categories', 'grade_categories.id', '=', 'users.grade_category')
            ->leftJoin('indonesia_provinces', 'indonesia_provinces.code', '=', 'users.area')
            ->leftJoin('indonesia_cities', 'indonesia_cities.id', '=', 'users.kota')
            ->leftJoin('divisions', 'divisions.id', '=', 'users.division')
            ->leftJoin('departments', 'departments.id', '=', 'users.department')
            ->leftJoin('terminate_reasons', 'terminate_reasons.id', '=', 'users.terminate_reason')
            ->select('users.*', 'emp_statuses.status_name', 'levels.level', 'levels.lev_name', 'grade_categories.level as grade_level', 'grade_categories.grade_name', 'indonesia_provinces.name as provinces', 'indonesia_cities.name as cities', 'divisions.div_name', 'departments.dep_name', 'terminate_reasons.id as terminate_id', 'terminate_reasons.name as terminate_name')
            ->where('users.id', $id)
            ->first();

        $area2 = DB::table('users')
            ->leftJoin('indonesia_provinces', 'indonesia_provinces.code', '=', 'users.area2')
            ->select('indonesia_provinces.name')
            ->where('users.id', $id)
            ->get();

        $area3 = DB::table('users')
            ->Join('indonesia_provinces', 'indonesia_provinces.code', '=', 'users.area3')
            ->select('indonesia_provinces.name')
            ->where('users.id', $id)
            ->get();

        $emergencies = DB::table('emergencies')->where('user_id', $id)->get();

        if (!isset($datas)) {
            return redirect('error.404');
        }

        // custom role name
        $role = 'Super Admin';
        if ($datas->role == 1) {
            $role = 'Admin';
        } else if ($datas->role == 2) {
            $role = 'Member';
        } else if ($datas->role == 3) {
            $role = 'Report';
        }
        $datas->role_name = $role;

        // custom direct_supervisor name
        $direct_supervisor = '-';
        if (!is_null($datas->direct_supervisor)) {
            $direct_supervisor = EmpPosition::find($datas->direct_supervisor)->name;
        }
        $datas->direct_supervisor_name = $direct_supervisor;

        // custom immediate_manager name
        $immediate_manager = '-';
        if (!is_null($datas->immediate_manager)) {
            $immediate_manager = EmpPosition::find($datas->immediate_manager)->name;
        }
        $datas->immediate_manager_name = $immediate_manager;

        $area_outlets = Outlet::all();

        return view('user.show', compact('datas', 'area2', 'area3', 'emergencies', 'area_outlets'));
    }

    public function show1($id)
    {
        $datas = DB::table('users')
            ->leftJoin('emp_statuses', 'emp_statuses.id', '=', 'users.employment_status')
            ->leftJoin('levels', 'levels.id', '=', 'users.level')
            ->leftJoin('grade_categories', 'grade_categories.id', '=', 'users.grade_category')
            ->leftJoin('indonesia_provinces', 'indonesia_provinces.code', '=', 'users.area')
            ->leftJoin('indonesia_cities', 'indonesia_cities.id', '=', 'users.kota')
            ->leftJoin('divisions', 'divisions.id', '=', 'users.division')
            ->leftJoin('departments', 'departments.id', '=', 'users.department')
            ->leftJoin('terminate_reasons', 'terminate_reasons.id', '=', 'users.terminate_reason')
            ->select('users.*', 'emp_statuses.status_name', 'levels.level', 'levels.lev_name', 'grade_categories.level as grade_level', 'grade_categories.grade_name', 'indonesia_provinces.name as provinces', 'indonesia_cities.name as cities', 'divisions.div_name', 'departments.dep_name', 'terminate_reasons.id as terminate_id', 'terminate_reasons.name as terminate_name')
            ->where('users.id', $id)
            ->first();

        $area2 = DB::table('users')
            ->leftJoin('indonesia_provinces', 'indonesia_provinces.code', '=', 'users.area2')
            ->select('indonesia_provinces.name')
            ->where('users.id', $id)
            ->get();

        $area3 = DB::table('users')
            ->Join('indonesia_provinces', 'indonesia_provinces.code', '=', 'users.area3')
            ->select('indonesia_provinces.name')
            ->where('users.id', $id)
            ->get();

        $emergencies = DB::table('emergencies')->where('user_id', $id)->get();

        if (!isset($datas)) {
            return redirect('error.404');
        }

        // custom role name
        $role = 'Super Admin';
        if ($datas->role == 1) {
            $role = 'Admin';
        } else if ($datas->role == 2) {
            $role = 'Member';
        } else if ($datas->role == 3) {
            $role = 'Report';
        }
        $datas->role_name = $role;

        // custom direct_supervisor name
        $direct_supervisor = '-';
        if (!is_null($datas->direct_supervisor)) {
            $direct_supervisor = EmpPosition::find($datas->direct_supervisor)->name;
        }
        $datas->direct_supervisor_name = $direct_supervisor;

        // custom immediate_manager name
        $immediate_manager = '-';
        if (!is_null($datas->immediate_manager)) {
            $immediate_manager = EmpPosition::find($datas->immediate_manager)->name;
        }
        $datas->immediate_manager_name = $immediate_manager;

        $area_outlets = Outlet::all();

        return view('user.show1', compact('datas', 'area2', 'area3', 'emergencies', 'area_outlets'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::User()->role == 0 || Auth::User()->role == 1) {
            $datas = DB::table('users')
                ->leftJoin('emp_statuses', 'emp_statuses.id', '=', 'users.employment_status')
                ->leftJoin('levels', 'levels.id', '=', 'users.level')
                ->leftJoin('grade_categories', 'grade_categories.id', '=', 'users.grade_category')
                ->leftJoin('indonesia_provinces', 'indonesia_provinces.code', '=', 'users.area', 'users.area2', 'users.area3')
                ->leftJoin('indonesia_cities', 'indonesia_cities.id', '=', 'users.kota')
                ->leftJoin('divisions', 'divisions.id', '=', 'users.division')
                ->leftJoin('departments', 'departments.id', '=', 'users.department')
                ->leftJoin('terminate_reasons', 'terminate_reasons.id', '=', 'users.terminate_reason')
                ->select('users.*', 'emp_statuses.status_name', 'levels.level as lev_level', 'levels.lev_name', 'grade_categories.level as grade_level', 'grade_categories.grade_name', 'indonesia_provinces.name as provinces', 'indonesia_cities.name as cities', 'divisions.div_name', 'departments.dep_name', 'terminate_reasons.id as terminate_id', 'terminate_reasons.name as terminate_name')
                ->where('users.id', $id)
                ->first();

            if (!isset($datas)) {
                return redirect('error.404');
            }

            // custom direct_supervisor name
            $direct_supervisor = '-';
            if (!is_null($datas->direct_supervisor)) {
                $direct_supervisor = EmpPosition::find($datas->direct_supervisor)->name;
            }
            $datas->direct_supervisor_name = $direct_supervisor;

            // custom immediate_manager name
            $immediate_manager = '-';
            if (!is_null($datas->immediate_manager)) {
                $immediate_manager = EmpPosition::find($datas->immediate_manager)->name;
            }
            $datas->immediate_manager_name = $immediate_manager;

            $datas->birth_date = date('d/M/Y', strtotime($datas->birth_date));
            $datas->join_date = date('d/M/Y', strtotime($datas->join_date));
            $datas->start_date = date('d/M/Y', strtotime($datas->start_date));
            $datas->employment_start_date_immediate = isset($datas->employment_start_date_immediate) ?  date('d/M/Y', strtotime($datas->employment_start_date_immediate)) : '';
            $datas->employment_end_date_immediate = isset($datas->employment_end_date_immediate) ?  date('d/M/Y', strtotime($datas->employment_end_date_immediate)) : '';

            $datas->end_date = isset($datas->end_date) ? date('d/M/Y', strtotime($datas->end_date)) : '';
            $datas->termination_date = isset($datas->termination_date) ? date('d/M/Y', strtotime($datas->termination_date)) : '';

            $datas->immediate_manager_name = $immediate_manager;

            $users = User::where('users.employee_status', 'ACTIVE')->get();
            $emp_stats = EmpStatus::where('status_delete', '!=', 1)->get();
            $jabatans = Jabatan::where('status_delete', '!=', 1)->get();
            $levels = Level::where('status_delete', '!=', 1)->get();
            $grades = GradeCategory::where('status_delete', '!=', 1)->get();
            $divisions = Division::where('status_delete', '!=', 1)->get();
            $departments = Department::where('status_delete', '!=', 1)->get();
            $terminate_reasons = TerminateReason::where('status_delete', '!=', 1)->get();
            $provinces = Province::pluck('name', 'code');
            $cities = indonesia_cities::where('province_code', $datas->area)->get();

            $area_outlets = Outlet::all();

            $emergencies = DB::table('emergencies')->where('user_id', $id)->get();

            return view('user.edit', compact('users', 'emp_stats', 'jabatans', 'levels', 'grades', 'divisions', 'departments', 'provinces', 'datas', 'cities', 'terminate_reasons', 'emergencies', 'area_outlets'));
        } else {
            return redirect('error.404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required',
            'nik' => 'required',
            'phone' => 'required',

        ]);

        $get_data_lama_user = DB::table('users')->where('users.id', $request->id)->get();

        $get_data_lama_emer = DB::table('emergencies')->where('user_id', $request->id)->get();

        $data_lama_user['user'] = [$get_data_lama_user];
        $data_lama_emergencies['emergency_user'] = $get_data_lama_emer;
        $data_lama = array_merge($data_lama_user, $data_lama_emergencies);

        $id = $request->id;
        $user = User::find($id);

        if ($request->password != '' && strlen(trim($request->password)) > 0) {
            $user->password = Hash::make($request->password);
        }

        $user->nik = $request->nik;
        $user->nik_ktp = $request->nik_ktp;
        $user->fullname = $request->fullname;
        $user->phone = $request->phone;
        $user->birth_date = $this->hris_custom_date($request->birth_date);
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->religion = $request->religion;
        $user->golongan_darah = $request->golongan_darah;
        $user->marital_status = $request->marital_status;
        $user->education_level = $request->education_level;
        $user->role = $request->role;
        $user->address = $request->address;
        $user->domisili = $request->domisili;

        $user->join_date = $this->hris_custom_date($request->join_date);
        $user->employment_status = $request->employment_status;
        $user->start_date = $this->hris_custom_date($request->start_date);

        $user->jabatan = $request->jabatan;
        $user->organization_unit = $request->organization_unit;
        $user->job_title = $request->job_title;
        $user->job_status = $request->job_status;

        $user->level = $request->level;
        $user->grade_category = $request->grade_category;
        $user->work_location = $request->work_location;
        $user->employee_status = $request->employee_status;
       if (count($request->direct_supervisor) > 1 || count($request->immediate_manager) > 1) {
            $user->direct_supervisor = $request->direct_supervisor[0] ?? null;
            $user->direct_supervisor2 = $request->direct_supervisor[1] ?? null;
            $user->direct_supervisor3 = $request->direct_supervisor[2] ?? null;
        
            $user->immediate_manager = $request->immediate_manager[0]?? null;
            $user->immediate_manager2 = $request->immediate_manager[1] ?? null;
            $user->immediate_manager3 = $request->immediate_manager[2] ?? null;
        } else {
            $user->direct_supervisor = $request->direct_supervisor[0] ?? null;
            $user->immediate_manager = $request->immediate_manager[0] ?? null;
        }

        $user->area = $request->area;
        $user->area2 = $request->area2;
        $user->area3 = $request->area3;
        $user->kota = $request->kota;
        $user->division = $request->division;
        $user->department = $request->department;
        $user->status_delete = 1;
        $user->approved_by = 0;
        $user->status = 'Waiting';

        $user->function = $request->function;

        $user->immediate_position = $request->immediate_position;
        // $user->employment_start_date_immediate = $request->employment_start_date_immediate;
        // $user->employment_end_date_immediate = $request->employment_end_date_immediate;

        $user->length_of_service = $this->hris_length_of_service($user->join_date);

        $user->updated_by = Auth::User()->id;

        if (isset($request->end_date)) {
            $user->end_date = $this->hris_custom_date($request->end_date);
        }

        if (isset($request->employment_start_date_immediate)) {
            $user->employment_start_date_immediate = $this->hris_custom_date($request->employment_start_date_immediate);
        }

        if (isset($request->employment_end_date_immediate)) {
            $user->employment_end_date_immediate = $this->hris_custom_date($request->employment_end_date_immediate);
        }

        if (isset($request->termination_date)) {
            $user->termination_date = $this->hris_custom_date($request->termination_date);
        }

        if (isset($request->terminate_reason)) {
            $user->terminate_reason = $request->terminate_reason;
        }

        if (isset($request->resignation)) {
            $file = $request->file('resignation');
            $filename = $user->nik . '_' . time() . '_' . $file->hashName();

            $tmp_path = $_FILES["resignation"]["tmp_name"];

            // declare full path and filename
            $target_file = public_path('/assets/resignation/');

            // move file upload to storage
            $file->move($target_file, $filename);

            $user->resignation = $filename;
        }

        // $emp_status_check =  DB::table('employment_status_check')
        // ->where('user_id', $request->id)
        // ->where('employment_status_new','!=',$request->employment_status)
        // ->get();

        // if(count($emp_status_check) > 0){
        //     DB::table('employment_status_check')
        //     ->where('user_id', $request->id)
        //     ->update([
        //         'employment_status_new' => $user->employment_status,
        //         'employment_end_date_new' => $user->end_date,
        //         'employment_start_date_new' => $user->start_date,
        //         'updated_by' => Auth::User()->id,
        //         'updated_at' => date('Y-m-d H:i:s'),
        //         'status_approve' => 'Waiting',
        //     ]);
        // }else{
        DB::table('employment_status_check')->insert([
            'user_id' => $request->id,
            'employment_status_new' => $request->employment_status,
            'employment_status_old' => $get_data_lama_user[0]->employment_status,
            'employment_end_date_new' => $this->hris_custom_date($request->end_date),
            'employment_end_date_old' => $get_data_lama_user[0]->end_date,
            'employment_start_date_new' => $this->hris_custom_date($request->start_date),
            'employment_start_date_old' => $get_data_lama_user[0]->start_date,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'status_approve' => 'Waiting',
        ]);

        // }
        $emergencies_arr = null;
        try {
            $user->save();
            if (count($request->emergency_name) > 0) {
                DB::table('emergencies')->where('user_id', $user->id)->delete();
                $emergencies_arr = [];
                foreach ($request->emergency_name as $k => $v) {
                    $emergencies = new Emergencies();
                    $emergencies->user_id = $user->id;
                    $emergencies->name = $v;
                    $emergencies->contact = $request->emergency_contact[$k];
                    $emergencies->relationship = $request->emergency_relationship[$k];
                    $emergencies->address = $request->emergency_address[$k];
                    $emergencies->created_by = Auth::User()->id;
                    $emergencies->updated_by = Auth::User()->id;
                    $emergencies->save();

                    $emergencies_arr[] = $emergencies;
                }
            }

            $return['message'] = 'Waiting Approved By Direct Supervisor';
            $return['url'] = route('dashboard.users.index');
        } catch (Exception $e) {
            // dd($e->getMessage());
            $return['message'] = 'Failed';
        }

        // $data_baru = [$user];
        $data_baru_user['user'] = [$user];
        $data_baru_emergencies['emergency_user'] = $emergencies_arr;
        $data_baru = array_merge($data_baru_user, $data_baru_emergencies);

        DB::table('notification')->insert([
            // 'id' => $request->id,
            'user_id' => Auth::User()->id,
            'link' => $user->id, //link = nik yang melakukan add data
            'message' => 'Edit User',
            'appraiser' => Auth::User()->direct_supervisor, //appraiser = direct_supervisor yang melakukan add data
            'appraiser2' => Auth::User()->immediate_manager, //appraiser = direct_supervisor yang melakukan add data
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => Auth::User()->id, // id yang melakukan add data
            // 'approved_by' => 0,
            'status_approve' => 'Waiting',
            'data_baru' => json_encode($data_baru),
            'data_lama' => json_encode($data_lama),

        ]);

        return $return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function terminate($id)
    {
        if (Auth::User()->role == 0 || Auth::User()->role == 1) {
            $datas = DB::table('users')
                ->leftJoin('emp_statuses', 'emp_statuses.id', '=', 'users.employment_status')
                ->leftJoin('levels', 'levels.id', '=', 'users.level')
                ->leftJoin('grade_categories', 'grade_categories.id', '=', 'users.grade_category')
                ->leftJoin('indonesia_provinces', 'indonesia_provinces.code', '=', 'users.area', 'users.area2', 'users.area3')
                ->leftJoin('indonesia_cities', 'indonesia_cities.id', '=', 'users.kota')
                ->leftJoin('divisions', 'divisions.id', '=', 'users.division')
                ->leftJoin('departments', 'departments.id', '=', 'users.department')
                ->leftJoin('terminate_reasons', 'terminate_reasons.id', '=', 'users.terminate_reason')
                ->select('users.*', 'emp_statuses.status_name', 'levels.level as lev_level', 'levels.lev_name', 'grade_categories.level as grade_level', 'grade_categories.grade_name', 'indonesia_provinces.name as provinces', 'indonesia_cities.name as cities', 'divisions.div_name', 'departments.dep_name', 'terminate_reasons.id as terminate_id', 'terminate_reasons.name as terminate_name')
                ->where('users.id', $id)
                ->first();

            if (!isset($datas)) {
                return redirect('error.404');
            }

            // custom direct_supervisor name
            $direct_supervisor = '-';
            if (!is_null($datas->direct_supervisor)) {
                $direct_supervisor = EmpPosition::find($datas->direct_supervisor)->name;
            }
            $datas->direct_supervisor_name = $direct_supervisor;

            // custom immediate_manager name
            $immediate_manager = '-';
            if (!is_null($datas->immediate_manager)) {
                $immediate_manager = EmpPosition::find($datas->immediate_manager)->name;
            }
            $datas->immediate_manager_name = $immediate_manager;

            $datas->birth_date = date('d/M/Y', strtotime($datas->birth_date));
            $datas->join_date = date('d/M/Y', strtotime($datas->join_date));
            $datas->start_date = date('d/M/Y', strtotime($datas->start_date));

            $datas->end_date = isset($datas->end_date) ? date('d/M/Y', strtotime($datas->end_date)) : '';
            $datas->termination_date = isset($datas->termination_date) ? date('d/M/Y', strtotime($datas->termination_date)) : '';

            $datas->immediate_manager_name = $immediate_manager;

            $users = User::where('users.employee_status', 'ACTIVE')->get();
            $emp_stats = EmpStatus::where('status_delete', '!=', 1)->get();
            $jabatans = Jabatan::where('status_delete', '!=', 1)->get();
            $levels = Level::where('status_delete', '!=', 1)->get();
            $grades = GradeCategory::where('status_delete', '!=', 1)->get();
            $divisions = Division::where('status_delete', '!=', 1)->get();
            $departments = Department::where('status_delete', '!=', 1)->get();
            $terminate_reasons = TerminateReason::where('status_delete', '!=', 1)->get();
            $provinces = Province::pluck('name', 'code');
            $cities = indonesia_cities::where('province_code', $datas->area)->get();

            $area_outlets = Outlet::all();

            return view('user.terminate', compact('users', 'emp_stats', 'jabatans', 'levels', 'grades', 'divisions', 'departments', 'provinces', 'datas', 'cities', 'terminate_reasons', 'area_outlets'));
        } else {
            return redirect('error.404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update2(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        $user = User::find($id);

        $get_data_lama_user = DB::table('users')->where('users.id', $request->id)->get();

        $get_data_lama_emer = DB::table('emergencies')->where('user_id', $request->id)->get();

        $data_lama_user['user'] = [$get_data_lama_user];
        $data_lama_emergencies['emergency_user'] = $get_data_lama_emer;
        $data_lama = array_merge($data_lama_user, $data_lama_emergencies);

        if ($request->password != '' && strlen(trim($request->password)) > 0) {
            $user->password = Hash::make($request->password);
        }

        $user->job_status = $request->job_status;
        $user->employee_status = $request->employee_status;

        $user->updated_by = Auth::User()->id;

        if (isset($request->end_date)) {
            $user->end_date = $this->hris_custom_date($request->end_date);
        }

        if (isset($request->termination_date)) {
            $user->termination_date = $this->hris_custom_date($request->termination_date);
            $user->status = 'Delete';
        }

        if (isset($request->terminate_reason)) {
            $user->terminate_reason = $request->terminate_reason;
        }

        if (isset($request->resignation)) {
            $file = $request->file('resignation');
            $filename = $user->nik . '_' . time() . '_' . $file->hashName();

            $tmp_path = $_FILES["resignation"]["tmp_name"];

            // declare full path and filename
            $target_file = public_path('/assets/resignation/');

            // move file upload to storage
            $file->move($target_file, $filename);

            $user->resignation = $filename;
            $user->status_delete = 1;
            $user->approved_by = 0;
        }

        try {
            $user->save();
            $return['message'] = 'Success';
            $return['url'] = route('dashboard.users.index');
        } catch (Exception $e) {
            // dd($e->getMessage());
            $return['message'] = 'Failed';
        }

        $data_baru_user['user'] = [$user];
        $data_lama_emergencies['emergency_user'] = $get_data_lama_emer;
        $data_baru = array_merge($data_baru_user, $data_lama_emergencies);

        DB::table('notification')->insert([
            // 'id' => $request->id,
            'user_id' => Auth::User()->id,
            'link' => $user->id, //link = nik yang melakukan add data
            'message' => 'Edit User',
            'appraiser' => Auth::User()->direct_supervisor, //appraiser = direct_supervisor yang melakukan add data
            'appraiser2' => Auth::User()->immediate_manager, //appraiser = direct_supervisor yang melakukan add data
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => Auth::User()->id, // id yang melakukan add data
            // 'approved_by' => 0,
            'status_approve' => 'Waiting',
            'data_baru' => json_encode($data_baru),
            'data_lama' => json_encode($data_lama),

        ]);

        return $return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $user->status_delete = 1;
        $user->approved_by = 2;
        $user->status = 'Delete';
        $user->employee_status = 'INACTIVE';
        $user->save();

        return $user;
    }

    public function edit1(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        return $user;
    }

    // public function approveXX(Request $request)
    // {

    //     $tanggal_sekarang = date('Y-m-d');
    //     $update_terminate = DB::table('users')
    //         ->where('id', $request->id)
    //         ->whereNotNull('terminate_reason')->get();
    //     $now = date('Y-m-d');

    //     if (count($update_terminate) > 0) {
    //         DB::table('users')
    //             ->where('id', $request->id)
    //             ->where('termination_date', '<=', $tanggal_sekarang)
    //             ->whereNotNull('terminate_reason')
    //             ->update([
    //                 'job_status' => DB::raw("CASE WHEN termination_date <= '$now' THEN 'INACTIVE' ELSE 'ACTIVE' END"),
    //                 'employee_status' => DB::raw("CASE WHEN termination_date <= '$now' THEN 'INACTIVE' ELSE 'ACTIVE' END"),
    //                 'status_delete' => 2,
    //                 'approved_by' => 1,
    //             ]);
    //         $id_notif = DB::table('notification')
    //             ->where('link', $request->id)
    //             ->where('message', 'LIKE', '%User%')
    //             ->where('status_approve', 'Waiting')
    //             ->get();

    //         DB::table('notification')
    //             ->where('id', $id_notif[0]->id)
    //             ->update([
    //                 'approved_by' => Auth::User()->fullname,
    //                 'declined_by' => null,
    //                 'status_approve' => 'Approve',
    //                 'updated_by' => Auth::User()->id,
    //                 'approved_at' => date('Y-m-d H:i:s'),
    //             ]);
    //     } else {
    //         $id = $request->id;
    //         $user = User::find($id);
    //         $user->status = 'Approve';
    //         $user->status_delete = 2;
    //         $user->approved_by = 1;
    //         $user->save();

    //         $emp_status_check_permanent = DB::table('employment_status_check')
    //             ->where('user_id', $id)
    //             ->where('employment_status_new', '=', 1)
    //             ->where('employment_end_date_new', $tanggal_sekarang)
    //             ->get();

    //         $emp_status_check_permanent2 = DB::table('employment_status_check')
    //             ->where('user_id', $id)
    //             ->where('employment_status_new', '=', 1)
    //             ->where('employment_end_date_new', '!=', $tanggal_sekarang)
    //             ->get();

    //         if (count($emp_status_check_permanent) > 0) {
    //             DB::table('employment_status_check')
    //                 ->where('user_id', $id)
    //                 ->update([
    //                     'status_approve' => 'Approve',
    //                 ]);

    //             DB::table('users')
    //                 ->where('id', $id)
    //                 ->where('end_date', $tanggal_sekarang)
    //                 ->update([
    //                     'employment_status' => 1,
    //                     'updated_by' => Auth::User()->id,
    //                     'updated_at' => date('Y-m-d H:i:s'),
    //                 ]);
    //         } else {
    //             if (count($emp_status_check_permanent2) > 0) {
    //                 DB::table('employment_status_check')
    //                     ->where('user_id', $id)
    //                     ->update([
    //                         'status_approve' => 'Approve',
    //                     ]);
    //                 $emp_status_check2 = DB::table('employment_status_check')
    //                     ->where('user_id', $id)
    //                     ->get();

    //                 DB::table('users')
    //                     ->where('id', $id)
    //                     ->where('end_date', '!=', $tanggal_sekarang)
    //                     ->update([
    //                         'employment_status' => $emp_status_check2[0]->employment_status_old,
    //                         'updated_by' => Auth::User()->id,
    //                         'updated_at' => date('Y-m-d H:i:s'),
    //                     ]);
    //             }
    //         }

    //         $emp_status_check_contract = DB::table('employment_status_check')
    //             ->where('user_id', $id)
    //             ->where('employment_status_new', '!=', 1)
    //             ->where('employment_start_date_new', $tanggal_sekarang)
    //             ->get();

    //         $emp_status_check_contract2 = DB::table('employment_status_check')
    //             ->where('user_id', $id)
    //             ->where('employment_status_new', '!=', 1)
    //             ->where('employment_start_date_new', '!=', $tanggal_sekarang)
    //             ->get();

    //         if (count($emp_status_check_contract) > 0) {
    //             DB::table('employment_status_check')
    //                 ->where('user_id', $id)
    //                 ->update([
    //                     'status_approve' => 'Approve',
    //                 ]);

    //             DB::table('users')
    //                 ->where('id', $id)
    //                 ->where('employment_status', '!=', 1)
    //                 ->where('start_date', '=', $tanggal_sekarang)
    //                 ->update([
    //                     'employment_status' => $user->employment_status,
    //                     'updated_by' => Auth::User()->id,
    //                     'updated_at' => date('Y-m-d H:i:s'),
    //                 ]);
    //         } else {
    //             if (count($emp_status_check_contract2) > 0) {
    //                 DB::table('employment_status_check')
    //                     ->where('user_id', $id)
    //                     ->update([
    //                         'status_approve' => 'Approve',
    //                     ]);
    //                 $emp_status_check2_tmp = DB::table('employment_status_check')
    //                     ->where('user_id', $id)
    //                     ->orderBy('created_at', 'DESC')
    //                     ->get();

    //                 DB::table('users')
    //                     ->where('id', $id)
    //                     ->where('employment_status', '!=', 1)
    //                     ->where('start_date', '!=', $tanggal_sekarang)
    //                     ->update([
    //                         'employment_status' => $emp_status_check2_tmp[0]->employment_status_old,
    //                         'updated_by' => Auth::User()->id,
    //                         'updated_at' => date('Y-m-d H:i:s'),
    //                     ]);
    //             }

    //         }

    //         $id_notif = DB::table('notification')
    //             ->where('link', $user->id)
    //             ->where('message', 'LIKE', '%User%')
    //             ->where('status_approve', 'Waiting')
    //             ->get();

    //         DB::table('notification')
    //             ->where('id', $id_notif[0]->id)
    //             ->update([
    //                 'approved_by' => Auth::User()->fullname,
    //                 'declined_by' => null,
    //                 'status_approve' => 'Approve',
    //                 'updated_by' => Auth::User()->id,
    //                 'approved_at' => date('Y-m-d H:i:s'),
    //             ]);
    //     }

    //     return redirect()->back();
    // }

    public function approve(Request $request)
    {

        $tanggal_sekarang = date('Y-m-d');
        $update_terminate = DB::table('users')
            ->where('id', $request->id)
            ->whereNotNull('terminate_reason')->get();
        $now = date('Y-m-d');

        if (count($update_terminate) > 0) {
            DB::table('users')
                ->where('id', $request->id)
                ->where('termination_date', '<=', $tanggal_sekarang)
                ->whereNotNull('terminate_reason')
                ->update([
                    'status_delete' => 2,
                    'approved_by' => 1,
                    'job_status' => DB::raw("CASE WHEN termination_date <= '$now' THEN 'INACTIVE' ELSE 'ACTIVE' END"),
                    'employee_status' => DB::raw("CASE WHEN termination_date <= '$now' THEN 'INACTIVE' ELSE 'ACTIVE' END"),
                    'status' => DB::raw("CASE WHEN termination_date <= '$now' THEN 'Delete' ELSE 'Approve' END"),
                    'status_delete' => 2,
                    'approved_by' => 1,
                ]);
        }

        $emp_status_check_permanent = DB::table('users')
            ->leftJoin('employment_status_check', 'employment_status_check.user_id', '=', 'users.id')
            ->where('employment_status_check.employment_status_new', '=', 1)
            ->where('users.id', $request->id)
            ->where('employment_status_check.status_approve', '=', 'Waiting')
            ->get();
        if (count($emp_status_check_permanent) > 0) {
            foreach ($emp_status_check_permanent as $check) {
                $emp_status_old = $check->employment_status_old;
                $end_date_new = $check->employment_end_date_new;
                $current_date = date('Y-m-d');

                if ($end_date_new <= $current_date) {
                    DB::table('users')
                        ->leftJoin('employment_status_check', 'employment_status_check.user_id', '=', 'users.id')
                        ->where('employment_status_check.employment_status_new', '=', 1)
                        ->where('employment_status_check.employment_end_date_new', '<=', $current_date)
                        ->where('users.id', $request->id)
                        ->update([
                            'employment_status' => 1,
                            'status' => 'Approve',
                            'status_delete' => 2,
                            'approved_by' => 1,
                        ]);
                       
                } elseif ($end_date_new > $current_date) {
                    DB::table('users')
                        ->leftJoin('employment_status_check', 'employment_status_check.user_id', '=', 'users.id')
                        ->where('employment_status_check.employment_status_new', '=', 1)
                        ->where('employment_status_check.employment_end_date_new', '>', $current_date)
                        ->where('users.id', $request->id)
                        ->update([
                            'employment_status' => $emp_status_old,
                            'status' => 'Approve',
                            'status_delete' => 2,
                            'approved_by' => 1,
                        ]);

                }
              
            }
        }
        $emp_status_tmp = DB::table('users')
            ->leftJoin('employment_status_check', 'employment_status_check.user_id', '=', 'users.id')
            ->where('employment_status_check.employment_status_new', '!=', 1)
            ->where('users.id', $request->id)
            ->where('employment_status_check.status_approve', '=', 'Waiting')
            ->get();

        if (count($emp_status_tmp) > 0) {
            foreach ($emp_status_tmp as $tmp_status) {
                $usr_id = $tmp_status->user_id;
                $emp_status_old = $tmp_status->employment_status_old;
                $start_date_new = $tmp_status->employment_start_date_new;
                $current_date = date('Y-m-d');

                if ($start_date_new <= $current_date) {
                    DB::table('users')
                        ->leftJoin('employment_status_check', 'employment_status_check.user_id', '=', 'users.id')
                        ->where('employment_status_check.employment_status_new', '!=', 1)
                        ->where('employment_status_check.employment_start_date_new', '<=', $tanggal_sekarang)
                        ->where('users.id', $usr_id)
                        ->update([
                            'employment_status' => $tmp_status->employment_status_new,
                            'status' => 'Approve',
                            'status_delete' => 2,
                            'approved_by' => 1,
                        ]);
                        
                } elseif ($start_date_new > $current_date) {
                    DB::table('users')
                        ->leftJoin('employment_status_check', 'employment_status_check.user_id', '=', 'users.id')
                        ->where('employment_status_check.employment_status_new', '!=', 1)
                        ->where('employment_status_check.employment_start_date_new', '>', $tanggal_sekarang)
                        ->where('users.id', $usr_id)
                        ->update([
                            'employment_status' => $tmp_status->employment_status_old,
                            'status' => 'Approve',
                            'status_delete' => 2,
                            'approved_by' => 1,
                        ]);
                    
                }
              
            }
        } 
        $update_status = DB::table('users')
        ->where('id', $request->id)
        ->whereNotNull('join_date')
        ->where('job_status','=','PENDING')
        ->get();

        if (count($update_status) > 0) {
            DB::table('users')
                ->where('id', $request->id)
                ->where('join_date', '<=', $tanggal_sekarang)
                ->where('job_status','=','PENDING')
                ->update([
                    'status_delete' => 2,
                    'approved_by' => 1,
                    'job_status' => DB::raw("CASE WHEN join_date <= '$now' THEN 'ACTIVE' ELSE 'PENDING' END"),
                    'employee_status' => DB::raw("CASE WHEN join_date <= '$now' THEN 'ACTIVE' ELSE 'PENDING' END"),
                    'status' => 'Approve',
                    'status_delete' => 2,
                    'approved_by' => 1,
                ]);
        }
        else {
            User::where('approved_by', 0)
                ->where('id', $request->id)
                ->update(['status' => 'Approve', 'status_delete' => 2, 'approved_by' => 1]);
        }

        
        DB::table('employment_status_check')
        ->where('user_id', $request->id)
        ->where('status_approve', '=', 'Waiting')
        ->update([
            'status_approve' => 'Approve',
        ]);
        $id_notif = DB::table('notification')
            ->where('link', $request->id)
            ->where('message', 'LIKE', '%User%')
            ->where('status_approve', 'Waiting')
            ->get();

        DB::table('notification')
            ->where('id', $id_notif[0]->id)
            ->update([
                'approved_by' => Auth::User()->fullname,
                'declined_by' => null,
                'status_approve' => 'Approve',
                'updated_by' => Auth::User()->id,
                'approved_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->back();
    }
    public function edit2(Request $request)
    {
        $user = User::where('approved_by', '=', 0)->get();

        return $user;
    }

    public function approveall(Request $request)
    {
        // dd($request->all());
        $tanggal_sekarang = date('Y-m-d');
        $update_terminate = DB::table('users')
            ->leftJoin('notification', 'notification.link', '=', 'users.id')
            ->where('notification.message', 'LIKE', '%User%')
            ->where('notification.status_approve', 'Waiting')
            ->whereNotNull('users.terminate_reason')
            ->get();
        $now = date('Y-m-d');

        if (count($update_terminate) > 0) {
            DB::table('users')
                ->where('terminate_reason', '!=', null)
                ->update([
                    'status_delete' => 2,
                    'approved_by' => 1,
                    'job_status' => DB::raw("CASE WHEN termination_date <= '$now' THEN 'INACTIVE' ELSE 'ACTIVE' END"),
                    'employee_status' => DB::raw("CASE WHEN termination_date <= '$now' THEN 'INACTIVE' ELSE 'ACTIVE' END"),
                    'status' => DB::raw("CASE WHEN termination_date <= '$now' THEN 'Delete' ELSE 'Approve' END"),
                    'status_delete' => 2,
                    'approved_by' => 1,
                ]);
        }

        $emp_status_check_permanent = DB::table('users')
            ->leftJoin('employment_status_check', 'employment_status_check.user_id', '=', 'users.id')
            ->where('employment_status_check.employment_status_new', '=', 1)
            ->where('employment_status_check.status_approve', '=', 'Waiting')
            ->get();
        if (count($emp_status_check_permanent) > 0) {
            foreach ($emp_status_check_permanent as $check) {
                $emp_status_old = $check->employment_status_old;
                $end_date_new = $check->employment_end_date_new;
                $current_date = date('Y-m-d');

                if (strtotime($end_date_new) <= strtotime($current_date)) {
                    DB::table('users')
                        ->leftJoin('employment_status_check', 'employment_status_check.user_id', '=', 'users.id')
                        ->where('employment_status_check.employment_status_new', '=', 1)
                        ->where('employment_status_check.employment_end_date_new', '<=', $current_date)
                        ->update([
                            'employment_status' => 1,
                            'status' => 'Approve',
                            'status_delete' => 2,
                            'approved_by' => 1,
                        ]);
                } elseif (strtotime($end_date_new) > strtotime($current_date)) {
                    DB::table('users')
                        ->leftJoin('employment_status_check', 'employment_status_check.user_id', '=', 'users.id')
                        ->where('employment_status_check.employment_status_new', '=', 1)
                        ->where('employment_status_check.employment_end_date_new', '>', $current_date)
                        ->update([
                            'employment_status' => $emp_status_old,
                            'status' => 'Approve',
                            'status_delete' => 2,
                            'approved_by' => 1,
                        ]);
                }
             
            }
        }
        $emp_status_tmp = DB::table('users')
            ->leftJoin('employment_status_check', 'employment_status_check.user_id', '=', 'users.id')
            ->where('employment_status_check.employment_status_new', '!=', 1)
            ->where('employment_status_check.status_approve', '=', 'Waiting')
            ->get();

        if (count($emp_status_tmp) > 0) {
            foreach ($emp_status_tmp as $tmp_status) {
                $usr_id = $tmp_status->user_id;
                $emp_status_old = $tmp_status->employment_status_old;
                $start_date_new = $tmp_status->employment_start_date_new;
                $current_date = date('Y-m-d');

                if (strtotime($start_date_new) <= strtotime($current_date)) {
                    DB::table('users')
                        ->leftJoin('employment_status_check', 'employment_status_check.user_id', '=', 'users.id')
                        ->where('employment_status_check.employment_status_new', '!=', 1)
                        ->where('employment_status_check.employment_start_date_new', '<=', $tanggal_sekarang)
                        ->where('users.id', $usr_id)
                        ->update([
                            'employment_status' => $tmp_status->employment_status_new,
                            'status' => 'Approve',
                            'status_delete' => 2,
                            'approved_by' => 1,
                        ]);

                } elseif (strtotime($start_date_new) > strtotime($current_date)) {
                    DB::table('users')
                        ->leftJoin('employment_status_check', 'employment_status_check.user_id', '=', 'users.id')
                        ->where('employment_status_check.employment_status_new', '!=', 1)
                        ->where('employment_status_check.employment_start_date_new', '>', $tanggal_sekarang)
                        ->where('users.id', $usr_id)
                        ->update([
                            'employment_status' => $tmp_status->employment_status_old,
                            'status' => 'Approve',
                            'status_delete' => 2,
                            'approved_by' => 1,
                        ]);
                }
               
            }
        } 
        $update_status = DB::table('users')
        ->leftJoin('notification', 'notification.link', '=', 'users.id')
        ->where('notification.message', 'LIKE', '%Create User%')
        ->where('notification.status_approve', 'Waiting')
        ->whereNotNull('users.join_date')
        ->where('users.job_status','=','PENDING')
        ->get();

        if (count($update_status) > 0) {
            DB::table('users')
                ->where('join_date', '!=', null)
                ->where('job_status','=','PENDING')
                ->update([
                    'status_delete' => 2,
                    'approved_by' => 1,
                    'job_status' => DB::raw("CASE WHEN join_date <= '$now' THEN 'ACTIVE' ELSE 'PENDING' END"),
                    'employee_status' => DB::raw("CASE WHEN join_date <= '$now' THEN 'ACTIVE' ELSE 'PENDING' END"),
                    'status' => 'Approve',
                    'status_delete' => 2,
                    'approved_by' => 1,
                ]);
        }
        else {
            User::where('approved_by', 0)->update(['status' => 'Approve', 'status_delete' => 2, 'approved_by' => 1]);
        }


        DB::table('employment_status_check')
        ->where('status_approve', '=', 'Waiting')
        ->update([
            'status_approve' => 'Approve',
        ]);

        DB::table('notification')
            ->where('message', 'LIKE', '%User%')
            ->where('status_approve', 'Waiting')
            ->update([
                'approved_by' => Auth::User()->fullname,
                'declined_by' => null,
                'status_approve' => 'Approve',
                'updated_by' => Auth::User()->id,
                'approved_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->back();
    }

    public function declineall(Request $request)
    {
        $data_users = DB::table('users')
            ->where('approved_by', 0)
            ->where('status', 'Waiting')
            ->get();

        foreach ($data_users as $user) {
            $id_notif = DB::table('notification')
                ->where('link', $user->id)
                ->where('message', 'LIKE', '%User%')
                ->where('status_approve', 'Waiting')
                ->get();

            $message_notif = $id_notif[0]->message;

            if ($message_notif == 'Edit User') {
                // $data_lama = (array) json_decode($id_notif[0]->data_lama)[0];
                $data_lama = json_decode($id_notif[0]->data_lama);

                $data_lama_user = (array) $data_lama->user[0][0];
                $data_lama_emer = $data_lama->emergency_user;

                DB::table('emergencies')->where('user_id', $user->id)->delete();
                foreach ($data_lama_emer as $k => $v) {
                    // $data_lama_emer[$k] = (array) $v;

                    $emergencies = new Emergencies();
                    $emergencies->user_id = $v->user_id;
                    $emergencies->name = $v->name;
                    $emergencies->contact = $v->contact;
                    $emergencies->relationship = $v->relationship;
                    $emergencies->address = $v->address;
                    $emergencies->created_by = $v->created_by;
                    $emergencies->updated_by = $v->updated_by;
                    $emergencies->save();
                }

                DB::table('users')
                    ->where('id', $user->id)
                    ->update($data_lama_user);
            } else if ($message_notif == 'Create User') {
                // DB::table('emergencies')->where('user_id', $user->id)->delete();

                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'status_delete' => 1,
                        'approved_by' => 2,
                        'status' => 'Delete',
                        'employee_status' => 'INACTIVE',
                    ]);
            }

            DB::table('notification')
                ->where('id', $id_notif[0]->id)
                ->update([
                    'declined_by' => Auth::User()->fullname,
                    'status_approve' => 'Decline',
                    'updated_by' => Auth::User()->id,
                ]);
        }

        return redirect()->back();
    }

    public function decline(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        $id_notif = DB::table('notification')
            ->where('link', $user->id)
            ->where('message', 'LIKE', '%User%')
            ->where('status_approve', 'Waiting')
            ->get();

        $message_notif = $id_notif[0]->message;

        if ($message_notif == 'Edit User') {
            // $data_lama = (array) json_decode($id_notif[0]->data_lama)[0];
            $data_lama = json_decode($id_notif[0]->data_lama);

            $data_lama_user = (array) $data_lama->user[0][0];
            $data_lama_emer = $data_lama->emergency_user;

            DB::table('emergencies')->where('user_id', $user->id)->delete();
            foreach ($data_lama_emer as $k => $v) {
                // $data_lama_emer[$k] = (array) $v;

                $emergencies = new Emergencies();
                $emergencies->user_id = $v->user_id;
                $emergencies->name = $v->name;
                $emergencies->contact = $v->contact;
                $emergencies->relationship = $v->relationship;
                $emergencies->address = $v->address;
                $emergencies->created_by = $v->created_by;
                $emergencies->updated_by = $v->updated_by;
                $emergencies->save();
            }

            DB::table('users')
                ->where('id', $user->id)
                ->update($data_lama_user);
        } else if ($message_notif == 'Create User') {
            // DB::table('emergencies')->where('user_id', $user->id)->delete();

            $user->status_delete = 1;
            $user->approved_by = 2;
            $user->status = 'Delete';
            $user->employee_status = 'INACTIVE';
            $user->save();
        }

        DB::table('notification')
            ->where('id', $id_notif[0]->id)
            ->update([
                'declined_by' => Auth::User()->fullname,
                'status_approve' => 'Decline',
                'updated_by' => Auth::User()->id,
            ]);

        return redirect()->back();
    }

    public function approval()
    {
        $users = DB::table('users')
            ->join('notification', 'notification.link', '=', 'users.id')
            ->select('users.*', 'notification.message as message', 'notification.data_lama', 'notification.data_baru')
            ->where('users.approved_by', '=', 0)
            ->where('notification.message', 'LIKE', '%User%')
            ->where('notification.status_approve', '=', 'Waiting')
            ->get();

        $area_outlets = Outlet::all();

        return view('user.approval', compact('users', 'area_outlets'));
    }

    public function editPassword(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        return response()->json(['data' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        if ($request->password != '' && strlen(trim($request->password)) > 0) {
            $user->password = Hash::make($request->password);
        }
        $user->updated_by = Auth::User()->id;
        $user->save();

        return redirect(route('dashboard.users.index'));
    }

    public function uploadUsers(Request $request)
    {
        $extension = $request->file('file')->getClientOriginalExtension();

        $ext = ['xlsx', 'xls'];

        if (!in_array($extension, $ext)) {

            return redirect()->route('.dashboard.users.index')->with('message', 'Format file tidak sesuai !');
        }

        $tmp_path = $_FILES["file"]["tmp_name"];
        $filename = $_FILES['file']['name'];
        $target_file = storage_path('app' . DIRECTORY_SEPARATOR . $filename);

        // move file upload to storage
        move_uploaded_file($tmp_path, $target_file);
        try {
            $import = new UsersImport();
            $import_data = Excel::import($import, $target_file);

            $return = 'Success';
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $return = $failure->errors();
            }
            File::delete($target_file);

            return redirect()->route('dashboard.users.index')->with('failure', $return[0]);
        }
        File::delete($target_file);

        return redirect()->route('dashboard.users.index')->with('success', $return);
    }

    public function uploadEmergency(Request $request)
    {
        $extension = $request->file('file')->getClientOriginalExtension();

        $ext = ['xlsx', 'xls'];

        if (!in_array($extension, $ext)) {

            return redirect()->route('.dashboard.users.index')->with('message', 'Format file tidak sesuai !');
        }

        $tmp_path = $_FILES["file"]["tmp_name"];
        $filename = $_FILES['file']['name'];
        $target_file = storage_path('app' . DIRECTORY_SEPARATOR . $filename);

        // move file upload to storage
        move_uploaded_file($tmp_path, $target_file);
        try {
            $import = new EmergenciesImport();
            $import_data = Excel::import($import, $target_file);

            $return = 'Success';
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $return = $failure->errors();
            }
            File::delete($target_file);

            return redirect()->route('dashboard.users.index')->with('failure', $return[0]);
        }
        File::delete($target_file);

        return redirect()->route('dashboard.users.index')->with('success', $return);
    }

    public function uploadGolonganDarah(Request $request)
    {
        $extension = $request->file('file')->getClientOriginalExtension();

        $ext = ['xlsx', 'xls'];

        if (!in_array($extension, $ext)) {

            return redirect()->route('.dashboard.users.index')->with('message', 'Format file tidak sesuai !');
        }

        $tmp_path = $_FILES["file"]["tmp_name"];
        $filename = $_FILES['file']['name'];
        $target_file = storage_path('app' . DIRECTORY_SEPARATOR . $filename);

        // move file upload to storage
        move_uploaded_file($tmp_path, $target_file);
        try {
            $import = new GolonganDarahImport();
            $import_data = Excel::import($import, $target_file);

            $return = 'Success';
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $return = $failure->errors();
            }
            File::delete($target_file);

            return redirect()->route('dashboard.users.index')->with('failure', $return[0]);
        }
        File::delete($target_file);

        return redirect()->route('dashboard.users.index')->with('success', $return);
    }

    public function action(Request $request)
    {

        $uploads = DB::table('uploads')->where('status', '=', 'Approve')->get();
        $id = [];

        foreach ($uploads as $upload) {
            $target_kebijakan = json_decode($upload->target_kebijakan);

            if (is_array($target_kebijakan)) {
                foreach ($target_kebijakan as $dept) {
                    if ($dept == Auth::user()->department) {
                        $id[] = $upload->id;
                    }
                }
            }
        }

        DB::table('users')
            ->where('id', Auth::User()->id)
            ->update([
                'read_policy' => 'yes',
                'list_file_kebijakan' => json_encode($id),
            ]);

        return 'Success';
    }

    public function downloadZip(Request $request)
    {
        $zip = new ZipArchive();
        $fileName = 'kebijakan.zip';
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) == true) {
            $files = File::files(public_path('/assets/uploadfile/'));
            foreach ($files as $key => $value) {
                $relativeName = basename($value);
                $zip->addFile($value, $relativeName);
            }
            $zip->close();
            return response()->download(public_path($fileName));
        }
        // Session::put('read_policy', 'yes');
        // return redirect()->back();
    }

    public function history(Request $request)
    {
        $data = 'User';

        $users = DB::table('notification')
            ->join('users', 'users.id', '=', 'notification.user_id')
            ->select('notification.*', 'users.fullname as fullname')
            ->where('message', 'LIKE', '%' . $data . '%')
            ->orderBy('notification.created_at', 'DESC')
            ->get();

        $area_outlets = Outlet::all();

        return view('user.history', compact('users', 'area_outlets'));
    }

    public function myArea(Request $request)
    {
        $data = DB::table('outlet_area')->where('user_id', $request->id)->get();
        $my_area = [];
        if (isset($data[0])) {
            $my_area = json_decode($data[0]->list_outlet);
        }

        return $my_area;
    }

    public function updateMyArea(Request $request)
    {
        $check = DB::table('outlet_area')->where('user_id', Auth::User()->id)->get();

        $area = $request->area;

        if (count($check) == 0) {
            DB::table('outlet_area')->insert([
                'user_id' => Auth::User()->id,
                'nik' => Auth::User()->nik,
                'user_fullname' => Auth::User()->fullname,
                'list_outlet' => json_encode($area),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::User()->id,
                'updated_by' => Auth::User()->id,
            ]);
        } else {
            DB::table('outlet_area')
                ->where('id', $check[0]->id)
                ->update([
                    'list_outlet' => json_encode($area),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => Auth::User()->id,
                ]);
        }

        return 'Update Area Berhasil !';
    }

    public function listArea()
    {
        $area_outlets = Outlet::all();
        $users = User::whereIn('department', [5, 6, 16])->where('employee_status', 'ACTIVE')->get();
        return view('user.area', compact('users', 'area_outlets'));
    }

    public function listAreaFilter(Request $request)
    {
        $date = $request->date;
        $user_fullname = $request->user_fullname;

        $hari_ini = $date;
        $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
        $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));

        $usr = [];
        foreach ($user_fullname as $v) {
            $usr[] = explode('|', $v)[0];
        }

        $data = DB::table('outlet_area')->whereIn('user_id', $usr)->get();
        $datas = [];
        foreach ($data as $k => $v) {
            $v->list_outlets = json_decode($v->list_outlet);

            $ol = [];
            foreach ($v->list_outlets as $key => $val) {
                $ol[] = "<label class='badge badge-info'>" . explode('|', $val)[1] . "</label>";
            }
            $ol = implode(' | ', $ol);

            $qry_visit = DB::select("
                            SELECT p.user_id, p.outlet_name_id, p.outlet_name, p.imgTaken
                            FROM posts p
                            WHERE 1=1
                            AND p.user_id = '" . $v->user_id . "'
                            AND p.imgTaken LIKE '%" . $date . "%'
                        ");

            $jml_visit = '0 Kunjungan dari ' . count($v->list_outlets);

            $visited = [];
            $not_visited = [];

            // get visited data
            foreach ($v->list_outlets as $kl => $vl) {
                $area_id = explode('|', $vl)[0];
                $area_name = explode('|', $vl)[1];

                foreach ($qry_visit as $kv => $vv) {
                    if ($area_id == $vv->outlet_name_id) {
                        $visited[] = $vl;
                    }
                }

                $visited = array_unique($visited);
            }

            // get not visited data
            $not_visited = $v->list_outlets;
            foreach ($visited as $kv2 => $vv2) {
                foreach ($not_visited as $k2 => $v2) {
                    if ($vv2 == $v2) {
                        unset($not_visited[$k2]);
                    }

                }
            }
            $not_visited = array_values($not_visited);

            $not_visited_tmp = [];
            foreach ($not_visited as $key2 => $value2) {
                $not_visited_tmp[] = explode('|', $value2)[1];
            }

            $visit_percent = 0;
            if (count($visited) > 0 || count($v->list_outlets) > 0) {
                $visit_percent = (count($visited) / count($v->list_outlets)) * 100;
            }

            $jml_visit = count($visited) . ' Kunjungan dari ' . count($v->list_outlets) . ' Area (' . round($visit_percent) . '%)';

            $ul = [];
            foreach ($not_visited_tmp as $kul => $vul) {
                $ul[] = "<label class='badge badge-info'>" . $vul . "</label>";
            }
            $ul = implode(' | ', $ul);

            $tr = "
                <tr>
                    <td>" . $v->user_fullname . "</td>
                    <td>" . $date . "</td>
                    <td>" . $ol . "</td>
                    <td>" . count($v->list_outlets) . "</td>
                    <td>" . $jml_visit . "</td>
                    <td>" . $ul . "</td>
                    <td>
                        <form action=" . route('reports.show_report') . " method='post' id='show-monthly-report'>
                            " . csrf_field() . "
                            <input type='hidden' name='user_fullname' value=" . $v->user_id . "|" . $v->user_fullname . ">
                            <input type='hidden' name='date' value=" . $tgl_pertama . ">
                            <input type='hidden' name='date2' value=" . $tgl_terakhir . ">
                            <input type='submit' value='Detail' class='btn btn-primary'>
                        </form>
                    </td>
                </tr>
            ";

            $datas[] = $tr;
        }

        return $datas;
    }

    public function listallarea()
    {
        $area_outlets = Outlet::all();
        $outlets = Outlet::all();
        $users = User::all();
        $jabatans = Jabatan::get(["name", "id"]);

        $datas = DB::table('outlet_area')->where('user_id', Auth::User()->id)->get();
        $data_areas = [];
        $id_data_areas = [];
        if (isset($datas[0])) {
            $areas = json_decode($datas[0]->list_outlet);
            foreach ($areas as $k => $v) {
                $expl = explode('|', $v);
                $data = ['id' => $expl[0], 'name' => $expl[1]];
                $data = (object) $data;
                $data_areas[] = $data;
                $id_data_areas[] = $expl[0];
            }
        }

        $data_add_areas = Outlet::whereNotIn('id', $id_data_areas)->get();

        return view('user.listarea', compact('users', 'jabatans', 'outlets', 'area_outlets', 'data_areas', 'data_add_areas'));
    }

    public function areaupdate(Request $request)
    {
        $area_id = [$request->id];
        $area_old_id = $request->old_id;

        $datas = DB::table('outlet_area')->where('user_id', Auth::User()->id)->get();
        $data_areas = [];
        if (isset($datas[0])) {
            $areas = json_decode($datas[0]->list_outlet);
            foreach ($areas as $k => $v) {
                if ($v != $area_old_id) {
                    $data_areas[] = $v;
                }
            }
        }

        $data_areas = array_merge($data_areas, $area_id);

        DB::table('outlet_area')
            ->where('user_id', Auth::User()->id)
            ->update([
                'list_outlet' => json_encode($data_areas),
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => Auth::User()->id,
            ]);

        return 'Ubah Area Berhasil !';
    }

    public function areadelete(Request $request)
    {
        $area_id = $request->id;

        $datas = DB::table('outlet_area')->where('user_id', Auth::User()->id)->get();
        $data_areas = [];
        if (isset($datas[0])) {
            $areas = json_decode($datas[0]->list_outlet);
            foreach ($areas as $k => $v) {
                if ($v != $area_id) {
                    $data_areas[] = $v;
                }
            }
        }

        DB::table('outlet_area')
            ->where('user_id', Auth::User()->id)
            ->update([
                'list_outlet' => json_encode($data_areas),
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => Auth::User()->id,
            ]);

        return 'Hapus Area Berhasil !';
    }

    public function areaadd(Request $request)
    {
        $area_id = [$request->outlet_id];

        $datas = DB::table('outlet_area')->where('user_id', Auth::User()->id)->get();

        if (count($datas) == 0) {
            DB::table('outlet_area')->insert([
                'user_id' => Auth::User()->id,
                'nik' => Auth::User()->nik,
                'user_fullname' => Auth::User()->fullname,
                'list_outlet' => json_encode($area_id),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::User()->id,
                'updated_by' => Auth::User()->id,
            ]);
        } else {
            $data_areas = [];
            if (isset($datas[0])) {
                $areas = json_decode($datas[0]->list_outlet);
                foreach ($areas as $k => $v) {
                    if ($v != $area_id) {
                        $data_areas[] = $v;
                    }
                }
            }

            $data_areas = array_merge($data_areas, $area_id);

            DB::table('outlet_area')
                ->where('user_id', Auth::User()->id)
                ->update([
                    'list_outlet' => json_encode($data_areas),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => Auth::User()->id,
                ]);
        }

        return 'Tambah Area Berhasil !';
    }

    public function setarea()
    {
        $area_outlets = Outlet::all();
        $users = User::whereIn('department', [5, 6, 16])->get();

        $data = DB::table('outlet_area')->get();

        if (Auth::User()->id == 1) {
            $check_atasan1 = DB::table('mkt_structures')->get();
            $check_atasan2 = DB::table('mkt_structures')->get();
        } else {
            $check_atasan1 = DB::table('mkt_structures')->where('direct_supervisor', Auth::User()->id)->get();
            $check_atasan2 = DB::table('mkt_structures')->where('immediate_manager', Auth::User()->id)->get();
        }

        $check_atasan = [];
        if (count($check_atasan1) > 0) {
            foreach ($check_atasan1 as $k => $v) {
                $check_atasan[] = $v->user_id;
            }
        }

        if (count($check_atasan2) > 0) {
            foreach ($check_atasan2 as $k => $v) {
                $check_atasan[] = $v->user_id;
            }
        }

        $check_atasan = array_unique($check_atasan);
        // dd($check_atasan);

        $datas = [];
        if (Auth::user()->id == 1) {
            foreach ($data as $key => $value) {
                $list_outlets = json_decode($value->list_outlet);
                $ol = [];
                foreach ($list_outlets as $k => $v) {
                    $ol[] = "<label class='badge badge-info'>" . explode('|', $v)[1] . "</label>";
                }
                $ol = implode(' | ', $ol);

                $tr = "
                    <tr>
                        <td>" . $value->user_fullname . "</td>
                        <td>" . count($list_outlets) . "</td>
                        <td>" . $ol . "</td>
                    </tr>
                ";

                // $datas[] = $tr;

                $datas[] = [
                    'area_id' => $value->user_id,
                    'user_id' => $value->user_id,
                    'nik' => $value->nik,
                    'user_fullname' => $value->user_fullname,
                    'jml_area' => count($list_outlets),
                    'list_outlets' => $list_outlets,
                ];
            }
        } else {
            foreach ($data as $key => $value) {
                foreach ($check_atasan as $atasan) {
                    if ($atasan == $value->user_id) {
                        $list_outlets = json_decode($value->list_outlet);
                        $ol = [];
                        foreach ($list_outlets as $k => $v) {
                            $ol[] = "<label class='badge badge-info'>" . explode('|', $v)[1] . "</label>";
                        }
                        $ol = implode(' | ', $ol);

                        $tr = "
                            <tr>
                                <td>" . $value->user_fullname . "</td>
                                <td>" . count($list_outlets) . "</td>
                                <td>" . $ol . "</td>
                            </tr>
                        ";

                        // $datas[] = $tr;

                        $datas[] = [
                            'area_id' => $value->user_id,
                            'user_id' => $value->user_id,
                            'nik' => $value->nik,
                            'user_fullname' => $value->user_fullname,
                            'jml_area' => count($list_outlets),
                            'list_outlets' => $list_outlets,
                        ];
                    }
                }
            }
        }

        return view('user.setarea', compact('users', 'area_outlets', 'datas'));
    }

    public function getsetarea()
    {
        $area_outlets = Outlet::all();
        $users = User::all();

        $data = DB::table('outlet_area')->get();

        if (Auth::User()->id == 1) {
            $check_atasan1 = DB::table('mkt_structures')->get();
            $check_atasan2 = DB::table('mkt_structures')->get();
        } else {
            $check_atasan1 = DB::table('mkt_structures')->where('direct_supervisor', Auth::User()->id)->get();
            $check_atasan2 = DB::table('mkt_structures')->where('immediate_manager', Auth::User()->id)->get();
        }

        $check_atasan = [];
        if (count($check_atasan1) > 0) {
            foreach ($check_atasan1 as $k => $v) {
                $check_atasan[] = $v->user_id;
            }
        }

        if (count($check_atasan2) > 0) {
            foreach ($check_atasan2 as $k => $v) {
                $check_atasan[] = $v->user_id;
            }
        }

        $check_atasan = array_unique($check_atasan);
        // dd($check_atasan);

        /*
        $datas = [];
        foreach ($data as $key => $value) {
        $list_outlets = json_decode($value->list_outlet);

        $ol = [];
        foreach ($list_outlets as $k => $v) {
        $ol[] = "<label class='badge badge-info'>" . explode('|', $v)[1] . "</label>";
        }
        $ol = implode(' | ', $ol);

        $datas['data'][] = [
        'user_fullname' => $value->user_fullname,
        'jml_area' => count($list_outlets),
        'list_outlets' => $ol,
        'area_id' => $value->id,
        ];
        }
         */

        $datas = [];
        if (Auth::user()->id == 1) {
            foreach ($data as $key => $value) {
                $list_outlets = json_decode($value->list_outlet);

                $ol = [];
                foreach ($list_outlets as $k => $v) {
                    $ol[] = "<label class='badge badge-info'>" . explode('|', $v)[1] . "</label>";
                }
                $ol = implode(' | ', $ol);

                $datas['data'][] = [
                    'user_fullname' => $value->user_fullname,
                    'jml_area' => count($list_outlets),
                    'list_outlets' => $ol,
                    'area_id' => $value->id,
                ];
            }
        } else {
            foreach ($data as $key => $value) {
                foreach ($check_atasan as $atasan) {
                    if ($atasan == $value->user_id) {
                        $list_outlets = json_decode($value->list_outlet);

                        $ol = [];
                        foreach ($list_outlets as $k => $v) {
                            $ol[] = "<label class='badge badge-info'>" . explode('|', $v)[1] . "</label>";
                        }
                        $ol = implode(' | ', $ol);

                        $datas['data'][] = [
                            'user_fullname' => $value->user_fullname,
                            'jml_area' => count($list_outlets),
                            'list_outlets' => $ol,
                            'area_id' => $value->id,
                        ];
                    }
                }
            }
        }

        return $datas;
    }

    public function updatesetarea(Request $request)
    {
        $exp = explode('|', $request->user_id);
        $user_id = $exp[0];
        $nik = $exp[1];
        $user_fullname = $exp[2];

        $area = $request->area;

        $check = DB::table('outlet_area')->where('user_id', $user_id)->get();

        if (count($check) == 0) {
            DB::table('outlet_area')->insert([
                'user_id' => $user_id,
                'nik' => $nik,
                'user_fullname' => $user_fullname,
                'list_outlet' => json_encode($area),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::User()->id,
                'updated_by' => Auth::User()->id,
            ]);
        } else {
            DB::table('outlet_area')
                ->where('user_id', $user_id)
                ->update([
                    'list_outlet' => json_encode($area),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => Auth::User()->id,
                ]);
        }

        return 'Update Area Berhasil !';
    }

    public function editsetarea(Request $request)
    {
        $data = DB::table('outlet_area')->where('id', $request->area_id)->get();
        $my_area = [];
        if (isset($data[0])) {
            $my_area['user'] = [
                'user_id' => $data[0]->user_id . '|' . $data[0]->nik . '|' . $data[0]->user_fullname,
            ];
            $my_area['area'] = json_decode($data[0]->list_outlet);
        }

        return $my_area;
    }
}
