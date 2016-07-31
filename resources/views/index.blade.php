@extends('layouts.index')
@section('title', $title)
@section('content')
<div class="container">
            	
              	<div class="text-align-center">
                	<h3>Why learn with our ICT Academia?</h3>
                	<hr class="sm">
               	</div>
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="icon-box ibox-center ibox-plain">
                            <div class="ibox-icon margin-0">
                                <i class="icon icon-dialogue-happy"></i>
                            </div>
                            <h3>Amazing People</h3>
                            <p>Aenean imperdiet lacus sit amet elit porta, et malesuada erat bibendum</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="icon-box ibox-center ibox-plain">
                            <div class="ibox-icon margin-0">
                                <i class="icon icon-check"></i>
                            </div>
                            <h3>Experienced</h3>
                            <p>Aenean imperdiet lacus sit amet elit porta, et malesuada erat bibendum</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="icon-box ibox-center ibox-plain">
                            <div class="ibox-icon margin-0">
                                <i class="icon icon-diamond"></i>
                            </div>
                            <h3>Solid Foundation</h3>
                            <p>Aenean imperdiet lacus sit amet elit porta, et malesuada erat bibendum</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="icon-box ibox-center ibox-plain">
                            <div class="ibox-icon margin-0">
                                <i class="icon icon-music-random"></i>
                            </div>
                            <h3>Different Approach</h3>
                            <p>Aenean imperdiet lacus sit amet elit porta, et malesuada erat bibendum</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="spacer-50"></div>
            <div class="parallax parallax1 parallax-light padding-tb125" style="background-image:url(public/assets/images/parallax1.jpg);">
            	<div class="container">
                    <h5 class="subhead">We truly Listen</h5>
                    <h2>Have a meet with our Professionals</h2>
                 	<p>Vestibulum quam nisi, pretium a nibh sit amet, consectetur hendrerit mi.<br>Aenean imperdiet lacus sit amet elit porta, et malesuada erat<br>bibendum. Cras sed nunc massa.</p>
                    <div class="spacer-75"></div>
                </div>
            </div>
            
            <div class="container">
            	<div class="row">
                	<div class="col-md-4">
                    	<div class="shadow-block">
                        	<h3 class="accent-color">Partner with us!</h3>
                        	<p>Fill in below form as complete as possible and one of our personnel will be in touch with you shortly</p>
                            <form method="post" id="meetingform" name="meetingform" class="meeting-form clearfix" action="http://html.imithemes.com/solicitor/mail/meeting.php">
                            	<input name="mname" id="mname" type="text" placeholder="Name" class="form-control input-lg">
                            	<input name="memail" id="memail" type="email" placeholder="Email" class="form-control input-lg">
                            	<input name="mphone" id="mphone" type="text" placeholder="Phone" class="form-control input-lg">
                                <!-- <select name="mcase" id="mcase" class="selectpicker form-control input-lg">
                                	<option>Case type</option>
                                	<option>Business</option>
                                	<option>Family</option>
                                	<option>Civil</option>
                                	<option>Other</option>
                                </select> -->
                                <button name="msubmit" id="msubmit" type="submit" class="btn btn-primary btn-block btn-lg margin-20"><i class="fa fa-send-o"></i> Submit</button>
                            </form>
                            <div class="clearfix"></div>
                            <div id="mmessage"></div>
                            <p class="small margin-0">Note: Your details are kept strictly confidential as per our Privacy Policy.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                    <div class="spacer-40"></div>
                    	<a href="services.html" class="btn btn-primary pull-right">All Courses</a>
                    	<h3>Trending Courses</h3>
                    	<div class="spacer-20"></div>
                        <div class="row">
                        	<div class="col-md-12">
                                <div class="accordion" id="toggleArea">
                                    <div class="accordion-group panel">
                                        <div class="accordion-heading togglize">
                                        	<a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseOne">
                                            	Bankruptcy &amp; Reorganization
                                                <i class="fa fa-plus-circle"></i><i class="fa fa-minus-circle"></i>
                                          	</a>
                                       	</div>
                                        <div id="collapseOne" class="accordion-body collapse">
                                            <div class="accordion-inner">
                                            	<div class="row">
                                                    <ul class="carets col-md-6">
                                                    	<li>Bankruptcy Trustees</li>
                                                    	<li>Creditors Committees</li>
                                                    	<li>Executory Contracts</li>
                                                    	<li>Mortgage Warehouse Financing Workouts</li>
                                                    </ul>
                                                    <ul class="carets col-md-6">
                                                    	<li>SEC Receiverships</li>
                                                    	<li>Workouts &amp; Restructuring</li>
                                                    	<li>Secured Creditors</li>
                                                    	<li>Chapter 11 Debtors</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-group panel">
                                        <div class="accordion-heading togglize">
                                        	<a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapse2">
                                            	Corporate
                                                <i class="fa fa-plus-circle"></i><i class="fa fa-minus-circle"></i>
                                          	</a>
                                       	</div>
                                        <div id="collapse2" class="accordion-body collapse">
                                            <div class="accordion-inner">
                                            	<div class="row">
                                                    <ul class="carets col-md-6">
                                                    	<li>Bankruptcy Trustees</li>
                                                    	<li>Creditors Committees</li>
                                                    	<li>Executory Contracts</li>
                                                    	<li>Mortgage Warehouse Financing Workouts</li>
                                                    </ul>
                                                    <ul class="carets col-md-6">
                                                    	<li>SEC Receiverships</li>
                                                    	<li>Workouts &amp; Restructuring</li>
                                                    	<li>Secured Creditors</li>
                                                    	<li>Chapter 11 Debtors</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-group panel">
                                        <div class="accordion-heading togglize">
                                        	<a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapse3">
                                            	Real Estate
                                                <i class="fa fa-plus-circle"></i><i class="fa fa-minus-circle"></i>
                                          	</a>
                                       	</div>
                                        <div id="collapse3" class="accordion-body collapse">
                                            <div class="accordion-inner">
                                            	<div class="row">
                                                    <ul class="carets col-md-6">
                                                    	<li>Bankruptcy Trustees</li>
                                                    	<li>Creditors Committees</li>
                                                    	<li>Executory Contracts</li>
                                                    	<li>Mortgage Warehouse Financing Workouts</li>
                                                    </ul>
                                                    <ul class="carets col-md-6">
                                                    	<li>SEC Receiverships</li>
                                                    	<li>Workouts &amp; Restructuring</li>
                                                    	<li>Secured Creditors</li>
                                                    	<li>Chapter 11 Debtors</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-group panel">
                                        <div class="accordion-heading togglize">
                                        	<a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapse4">
                                            	Consumer Financial Services
                                                <i class="fa fa-plus-circle"></i><i class="fa fa-minus-circle"></i>
                                          	</a>
                                       	</div>
                                        <div id="collapse4" class="accordion-body collapse">
                                            <div class="accordion-inner">
                                            	<div class="row">
                                                    <ul class="carets col-md-6">
                                                    	<li>Bankruptcy Trustees</li>
                                                    	<li>Creditors Committees</li>
                                                    	<li>Executory Contracts</li>
                                                    	<li>Mortgage Warehouse Financing Workouts</li>
                                                    </ul>
                                                    <ul class="carets col-md-6">
                                                    	<li>SEC Receiverships</li>
                                                    	<li>Workouts &amp; Restructuring</li>
                                                    	<li>Secured Creditors</li>
                                                    	<li>Chapter 11 Debtors</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-group panel">
                                        <div class="accordion-heading togglize">
                                        	<a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapse5">
                                            	Fraud &amp; Recovery
                                                <i class="fa fa-plus-circle"></i><i class="fa fa-minus-circle"></i>
                                          	</a>
                                       	</div>
                                        <div id="collapse5" class="accordion-body collapse">
                                            <div class="accordion-inner">
                                            	<div class="row">
                                                    <ul class="carets col-md-6">
                                                    	<li>Bankruptcy Trustees</li>
                                                    	<li>Creditors Committees</li>
                                                    	<li>Executory Contracts</li>
                                                    	<li>Mortgage Warehouse Financing Workouts</li>
                                                    </ul>
                                                    <ul class="carets col-md-6">
                                                    	<li>SEC Receiverships</li>
                                                    	<li>Workouts &amp; Restructuring</li>
                                                    	<li>Secured Creditors</li>
                                                    	<li>Chapter 11 Debtors</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               	</div>
                                <!-- End Toggle -->
                            </div>
                        </div>
                    </div>
                </div>
           	</div>
            <div class="spacer-60"></div>
            <div class="padding-tb45 parallax parallax2 parallax-light" style="background-image:url(public/assets/images/parallax2.jpg)">
                <div class="overlay-accent"></div>
                <h3 class="text-align-center margin-0">The relationship between our experts and students <br>is the key to success</h3>
            </div>
@endsection