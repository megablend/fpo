<div data-ng-controller="MerchantPosCtrl">
    <h1 class="merchants-signup-header">Number of POS Required</h1>

              <!-- Angular Errors -->
              <div class="alert alert-danger" data-ng-cloak data-ng-show="errors.length">
                  <strong>Please correct the errors listed below!</strong><br>
                  <ul style="list-style: none">
                          <li data-ng-repeat="error in errors">** @{{ error }}</li>
                  </ul>
              </div>

              <form class="signup" id="merchant-signup-form" name="merchants.signup.form" novalidate method="post" action="{{ url('merchants/signup') }}">

                {{ csrf_field() }}
             
            <div id="div_id_premises_type" class="form-group"> 
              <label for="id_premises_type" class="control-label signup-label">
                        Type of Premises Required<span class="asteriskField">*</span>
              </label> 
              <div class="controls "> 
                <select name="premises_type" data-ng-init="merchants.premises_type='{{ old('premises_type') }}'" data-ng-model="merchants.premises_type" id="input-premises-type" class="form-control" required>
                  <option value=""> --- Please Select --- </option>
                  <option ng-repeat="tp in typeOfPremises">@{{tp}}</option>
               </select>
               <span class="form-div-error" data-ng-cloak data-ng-show="merchants.signup.form.account_type.$error.required && merchants.signup.form.account_type.$dirty">** Please select the type of premises required</span>
              </div> 
            </div>

            <div id="div_id_rent_duration" class="form-group" data-ng-cloak data-ng-show="merchants.premises_type == 'Rented'"> 
              <label for="id_full_name" class="control-label signup-label">
                        Duration of Rent <span class="asteriskField">*</span>
              </label> 
              <div class="controls "> 
                <datepicker date-format="yyyy-MM-dd">
                   <input class="textinput textInput form-control signup-form-control" data-ng-required="merchants.premises_type == 'Rented'" data-ng-init="merchants.rent_duration='{{ old('rent_duration') }}'" data-ng-model="merchants.rent_duration" id="id_rent_duration" placeholder="The rent duration" name="rent_duration" type="text">
               </datepicker>
                <!-- Element Errors Holder -->
                <span class="form-div-error" data-ng-cloak data-ng-show="merchants.signup.form.rent_duration.$error.required && merchants.signup.form.rent_duration.$dirty">** Please enter the rent duration</span> 
              </div> 
            </div>

            <div id="div_id_number_of_chain_stores" class="form-group"> 
              <label for="id_number_of_chain_stores" class="control-label signup-label">
                        Number of chain stores to delpoy POS <span class="asteriskField">*</span>
              </label> 
              <div class="controls "> 
                <input class="textinput textInput form-control signup-form-control" data-ng-init="merchants.number_of_chain_stores='{{  old('number_of_chain_stores') }}'" data-ng-model="merchants.number_of_chain_stores" id="id_number_of_chain_stores" placeholder="The number of chain stores" name="number_of_chain_stores" type="number" required>
                <input type="hidden" name="completed_registration_step" value="4">
                <!-- Element Errors Holder -->
                <span class="form-div-error" data-ng-cloak data-ng-show="merchants.signup.form.number_of_chain_stores.$error.required && merchants.signup.form.number_of_chain_stores.$dirty">** Please enter the number of chain stores</span> 
              </div> 
            </div> 
                
        <button id="sign-up-button" class="btn btn-primary merchant-signup-btn" type="button" data-ng-click="submit()">Finish »</button>
         </form>

  </div>