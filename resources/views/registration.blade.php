@extends('layouts.home')
@section('title', 'Register for online courses')
@section('content')
<section class="p40 full-width">
    <div class="container">
      <div class="row  mTop-30">
        <div class="col-sm-6 col-sm-offset-3">


        <div class="hpanel">

        <div class="panel-body frameLR bg-white shadow">
          {{-- Errors --}}
          @include('shared.errors')
          
            <div data-ng-controller="MerchantSignupCtrl">
            <h1 class="merchants-signup-header">Student Registration</h1>

                      <p>Already have an account? Then please <a href="{{ url('merchants/signin') }}">sign in</a>.</p>

                      <!-- Angular Errors -->
                      <div class="alert alert-danger" data-ng-cloak data-ng-show="errors.length">
                          <strong>Please correct the errors listed below!</strong><br>
                          <ul style="list-style: none">
                                  <li data-ng-repeat="error in errors">** @{{ error }}</li>
                          </ul>
                      </div>

                      <form class="signup" id="merchant-signup-form" name="merchants.signup.form" novalidate method="post" action="{{ url('merchants/signup') }}" enctype="multipart/form-data">

                        {{ csrf_field() }}
                     <div id="div_id_business_name" class="form-group"> 
                      <label for="id_business_name" class="control-label signup-label">
                                First Name<span class="asteriskField">*</span>
                      </label> 
                      <div class="controls "> 
                        <input class="textinput textInput form-control signup-form-control" data-ng-init="merchants.business_name='{{ old('business_name') }}'" data-ng-model="merchants.business_name" id="id_business_name" placeholder="Your Business Name" maxlength="30" name="business_name" type="text" required>
                        <input type="hidden" name="completed_registration_step" value="1">
                        <!-- Element Errors Holder -->
                        <span class="form-div-error" data-ng-cloak data-ng-show="merchants.signup.form.business_name.$error.required && merchants.signup.form.business_name.$dirty">** Please enter your business name</span> 
                      </div> 
                    </div> 

                    <div id="div_id_business_address" class="form-group"> 
                      <label for="id_business_address" class="control-label signup-label">
                                Last Name<span class="asteriskField">*</span>
                      </label> 
                      <div class="controls "> 
                        <input class="textinput textInput form-control signup-form-control" data-ng-init="merchants.business_address='{{ old('business_address') }}'" data-ng-model="merchants.business_address" id="id_business_address" placeholder="Your Business Address" maxlength="30" name="business_address" type="text"  required>
                        <!-- Element Errors Holder -->
                        <span class="form-div-error" data-ng-cloak data-ng-show="merchants.signup.form.business_address.$error.required && merchants.signup.form.business_address.$dirty">** Please enter your business address</span>  
                      </div> 
                    </div>

                    <div id="div_id_business_type" class="form-group"> 
                      <label for="id_business_type" class="control-label signup-label">
                                Registration Number<span class="asteriskField">*</span>
                      </label> 
                      <div class="controls "> 
                        <input class="textinput textInput form-control signup-form-control" data-ng-init="merchants.business_type='{{ old('business_type') }}'" data-ng-model="merchants.business_type" id="id_business_type" placeholder="Your Business Type" maxlength="30" name="business_type" type="text" required> 
                        <!-- Element Errors Holder -->
                        <span class="form-div-error" data-ng-cloak data-ng-show="merchants.signup.form.business_type.$error.required && merchants.signup.form.business_type.$dirty">** Please enter your business type</span>  
                      </div> 
                    </div> 

                    <div id="div_id_telephone" class="form-group"> 
                      <label for="id_telephone" class="control-label signup-label">
                                Telephone Number<span class="asteriskField">*</span>
                      </label> 
                      <div class="controls "> 
                        <input class="textinput textInput form-control signup-form-control" id="id_telephone" maxlength="30" placeholder="Your Telephone Number" name="telephone" value="{{ old('telephone') }}" data-ng-init="merchants.telephone='{{ old('telephone') }}'" data-ng-model="merchants.telephone" data-ng-pattern="/^[0-9]{1,15}$/" type="tel" required>
                        <span class="form-div-error" data-ng-cloak ng-show="merchants.signup.form.telephone.$error.required && merchants.signup.form.telephone.$dirty">** This field is required</span>
                        <span class="form-div-error" data-ng-cloak ng-show="!merchants.signup.form.telephone.$error.required && merchants.signup.form.telephone.$error.pattern && merchants.signup.form.telephone.$dirty">** Invalid telephone number provided</span>
                      </div> 
                    </div> 

                  <div id="div_id_email" class="form-group"> 
                    <label for="id_email" class="control-label  requiredField  signup-label">
                      E-mail<span class="asteriskField">*</span> 
                    </label> 
                    <div class="controls "> 
                      <input class="textinput textInput form-control signup-form-control" data-ng-init="merchants.email='{{ old('email') }}'" data-ng-model="merchants.email" id="id_email" name="email" placeholder="E-mail address" type="email" required>
                      <!-- Element Errors Holder -->
                        <span class="form-div-error" data-ng-cloak data-ng-show="merchants.signup.form.email.$error.required && merchants.signup.form.email.$dirty">** This field is required</span>
                        <span class="form-div-error" data-ng-cloak data-ng-show="!merchants.signup.form.email.$error.required && merchants.signup.form.email.$error.email && merchants.signup.form.email.$dirty">** Invalid email address provided</span>    
                    </div> 
                  </div> 


                  <div id="div_id_password1" class="form-group"> 
                    <label for="id_password1" class="control-label  requiredField  signup-label">
                      Password<span class="asteriskField">*</span> 
                    </label> <div class="controls "> 
                    <input class="textinput textInput form-control signup-form-control" data-ng-model="merchants.password" data-ng-minlength="8" data-ng-maxlength="20" id="id_password1" name="password" placeholder="Password" type="password" required>
                    <span class="form-div-error" data-ng-cloak data-ng-show="merchants.signup.form.password.$error.required && merchants.signup.form.password.$dirty">** This field is required</span>
                      <span class="form-div-error" data-ng-cloak data-ng-show="!merchants.signup.form.password.$error.required && (merchants.signup.form.password.$error.minlength || merchants.signup.form.password.$error.maxlength) && merchants.signup.form.password.$dirty">** Your password must be between 8 and 20 characters.</span>
                  </div> 
                </div>

                <div id="div_id_password2" class="form-group"> 
                  <label for="id_password2" class="control-label  requiredField  signup-label">
                      Password (again)<span class="asteriskField">*</span> 
                    </label> 
                    <div class="controls "> 
                    <input class="textinput textInput form-control signup-form-control" data-ng-model="merchants.password_confirmation" id="id_password2" name="password_confirmation" placeholder="Password (again)" type="password" required>
                    <span class="form-div-error" data-ng-show="merchants.signup.form.password_confirmation.$error.required && merchants.signup.form.password_confirmation.$dirty">** This field is required</span>
                  </div> 
                </div>

                 
                        
                <button id="sign-up-button" class="btn btn-primary merchant-signup-btn" type="button" data-ng-click="submit()">Continue »</button>
                 </form>

          </div>
          <!-- Declaration -->
          <p style="margin-top: 10px">By signing up, you agree to the <a href="{{ url('/terms-and-conditions') }}" class="legal-link" target="_blank">Terms of Service</a> 
            and <a href="{{ url('/privacy-policy') }}" class="legal-link" target="_blank">Privacy Policy</a> of {{ $company_name }}.</p>
        </div>
      </div>
    </div>
    </div>
    </div>

</section>
@endsection