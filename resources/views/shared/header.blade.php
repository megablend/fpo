<header>
      <div class="container-fluid">
        <div class="row header-shadow">
          <div class="nav-anchor"><a href="#"><i class="fa fa-bars"></i></a></div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 logo-wrapper">
            <div class="logo">
              <a href="{{ url('/') }}"><img src="{{ URL::asset('public/assets/site/img/2_0/logo-w.png') }}" alt=""></a>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12 search-box hidden-sm" style="padding-left:5px; padding-right:0">
            
          </div>
          <div class="col-sm-offset-3 col-lg-7 col-md-7 col-sm-10 col-xs-12 header-menu" style="padding-left:0">
            <nav class="header-nav-margin-right">
                <ul>
                    
                    <!-- <li class="header-nav-li"><a href="{{ url('customers/signup') }}" class="rounded">Login</a></li> -->
                    
                    
                    <li class="button-block header-nav-li"><a href="{{ url('/login') }}">Login</a></li>
                </ul>
            </nav>
          </div>
        </div>
      </div>
    </header>