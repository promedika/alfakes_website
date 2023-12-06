@extends('master')
@section('title')
    Edit Employee
@endsection
@section('custom_link_css')
    <!-- Select 2 -->
    <link rel="stylesheet" href="{{ asset('/assets/AdminLTE-3.2.0/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    
    <!-- Datatables -->
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
    <?php
    $emp_positions = DB::table('emp_positions')
        ->where('status_delete', '!=', 1)
        ->get();
    $immediate_positions = DB::table('immediate_positions')
        ->where('status_delete', '!=', 1)
        ->get();
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Employee </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Beranda</a></li>
                            @if (Auth::user()->role == 0 || Auth::user()->role == 1)
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Employee</a></li>
                            @endif
                            <li class="breadcrumb-item active">Edit Employee</li>

                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="" method="post" accept-charset="utf-8" id="form-edit" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $datas->id }}" readonly>

                    <!-- Employee Personal Data -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Employee Personal Data</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik">EMPLOYEE NO (NIK) <span style="color: red;">*</span></label>
                                        <input type="text" name="nik" id="nik" class="form-control"
                                            value="{{ $datas->nik }}" readonly>
                                        <span id="errorNik" class="text-red"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="fullname">EMPLOYEE NAME <span style="color: red;">*</span></label>
                                        <input type="text" name="fullname" id="fullname" class="form-control"
                                            value="{{ $datas->fullname }}" required>
                                        <span id="errorFullName" class="text-red"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="nik">EMPLOYEE NIK KTP <span style="color: red;">*</span></label>
                                        <input type="text" name="nik_ktp" id="nik_ktp" class="form-control"
                                            value="{{ $datas->nik_ktp }}" required>
                                        <span id="errorNikKtp" class="text-red"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">PHONE NUMBER <span style="color: red;">*</span></label>
                                        <input type="number" name="phone" id="phone" class="form-control"
                                            value="{{ $datas->phone }}" readonly>
                                        <span id="errorFullName" class="text-red"></span>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="birth_date">BIRTH DATE <span style="color: red;">*</span></label>
                                        <div class="input-group datepicker" data-target-input="nearest"
                                            data-toggle="datetimepicker">
                                            <input type="text" name="birth_date" id="birth_date" class="form-control"
                                                placeholder="DD/Month/YYYY" value="{{ $datas->birth_date }}" readonly
                                                required>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <span id="errorBirthDate" class="text-red"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">GENDER <span style="color: red;">*</span></label>
                                        <select class="form-control select2" id="gender" name="gender" required>
                                            <option value="" style="display:none;">CHOOSE GENDER</option>
                                            <option value="MAN"
                                                @php if ($datas->gender == 'MAN') { echo 'selected'; } @endphp>MEN</option>
                                            <option value="WOMEN"
                                                @php if ($datas->gender == 'WOMEN') { echo 'selected'; } @endphp>WOMEN
                                            </option>
                                        </select>
                                        <span id="errorGender" class="text-red"></span>
                                    </div>
                                </div>

                                <input type="hidden" value="promedika" name="password" id="password" class="form-control">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="religion">RELIGION <span style="color: red;">*</span></label>
                                        <select class="form-control select2" id="religion" name="religion" required>
                                            <option value="" style="display:none;">CHOOSE RELIGION</option>
                                            <option value="ISLAM"
                                                @php if ($datas->religion == 'ISLAM') { echo 'selected'; } @endphp>ISLAM
                                            </option>
                                            <option value="CHRISTIAN"
                                                @php if ($datas->religion == 'CHRISTIAN') { echo 'selected'; } @endphp>
                                                CHRISTIAN</option>
                                            <option value="CATHOLIC"
                                                @php if ($datas->religion == 'CATHOLIC') { echo 'selected'; } @endphp>
                                                CATHOLIC</option>
                                            <option value="HINDUISM"
                                                @php if ($datas->religion == 'HINDUISM') { echo 'selected'; } @endphp>
                                                HINDUISM</option>
                                            <option value="BUDDHISM"
                                                @php if ($datas->religion == 'BUDDHISM') { echo 'selected'; } @endphp>
                                                BUDDHISM</option>
                                            <option value="OTHER"
                                                @php if ($datas->religion == 'OTHER') { echo 'selected'; } @endphp>OTHER
                                            </option>
                                        </select>
                                        <span id="errorReligion" class="text-red"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">ROLE SYSTEM <span style="color: red;">*</span></label>
                                        <select class="form-control select2" id="role" name="role" required>
                                            <option value="" style="display:none;">CHOOSE ROLE SYSTEM</option>
                                            <option value="0"
                                                @php if ($datas->role == '0') { echo 'selected'; } @endphp>SUPER ADMIN
                                            </option>
                                            <option value="1"
                                                @php if ($datas->role == '1') { echo 'selected'; } @endphp>ADMIN</option>
                                            <option value="2"
                                                @php if ($datas->role == '2') { echo 'selected'; } @endphp>MEMBER</option>
                                            <option value="3"
                                                @php if ($datas->role == '3') { echo 'selected'; } @endphp>REPORT</option>
                                        </select>
                                        <span id="errorRole" class="text-red"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="golongan_darah">GOLONGAN DARAH <span style="color: red;">*</span></label>
                                        <select class="form-control select2" id="golongan_darah" name="golongan_darah" required>
                                            <option value="" style="display:none;">CHOOSE GOLONGAN DARAH</option>
                                            <option value="A"
                                                @php if ($datas->golongan_darah == 'A') { echo 'selected'; } @endphp>A
                                            </option>
                                            <option value="B"
                                                @php if ($datas->golongan_darah == 'B') { echo 'selected'; } @endphp>B</option>
                                            <option value="AB"
                                                @php if ($datas->golongan_darah == 'AB') { echo 'selected'; } @endphp>AB</option>
                                            <option value="O"
                                                @php if ($datas->golongan_darah == 'O') { echo 'selected'; } @endphp>O</option>
                                            <option value="-"
                                                @php if ($datas->golongan_darah == '-') { echo 'selected'; } @endphp>-</option>
                                        </select>
                                        <span id="errorGolonganDarah" class="text-red"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">ADDRESS <span style="color: red;">*</span></label>
                                        <textarea id="address" class="form-control" rows="6" cols="110"
                                            onkeypress="this.value = this.value + event.key.toUpperCase(); return false;" style="max-width: 100%"
                                            name="address" placeholder="" required>{{ $datas->address }}</textarea>
                                        <span id="errorAddress" class="text-red"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="marital_status">MARITAL STATUS <span
                                                style="color: red;">*</span></label>
                                        <select class="form-control select2" id="marital_status" name="marital_status"
                                            required>
                                            <option value="" style="display:none;">CHOOSE MARITAL STATUS</option>
                                            <option value="SINGLE"
                                                @php if ($datas->marital_status == 'SINGLE') { echo 'selected'; } @endphp>
                                                SINGLE</option>
                                            <option value="MARRIED"
                                                @php if ($datas->marital_status == 'MARRIED') { echo 'selected'; } @endphp>
                                                MARRIED</option>
                                            <option value="DIVORCED"
                                                @php if ($datas->marital_status == 'DIVORCED') { echo 'selected'; } @endphp>
                                                DIVORCED</option>
                                            <option value="WIDOW"
                                                @php if ($datas->marital_status == 'WIDOW') { echo 'selected'; } @endphp>
                                                WIDOW</option>
                                            <option value="WIDOWER"
                                                @php if ($datas->marital_status == 'WIDOWER') { echo 'selected'; } @endphp>
                                                WIDOWER</option>
                                        </select>
                                        <span id="errorMaritalStatus" class="text-red"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="education_level">EDUCATION LEVEL <span
                                                style="color: red;">*</span></label>
                                        <select class="form-control select2" id="education_level" name="education_level"
                                            required>
                                            <option value="" style="display:none;">CHOOSE EDUCATION LEVEL</option>
                                            <option value="SD"
                                                @php if ($datas->education_level == 'SD') { echo 'selected'; } @endphp>SD
                                            </option>
                                            <option value="SMP"
                                                @php if ($datas->education_level == 'SMP') { echo 'selected'; } @endphp>SMP
                                            </option>
                                            <option value="SMA/SMK"
                                                @php if ($datas->education_level == 'SMA/SMK') { echo 'selected'; } @endphp>
                                                SMA/SMK</option>
                                            <option value="DIPLOMA 1"
                                                @php if ($datas->education_level == 'DIPLOMA 1') { echo 'selected'; } @endphp>
                                                DIPLOMA 1</option>
                                            <option value="DIPLOMA 2"
                                                @php if ($datas->education_level == 'DIPLOMA 2') { echo 'selected'; } @endphp>
                                                DIPLOMA 2</option>
                                            <option value="DIPLOMA 3"
                                                @php if ($datas->education_level == 'DIPLOMA 3') { echo 'selected'; } @endphp>
                                                DIPLOMA 3</option>
                                            <option value="DIPLOMA 4"
                                                @php if ($datas->education_level == 'DIPLOMA 4') { echo 'selected'; } @endphp>
                                                DIPLOMA 4</option>
                                            <option value="STRATA 1"
                                                @php if ($datas->education_level == 'STRATA 1') { echo 'selected'; } @endphp>
                                                STRATA 1</option>
                                            <option value="STRATA 2"
                                                @php if ($datas->education_level == 'STRATA 2') { echo 'selected'; } @endphp>
                                                STRATA 2</option>
                                            <option value="STRATA 3"
                                                @php if ($datas->education_level == 'STRATA 3') { echo 'selected'; } @endphp>
                                                STRATA 3</option>
                                        </select>
                                        <span id="errorEducationLevel" class="text-red"></span>
                                    </div>
                                   
                                    <div class="form-group" style="margin-top:102px;">
                                        <label for="domisili">DOMISILI <span style="color: red;">*</span></label>
                                        <textarea id="domisili" class="form-control" rows="6" cols="110"
                                            onkeypress="this.value = this.value + event.key.toUpperCase(); return false;" style="max-width: 100%"
                                            name="domisili" placeholder="" required>{{ $datas->domisili }}</textarea>
                                        <span id="errorDomisili" class="text-red"></span>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-12">
                                    <label for="emergency">EMERGENCY CONTACT <span style="color: red;">*</span></label>
                                    <div class="card">
                                        <div class="card-header">
                                            
                                            <button id="addRow" class="btn btn-md btn-success"><i class="fa solid fa-plus"></i></button>
                                            <button id="deleteRow" class="btn btn-md btn-danger"><i class="fa solid fa-minus"></i></button>
                                        </div>
                                        <div class="card-body">
                                            <table id="emergency" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>NAME</th>
                                                        <th>RELATIONSHIP</th>
                                                        <th>PHONE</th>
                                                        <th>ADDRESS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($emergencies) > 0)
                                                        @foreach($emergencies as $v)
                                                        <tr>
                                                            <td><input value="{{ $v->name }}" type="text" name="emergency_name[]" class="form-control" required></td>
                                                            <td><input value="{{ $v->relationship }}" type="text" name="emergency_relationship[]" class="form-control" required></td>
                                                            <td><input value="{{ $v->contact }}" type="text" name="emergency_contact[]" class="form-control" required></td>
                                                            <td>
                                                                <input value="{{ $v->address }}" type="text" name="emergency_address[]" class="form-control" required>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td><input type="text" name="emergency_name[]" class="form-control" required></td>
                                                            <td><input type="text" name="emergency_relationship[]" class="form-control" required></td>
                                                            <td><input type="text" name="emergency_contact[]" class="form-control" required></td>
                                                            <td>
                                                                <input type="text" name="emergency_address[]" class="form-control" required>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- Employee Status -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Employee Status</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="join_date">JOIN DATE <span style="color: red;">*</span></label>
                                        <div class="input-group datepicker" data-target-input="nearest"
                                            data-toggle="datetimepicker">
                                            <input type="text" name="join_date" id="join_date" class="form-control"
                                                placeholder="DD/Month/YYYY" value="{{ $datas->join_date }}" readonly
                                                required>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <span id="errorJoinDate" class="text-red"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="employment_status">EMPLOYMENT STATUS <span
                                                style="color: red;">*</span></label>
                                        <select class="form-control select2" id="employment_status"
                                            name="employment_status" required>
                                            <option value="" style="display:none;">CHOOSE EMPLOYMENT STATUS</option>
                                            @foreach ($emp_stats as $emp_stat)
                                                <option value="{{ $emp_stat->id }}"
                                                    @php if ($datas->employment_status == $emp_stat->id) { echo 'selected'; } @endphp>
                                                    {{ $emp_stat->status_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="errorDepartment" class="text-red"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">EMPLOYMENT START DATE <span
                                                style="color: red;">*</span></label>
                                        <div class="input-group datepicker" data-target-input="nearest"
                                            data-toggle="datetimepicker">
                                            <input type="text" name="start_date" id="start_date" class="form-control"
                                                placeholder="DD/Month/YYYY" value="{{ $datas->start_date }}" readonly
                                                required>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <span id="errorStartDate" class="text-red"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="Jabatan">EMPLOYEE POSITION <span style="color: red;">*</span></label>
                                        <select class="form-control select2" id="jabatan" name="jabatan">
                                            <option value="" style="display:none;">CHOOSE EMPLOYEE POSITION</option>
                                            @foreach ($emp_positions as $position)
                                                <option value="{{ $position->id }}"
                                                    @php if ($datas->jabatan == $position->id) { echo 'selected'; } @endphp>
                                                    {{ $position->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="errorJabatan" class="text-red"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="job_title">JOB TITLE <span style="color: red;">*</span></label>
                                        <select class="form-control select2" id="job_title" name="job_title" required>
                                            <option value="" style="display:none;">CHOOSE JOB TITLE</option>
                                            <option value="DIRECT WORKER"
                                                @php if ($datas->job_title == 'DIRECT WORKER') { echo 'selected'; } @endphp>
                                                DIRECT WORKER</option>
                                            <option value="NON DIRECT WORKER"
                                                @php if ($datas->job_title == 'NON DIRECT WORKER') { echo 'selected'; } @endphp>
                                                NON DIRECT WORKER</option>
                                        </select>
                                        <span id="errorJobTitle" class="text-red"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="organization_unit">ORGANIZATION UNIT <span
                                                style="color: red;">*</span></label>
                                        <select class="form-control select2" id="organization_unit"
                                            name="organization_unit" required>
                                            <option value="" style="display:none;">CHOOSE ORGANIZATION UNIT</option>
                                            <option value="OPERATIONAL"
                                                @php if ($datas->organization_unit == 'OPERATIONAL') { echo 'selected'; } @endphp>
                                                OPERATIONAL</option>
                                            <option value="CORPORATE"
                                                @php if ($datas->organization_unit == 'CORPORATE') { echo 'selected'; } @endphp>
                                                CORPORATE</option>
                                        </select>
                                        <span id="errorOrganizationUnit" class="text-red"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="job_status">JOB STATUS <span style="color: red;">*</span></label>
                                        <select class="form-control select2" id="job_status" name="job_status" required>
                                            <option value="" style="display:none;">CHOOSE JOB STATUS</option>
                                            <option value="ACTIVE"
                                                @php if ($datas->job_status == 'ACTIVE') { echo 'selected'; } @endphp>
                                                ACTIVE</option>
                                            <option value="INACTIVE"
                                                @php if ($datas->job_status == 'INACTIVE') { echo 'selected'; } @endphp>
                                                INACTIVE</option>
                                        </select>
                                        <span id="errorJobStatus" class="text-red"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="employee_status">EMPLOYEE STATUS <span
                                                style="color: red;">*</span></label>
                                        <select class="form-control select2" id="employee_status" name="employee_status"
                                            required>
                                            <option value="" style="display:none;">CHOOSE EMPLOYEE STATUS</option>
                                            <option value="ACTIVE"
                                                @php if ($datas->employee_status == 'ACTIVE') { echo 'selected'; } @endphp>
                                                ACTIVE</option>
                                            <option value="INACTIVE"
                                                @php if ($datas->employee_status == 'INACTIVE') { echo 'selected'; } @endphp>
                                                INACTIVE</option>
                                        </select>
                                        <span id="errorJobStatus" class="text-red"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">EMPLOYMENT END DATE</label>
                                        <div class="input-group datepicker" data-target-input="nearest"
                                            data-toggle="datetimepicker" required>
                                            <input type="text" name="end_date" id="end_date" class="form-control"
                                                placeholder="DD/Month/YYYY" value="{{ $datas->end_date }}" readonly>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <span id="errorEndDate" class="text-red"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="immediate_position">IMMEDIATE POSITION </label>
                                        <select class="form-control select2" id="immediate_position"
                                            name="immediate_position">
                                            <option value="" style="display:none;">CHOOSE IMMEDIATE POSITION
                                            </option>
                                            @foreach ($immediate_positions as $immediate_position)
                                                <option value="{{ $immediate_position->id }}"
                                                    @php if ($datas->immediate_position == $immediate_position->id) { echo 'selected'; } @endphp>
                                                    {{ $immediate_position->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="errorimmediate_position" class="text-red"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employment_start_date_immediate">EMPLOYMENT PROMOTION START DATE </label>
                                        <div class="input-group datepicker" data-target-input="nearest"
                                            data-toggle="datetimepicker" required>
                                            <input type="text" name="employment_start_date_immediate" id="employment_start_date_immediate" class="form-control"
                                            placeholder="DD/Month/YYYY" value="{{ $datas->employment_start_date_immediate }}" readonly>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <span id="errorEndDate" class="text-red"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employment_end_date_immediate">EMPLOYMENT PROMOTION END DATE</label>
                                        <div class="input-group datepicker" data-target-input="nearest"
                                            data-toggle="datetimepicker" required>
                                            <input type="text" name="employment_end_date_immediate" id="employment_end_date_immediate" class="form-control"
                                            placeholder="DD/Month/YYYY" value="{{ $datas->employment_end_date_immediate }}" readonly>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <span id="errorEndDate" class="text-red"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- Employee Structure -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Employee Structure</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="direct_supervisor">DIRECT SUPERVISOR</label>
                                        <select name="direct_supervisor[]" id="direct_supervisor" class="form-control direct_supervisor select2"
                                        multiple="multiple" data-placeholder="CHOOSE DIRECT SUPERVISOR" style="display:none;" required>
                                            <option value="" style="display:none;">CHOOSE DIRECT SUPERVISOR</option>
                                            @foreach ($emp_positions as $position)
                                                <option value="{{ $position->id }}"
                                                    @php if ($datas->direct_supervisor == $position->id) { echo 'selected'; } if ($datas->direct_supervisor2 == $position->id) { echo 'selected'; } if ($datas->direct_supervisor3 == $position->id) { echo 'selected'; }@endphp>
                                                    {{ $position->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="errorDirectSupervisor" class="text-red"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="department">DEPARTMENT</label>
                                        <select class="form-control select2" id="department" name="department">
                                            <option value="" style="display:none;">CHOOSE DEPARTMENT</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    @php if ($datas->department == $department->id) { echo 'selected'; } @endphp>
                                                    {{ $department->dep_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="errorDepartment" class="text-red"></span>
                                    </div>
                                </div>

                                <!--  -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="immediate_manager">IMMEDIATE MANAGER</label>
                                        <select name="immediate_manager[]" id="immediate_manager" class="form-control immediate_manager select2"
                                        multiple="multiple" data-placeholder="CHOOSE IMMEDIATE MANAGER" style="display:none;" required>
                                            <option value="" style="display:none;">CHOOSE IMMEDIATE MANAGER</option>
                                            @foreach ($emp_positions as $position)
                                                <option value="{{ $position->id }}"
                                                    @php if ($datas->immediate_manager == $position->id) { echo 'selected'; } if ($datas->immediate_manager2 == $position->id) { echo 'selected'; } if ($datas->immediate_manager3 == $position->id) { echo 'selected'; }@endphp>
                                                    {{ $position->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="errorImmediateManager" class="text-red"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="division">DIVISION </label>
                                        <select class="form-control select2" id="division" name="division">
                                            <option value="" style="display:none;">CHOOSE DIVISION</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}"
                                                    @php if ($datas->division == $division->id) { echo 'selected'; } @endphp>
                                                    {{ $division->div_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="errorDivision" class="text-red"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="level">LEVEL <span style="color: red;">*</span></label>
                                        <select class="form-control select2" id="level" name="level" required>
                                            <option value="" style="display:none;">CHOOSE LEVEL</option>
                                            @foreach ($levels as $level)
                                                <option value="{{ $level->id }}"
                                                    @php if ($datas->level == $level->id) { echo 'selected'; } @endphp>
                                                    {{ $level->lev_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="errorLevel" class="text-red"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="work_location">WORK LOCATION</span></label>
                                        <input type="text" name="work_location" id="work_location"
                                            class="form-control" value="{{ $datas->work_location }}">
                                        <span id="errorWork_Location" class="text-red"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="area2">AREA 2</label>
                                        <select class="form-control select2" id="area2" name="area2">
                                            <option value="" style="display: none">CHOOSE AREA</option>
                                            @foreach ($provinces as $id => $name)
                                                <option value="{{ $id }}"
                                                    @php if ($datas->area2 == $id) { echo 'selected'; } @endphp>
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="errorArea2" class="text-red"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="grade_category">GRADE CATEGORY <span
                                                style="color: red;">*</span></label>
                                        <select class="form-control select2" id="grade_category" name="grade_category"
                                            required>
                                            <option value="" style="display:none;">CHOOSE GRADE CATEGORY</option>
                                            @foreach ($grades as $grade)
                                                <option value="{{ $grade->id }}"
                                                    @php if ($datas->grade_category == $grade->id) { echo 'selected'; } @endphp>
                                                    {{ $grade->grade_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="errorGradeCategory" class="text-red"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="area">AREA 1<span style="color: red;">*</span></label>
                                        <select class="form-control select2" id="area" name="area">
                                            <option value="" style="display: none">CHOOSE AREA</option>
                                            @foreach ($provinces as $id => $name)
                                                <option value="{{ $id }}"
                                                    @php if ($datas->area == $id) { echo 'selected'; } @endphp>
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="errorArea" class="text-red"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="area3">AREA 3</label>
                                        <select class="form-control select2" id="area3" name="area3">
                                            <option value="" style="display: none">CHOOSE AREA 3</option>
                                            @foreach ($provinces as $id => $name)
                                                <option value="{{ $id }}"
                                                    @php if ($datas->area3 == $id) { echo 'selected'; } @endphp>
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="errorArea3" class="text-red"></span>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- Button -->
                    <div class="card card-default">
                        <div class="card-body">
                            <button type="submit" id="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </form>
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
@section('custom_script_js')
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/moment/moment.min.js') }}"></script>
    <!-- Select 2 -->
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script
        src="{{ asset('/assets/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>

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
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('change', "input[name=resignation]", function(e) {
                // let fileName = $(this).val().split('\\').pop();
                let fileName = $(this).val().replace(/.*(\/|\\)/, '');
                $('.label-resignation').text(fileName);
            });

            $(document).on('blur', "input[type=text]", function() {
                $(this).val(function(_, val) {
                    return val.toUpperCase();
                });
            });

            $(document).on('keyup', "input[type=text]", function() {
                $(this).val(function(_, val) {
                    return val.toUpperCase();
                });
            });

            //Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4'
            });

            //Date picker
            $('.datepicker').datetimepicker({
                format: 'DD/MMMM/YYYY'
            });

            var site_url = "{{ url('/') }}";
            $('#area').on('change', function() {
                var idProvince = this.value;
                $("#kota").html('');

                jQuery.ajax({
                    method: "post",
                    url: site_url + "/api/fetch-cities",
                    data: {
                        province_code: idProvince,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {},
                    success: function(result) {
                        $('#kota option').remove();
                        $('#kota').html('<option value="">CHOOSE CITIES</option>');
                        $.each(result, function(key, value) {
                            let val = value.id;
                            $("#kota").append('<option value="' + val + '">' + value
                                .name + '</option>');
                        });
                    }
                });
            });

            $('#form-edit').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('dashboard.users.update') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    beforeSend: function() {
                        $('button').prop('disabled', true);
                        $('#loader').modal('show');
                    },
                    success: function(data) {
                        alert(data.message);
                        location.href = data.url;
                    },
                    error: function(response) {
                        alert(response.message);
                        location.reload();
                    }
                })
            })

            $("#address").attr("readonly", false);

            $(document).on('keyup', "input[type=number]", function(e) {
                e.preventDefault;
                let check = /^\d+$/.test($(this).val());
                if (!check) {
                    $(this).val('');
                    alert('Input must be a number');
                }
            });

            var t = $('#emergency').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            var counter = 1;
        
            $('#addRow').on('click', function (e) {
                e.preventDefault();

                let td_emer_name = '<input type="text" name="emergency_name[]" class="form-control" required>';
                let td_emer_relationship = '<input type="text" name="emergency_relationship[]" class="form-control" required>';
                let td_emer_contact = '<input type="text" name="emergency_contact[]" class="form-control" required>';
                let td_emer_address = '<input type="text" name="emergency_address[]" class="form-control" required>';

                t.row.add([td_emer_name, td_emer_relationship, td_emer_contact, td_emer_address]).draw(false);
        
                counter++;
            });

            $('#emergency tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    t.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }

                t.$('tr').css('background-color','#ffffff');
                t.$('tr.selected').css('background-color','#66c2ec');
            });
        
            $('#deleteRow').click(function (e) {
                e.preventDefault();
                t.row('.selected').remove().draw(false);
            });
        });
    </script>
@endsection
