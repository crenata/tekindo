<!DOCTYPE html>
<html class="no-js css-menubar">
<head>
	@include('admin.partials.body.head')
</head>
<body class="animsition site-navbar-small dashboard">
	@include('admin.partials.attributs.nav')

	@include('admin.partials.attributs.sidebar')
	
	@include('admin.partials.attributs.message')

	<div class="page">
		@yield('pageheader')
		<div class="page-content container-fluid">
			@yield('content')
		</div>
	</div>
	
	@include('admin.partials.body.footer')

	@include('admin.partials.components.js')
</body>
</html>