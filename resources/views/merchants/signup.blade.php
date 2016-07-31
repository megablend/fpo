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
    <div class="container">
      <div class="row  mTop-30">
        <div class="col-sm-6 col-sm-offset-3">


        <div class="hpanel">

        <div class="panel-body frameLR bg-white shadow">
          <!-- Navigation Wizard
          ========================================-->
          @include('merchants.partials.nav')

          {{-- Errors --}}
          @include('shared.errors')
          
           
          @if(!session()->has('merchant_completed_step') || session('merchant_completed_step') == '0')
            @include('merchants.partials.registration_step_1')
          @elseif(session()->has('merchant_completed_step') && session('merchant_completed_step') == '1')
            @include('merchants.partials.registration_step_2')
          @elseif(session()->has('merchant_completed_step') && session('merchant_completed_step') == '2')
            @include('merchants.partials.registration_step_3')
          @elseif(session()->has('merchant_completed_step') && session('merchant_completed_step') == '3')
            @include('merchants.partials.registration_step_4')
          @else
              @include('merchants.partials.registration_step_1')
          @endif

          <!-- Declaration -->
          <p style="margin-top: 10px">By signing up, you agree to the <a href="{{ url('/terms-and-conditions') }}" class="legal-link" target="_blank">Terms of Service</a> 
            and <a href="{{ url('/privacy-policy') }}" class="legal-link" target="_blank">Privacy Policy</a> of Tradestore.</p>
        </div>
      </div>
    </div>
    </div>
    </div>

</section>
@endsection