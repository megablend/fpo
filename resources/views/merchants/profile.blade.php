@extends('layouts.merchant')
@section('title', $title)
@section('content')
<section class="app-content" style="margin-bottom: 170px">
		
        <div class="row">
			<div class="col-md-12">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title">My Business Details</h4>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body row">
						<div class="col-xs-4">
							<div class="profile-avatar p-h-md" style="border-right: 2px solid #eee; color: rgba(21,36,55,0.7); height: 170px">
				                <div class="profile-avatar-img pull-left"><img ng-src="{{ Merchants::logo(request()) }}" alt="{{  Helper::capitalize($merchant->business_name) }}" src="{{ Merchants::logo(request()) }}"></div>
				                <div class=" ">
				                    <h4>{{  Helper::capitalize($merchant->business_name) }}</h4>
				                    <!-- <h5><a href="#" class="hide">Change Store Avatar</a></h5> -->
				                </div>
				            </div>
						</div><!-- END column -->
						<div class="col-xs-4">
							<div class="text-center p-h-md" style="border-right: 2px solid #eee; color: rgba(21,36,55,0.7);">
								<h5 class="" data-plugin="counterUp" style="text-align: left;">MERCHANT DETAILS</h5>

								<div class="" style='margin-top: 20px; display: block; text-align: left;'>
				                    <div data-ng-cloak style="margin-bottom: 10px"><i class="fa fa-user"></i> {{ $merchant->business_name  }}</div>
				                    <div data-ng-cloak style="margin-bottom: 10px"><i class="fa fa-envelope"></i> {{  $merchant->email }}</div>
				                    <div data-ng-cloak style="margin-bottom: 10px"><i class="fa fa-phone"></i> {{  $merchant->telephone }}</div>
				                </div>
							</div>
						</div><!-- END column -->
						<div class="col-xs-4">
							<div class="text-center p-h-md">
								<h5 class="" data-plugin="counterUp" style="text-align: left;">ADDRESS</h5>

								<div class="" style='margin-top: 20px; display: block; text-align: left;'>
				                    <div style="margin-bottom: 10px"><i class="fa fa-map-marker"></i> {{  $merchant->business_address }}, {{ $merchant->state->state_name }}</div>
				                </div>
							</div>
						</div><!-- END column -->
						
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div><!-- END column -->
		</div><!-- .row -->
	</section><!-- #dash-content -->
@endsection