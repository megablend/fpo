<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>{{ $school_name }} - @yield('title')</title>
	<meta name="description" content="Admin, Dashboard, Bootstrap" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="{{ URL::asset('public/assets/img/favicon.png') }}"/>
	
	<link href="{{ URL::asset('public/assets/site/css/2_0/font-awesome.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ URL::asset('public/merchants/libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css') }}">

	<!-- build:css ../assets/css/app.min.css -->
	<link rel="stylesheet" href="{{ URL::asset('public/merchants/libs/bower/animate.css/animate.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/merchants/libs/bower/fullcalendar/dist/fullcalendar.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/merchants/libs/bower/perfect-scrollbar/css/perfect-scrollbar.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/assets/site/css/2_0/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/merchants/assets/css/app.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/assets/site/css/2_0/sweetalert.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/assets/css/site/2_0/angular/angular-datepicker.min.css') }}">
	<!-- endbuild -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">

	<script src="{{ URL::asset('public/assets/site/js/angularjs/angular.min.js') }}"></script>
	<script src="{{ URL::asset('public/assets/site/js/angularjs/ngStorage.min.js') }}"></script>
	<script src="{{ URL::asset('public/assets/site/js/angularjs/angular-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/site/js/angularjs/app.js') }}"></script>
    
    
    <!-- Extra CSS Files -->
	@yield('extra_css_files')
</head>
	
<body class="sb-left" data-ng-app="jifatuApp" data-ng-controller="MerchantCtrl">
<!--============= start main area -->

<!-- APP ASIDE ==========-->
<aside id="app-aside" class="app-aside left light">
	<!--
	============= APP Tilte =========================-->
	@include('shared.merchants.app_title')

	<!--
	============ Merchant Profile ===================-->
	@include('shared.merchants.merchant_profile')

	<!--
	=============== SIDEBAR LINKS ==================-->
	@include('shared.merchants.sidebar_links')
</aside>
<!--========== END app aside -->

<!-- APP NAVBAR =======================-->
@include('shared.merchants.navbar')
<!-- END APP NAVBAR ===================-->

<!-- APP CONTENT ======================-->
<main id="app-main" class="app-main">
	<div class="wrap">
       

       <!-- Page Content -->
       @yield('content')

	</div>
	@include('shared.merchants.footer')
</main>
<!--========== END APP CONTENT -->
   
   <!-- Modals -->
   @yield('modals')
   
   <!-- Scripts -->
   @include('shared.merchants.scripts')

   <!-- Extra JS ====================-->
   @yield('extra_js_files')

</body>
</html>