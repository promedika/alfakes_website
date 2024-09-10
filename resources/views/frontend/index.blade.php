@extends('frontend/layout')

@section('title')
    Home
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
	{{-- <!-- Slider Area --> --}}
	<section class="slider">
		<div class="hero-slider">
			<!-- Start Single Slider -->
			<div class="single-slider" style="background-image:url('{{ asset('/assets/frontend/img/slider2.png') }}')">
				<div class="container">
					<div class="row">
						<div class="col-lg-7">
							<div class="text">
								<h1>Kerja, Maju, Sejahtera Bersama</h1>
								<p>
									Berkarya Membangun dan Meningkatkan Kualitas Jaminan Mutu Alat Kesehatan Indonesia.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Single Slider -->
			<!-- Start Single Slider -->
			<div class="single-slider" style="background-image:url('{{ asset('/assets/frontend/img/slider.png') }}')">
				<div class="container">
					<div class="row">
						<div class="col-lg-7">
							<div class="text">
								<h1>Kerja, Maju, Sejahtera Bersama</h1>
								<p>
									Alfakes Merupakan Asosiasi Perusahaan Laboratorium Pengujian, Kalibrasi, Pemeliharaan dan Perbaikan Fasilitas Kesehatan Indonesia.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Start End Slider -->
			<!-- Start Single Slider -->
			<div class="single-slider" style="background-image:url('{{ asset('/assets/frontend/img/slider3.png') }}')">
				<div class="container">
					<div class="row">
						<div class="col-lg-7">
							<div class="text">
								{{-- <h1>Selamat Datang</h1>
								<p>
									ALFAKES merupakan Asosiasi Perusahaan Laboratorium Pengujian dan Kalibrasi Fasilitas Kesehatan, di dirikan oleh beberapa perusahaan kalibrasi di indonesia pada tahun 2012.
								</p> --}}
								<h1>Kerja, Maju, Sejahtera Bersama</h1>
								<p>
									Berkarya Membangun dan Meningkatkan Kualitas Jaminan Mutu Alat Kesehatan Indonesia.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Single Slider -->
		</div>
	</section>
	{{-- <!--/ End Slider Area --> --}}
	
	{{-- <!-- Start Schedule Area --> --}}
	<section class="schedule">
		<div class="container">
			<div class="schedule-inner">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-12 ">
						<!-- single-schedule -->
						<div class="single-schedule first">
							<div class="inner">
								<div class="icon">
									<i class="fa fa-ambulance"></i>
								</div>
								<div class="single-content">
									<h4>Apakah itu kalibrasi ?</h4>
									<p>
										<strong>Arti kalibrasi menurut ISO/IEC Guide 17025 adalah</strong> serangkaian kegiatan yang membentuk hubungan antara nilai yang ditunjukkan oleh instrumen ukur atau sistem pengukuran, atau nilai yang diwakili oleh bahan ukur, dengan nilai-nilai yang sudah diketahui yang berkaitan dari besaran yang diukur dalam kondisi tertentu.
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-12">
						<!-- single-schedule -->
						<div class="single-schedule middle">
							<div class="inner">
								<div class="icon">
									<i class="icofont-prescription"></i>
								</div>
								<div class="single-content">
									<h4>Apakah itu IPM ?</h4>
									<p>
										IPM adalah kegiatan pemeliharaan periodik untuk memeriksa kondisi komponen peralatan peralatan medis dan area sekitar peralatan medis. Kegiatan ini dilakukan secara berkala sehingga mencegah terjadinya kerusakan dan memonitoring performa alat medis per bulan.
									</p>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</section>
	{{-- <!--/End Start schedule Area --> --}}
	
	{{-- <!-- Start Why choose --> --}}
	<section class="why-choose section" >
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						{{-- <h2>Kami Menawarkan Berbagai Layanan Untuk Meningkatkan Fasilitas Kesehatan Anda</h2> --}}
						<h2>Komunikasi dan Konsultasi Layanan pada Fasilitas kesehatan</h2>
						<img src="{{ asset('/assets/frontend/img/section-img.png') }}" alt="#">
						<p>Kerja, Maju, Sejahtera Bersama</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-12">
					<!-- Start Choose Left -->
					<div class="choose-left">
						<h3>Siapa Kami</h3>
						<ul>
							<li>Asosiasi Perusahaan Laboratorium Pengujian, Kalibrasi, Pemeliharaan dan Perbaikan Fasilitas Kesehatan Indonesia.</li>
							<br>
							<li>Didirikan pada tanggal 22 September 2011</li>
							<br>
							<li>Satu-satunya wadah komunikasi dan konsultasi perusahaan yang bergerak di bidang Pengujian/Kalibrasi alat kesehatan pada Fasilitas Kesehatan di Indonesia.</li>
						</ul>
					</div>
					<!-- End Choose Left -->
				</div>
				<div class="col-lg-6 col-12">
					<!-- Start Choose Rights -->
					<div class="choose-right" style="background-image:url('{{ asset('/assets/frontend/img/thumbnail-alfakes.png') }}')">
						<div class="video-image">
							<!-- Video Animation -->
							<div class="promo-video">
								<div class="waves-block">
									<div class="waves wave-1"></div>
									<div class="waves wave-2"></div>
									<div class="waves wave-3"></div>
								</div>
							</div>
							<!--/ End Video Animation -->
							<a href="https://www.youtube.com/watch?v=rODYsEkAtUs" class="video video-popup mfp-iframe"><i class="fa fa-play"></i></a>
						</div>
					</div>
					<!-- End Choose Rights -->
				</div>
			</div>
		</div>
	</section>
	{{-- <!--/ End Why choose --> --}}
	
	{{-- <!-- Start Call to action --> --}}
	<section class="call-action overlay" data-stellar-background-ratio="0.5">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-12">
					<div class="content">
						<h2>Anda butuh layanan untuk Pengujian, Kalibrasi, Pemeliharaan ataupun Perbaikan alat kesehatan?</h2>
						{{-- <p>Kerja, Maju, Sejahtera Bersama</p> --}}
						<div class="button" style="margin-top: 20px;">
							<a href="{{ route('contact-us.index') }}" class="btn">Hubungi Kami</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	{{-- <!--/ End Call to action --> --}}
	
	{{-- <!-- Start portfolio --> --}}
	<section class="portfolio section" >
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2>Anggota Kami</h2>
						<img src="{{ asset('/assets/frontend/img/section-img.png') }}" alt="#">
						<p>Daftar anggota yg sudah terdaftar di Alfakes Indonesia</p>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-12">
					<div class="owl-carousel portfolio-slider">
						@for ($i = 0; $i < 10; $i++)
						<div class="single-pf">
							<img src="{{ asset('/assets/frontend/img/pf1.png') }}" alt="GPS">
							<a href="{{ route('member.index') }}" class="btn">View Details</a>
						</div>
						@endfor
					</div>
				</div>
			</div>
		</div>
	</section>
	{{-- <!--/ End portfolio --> --}}
	
	{{-- <!-- Start service --> --}}
	<section class="services section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2>Visi dan Misi Alfakes Indonesia</h2>
						<img src="{{ asset('/assets/frontend/img/section-img.png') }}" alt="#">
						<p>Kerja, Maju, Sejahtera Bersama</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="icofont icofont-eye-alt"></i>
						<h4><a href="service-details.html">Visi</a></h4>
						<p>Alfakes Menjadi Rujukan  Bagi Tersedianya Layanan Pengujian & Kalibrasi ALat Kesehatan yang bermutu, berkualitas dan terpercaya.</p>	
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-6 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="icofont icofont-prescription"></i>
						<h4><a href="service-details.html">Misi</a></h4>
						<p>Meningkatkan Kompetensi anggota dengan program terstruktur dan sistematis.</p>
						<br>
						<p>Maju, Sejahtera Bersama anggota dengan persaingan yang wajar.</p>
						<br>
						<p>Memastikan semua Anggota untuk menjaga mutu dan layanan yang dapat dipertanggungjawabkan.</p>
						<br>
						<p>Memperluas Jaringan Kerjasama</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	{{-- <!--/ End service --> --}}
	
	{{-- <!-- Pricing Table --> --}}
	<section class="pricing-table section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2>Daftar Harga</h2>
						<img src="{{ asset('/assets/frontend/img/section-img.png') }}" alt="#">
						<p>Daftar harga IPM (Inspection Preventive Maintenance), kalibrasi alat kesehatan dan kalibrasi kalibrator.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- Single Table -->
				<div class="col-lg-4 col-md-12 col-12">
					<div class="single-table">
						<!-- Table Head -->
						<div class="table-head">
							<div class="icon">
								<i class="icofont-tools-alt-2"></i>
							</div>
							<h4 class="title">IPM</h4>
						</div>
						<!-- Table List -->
						<ul class="table-list">
							{{-- <li><i class="icofont icofont-ui-check"></i>Lorem ipsum dolor sit</li>
							<li><i class="icofont icofont-ui-check"></i>Cubitur sollicitudin fentum</li>
							<li class="cross"><i class="icofont icofont-ui-close"></i>Nullam interdum enim</li>
							<li class="cross"><i class="icofont icofont-ui-close"></i>Donec ultricies metus</li>
							<li class="cross"><i class="icofont icofont-ui-close"></i>Pellentesque eget nibh</li> --}}
							@for ($i = 0; $i < 5; $i++)
							<li><i class="icofont icofont-ui-check"></i>Anaesthesia + Ventilator</li>
							@endfor
						</ul>
						<div class="table-bottom">
							<a class="btn" href="{{ route('price-list-ipm.index') }}">Detail</a>
						</div>
						<!-- Table Bottom -->
					</div>
				</div>
				<!-- End Single Table-->
				<!-- Single Table -->
				<div class="col-lg-4 col-md-12 col-12">
					<div class="single-table">
						<!-- Table Head -->
						<div class="table-head">
							<div class="icon">
								<i class="icofont icofont-heartbeat"></i>
							</div>
							<h4 class="title">Kalibrasi Alat Kesehatan</h4>
						</div>
						<!-- Table List -->
						<ul class="table-list">
							@for ($i = 0; $i < 5; $i++)
							<li><i class="icofont icofont-ui-check"></i>Anaesthesia + Ventilator</li>
							@endfor
						</ul>
						<div class="table-bottom">
							<a class="btn" href="{{ route('price-list-kalibrasi.index') }}">Detail</a>
						</div>
						<!-- Table Bottom -->
					</div>
				</div>
				<!-- End Single Table-->
				<!-- Single Table -->
				<div class="col-lg-4 col-md-12 col-12">
					<div class="single-table">
						<!-- Table Head -->
						<div class="table-head">
							<div class="icon">
								<i class="icofont icofont-surgeon-alt"></i>
							</div>
							<h4 class="title">Kalibrasi Kalibrator</h4>
						</div>
						<!-- Table List -->
						<ul class="table-list">
							@for ($i = 0; $i < 5; $i++)
							<li><i class="icofont icofont-ui-check"></i>Electrical Safety Analyzer</li>
							@endfor
						</ul>
						<div class="table-bottom">
							<a class="btn" href="{{ route('price-list-kalibrasi.index') }}">Detail</a>
						</div>
						<!-- Table Bottom -->
					</div>
				</div>
				<!-- End Single Table-->
			</div>	
		</div>	
	</section>	
	{{-- <!--/ End Pricing Table --> --}}

	{{-- <!-- Start Contact Us --> --}}
	<section class="contact-us section">
		<div class="container">
			<div class="inner">
				<div class="row"> 
					<div class="col-lg-6">
						<div class="contact-us-left">
							<!--Start Google-map -->
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.7766307712195!2d106.78230917355542!3d-6.293060161590652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1007dacad53%3A0x69018fcc70143966!2sALFAKES%20INDONESIA!5e0!3m2!1sen!2sid!4v1708327010889!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
							<!--/End Google-map -->
						</div>
					</div>
					<div class="col-lg-6">
						<div class="contact-us-form">
							<h2>Hubungi Kami</h2>
							<p>Jika anda mempunyai pertanyaan, jangan ragu untuk menghubungi kami</p>
							<!-- Form -->
							<form class="form" method="post" action="mail/mail.php">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<input type="text" name="name" placeholder="Name" required="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<input type="email" name="email" placeholder="Email" required="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<input type="text" name="phone" placeholder="Phone" required="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<input type="text" name="subject" placeholder="Subject" required="">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<textarea name="message" placeholder="Your Message" required=""></textarea>
										</div>
									</div>
									<div class="col-12">
										<div class="form-group login-btn">
											<button class="btn" type="submit">Kirim</button>
										</div>
									</div>
								</div>
							</form>
							<!--/ End Form -->
						</div>
					</div>
				</div>
			</div>
			<div class="contact-info">
				<div class="row">
					<!-- single-info -->
					<div class="col-lg-4 col-12 ">
						
						<div class="single-info">
							<i class="icofont icofont-ui-call"></i>
							<div class="content">
								<a href="tel:+62129557451">
									<h3>(021) 295 57 451</h3>
								</a>
								<a href="mailto:alfakessekretariat@gmail.com">
									<p>alfakessekretariat@gmail.com</p>
								</a>
							</div>
						</div>
					</div>
					<!--/End single-info -->
					<!-- single-info -->
					<div class="col-lg-4 col-12 ">
						<a href="https://maps.app.goo.gl/Amc3YYmWGN8evVjx5" target="_blank">
						<div class="single-info">
							<i class="icofont-google-map"></i>
							<div class="content">
								<h3>Alfakses Indonesia</h3>
								<p>Gedung Metropolitan Tower, Lt 13A, Cilandak, Jakarta 12430</p>
							</div>
						</div>
						</a>
					</div>
					<!--/End single-info -->
					<!-- single-info -->
					<div class="col-lg-4 col-12 ">
						<div class="single-info">
							<i class="icofont icofont-wall-clock"></i>
							<div class="content">
								<h3>Mon - Fri: 8am - 5pm</h3>
								<p>Saturday and Sunday Closed</p>
							</div>
						</div>
					</div>
					<!--/End single-info -->
				</div>
			</div>
		</div>
	</section>
	{{-- <!--/ End Contact Us --> --}}
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="{{ asset('/assets/frontend/js/bootstrap.min.js') }}"></script>
	<!-- Main JS -->
	<script src="{{ asset('/assets/frontend/js/main.js') }}"></script>
@endsection
