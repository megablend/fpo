@extends('layouts.home')
@section('title', $title)
@section('content')
<section class="p40 full-width">
    <div class="container" data-ng-controller="ResetPasswordCtrl">
      <div class="row  mTop-30 ">
        <div class="col-sm-4 col-sm-offset-4">


        <div class="hpanel">
        <div class="panel-body frameLR bg-white shadow">

          <h2 class="merchants-signup-header">Password Reset</h2>

          <p><?php print $message; ?></p>

        </div>
      </div>

        </div>
      </div>
    </div>
</section>
@endsection