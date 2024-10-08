<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alfakes Indonesia - Kerja, Maju, Sejahtera Bersama - @yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- <!-- Google / Search Engine Tags --> --}}
    <meta itemprop="name" content="Alfakes Indonesia - Kerja, Maju, Sejahtera Bersama" />
    <meta itemprop="description" content="Alfakes Indonesia - Asosiasi Perusahaan Laboratorium Pengujian dan Kalibrasi Fasilitas Kesehatan Indonesia" />
    <meta itemprop="image" content="{{ asset('/assets/frontend/img/alfakes_og_meta.jpg') }}" />

    {{-- <!-- Facebook Meta Tags --> --}}
    <meta property="og:url" content="https://alfakesindonesia.com/login" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Alfakes Indonesia - Kerja, Maju, Sejahtera Bersama" />
    <meta property="og:description" content="Alfakes Indonesia - Asosiasi Perusahaan Laboratorium Pengujian dan Kalibrasi Fasilitas Kesehatan Indonesia" />
    <meta property="og:image" content="{{ asset('/assets/frontend/img/alfakes_og_meta.jpg') }}" />

    {{-- <!-- Twitter Meta Tags --> --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Alfakes Indonesia - Kerja, Maju, Sejahtera Bersama" />
    <meta name="twitter:description" content="Alfakes Indonesia - Asosiasi Perusahaan Laboratorium Pengujian dan Kalibrasi Fasilitas Kesehatan Indonesia" />
    <meta name="twitter:image" content="{{ asset('/assets/frontend/img/alfakes_og_meta.jpg') }}" />

    <!-- favicon -->
    <link rel="icon" href="{{ asset('/assets/frontend/img/favicon.ico') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/assets/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/assets/AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/assets/AdminLTE-3.2.0/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('/assets/AdminLTE-3.2.0/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    
    <!-- csrf -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @yield('custom_link_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="modal fade in" id="loader" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: transparent; box-shadow: none; border: none;">
                <div class="modal-body" style="left: 25%">
                    <img src="{{ asset('/assets/img/gps-loader.gif') }}" style="width:50%; height:100%;">
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <img src="{{ asset('assets/img/pngwing.com.png') }}" class="img-circle elevation-2"
                            style="width:30px; height:30px" alt="User Image">
                        @php $check_fullname = explode(" ", Auth::User()->fullname); @endphp
                        @if (count($check_fullname) > 2)
                        <span><b>{{ $check_fullname[0]." ".$check_fullname[1] }}</b></span>
                        @else
                        <span><b>{{ Auth::User()->fullname }}</b></span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-md">
                        <a href="#" user-id="{{ Auth::User()->id }}"
                            class="dropdown-item btn-edit-user-master-password" style="text-align: center"><i
                                class="fas fa-cog"> Ubah Password</i></a>
                        <a href="{{ route('logout') }}" user-id="{{ Auth::User()->id }}"
                            class="dropdown-item btn-logout" style="text-align: left"><i class="fas fa-door-open">
                                Logout</i></a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4" style="background: #dce6f0;">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard.index') }}" class="brand-link">
                <img src="{{ asset('assets/img/logo_alfakes_only.png') }}" alt="Alfakes Indonesia" class="brand-image"
                    style="margin-left: 5px; margin-right: 0; max-height: 50px; margin-top: -0.5rem;">
                <strong>
                    <span class="brand-text" style="color: #b2d136;">ALFA</span><span class="brand-text" style="color: #1a76d1;">KES</span>
                </strong>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('members.index') }}" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <p>Members</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('price_lists.index') }}" class="nav-link">
                                <i class="nav-icon fa fa-tags"></i>
                                <p>Price Lists</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="wrapper" style="background: rgb(14, 84, 236);">
            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                &nbsp;
            </div>
            <!-- Default to the left -->
            <strong>&copy; Copyright {{date('Y')}} | All Rights Reserved by <a href="{{ route('home.index') }}" target="_blank">Alfakes Indonesia</a></strong>
        </footer>
    </div>

    <!-- Modal Edit User -->
    <div class="modal fade in" id="modalEditUserPassword" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="javascript:void(0)" method="post" accept-charset="utf-8"
                    id="form-edit-master-password">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Ubah Password</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="id" id="id" class="form-control">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fullname" type="text"
                                name="first_name">{{ Auth::User()->fullname }}</label>
                        </div>
                        <div class="form-group">
                            <label for="password">Password <span style="font-size: 10px; color:red">*Kosongkan jika
                                    tidak ingin merubah password</span></label>
                            <input placeholder="Kosongkan jika tidak ingin merubah password" type="master_password"
                                name="master_password" id="master_password_update" class="form-control">
                            <span id="errorPassword" class="text-red"></span>
                        </div>
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
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/assets/AdminLTE-3.2.0/dist/js/adminlte.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery("body").on("click", ".btn-edit-user-master-password", function(e) {
                $('#modalEditUserPassword').modal('show');
                var userID = $(this).attr('user-id');
                var id = $('#id').val(userID);
                $.ajax({
                    url: "{{ route('dashboard.users.editpassword') }}",
                    type: 'POST',
                    data: {
                        id: userID,
                    },
                    success: function(data) {
                        console.log('success edit');
                        $('#master_password_update').val(data.data.password);;
                    },
                    error: function(response) {
                        $('#errorPassword').text(response.responseJSON.errors.password);
                    }

                })

                $('#form-edit-master-password').submit(function(e) {
                    e.preventDefault();
                    let modal_id = $('#modalEditUserPassword');
                    var formData = new FormData(this);
                    $.ajax({
                        url: "{{ route('dashboard.users.updatepassword') }}",
                        type: 'POST',
                        data: formData,
                        data: {
                            id: userID,
                            password: $('#master_password_update').val(),
                        },
                        beforeSend: function() {
                            modal_id.find('.modal-footer button').prop('disabled',
                                true);
                            modal_id.find('.modal-header button').prop('disabled',
                                true);
                        },
                        success: function(data) {
                            console.log('success update');
                            location.reload();
                        },
                        error: function(response) {
                            $('#errorPassword').text(response.responseJSON.errors
                                .password);

                            modal_id.find('.modal-footer button').prop('disabled',
                                false);
                            modal_id.find('.modal-header button').prop('disabled',
                                false);
                        }
                    })
                })
            })

            $('.select2').select2({
                width: '100%',
                theme: 'bootstrap4',
            });
        })
    </script>

    @yield('custom_script_js')
</body>

</html>