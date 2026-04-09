<!doctype html>
<html class="fixed">

<head>
	<meta charset="UTF-8">
	<title>Acceso - Plataforma de Seguimiento Ambiental</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/stylesheets/theme.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/stylesheets/skins/default.css') }}" />

	<!-- Web Fonts  -->
	<link
		href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&display=swap"
		rel="stylesheet">

	<style>
		body {
			background-color: #f7f9fc;
			background-image:
				radial-gradient(at 0% 0%, hsla(145, 63%, 92%, 1) 0, transparent 50%),
				radial-gradient(at 50% 0%, hsla(202, 63%, 92%, 1) 0, transparent 50%);
			font-family: 'Inter', sans-serif !important;
			height: 100vh;
			margin: 0;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		.title {
			font-family: 'Outfit', sans-serif !important;
		}

		.body-sign {
			display: flex;
			align-items: center;
			justify-content: center;
			min-height: 100vh;
			padding: 20px;
		}

		.panel-sign {
			background: #ffffff;
			border-radius: 24px;
			overflow: hidden;
			box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
			border: 1px solid rgba(226, 232, 240, 0.8);
			max-width: 440px;
			width: 100%;
			padding: 45px;
		}

		.logo-container {
			text-align: center;
			margin-bottom: 25px;
		}

		.title-accent {
			text-align: center;
			color: #1a202c;
			font-size: 24px;
			font-weight: 800;
			margin: 0 0 8px 0;
			letter-spacing: -0.5px;
		}

		.platform-sub {
			text-align: center;
			color: #718096;
			margin-bottom: 35px;
			font-size: 14px;
			font-weight: 500;
			line-height: 1.5;
		}

		.form-group label {
			font-weight: 700;
			color: #4a5568;
			margin-bottom: 6px;
			font-size: 13px;
		}

		.input-lg {
			height: 52px;
			border-radius: 12px;
			border: 1px solid #e2e8f0;
			font-size: 15px;
			font-weight: 500;
			transition: all 0.2s;
			box-shadow: none !important;
			background: #fcfdfe;
		}

		.input-lg:focus {
			border-color: #27ae60;
			background: #ffffff;
			box-shadow: 0 0 0 4px rgba(39, 174, 96, 0.05) !important;
		}

		.btn-primary {
			background: #1a202c !important;
			color: #fff !important;
			border: none !important;
			height: 54px;
			font-weight: 700;
			font-size: 16px;
			border-radius: 12px;
			transition: all 0.25s ease;
			margin-top: 10px;
			box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
		}

		.btn-primary:hover {
			background: #2d3748 !important;
			transform: translateY(-2px);
			box-shadow: 0 15px 20px -5px rgba(0, 0, 0, 0.15);
		}

		.checkbox-custom label {
			padding-left: 10px;
			color: #718096;
			font-size: 14px;
			font-weight: 500;
		}

		.text-muted {
			color: #94a3b8 !important;
		}

		.forgot-link {
			color: #27ae60 !important;
			font-weight: 600;
			font-size: 13px;
			text-decoration: none;
		}

		.forgot-link:hover {
			color: #219150 !important;
			text-decoration: underline;
		}

		.alert-danger {
			border-radius: 12px;
			margin-bottom: 25px;
			border: none;
			background: #fff5f5;
			color: #c53030;
			font-size: 14px;
			padding: 15px;
		}

		.footer-copyright {
			margin-top: 30px;
			font-size: 12px;
			text-align: center;
			color: #94a3b8;
		}
	</style>
</head>

<body>
	<section class="body-sign">
		<div class="center-sign">
			<div class="panel-sign">
				<div class="logo-container">
					<img src="{{ asset('png/gp-fullcolor.png') }}" height="100" alt="Logo" />
				</div>

				<h2 class="title-accent">Bienvenido</h2>
				<p class="platform-sub">Plataforma de seguimiento ambiental.</p>

				@if ($errors->any())
					<div class="alert alert-danger">
						<ul class="list-unstyled mb-none">
							@foreach ($errors->all() as $error)
								<li><i class="fa fa-exclamation-circle mr-xs"></i> {{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				<form action="{{ url('/login') }}" method="POST">
					@csrf
					<div class="form-group mb-lg">
						<label>Correo Electrónico</label>
						<input name="email" type="email" class="form-control input-lg" value="{{ old('email') }}"
							placeholder="ejemplo@correo.com" required autofocus />
					</div>

					<div class="form-group mb-lg">
						<div class="clearfix">
							<label class="pull-left">Contraseña</label>
							<a href="#" class="pull-right forgot-link">¿Olvidó su contraseña?</a>
						</div>
						<input name="password" type="password" class="form-control input-lg"
							placeholder="Ingrese su contraseña" required />
					</div>

					<div class="row" style="margin-top: 15px;">
						<div class="col-sm-12">
							<div class="checkbox-custom checkbox-default">
								<input id="RememberMe" name="remember" type="checkbox" />
								<label for="RememberMe">Mantener sesión iniciada</label>
							</div>
						</div>
					</div>

					<div class="row" style="margin-top: 20px;">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
						</div>
					</div>

				</form>

				<div class="footer-copyright">
					&copy; {{ date('Y') }} GP CONSULTORES. Todos los derechos reservados.
				</div>
			</div>
		</div>
	</section>

	<script src="{{ asset('assets/vendor/jquery/jquery.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
</body>

</html>