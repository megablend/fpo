<div class="aside-scroll">
		<div id="aside-scroll-inner" class="aside-scroll-inner">
			<ul class="aside-menu aside-left-menu">
				<li class="menu-item has-submenu">
					<a href="javascript:void(0)" class="menu-link submenu-toggle">
						<span class="menu-icon"><i class="zmdi zmdi-view-dashboard zmdi-hc-lg"></i></span>
						<span class="menu-text foldable">Dashboard</span>
						<span class="menu-caret foldable"><i class="zmdi zmdi-hc-sm zmdi-chevron-right"></i></span>
					</a>
					<ul class="submenu">
						<li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
					</ul>
				</li><!-- .menu-item -->
				
				<li class="menu-item has-submenu">
					<a href="javascript:void(0)" class="menu-link submenu-toggle">
						<span class="menu-icon"><i class="zmdi zmdi-mall zmdi-hc-lg"></i></span>
						<span class="menu-text foldable">Courses</span>
						<span class="menu-caret foldable"><i class="zmdi zmdi-hc-sm zmdi-chevron-right"></i></span>
					</a>
					<ul class="submenu">
						<li><a href="{{ url('/courses') }}">Manage Courses</a></li>
					</ul>
				</li><!-- .menu-item -->

				<!--  -->
			</ul>
			<hr>
			<footer id="aside-footer">
				<ul class="aside-menu aside-left-menu">
					<li class="menu-item">
						<a href="{{ url('merchants/help') }}" class="menu-link">
							<span class="menu-icon"><i class="zmdi zmdi-file-text zmdi-hc-lg"></i></span>
							<span class="menu-text foldable">Help</span>
						</a>
					</li><!-- .menu-item -->
				</ul>
			</footer><!-- #sidebar-footer -->
		</div><!-- .aside-scroll-inner -->
	</div><!-- #aside-scroll -->