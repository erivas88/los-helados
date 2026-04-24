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
			background-image: url("{{ asset('images/los_helados_2.jpg') }}");
			background-size: cover;
			background-position: center;
			background-attachment: fixed;
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
			background: transparent;
			/* Eliminado el oscurecimiento global */
		}

		.panel-sign {
			background: rgba(255, 255, 255, 0.75);
			/* Fondo blanco transparentizado */
			backdrop-filter: blur(15px);
			/* Difuminado solo interno */
			-webkit-backdrop-filter: blur(15px);
			border-radius: 24px;
			overflow: hidden;
			box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
			border: 1px solid rgba(255, 255, 255, 0.4);
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
			color: #000000 !important;
			/* Negro Puro */
			font-size: 26px;
			font-weight: 800;
			margin: 0 0 8px 0;
			letter-spacing: -0.5px;
		}

		.platform-sub {
			text-align: center;
			color: #000000 !important;
			/* Negro Puro */
			margin-bottom: 35px;
			font-size: 15px;
			font-weight: 600;
			line-height: 1.5;
		}

		.form-group label {
			font-weight: 800;
			color: #000000 !important;
			/* Negro Puro */
			margin-bottom: 6px;
			font-size: 14px;
		}

		.input-lg {
			height: 52px;
			border-radius: 12px;
			border: 2px solid #000000;
			/* Borde más marcado */
			font-size: 15px;
			font-weight: 600;
			transition: all 0.2s;
			box-shadow: none !important;
			background: #ffffff;
			color: #000000;
		}

		.input-lg:focus {
			border-color: #27ae60;
			background: #ffffff;
			box-shadow: 0 0 0 4px rgba(39, 174, 96, 0.1) !important;
		}

		.btn-primary {
			background: #000000 !important;
			/* Negro Puro */
			color: #ffffff !important;
			/* Blanco Puro */
			border: none !important;
			height: 54px;
			font-weight: 800;
			font-size: 17px;
			border-radius: 12px;
			transition: all 0.25s ease;
			margin-top: 10px;
			box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
		}

		.btn-primary:hover {
			background: #1a1a1a !important;
			transform: translateY(-2px);
			box-shadow: 0 15px 20px -5px rgba(0, 0, 0, 0.4);
		}

		.checkbox-custom label {
			padding-left: 10px;
			color: #000000 !important;
			/* Negro Puro */
			font-size: 15px;
			font-weight: 700;
		}

		.text-muted {
			color: #000000 !important;
			/* Negro Puro */
		}

		.forgot-link {
			color: #000000 !important;
			/* Negro Puro */
			font-weight: 800;
			font-size: 13px;
			text-decoration: underline;
		}

		.forgot-link:hover {
			color: #000000 !important;
			opacity: 0.7;
		}

		.alert-danger {
			border-radius: 12px;
			margin-bottom: 25px;
			border: 2px solid #c53030;
			background: #ffffff;
			color: #c53030;
			font-size: 14px;
			padding: 15px;
			font-weight: 700;
		}

		.footer-copyright {
			margin-top: 30px;
			font-size: 13px;
			text-align: center;
			color: #000000 !important;
			/* Negro Puro */
			font-weight: 700;
		}
	</style>
</head>

<body>
	<section class="body-sign">
		<div class="center-sign">
			<div class="panel-sign">
				<div class="logo-container" style="margin-bottom: 30px;">
					<img src="{{ asset('png/gp-fullcolor.png') }}" height="110" alt="Logo" />
				</div>

				<div style="margin-bottom: 40px; text-align: center;">
					<p class="platform-sub"
						style="margin-bottom: 6px; font-size: 18px; font-weight: 800; letter-spacing: -0.8px; white-space: nowrap;">
						Plataforma de Seguimiento Ambiental</p>
					<div style="width: 40px; height: 3px; background: #000; margin: 12px auto; border-radius: 2px;">
					</div>
					<p class="platform-sub"
						style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 2.5px; opacity: 0.7; line-height: 1.6;">
						Proyecto los Helados
					</p>
				</div>
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
					&copy; {{ date('Y') }} GP CONSULTORES.
				</div>
			</div>
		</div>
	</section>

	<script src="{{ asset('assets/vendor/jquery/jquery.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
</body>

</html>