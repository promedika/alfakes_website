@extends('master')
@section('title')
    Show Employee
@endsection
@section('custom_link_css')
    <!-- Select 2 -->
    <link rel="stylesheet" href="{{ asset('/assets/AdminLTE-3.2.0/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
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
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Show Employee </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Beranda</a>
                            </li>
                            @if (Auth::user()->role == 0 || Auth::user()->role == 1)
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Employee</a>
                                </li>
                            @endif
                            <li class="breadcrumb-item active">Show Employee</li>

                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if ($datas->status == 'Waiting')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-md-6">
                                    <a href="#" user-id="{{ $datas->id }}" title="Approve" class="btn btn-success col-4 btn-approve-user"><i class="fas fa-checklis"></i>Approve</a>
                                    <a href="#" user-id="{{ $datas->id }}" title="Decline" class="btn btn-danger col-4 btn-decline-user"><i class="fas fa-checklis"></i>Decline</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('assets/img/pngwing.com.png') }}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">{{ $datas->fullname }}</h3>
                                <p class="text-muted text-center">{{ $datas->role_name }}</p>
                          </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong>NIK</strong>

                                <p class="text-muted">
                                    {{ $datas->nik }}
                                </p>

                                <hr>

                                <strong>NIK KTP</strong>

                                <p class="text-muted">{{ $datas->nik_ktp }}</p>

                                <hr>

                                <strong>Phone Number</strong>

                                <p class="text-muted">{{ $datas->phone }}</p>

                                <hr>

                                <strong>Birth Date</strong>

                                <p class="text-muted">
                                    {{ date('d M Y', strtotime($datas->birth_date)) }}
                                </p>

                                <hr>

                                <strong>Gender</strong>

                                <p class="text-muted">{{ $datas->gender }}</p>

                                <hr>

                                <strong>Marital Status</strong>

                                <p class="text-muted">{{ $datas->marital_status }}</p>

                                <hr>

                                <strong>Religion</strong>

                                <p class="text-muted">{{ $datas->religion }}</p>

                                <hr>

                                <strong>Golongan Darah</strong>

                                <p class="text-muted">{{ $datas->golongan_darah }}</p>

                                <hr>

                                <strong>Education Level</strong>

                                <p class="text-muted">{{ $datas->education_level }}</p>

                                <hr>

                                <strong>Address</strong>

                                <p class="text-muted">{{ $datas->address }}</p>

                                <hr>

                                <strong>Domisili</strong>

                                <p class="text-muted">{{ $datas->domisili }}</p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link" href="#gps_emergency_contact"
                                        data-toggle="tab">Emergency Contact</a></li>
                                    <li class="nav-item"><a class="nav-link active" href="#gps_emp_status"
                                            data-toggle="tab">Employee Status</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#gps_emp_structure"
                                            data-toggle="tab">Employee Structure</a></li>

                                    @if ($datas->employee_status == 'INACTIVE')
                                        <li class="nav-item"><a class="nav-link" href="#gps_emp_terminate"
                                                data-toggle="tab">Employee Terminate</a></li>
                                    @endif
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane" id="gps_emergency_contact">
                                        <table class="table table-bordered table-hover" id="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Emergency Name</th>
                                                    <th>Emergency Phone</th>
                                                    <th>Emergency Relationship</th>
                                                    <th>Emergency Address</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $no = 1; @endphp
                                                @foreach ($emergencies as $emer)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $emer->name }}</td>
                                                        <td>{{ $emer->contact }}</td>
                                                        <td>{{ $emer->relationship }}</td>
                                                        <td>{{ $emer->address }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.tab-pane -->

                                    <div class="active tab-pane" id="gps_emp_status">
                                        <form class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="join_date" class="col-sm-2 col-form-label">Join Date</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ date('d M Y', strtotime($datas->join_date)) }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="employment_start_date"
                                                    class="col-sm-2 col-form-label">Employment Start Date</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ date('d M Y', strtotime($datas->start_date)) }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="employment_end_date"
                                                    class="col-sm-2 col-form-label">Employment End Date</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ date('d M Y', strtotime($datas->end_date)) }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                            @if($datas->employment_start_date_immediate != NULL || $datas->employment_end_date_immediate != NULL)
                                            <div class="form-group row">
                                                <label for="employment_start_date"
                                                    class="col-sm-2 col-form-label">Employment Promotion Start Date</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ date('d M Y', strtotime($datas->employment_start_date_immediate)) }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="employment_end_date"
                                                    class="col-sm-2 col-form-label">Employment Promotion End Date</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ date('d M Y', strtotime($datas->employment_end_date_immediate)) }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="form-group row">
                                                <label for="employment_status" class="col-sm-2 col-form-label">Employment
                                                    Status</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ $datas->status_name }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="employee_position" class="col-sm-2 col-form-label">Employee
                                                    Position</label>
                                                <div class="col-sm-10">
                                                    <?php $emp_positions = DB::table('emp_positions')->where('id',$datas->jabatan)->where('status_delete','!=',1)->pluck('name'); ?>
                                                    <input type="text" class="form-control"
                                                        value="{{ isset($emp_positions[0]) ? $emp_positions[0] : ''}}" style="background-color: #FFFFFF;"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="job_title" class="col-sm-2 col-form-label">Job Title</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ $datas->job_title }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="job_status" class="col-sm-2 col-form-label">Job Status</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ $datas->job_status }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="organization_unit"
                                                    class="col-sm-2 col-form-label">Organization Unit</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ $datas->organization_unit }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="employee_status" class="col-sm-2 col-form-label">Employee
                                                    Status</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ $datas->employee_status }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="role" class="col-sm-2 col-form-label">Length Of Service</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ $datas->length_of_service }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="role" class="col-sm-2 col-form-label">Role System</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ $datas->role_name }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->

                                    <div class="tab-pane" id="gps_emp_structure">
                                        <form class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="direct_supervisor" class="col-sm-2 col-form-label">Direct
                                                    Supervisor</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ $datas->direct_supervisor_name }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="immediate_manager" class="col-sm-2 col-form-label">Immediate
                                                    Manager</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ $datas->immediate_manager_name }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="department" class="col-sm-2 col-form-label">Department</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ $datas->dep_name }}" style="background-color: #FFFFFF;"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="division" class="col-sm-2 col-form-label">Division</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ $datas->div_name }}" style="background-color: #FFFFFF;"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="level" class="col-sm-2 col-form-label">Level</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ $datas->level }} - {{ $datas->lev_name }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="grade_category" class="col-sm-2 col-form-label">Grade
                                                    Category</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ $datas->grade_level }} - {{ $datas->grade_name }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="area" class="col-sm-2 col-form-label">Area 1</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ isset($datas->provinces) ? $datas->provinces : '' }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="area2" class="col-sm-2 col-form-label">Area 2</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ isset(json_decode($area2)[0]->name) ? json_decode($area2)[0]->name : '' }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="area3" class="col-sm-2 col-form-label">Area 3</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ isset(json_decode($area3)[0]->name) ? json_decode($area3)[0]->name : '' }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="work_location" class="col-sm-2 col-form-label">Work
                                                    Location</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ $datas->work_location }}"
                                                        style="background-color: #FFFFFF;" readonly>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->

                                    @if ($datas->employee_status == 'INACTIVE')
                                        <div class="tab-pane" id="gps_emp_terminate">
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <label for="end_date" class="col-sm-2 col-form-label">Employment End
                                                        Date</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control"
                                                            value="{{ date('d M Y', strtotime($datas->end_date)) }}"
                                                            style="background-color: #FFFFFF;" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="termination_date"
                                                        class="col-sm-2 col-form-label">Termination Date</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control"
                                                            value="{{ date('d M Y', strtotime($datas->termination_date)) }}"
                                                            style="background-color: #FFFFFF;" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="terminate_reason"
                                                        class="col-sm-2 col-form-label">Termination Reason</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control"
                                                            value="{{ $datas->terminate_name }}"
                                                            style="background-color: #FFFFFF;" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="resignation"
                                                        class="col-sm-2 col-form-label">Resignation</label>
                                                    <div class="col-sm-10">
                                                        <a href="{{ asset('/assets/resignation') . '/' . $datas->resignation }}"
                                                            target="_blank" class="btn btn-info">Resignation File</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
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
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/moment/moment.min.js') }}"></script>
    <!-- Select 2 -->
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script
        src="{{ asset('/assets/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
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
                // "scrollX": true,
            });

            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust()
                .responsive.recalc();
            }); 

            $('.btn-approve-user').click(function() {
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

            $('.btn-decline-user').click(function() {
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
        });
    </script>
@endsection
