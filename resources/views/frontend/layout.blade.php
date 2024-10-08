<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta Tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="Alfakes Indonesia - Asosiasi Perusahaan Laboratorium Pengujian dan Kalibrasi Fasilitas Kesehatan Indonesia">
		<meta name="description" content="Alfakes Indonesia - Asosiasi Perusahaan Laboratorium Pengujian dan Kalibrasi Fasilitas Kesehatan Indonesia">
		<meta name='copyright' content=''>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		{{-- <!-- Google / Search Engine Tags --> --}}
		<meta itemprop="name" content="Alfakes Indonesia - Kerja, Maju, Sejahtera Bersama" />
		<meta itemprop="description" content="Alfakes Indonesia - Asosiasi Perusahaan Laboratorium Pengujian dan Kalibrasi Fasilitas Kesehatan Indonesia" />
		<meta itemprop="image" content="{{ asset('/assets/frontend/img/alfakes_og_meta.jpg') }}" />

		{{-- <!-- Facebook Meta Tags --> --}}
		<meta property="og:url" content="https://alfakesindonesia.com/" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="Alfakes Indonesia - Kerja, Maju, Sejahtera Bersama" />
		<meta property="og:description" content="Alfakes Indonesia - Asosiasi Perusahaan Laboratorium Pengujian dan Kalibrasi Fasilitas Kesehatan Indonesia" />
		<meta property="og:image" content="{{ asset('/assets/frontend/img/alfakes_og_meta.jpg') }}" />

		{{-- <!-- Twitter Meta Tags --> --}}
		<meta name="twitter:card" content="summary_large_image" />
		<meta name="twitter:title" content="Alfakes Indonesia - Kerja, Maju, Sejahtera Bersama" />
		<meta name="twitter:description" content="Alfakes Indonesia - Asosiasi Perusahaan Laboratorium Pengujian dan Kalibrasi Fasilitas Kesehatan Indonesia" />
		<meta name="twitter:image" content="{{ asset('/assets/frontend/img/alfakes_og_meta.jpg') }}" />
		
		<!-- Title -->
		<title>Alfakes Indonesia - Kerja, Maju, Sejahtera Bersama - @yield('title')</title>
		
		<!-- Favicon -->
        <link rel="icon" href="{{ asset('/assets/frontend/img/favicon.ico') }}">
		
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

		<!-- csrf -->
		<meta name="csrf-token" content="{{ csrf_token() }}" />

		<!-- SweetAlert2 -->
		<link rel="stylesheet" href="{{ asset('/assets/AdminLTE-3.2.0/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

		<style>
			.logo img {
				width: 178px;
    			height: 37px;
			}
		</style>

		@yield('custom_link_css')
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
										<img src="{{ asset('assets/frontend/img/logo_alfakes.png') }}">
										{{-- <div class="text">
											<h1>
												<span style="color: #b2d136;">ALFA</span><span style="color: #1a76d1;">KES</span>
											</h1>
										</div> --}}
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
											<li><a href="{{ route('list-members.index') }}">Members </a></li>
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
	
		@yield('custom_content')
		
		<!-- Footer Area -->
		<footer id="footer" class="footer ">
			<!-- Copyright -->
			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-12">
							<div class="copyright-content">
								<p>&copy; Copyright {{date('Y')}} | All Rights Reserved by <a href="{{ route('home.index') }}" target="_self">Alfakes Indonesia</a> </p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Copyright -->
		</footer>
		<!--/ End Footer Area -->
		
		<!-- SweetAlert2 -->
		<script src="{{ asset('/assets/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
		@yield('custom_link_js')
    </body>
</html>