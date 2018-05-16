<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="_token" content="{!! csrf_token() !!}"/>
	<title>Essentia Pharma - @yield('title')</title>
	<link rel="shortcut icon" href="{{ asset('images/favicon-essential.png') }}" type="image/x-icon">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
	@section('alert')
		<div class="sweet-overlay"></div>
		<div class="sweet-alert">

			<div class="icon error">
				<span class="x-mark">
					<span class="line left"></span>
					<span class="line right"></span>
				</span>
			</div>

			<div class="icon warning">
				<span class="body"></span>
				<span class="dot"></span>
			</div>

			<div class="icon info"></div>

			<div class="icon success">
				<span class="line tip"></span>
				<span class="line long"></span>
				<div class="placeholder"></div>
				<div class="fix"></div>
			</div>

			<div class="icon custom"></div>

			<h2>Title</h2>
			<p class="text-muted">Text</p>
			<p>
				<button class="cancel btn btn-lg btn-default">Cancel</button>
				<button class="confirm btn btn-lg">OK</button>
			</p>
		</div>
	@show

	{{-- Bloco menu --}}
	@section('menu')
		<div class="menu-anchor">
			<img src="{{ asset('images/logo-essentia-pharma.png') }}" />
		</div>
		<header>
			<!-- Brand and toggle get grouped for better mobile display -->
		    <div class="closed-menu"></div>
		    <a class="brand" href="">
		      <img src="{{ asset('images/logo-essentia-pharma.png') }}" />
		    </a>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="nav-menu">
                <ul id="main-menu" class="nav navbar-nav">
                </ul>
            </div>
	    </header>
		<div class="content-general">
			<div class="container">
				@show
					<div class="alert alert-success msg-alert alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Item salvo com sucesso!
					</div>
					<div class="alert alert-danger msg-alert alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						O item não foi salvo! Tente novamente.
					</div>
				@section('flash')
					@if (count($errors) > 0)
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							@foreach ($errors->all() as $error)
									{{ $error }} <br />
							@endforeach
						</div>
					@endif

					@if(Session::has('success'))
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{!! Session::get('success') !!}
						</div>
					@endif

					@if(Session::has('warning'))
						<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{!! Session::get('warning') !!}
						</div>
					@endif

					@if(Session::has('error'))
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{!! Session::get('error') !!}
						</div>
					@endif
				@show

				{{-- Bloco de conteúdo --}}
				@yield('content')

				{{-- Bloco de dependencias js --}}
				@section('js')
			</div>
		</div>
		<script>
			var base_url = {!! json_encode(url()) !!};
		</script>

		<script src="{{ asset('js/main.js') }}"></script>

	@show
	@yield('script')
</body>
</html>
