@extends('layouts.home')
@section('title', $title)
@section('extra_css_files')
  <link rel="stylesheet" href="{{ URL::asset('public/assets/css/2_0/upload.css') }}">
@endsection

@section('extra_js_files')
  <script src="{{ URL::asset('public/assets/js/2_0/upload.js') }}"></script>
@endsection
@section('content')
<section class="p40 full-width">
    <div class="container" data-ng-controller="MerchantSigninCtrl">
      <div class="row  mTop-30 ">
        <div class="col-sm-4 col-sm-offset-4">


        <div class="hpanel">
        <div class="panel-body frameLR bg-white shadow">

          <h2 class="merchants-signup-header">Sign In</h2>

          {{-- Errors --}}
          @include('shared.errors')
        
          <form class="login" method="POST" id="merchants-signin-form" name="merchants.signin.form" action="{{ url('merchants/signin') }}">
            {{ csrf_field() }}
             <div id="div_id_login" class="form-group"> 
                <label for="id_login" class="control-label signup-label  requiredField">
                    E-mail<span class="asteriskField">*</span> 
                </label> 
                <div class="controls "> 
                  <input autofocus="autofocus" data-ng-model="merchants.email" name="email" class="textinput textInput form-control signup-form-control" id="id_login" placeholder="E-mail address" type="email" required> 
                  <!-- Element Errors Holder -->
                <span class="form-div-error" data-ng-cloak data-ng-show="merchants.signin.form.email.$error.required && merchants.signin.form.email.$dirty">** This field is required</span>
                <span class="form-div-error" data-ng-cloak data-ng-show="!merchants.signin.form.email.$error.required && merchants.signin.form.email.$error.email && merchants.signin.form.email.$dirty">** Invalid email address provided</span>    
                </div> 
              </div> 
            <div id="div_id_password" class="form-group"> 
              <label for="id_password" class="control-label signup-label  requiredField">
                    Password<span class="asteriskField">*</span> 
              </label> 
              <div class="controls "> 
              <input class="textinput textInput form-control signup-form-control" data-ng-model="merchants.password" id="id_password" name="password" placeholder="Password" type="password" required>
              <span class="form-div-error" data-ng-cloak data-ng-show="merchants.signin.form.password.$error.required && merchants.signin.form.password.$dirty">** This field is required</span>
            </div> 
          </div> 

            
            <button id="sign-in-button" class="btn btn-primary merchant-signup-btn" type="button" data-ng-click="submit()">Sign In <i class="fa fa-sign-in"></i></button>
            <a class="secondaryAction" href="{{ url('merchants/forgot-password') }}">Forgot Password?</a>
          </form>

        </div>
      </div>

        </div>
      </div>
    </div>
</section>
@endsection