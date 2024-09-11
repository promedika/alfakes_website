@extends('frontend/layout')

@section('title')
	Price List Kalibrasi
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
						<h2>Price List Kalibrasi</h2>
						<ul class="bread-list">
							<li><a href="{{ route('home.index') }}">Home</a></li>
							<li><i class="icofont-simple-right"></i></li>
							<li class="active">Price List Kalibrasi</li>
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
							<h3>Daftar Harga Pengujian dan Kalibrasi Alat Kesehatan</h3>
							{{-- <p>Asosiasi Laboratorium Pengujian dan Kalibrasi Alat Kesehatan Berlaku Mulai Januari 2021</p> --}}
							<p>Daftar Harga Pengujian dan Kalibrasi Asosiasi Laboratorium Pengujian dan Kalibrasi Alat Kesehatan</p>
							<p>&nbsp;</p>
						</div>
					</div>

					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#tab1">Kalibrasi Alat Kesehatan</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tab2">Kalibrasi Kalibrator</a>
								</li>
							</ul>
						</div>

						<div class="card-body">
							<div class="tab-content mt-3">
								<div class="tab-pane show active" id="tab1" role="tabpanel">
									<h4 style="text-align: center;">Kalibrasi Alat Kesehatan</h4>
									<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover" id="table">
											<thead class="thead-dark">
												<tr>
													<th>No</th>
													<th>Nama Alat Kesehatan</th>
													<th>Harga (Rp)</th>
												</tr>
											</thead>
											<tbody>
												@php $no = 1; @endphp
												@foreach ($cal_prices as $data)
												<tr>
													<td style="text-align: left;">{{$no++}}</td>
													<td style="text-align: left;">{{$data->name}}</td>
													<td style="text-align: right;">
														@php $price = isset($data->price) ? number_format($data->price,0,"",'.') : 0; @endphp
														{{ $price }}
													</td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane " id="tab2" role="tabpanel">
									<h4 style="text-align: center;">Kalibrasi Kalibrator</h4>
									<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover" id="table2">
											<thead class="thead-dark">
												<tr>
													<th>No</th>
													<th>Nama Kalibrator</th>
													<th>Harga (Rp)</th>
												</tr>
											</thead>
											<tbody>
												@php $no = 1; @endphp
												@foreach ($calib_prices as $data)
												<tr>
													<td style="text-align: left;">{{$no++}}</td>
													<td style="text-align: left;">{{$data->name}}</td>
													<td style="text-align: right;">
														@php $price = isset($data->price) ? number_format($data->price,0,"",'.') : 0; @endphp
														{{ $price }}
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

					<div class="inner-content">
						<div class="body-text">
							<p>&nbsp;</p>
							<h4>Catatan</h4>
							<p>1. Harga belum termasuk Pajak yang berlaku</p>
							<p>2. Harga belum termasuk Biaya Petugas</p>
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
	{{-- <script src="{{ asset('/assets/frontend/js/jquery-migrate-3.0.0.js') }}"></script> --}}
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
	{{-- <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script> --}}
	<!-- Bootstrap JS -->
	<script src="{{ asset('/assets/frontend/js/bootstrap.min.js') }}"></script>
	<!-- Main JS -->
	<script src="{{ asset('/assets/frontend/js/main.js') }}"></script>

	<!--Datatables -->
	<script src="//cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>

	<script>
		$(document).ready(function(){
			// let table = new DataTable('#table');
			$('#table, #table2').DataTable({
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
