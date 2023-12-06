@extends('master')
@section('title')
    Employee
@endsection

@section('custom_link_css')
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('/assets/AdminLTE-3.2.0/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('/assets/AdminLTE-3.2.0/plugins/toastr/toastr.min.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Employee</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Beranda</a></li>
                            <li class="breadcrumb-item active">Employee</li>
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
                                <a href="{{ route('dashboard.user.create') }}" title="Add"
                                    class="btn btn-primary col-2 btn-add-user"><i class="fa solid fa-plus"></i></a>
                                <a href="#" title="Employee Import" class="btn btn-success col-2 btn-import-user"><i
                                        class="fa solid fa-file-import"></i></a>
                                <a href="#" title="Emergency Import" class="btn btn-info col-2 btn-import-emergency"><i
                                    class="fa solid fa-file-import"></i></a>
                                @if(Auth::User()->id == 1)
                                <a href="#" title="Golongan Darah Import" class="btn btn-info col-2 btn-import-golongan_darah"><i
                                    class="fa solid fa-file-import"></i></a>
                                @endif
                            </div>

                            {{-- @if (session()->has('success'))
                                <div class="alert alert-success mt-2">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            @if (session()->has('failure'))
                                <div class="alert alert-danger mt-2">
                                    {{ session()->get('failure') }}
                                </div>
                            @endif --}}
                            @php
                                $session_message = '';
                                if (session()->has('success')) {
                                    $session_message = 'success';
                                } elseif (session()->has('failure')) {
                                    $session_message = 'failure';
                                }
                            @endphp
                            <input type="hidden" id="session_message" value="{{$session_message}}">

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Employee NIK</th>
                                            <th>Employee Name</th>
                                            <th>Employment Status</th>
                                            <th>Employee Position</th>
                                            <th>Employee Status</th>
                                            <th width="100"></th>
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
                                            @endphp
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $user->nik }}</td>
                                                <td>{{ $user->fullname }}</td>
                                                <td>{{ $user->employment_status }}</td>
                                                <td>{{ isset($emp_positions[0]) ? $emp_positions[0] : '' }}</td>
                                                <td>{{ $user->employee_status }}</td>
                                                <td>
                                                    <a href="{{ route('dashboard.user.show', ['id' => $user->id]) }}"
                                                        user-id="{{ $user->id }}" title="view"
                                                        class="btn btn-info btn-sm btn-view-user"><i
                                                            class="fas fa-eye"></i></a>
                                                    <a href="{{ route('dashboard.user.edit', ['id' => $user->id]) }}"
                                                        user-id="{{ $user->id }}" title="edit"
                                                        class="btn btn-warning btn-sm btn-edit-user"><i
                                                            class="fas fa-edit"></i></a>
                                                    <a href="{{ route('dashboard.user.terminate', ['id' => $user->id]) }}"
                                                        user-id="{{ $user->id }}" title="terminate"
                                                        class="btn btn-danger btn-sm btn-terminate-user"><i
                                                            class="fas fa-user-times"></i></a>
                                                    {{--
                                  <a href="#" user-id="{{$user->id}}" data-user="{{$user->fullname}}" title="delete" class="btn btn-danger btn-delete-user"><i class="fas fa-trash"></i></a>
                                  --}}
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
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    {{-- import user --}}
    <div class="modal fade in" id="modal-import-user" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('dashboard.users.upload') }}" method="post" accept-charset="utf-8" id="form-import"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Import Data Karyawan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <p>
                                <font color="red">* Format file harus .xlsx atau .xls</font>
                            </p>
                            <a class="btn btn-sm btn-info"
                                href="{{ asset('/assets/template/employee_template.xlsx') }}">Download Template</a><br><br>
                            <!-- <label for="name">Pilih File</label> -->
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input name" id="import_file"
                                    accept=".xlsx, .xls" required>
                                <input type="hidden" name="status_delete" id="status_delete" value="1"
                                    class="form-control">
                                <input type="hidden" name="approved_by" id="approved_by" value="0"
                                    class="form-control">
                                <label class="custom-file-label label-file" for="file">Choose File</label>
                            </div>
                            <!-- <input type="file" name="file" class="name" id="import_file" accept=".xlsx, .xls" required > -->
                            <span id="errorName" class="text-red"></span>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- import emergency --}}
    <div class="modal fade in" id="modal-import-emergency" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('dashboard.emergency.upload') }}" method="post" accept-charset="utf-8" id="form-import"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Import Data Emergency</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <p>
                                <font color="red">* Format file harus .xlsx atau .xls</font>
                            </p>
                            <a class="btn btn-sm btn-info"
                                href="{{ asset('/assets/template/emergency_template.xlsx') }}">Download Template</a><br><br>
                            <!-- <label for="name">Pilih File</label> -->
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input name" id="import_file_emer"
                                    accept=".xlsx, .xls" required>
                                <input type="hidden" name="status_delete" id="status_delete" value="1"
                                    class="form-control">
                                <input type="hidden" name="approved_by" id="approved_by" value="0"
                                    class="form-control">
                                <label class="custom-file-label label-file" for="file">Choose File</label>
                            </div>
                            <!-- <input type="file" name="file" class="name" id="import_file" accept=".xlsx, .xls" required > -->
                            <span id="errorName" class="text-red"></span>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     {{-- import golongan darah --}}
     <div class="modal fade in" id="modal-import-golongan_darah" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('dashboard.golongan_darah.upload') }}" method="post" accept-charset="utf-8" id="form-import"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Import Data Golongan Darah</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <p>
                                <font color="red">* Format file harus .xlsx atau .xls</font>
                            </p>
                            <a class="btn btn-sm btn-info"
                                href="{{ asset('/assets/template/golongan_darah_template.xlsx') }}">Download Template</a><br><br>
                            <!-- <label for="name">Pilih File</label> -->
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input name" id="import_file_emer"
                                    accept=".xlsx, .xls" required>
                                <input type="hidden" name="status_delete" id="status_delete" value="1"
                                    class="form-control">
                                <input type="hidden" name="approved_by" id="approved_by" value="0"
                                    class="form-control">
                                <label class="custom-file-label label-file" for="file">Choose File</label>
                            </div>
                            <!-- <input type="file" name="file" class="name" id="import_file" accept=".xlsx, .xls" required > -->
                            <span id="errorName" class="text-red"></span>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade in" id="modalDeleteUser" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" accept-charset="utf-8" id="form-delete">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="id" id="id_delete" class="form-control">

                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menghapus data <span></span> ini ?</p>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
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

    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/toastr/toastr.min.js') }}"></script>

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

            $(document).on('change', "input[name=file]", function(e) {
                let fileName = $(this).val().replace(/.*(\/|\\)/, '');
                $('.label-file').text(fileName);
            });

            $('.btn-import-user').click(function() {
                $('#modal-import-user').modal('show');
            });

            $('#modal-import-user #submit').click(function() {
                if ($('#import_file').val() == '') {
                    toastr.info('File tidak boleh kosong!');
                    return false;
                } else {
                    $('#modal-import-user').modal('hide');
                    $('#loader').modal('show');
                }
            });

            $('.btn-import-emergency').click(function() {
                $('#modal-import-emergency').modal('show');
            });

            $('.btn-import-golongan_darah').click(function() {
                $('#modal-import-golongan_darah').modal('show');
            });

            $('#modal-import-emergency #submit').click(function() {
                if ($('#import_file_emer').val() == '') {
                    toastr.info('File tidak boleh kosong!');
                    return false;
                } else {
                    $('#modal-import-emergency').modal('hide');
                    $('#loader').modal('show');
                }
            });

            jQuery("body").on("click", ".btn-delete-user", function(e) {
                $('#modalDeleteUser').find('.modal-body span').text($(this).data("user"));
                $('#modalDeleteUser').modal('show');
                var usrID = $(this).attr('user-id');
                var id = $('#id_delete').val(usrID);
                $('#form-delete').submit(function(e) {
                    e.preventDefault();
                    let modal_id = $('#modalCreateUser');
                    $.ajax({
                        url: "{{ route('dashboard.users.delete') }}",
                        type: 'POST',
                        data: {
                            id: usrID,
                        },
                        beforeSend: function() {
                            modal_id.find('.modal-footer button').prop('disabled',
                            true);
                            modal_id.find('.modal-header button').prop('disabled',
                            true);
                        },
                        success: function(data) {
                            console.log('success deleted');
                            location.reload()
                        },
                        error: function(response) {
                            console.log('success failed');
                            location.reload()
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

            let session_message = $('#session_message').val();
            

            if (session_message == 'success') {
                toastr.info('Success');
            }
            
            if (session_message == 'failure') {
                toastr.error('Error');
            }
        })
    </script>
@endsection
