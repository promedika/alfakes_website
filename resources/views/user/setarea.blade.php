@extends('master')
@section('title')
    Setting Area
@endsection
@section('custom_link_css')
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

    <style>
        /* For desktop: */
        @media (min-width: 769px) {
            /* .screen-mobile-area {display: none;} */
            div.dataTables_wrapper div.dataTables_paginate {
                width: 50%;
                float: right;
            }
            div.dataTables_wrapper div.dataTables_info {
                width: 50%;
                float: left;
            }
            div.dataTables_wrapper div.dataTables_filter {
                width: 50%;
                float: right;
            }
        }
    </style>
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
                        <h1>Setting Area</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Beranda</a></li>
                            <li class="breadcrumb-item active">Setting Area</li>
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
                            <select name="user_id" id="user" class="form-control" style="width: 100%;" required>
                              <option value="">Pilih User</option>
                              @foreach($users as $user)
                                @foreach($check_atasan as $atasan)
                                    @if ($atasan == $user->id)
                                    <option value="{{$user->id}}|{{$user->nik}}|{{$user->fullname}}">
                                        {{$user->fullname}}
                                    </option>
                                    @endif
                                @endforeach
                              @endforeach
                            </select>
                          </div>

                          <div class="col-4 form-group">
                            <select name="area[]" id="master_my_area_add" class="form-control select2"
                                multiple="multiple" data-placeholder="Pilih Area" style="width: 100%;" required>
                                @foreach ($area_outlets as $outlet)
                                    <option value="{{ $outlet->id . '|' . $outlet->name }}">
                                        {{ $outlet->name.' | '.$outlet->kab_kota }}
                                    </option>
                                @endforeach
                                <option>Washington</option>
                            </select>
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
                                            <th scope="col">Jumlah Area</th>
                                            <th scope="col">Area</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody> --}}
                                        {{-- @foreach ($datas as $data)
                                            <tr>
                                                <td>{{$data['user_fullname']}}</td>
                                                <td>{{$data['jml_area']}}</td>
                                                <td>
                                                    @foreach ($data['list_outlets'] as $key_outlet => $value_outlet)
                                                        <span class='badge badge-info'>{{explode('|',$value_outlet)[1]}}</span>
                                                        @if ($key_outlet != count($data['list_outlets']) - 1)|@endif
                                                    @endforeach
                                                </td>
                                                <td></td>
                                            </tr>
                                        @endforeach --}}
                                    {{-- </tbody> --}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <!-- Modal Setting Area -->
    <div class="modal fade in" id="modalSetArea" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-my-area_update">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update Setting Area</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="id_area" id="id_area" class="form-control">
                    <input type="hidden" name="edit_user_id_area" id="edit_user_id_area">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="first_name" type="text" name="first_name" id="first_name"></label>
                        </div>
                        <div class="form-group">
                            <label for="pilih area">Pilih Area <span style="font-size: 10px; color:red">*Area yang
                                    dipilih akan muncul di kunjungan</span></label>
                            <select name="my_area[]" id="master_my_area_edit" class="form-control select2"
                                multiple="multiple" data-placeholder="Pilih Area" style="width: 100%;" required>
                                @foreach ($area_outlets as $outlet)
                                    <option value="{{ $outlet->id . '|' . $outlet->name }}">
                                        {{ $outlet->name.' | '.$outlet->kab_kota }}
                                    </option>
                                @endforeach
                            </select>
                            <span id="errorMyArea" class="text-red"></span>
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
                    url: "{{ route('dashboard.users.updatesetarea') }}",
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
                        alert('Update area berhasil');
                        location.reload();
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

            $('#table').dataTable({
                processing: true,
                // serverSide: true,
                // deferRender: true,
                // paging: true,
                lengthChange: true,
                // searching: true,
                // ordering: true,
                // info: true,
                // autoWidth: false,
                responsive: true,
                // ajax: "{{ route('dashboard.users.getsetarea') }}",
                ajax: {
                    url: "{{ route('dashboard.users.getsetarea') }}",
                    type: "GET"
                },
                // columnDefs: [
                //     {
                //         targets: -1,
                //         data: null,
                //         defaultContent: "<button title='Edit' class='btn btn-warning btn-edit-area'><i class='fas fa-edit'></i></button>",
                //     },
                // ]
                columns: [
                    { data: "user_fullname" },
                    { data: "jml_area" },
                    { data: "list_outlets" },
                    {
                        "mData": "area_id",
                        "mRender": function (data, type, row) {
                            return "<button areaid='"+data+"' title='Edit' class='btn btn-warning btn-edit-area'><i class='fas fa-edit'></i></button>";
                        }
                    }
                ],
                dom: 'lBfrtip',
                // dom: '<"top"Blf>rt<"bottom"pi><"clear">',
                buttons: [ 
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                ]
            });

            $("body").on("click", ".btn-edit-area", function(e) {
                // e.preventDefault();
                let area_id = $(this).attr('areaid');
                // alert(area_id)
                $.ajax({
                    url: "{{ route('dashboard.users.editsetarea') }}",
                    type: 'POST',
                    data: {
                        area_id: area_id,
                    },
                    beforeSend: function() {
                        $('#modalSetArea').modal('show');
                    },
                    success: function(data) {
                        let usr = data.user.user_id;
                        let usr_split = usr.split('|');
                        $('#edit_user_id_area').val(usr);
                        $('label#first_name').text(usr_split[2]);
                        $.each(data.area, function(i, e) {
                            $("#master_my_area_edit option[value='" + e + "']").prop(
                                "selected", true).trigger('change');
                        });
                    },
                    error: function(response) {
                        alert('error');
                        location.reload();
                    }
                })
            })

            $('#form-my-area_update').submit(function(e) {
                e.preventDefault();
                let usr_id = $('#edit_user_id_area').val();
                let area = $('#master_my_area_edit').val();
                $.ajax({
                    url: "{{ route('dashboard.users.updatesetarea') }}",
                    type: 'POST',
                    data: {
                        user_id: usr_id,
                        area: area
                    },
                    beforeSend: function() {
                        // $('#form-my-area_update button[type="submit"]').prop('disabled',true);
                        $('#form-my-area_update button').prop('disabled',true);
                    },
                    success: function(data) {
                        alert('Update area berhasil');
                        location.reload();
                    },
                    error: function(response) {
                        alert('error');
                        location.reload();
                    }
                })
            })

            /*
            $("#table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [ 
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                ]
            }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
            */

            $('title').text('Setting Area');

            $('#user').select2({
                width:'100%',
                theme: 'bootstrap4',
            });

            $('#master_my_area_add').select2({
                width:'100%',
                theme: 'bootstrap4',
            });

            $('#master_my_area_edit').select2({
                width:'100%',
                theme: 'bootstrap4',
            });
        });
    </script>
@endsection
