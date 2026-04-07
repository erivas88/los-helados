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
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

	<style>
		body {
			background: linear-gradient(135deg, #1e4d2b 0%, #2d5a27 100%);
			font-family: 'Inter', sans-serif !important;
		}

		h1, h2, h3, h4, h5, h6, .title {
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
			border-radius: 12px;
			overflow: hidden;
			box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
			border: none;
			max-width: 450px;
			width: 100%;
		}

		.panel-sign .panel-title-sign {
			background: #27ae60;
			padding: 25px;
			text-align: center;
		}

		.panel-sign .panel-title-sign .title {
			color: #fff;
			font-size: 20px;
			font-weight: 700;
			margin: 0;
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 10px;
		}

		.panel-sign .panel-body {
			padding: 40px;
			background: #fff;
		}

		.logo-container {
			text-align: center;
			margin-bottom: 25px;
		}

		.platform-sub {
			text-align: center;
			color: #666;
			margin-bottom: 30px;
			font-size: 14px;
		}

		.form-group label {
			font-weight: 600;
			color: #2c3e50;
			margin-bottom: 8px;
		}

		.input-lg {
			height: 50px;
			border-radius: 8px;
			border: 1px solid #e0e6ed;
			font-size: 15px;
		}

		.input-lg:focus {
			border-color: #27ae60;
			box-shadow: 0 0 0 3px rgba(39, 174, 96, 0.1);
		}

		.input-group-addon {
			border-radius: 0 8px 8px 0;
			background: #f8f9fa;
			border-left: none;
			color: #27ae60;
		}

		.btn-primary {
			background: #27ae60 !important;
			border: none !important;
			height: 50px;
			font-weight: 700;
			font-size: 16px;
			border-radius: 8px;
			transition: all 0.3s ease;
		}

		.btn-primary:hover {
			background: #219150 !important;
			transform: translateY(-2px);
			box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
		}

		.checkbox-custom label {
			padding-left: 10px;
			color: #7f8c8d;
		}

		.text-muted {
			color: rgba(255, 255, 255, 0.6) !important;
		}

		.alert-danger {
			border-radius: 8px;
			margin-bottom: 25px;
		}

		.icon-leaf {
			font-size: 24px;
			color: #fff;
		}
	</style>
</head>

<body>
	<section class="body-sign">
		<div class="center-sign">
			<div class="panel panel-sign">
				<div class="panel-title-sign">
					<h2 class="title"><i class="fa fa-leaf icon-leaf"></i> SISTEMA DE MONITOREO</h2>
				</div>
				<div class="panel-body">
					<div class="logo-container">
						<img src="{{ asset('assets/images/logo.png') }}" height="60" alt="Logo" />
					</div>
					<p class="platform-sub">Plataforma de Seguimiento y Control Ambiental</p>

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
							<div class="input-group input-group-icon">
								<input name="email" type="email" class="form-control input-lg"
									value="{{ old('email') }}" placeholder="ejemplo@correo.com" required autofocus />
								<span class="input-group-addon">
									<span class="icon icon-lg">
										<i class="fa fa-envelope"></i>
									</span>
								</span>
							</div>
						</div>

						<div class="form-group mb-lg">
							<div class="clearfix">
								<label class="pull-left">Contraseña</label>
								<a href="#" class="pull-right text-success" style="font-size: 12px;">¿Olvidó su
									contraseña?</a>
							</div>
							<div class="input-group input-group-icon">
								<input name="password" type="password" class="form-control input-lg"
									placeholder="Ingrese su contraseña" required />
								<span class="input-group-addon">
									<span class="icon icon-lg">
										<i class="fa fa-lock"></i>
									</span>
								</span>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-7">
								<div class="checkbox-custom checkbox-default">
									<input id="RememberMe" name="remember" type="checkbox" />
									<label for="RememberMe">Recordarme</label>
								</div>
							</div>
							<div class="col-sm-5 text-right">
								<button type="submit" class="btn btn-primary btn-block">Ingresar</button>
							</div>
						</div>

					</form>
				</div>
			</div>

			<p class="text-center text-muted mt-md mb-md">&copy; {{ date('Y') }} Plataforma de Monitoreo Ambiental.
				Todos los derechos reservados.</p>
		</div>
	</section>

	<script src="{{ asset('assets/vendor/jquery/jquery.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
</body>

</html>