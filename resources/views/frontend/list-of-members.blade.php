<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <!-- Meta Tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="ALFAKES - Asosiasi Perusahaan Laboratorium Pengujian dan Kalibrasi Fasilitas Kesehatan Indonesia">
		<meta name="description" content="ALFAKES - Asosiasi Perusahaan Laboratorium Pengujian dan Kalibrasi Fasilitas Kesehatan Indonesia">
		<meta name='copyright' content=''>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Title -->
        <title>Alfakes Indonesia - Members</title>
		
		<!-- Favicon -->
        <link rel="icon" href="{{ asset('/assets/frontend/img/favicon.ico') }}">
		
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

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
    </head>
    <body>
	
		<!-- Preloader -->
        <div class="preloader">
            <div class="loader">
                <div class="loader-outter"></div>
                <div class="loader-inner"></div>

                <div class="indicator"> 
                    <svg width="16px" height="12px">
                        <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                        <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <!-- End Preloader -->
	
		<!-- Header Area -->
		<header class="header" >
			<!-- Header Inner -->
			<div class="header-inner">
				<div class="container">
					<div class="inner">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-12">
								<!-- Start Logo -->
								<div class="logo">
									<a href="{{ route('home.index') }}">
										<div class="text">
											<h1><span style="color: #b2d136;">ALFA</span><span style="color: #1a76d1;">KES</span></h1>
										</div>
									</a>
								</div>
								<!-- End Logo -->
								<!-- Mobile Nav -->
								<div class="mobile-nav"></div>
								<!-- End Mobile Nav -->
							</div>
							<div class="col-lg-7 col-md-9 col-12">
								<!-- Main Menu -->
								<div class="main-menu">
									<nav class="navigation">
										<ul class="nav menu">
											<li><a href="{{ route('home.index') }}">Home </a></li>
											<li class="active"><a href="{{ route('list-members.index') }}">Members </a></li>
											<li><a href="#">Price List <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="{{ route('price-list-ipm.index') }}">Price List IPM</a></li>
													<li><a href="{{ route('price-list-kalibrasi.index') }}">Price List Kalibrasi</a></li>
												</ul>
											</li>
											<li><a href="{{ route('contact-us.index') }}">Contact Us</a></li>
											<li><a href="{{ route('about-us.index') }}">About Us </a></li>
										</ul>
									</nav>
								</div>
								<!--/ End Main Menu -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>
		<!-- End Header Area -->
	
		<!-- Breadcrumbs -->
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
		<!-- End Breadcrumbs -->
	
		<!-- Start Portfolio Details Area -->
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
											@for ($i = 0; $i < 10; $i++)
											<tr>
												<td>{{$no++}}</td>
												<td>PT. Global Promedika Services</td>
												<td>
													<a href="{{ route('member.index') }}"><button class="btn">View</button></a>
												</td>
											</tr>
											@endfor
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</section>
		<!-- End Portfolio Details Area -->
		
		<!-- Footer Area -->
		<footer id="footer" class="footer ">
			<!-- Copyright -->
			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-12">
							<div class="copyright-content">
								<p>© Copyright {{date('Y')}} | All Rights Reserved by <a href="{{ route('home.index') }}" target="_blank">Alfakes Indonesia</a> </p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Copyright -->
		</footer>
		<!--/ End Footer Area -->
		
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
    </body>
</html>