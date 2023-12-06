@extends('master')
@section('title')
    My Area
@endsection
@section('custom_link_css')
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<!-- Select 2 -->
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

<style>
  /* For mobile phones: */
  @media (max-width: 768px) {
    .screen-desktop-area {display: none;}
  }
  /* For desktop: */
  /* @media (min-width: 769px) and (max-width: 768px) {
    body {
      background-color: #de3163;
    }
  } */
  @media (min-width: 769px) {
    .screen-mobile-area {display: none;}
  }
</style>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">My Area</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Beranda</a></li>
            <li class="breadcrumb-item active">My Area</li>
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
                      <p>Untuk penambahan / perubahan data rumah sakit, bisa menghubungi Admin Marketing / IT / DM</p>
                      <div class="screen-desktop-area">
                          <a href="#" title="Add Area" class="btn btn-primary btn-add-useroutlet"><i class="fa solid fa-plus"></i> Tambah Area</a>
                          @if (Auth::user()->role == 0 || Auth::user()->role == 2)
                          {{-- <a href="#" title="Add RS" class="btn btn-success btn-add-outlet"><i class="fa solid fa-plus"></i> Tambah RS</a> --}}
                          @endif
                          <a href="#" title="Add User RS" class="btn btn-info btn-add-useroutletrs"><i class="fa solid fa-plus"></i> Tambah User RS</a>
                          <a href="#" title="Add Area" class="btn btn-secondary btn-add-jabatan"><i class="fa solid fa-plus"></i> Tambah Jabatan User RS</a>
                      </div>

                      <div class="screen-mobile-area">
                          <a href="#" title="Add Area" class="btn btn-primary btn-block btn-add-useroutlet"><i class="fa solid fa-plus"></i> Tambah Area</a>
                          @if (Auth::user()->role == 0 || Auth::user()->role == 2)
                          {{-- <a href="#" title="Add RS" class="btn btn-success btn-block btn-add-outlet"><i class="fa solid fa-plus"></i> Tambah RS</a> --}}
                          @endif
                          <a href="#" title="Add User RS" class="btn btn-info btn-block btn-add-useroutletrs"><i class="fa solid fa-plus"></i> Tambah User RS</a>
                          <a href="#" title="Add Area" class="btn btn-secondary btn-block btn-add-jabatan"><i class="fa solid fa-plus"></i> Tambah Jabatan User RS</a>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered table-hover" id="table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama RS</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          @php $no = 1; @endphp
                          
                          @foreach ($data_areas as $data_area)
                          <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data_area->name}}</td>
                            <td>
                              <a href="#" area-id="{{$data_area->id.'|'.$data_area->name}}" title="Edit" class="btn btn-warning btn-edit-useroutlet"><i class="fas fa-edit"></i></a>
                              {{-- <a href="#" area-id="{{$data_area->id.'|'.$data_area->name}}" area-name="{{$data_area->name}}" title="Delete" class="btn btn-danger btn-delete-useroutlet"><i class="fas fa-trash"></i></a> --}}
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

<!-- The Modal Add Jabatan -->
<div class="modal fade in" id="modalCreateJabatan" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-signup">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Buat Jabatan User RS</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
          <label for="name">Nama Jabatan</label>
          <input type="text" name="name" id="name" class="form-control" required>
          <span id="errorName" class="text-red"></span>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal Add RS -->
<div class="modal fade in" id="modalCreateOutlet" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-signup">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Buat RS</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
          <label for="name">Nama RS</label>
          <input type="text" name="name" id="name" class="form-control" required>
          <span id="errorName" class="text-red"></span>
        </div>

        <div class="form-group">
          <label for="kab_kota">Kab/Kota</label>
          <input type="text" name="kab_kota" id="kab_kota" class="form-control" required>
          <span id="errorName" class="text-red"></span>
        </div>

        <div class="form-group">
          <label for="alamat">Alamat</label>
          <textarea class="form-control" name="alamat" id="alamat"></textarea>
          <span id="errorName" class="text-red"></span>
        </div>

        <div class="form-group">
          <label for="provinsi">Provinsi</label>
          <input type="text" name="provinsi" id="provinsi" class="form-control">
          <span id="errorName" class="text-red"></span>
        </div>

        <div class="form-group">
          <label for="telepon">Telepon</label>
          <input type="text" name="telepon" id="telepon" class="form-control" required>
          <span id="errorName" class="text-red"></span>
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

