<div data-ng-controller="MerchantContactPersonCtrl">
    <h1 class="merchants-signup-header">Details of Contact Person/Business Owner</h1>

              <!-- Angular Errors -->
              <div class="alert alert-danger" data-ng-cloak data-ng-show="errors.length">
                  <strong>Please correct the errors listed below!</strong><br>
                  <ul style="list-style: none">
                          <li data-ng-repeat="error in errors">** @{{ error }}</li>
                  </ul>
              </div>

              <form class="signup" id="merchant-signup-form" name="merchants.signup.form" novalidate method="post" action="{{ url('merchants/signup') }}">

                {{ csrf_field() }}
             <div id="div_id_full_name" class="form-group"> 
              <label for="id_full_name" class="control-label signup-label">
                        Full Name<span class="asteriskField">*</span>
              </label> 
              <div class="controls "> 
                <input class="textinput textInput form-control signup-form-control" data-ng-init="merchants.fullname='{{ old('full_name') }}'" data-ng-model="merchants.full_name" id="id_full_name" placeholder="The full name of your contact person" maxlength="30" name="full_name" type="text" required>
                <input type="hidden" name="completed_registration_step" value="3">
                <!-- Element Errors Holder -->
                <span class="form-div-error" data-ng-cloak data-ng-show="merchants.signup.form.full_name.$error.required && merchants.signup.form.full_name.$dirty">** Please enter the full name of your contact person</span> 
              </div> 
            </div> 

            <div id="div_id_address" class="form-group"> 
              <label for="id_address" class="control-label signup-label">
                        Address<span class="asteriskField">*</span>
              </label> 
              <div class="controls "> 
                <input class="textinput textInput form-control signup-form-control" data-ng-init="merchants.address='{{ old('address') }}'" data-ng-model="merchants.address" id="id_address" placeholder="Address of your contact person" name="address" type="text" required> 
                <!-- Element Errors Holder -->
                <span class="form-div-error" data-ng-cloak data-ng-show="merchants.signup.form.address.$error.required && merchants.signup.form.address.$dirty">** Please enter the address of your contact person</span>  
              </div> 
            </div> 
                
        <button id="sign-up-button" class="btn btn-primary merchant-signup-btn" type="button" data-ng-click="submit()">Continue »</button>
         </form>

  </div>