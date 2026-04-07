<!doctype html>
<html class="fixed">

<head>

	<!-- Basic -->
	<meta charset="UTF-8">

	<title>@yield('title', 'Porto Admin - Responsive HTML5 Template')</title>
	<meta name="keywords" content="HTML5 Admin Template" />
	<meta name="description" content="Porto Admin - Responsive HTML5 Template">
	<meta name="author" content="okler.net">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light"
		rel="stylesheet" type="text/css">
	<link
		href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&display=swap"
		rel="stylesheet">

	<style>
		body {
			font-family: 'Inter', sans-serif !important;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			font-family: 'Outfit', sans-serif !important;
		}
	</style>

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.css') }}" />
	<script src="https://kit.fontawesome.com/e5291bc371.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/css/datepicker3.css') }}" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="{{ asset('assets/stylesheets/theme.css') }}" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="{{ asset('assets/stylesheets/skins/default.css') }}" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="{{ asset('assets/stylesheets/theme-custom.css') }}">

	<!-- Head Libs -->
	<script src="{{ asset('assets/vendor/modernizr/modernizr.js') }}"></script>

	@stack('css')

</head>

<body>
	<section class="body">

		<!-- start: header -->
		<header class="header">
			<div class="logo-container">
				<a href="{{ url('/') }}" class="logo">
					<img src="{{ asset('png/gp-negro.png') }}" height="45" style="padding-bottom: 10px;" />
				</a>
				<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html"
					data-fire-event="sidebar-left-opened">
					<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
				</div>
			</div>

			<!-- start: search & user box -->
			<div class="header-right">



				<span class="separator"></span>



				<span class="separator"></span>

				<div id="userbox" class="userbox">
					<a href="#" data-toggle="dropdown">
						<figure class="profile-picture">
							<img src="{{ asset('assets/images/!logged-user.jpg') }}" alt="Joseph Doe" class="img-circle"
								data-lock-picture="{{ asset('assets/images/!logged-user.jpg') }}" />
						</figure>
						<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
							<span class="name">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</span>
							<span class="role">{{ Auth::check() ? 'User' : 'None' }}</span>
						</div>

						<i class="fa custom-caret"></i>
					</a>

					<div class="dropdown-menu">
						<ul class="list-unstyled">
							<li class="divider"></li>
							<li>
								<a role="menuitem" tabindex="-1" href="#"><i class="fa fa-user"></i> My Profile</a>
							</li>
							<li>
								<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i
										class="fa fa-lock"></i> Lock Screen</a>
							</li>
							<li>
								<a role="menuitem" tabindex="-1" href="#"
									onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
										class="fa fa-power-off"></i> Logout</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST"
									style="display: none;">
									@csrf
								</form>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- end: search & user box -->
		</header>
		<!-- end: header -->

		<div class="inner-wrapper">
			<!-- start: sidebar -->
			<aside id="sidebar-left" class="sidebar-left">

				<div class="sidebar-header">
					<div class="sidebar-title">
						Menu
					</div>
					<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html"
						data-fire-event="sidebar-left-toggle">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>

				<div class="nano">
					<div class="nano-content">
						<nav id="menu" class="nav-main" role="navigation">
							<ul class="nav nav-main">
								<li class="{{ Request::is('dashboard') ? 'nav-active' : '' }}">
									<a href="{{ url('/dashboard') }}">
										<i class="fa fa-home" aria-hidden="true"></i>
										<span>Dashboard</span>
									</a>
								</li>
								<li class="{{ Request::is('carga-datos') ? 'nav-active' : '' }}">
									<a href="{{ url('/carga-datos') }}">
										<i class="fa fa-upload" aria-hidden="true"></i>
										<span>Carga de Datos</span>
									</a>
								</li>
								<li class="{{ Request::is('control-calidad') ? 'nav-active' : '' }}">
									<a href="{{ url('/control-calidad') }}">
										<i class="fa fa-check-square" aria-hidden="true"></i>
										<span>Control de Calidad</span>
									</a>
								</li>
								<li class="{{ Request::is('visualizacion') ? 'nav-active' : '' }}">
									<a href="{{ url('/visualizacion') }}">
										<i class="fa fa-eye" aria-hidden="true"></i>
										<span>Visualización</span>
									</a>
								</li>
								<li class="{{ Request::is('graficos') ? 'nav-active' : '' }}">
									<a href="{{ url('/graficos') }}">
										<i class="fa fa-signal" aria-hidden="true"></i>
										<span>Gráficos</span>
									</a>
								</li>
								<li class="{{ Request::is('estaciones-proyecto') ? 'nav-active' : '' }}">
									<a href="{{ url('/estaciones-proyecto') }}">
										<i class="fa fa-map-marker" aria-hidden="true"></i>
										<span>Estaciones Proyecto</span>
									</a>
								</li>
							</ul>
						</nav>

						<hr class="separator" />


					</div>

				</div>

			</aside>
			<!-- end: sidebar -->

			<section role="main" class="content-body">
				<header class="page-header">
					<h2>@yield('page_title', 'Default Layout')</h2>

					<div class="right-wrapper pull-right">
						<ol class="breadcrumbs">
							<li>
								<a href="{{ url('/') }}">
									<i class="fa fa-home"></i>
								</a>
							</li>
							<li><span>Layouts</span></li>
							<li><span>Default</span></li>
						</ol>

						<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
					</div>
				</header>

				<!-- start: page -->
				@yield('content')
				<!-- end: page -->
			</section>
		</div>


	</section>

	<!-- Vendor -->
	<script src="{{ asset('assets/vendor/jquery/jquery.js') }}"></script>
	<script src="{{ asset('assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
	<script src="{{ asset('assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('assets/vendor/magnific-popup/magnific-popup.js') }}"></script>
	<script src="{{ asset('assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="{{ asset('assets/javascripts/theme.js') }}"></script>

	<!-- Theme Custom -->
	<script src="{{ asset('assets/javascripts/theme.custom.js') }}"></script>

	<!-- Theme Initialization Files -->
	<script src="{{ asset('assets/javascripts/theme.init.js') }}"></script>

	@stack('js')

</body>

</html>