<!-- The Modal Add User RS -->
<div class="modal fade in" id="modalCreateUserOutletRS" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-signup">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Buat User RS</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
          <label for="first_name">Nama User</label>
          <input type="text" name="name" id="name" class="form-control" required>
          <span id="errorName" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="outlet_name">Nama RS</label>
          <select id="outlet-dd" name="outlet_id" class="form-control" required>
            <option value="">Pilih Lokasi</option>
            @foreach ($data_areas as $outlet)
            <option value="{{$outlet->id}}">
                {{$outlet->name}}
            </option>
            @endforeach
        </select>
        </div>

        <div class="form-group">
          <label for="Jabatan">Jabatan</label>
          <select id="jabatan" name="jabatan" class="form-control" required>
            <option value="" style="display:none;">Pilih Jabatan</option>
            @foreach ($jabatans as $jabatan)
            <option value="{{$jabatan->id}}">{{$jabatan->name}}</option>
            @endforeach
        </select>
        </div>

        <div class="form-group">
          <label for="status">Status</label>
          <select id="status" name="status"  class="form-control" required>
            <option value=""style="display:none;">Pilih Status</option>
            <option value="AKTIF">AKTIF</option>
            <option value="EXPIRED">EXPIRED</option>
        </select>
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

<!-- The Modal Add -->
<div class="modal fade in" id="modalCreateUserOutlet" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-signup">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Buat Area</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="outlet_name">Nama RS</label>
            <select id="outlet-dd-area" name="outlet_id" class="form-control" required>
              <option value="">Pilih Lokasi</option>
              @foreach ($data_add_areas as $outlet)
              <option value="{{$outlet->id.'|'.$outlet->name}}">
                  {{$outlet->name.' | '.$outlet->kab_kota}}
              </option>
              @endforeach
            </select>
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

<!-- The Modal Edit -->
<div class="modal fade in" id="modalEditUserOutlet" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-edit">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Ubah Area</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="hidden" name="id" id="id" class="form-control">
      <!-- Modal body -->  
      <div class="modal-body">
        <div class="form-group">
          <label for="outlet_name">Nama RS</label>
          <select id="outlet_dd_update" name="outlet_id_update" value="{{ old('outlets_name')}}" class="form-control" required>
              <option value="">Silahkan Pilih</option>
              @foreach ($outlets as $outlet)
              <option value="{{$outlet->id.'|'.$outlet->name}}">{{$outlet->name.' | '.$outlet->kab_kota}}</option>
              @endforeach
          </select>
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


<!-- The Modal Delete-->
<div class="modal fade in" id="modalDeleteUserOutlet" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-delete">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Hapus Area</h4>
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
        <button type="submit" class="btn btn-primary">Hapus</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('custom_script_js')
