@extends('layouts.home')
@section('title', $title)
@section('content')
<section class="p40 full-width">
    <div class="container" data-ng-controller="ResetPasswordCtrl">
      <div class="row  mTop-30 ">
        <div class="col-sm-4 col-sm-offset-4">


        <div class="hpanel">
        <div class="panel-body frameLR bg-white shadow">

          <h2 class="merchants-signup-header">Forgot Your Password?</h2>

          {{-- Errors --}}
          @include('shared.errors')
        
          <form class="login" method="POST" id="merchants-password-reset-form" name="merchants.reset.form" action="{{ url('merchants/forgot-password') }}">
            {{ csrf_field() }}
             <div id="div_id_login" class="form-group"> 
                <label for="id_login" class="control-label signup-label  requiredField">
                    E-mail<span class="asteriskField">*</span> 
                </label> 
                <div class="controls "> 
                  <input autofocus="autofocus" data-ng-model="merchant.email" name="email" class="textinput textInput form-control signup-form-control" id="id_login" placeholder="Enter your e-mail address" type="email" required> 
                  <!-- Element Errors Holder -->
                <span class="form-div-error" data-ng-cloak data-ng-show="merchants.reset.form.email.$error.required && merchants.reset.form.email.$dirty">** This field is required</span>
                <span class="form-div-error" data-ng-cloak data-ng-show="!merchants.reset.form.email.$error.required && merchants.reset.form.email.$error.email && merchants.reset.form.email.$dirty">** Invalid email address provided</span>    
                </div> 
              </div> 
            
            <button id="sign-in-button" class="btn btn-primary merchant-signup-btn" type="button" data-ng-disabled="merchants.reset.form.$invalid" data-ng-click="resetPassword()">Send me reset password instructions</button>
          </form>

        </div>
      </div>

        </div>
      </div>
    </div>
</section>
@endsection