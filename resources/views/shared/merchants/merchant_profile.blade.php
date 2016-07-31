<div class="aside-user">
		<!-- aside-user -->
		<div class="media">
			<div class="media-left">
				<div class="avatar avatar-md avatar-circle">
					<a href="javascript:void(0)"><img class="img-responsive" src="{{ Merchants::logo(request()) }}" alt="avatar"/></a>
				</div><!-- .avatar -->
			</div>
			<div class="media-body">
				<div class="foldable">
					<h5><a href="javascript:void(0)" class="username">{{ request()->user()->first_name }}</a></h5>
					<ul>
						<li class="dropdown">
							<a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<small>Profile</small>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu animated flipInY">
								<li>
									<a class="text-color" href="{{ url('/profile') }}">
										<span class="m-r-xs"><i class="fa fa-user"></i></span>
										<span>Profile</span>
									</a>
								</li>
								<li>
									<a class="text-color" href="{{ url('/settings') }}">
										<span class="m-r-xs"><i class="fa fa-gear"></i></span>
										<span>Settings</span>
									</a>
								</li>
								<li role="separator" class="divider"></li>
								<li>
									<a class="text-color" href="{{ url('/logout') }}">
										<span class="m-r-xs"><i class="fa fa-power-off"></i></span>
										<span>Logout</span>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /aside-user -->
	</div><!-- #aside-user -->