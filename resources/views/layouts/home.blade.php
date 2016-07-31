<!doctype html>
<html>

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="keywords" content="" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black" />
  <meta name="format-detection" content="telephone=yes" />
  <meta name="robots" content="index, follow" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

  <meta name="keywords" content=""/>
  <meta name="google-play-app" content="app-id=com.app.truppr"/>
  <meta name="apple-itunes-app" content="app-id=888657240"/>
  <meta name="msapplication-TileImage" content="assets/img/truppr-icon-58.png"/>
  <link rel="stylesheet" href="{{ URL::asset('public/assets/css/jquery.smartbanner.css') }}" type="text/css" media="screen"/>
  <link href="{{ URL::asset('public/assets/css/smart-app-banner.min.css') }}" rel="stylesheet"/>
  <meta name="twitter:card" content="app"/>
  <meta name="twitter:app:country" content="NG"/>
  <meta name="twitter:app:name:iphone" content="{{ $school_name }}"/><meta name="twitter:app:id:iphone" content="888657240"/>
  <meta name="twitter:app:url:iphone" content="{{ $school_name }}://"/><meta name="twitter:app:name:ipad" content="{{ $school_name }}"/>
  <meta name="twitter:app:id:ipad" content="888657240"/>
  <meta name="twitter:app:url:ipad" content="{{ $school_name }}://"/>
  <meta name="twitter:app:name:googleplay" content="{{ $school_name }}"/><meta name="twitter:app:id:googleplay" content="com.app.truppr"/>

  <!-- <meta name="google-site-verification" content="QTBDVfaddZTizTN6Rfa9F-osoaPJN1gb09ggI9ct2lU" /> -->

  <!-- Icons. -->

  <title>{{ $school_name }} - @yield('title')</title>
  <link rel="shortcut icon" type="image/png" href="{{ URL::asset('public/assets/img/favicon.png') }}"/>
  <link rel="stylesheet" href="{{ URL::asset('public/assets/site/css/2_0/bootstrap.min.css') }}">
  <!--<link rel="stylesheet" href="/assets/css/2_0/bootstrap-theme.min.css">-->
  <link href="{{ URL::asset('public/assets/css/2_0/font-awesome.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ URL::asset('public/assets/site/css/2_0/style.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('public/assets/site/css/2_0/bootstrap-datepicker.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('public/assets/site/css/bootstrap-editable.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('public/assets/site/css/2_0/sweetalert.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('public/assets/site/css/2_0/angular/angular-datepicker.min.css') }}">

  <script src="{{ URL::asset('public/assets/site/js/angularjs/angular.min.js') }}"></script>
  <script src="{{ URL::asset('public/assets/site/js/angularjs/ngStorage.min.js') }}"></script>
  <script src="{{ URL::asset('public/assets/site/js/angularjs/angular-datepicker.min.js') }}"></script>
  <script src="{{ URL::asset('public/assets/site/js/angularjs/app.js') }}"></script>

  @yield('extra_css_files')

</head>
  <body data-ng-app="jifatuApp">
    <!-- Header
    ===========================================-->
    @include('shared.header')

    @yield('content')

    <!-- Footer
    ===========================================-->

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="footer-menu">
              <ul>
                <li><a href="{{ url('/about-us') }}">About</a></li>
                <li><a href="{{ url('/how-it-works') }}">How it works</a></li>
                <li><a href="{{ url('/terms-and-conditions') }}">Terms and Conditions</a></li>
                <li><a href="{{ url('/contact-us') }}">Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6">
            
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12">
            <p class="copy">{{ $company_name }} &copy; {{ date('Y') }}. All rights reserved.</p>
          </div>

        </div>
      </div>
    </footer>

    
    <script src="{{ URL::asset('public/assets/site/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/site/js/smart-app-banner.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/site/js/jquery.smartbanner.js') }}"></script>
    <script type="text/javascript">$.smartbanner();</script>
    <script src="{{ URL::asset('public/assets/site/js/2_0/image-scale.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/site/js/2_0/jquery.bxslider.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/site/js/2_0/typed.js') }}"></script>
    <script src="{{ URL::asset('public/assets/site/js/2_0/tipr.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/site/js/2_0/main.js') }}"></script>
    <script src="{{ URL::asset('public/assets/site/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/site/js/2_0/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/site/js/bootstrap-editable.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/site/js/2_0/sweetalert.min.js') }}"></script>
    @yield('extra_js_files')
  </body>
</html>