@extends('layouts.home')
@section('title', $title)
@section('content')
<section class="p40 full-width">
    <div class="container" data-ng-controller="ResetPasswordCtrl">
      <div class="row  mTop-30 ">
        <div class="col-sm-4 col-sm-offset-4">


        <div class="hpanel">
        <div class="panel-body frameLR bg-white shadow">

          <h2 class="merchants-signup-header">Change Your Password</h2>

          {{-- Errors --}}
          @include('shared.errors')
        
          <form class="login" method="POST" id="merchants-change-password-form" name="merchants.change.password.form" action="{{ url('/merchant/reset-password') }}">
            {{ csrf_field() }}
             <div id="div_id_login" class="form-group"> 
                <label for="id_password" class="control-label signup-label  requiredField">
                    New Password<span class="asteriskField">*</span> 
                </label> 
                <div class="controls "> 
                  <input data-ng-minlength="8" data-ng-maxlength="20" data-ng-model="merchant.password" name="password" class="textinput textInput form-control signup-form-control" id="id_password" placeholder="Enter your new password" type="password" required> 
                  <input type="hidden" name="password_token" value="{{ $token }}">
                  <!-- Element Errors Holder -->
                  <span class="form-div-error" data-ng-cloak data-ng-show="merchants.change.password.form.password.$error.required && merchants.change.password.form.password.$dirty">** This field is required</span>
                  <span class="form-div-error" data-ng-cloak data-ng-show="!merchants.change.password.form.password.$error.required && (merchants.change.password.form.password.$error.minlength || merchants.change.password.form.password.$error.maxlength) && merchants.change.password.form.password.$dirty">** Your password must be between 8 and 20 characters.</span>
                </div> 
              </div>

              <div id="div_id_password" class="form-group"> 
                <label for="id_password" class="control-label signup-label  requiredField">
                      Confirm Password<span class="asteriskField">*</span> 
                </label> 
                <div class="controls "> 
                <input class="textinput textInput form-control signup-form-control" data-ng-model="merchant.password_confirmation" id="id_password" name="password_confirmation" placeholder="Password" type="password" required>
                <span class="form-div-error" data-ng-cloak data-ng-show="merchants.change.password.form.password_confirmation.$error.required && merchants.change.password.form.password_confirmation.$dirty">** This field is required</span>
              </div> 
            </div>
            
            <button id="sign-in-button" class="btn btn-primary merchant-signup-btn" type="button" data-ng-disabled="merchants.change.password.form.$invalid" data-ng-click="changePassword()">Reset Password</button>
          </form>

        </div>
      </div>

        </div>
      </div>
    </div>
</section>
@endsection