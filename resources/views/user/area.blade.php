@extends('master')
@section('title')
    Laporan Area
@endsection
@section('custom_link_css')
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
@endsection
@php
  if (Auth::User()->id == 1) {
    $check_atasan1 = DB::table('mkt_structures')->get();
    $check_atasan2 = DB::table('mkt_structures')->get();
  } else {
    $check_atasan1 = DB::table('mkt_structures')->where('direct_supervisor',Auth::User()->id)->get();
    $check_atasan2 = DB::table('mkt_structures')->where('immediate_manager',Auth::User()->id)->get();
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
@endphp
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Laporan Area</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Beranda</a></li>
                            <li class="breadcrumb-item active">Laporan Area</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                    <div>
                      <form action="javascript:void(0)" accept-charset="utf-8" id="list_area_filter">

                        @csrf
                        
                        <div class="card-header" style="display: flex">
                          <div class="col-4 form-group">
                            <select name="user_fullname[]" id="user" class="form-control" multiple="multiple" data-placeholder="Pilih User" style="width: 100%;" required>
                              <option value="">Pilih User</option>
                              @foreach($users as $user)
                                @foreach($check_atasan as $atasan)
                                    @if ($atasan == $user->id)
                                    <option value="{{$user->id}}|{{$user->fullname}}">
                                        {{$user->fullname}}
                                    </option>
                                    @endif
                                @endforeach
                              @endforeach
                            </select>
                          </div>

                          <div class="col-4 form-group">
                              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input value="" name="date" placeholder="Pilih Bulan & Tahun" type="text" class="form-control datetimepicker-input txtdate" data-toggle="datetimepicker" data-target="#reservationdate" readonly required/>
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>  
                              </div>
                          </div>

                          <div>
                             <input type="submit" value="Submit" class="btn btn-primary">
                          </div>
                        </div>
                      </form>
                    </div>
                </div>
              </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nama Karyawan</th>
                                            <th scope="col">Tahun & Bulan</th>
                                            <th scope="col">Area</th>
                                            <th scope="col">Jumlah Area</th>
                                            <th scope="col">Jumlah Kunjungan</th>
                                            <th scope="col">Area Belum Dikunjungi</th>
                                            <th scope="col">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
    <script src="{{asset('assets/AdminLTE-3.2.0/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <script>
        jQuery(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#list_area_filter').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('dashboard.users.listareafilter') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    beforeSend: function() {
                        $('#list_area_filter input[type="submit"]').prop('disabled',true);
                    },
                    success: function(data) {
                        console.log('success');
                        $('#list_area_filter input[type="submit"]').prop('disabled',false);
                        
                        $('#table').DataTable().destroy();
                        $('#table tbody tr').remove();

                        $('#table tbody').append(data);

                        $("#table").DataTable({
                            "responsive": true,
                            "lengthChange": false,
                            "autoWidth": false,
                            "buttons": [ 
                                {
                                    extend: 'copy',
                                    exportOptions: {
                                        columns: [ 0, 1, 2, 3, 4, 5 ]
                                    }
                                },
                                {
                                    extend: 'csv',
                                    exportOptions: {
                                        columns: [ 0, 1, 2, 3, 4, 5 ]
                                    }
                                },
                                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: [ 0, 1, 2, 3, 4, 5 ]
                                    }
                                },
                                {
                                    extend: 'pdf',
                                    exportOptions: {
                                        columns: [ 0, 1, 2, 3, 4, 5 ]
                                    }
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [ 0, 1, 2, 3, 4, 5 ]
                                    }
                                },
                            ]
                        }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
                    },
                    error: function(response) {
                        alert('error');
                        location.reload();
                    }
                })
            })

            $('.modalMd').off('click').on('click', function() {
                $('#modalMdContent').load($(this).attr('value'));
                $('#modalMdTitle').html($(this).attr('title'));
            });

            $("#table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [ 
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: [ 0, 1 ]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [ 0, 1 ]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 0, 1 ]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [ 0, 1 ]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1 ]
                        }
                    },
                ]
            }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');

            $('title').text('Laporan Area');

            //Date picker
            $('#reservationdate').datetimepicker({
                // viewMode: 'months', 
                format: 'YYYY-MM'
            });

            $('#user').select2({
                width:'100%',
                theme: 'bootstrap4',
            });
        });
    </script>
@endsection
