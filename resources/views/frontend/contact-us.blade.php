@extends('frontend/layout')

@section('title')
    Contact Us
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
						<h2>Contact Us</h2>
						<ul class="bread-list">
							<li><a href="{{ route('home.index') }}">Home</a></li>
							<li><i class="icofont-simple-right"></i></li>
							<li class="active">Contact Us</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- <!-- End Breadcrumbs --> --}}
			
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
	<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
	<!-- Google Map API Key JS -->
	<script src="https://maps.google.com/maps/api/js?key={{env('GOOGLE_MAPS_API')}}"></script>
	<!-- Gmaps JS -->
	<script src="{{ asset('/assets/frontend/js/gmaps.min.js') }}"></script>
	<!-- Map Active JS -->
	<script src="{{ asset('/assets/frontend/js/map-active.js') }}"></script>
	<!-- Bootstrap JS -->
	<script src="{{ asset('/assets/frontend/js/bootstrap.min.js') }}"></script>
	<!-- Main JS -->
	<script src="{{ asset('/assets/frontend/js/main.js') }}"></script>
@endsection
