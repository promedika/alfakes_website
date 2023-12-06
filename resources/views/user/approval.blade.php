@extends('master')
@section('title')
    Listing Approval
@endsection
@section('custom_link_css')
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Approve User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Employee</a></li>
                            <li class="breadcrumb-item active">Approve User</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="#" title="ApproveAll" class="btn btn-success btn-approveall-user"><i
                                        class="fas fa-checklis"></i>Approve All</a>
                                <a href="#" title="DeclineAll" class="btn btn-danger btn-declineall-user"><i
                                        class="fas fa-checklis"></i>Decline All</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Employee Name</th>
                                            <th>Data Baru</th>
                                            <th>Data Lama</th>
                                            <th>Description</th>
                                            <th>Employee Position</th>
                                            <th>Employee NIK</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($users as $user)
                                            @php
                                                if ($user->nik == '123456789') {
                                                    continue;
                                                }
                                                $emp_positions = DB::table('emp_positions')
                                                    ->where('id', $user->jabatan)
                                                    ->where('status_delete', '!=', 1)
                                                    ->pluck('name');
                                                
                                                $data_lama = json_decode($user->data_lama, true);
                                                $data_baru = json_decode($user->data_baru, true);
                                                
                                                if (isset($data_lama['user']) && isset($data_baru['user'])) {
                                                    $data_lama_user = $data_lama['user'][0];
                                                    $data_baru_user = $data_baru['user'][0];
                                                
                                                    $kolom_yang_diubah = ['fullname', 'employee_status', 'jabatan', 'religion', 'marital_status', 'education_level', 'start_date', 'end_date', 'employment_status', 'length_of_service', 'jabatan', 'level', 'grade_category', 'work_location', 'direct_supervisor', 'immediate_manager', 'termination_date', 'termination_reason', 'area', 'division', 'department', 'area2', 'area3', 'employment_start_date_immediate', 'employment_end_date_immediate', 'immediate_position'];
                                                
                                                    $perbedaan = array_diff_assoc($data_baru_user, $data_lama_user[0]);
                                                
                                                    $data_lama_value_berubah = [];
                                                    $data_baru_value = [];
                                                
                                                    foreach ($perbedaan as $key => $value) {
                                                        if (in_array($key, $kolom_yang_diubah)) {
                                                            $data_lama_value_berubah[$key] = $data_lama_user[0][$key];
                                                            $data_baru_value[$key] = $value;
                                                        }
                                                    }
                                                }
                                                if (isset($data_baru['user']) && $user->message == 'Create User') {
                                                    $data_baru_user = $data_baru['user'][0];
                                                
                                                    $kolom_yang_diubah = ['nik', 'join_date', 'division', 'department', 'immediate_position'];
                                                
                                                    $perbedaan = array_diff_assoc($data_baru_user);
                                                
                                                    $data_lama_value_berubah2 = [];
                                                    $data_baru_value2 = [];
                                                
                                                    foreach ($perbedaan as $key => $value) {
                                                        if (in_array($key, $kolom_yang_diubah)) {
                                                            $data_baru_value2[$key] = $value;
                                                        }
                                                    }
                                                }
                                                
                                            @endphp
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $user->fullname }}</td>
                                                @if ($user->message == 'Edit User')
                                                    <td>
                                                        @foreach ($data_baru_value as $key => $value)
                                                            @if ($key == 'employment_status')
                                                                <?php $datas = DB::table('emp_statuses')
                                                                    ->select('status_name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{ $datas->first()->status_name }}</label><br>
                                                            @elseif ($key == 'jabatan')
                                                                <?php $emp_position = DB::table('emp_positions')
                                                                    ->select('name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{isset($emp_position->first()->name) ? $emp_position->first()->name : ''; }}</label><br>
                                                            @elseif ($key == 'immediate_position')
                                                                <?php $immediate_position = DB::table('immediate_positions')
                                                                    ->select('name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-success'>
                                                                    {{ $formattedKey }} :
                                                                    {{ isset($immediate_position->first()->name) ? $immediate_position->first()->name : ''; }}
                                                                </label><br>
                                                            @elseif ($key == 'direct_supervisor')
                                                                <?php $emp_position = DB::table('emp_positions')
                                                                    ->select('name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{ isset($emp_position->first()->name) ? $emp_position->first()->name : '';}}</label><br>
                                                            @elseif ($key == 'immediate_manager')
                                                                <?php $emp_position = DB::table('emp_positions')
                                                                    ->select('name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{isset($emp_position->first()->name) ? $emp_position->first()->name : '';}}</label><br>
                                                            @elseif ($key == 'department')
                                                                <?php $departments = DB::table('departments')
                                                                    ->select('dep_name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <?php
                                                                $nama_department = count($departments) > 0 ? $departments->first()->dep_name : '';
                                                                ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{ $nama_department }}</label><br>
                                                            @elseif ($key == 'division')
                                                                <?php $division = DB::table('divisions')
                                                                    ->select('div_name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <?php
                                                                $nama_division = count($division) > 0 ? $division->first()->div_name : '';
                                                                ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{ $nama_division }}</label><br>
                                                            @elseif ($key == 'level')
                                                                <?php $levels = DB::table('levels')
                                                                    ->select('lev_name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{ $levels->first()->lev_name }}</label><br>
                                                            @elseif ($key == 'grade_category')
                                                                <?php $grade = DB::table('grade_categories')
                                                                    ->select('grade_name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{ $grade->first()->grade_name }}</label><br>
                                                            @elseif ($key == 'area')
                                                                <?php $area = DB::table('indonesia_provinces')
                                                                    ->select('name')
                                                                    ->where('code', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <?php
                                                                $nama_area = count($area) > 0 ? $area->first()->name : '';
                                                                ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{ $nama_area }}</label><br>
                                                            @elseif ($key == 'area2')
                                                                <?php $area2 = DB::table('indonesia_provinces')
                                                                    ->select('name')
                                                                    ->where('code', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{ $area2->first()->name }}</label><br>
                                                            @elseif ($key == 'area3')
                                                                <?php $area3 = DB::table('indonesia_provinces')
                                                                    ->select('name')
                                                                    ->where('code', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{ $area3->first()->name }}</label><br>
                                                            @elseif($key == 'start_date')
                                                                <?php
                                                                $formattedKey = strtoupper(str_replace('_', ' ', $key));
                                                                $formattedValue = date('d F Y', strtotime($value));
                                                                $formattedValue = strtoupper($formattedValue); // Mengubah bulan menjadi huruf besar semua
                                                                ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{ $formattedValue }}</label><br>
                                                            @elseif($key == 'end_date')
                                                                <?php
                                                                $formattedKey = strtoupper(str_replace('_', ' ', $key));
                                                                $formattedValue = date('d F Y', strtotime($value));
                                                                $formattedValue = strtoupper($formattedValue); // Mengubah bulan menjadi huruf besar semua
                                                                ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{ $formattedValue }}</label><br>
                                                            @elseif($key == 'employment_start_date_immediate')
                                                                <?php
                                                                $formattedKey = strtoupper(str_replace('_', ' ', $key));
                                                                $formattedKey = str_replace('EMPLOYMENT START DATE IMMEDIATE', 'EMPLOYMENT PROMOTION START DATE', $formattedKey);
                                                                
                                                                $formattedValue = date('d F Y', strtotime($value));
                                                                $formattedValue = strtoupper($formattedValue); // Mengubah bulan menjadi huruf besar semua
                                                                ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{ $formattedValue }}</label><br>
                                                            @elseif($key == 'employment_end_date_immediate')
                                                                <?php
                                                                $formattedKey = strtoupper(str_replace('_', ' ', $key));
                                                                $formattedKey = str_replace('EMPLOYMENT END DATE IMMEDIATE', 'EMPLOYMENT PROMOTION END DATE', $formattedKey);
                                                                
                                                                $formattedValue = date('d F Y', strtotime($value));
                                                                $formattedValue = strtoupper($formattedValue); // Mengubah bulan menjadi huruf besar semua
                                                                ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{ $formattedValue }}</label><br>
                                                            @else
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{ $value }}</label><br>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($data_lama_value_berubah as $key => $value)
                                                            @if ($key == 'employment_status')
                                                                <?php $datas = DB::table('emp_statuses')
                                                                    ->select('status_name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-danger'>{{ $formattedKey }} :
                                                                    {{ $datas->first()->status_name }}</label><br>
                                                            @elseif ($key == 'jabatan')
                                                                <?php $emp_position = DB::table('emp_positions')
                                                                    ->select('name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-danger'>{{ $formattedKey }} :
                                                                    {{isset($emp_position->first()->name) ? $emp_position->first()->name : '';}}</label><br>
                                                            @elseif ($key == 'immediate_position')
                                                                <?php $immediate_position = DB::table('immediate_positions')
                                                                    ->select('name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-danger'>{{ $formattedKey }} :
                                                                    {{ isset($immediate_position->first()->name) ? $immediate_position->first()->name : ''; }}</label><br>
                                                            @elseif ($key == 'direct_supervisor')
                                                                <?php $emp_position = DB::table('emp_positions')
                                                                    ->select('name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-danger'>{{ $formattedKey }} :
                                                                    {{ isset($emp_position->first()->name) ? $emp_position->first()->name : ''; }}</label><br>
                                                            @elseif ($key == 'immediate_manager')
                                                                <?php $emp_position = DB::table('emp_positions')
                                                                    ->select('name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-danger'>{{ $formattedKey }} :
                                                                    {{ isset($emp_position->first()->name) ? $emp_position->first()->name : ''; }}</label><br>
                                                            @elseif ($key == 'department')
                                                                <?php $departments = DB::table('departments')
                                                                    ->select('dep_name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <?php
                                                                $nama_department = count($departments) > 0 ? $departments->first()->dep_name : '';
                                                                ?>
                                                                <label class='badge badge-danger'>{{ $formattedKey }} :
                                                                    {{ $nama_department }}</label><br>
                                                            @elseif ($key == 'division')
                                                                <?php $division = DB::table('divisions')
                                                                    ->select('div_name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <?php
                                                                $nama_division = count($division) > 0 ? $division->first()->div_name : '';
                                                                ?>
                                                                <label class='badge badge-danger'>{{ $formattedKey }} :
                                                                    {{ $nama_division }}</label><br>
                                                            @elseif ($key == 'level')
                                                                <?php $levels = DB::table('levels')
                                                                    ->select('lev_name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-danger'>{{ $formattedKey }} :
                                                                    {{ $levels->first()->lev_name }}</label><br>
                                                            @elseif ($key == 'grade_category')
                                                                <?php $grade = DB::table('grade_categories')
                                                                    ->select('grade_name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-danger'>{{ $formattedKey }} :
                                                                    {{ $grade->first()->grade_name }}</label><br>
                                                            @elseif ($key == 'area')
                                                                <?php $area = DB::table('indonesia_provinces')
                                                                    ->select('name')
                                                                    ->where('code', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <?php
                                                                $nama_area = count($area) > 0 ? $area->first()->name : '';
                                                                ?>
                                                                <label class='badge badge-danger'>{{ $formattedKey }} :
                                                                    {{ $nama_area }}</label><br>
                                                            @elseif ($key == 'area2')
                                                                <?php $area2 = DB::table('indonesia_provinces')
                                                                    ->select('name')
                                                                    ->where('code', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-danger'>{{ $formattedKey }} :
                                                                    {{ $area2->first()->name }}</label><br>
                                                            @elseif ($key == 'area3')
                                                                <?php $area3 = DB::table('indonesia_provinces')
                                                                    ->select('name')
                                                                    ->where('code', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-danger'>{{ $formattedKey }} :
                                                                    {{ $area3->first()->name }}</label><br>
                                                            @elseif($key == 'start_date')
                                                                <?php
                                                                $formattedKey = strtoupper(str_replace('_', ' ', $key));
                                                                $formattedValue = date('d F Y', strtotime($value));
                                                                $formattedValue = strtoupper($formattedValue); // Mengubah bulan menjadi huruf besar semua
                                                                ?>
                                                                <label class='badge badge-danger'>{{ $formattedKey }} :
                                                                    {{ $formattedValue }}</label><br>
                                                            @elseif($key == 'end_date')
                                                                <?php
                                                                $formattedKey = strtoupper(str_replace('_', ' ', $key));
                                                                $formattedValue = date('d F Y', strtotime($value));
                                                                $formattedValue = strtoupper($formattedValue); // Mengubah bulan menjadi huruf besar semua
                                                                ?>
                                                                <label class='badge badge-danger'>{{ $formattedKey }} :
                                                                    {{ $formattedValue }}</label><br>
                                                            @elseif($key == 'employment_start_date_immediate')
                                                                <?php
                                                                $formattedKey = strtoupper(str_replace('_', ' ', $key));
                                                                    
                                                                    // Ganti kata kunci jika ditemukan
                                                                $formattedKey = str_replace('EMPLOYMENT START DATE IMMEDIATE', 'EMPLOYMENT PROMOTION START DATE', $formattedKey);
                                                                    
                                                                if ($value === '[NULL]' || $value === null) {
                                                                    $formattedValue = ''; // Kosongkan nilai jika $value adalah "[NULL]"
                                                                } else {
                                                                    $formattedValue = date('d F Y', strtotime($value));
                                                                    $formattedValue = strtoupper($formattedValue); // Mengubah bulan menjadi huruf besar semua
                                                                }
                                                                ?>
                                                                <label class='badge badge-danger'>{{ $formattedKey }} :
                                                                    {{ $formattedValue }}</label><br>
                                                                    @elseif($key == 'employment_end_date_immediate')
                                                                    <?php
                                                                    $formattedKey = strtoupper(str_replace('_', ' ', $key));
                                                                    
                                                                    // Ganti kata kunci jika ditemukan
                                                                    $formattedKey = str_replace('EMPLOYMENT END DATE IMMEDIATE', 'EMPLOYMENT PROMOTION END DATE', $formattedKey);
                                                                    
                                                                    if ($value === '[NULL]' || $value === null) {
                                                                        $formattedValue = ''; // Kosongkan nilai jika $value adalah "[NULL]"
                                                                    } else {
                                                                        $formattedValue = date('d F Y', strtotime($value));
                                                                        $formattedValue = strtoupper($formattedValue); // Mengubah bulan menjadi huruf besar semua
                                                                    }
                                                                    ?>
                                                                
                                                                    <label class='badge badge-danger'>{{ $formattedKey }} :
                                                                        {{ $formattedValue }}</label><br>                                                                
                                                            @else
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-danger'>{{ $formattedKey }} :
                                                                    {{ $value }}</label><br>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @elseif ($user->message == 'Create User')
                                                    <td>
                                                        @foreach ($data_baru_value2 as $key => $value)
                                                            @if ($key == 'department')
                                                                <?php $departments = DB::table('departments')
                                                                    ->select('dep_name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <?php
                                                                $nama_department = count($departments) > 0 ? $departments->first()->dep_name : '';
                                                                ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{ $nama_department }}</label><br>
                                                            @elseif ($key == 'division')
                                                                <?php $division = DB::table('divisions')
                                                                    ->select('div_name')
                                                                    ->where('id', $value)
                                                                    ->get(); ?>
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <?php
                                                                $nama_division = count($division) > 0 ? $division->first()->div_name : '';
                                                                ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{ $nama_division }}</label><br>
                                                            @elseif ($key == 'join_date')
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <?php
                                                                $join_date = date('d F Y', strtotime($value));
                                                                ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{ $join_date }}</label><br>
                                                            @else
                                                                <?php $formattedKey = strtoupper(str_replace('_', ' ', $key)); ?>
                                                                <label class='badge badge-success'>{{ $formattedKey }} :
                                                                    {{ $value }}</label><br>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td></td>
                                                @endif
                                                <td>{{ $user->message }}</td>
                                                <td>{{ isset($emp_positions[0]) ? $emp_positions[0] : '' }}</td>
                                                <td>{{ $user->nik }}</td>
                                                <td>
                                                    <a href="{{ route('dashboard.user.show1', ['id' => $user->id]) }}"
                                                        user-id="{{ $user->id }}" title="view"
                                                        class="btn btn-info btn-view-user"><i class="fas fa-eye"></i></a>
                                                    <a href="#" user-id="{{ $user->id }}" title="Approve"
                                                        class="btn btn-success btn-approve-user"><i
                                                            class="fas fa-checklis"></i>Approve</a>
                                                    <a href="#" user-id="{{ $user->id }}" title="Decline"
                                                        class="btn btn-danger btn-decline-user"><i
                                                            class="fas fa-checklis"></i>Decline</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <div class="modal fade in" id="modalApproveAlluser" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-approve-all">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Approve All user
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <input type="hidden" name="status_delete" id="status_delete"
                        value="{{ old('status_delete', '=', 1) }}" class="form-control">
                    <input type="hidden" name="approved_by" id="approved_by" value="{{ old('approved_by', '=', 0) }}"
                        class="form-control">
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Approve All</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade in" id="modalApproveuser" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-approve">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Approve user
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <input type="hidden" name="id" id="id" class="form-control">
                    <input type="hidden" name="status" id="status" class="form-control">
                    <input type="hidden" name="status_delete" id="status_delete"
                        value="{{ old('status_delete', '=', 1) }}" class="form-control">
                    <input type="hidden" name="approved_by" id="approved_by" value="{{ old('approved_by', '=', 0) }}"
                        class="form-control">

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Approve</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade in" id="modalDeclineAlluser" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-decline-all">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Decline All user
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <input type="hidden" name="status_delete" id="status_delete"
                        value="{{ old('status_delete', '=', 1) }}" class="form-control">
                    <input type="hidden" name="approved_by" id="approved_by" value="{{ old('approved_by', '=', 0) }}"
                        class="form-control">
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Decline All</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- The Modal Decline -->
    <div class="modal fade in" id="modalDeclineuser" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-decline">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Decline User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="id" id="id_decline" class="form-control">

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Decline</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom_script_js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            $('.btn-approveall-user').click(function() {
                $('#modalApproveAlluser').modal('show');
                var userID = $(this).attr('user-id');
                var id = $('#id').val(userID);

                $.ajax({
                    url: "{{ route('dashboard.users.edit2') }}",
                    type: 'POST',
                    data: {
                        id: userID,
                    },
                    success: function(data) {
                        $('#status_delete').val(data.status_delete);
                        $('#approved_by').val(data.approved_by);
                        $('#form-approve').data('id', userID);
                    },
                    error: function(response) {
                        $('#errorStatus_delete').text(response.responseJSON.errors
                            .status_delete);
                        $('#errorApproved_by').text(response.responseJSON.errors.approved_by);
                    }

                })

                $('#form-approve-all').submit(function(e) {
                    e.preventDefault();
                    let modal_id = $('#modalApproveAlluser');
                    let userID = $(this).data('id');
                    var formData = new FormData(this);
                    $.ajax({
                        url: "{{ route('dashboard.users.approveall') }}",
                        type: 'POST',
                        data: {
                            id: userID,
                            status_delete: $('#status_delete').val(),
                            approved_by: $('#approved_by').val(),
                        },
                        beforeSend: function() {
                            modal_id.find('.modal-footer button').prop('disabled',
                                true);
                            modal_id.find('.modal-header button').prop('disabled',
                                true);
                            modal_id.modal('hide');
                            $('#loader').modal('show');
                        },
                        success: function(data) {
                            alert('success approved');
                            location.reload();
                        },
                        error: function(response) {
                            alert('failed approved');
                            location.reload();
                        }
                    })
                })
            })


            $(document).on('click', ".btn-approve-user", function() {
                $('#modalApproveuser').modal('show');
                var userID = $(this).attr('user-id');
                var id = $('#id').val(userID);

                $.ajax({
                    url: "{{ route('dashboard.users.edit1') }}",
                    type: 'POST',
                    data: {
                        id: userID,
                    },
                    success: function(data) {
                        $('#status').val(data.status);
                        $('#status_delete').val(data.status_delete);
                        $('#approved_by').val(data.approved_by);
                        $('#form-approve').data('id', userID);
                    },
                    error: function(response) {
                        $('#errorStatus').text(response.responseJSON.errors
                            .status);
                        $('#errorStatus_delete').text(response.responseJSON.errors
                            .status_delete);
                        $('#errorApproved_by').text(response.responseJSON.errors.approved_by);
                    }

                })

                $('#form-approve').submit(function(e) {
                    e.preventDefault();
                    let modal_id = $('#modalApproveuser');
                    let userID = $(this).data('id');
                    var formData = new FormData(this);
                    $.ajax({
                        url: "{{ route('dashboard.users.approve') }}",
                        type: 'POST',
                        data: {
                            id: userID,
                            status: $('#status').val(),
                            status_delete: $('#status_delete').val(),
                            approved_by: $('#approved_by').val(),
                        },
                        beforeSend: function() {
                            modal_id.find('.modal-footer button').prop('disabled',
                                true);
                            modal_id.find('.modal-header button').prop('disabled',
                                true);
                            modal_id.modal('hide');
                            $('#loader').modal('show');
                        },
                        success: function(data) {
                            alert('success approved');
                            location.reload();
                        },
                        error: function(response) {
                            alert('failed approved');
                            location.reload();
                        }
                    })
                })
            })

            $(document).on('click', ".btn-decline-user", function() {
                $('#modalDeclineuser').modal('show');
                var userID = $(this).attr('user-id');
                var id = $('#id_decline').val(userID);
                $('#form-decline').submit(function(e) {
                    e.preventDefault();
                    let modal_id = $('#modalDeclineuser');
                    $.ajax({
                        url: "{{ route('dashboard.users.decline') }}",
                        type: 'POST',
                        data: {
                            id: userID,
                        },
                        beforeSend: function() {
                            modal_id.find('.modal-footer button').prop(
                                'disabled',
                                true);
                            modal_id.find('.modal-header button').prop(
                                'disabled',
                                true);
                            modal_id.modal('hide');
                            $('#loader').modal('show');
                        },
                        success: function(data) {
                            alert('success decline');
                            location.reload();
                        },
                        error: function(response) {
                            alert('failed decline');
                            location.reload();
                        }
                    })
                })
            })

            $('.btn-declineall-user').click(function() {
                $('#modalDeclineAlluser').modal('show');
                var userID = $(this).attr('user-id');
                var id = $('#id').val(userID);

                $.ajax({
                    url: "{{ route('dashboard.users.edit2') }}",
                    type: 'POST',
                    data: {
                        id: userID,
                    },
                    success: function(data) {
                        $('#status_delete').val(data.status_delete);
                        $('#approved_by').val(data.approved_by);
                        $('#form-decline-all').data('id', userID);
                    },
                    error: function(response) {
                        $('#errorStatus_delete').text(response.responseJSON.errors
                            .status_delete);
                        $('#errorApproved_by').text(response.responseJSON.errors.approved_by);
                    }

                })

                $('#form-decline-all').submit(function(e) {
                    e.preventDefault();
                    let modal_id = $('#modalDeclineAlluser');
                    let userID = $(this).data('id');
                    var formData = new FormData(this);
                    $.ajax({
                        url: "{{ route('dashboard.users.declineall') }}",
                        type: 'POST',
                        data: {
                            id: userID,
                            status_delete: $('#status_delete').val(),
                            approved_by: $('#approved_by').val(),
                        },
                        beforeSend: function() {
                            modal_id.find('.modal-footer button').prop('disabled',
                                true);
                            modal_id.find('.modal-header button').prop('disabled',
                                true);
                            modal_id.modal('hide');
                            $('#loader').modal('show');
                        },
                        success: function(data) {
                            alert('success decline');
                            location.reload();
                        },
                        error: function(response) {
                            alert('failed decline');
                            location.reload();
                        }
                    })
                })
            })


            $(document).on('keyup', "input[type=number]", function(e) {
                e.preventDefault;
                let check = /^\d+$/.test($(this).val());
                if (!check) {
                    $(this).val('');
                    alert('Input must be a number');
                }
            });
        })
    </script>
@endsection
