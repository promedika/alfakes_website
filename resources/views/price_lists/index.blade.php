@extends('master')
@section('title')
    Price Lists
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
                        <h1 class="m-0">Price Lists</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Beranda</a></li>
                            <li class="breadcrumb-item active">Price Lists</li>
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
                                <a href="#" title="Add"
                                    class="btn btn-primary btn-block col-2 btn-add-department"><i
                                        class="fa solid fa-plus"></i></a>
                            </div>
                            
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Price (Rp)</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($datas as $role)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>{{ $role->type }}</td>
                                                <td>
                                                    @php $price = isset($role->price) ? number_format($role->price,0,"",'.') : 0; @endphp
                                                    {{ $price }}
                                                </td>
                                                <td>
                                                    <a href="#" department-id="{{ $role->id }}" title="Update"
                                                        class="btn btn-warning btn-edit-department"><i
                                                            class="fas fa-edit"></i></a>
                                                            
                                                    <a href="#" department-id="{{ $role->id }}" department-name="{{ $role->name }}" title="Delete"
                                                        class="btn btn-danger btn-delete-department"><i
                                                            class="fas fa-trash"></i></a>
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
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>

    <!-- The Modal Add -->
    <div class="modal fade in" id="modalCreateDepartment" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-create" enctype="multipart/form-data">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Create</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name <span style="color: red;">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price <span style="color: red;">*</span></label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Type </label>
                            <select class="form-control select child" id="type" name="type" required>
                                <option value="IPM">IPM</option>
                                <option value="Kalibrasi Alat Kesehatan">Kalibrasi Alat Kesehatan</option>
                                <option value="Kalibrasi Kalibrator">Kalibrasi Kalibrator</option>
                            </select>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- The Modal Edit -->
    <div class="modal fade in" id="modalEditDepartment" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-edit">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="id" id="id" class="form-control">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name <span style="color: red;">*</span></label>
                            <input type="text" name="name" id="name_update" value="{{ old('name') }}"
                                class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="price">Price <span style="color: red;">*</span></label>
                            <input type="text" name="price" id="price_update" value="{{ old('price') }}"
                                class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="type">Type </label>
                            <select class="form-control select child" id="type_update" name="type" required>
                                <option value="IPM" @php if (old('type') == 'IPM') { echo 'selected'; } @endphp>IPM</option>
                                <option value="Kalibrasi Alat Kesehatan" @php if (old('type') == 'Kalibrasi Alat Kesehatan') { echo 'selected'; } @endphp>Kalibrasi Alat Kesehatan</option>
                                <option value="Kalibrasi Kalibrator" @php if (old('type') == 'Kalibrasi Kalibrator') { echo 'selected'; } @endphp>Kalibrasi Kalibrator</option>
                            </select>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- The Modal Delete -->
    <div class="modal fade in" id="modalDeleteDepartment" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-delete">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Delete</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="id" id="id_delete" class="form-control">

                    <!-- Modal body -->
                    <div class="modal-body">
                        <p>Apakah anda yakin menghapus harga <b><span id="del_role_name"></span></b> ?</p>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Delete</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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

            $('.btn-add-department').click(function() {
                $('#modalCreateDepartment').modal('show');

                $('#form-create').submit(function(e) {
                    e.preventDefault();
                    let modal_id = $('#modalCreateDepartment');
                    var formData = new FormData(this);
                    $.ajax({
                        url: "{{ route('price_lists.store') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: 'multipart/form-data',
                        beforeSend: function() {
                            modal_id.find('.modal-footer button').prop('disabled',
                                true);
                            modal_id.find('.modal-header button').prop('disabled',
                                true);
                            modal_id.modal('hide');
                            $('#loader').modal('show');
                        },
                        success: function(data) {
                            $('#loader').modal('hide');
                            Swal.fire({
                                title: "Create",
                                text: "Tambah data berhasil",
                                icon: "success",
                                confirmButtonColor: "#3085d6",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#loader').modal('hide');
                                    location.href = data.url;
                                }
                            });
                        },
                        error: function(response) {
                            let err_tmp = '';
                            $.each(response.responseJSON.image, function( i, v ) {
                                err_tmp += '<li>'+v+'</li>';
                            });

                            let error_message = err_tmp;

                            $('#loader').modal('hide');
                            Swal.fire({
                                title: "Create",
                                text: "Tambah data gagal",
                                icon: "error",
                                confirmButtonColor: "#3085d6",
                                footer: error_message
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#loader').modal('hide');
                                    location.reload();
                                }
                            });
                            $('.swal2-footer').css('display','block');
                        }
                    })
                })
            })


            $(document).on('click', ".btn-edit-department", function() {
                $('#modalEditDepartment').modal('show');
                var departmentID = $(this).attr('department-id');
                var id = $('#id').val(departmentID);

                $.ajax({
                    url: "{{ route('price_lists.edit') }}",
                    type: 'POST',
                    data: {
                        id: departmentID,
                    },
                    success: function(data) {
                        $('#name_update').val(data.name);
                        $('#price_update').val(data.price);
                        $('#type_update').val(data.type);
                        $('#form-edit').data('id', departmentID);
                    },
                    error: function(response) {
                        $('#errorName').text(response.responseJSON.errors.name);
                    }

                })

                $('#form-edit').submit(function(e) {
                    e.preventDefault();
                    let modal_id = $('#modalEditDepartment');
                    let departmentID = $(this).data('id');
                    var formData = new FormData(this);
                    $.ajax({
                        url: "{{ route('price_lists.update') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: 'multipart/form-data',
                        beforeSend: function() {
                            modal_id.find('.modal-footer button').prop('disabled',
                                true);
                            modal_id.find('.modal-header button').prop('disabled',
                                true);
                            modal_id.modal('hide');
                            $('#loader').modal('show');
                        },
                        success: function(data) {
                            $('#loader').modal('hide');
                            Swal.fire({
                                title: "Update",
                                text: "Update data berhasil",
                                icon: "success",
                                confirmButtonColor: "#3085d6",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#loader').modal('hide');
                                    location.href = data.url;
                                }
                            });
                        },
                        error: function(response) {
                            let err_tmp = '';
                            $.each(response.responseJSON.image, function( i, v ) {
                                err_tmp += '<li>'+v+'</li>';
                            });

                            let error_message = err_tmp;

                            $('#loader').modal('hide');
                            Swal.fire({
                                title: "Update",
                                text: "Update data gagal",
                                icon: "error",
                                confirmButtonColor: "#3085d6",
                                footer: error_message
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#loader').modal('hide');
                                    location.reload();
                                }
                            });
                            $('.swal2-footer').css('display','block');
                        }
                    })
                })
            })

            $(document).on('click', ".btn-delete-department", function() {
                $('#modalDeleteDepartment').modal('show');
                var departmentID = $(this).attr('department-id');
                var id = $('#id_delete').val(departmentID);
                var departmentName = $(this).attr('department-name');
                var id = $('#del_role_name').text(departmentName);

                $('#form-delete').submit(function(e) {
                    e.preventDefault();
                    let modal_id = $('#modalDeleteDepartment');

                    $.ajax({
                        url: "{{ route('price_lists.delete') }}",
                        type: 'POST',
                        data: {
                            id: departmentID,
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
                            $('#loader').modal('hide');
                            Swal.fire({
                                title: "Delete",
                                text: "Hapus data berhasil",
                                icon: "success",
                                confirmButtonColor: "#3085d6",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#loader').modal('hide');
                                    location.reload();
                                }
                            });
                        },
                        error: function(response) {
                            $('#loader').modal('hide');
                            Swal.fire({
                                title: "Delete",
                                text: "Hapus data gagal",
                                icon: "error",
                                confirmButtonColor: "#3085d6",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#loader').modal('hide');
                                    location.reload();
                                }
                            });
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
