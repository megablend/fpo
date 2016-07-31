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
          
            <div data-ng-controller="UsersCtrl">
            <h1 class="merchants-signup-header">Student's Registration</h1>

                      <p>Already have an account? Then please <a href="{{ url('/login') }}">login</a>.</p>

                      <!-- Angular Errors -->
                      <div class="alert alert-danger" data-ng-cloak data-ng-show="errors.length">
                          <strong>Please correct the errors listed below!</strong><br>
                          <ul style="list-style: none">
                                  <li data-ng-repeat="error in errors">** @{{ error }}</li>
                          </ul>
                      </div>

                      <form class="signup" id="user-signup-form" name="user.signup.form" novalidate method="post" action="{{ url('/register') }}" enctype="multipart/form-data">

                        {{ csrf_field() }}
                     <div id="div_id_business_name" class="form-group"> 
                      <label for="id_business_name" class="control-label signup-label">
                                First Name<span class="asteriskField">*</span>
                      </label> 
                      <div class="controls "> 
                        <input class="textinput textInput form-control signup-form-control" data-ng-init="user.first_name='{{ old('first_name') }}'" data-ng-model="user.first_name" id="id_first_name" placeholder="Enter your first name" maxlength="30" name="first_name" type="text" required>
                        <!-- Element Errors Holder -->
                        <span class="form-div-error" data-ng-cloak data-ng-show="user.signup.form.first_name.$error.required && user.signup.form.first_name.$dirty">** Please enter your first name</span> 
                      </div> 
                    </div> 

                    <div id="div_id_business_address" class="form-group"> 
                      <label for="id_business_address" class="control-label signup-label">
                                Last Name<span class="asteriskField">*</span>
                      </label> 
                      <div class="controls "> 
                        <input class="textinput textInput form-control signup-form-control" data-ng-init="user.last_name='{{ old('last_name') }}'" data-ng-model="user.last_name" id="id_business_address" placeholder="Enter your last name" maxlength="30" name="last_name" type="text"  required>
                        <!-- Element Errors Holder -->
                        <span class="form-div-error" data-ng-cloak data-ng-show="user.signup.form.last_name.$error.required && user.signup.form.last_name.$dirty">** Please enter your last name</span>  
                      </div> 
                    </div>

                    <div id="div_id_business_type" class="form-group"> 
                      <label for="id_business_type" class="control-label signup-label">
                                Registration Number<span class="asteriskField">*</span>
                      </label> 
                      <div class="controls "> 
                        <input class="textinput textInput form-control signup-form-control" data-ng-init="user.registration_number='{{ old('registration_number') }}'" data-ng-model="user.registration_number" id="id_business_type" placeholder="Enter your registration number" maxlength="30" name="registration_number" type="text" required> 
                        <!-- Element Errors Holder -->
                        <span class="form-div-error" data-ng-cloak data-ng-show="user.signup.form.registration_number.$error.required && user.signup.form.registration_number.$dirty">** Please enter your registration number</span>  
                      </div> 
                    </div> 

                    <div id="div_id_local_govt" class="form-group"> 
                    <label for="id_local_govt" class="control-label  requiredField  signup-label">
                              Course<span class="asteriskField">*</span> 
                    </label> 
                    <div class="controls "> 
                          <select name="course" data-ng-init="user.course='{{ old('course') }}'" data-ng-model="user.course" id="id_course" class="form-control signup-select" required>
                              <option value=""> --- Please Select --- </option>
                              <option data-ng-cloak data-ng-repeat="course in courses" value="@{{course}}">@{{course}}</option>                           
                           </select>
                           <!-- Element Errors Holder -->
                           <span class="form-div-error" data-ng-cloak data-ng-show="user.signup.form.course.$error.required && user.signup.form.course.$dirty">** Please select the course you would like to study</span>  
                    </div> 
                  </div>

                    <div id="div_id_telephone" class="form-group"> 
                      <label for="id_telephone" class="control-label signup-label">
                                Telephone Number<span class="asteriskField">*</span>
                      </label> 
                      <div class="controls "> 
                        <input class="textinput textInput form-control signup-form-control" id="id_telephone" maxlength="30" placeholder="Your Telephone Number" name="telephone_number" value="{{ old('telephone_number') }}" data-ng-init="user.telephone_number='{{ old('telephone_number') }}'" data-ng-model="user.telephone_number" data-ng-pattern="/^[0-9]{1,15}$/" type="tel" required>
                        <span class="form-div-error" data-ng-cloak ng-show="user.signup.form.telephone_number.$error.required && user.signup.form.telephone_number.$dirty">** This field is required</span>
                        <span class="form-div-error" data-ng-cloak ng-show="!user.signup.form.telephone_number.$error.required && user.signup.form.telephone_number.$error.pattern && user.signup.form.telephone_number.$dirty">** Invalid telephone number provided</span>
                      </div> 
                    </div> 

                  <div id="div_id_email" class="form-group"> 
                    <label for="id_email" class="control-label  requiredField  signup-label">
                      E-mail<span class="asteriskField">*</span> 
                    </label> 
                    <div class="controls "> 
                      <input class="textinput textInput form-control signup-form-control" data-ng-init="user.email='{{ old('email') }}'" data-ng-model="user.email" id="id_email" name="email" placeholder="E-mail address" type="email" required>
                      <!-- Element Errors Holder -->
                        <span class="form-div-error" data-ng-cloak data-ng-show="user.signup.form.email.$error.required && user.signup.form.email.$dirty">** This field is required</span>
                        <span class="form-div-error" data-ng-cloak data-ng-show="!user.signup.form.email.$error.required && user.signup.form.email.$error.email && user.signup.form.email.$dirty">** Invalid email address provided</span>    
                    </div> 
                  </div> 


                  <div id="div_id_password1" class="form-group"> 
                    <label for="id_password1" class="control-label  requiredField  signup-label">
                      Password<span class="asteriskField">*</span> 
                    </label> <div class="controls "> 
                    <input class="textinput textInput form-control signup-form-control" data-ng-model="user.password" data-ng-minlength="8" data-ng-maxlength="20" id="id_password1" name="password" placeholder="Password" type="password" required>
                    <span class="form-div-error" data-ng-cloak data-ng-show="user.signup.form.password.$error.required && user.signup.form.password.$dirty">** This field is required</span>
                      <span class="form-div-error" data-ng-cloak data-ng-show="!user.signup.form.password.$error.required && (user.signup.form.password.$error.minlength || user.signup.form.password.$error.maxlength) && user.signup.form.password.$dirty">** Your password must be between 8 and 20 characters.</span>
                  </div> 
                </div>

                <div id="div_id_password2" class="form-group"> 
                  <label for="id_password2" class="control-label  requiredField  signup-label">
                      Password (again)<span class="asteriskField">*</span> 
                    </label> 
                    <div class="controls "> 
                    <input class="textinput textInput form-control signup-form-control" data-ng-model="user.password_confirmation" id="id_password2" name="password_confirmation" placeholder="Password (again)" type="password" required>
                    <span class="form-div-error" data-ng-show="user.signup.form.password_confirmation.$error.required && user.signup.form.password_confirmation.$dirty">** This field is required</span>
                  </div> 
                </div>

                 
                        
                <button id="sign-up-button" class="btn btn-primary merchant-signup-btn" type="button" data-ng-disabled="user.signup.form.$invalid" data-ng-click="submit()">Continue »</button>
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