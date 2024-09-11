@extends('frontend/layout')

@section('title')
    Members
@endsection

@section('custom_link_css')
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('/assets/frontend/css/bootstrap.min.css') }}">
	<!-- Nice Select CSS -->
	<link rel="stylesheet" href="{{ asset('/assets/frontend/css/nice-select.css') }}">
	<!-- Font Awesome CSS -->
	<link rel="stylesheet" href="{{ asset('/assets/frontend/css/font-awesome.min.css') }}">
	<!-- icofont CSS -->
	<link rel="stylesheet" href="{{ asset('/assets/frontend/css/icofont.css') }}">
	<!-- Slicknav -->
	<link rel="stylesheet" href="{{ asset('/assets/frontend/css/slicknav.min.css') }}">
	<!-- Owl Carousel CSS -->
	<link rel="stylesheet" href="{{ asset('/assets/frontend/css/owl-carousel.css') }}">
	<!-- Datepicker CSS -->
	<link rel="stylesheet" href="{{ asset('/assets/frontend/css/datepicker.css') }}">
	<!-- Animate CSS -->
	<link rel="stylesheet" href="{{ asset('/assets/frontend/css/animate.min.css') }}">
	<!-- Magnific Popup CSS -->
	<link rel="stylesheet" href="{{ asset('/assets/frontend/css/magnific-popup.css') }}">

	<!-- Datatables -->
	<link rel="stylesheet" href="//cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">
	
	<!-- Medipro CSS -->
	<link rel="stylesheet" href="{{ asset('/assets/frontend/css/normalize.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/frontend/style.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/frontend/css/responsive.css') }}">
@endsection

@section('custom_content')
	{{-- <!-- Breadcrumbs --> --}}
	<div class="breadcrumbs overlay">
		<div class="container">
			<div class="bread-inner">
				<div class="row">
					<div class="col-12">
						<h2>List Of Members</h2>
						<ul class="bread-list">
							<li><a href="{{ route('home.index') }}">Home</a></li>
							<li><i class="icofont-simple-right"></i></li>
							<li class="active">List Of Members</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- <!-- End Breadcrumbs --> --}}

	{{-- <!-- Start Portfolio Details Area --> --}}
	<section class="pf-details section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="inner-content">
						<div class="body-text">
							<h3>Anggota Alfakes Indonesia</h3>
							<p>Terdiri dari beberapa Perusahaan Laboratorium Pengujian, Kalibrasi, Pemeliharaan dan Perbaikan Fasilitas Kesehatan di Indonesia yang mempunyai standar sertifikasi KAN, antara lain yaitu :</p>
							<p>&nbsp;</p>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover" id="table">
									<thead class="thead-dark">
										<tr>
											<th>No</th>
											<th>Name</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@php $no = 1; @endphp
										@foreach ($datas as $data)
										<tr>
											<td>{{$no++}}</td>
											<td>{{$data->name}}</td>
											<td>
												<a href="{{ route('member.index', ['id' => $data->id]) }}"><button class="btn">View</button></a>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</section>
	{{-- <!-- End Portfolio Details Area --> --}}
@endsection

@section('custom_link_js')
	<!-- jquery Min JS -->
	<script src="{{ asset('/assets/frontend/js/jquery.min.js') }}"></script>
	<!-- jquery Migrate JS -->
	<script src="{{ asset('/assets/frontend/js/jquery-migrate-3.0.0.js') }}"></script>
	<!-- jquery Ui JS -->
	<script src="{{ asset('/assets/frontend/js/jquery-ui.min.js') }}"></script>
	<!-- Easing JS -->
	<script src="{{ asset('/assets/frontend/js/easing.js') }}"></script>
	<!-- Color JS -->
	<script src="{{ asset('/assets/frontend/js/colors.js') }}"></script>
	<!-- Popper JS -->
	<script src="{{ asset('/assets/frontend/js/popper.min.js') }}"></script>
	<!-- Bootstrap Datepicker JS -->
	<script src="{{ asset('/assets/frontend/js/bootstrap-datepicker.js') }}"></script>
	<!-- Jquery Nav JS -->
	<script src="{{ asset('/assets/frontend/js/jquery.nav.js') }}"></script>
	<!-- Slicknav JS -->
	<script src="{{ asset('/assets/frontend/js/slicknav.min.js') }}"></script>
	<!-- ScrollUp JS -->
	<script src="{{ asset('/assets/frontend/js/jquery.scrollUp.min.js') }}"></script>
	<!-- Niceselect JS -->
	<script src="{{ asset('/assets/frontend/js/niceselect.js') }}"></script>
	<!-- Tilt Jquery JS -->
	<script src="{{ asset('/assets/frontend/js/tilt.jquery.min.js') }}"></script>
	<!-- Owl Carousel JS -->
	<script src="{{ asset('/assets/frontend/js/owl-carousel.js') }}"></script>
	<!-- counterup JS -->
	<script src="{{ asset('/assets/frontend/js/jquery.counterup.min.js') }}"></script>
	<!-- Steller JS -->
	<script src="{{ asset('/assets/frontend/js/steller.js') }}"></script>
	<!-- Wow JS -->
	<script src="{{ asset('/assets/frontend/js/wow.min.js') }}"></script>
	<!-- Magnific Popup JS -->
	<script src="{{ asset('/assets/frontend/js/jquery.magnific-popup.min.js') }}"></script>
	<!-- Counter Up CDN JS -->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="{{ asset('/assets/frontend/js/bootstrap.min.js') }}"></script>
	<!-- Main JS -->
	<script src="{{ asset('/assets/frontend/js/main.js') }}"></script>

	<!--Datatables -->
	<script src="//cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>

	<script>
		$(document).ready(function(){
			// let table = new DataTable('#table');
			$('#table').DataTable({
			   "paging": true,
			   "lengthChange": true,
			   "searching": true,
			   "ordering": true,
			   "info": true,
			   "autoWidth": false,
			   "responsive": true,
			});
		})
	</script>
@endsection
