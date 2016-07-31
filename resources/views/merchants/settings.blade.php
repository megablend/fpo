@extends('layouts.merchant')
@section('title', $title)
@section('content')
<section class="app-content">
		
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
				                    <div data-ng-cloak style="margin-bottom: 10px"><i class="fa fa-user"></i> @{{ merchant.business_name  }}</div>
				                    <div data-ng-cloak style="margin-bottom: 10px"><i class="fa fa-envelope"></i> @{{  merchant.email }}</div>
				                    <div data-ng-cloak style="margin-bottom: 10px"><i class="fa fa-phone"></i> @{{  merchant.telephone }}</div>
				                </div>
							</div>
						</div><!-- END column -->
						<div class="col-xs-4">
							<div class="text-center p-h-md">
								<h5 class="" data-plugin="counterUp" style="text-align: left;">ADDRESS</h5>

								<div class="" style='margin-top: 20px; display: block; text-align: left;'>
				                    <div style="margin-bottom: 10px"><i class="fa fa-map-marker"></i> @{{  merchant.business_address }}, {{ $merchant->state->state_name }}</div>
				                </div>
							</div>
						</div><!-- END column -->
						
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div><!-- END column -->
		</div><!-- .row -->
		
		<div class="row">
			<div class="col-md-12">
				<div id="profile-tabs" class="nav-tabs-horizontal white m-b-lg">
					<!-- tabs list -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#profile-stream" aria-controls="stream" role="tab" data-toggle="tab">Business Details</a></li>
						<li role="presentation"><a href="#bank-details-form" aria-controls="photos" role="tab" data-toggle="tab">Bank Details</a></li>
						<li role="presentation"><a href="#contact-details" aria-controls="friends" role="tab" data-toggle="tab">Contact Person</a></li>
						<li role="presentation"><a href="#pos-details" aria-controls="friends" role="tab" data-toggle="tab">POS Details</a></li>
					</ul><!-- .nav-tabs -->

					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane in active fade" id="profile-stream">

							<div class="widget-body" id="business-details-form">
								<form novalidate method="POST" make-dirty name="merchant.form" id="business-details" action="">
									<div class="alert alert-danger" data-ng-cloak data-ng-if="merchant.activeForm == 'business_details'" data-ng-show="errors.length">
									    <strong>Please correct the errors listed below!</strong><br>
									    <ul style="list-style: none">
									            <li data-ng-repeat="error in errors">** @{{ error }}</li>
									    </ul>
									</div>

									<div class="form-group">
										<label for="business-name">Business Name</label>
										<input type="text" class="form-control" id="business-name" data-ng-init="merchant.business_name='{{ $merchant->business_name }}'" data-ng-model="merchant.business_name" name="business_name" placeholder="Enter your business name" required>
										<!-- Element Errors Holder -->
                                        <span class="form-div-error" data-ng-cloak data-ng-show="merchant.form.business_name.$error.required && merchant.form.business_name.$dirty">** Please enter your business name</span> 
									</div>
									<div class="form-group">
										<label for="business-address">Business Address</label>
										<input type="text" class="form-control" id="business-address" data-ng-init="merchant.business_address='{{ $merchant->business_address }}'" data-ng-model="merchant.business_address" name="business_address" placeholder="Enter your business address" required>
										<!-- Element Errors Holder -->
                                        <span class="form-div-error" data-ng-cloak data-ng-show="merchant.form.business_address.$error.required && merchant.form.business_address.$dirty">** Please enter your business address</span> 

									</div>

									<div class="form-group">
										<label for="business-type">Business Type</label>
										<input type="text" class="form-control" id="business-type" data-ng-init="merchant.business_type='{{ $merchant->business_type }}'" data-ng-model="merchant.business_type" name="business_type" placeholder="Enter your business type" required>
										<!-- Element Errors Holder -->
                                        <span class="form-div-error" data-ng-cloak data-ng-show="merchant.form.business_type.$error.required && merchant.form.business_type.$dirty">** Please enter your business type</span> 

									</div>

									<div class="form-group">
										<label for="business-email">Email</label>
										<input type="email" class="form-control" id="business-email" data-ng-init="merchant.email='{{ $merchant->email }}'" data-ng-model="merchant.email" name="email" placeholder="Enter your business address" required>
										<!-- Element Errors Holder -->
						                <span class="form-div-error" data-ng-cloak data-ng-show="merchant.form.email.$error.required && merchant.form.email.$dirty">** This field is required</span>
						                <span class="form-div-error" data-ng-cloak data-ng-show="!merchant.form.email.$error.required && merchant.form.email.$error.email && merchants.signup.form.email.$dirty">** Invalid email address provided</span>    
									</div>

									<div class="form-group">
										<label for="id_state_of_business">State of Business</label>
										<select name="state_of_business_id" data-ng-change="updateLocalGovt()" data-ng-init="merchant.state_of_business_id={{ $merchant->state->id }}; initUpdateLocalGovt({{ $merchant->state->id }});" data-ng-model="merchant.state_of_business_id" id="id_state_of_business" class="form-control signup-select" required>
					                        <option value=""> --- Please Select --- </option>
					                        @foreach($states as $state)
					                          <option value="{{ $state->id }}"  {{ (old("state_id") == $state->id ? "selected":"") }}>{{ $state->state_name }}</option>
					                        @endforeach                           
					                     </select>
					                     <!-- Element Errors Holder -->
                                        <span class="form-div-error" data-ng-cloak data-ng-show="merchant.form.state_of_business_id.$error.required && merchant.form.state_of_business_id.$dirty">** Please select your state</span> 
									</div>

									<div class="form-group">
										<label for="business-local-gvot">Local Government</label>
										<select name="local_govt_id" data-ng-init="merchant.local_govt_id={{ $merchant->local_govt->id }}" data-ng-model="merchant.local_govt_id" id="id_local_govt" class="form-control signup-select" required>
					                        <option value=""> --- Please Select --- </option>
					                        <option data-ng-cloak data-ng-repeat="lg in localGovts" value="@{{lg.id}}" data-ng-selected="lg.id == {{ $merchant->local_govt->id }}">@{{lg.local_govt}}</option>                           
					                     </select>

					                     <!-- Element Errors Holder -->
                                        <span class="form-div-error" data-ng-cloak data-ng-show="merchant.form.local_govt_id.$error.required && merchant.form.local_govt_id.$dirty">** Please select your local government</span> 
									</div>

									<div class="form-group">
										<label for="id_state_of_business">Business Categories <span class="small">Hold CTRL key to select multiple options</span></label>
										<select name="business_categories" data-ng-init="merchant.business_categories=[]; updateBusinessCategories('{{ $merchant->business_categories }}')" data-ng-model="merchant.business_categories" id="id_business_categories" class="form-control signup-select" style="height: 100px" multiple required>
					                        @if(count($products_categories))
					                           @foreach($products_categories as $product_category)
					                            <option value="{{ $product_category->id }}" data-ng-selected="merchant.business_categories.indexOf('{{ $product_category->id }}') >= 0">{{ $product_category->category_name }}</option>
					                          @endforeach
					                        @endif                           
					                     </select>
					                     <!-- Element Errors Holder -->
                                        <span class="form-div-error" data-ng-cloak data-ng-show="merchant.form.business_categories.$error.required && merchant.form.business_categories.$dirty">** Please select your business categories</span> 
									</div>

									<div class="form-group">
										<label for="telephone">Telephone</label>
										<input type="tel" class="form-control" id="telephone" name="telephone" data-ng-init="merchant.telephone='{{ $merchant->telephone }}'" data-ng-model="merchant.telephone" data-ng-pattern="/^[0-9]{1,15}$/" placeholder="Enter your telephone number" required>
										<span class="form-div-error" data-ng-cloak ng-show="merchant.form.telephone.$error.required && merchant.form.telephone.$dirty">** This field is required</span>
                                        <span class="form-div-error" data-ng-cloak ng-show="!merchants.form.telephone.$error.required && merchant.form.telephone.$error.pattern && merchant.form.telephone.$dirty">** Invalid telephone number provided</span>
									</div>
									
									<button type="button" class="btn btn-primary btn-md" id="business-details-btn" data-ng-disabled="merchant.form.$invalid" data-ng-click="saveChanges($event, 'business_details', 'business-details', 'Save Business Details')"><i class="fa fa-save"></i> Save Business Details</button>
								</form>
							</div><!-- .widget-body -->

                                <div class="widget">
									<header class="widget-header">
										<h4 class="widget-title">Change Password</h4>
									</header><!-- .widget-header -->
									<hr class="widget-separator">
								    <div class="widget-body">
										<form novalidate id="change-password" method="POST" name="merchant.password.form" action="">

											<div class="alert alert-danger" data-ng-cloak data-ng-if="merchant.activeForm == 'password'" data-ng-show="errors.length">
											    <strong>Please correct the errors listed below!</strong><br>
											    <ul style="list-style: none">
											            <li data-ng-repeat="error in errors">** @{{ error }}</li>
											    </ul>
											</div>

											<div class="form-group">
												<label for="current-password">Current Password</label>
												<input type="password" class="form-control" id="current-password" data-ng-model="merchant.current_password" name="current_password" placeholder="Enter your current password" required>
												<!-- Element Errors Holder -->
                                                <span class="form-div-error" data-ng-cloak data-ng-show="merchant.password.form.current_password.$error.required && merchant.password.form.current_password.$dirty">** Please enter your current password</span> 
											</div>

											<div class="form-group">
												<label for="new-password">New Password</label>
												<input type="password" class="form-control" id="new-password" data-ng-model="merchant.new_password" data-ng-minlength="8" data-ng-maxlength="20" name="password" placeholder="Enter your new password" required>
												<span class="form-div-error" data-ng-cloak data-ng-show="merchant.password.form.password.$error.required && merchant.password.form.password.$dirty">** This field is required</span>
                                                <span class="form-div-error" data-ng-cloak data-ng-show="!merchant.password.form.password.$error.required && (merchant.password.form.password.$error.minlength || merchant.password.form.password.$error.maxlength) && merchant.password.form.password.$dirty">** Your password must be between 8 and 20 characters.</span>
											</div>

											<div class="form-group">
												<label for="password-again">Password Again</label>
												<input type="password" class="form-control" id="password-again" name="password_confirmation" data-ng-model="merchant.password_confirmation" placeholder="Enter your password again" required>
												<!-- Element Errors Holder -->
                                                <span class="form-div-error" data-ng-cloak data-ng-show="merchant.password.form.password_confirmation.$error.required && merchant.password.form.password_confirmation.$dirty">** Please enter your password again</span> 
											</div>
											<button type="button" class="btn btn-primary btn-md" id="change-password-btn" data-ng-disabled="merchant.password.form.$invalid" data-ng-click="saveChanges($event, 'password', 'change-password', 'Save Password')"><i class="fa fa-save"></i> Save Password</button>
									    </form>
									 </div>						    
									</div>
							

						</div><!-- .tab-pane -->

						<div role="tabpanel" id="bank-details-form" class="tab-pane fade p-md">
							<div class="widget-body">
								<form novalidate method="POST" make-dirty name="merchant.bank.form" id="bank-details" action="">
									<div class="alert alert-danger" data-ng-cloak data-ng-if="merchant.activeForm == 'bank_details'" data-ng-show="errors.length">
									    <strong>Please correct the errors listed below!</strong><br>
									    <ul style="list-style: none">
									            <li data-ng-repeat="error in errors">** @{{ error }}</li>
									    </ul>
									</div>

									<div class="form-group">
										<label for="business-name">Bank Name</label>
										<input type="text" class="form-control" id="bank-name" data-ng-init="merchant.bank_name='{{ $merchant->bank_details->bank_name }}'" data-ng-model="merchant.bank_name" name="bank_name" placeholder="Enter your bank name" required>
										<!-- Element Errors Holder -->
                                        <span class="form-div-error" data-ng-cloak data-ng-show="merchant.bank.form.bank_name.$error.required && merchant.bank.form.bank_name.$dirty">** Please enter your bank name</span> 
									</div>
									<div class="form-group">
										<label for="account-type">Account Type</label>
										<select name="account_type" data-ng-init="merchant.account_type='{{ $merchant->bank_details->account_type }}'" data-ng-model="merchant.account_type" id="account-type" class="form-control" required>
						                  <option value=""> --- Please Select --- </option>
						                  <option ng-repeat="at in accountTypes">@{{at}}</option>
						               </select>
										<!-- Element Errors Holder -->
                                        <span class="form-div-error" data-ng-cloak data-ng-show="merchant.bank.form.account_type.$error.required && merchant.bank.form.account_type.$dirty">** Please select your account type</span> 

									</div>

									<div class="form-group">
										<label for="id_account_number">Account Number</label>
										<input class="form-control" data-ng-init="merchant.account_number={{ $merchant->bank_details->account_number }}" data-ng-model="merchant.account_number" id="id_account_number" placeholder="Enter your Account Number" maxlength="30" name="account_number" type="number" required> 
						                <!-- Element Errors Holder -->
						                <span class="form-div-error" data-ng-cloak data-ng-show="merchant.bank.form.account_number.$error.required && merchant.bank.form.account_number.$dirty">** Please enter your account number</span>  
									</div>
									
									<button type="button" class="btn btn-primary btn-md" id="bank-details-btn" data-ng-disabled="merchant.bank.form.$invalid" data-ng-click="saveChanges($event, 'bank_details', 'bank-details', 'Save Bank Details')"><i class="fa fa-save"></i> Save Bank Details</button>
								</form>
							</div><!-- .widget-body -->
						</div><!-- .tab-pane -->

						<div role="tabpanel" class="tab-pane fade p-md" id="contact-details">
							<div class="widget-body">
								<form novalidate method="POST" make-dirty name="merchant.contact.form" id="contact-details" action="">
									<div class="alert alert-danger" data-ng-cloak data-ng-if="merchant.activeForm == 'contact_details'" data-ng-show="errors.length">
									    <strong>Please correct the errors listed below!</strong><br>
									    <ul style="list-style: none">
									            <li data-ng-repeat="error in errors">** @{{ error }}</li>
									    </ul>
									</div>

									<div class="form-group">
										<label for="full-name">Full Name</label>
										<input type="text" class="form-control" id="full-name" data-ng-init="merchant.full_name='{{ $merchant->contact_person->full_name }}'" data-ng-model="merchant.full_name" name="full_name" placeholder="Enter the full name of your contact person" required>
										<!-- Element Errors Holder -->
                                        <span class="form-div-error" data-ng-cloak data-ng-show="merchant.contact.form.full_name.$error.required && merchant.contact.form.full_name.$dirty">** Please enter the name of your contact person</span> 
									</div>

									<div class="form-group">
										<label for="id_address">Address</label>
										<input class="form-control" data-ng-init="merchant.address='{{ $merchant->contact_person->address }}'" data-ng-model="merchant.address" id="id_address" placeholder="Address of your contact person" name="address" type="text" required> 
						                <!-- Element Errors Holder -->
						                <span class="form-div-error" data-ng-cloak data-ng-show="merchant.contact.form.address.$error.required && merchant.contact.form.address.$dirty">** Please enter the address of your contact person</span>  
									</div>
									
									<button type="button" class="btn btn-primary btn-md" id="contact-details-btn" data-ng-disabled="merchant.contact.form.$invalid" data-ng-click="saveChanges($event, 'contact_details', 'contact-details', 'Save Contact Details')"><i class="fa fa-save"></i> Save Contact Details</button>
								</form>
							</div><!-- .widget-body -->
						</div><!-- .tab-pane -->

						<div role="tabpanel" class="tab-pane fade p-md" id="pos-details">
							 <div class="widget-body">
								<form novalidate method="POST" make-dirty name="merchant.pos.form" id="pos-details" action="">
									<div class="alert alert-danger" data-ng-cloak data-ng-if="merchant.activeForm == 'pos_details'" data-ng-show="errors.length">
									    <strong>Please correct the errors listed below!</strong><br>
									    <ul style="list-style: none">
									            <li data-ng-repeat="error in errors">** @{{ error }}</li>
									    </ul>
									</div>

									<div class="form-group">
										<label for="premises-type">Type of Premises Required</label>
										<select name="premises_type" data-ng-init="merchant.premises_type='{{ $merchant->pos_details->premises_type_required }}'" data-ng-model="merchant.premises_type" id="premises-type" class="form-control" required>
						                  <option value=""> --- Please Select --- </option>
						                  <option ng-repeat="tp in typeOfPremises">@{{tp}}</option>
						               </select>
										<!-- Element Errors Holder -->
                                        <span class="form-div-error" data-ng-cloak data-ng-show="merchant.pos.form.premises_type.$error.required && merchant.pos.form.premises_type.$dirty">** Please select the type of premises required</span> 
									</div>
                           
									<div class="form-group" data-ng-cloak data-ng-show="merchant.premises_type == 'Rented'">
										<label for="duration-of-rent">Duration of Rent</label>
										<datepicker date-format="yyyy-MM-dd" style="margin-bottom: 24px;">
										   <input class="form-control" data-ng-required="merchant.premises_type == 'Rented'" data-ng-init="merchant.rent_duration='{{ $merchant->pos_details->rented_duration == '0000-00-00' ? '' : $merchant->pos_details->rented_duration }}'" data-ng-model="merchant.rent_duration" id="duration-of-rent" placeholder="Enter the rent duration" name="rent_duration" type="text">
									    </datepicker>
										<!-- <input type="text" id="datetimepicker5" class="form-control" data-plugin="datetimepicker" data-options="{ defaultDate: '3/27/2016' }"> -->
						                <!-- Element Errors Holder -->
						                <span class="form-div-error" data-ng-cloak data-ng-show="merchant.pos.form.rent_duration.$error.required && merchant.pos.form.rent_duration.$dirty">** Please enter the rent duration</span> 
									</div>

									<div class="form-group">
										<label for="chain-stores">Number of chain stores to delpoy POS</label>
										<input class="form-control" data-ng-init="merchant.number_of_chain_stores={{ $merchant->pos_details->number_of_chain_stores }}" data-ng-model="merchant.number_of_chain_stores" id="chain-stores" placeholder="Enter the number of chain stores" maxlength="30" name="number_of_chain_stores" type="number" required> 
						                <!-- Element Errors Holder -->
						                <span class="form-div-error" data-ng-cloak data-ng-show="merchant.pos.form.number_of_chain_stores.$error.required && merchant.pos.form.number_of_chain_stores.$dirty">** Please enter the number of chain stores</span>  
									</div>
									
									<button type="button" class="btn btn-primary btn-md" id="pos-details-btn" data-ng-disabled="merchant.pos.form.$invalid" data-ng-click="saveChanges($event, 'pos_details', 'pos-details', 'Save POS Details')"><i class="fa fa-save"></i> Save POS Details</button>
								</form>
							</div><!-- .widget-body -->
					    </div>
					</div><!-- .tab-content -->
				</div><!-- #profile-components -->
			</div><!-- END column -->
		</div><!-- .row -->
	</section><!-- #dash-content -->
@endsection