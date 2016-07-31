<!DOCTYPE HTML>
<html class="no-js">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<!-- Basic Page Needs
  ================================================== -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>{{ $school_name }} - @yield('title')</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<!-- Mobile Specific Metas
  ================================================== -->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<!-- CSS
  ================================================== -->
<link href="{{ URL::asset('public/assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('public/assets/css/bootstrap-theme.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('public/assets/css/style.css') }}"  rel="stylesheet" type="text/css">
<link href="{{ URL::asset('public/assets/vendor/magnific/magnific-popup.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('public/assets/vendor/owl-carousel/css/owl.carousel.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('public/assets/vendor/owl-carousel/css/owl.theme.css') }}" rel="stylesheet" type="text/css">
<!--[if lte IE 9]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
<link href="{{ URL::asset('public/assets/css/custom.css') }}"  rel="stylesheet" type="text/css"><!-- CUSTOM STYLESHEET FOR STYLING -->
<link class="alt" href="{{ URL::asset('public/assets/colors/color1.css') }}" rel="stylesheet" type="text/css">
<!-- SCRIPTS
  ================================================== -->
<script src="{{ URL::asset('public/assets/js/modernizr.js') }}"></script><!-- Modernizr -->
</head>
<body class="home header-style1">
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->
<div class="body">
    <!-- Header
    =================================-->
    @include('shared.frontend.header')

    <!-- Slider
    =================================-->
    @include('shared.frontend.slider')
    
    <!-- Course Selection
    =================================-->
    @include('shared.frontend.courses_selection')

    <!-- Main Content -->
    <div id="main-container">
    	<div class="content">
        	 @yield('content')
        </div>
  	</div>
    <!-- Site Footer -->
    @include('shared.frontend.footer')
</div>
<script src="{{ URL::asset('public/assets/js/jquery-2.2.3.min.js') }}"></script> <!-- Jquery Library Call -->
<script src="{{ URL::asset('public/assets/vendor/magnific/jquery.magnific-popup.min.js') }}"></script> <!-- Maginific Popup Plugin -->
<script src="{{ URL::asset('public/assets/js/ui-plugins.js') }}"></script> <!-- UI Plugins -->
<script src="{{ URL::asset('public/assets/js/helper-plugins.js') }}"></script> <!-- Helper Plugins -->
<script src="{{ URL::asset('public/assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script> <!-- Owl Carousel -->
<script src="{{ URL::asset('public/assets/js/bootstrap.js') }}"></script> <!-- UI -->
<script src="{{ URL::asset('public/assets/js/init.js') }}"></script> <!-- All Scripts -->
<script src="{{ URL::asset('public/assets/vendor/flexslider/js/jquery.flexslider.js') }}"></script> <!-- FlexSlider -->
</body>

</html>