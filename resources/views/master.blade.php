<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		@section('style')
			<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
			<link rel="stylesheet" href="{{ asset('public/css/bootstrap.css') }}" media="screen">
			<link rel="stylesheet" href="{{ asset('public/components/jquery-ui/themes/flick/jquery-ui.css') }}" media="screen">
			<link rel="stylesheet" href="{{ asset('public/components/magnific-popup/dist/magnific-popup.css') }}" media="screen">
			<link rel="stylesheet" href="{{ asset('public/components/bootstrap-select/dist/css/bootstrap-select.css') }}" media="screen">
			<link rel="stylesheet" href="{{ asset('public/components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" media="screen">
			<link rel="stylesheet" href="{{ asset('public/components/font-awesome/css/font-awesome.css') }}" media="screen">
			<link rel="stylesheet" href="{{ asset('public/components/datatables.net-bs/css/dataTables.bootstrap.css') }}" media="screen">
			<link rel="stylesheet" href="{{ asset('public/components/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }}" media="screen">
			<link rel="stylesheet" href="{{ asset('public/components/highcharts/css/highcharts.css') }}" media="screen">
			<link rel="stylesheet" href="{{ asset('public/components/loaders.css/loaders.min.css') }}" media="screen">
			<link rel="stylesheet" href="{{ asset('public/css/main.css') }}" media="screen">
		@show
		@section('script')
			<script src="{{ asset('public/components/moment/moment.js') }}"></script>
			<script src="{{ asset('public/components/jquery/jquery.js') }}"></script>
			<script src="{{ asset('public/components/jquery-ui/jquery-ui.js') }}"></script>
			<script src="{{ asset('public/components/magnific-popup/dist/jquery.magnific-popup.js') }}"></script>
			<script src="{{ asset('public/components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
			<script src="{{ asset('public/components/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
			<script src="{{ asset('public/components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
			<script src="{{ asset('public/components/bootbox.js/bootbox.js') }}"></script>
			<script src="{{ asset('public/components/datatables.net/js/jquery.dataTables.js') }}"></script>
			<script src="{{ asset('public/components/datatables.net-bs/js/dataTables.bootstrap.js') }}"></script>
			<script src="{{ asset('public/components/datatables.net-responsive/js/dataTables.responsive.js') }}"></script>
			<script src="{{ asset('public/components/highcharts/js/highcharts.js') }}"></script>
			<script src="{{ asset('public/Js/main.js?v=2') }}"></script>
		@show
		<title>SIPI</title>
	</head>
	<body>
		<!-- Menu Módulo -->
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a href="{{ url('/welcome') }}" class="navbar-brand">SIM</a>
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="navbar-collapse collapse" id="navbar-main">
					<ul class="nav navbar-nav">
						<li class="{{ $seccion && in_array($seccion, ['Buscador']) ? 'active' : '' }}">
							<a href="{{ url('/buscador') }}">Buscador</a>
						</li>
						@if(isset($_SESSION['Usuario']))
							@if(
								$_SESSION['Usuario']['Permisos']['gestion_de_categorias'] ||
								$_SESSION['Usuario']['Permisos']['gestion_de_insumos'] ||
								$_SESSION['Usuario']['Permisos']['gestion_de_cotizaciones'] ||
								$_SESSION['Usuario']['Permisos']['gestion_de_proveedores']
							)
								<li class="{{ $seccion && in_array($seccion, ['Gestor de Insumos']) ? 'active' : '' }}">
									<a href="{{ URL::to('insumos') }}">Gestor de insumos</a>
								</li>
							@endif
							@if(
								$_SESSION['Usuario']['Permisos']['gestion_de_fichas_tecnicas'] ||
								$_SESSION['Usuario']['Permisos']['administrar_fichas_tecnicas']
							)
								<li class="{{ $seccion && in_array($seccion, ['Gestor de fichas técnicas']) ? 'active' : '' }}">
									<a href="{{ URL::to('fichaTecnica') }}">Fichas técnicas</a>
								</li>
							@endif
							@if ($_SESSION['Usuario']['Permisos']['administrar_usuarios'])
								<li class="{{ $seccion && in_array($seccion, ['Personas']) ? 'active' : '' }}">
									<a href="{{ url('/personas') }}">Usuarios</a>
								</li>
							@endif
						@endif
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="http://www.idrd.gov.co/sitio/idrd/" target="_blank">I.D.R.D</a></li>
						@if(isset($_SESSION['Usuario']))
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $_SESSION['Usuario']['Persona']['Primer_Apellido'].' '.$_SESSION['Usuario']['Persona']['Primer_Nombre'] }}<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li>
										<a href="{{ url('logout') }}">Cerrar sesión</a>
									</li>
								</ul>
							</li>
						@endif
					</ul>
				</div>
			</div>
		</div>
		<!-- FIN Menu Módulo -->

		<!-- Contenedor información módulo -->
		</br></br>
		@if (!isset($no_header))
		<div class="container">
			<div class="page-header" id="banner">
				<div class="row">
					<div class="col-lg-8 col-md-7 col-sm-6">
						<h1>
							<img src="http://idrd.gov.co/SIM/images/sipix2.png" alt="" height="48px" style="margin-top: -25px;">
							Sistema integrado de precios IDRD
						</h1>
						<p class="lead">
							<h4>Módulo para la gestión de precios, insumos y cotizaciones del IDRD</h4>
						</p>
					</div>
					<div class="col-lg-4 col-md-5 col-sm-6">
						 <div align="right">
								<img src="{{ asset('public/Img/IDRD.JPG') }}" width="50%" heigth="40%"/>
						 </div>
					</div>
					<div class="col-sm-12">
						<p class="text-primary">{{ $seccion ? $seccion : '' }}</p>
					</div>
				</div>
			</div>
		</div>
		@endif
		<!-- FIN Contenedor información módulo -->

		<!-- Contenedor panel principal -->
		<div class="{{ isset($full_width) ? 'container-fluid' : 'container' }}">
			@yield('content')
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<br><br><br>
				</div>
			</div>
		</div>
		<div class="ajaxloader">
			<div class="ball-scale-multiple"><div></div><div></div><div></div></div>
			<span>PROCESANDO</span>
		</div>
		<!-- FIN Contenedor panel principal -->
	</body>
</html>
