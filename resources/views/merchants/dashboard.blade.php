@extends('layouts.merchant')
@section('title', $title)
@section('content')
<section class="app-content" style="margin-bottom: 170px">
		<div class="row">
			<div class="col-md-12">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title">Quick Practice</h4>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body row">
						<div class="col-xs-4">
							<div class="text-center p-h-md" style="border-right: 2px solid #eee">
								<h2 class="fz-xl fw-400 m-0" data-plugin="counterUp">Basic ICT</h2>

								<div class="title" style='margin-top: 20px'>
				                    <button data-ng-click="openLink('{{ url('/practice') }}')" type="button" class="btn mw-md btn-purple">Start</button>
				                </div>
							</div>
						</div><!-- END column -->
						<div class="col-xs-4">
							<div class="text-center p-h-md" style="border-right: 2px solid #eee">
								<h2 class="fz-xl fw-400 m-0" data-plugin="counterUp">Programming</h2>

								<div class="title" style='margin-top: 20px'>
				                    <button type="button" class="btn mw-md btn-inverse">Start</button>
				                </div>
							</div>
						</div><!-- END column -->
						<div class="col-xs-4">
							<div class="text-center p-h-md">
								<h2 class="fz-xl fw-400 m-0" data-plugin="counterUp">IT Security</h2>
								<div class="title" style='margin-top: 20px'>
				                    <button type="button" class="btn mw-md btn-pink">Start</button>
				                </div>
							</div>
						</div><!-- END column -->
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div><!-- END column -->
		</div><!-- .row -->

		<div class="row">
					<div class="col-md-12">
						<div class="widget row no-gutter p-lg">						
							<div class="col-md-5 col-sm-5">
								<div>
									<h3 class="widget-title fz-lg text-primary m-b-lg">Welcome {{ Helper::capitalize(request()->user()->first_name) }}! Get started</h3>
									<!-- <p class="m-b-lg">Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits</p> -->
									<p class="fs-italic">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic eum alias est vitae, obcaecati?</p>
								</div>
							</div>

							<div class="col-md-7 col-sm-7">
								<div>
									<div id="lineChart" data-plugin="plot" data-options="
										[
											{
												data: [[1,3.6],[2,3.5],[3,6],[4,4],[5,4.3],[6,3.5],[7,3.6]],
												color: '#ffa000',
												lines: { show: true, lineWidth: 6 },
												curvedLines: { apply: true }
											},
											{
												data: [[1,3.6],[2,3.5],[3,6],[4,4],[5,4.3],[6,3.5],[7,3.6]],
												color: '#ffa000',
												points: {show: true}
											}
										],
										{
											series: {
												curvedLines: { active: true }
											},
											xaxis: {
												show: true,
												font: { size: 12, lineHeight: 10, style: 'normal', weight: '100',family: 'lato', variant: 'small-caps', color: '#a2a0a0' }
											},
											yaxis: {
												show: true,
												font: { size: 12, lineHeight: 10, style: 'normal', weight: '100',family: 'lato', variant: 'small-caps', color: '#a2a0a0' }
											},
											grid: { color: '#a2a0a0', hoverable: true, margin: 8, labelMargin: 8, borderWidth: 0, backgroundColor: '#fff' },
											tooltip: true,
											tooltipOpts: { content: 'X: %x.0, Y: %y.2',  defaultTheme: false, shifts: { x: 0, y: -40 } },
											legend: { show: false }
										}" style="width: 100%; height: 230px;">
									</div>
								</div>
							</div>
						</div><!-- .widget -->	
					</div>
				</div>


		<!-- <div class="row">
			<div class="col-md-12">
				<div class="widget row no-gutter p-lg">						
					<div class="col-md-5 col-sm-5">
						<div>
							<h3 class="widget-title fz-lg text-primary m-b-lg">Sales in 2014</h3>
							<p class="m-b-lg">Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits</p>
							<p class="fs-italic">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic eum alias est vitae, obcaecati?</p>
						</div>
					</div>

					<div class="col-md-7 col-sm-7">
						<div>
							<div id="lineChart" data-plugin="plot" data-options="
								[
									{
										data: [[1,3.6],[2,3.5],[3,6],[4,4],[5,4.3],[6,3.5],[7,3.6]],
										color: '#ffa000',
										lines: { show: true, lineWidth: 6 },
										curvedLines: { apply: true }
									},
									{
										data: [[1,3.6],[2,3.5],[3,6],[4,4],[5,4.3],[6,3.5],[7,3.6]],
										color: '#ffa000',
										points: {show: true}
									}
								],
								{
									series: {
										curvedLines: { active: true }
									},
									xaxis: {
										show: true,
										font: { size: 12, lineHeight: 10, style: 'normal', weight: '100',family: 'lato', variant: 'small-caps', color: '#a2a0a0' }
									},
									yaxis: {
										show: true,
										font: { size: 12, lineHeight: 10, style: 'normal', weight: '100',family: 'lato', variant: 'small-caps', color: '#a2a0a0' }
									},
									grid: { color: '#a2a0a0', hoverable: true, margin: 8, labelMargin: 8, borderWidth: 0, backgroundColor: '#fff' },
									tooltip: true,
									tooltipOpts: { content: 'X: %x.0, Y: %y.2',  defaultTheme: false, shifts: { x: 0, y: -40 } },
									legend: { show: false }
								}" style="width: 100%; height: 230px;">
							</div>
						</div>
					</div>
				</div><!-- .widget -->	
			</div>
		<!-- </div><!-- .row --> 

	</section><!-- #dash-content -->
@endsection