<div data-ng-controller="MerchantBankDetailsCtrl">
    <h1 class="merchants-signup-header">Your Bank Details</h1>

              <!-- Angular Errors -->
              <div class="alert alert-danger" data-ng-cloak data-ng-show="errors.length">
                  <strong>Please correct the errors listed below!</strong><br>
                  <ul style="list-style: none">
                          <li data-ng-repeat="error in errors">** @{{ error }}</li>
                  </ul>
              </div>

              <form class="signup" id="merchant-signup-form" name="merchants.signup.form" novalidate method="post" action="{{ url('merchants/signup') }}">

                {{ csrf_field() }}
             <div id="div_id_bank_name" class="form-group"> 
              <label for="id_bank_name" class="control-label signup-label">
                        Bank Name<span class="asteriskField">*</span>
              </label> 
              <div class="controls "> 
                <input class="textinput textInput form-control signup-form-control" data-ng-init="merchants.bank_name='{{ old('bank_name') }}'" data-ng-model="merchants.bank_name" id="id_bank_name" placeholder="The name of your bank" maxlength="30" name="bank_name" type="text" required>
                <input type="hidden" name="completed_registration_step" value="2">
                <!-- Element Errors Holder -->
                <span class="form-div-error" data-ng-cloak data-ng-show="merchants.signup.form.bank_name.$error.required && merchants.signup.form.bank_name.$dirty">** Please enter the name of your bank</span> 
              </div> 
            </div> 

            <div id="div_id_account_type" class="form-group"> 
              <label for="id_account_type" class="control-label signup-label">
                        Account Type<span class="asteriskField">*</span>
              </label> 
              <div class="controls "> 
                <select name="account_type" data-ng-init="merchants.account_type='{{ old('account_type') }}'" data-ng-model="merchants.account_type" id="input-account-type" class="form-control" required>
                  <option value=""> --- Please Select --- </option>
                  <option ng-repeat="at in accountTypes">@{{at}}</option>
               </select>
               <span class="form-div-error" data-ng-cloak data-ng-show="merchants.signup.form.account_type.$error.required && merchants.signup.form.account_type.$dirty">** Please select your account type</span>
              </div> 
            </div>

            <div id="div_id_account_number" class="form-group"> 
              <label for="id_account_number" class="control-label signup-label">
                        Account Number<span class="asteriskField">*</span>
              </label> 
              <div class="controls "> 
                <input class="textinput textInput form-control signup-form-control" data-ng-init="merchants.account_number='{{ old('account_number') }}'" data-ng-model="merchants.account_number" id="id_account_number" placeholder="Your Account Number" maxlength="30" name="account_number" type="number" required> 
                <!-- Element Errors Holder -->
                <span class="form-div-error" data-ng-cloak data-ng-show="merchants.signup.form.account_number.$error.required && merchants.signup.form.account_number.$dirty">** Please enter your account number</span>  
              </div> 
            </div> 
                
        <button id="sign-up-button" class="btn btn-primary merchant-signup-btn" type="button" data-ng-click="submit()">Continue »</button>
         </form>

  </div>