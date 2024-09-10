@extends('frontend/layout')

@section('title')
    About Us
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
						<h2>About Us</h2>
						<ul class="bread-list">
							<li><a href="{{ route('home.index') }}">Home</a></li>
							<li><i class="icofont-simple-right"></i></li>
							<li class="active">About Us</li>
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
						<div class="image-slider">
							<div class="pf-details-slider">
								<img src="{{ asset('/assets/frontend/img/slider2_full.jpg') }}" alt="#">
								<img src="{{ asset('/assets/frontend/img/slider_full.jpg') }}" alt="#">
								<img src="{{ asset('/assets/frontend/img/slider2_full.jpg') }}" alt="#">
							</div>
						</div>
						<div class="date">
							<ul>
								<li><span>Alfakes Indonesia</span></li>
							</ul>
						</div>
						<div class="body-text">
							<h3>Alfakes Indonesia</h3>
							<p>Asosiasi Perusahaan Laboratorium Pengujian, Kalibrasi, Pemeliharaan dan Perbaikan Fasilitas Kesehatan Indonesia.</p>
							<p>Didirikan pada tanggal 22 September 2011.</p>
							<p>Satu-satunya wadah komunikasi dan konsultasi perusahaan yang bergerak di bidang Pengujian/Kalibrasi alat kesehatan pada Fasilitas Kesehatan di Indonesia.</p>
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
@endsection