<!-- DataTables  & Plugins -->
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- Select 2 -->
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js')}}"></script>

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
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

        $('#outlet-dd').select2({
            dropdownParent: $('#modalCreateUserOutletRS'),
            width:'100%',
            theme: 'bootstrap4',
        });

        $('#outlet-dd-area').select2({
            dropdownParent: $('#modalCreateUserOutlet'),
            width:'100%',
            theme: 'bootstrap4',
        });

        $('#outlet_dd_update').select2({
            dropdownParent: $('#modalEditUserOutlet'),
            width:'100%',
            theme: 'bootstrap4',
        });

        $('#jabatan').select2({
            dropdownParent: $('#modalCreateUserOutletRS'),
            width:'100%',
            theme: 'bootstrap4',
        });

        $('#jabatan_update').select2({
            dropdownParent: $('#modalEditUserOutlet'),
            width:'100%',
            theme: 'bootstrap4',
        });
        
        jQuery("body").on("click", ".btn-add-useroutlet", function(e){
            $('#modalCreateUserOutlet').modal('show');

            $('#modalCreateUserOutlet #form-signup').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalCreateUserOutlet');
                var formData = new FormData(this);
                $.ajax({
                    url:"{{route('dashboard.users.areaadd')}}",
                    type:'POST',
                    data:formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    beforeSend: function() {
                      modal_id.find('.modal-footer button').prop('disabled',true);
                      modal_id.find('.modal-header button').prop('disabled',true);
                    },
                    success:function(data){
                      alert('Tambah area berhasil');
                      location.reload();
                    },
                    error:function(response){
                      alert('Tambah area gagal');
                      location.reload();
                    }
                })
            })
        })
        
        jQuery("body").on("click", ".btn-edit-useroutlet", function(e) {
            $('#modalEditUserOutlet').modal('show');
            var useroutletID = $(this).attr('area-id');
            var id = $('#id').val(useroutletID);
            $("#outlet_dd_update").data('old_id',useroutletID);
            $("#outlet_dd_update").val(useroutletID).trigger('change');

            $('#form-edit').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalEditUserOutlet');
                $.ajax({
                    url:"{{route('dashboard.users.areaupdate')}}",
                    type:'POST',
                    data:{
                      id:$("#outlet_dd_update").val(),
                      old_id:$("#outlet_dd_update").data('old_id'),
                    },
                    beforeSend: function() {
                      modal_id.find('.modal-footer button').prop('disabled',true);
                      modal_id.find('.modal-header button').prop('disabled',true);
                    },
                    success:function(data){
                        alert('Ubah area berhasil');
                        location.reload();
                    },
                    error:function(response){
                        alert('Ubah area gagal');
                        location.reload();
                    }
                })
            })
        })
          
        jQuery("body").on("click", ".btn-delete-useroutlet", function(e) {
          $('#modalDeleteUserOutlet').find('.modal-body span').text($(this).attr("area-name"));
          $('#modalDeleteUserOutlet').modal('show');
          var useroutletID = $(this).attr('area-id');
          var id = $('#id_delete').val(useroutletID);
          $('#form-delete').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalDeleteUserOutlet');
                $.ajax({
                    url:"{{route('dashboard.users.areadelete')}}",
                    type:'POST',
                    data:{
                      id:useroutletID,
                    },
                    beforeSend: function() {
                      modal_id.find('.modal-footer button').prop('disabled',true);
                      modal_id.find('.modal-header button').prop('disabled',true);
                    },
                    success:function(data){
                      alert('Hapus area berhasil');
                      location.reload();
                    },
                    error:function(response){
                      alert('Hapus area gagal');
                      location.reload();
                    }
                })
            })
        })

        // $('.btn-add-outlet').click(function(){
        //     $('#modalCreateOutlet').modal('show');

        //     $('#modalCreateOutlet #form-signup').submit(function(e){
        //         e.preventDefault();
        //         let modal_id = $('#modalCreateOutlet');
        //         var formData = new FormData(this);
        //         $.ajax({
        //             url:"{{route('outlet.create')}}",
        //             type:'POST',
        //             data:formData,
        //             processData: false,
        //             contentType: false,
        //             cache: false,
        //             enctype: 'multipart/form-data',
        //             beforeSend: function() {
        //               modal_id.find('.modal-footer button').prop('disabled',true);
        //               modal_id.find('.modal-header button').prop('disabled',true);
        //             },
        //             success:function(data){
        //               alert('Tambah RS Berhasil');
        //               location.reload();
        //             },
        //             error:function(response){
        //               alert('Tambah RS Gagal');
        //               location.reload();
        //             }

                    
        //         })
        //     })
        // })

        jQuery("body").on("click", ".btn-add-useroutletrs", function(e){
            $('#modalCreateUserOutletRS').modal('show');

            $('#modalCreateUserOutletRS #form-signup').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalCreateUserOutletRS');
                var formData = new FormData(this);
                $.ajax({
                    url:"{{route('useroutlet.create')}}",
                    type:'POST',
                    data:formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    beforeSend: function() {
                      modal_id.find('.modal-footer button').prop('disabled',true);
                      modal_id.find('.modal-header button').prop('disabled',true);
                    },
                    success:function(data){
                      alert('Tambah User RS Berhasil');
                      location.reload();
                    },
                    error:function(response){
                      alert('Tambah User RS Gagal');
                      location.reload();
                    }
                })
            })
        })

        $('.btn-add-jabatan').click(function(){
            $('#modalCreateJabatan').modal('show');

            $('#modalCreateJabatan #form-signup').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalCreateJabatan');
                var formData = new FormData(this);
                $.ajax({
                    url:"{{route('jabatan.create')}}",
                    type:'POST',
                    data:formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    beforeSend: function() {
                      modal_id.find('.modal-footer button').prop('disabled',true);
                      modal_id.find('.modal-header button').prop('disabled',true);
                    },
                    success:function(data){
                      alert('Tambah jabatan berhasil');
                      location.reload();
                    },
                    error:function(response){
                      alert('Tambah jabatan gagal');
                      location.reload();
                    }
                })
            })
        })
    })
</script>
@endsection