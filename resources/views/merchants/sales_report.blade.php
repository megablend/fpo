@extends('layouts.merchant')
@section('title', $title)
@section('extra_js_files')
  <script src="{{ URL::asset('public/assets/js/2_0/canvasjs.min.js') }}"></script>
@endsection
@section('content')
<section class="app-content" style="margin-bottom: 170px">
		
        <div class="row">
			<div class="col-md-12">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title">Sales Report</h4>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body row">
						<div id="chartContainer" style="height: 300px; width: 100%;">
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div><!-- END column -->
		</div><!-- .row -->
	</section><!-- #dash-content -->
@endsection