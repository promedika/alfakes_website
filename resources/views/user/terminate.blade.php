@extends('master')
@section('title')
    Employee Terminate
@endsection
@section('custom_link_css')
<!-- Select 2 -->
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employee Terminate </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Beranda</a></li>
              @if (Auth::user()->role == 0 || Auth::user()->role == 1)
              <li class="breadcrumb-item"><a href="{{route('dashboard.users.index')}}">Employee</a></li>
              @endif
              <li class="breadcrumb-item active">Employee Terminate</li>

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

                <input type="hidden" name="id" value="{{$datas->id}}" readonly>
                <!-- Employee Terminate -->
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Employee Terminate</h3>

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
                          <label for="termination_date">TERMINATION DATE <span style="color: red;">*</span></label>
                          <div class="input-group datepicker" data-target-input="nearest" data-toggle="datetimepicker" required>
                            <input type="text" name="termination_date" id="termination_date" class="form-control" placeholder="DD/Month/YYYY" value="{{$datas->termination_date}}" readonly required>
                            <div class="input-group-append" >
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                          <span id="errorTerminationDate" class="text-red"></span>
                        </div>
                        <div class="form-group">
                          <label for="terminate_reason">TERMINATE REASON <span style="color: red;">*</span></label>
                          <select class="form-control select2" id="terminate_reason" name="terminate_reason" required>
                              <option value="" style="display:none;">CHOOSE TERMINATE REASON</option>
                              @foreach ($terminate_reasons as $terminate_reason)
                              <option value="{{$terminate_reason->id}}" @php if ($datas->terminate_id == $terminate_reason->id) { echo 'selected'; } @endphp >
                                {{$terminate_reason->name}}
                              </option>
                              @endforeach
                          </select>
                          <span id="errorTerminateReason" class="text-red"></span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="job_status">JOB STATUS <span style="color: red;"></span></label>
                          <select class="form-control select2" id="job_status" name="job_status">
                              <option value="" style="display:none;">CHOOSE JOB STATUS</option>
                              <option value="ACTIVE" @php if ($datas->job_status == 'ACTIVE') { echo 'selected'; } @endphp >ACTIVE</option>
                              <option value="INACTIVE" @php if ($datas->job_status == 'INACTIVE') { echo 'selected'; } @endphp >INACTIVE</option>
                          </select>
                          <span id="errorJobStatus" class="text-red"></span>
                        </div>
                        <div class="form-group">
                          <label for="employee_status">EMPLOYEE STATUS <span style="color: red;"></span></label>
                          <select class="form-control select2" id="employee_status" name="employee_status">
                              <option value="" style="display:none;">CHOOSE EMPLOYEE STATUS</option>
                              <option value="ACTIVE" @php if ($datas->employee_status == 'ACTIVE') { echo 'selected'; } @endphp >ACTIVE</option>
                              <option value="INACTIVE" @php if ($datas->employee_status == 'INACTIVE') { echo 'selected'; } @endphp >INACTIVE</option>
                          </select>
                          <span id="errorJobStatus" class="text-red"></span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="resignation">RESIGNATION <span style="color: red;">*</span></label>
                          <div class="custom-file">
                            <input type="file" name="resignation" class="custom-file-input" id="resignation"  accept=".jpg, .png, .jpeg, .pdf" required>
                            <label class="custom-file-label label-resignation" for="resignation">Choose File</label>
                          </div>
                          @if (isset($datas->resignation))
                          <a href="{{asset('/assets/resignation').'/'.$datas->resignation}}" target="_blank"><span class="text-info">View File</span></a>
                          @endif
                        </div>
                      </div>

                      {{-- @endif --}}

                      <input type="hidden" value="" name="function" id="function" class="form-control">

                      </div>
                    </div>
                    <!-- /.row -->
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
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/moment/moment.min.js')}}"></script>
<!-- Select 2 -->
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('change', "input[name=resignation]", function (e) {
      // let fileName = $(this).val().split('\\').pop();
      let fileName = $(this).val().replace(/.*(\/|\\)/, '');
      $('.label-resignation').text(fileName);
    });

    $(document).on('blur', "input[type=text]", function () {
      $(this).val(function (_, val) {
        return val.toUpperCase();
      });
    });

    $(document).on('keyup', "input[type=text]", function () {
      $(this).val(function (_, val) {
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
    $('#area').on('change', function () {
        var idProvince = this.value;
        $("#kota").html('');

        jQuery.ajax({
            method: "post",
            url: site_url + "/api/fetch-cities",
            data: {
                province_code: idProvince,
                _token: '{{csrf_token()}}'
            },
            beforeSend: function() {
            },
            success:function(result){
                $('#kota option').remove();
                $('#kota').html('<option value="">CHOOSE CITIES</option>');
                $.each(result, function( key, value ) {
                    let val = value.id;
                    $("#kota").append('<option value="' + val + '">' + value.name + '</option>');
                });
            }
        });
    });

    $('#form-edit').submit(function(e){
        e.preventDefault();

        // check file extension
        fileName = document.querySelector('#resignation').value;
        regex = new RegExp('[^.]+$');
        extension = fileName.match(regex);

        if (fileName != '') {
        var extension = fileName.split('.').pop().toLowerCase();
        if (extension === 'pdf' || extension === 'png' || extension === 'jpg' || extension === 'jpeg') {
          // do nothing
        } else {
          alert('File extension must be .pdf, .png, .jpg, or .jpeg');
          return false;
        }
      }


        var formData = new FormData(this);
        $.ajax({
            url:"{{route('dashboard.users.update2')}}",
            type:'POST',
            data:formData,
            processData: false,
            contentType: false,
            cache: false,
            enctype: 'multipart/form-data',
            beforeSend: function() {
              $('button').prop('disabled',true);
              $('#loader').modal ('show');
            },
            success:function(data){
                alert(data.message);
                location.href = data.url;
            },
            error:function(response){
                alert(response);
                location.reload();
            }
        })
    })

    $("#address").attr("readonly", false); 

    $(document).on('keyup', "input[type=number]", function (e) {
      e.preventDefault;
      let check = /^\d+$/.test($(this).val());
      if (!check) { $(this).val(''); alert('Input must be a number'); }
    });
});
</script>
@endsection