@extends('layouts.merchant')
@section('title', $title)
@section('content')
<section class="app-content" style="margin-bottom: 170px">
		<div class="row" data-ng-show="!answered">
			<div class="col-md-6">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title">Answer the questions below:</h4>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
						<div class="m-b-lg">
							<small>
								Please ensure you answer all questions.
							</small>
						</div>
						<form no-validate data-ng-submit="submitQuestions()">
							<div class="form-group">
								<label for="exampleInputEmail1">1. Which of this is not a part of a computer system</label>
								<div class="radio">
									<input name="q_1_answer" type="radio" data-ng-model="questionOne" value="Monitor" id="radio-1">
									<label for="radio-1">Monitor</label>
								</div>
								<div class="radio">
									<input name="q_1_answer" type="radio" data-ng-model="questionOne" value="CPU" id="radio-1">
									<label for="radio-1">CPU</label>
								</div>
								<div class="radio">
									<input name="q_1_answer" type="radio" data-ng-model="questionOne" value="Mouse" id="radio-1">
									<label for="radio-1">Mouse</label>
								</div>
								<div class="radio">
									<input name="q_1_answer" type="radio" data-ng-model="questionOne" value="Keyboard" id="radio-1">
									<label for="radio-1">Keyboard</label>
								</div>
								<div class="radio">
									<input name="q_1_answer" type="radio" data-ng-model="questionOne" value="Ignition" id="radio-1">
									<label for="radio-1">Ignition</label>
								</div>
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">2. What is the full meaning of CPU</label>
								<div class="radio">
									<input name="q_2_answer" type="radio" data-ng-model="questionTwo" value="Central Processing Unit" id="radio-1">
									<label for="radio-1">Central Processing Unit</label>
								</div>
								<div class="radio">
									<input name="q_2_answer" type="radio" data-ng-model="questionTwo" value="Central Processing Monitor" id="radio-1">
									<label for="radio-1">Central Processing Monitor</label>
								</div>
								<div class="radio">
									<input name="q_2_answer" type="radio" data-ng-model="questionTwo" value="Center for Processing Monitor" id="radio-1">
									<label for="radio-1">Center for Processing Monitor</label>
								</div>
								<div class="radio">
									<input name="q_2_answer" type="radio" data-ng-model="questionTwo" value="Central Processing Mandate" id="radio-1">
									<label for="radio-1">Central Processing Mandate</label>
								</div>
								<div class="radio">
									<input name="q_2_answer" type="radio" data-ng-model="questionTwo" value="Center Processing Unit" id="radio-1">
									<label for="radio-1">Center Processing Unit</label>
								</div>
							</div>
							<button type="submit" class="btn btn-primary btn-md">Submit</button>
						</form>
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div><!-- END column -->

		</div><!-- .row -->

		<div class="row" data-ng-show="answered">
			<div class="col-md-6">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title">Congratulations! You have completed the practice questions</h4>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
							<h4 class="m-b-lg">Answers Summary</h4>
							<p class="m-b-lg docs">
								You got <strong>@{{ answersCounter }}</strong> out of <strong>2</strong> questions 
							</p>

							<h4 class="m-b-lg">Correct Answers</h4>
							<ul class="list-group no-border">
								<li data-ng-repeat="answer in correctAnswers" class="list-group-item"><strong>@{{$index + 1}}. @{{ answer }}</strong></li>
							</ul>
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div><!-- END column -->

		</div><!-- .row -->


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