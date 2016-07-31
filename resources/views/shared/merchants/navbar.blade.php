<nav id="app-navbar" class="app-navbar p-l-lg p-r-md primary">
	<div id="navbar-header" class="pull-left">
		<button id="aside-fold" class="hamburger visible-lg-inline-block hamburger--arrowalt is-active js-hamburger" type="button">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</button>
		<button id="aside-toggle" class="hamburger hidden-lg hamburger--spin js-hamburger" type="button">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</button>
		<h5 id="page-title" class="visible-md-inline-block visible-lg-inline-block m-l-md">@yield('title')</h5>
	</div>

	<div>
		<ul id="top-nav" class="pull-right">
			<li class="nav-item dropdown">
				<a href="javascript:void(0)" id="navbar-search-open" class="navbar-search-open">
					<i class="zmdi zmdi-hc-lg zmdi-search"></i>
				</a>
			</li>
			
			<li class="nav-item dropdown">
				<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="zmdi zmdi-hc-lg zmdi-settings"></i></a>
				<ul class="dropdown-menu animated flipInY">
					<li><a href="{{ url('/') }}"><i class="zmdi m-r-md zmdi-hc-lg zmdi-account-box"></i>My Profile</a></li>
					<li><a href="{{ url('/') }}"><i class="zmdi m-r-md zmdi-hc-lg zmdi-settings"></i>Settings</a></li>
					<li><a href="{{ url('/logout') }}"><i class="zmdi m-r-md zmdi-hc-lg zmdi-power"></i>Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>

	<!-- navbar search -->
	<div id="navbar-search" class="navbar-search">
		<form action="#">
			<span class="search-icon"><i class="fa fa-search"></i></span>
			<input class="search-field" type="search" placeholder="search..."/>
		</form>
		<button id="search-close" class="search-close">
			<i class="fa fa-close"></i>
		</button>
	</div><!-- END navbar search -->
</nav>