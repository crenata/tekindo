<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="bootstrap material admin template">
<meta name="author" content="">

<!-- <title>Dashboard | Remark Material Admin Template</title> -->
<title>@yield('title') | Tekindo</title>

<link rel="apple-touch-icon" href="{{ asset('public/plugin/mui-trade-template/mmenu/assets/images/apple-touch-icon.png') }}">
<link rel="shortcut icon" href="{{ asset('public/plugin/mui-trade-template/mmenu/assets/images/favicon.ico') }}">

<!--[if lt IE 9]>
<script src="../../global/vendor/html5shiv/html5shiv.min.js"></script>
<![endif]-->

<!--[if lt IE 10]>
<script src="../../global/vendor/media-match/media.match.min.js"></script>
<script src="../../global/vendor/respond/respond.min.js"></script>
<![endif]-->

@include('admin.partials.components.css')

@yield('stylesheets')

<!-- Scripts -->
{{ Html::script('public/plugin/mui-trade-template/global/vendor/breakpoints/breakpoints.js') }}
<script>
	Breakpoints();
</script>