/**
 * @createdBy: Megafu Charles
 * @dateOfCreation: **shrougs**
 * @email: megafu.charles@nexusaxis.com
 * 
 */

(function(){
var app = angular.module('jifatuApp', ['ngStorage', '720kb.datepicker']);
var urlPrefix = '';

/**
 * Global configuration
 * 
 */
app.run(function($rootScope, $http, defaultService, $interval){
   $rootScope.cart_items = [];
   $rootScope.activeOrderCode = null;
   $rootScope.orders = [];
   $rootScope.activeMerchantOrderCode = null;
   $rootScope.merchantOrders = [];
   $rootScope.orderCode = '';
   $http.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');


   //get the status name of an order id
   $rootScope.statusName = function(orderStatusId){
      switch(orderStatusId){
         case 1:
           return 'Pending';
         break;

         case 2:
           return 'Fulfilled';
         break;

         case 3:
           return 'Declined';
         break;

         case 5:
           return 'Cancelled';
         break;

         default:
           return 'Pending';
         break;
      }
   };

   //check if a user is logged in
    $rootScope.$on('$destroy', function() {
      $interval.cancel(timeoutId);
    });

    // start the UI update process; save the timeoutId for canceling
    timeoutId = $interval(function() {
      //console.log('hello');
    }, 5000);

   //cancel an order
   $rootScope.cancelOrder = function(orderId, orderCode){
      // cancel an order made by a customer
         swal({title: "Are you sure?",   
               text: "You're about to cancel an order. Do you want to proceed?",   
               type: "warning",   
               showCancelButton: true,   
               confirmButtonColor: "#DD6B55",   
               confirmButtonText: "Yes, cancel it!",   
               closeOnConfirm: true }, 
               function(){   
                    var url = '/' + urlPrefix + 'customers/cancel-item-order';
                    var params = { order_id : orderId };
                    defaultService.allPostRequests(url, params).
                    then(function(resp){
                        console.log(JSON.stringify(resp));
                        if(resp.status){
                            $("#item-order-status-" + orderId).html('Cancelled');
                            $('#item-cancel-btn-' + orderId).hide();
                            swal('Order Cancelled Successfully', resp.feedback, 'success');

                            //update order total
                            $('#order-sub-total-' + orderCode).html("&#8358;" + resp.order_sub_total);
                            $('#order-commission-' + orderCode).html("&#8358;" + resp.order_commission);
                            $('#order-total-' + orderCode).html("&#8358;" + resp.order_total);

                            //check if the parent order should be cancelled
                            if(resp.cancel_order){
                               $("#order-status-" + orderCode).html('Cancelled');
                               $('#cancel-btn-' + orderCode).hide();
                            }
                         }
                         else{
                            swal('Cancellation Error', resp.feedback, 'error');
                         }
                    }).
                    then(function(err){
                       if(typeof err != 'undefined'){
                          console.log(JSON.stringify(err));
                       }
                    }); 
          });
   };
});

/**
 * Capitalize a string
 * 
 */
app.filter('capitalize', function() {
    return function(input, all) {
      var reg = (all) ? /([^\W_]+[^\s-]*) */g : /([^\W_]+[^\s-]*)/;
      return (!!input) ? input.replace(reg, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}) : '';
    }
  });

/**
 * Jifatu Controller
 */
 app.controller('jifatuCtrl', ['$scope', 'defaultService', '$timeout', function($scope, defaultService, $timeout){
   $scope.purchase = [];
   $scope.purchase.quantity = 1;
   $scope.amountPreview = 0;
   $scope.range = function(min, max, step){
    step = step || 1;
    var input = [];
    for (var i = min; i <= max; i += step) input.push(i);
    return input;
  };

  //add item to cart
  $scope.addToCart = function(){
     if($scope.purchase.amount == '' || typeof $scope.purchase.amount == 'undefined'){
        swal('Error', 'Please enter the amount for the item you want to purchase', 'error');
        return;
     }

     if($scope.purchase.quantity == '' || typeof $scope.purchase.quantity == 'undefined'){
        swal('Error', 'Please enter the quantity of the item you want to purchase', 'error');
        return;
     }

     if($scope.purchase.description == '' || typeof $scope.purchase.description == 'undefined'){
        swal('Error', 'Please enter a brief description for the item you want to purchase', 'error');
        return;
     }
     else{
         swal({   title: "Are you sure?",   
                  text: "You are about to add this item to cart. Are all the details correct?",   
                  type: "success",   
                  showCancelButton: true,   
                  confirmButtonColor: "#74b64e",   
                  confirmButtonText: "Yes, add it!",   
                  closeOnConfirm: true }, 
                  function(){   
                       //add item to cart
                        var redirectPath = '/' + urlPrefix + 'customers/cart'; 
                        var urlPath = '/' + urlPrefix + 'customers/add-item-to-cart';
                        var params = { amount : $scope.purchase.amount,
                                       quantity : $scope.purchase.quantity,
                                       description : $scope.purchase.description };
                        defaultService.allPostRequests(urlPath, params).
                        then(function(resp){
                            if(resp.status){
                                 
                                 $('#add-to-cart-btn').html('<i class="fa fa-spinner fa-spin"></i> Adding Item...');
                                 $timeout(function(){
                                     //redirect to the cart page
                                     window.location.href = redirectPath;
                                 }, 2000);
                            }
                            else{
                               console.log(JSON.stringify(resp));
                               swal('Error', resp.feedback, 'error')
                            }
                        }).
                        then(function(err){
                           if(typeof err != 'undefined'){
                              console.log(JSON.stringify(err));
                           }
                        });
                  });
     }
  };
 }]);

/**
 * Shopping Cart Controller
 */
app.controller('CartCtrl', ['$scope', 'defaultService', '$filter', '$rootScope', function($scope, defaultService, $filter, $rootScope){
    $scope.cart = [];
    $scope.cart_items = [];
    $scope.cart_total = 0;
    $scope.total_amount = 10;
    $rootScope.cart_items = $scope.cart_items;

    //get all cart items
    var url = '/' + urlPrefix + 'customers/get-cart-items';
    defaultService.allGetRequests(url).
    then(function(resp){
        if(resp.status && resp.items){
            angular.forEach(resp.items, function(item){
                $scope.cart_items.push(item);
                var total_amount = parseInt(item.item_amount) * parseInt(item.item_quantity);
                $scope.cart_total += total_amount;
            });
        }
    }).
    then(function(err){
       if(typeof err != 'undefined'){
          console.log(JSON.stringify(err));
       }
    });

    //delete a cart item
    $scope.deleteCartItem = function(index){
       var cart_item = $scope.cart_items[index];
       swal({   title: "Are you sure?",   
       text: "You're about to delete this item from cart. Do you want to proceed?",   
       type: "warning",   
       showCancelButton: true,   
       confirmButtonColor: "#DD6B55",   
       confirmButtonText: "Yes, delete it!",   
       closeOnConfirm: true }, 
       function(){   
            // delete item from cart
            var urlPath = '/' + urlPrefix + 'customers/delete-cart-item';
            var params = { merchant_id : cart_item.merchant_id,
                           item_desc : cart_item.item_description}
            defaultService.allPostRequests(urlPath, params).
            then(function(resp){
               if(resp.status){
                   var total_amount = $filter("currency")(resp.total, "&#8358;");
                   $("#items-total-amt").html(total_amount);
               }
            }).
            then(function(err){
                if(typeof err != 'undefined'){
                   console.log(JSON.stringify(err))
                }
            });
            
             $scope.cart_items.splice(index, 1);
             $scope.$apply(function(){
                $scope.cart_items;
                $rootScope.cart_items;
             });
      });
    }
}]);

/**
 * Orders Controller 
 * 
 */
app.controller('OrderCtrl', ['$scope', 'defaultService', '$rootScope', function($scope, defaultService, $rootScope){
    //show order details
    $scope.orderDetails = function(orderCode){
        $rootScope.orders = [];
        
        // get all the orders made by this customer
        var url = '/' + urlPrefix + 'customers/get-orders';
        var params = { order_code : orderCode };
        defaultService.allPostRequests(url, params).
        then(function(resp){
            console.log(JSON.stringify(resp));
            if(resp.status && resp.orders){
                angular.forEach(resp.orders, function(order){
                    $rootScope.orders.push(order);
                });

                $rootScope.activeOrderCode = orderCode;
                // $rootScope.$apply(function(){
                //     $rootScope.activeOrderCode;
                // })
                $('#orderModal').modal('show'); 
             }
        }).
        then(function(err){
           if(typeof err != 'undefined'){
              console.log(JSON.stringify(err));
           }
        });
    };

    //cancel an order
    $scope.cancelOrder = function(orderCode, orderId, cancelBtn){
         // cancel an order made by a customer
         swal({title: "Are you sure?",   
               text: "You're about to cancel order " + orderCode + ". Do you want to proceed?",   
               type: "warning",   
               showCancelButton: true,   
               confirmButtonColor: "#DD6B55",   
               confirmButtonText: "Yes, cancel it!",   
               closeOnConfirm: true }, 
               function(){   
                    var url = '/' + urlPrefix + 'customers/cancel-order';
                    var params = { order_code : orderCode };
                    defaultService.allPostRequests(url, params).
                    then(function(resp){
                        if(resp.status){
                            $("#" + orderId).html('Cancelled');
                            $("#" + cancelBtn).hide();
                            swal('Order Cancelled Successfully', resp.feedback, 'success');
                         }
                         else{
                            swal('Cancellation Error', resp.feedback, 'error');
                         }
                    }).
                    then(function(err){
                       if(typeof err != 'undefined'){
                          console.log(JSON.stringify(err));
                       }
                    }); 
          });
    };


    //=============================== BANKORK ===========================================================
    //show order details
    $scope.orderDetailsMerchant = function(orderCode){
        $rootScope.merchantOrders = [];
        swal('Order Cancelled Successfully','The selected order was successfully cancelled', 'success');
        // get all the orders made by this customer
        var url = '/' + urlPrefix + 'merchants/get-orders';
        var params = { order_code : orderCode };
        defaultService.allPostRequests(url, params).
        then(function(resp){
            console.log(JSON.stringify(resp));
            if(resp.status && resp.orders){
                angular.forEach(resp.orders, function(order){
                    $rootScope.merchantOrders.push(order);
                });

                $rootScope.activeMerchantOrderCode = orderCode;
                // $rootScope.$apply(function(){
                //     $rootScope.activeOrderCode;
                // })
                $('#orderModal').modal('show'); 
             }
        }).
        then(function(err){
           if(typeof err != 'undefined'){
              console.log(JSON.stringify(err));
           }
        });
    };
}]);

 /**
 * Jifatu Controller
 */
 app.controller('SearchCtrl', ['$scope', 'defaultService', '$timeout', function($scope, defaultService, $timeout){
    $scope.searchStarted = false;
    $scope.searchTriggered = false;
    $scope.noSearchResult = false;
    $scope.result = [];
    $scope.localGovts = [];
    $scope.merchants = [];
    
    //update event listeners
    $scope.$on('updateEvent', function(event, data){
        if(data.searchStatus){
          $scope.noSearchResult = data.searchStatus;
        }
    })

    //activate merchant ID
    $scope.activateMerchant = function(merchantId){
      var redirectPath = '/' + urlPrefix + 'customers/make-purchase';
      var urlPath = '/' + urlPrefix + 'customers/activate-merchant';
      var params = { merchant_id : merchantId,
                     product_category_id : $scope.search.form.product_category.$viewValue }
      defaultService.allPostRequests(urlPath, params).
      then(function(resp){
          if(resp.status){
              window.location.href = redirectPath;
          }
      }).
      then(function(err){
         if(typeof err != 'undefined'){
            console.log(JSON.stringify(err));
         }
      });
    };

    $scope.searchForMerchants = function(){
       if($scope.search.form.state.$viewValue == '' || 
          typeof($scope.search.form.state.$viewValue) == 'undefined' ||
          $scope.search.form.local_govt.$viewValue == '' ||
          typeof($scope.search.form.local_govt.$viewValue) == 'undefined' ||
          $scope.search.form.product_category.$viewValue == '' ||
          typeof($scope.search.form.product_category.$viewValue) == 'undefined'){
           swal("Search Result", "Unable to render search result, please select all the fields", "error");
       }
       else{
          $scope.merchants = [];
          $scope.searchTriggered = true;
          $scope.searchStarted = true;
          $scope.noSearchResult = false;
          urlPath = '/' + urlPrefix + 'customers/get-merchants';
          params = { state_id : $scope.search.form.state.$viewValue,
                     local_govt_id : $scope.search.form.local_govt.$viewValue,
                     product_category_id : $scope.search.form.product_category.$viewValue };
          defaultService.allPostRequests(urlPath, params)
          .then(function(resp){
              // console.log(JSON.stringify(resp));
              $timeout(function(){
                  if(!resp.length){
                      $scope.$emit('updateEvent', { searchStatus : true });
                  }

                  $scope.searchStarted = false;
                  angular.forEach(resp, function(obj){
                      $scope.merchants.push(obj);
                  });
              }, 1000);
          })
          .then(function(err){
              if(typeof err != 'undefined'){
                 console.log('Something went wrong: ' + JSON.stringify(err));
              }
          });
       }
    }

    $scope.updateLocalGovt = function(){
       $scope.localGovts = [];
       urlPath = '/' + urlPrefix + 'customers/update-local-govts';
       params = { state_id : $scope.search.form.state.$viewValue };
       defaultService.allPostRequests(urlPath, params)
       .then(function(resp){
           if(resp.length > 0){
              angular.forEach(resp, function(obj){
                  $scope.localGovts.push(obj);
              });
           }
           else{
              swal("Local Governments", "Unable to get the list of local governments for the selected state, please try again", "error");
           }
       })
       .then(function(error){
          if(typeof error != 'undefined'){
              console.log('An error ocuured: ' + JSON.stringify(error));
          }
       });
    }
 }]);


/**
 * Header controller
 * 
 */
app.controller('HeaderCtrl', ['$scope', 'defaultService', function($scope, defaultService){

}]);

 /**
  * Registration Form Step One Controller
  */
 app.controller('regFormAcctDetailsCtrl', ['$scope', 'defaultService', '$http', function($scope, defaultService, $http){
    $scope.customers = {};
    $scope.errors = [];
    $scope.titles = ['Mr', 'Mrs', 'Master', 'Dr'];
    $scope.mariatlStatuses = ['Married', 'Single', 'Divorced'];
    $scope.genders = ['Male', 'Female'];
    $scope.meansOfIdentification = ['National Id Card', 'Driving Licence', 'Voters Card', 'Others'];
    $scope.accountTypes = ['Current', 'Savings'];
    $scope.cardTypes = ['Master', 'Verve', 'Visa'];

    var scroll = function(){
       $('html, body').animate({ scrollToTop: true }, 600);
    };
    
    $scope.check = function(){
       if($scope.regForm.phone_number.$viewValue == ''){
       	   if($scope.errors.indexOf('Please enter your phone number') == '-1'){
               $scope.errors.push('Please enter your phone number');
	       	   scroll();
	       	   return;
       	   }
       }
       if($scope.regForm.password.$viewValue != $scope.regForm.password_confirmation.$viewValue){
       	   if($scope.errors.indexOf('Your passwords do not match') == '-1'){
       	   	   $scope.errors.push('Your passwords do not match');
	       	   scroll();
	       	   return;
       	   }
       }
       else{//check for invalid phone number at the database
       	   var params = { tel: $scope.regForm.phone_number.$viewValue };
           $http.post('/' + urlPrefix + 'customers/check', { params: params })
           .success(function(response){
               if(response.status){
               	  if($scope.errors.indexOf('This phone number already exists.') == '-1'){
                      $scope.errors.push('This phone number already exists.');
	                  scroll();
	                  return;
               	  }
               }
               if($scope.regForm.$invalid){
               	  if($scope.errors.indexOf('Please fill/select the empty fields.') == '-1'){
                      $scope.errors.push('Please fill/select the empty fields.');
               	      return;
               	  }
               }
               else{
                  var form = $('#reg-form');
                  form.attr('action', $scope.customers.url);
                  form.submit();
               }
           })
           .error(function(error){
           	   console.log("An error occured: " + JSON.stringify(error));
           	   // defer.resolve(error);
           });
       }
    };
 }]);

/**
 * Merchants Registration Controller
 */
 app.controller('UsersCtrl', ['$scope', 'defaultService', '$timeout', function($scope, defaultService, $timeout){
     $scope.localGovts = [];
     $scope.errors = [];
     $scope.courses = ['Introductory Certificate in Information Technology - Creating Digital Products',
                       'Introductory Diploma in Information Technology - Creating Digital Products',
                       'Computer Systems with Data Cabling - Level 2 Diploma',
                       'Information and Creative Technology - BTEC Level 2 Certificate',
                       'Software and App Development - Higher National Certificate (HNC)'];
     $scope.updateLocalGovt = function(){
       $scope.localGovts = [];
       urlPath = '/' + urlPrefix + 'customers/update-local-govts';
       params = { state_id : $scope.merchants.signup.form.state_of_business_id.$viewValue };
       defaultService.allPostRequests(urlPath, params)
       .then(function(resp){
           if(resp.length > 0){
              angular.forEach(resp, function(obj){
                  $scope.localGovts.push(obj);
              });
           }
           else{
              swal("Local Governments", "Unable to get the list of local governments for the selected state, please try again", "error");
           }
       })
       .then(function(error){
          if(typeof error != 'undefined'){
              console.log('An error ocuured: ' + JSON.stringify(error));
          }
       });
    };

    $scope.submit = function(){
          if($scope.user.signup.form.$invalid){
              swal('Error', 'Please enter all required fields before you proceed.', 'error');
              return;
          }
          else{
              var form = $('#user-signup-form');
              $('#sign-up-button').html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
              $timeout(function(){
                 // $('#sign-up-button').html('Sign Up »');
                 form.submit();
              }, 2000);
          }
    };

    $scope.signinSubmit = function(){
             //check if the email address exists
              var urlPath = '/' + urlPrefix + 'check-email';
              var params = { email: $scope.user.email };
              defaultService.allPostRequests(urlPath, params).
              then(function(resp){
                  if($scope.user.signin.form.$invalid){
                      swal('Error', 'Please enter all required fields before you proceed.', 'error');
                      return;
                  }
                  else{
                      var form = $('#user-signin-form');
                      $('#sign-in-button').html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
                      $timeout(function(){
                         // $('#sign-up-button').html('Sign Up »');
                         form.submit();
                      }, 2000);
                  }
              }).
              then(function(err){
                  if(typeof err != 'undefined'){
                      console.log(JSON.stringify(err));
                  }
              });
    }
 }]);

/**
 * Reset Password Controller
 * 
 */
app.controller('ResetPasswordCtrl', ['$scope', 'defaultService', '$timeout', function($scope, defaultService, $timeout){
        $scope.resetPassword = function(){
           //check if this account is valid
           var urlPath = '/' + urlPrefix + 'merchants/check-email';
           var params = { email: $scope.merchant.email };
           defaultService.allPostRequests(urlPath, params).
           then(function(resp){
              if(!resp.status){
                 swal('Error', 'This account doesn\'t exist!', 'error');
                 return;
              }
              else{
                $('#sign-in-button').html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
                $timeout(function(){
                   var form = $('#merchants-password-reset-form');
                   form.submit();
                }, 2000);
              }
           }).
           then(function(err){
               if(typeof err != 'undefined'){
                    console.log(angular.toJson(err));
                }
           });
        };

        $scope.verifyRecoveryCode = function(){
             //check if this account is valid
             var urlPath = '/' + urlPrefix + 'customers/verify-recovery-code';
             var params = { code: $scope.customer.recovery_code };
             defaultService.allPostRequests(urlPath, params).
             then(function(resp){
                if(!resp.status){
                   swal('Error', 'Invalid recovery code, please try again.', 'error');
                   return;
                }
                else{
                  $('#sign-in-button').html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
                  $timeout(function(){
                     var form = $('#customers-password-reset-form');
                     form.submit();
                  }, 2000);
                }
             }).
             then(function(err){
                 if(typeof err != 'undefined'){
                      console.log(angular.toJson(err));
                  }
             });
        };

        $scope.resetCustomerPassword = function(){
           //check if this account is valid
           var urlPath = '/' + urlPrefix + 'customers/check';
           var params = { tel: $scope.customer.phone_number };
           defaultService.allPostRequests(urlPath, params).
           then(function(resp){
              if(!resp.status){
                 swal('Error', 'This account doesn\'t exist!', 'error');
                 return;
              }
              else{
                $('#sign-in-button').html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
                $timeout(function(){
                   var form = $('#customers-password-reset-form');
                   form.submit();
                }, 2000);
              }
           }).
           then(function(err){
               if(typeof err != 'undefined'){
                    console.log(angular.toJson(err));
                }
           });
        };

        $scope.changePassword = function(){
           //check if the password matches
           // alert($scope.merchant.password + ' = ' + $scope.merchant.password_confirmation);
           if($scope.merchant.password == $scope.merchant.password_confirmation){
              $('#sign-in-button').html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
              $timeout(function(){
                 var form = $('#merchants-change-password-form');
                 form.submit();
              }, 2000);
              return;
           }
           else{
               swal('Password Error', 'The passwords doesn\'t match', 'error');
               return;
           }
        };
}]);

/**
 * Merchants Controller 
 * 
 */
app.controller('MerchantCtrl', ['$scope', '$rootScope', 'defaultService', '$timeout', '$localStorage', '$window', function($scope, $rootScope, defaultService, $timeout, $localStorage, $window){
     $scope.activeCustomerProfile = null;
     $scope.localGovts = [];
     $scope.errors = [];
     $scope.accountTypes = ['Current', 'Savings'];
     $scope.typeOfPremises = ['Freehold', 'Rented'];
     $scope.answered = false;
     $scope.answers = [];
     $scope.correctAnswers = ['CPU', 'Central Processing Unit'];
     $scope.answersCounter = 0;

     var merchantSelectedCategories = [];
     var current_url = $window.location.href.split('/');
     var current_url_path = current_url[current_url.length - 1];

     $scope.submitQuestions = function(){
        if(typeof $scope.questionOne == 'undefined' || $scope.questionOne == ''){
            swal('Questions One', 'Please select the answer to question one', 'error');
            return;
        }
        if(typeof $scope.questionTwo == 'undefined' || $scope.questionTwo == ''){
            swal('Questions Two', 'Please select the answer to question two', 'error');
            return;
        }
        else{
          $scope.answered = true;
          $scope.answers.push($scope.questionOne);
          $scope.answers.push($scope.questionTwo);
          $scope.answersCounter = questionsAnsweredCorrectly();
          // alert(angular.toJson($scope.answers));
        }
     }

     var questionsAnsweredCorrectly = function(){
         var counter = 0;
        angular.forEach($scope.answers, function(obj){
            console.log(obj);
            if($scope.correctAnswers.indexOf(obj) >= 0){
                counter++;
            }
        });
        return counter;
     }

     $scope.openLink = function(url){
        $window.location.href = url;
     }

     $scope.searchParams = function(type){
           if(type == 'orders'){
              var url = $window.location.href;
              $window.location.href = '/' + urlPrefix + 'merchants/orders' + '/' + $scope.searchCriteria;
              return;
           }
           if(type == 'transactions'){
              var url = $window.location.href;
              $window.location.href = '/' + urlPrefix + 'merchants/transactions' + '/' + $scope.searchCriteria.toLowerCase();
              return;
           }
     };

     //link to download report
    $scope.downloadReport = function(status, type){
       if(type == 'orders'){
          var url = $window.location.href;
          $window.location.href = '/' + urlPrefix + 'merchants/download-orders-report' + '/' + $scope.searchCriteria;
          return;
       }
       if(type == 'transactions'){
         var url = $window.location.href;
         $window.location.href = '/' + urlPrefix + 'merchants/download-transactions-report' + '/' + $scope.searchCriteria.toLowerCase();
         return;
       }
       else{
         return;
       }
    };

     var chartData = function(data){
         var displayData = [];
         angular.forEach(data, function(obj){
            var unitData = {};
            unitData.label = obj.created_at;
            unitData.y = obj.total_orders;
            displayData.push(unitData);
         });
         console.log(angular.toJson(displayData));
         return displayData;
     }

     if(current_url_path == "sales-report"){
        urlPath = '/' + urlPrefix + 'merchants/orders-statistics';
        defaultService.allGetRequests(urlPath)
        .then(function(resp){
           console.log(angular.toJson(resp));
           if(resp.processed){
              var chart = new CanvasJS.Chart("chartContainer",
              {
                title:{
                  text: "Orders Report"             
                }, 
                animationEnabled: true,     
                axisY:{
                  titleFontFamily: "arial",
                  titleFontSize: 12,
                  includeZero: false
                },
                toolTip: {
                  shared: true
                },
                data: [
                {        
                  type: "spline",  
                  name: "Pending Orders",        
                  showInLegend: true,
                  dataPoints: chartData(resp.pending_orders)
                }, 
                {        
                  type: "spline",  
                  name: "Delined Orders",        
                  showInLegend: true,
                  dataPoints: chartData(resp.declined_orders)
                },
                {        
                  type: "spline",  
                  name: "Cancelled Orders",        
                  showInLegend: true,
                  dataPoints: chartData(resp.cancelled_orders)
                },
                {        
                  type: "spline",  
                  name: "fulfilled Orders",        
                  showInLegend: true,
                  dataPoints: chartData(resp.fulfilled_orders)
                }     
                ],
                legend:{
                  cursor:"pointer",
                  itemclick:function(e){
                    if(typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                      e.dataSeries.visible = false;
                    }
                    else {
                      e.dataSeries.visible = true;            
                    }
                    chart.render();
                  }
                }
              });

              chart.render();
           }
        })
        .then(function(error){
           if(typeof error != 'undefined'){
                console.log('An error ocuured: ' + JSON.stringify(error));
            }
        });
     }

     //get customer profile
     $scope.getCustomerProfile = function(customerId){
         $scope.activeCustomerProfile = [];
         urlPath = '/' + urlPrefix + 'customers/profile';
         params = { customer_id : customerId };
         defaultService.allPostRequests(urlPath, params)
         .then(function(resp){
             // console.log(JSON.stringify(resp));
             if(resp.profile){
                // console.log(resp.profile);
                // console.log(resp.profile.file_path);
                $scope.activeCustomerProfile = resp.profile;
                console.log(angular.toJson($scope.activeCustomerProfile));
                $("#customerProfileModal").modal('show');
             }
             else{
                swal("Profile Error", resp.feedback, "error");
             }
         })
         .then(function(error){
            if(typeof error != 'undefined'){
                console.log('An error ocuured: ' + JSON.stringify(error));
            }
         });
     };
     
     //update the active local government
     $scope.updateLocalGovt = function(){
       // alert('hello');
       $scope.localGovts = [];
       urlPath = '/' + urlPrefix + 'customers/update-local-govts';
       params = { state_id : $scope.merchant.form.state_of_business_id.$viewValue };
       defaultService.allPostRequests(urlPath, params)
       .then(function(resp){
           if(resp.length > 0){
              angular.forEach(resp, function(obj){
                  $scope.localGovts.push(obj);
              });
           }
           else{
              swal("Local Governments", "Unable to get the list of local governments for the selected state, please try again", "error");
           }
       })
       .then(function(error){
          if(typeof error != 'undefined'){
              console.log('An error ocuured: ' + JSON.stringify(error));
          }
       });
    };

    //form parameters 
    var profileFormParameters = function(formName){
        switch(formName){
            case 'business_details':
               var params = { business_name : $scope.merchant.business_name,
                              business_address : $scope.merchant.business_address,
                              business_type : $scope.merchant.business_type,
                              email : $scope.merchant.email,
                              state_of_business_id : $scope.merchant.state_of_business_id,
                              local_govt_id : $scope.merchant.local_govt_id,
                              business_categories : $scope.merchant.business_categories,
                              telephone : $scope.merchant.telephone };
               
            break;

            case 'password':
                var params = {
                                current_password : $scope.merchant.current_password,
                                password : $scope.merchant.new_password,
                                password_confirmation : $scope.merchant.password_confirmation
                             };
            break;

            case 'bank_details':
               var params = { bank_name : $scope.merchant.bank_name,
                              account_type : $scope.merchant.account_type,
                              account_number: $scope.merchant.account_number };
            break;

            case 'contact_details':
              var params = { full_name : $scope.merchant.full_name,
                             address : $scope.merchant.address };
            break;

            case 'pos_details':
              var params = { premises_type : $scope.merchant.premises_type,
                             number_of_chain_stores : $scope.merchant.number_of_chain_stores};
                  params.rent_duration = typeof $scope.merchant.rent_duration != 'undefined' && $scope.merchant.rent_duration != '' ? $scope.merchant.rent_duration : '';
            break;
        }

        //return params
        return params;
    };

    var profileFormUrl = function(formName){
        switch(formName){
            case 'business_details':
               return '/' + urlPrefix + 'merchants/update-business-details';
            break;
            case 'password':
               return '/' + urlPrefix + 'merchants/update-password';
            break;
            case 'bank_details':
               return '/' + urlPrefix + 'merchants/update-bank-details';
            break;

            case 'contact_details':
               return '/' + urlPrefix + 'merchants/update-contact-details';
            break;

            case 'pos_details':
               return '/' + urlPrefix + 'merchants/update-pos-details';
            break;
        }
    }

    $scope.saveChanges = function(event, formName, formId, defaultBtnValue){
        $scope.merchant.activeForm = formName;
        $scope.errors = [];
        event.preventDefault();
        swal({   title: "Are you sure?",   
                         text: "You're about to edit your " + formName.replace('_', ' ') + ". Do you want to proceed?",   
                         type: "warning",   
                         showCancelButton: true,   
                         confirmButtonColor: "#DD6B55",   
                         confirmButtonText: "Yes, proceed!",   
                         closeOnConfirm: true }, 
                         function(){ 
                                $('#' + formId + '-btn').html('<i class="fa fa-spinner fa-spin"></i> Updating...');
                                var url = profileFormUrl(formName);
                                var params = profileFormParameters(formName);
                                // alert(angular.toJson(params));

                                $timeout(function(){
                                    defaultService.allPutRequests(url, params). //save business details
                                    then(function(resp){
                                       // alert(angular.toJson(resp));
                                       // console.log(angular.toJson(resp));
                                       $('#' + formId + '-btn').html('<i class="fa fa-save"></i> ' +  defaultBtnValue);

                                       if(formName == 'password'){
                                           $scope.merchant.current_password = '';
                                           $scope.merchant.new_password = '';
                                           $scope.merchant.password_confirmation = '';
                                       }
                                       
                                       if(resp.processed){
                                          swal('Successful', resp.feedback, 'success');
                                          return;
                                       }
                                       else{
                                          if(resp.errors){
                                              var errors = JSON.parse(resp.errors);
                                              angular.forEach(errors, function(obj){
                                                 // console.log(angular.toJson(obj));
                                                 for(var index in obj){
                                                    if($scope.errors.indexOf(obj[index]) < 0){
                                                       $scope.errors.push(obj[index]);
                                                    }
                                                 }
                                              });

                                              //scroll to the top of the form 
                                              var offSet = $('form#' + formId).offset().top - 80;
                                              $('body, html').animate({scrollTop:offSet}, 'slow');
                                              return;
                                          }
                                          else{
                                            swal('Error', resp.feedback, 'error');
                                            return;
                                          }
                                       }
                                    }).
                                    then(function(error){
                                        if(typeof error != 'undefined'){
                                            console.log('An error ocuured: ' + JSON.stringify(error));
                                        }
                                     });
                                }, 2000);
                        });
    };


    $scope.initUpdateLocalGovt = function(stateId){
       // alert('hello');
       $scope.localGovts = [];
       urlPath = '/' + urlPrefix + 'customers/update-local-govts';
       params = { state_id : stateId };
       defaultService.allPostRequests(urlPath, params)
       .then(function(resp){
           if(resp.length > 0){
              angular.forEach(resp, function(obj){
                  $scope.localGovts.push(obj);
              });
              // $scope.$apply();
              // alert($scope.merchant.local_govt_id);
           }
           else{
              swal("Local Governments", "Unable to get the list of local governments for the selected state, please try again", "error");
           }
       })
       .then(function(error){
          if(typeof error != 'undefined'){
              console.log('An error ocuured: ' + JSON.stringify(error));
          }
       });
    };

    $scope.updateBusinessCategories = function(selectedCategories){
        var categoriesObj = JSON.parse(selectedCategories);
        // console.log(categoriesObj);
        for(var obj in categoriesObj){
            if(categoriesObj[obj].status){
                merchantSelectedCategories.push(categoriesObj[obj].product_category_id.toString());
                $scope.merchant.business_categories.push(categoriesObj[obj].product_category_id.toString());
            }
        }
    };

     //Process an order
     $scope.processOrder = function(orderId, orderCode){
         // alert(orderCode);
         swal({   title: "Are you sure?",   
                         text: "You're about to process order " + orderCode + ". Do you want to proceed?",   
                         type: "warning",   
                         showCancelButton: true,   
                         confirmButtonColor: "#DD6B55",   
                         confirmButtonText: "Yes, proceed!",   
                         closeOnConfirm: true }, 
                         function(){   
                               $('#order-processing-' + orderId).html('<i class="zmdi zmdi-spinner zmdi-hc-lg zmdi-hc-spin"></i> Processing');
                               urlPath = '/' + urlPrefix + 'merchants/process-order';
                               params = { order_id : orderId };
                               defaultService.allPostRequests(urlPath, params)
                               .then(function(resp){
                                   // alert(angular.toJson(resp));
                                   if(resp.processed){
                                      $scope.order.token = '';
                                      $localStorage.active_order_id = orderId;
                                      $rootScope.orderCode = orderCode;
                                      $("#orerTokenModal").modal('show');
                                      $('#order-processing-' + orderId).html('<i class="zmdi zmdi-check-circle zmdi-hc-lg"></i> Process Order');
                                   }
                                   else{
                                      swal("Token Error", resp.feedback, "error");
                                      $('#order-processing-' + orderId).html('<i class="zmdi zmdi-check-circle zmdi-hc-lg"></i> Process Order');
                                   }
                               })
                               .then(function(error){
                                  if(typeof error != 'undefined'){
                                      console.log('An error ocuured: ' + JSON.stringify(error));
                                  }
                               });
                        });
     };

     //complete the processing of order
     $scope.completeOrderProcess = function(event){
         event.preventDefault();

         //check if there is an active order id
         if($localStorage.hasOwnProperty('active_order_id')){
             $('#process-order').html('<i class="zmdi zmdi-spinner zmdi-hc-lg zmdi-hc-spin"></i> Processing');
             $timeout(function(){
                 //process order
                 var orderId = $localStorage.active_order_id;
                 urlPath = '/' + urlPrefix + 'merchants/complete-process-order';
                 params = { order_id : orderId,
                            token    : $scope.order.token };
                 defaultService.allPostRequests(urlPath, params)
                 .then(function(resp){
                     // alert(angular.toJson(resp));
                     if(resp.processed){
                        //set status to fulfilled
                        $('#order-status-' + orderId).html('Fulfilled');

                        //hide process order and decline order buttons
                        $('#order-processing-' + orderId).hide();
                        $('#decline-order-' + orderId).hide();
                        $('#process-order').html('<i class="zmdi zmdi-check-circle zmdi-hc-lg"></i> Process Order');

                        //close the modal
                        $("#orerTokenModal").modal('hide');

                        //show successful message for the processing
                        swal('Order Fulfilled', resp.feedback, 'success');
                        
                        //delete the data in the local storage
                        $localStorage.$reset();
                        
                     }
                     else{
                        swal("Token Error", resp.feedback, "error");
                        $('#process-order').html('<i class="zmdi zmdi-check-circle zmdi-hc-lg"></i> Process Order');
                     }
                 })
                 .then(function(error){
                    if(typeof error != 'undefined'){
                        console.log('An error ocuured: ' + JSON.stringify(error));
                    }
                 });
             }, 2000);
         }
         else{
            swal('Processing Error', 'There is a problem with this order, please close this popup and try again.', 'error');
         }
     };

     //cancel an order
     $scope.declineOrder = function(orderId, orderCode){
          swal({   title: "Are you sure?",   
                         text: "You're about to decline order " + orderCode + ". Do you want to proceed?",   
                         type: "warning",   
                         showCancelButton: true,   
                         confirmButtonColor: "#DD6B55",   
                         confirmButtonText: "Yes, decline!",   
                         closeOnConfirm: true }, 
                         function(){   
                               $('#decline-order-' + orderId).html('<i class="zmdi zmdi-spinner zmdi-hc-lg zmdi-hc-spin"></i> Processing');
                               urlPath = '/' + urlPrefix + 'merchants/decline-order';
                               params = { order_id : orderId };
                               defaultService.allPostRequests(urlPath, params)
                               .then(function(resp){
                                   // alert(angular.toJson(resp));
                                   if(resp.processed){
                                      swal('Order Declined Successfully', resp.feedback, 'success');

                                      //set status to declined
                                      $('#order-status-' + orderId).addClass('text-danger').html('Declined');

                                        //hide process order and decline order buttons
                                        $('#order-processing-' + orderId).hide();
                                        $('#decline-order-' + orderId).hide();
                                   }
                                   else{
                                      swal("Decline Error", resp.feedback, "error");
                                      $('#decline-order-' + orderId).html('<i class="zmdi zmdi-close-circle-o zmdi-hc-lg"></i> Decline Order');
                                   }
                               })
                               .then(function(error){
                                  if(typeof error != 'undefined'){
                                      console.log('An error ocuured: ' + JSON.stringify(error));
                                  }
                               });
                        });
     }
}]);

/**
 * Merchants Sign in Controller
 */
app.controller('MerchantSigninCtrl', ['$scope', 'defaultService', '$timeout', function($scope, defaultService, $timeout){
    $scope.submit = function(){
      //check if the form is valid
      if($scope.merchants.signin.form.$invalid){
          swal('Error', 'Please fill all the required fields', 'error');
          return;
      }
      else{
         //check if this account is valid
         var urlPath = '/' + urlPrefix + 'merchants/check-email';
         var params = { email: $scope.merchants.email };
         defaultService.allPostRequests(urlPath, params).
         then(function(resp){
            if(!resp.status){
               swal('Error', 'Invalid account, please try again.', 'error');
               return;
            }
            else{
              $('#sign-in-button').html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
              $timeout(function(){
                 var form = $('#merchants-signin-form');
                 form.submit();
              }, 2000);
            }
         }).
         then(function(err){

         });
      }
    }
}]);

/**
 * Merchants Bank Details
 * 
 */
app.controller('MerchantBankDetailsCtrl', ['$scope', '$timeout', function($scope, $timeout){
    $scope.accountTypes = ['Current', 'Savings'];
    $scope.submit = function(){
       if($scope.merchants.signup.form.$invalid){
           swal('Error', 'Please fill all the required fields', 'error');
           return;
       }
       else{
          var form = $('#merchant-signup-form');
          $('#sign-up-button').html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
          $timeout(function(){
             // $('#sign-up-button').html('Sign Up »');
             form.submit();
          }, 2000);
       }
    };
}]);

/**
 * Merchants Contact Person
 *
 */
app.controller('MerchantContactPersonCtrl', ['$scope', '$timeout', function($scope, $timeout){
    $scope.submit = function(){
       if($scope.merchants.signup.form.$invalid){
           swal('Error', 'Please fill all the required fields', 'error');
           return;
       }
       else{
          var form = $('#merchant-signup-form');
          $('#sign-up-button').html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
          $timeout(function(){
             // $('#sign-up-button').html('Sign Up »');
             form.submit();
          }, 2000);
       }
    };
}]);

/** 
 * Merchant POS Details
 *
 */
app.controller('MerchantPosCtrl', ['$scope', '$timeout', function($scope, $timeout){
    $scope.typeOfPremises = ['Freehold', 'Rented'];
    $scope.submit = function(){
       if($scope.merchants.signup.form.$invalid){
           swal('Error', 'Please fill all the required fields', 'error');
           return;
       }
       else{
          var form = $('#merchant-signup-form');
          $('#sign-up-button').html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
          $timeout(function(){
             // $('#sign-up-button').html('Sign Up »');
             form.submit();
          }, 2000);
       }
    };
}]);



 /**
  * Activation Controller
  *
  */
app.controller('AcctActivateCtrl', ['$scope', 'defaultService', function($scope, defaultService){
    // $scope.resendSmsCode = "pole e e";
}]);

/**
  * Signin Controller
  *
  */
app.controller('SigninCtrl', ['$scope', 'defaultService', function($scope, defaultService){
     $scope.errors = [];
     $scope.submit = function(){
          if($scope.signin.form.$invalid){
              swal("Error", "Please fill the form/correct the outlined errors in the form", "error");
              return;
          }
          else{
               $("#signin-btn").html("<i class='fa fa-spinner fa-spin' style='font-size:24px'></i> Please wait...");
               //validate customers
               defaultService.validateCustomerTelephoneNumber($scope.signin.form.phone_number.$viewValue).then(function(resp){
                   if(resp.status){
                      //sign customer in
                      var form = $("#signin-form");
                      form.submit();
                   }
                   else{
                      $("#signin-btn").html("Sign me in!");
                      swal("Error", "This account doesn't exist, please try again!", "error");
                      return;
                   }
               })
               .then(function(err){
                  console.log('An error occured: ' + JSON.stringify(err));
               });
          }
     };
}]);

 /** 
  * Default Service Library
  */
 app.factory('defaultService', ['$http', '$q', function($http,$q){
 	return {
        validateCustomerTelephoneNumber : function(telephoneNum){ //validate telephone number
        	var defer = $q.defer();
        	var promise = defer.promise;
        	var params = { tel: telephoneNum };
           $http.post('/' + urlPrefix + 'customers/check', { params: params })
           .success(function(response){
               defer.resolve(response);
           })
           .error(function(error){
           	   console.log("An error occured: " + JSON.stringify(error));
           	   defer.resolve(error);
           });

           //return promise object
           return promise;
       },
       resendSms : function(){//resend verification code to users 
           var defer = $q.defer();
          var promise = defer.promise;
           $http.get('/'  + urlPrefix +  'customers/resend-sms')
           .success(function(response){
               defer.resolve(response);
           })
           .error(function(error){
               defer.resolve(error);
           });

           //return promise object
           return promise;
       },
       allPostRequests : function(postUrl, params){ //Post Requests to the server
             var defer = $q.defer();
             var promise = defer.promise;
             $http.post(postUrl, { params: params })
             .success(function(response){
                 defer.resolve(response);
             })
             .error(function(error){
                 console.log("An error occured: " + JSON.stringify(error));
                 defer.resolve(error);
             });

             //return promise object
             return promise;
       },
       allGetRequests : function(url){ //Get Requests to the server
             var defer = $q.defer();
             var promise = defer.promise;
             $http.get(url)
             .success(function(response){
                 defer.resolve(response);
             })
             .error(function(error){
                 console.log("An error occured: " + JSON.stringify(error));
                 defer.resolve(error);
             });

             //return promise object
             return promise;
       },
       allPutRequests : function(putUrl, params){ //PUT Requests to the server
             var defer = $q.defer();
             var promise = defer.promise;
             $http.put(putUrl, { params: params })
             .success(function(response){
                 defer.resolve(response);
             })
             .error(function(error){
                 console.log("An error occured: " + JSON.stringify(error));
                 defer.resolve(error);
             });

             //return promise object
             return promise;
       },
 	};
 }]);

/**
 *  Update Price Preview
 */
app.directive('updatePricePreview', function(){
   return {
      scope: {
         quantity : '=quantityAttr',
         amountPreview: '=previewAttr'
      },
      link: function(scope, elem, attr){
          elem.on('keyup', function(){
             console.log(elem.val());
             var amount = parseInt(elem.val());
             var quantity = parseInt(scope.quantity);
             var totalAmount = amount * quantity;
             scope.amountPreview = totalAmount;
             //update model across board
             scope.$apply(function(){
                 scope.amountPreview;
             })
          })
      }
   };
});

app.directive('updateQuantity', function(){
   return {
      scope: {
         amount : '=amountAttr',
         amountPreview: '=previewAttr'
      },
      link: function(scope, elem, attr){
          elem.on('change', function(){
             var amount = parseInt(scope.amount);
             var quantity = parseInt(elem.val());
             var totalAmount = amount * quantity;
             scope.amountPreview = totalAmount;
             //update model across board
             scope.$apply(function(){
                 scope.amountPreview;
             })
          })
      }
   };
});

 /**
  * Valid Password Directive
  */
  app.directive('validPasswordConfirmation', function () {
    return {
        require: 'ngModel',
        link: function (scope, elm, attrs, ctrl) {
            ctrl.$parsers.unshift(function (viewValue, $scope) {
                var noMatch = viewValue != scope.regForm.password.$viewValue;
                ctrl.$setValidity('noMatch', !noMatch);
            });
        }
    }
});

/**
 * Check customer telephone number validity
 */
app.directive('phoneCheck', ['defaultService', function(defaultService){
    return {
    	require: 'ngModel',
    	link: function(scope, elem, attrs, ctrl){
           elem.on('blur', function(e){
              scope.$apply(function(){
              	    defaultService.validateCustomerTelephoneNumber(elem.val())
			    	.then(function(response){
			    		ctrl.$setValidity('unique', response.status);
			    		alert(JSON.stringify(response));
			    	})
			    	.then(function(error){
			    		console.log(error);
			    	});
              });
           });
    	}
    }
}]);

/**
 * Update shopping cart 
 */
app.directive('updateShoppingCart', function(defaultService, $filter){
   return {
      scope: {
         subTotal : '=totalPricePreviewAttr'
      },
      link: function(scope, elem, attr){
         elem.on('change', function(){
            var merchantId = attr.merchantIdAttr;
            var itemDesc = attr.itemDescAttr;
            var quantity = parseFloat(elem.val());
            var amount = parseFloat(attr.itemAmount);
            var total = quantity * amount;
            var itemSubTotal = $filter("currency")(total, "&#8358;");
            
            //update cart details
            var urlPath = '/' + urlPrefix + 'customers/update-cart-items';
            var params = { merchant_id : merchantId,
                           item_desc : itemDesc,
                           quantity : elem.val() }
            defaultService.allPostRequests(urlPath, params).
            then(function(resp){
              console.log(JSON.stringify(resp.debug));
               if(resp.status){
                   $("#" + attr.subTotalId).html(itemSubTotal);
                   var total_amount = $filter("currency")(resp.total, "&#8358;");
                   $("#items-total-amt").html(total_amount);
               }
               else{
                  swal('Update Error', resp.feedback, 'error');
               }
            }).
            then(function(err){
                if(typeof err != 'undefined'){
                   console.log(JSON.stringify(err))
                }
            });            
            
         });
      }
   }
});

/**
 * Delete Cart Item
 * 
 */
app.directive('deleteCartItem', function(defaultService){
    return {
        link: function(scope, elem, attr){
            elem.on('click', function(){
                var merchantId = attr.merchantIdAttr;
                var itemDesc = attr.itemDescAttr;

                swal({   title: "Are you sure?",   
                         text: "You're about to delete this item from cart. Do you want to proceed?",   
                         type: "warning",   
                         showCancelButton: true,   
                         confirmButtonColor: "#DD6B55",   
                         confirmButtonText: "Yes, delete it!",   
                         closeOnConfirm: true }, 
                         function(){   
                              // delete item from cart
                              var urlPath = '/' + urlPrefix + 'customers/update-cart-items';
                              var params = { merchant_id : merchantId,
                                             item_desc : itemDesc,
                                             quantity : elem.val() }
                              defaultService.allPostRequests(urlPath, params).
                              then(function(resp){
                                 if(resp.status){
                                     var total_amount = $filter("currency")(resp.total, "&#8358;");
                                     $("#items-total-amt").html(total_amount);
                                 }
                              }).
                              then(function(err){
                                  if(typeof err != 'undefined'){
                                     console.log(JSON.stringify(err))
                                  }
                              });
                        });
            });
        }
    }
});

/** 
 * Automatically Set all parameters
 *
 */
app.directive('makeDirty', function(){
    return function(scope, elem, attr) {
        angular.forEach(scope.regForm, function(val, key){
            // if(!key.match(/\$/)) {
            //     if(key == 'expiration_date' || key == 'date_of_birth' || key == 'issue_date'){
            //         val.$touched = true;
            //         val.$pristine = false;
            //         val.$dirty = true;
            //     }
            // }
            
            val.$touched = true;
            val.$pristine = false;
            val.$dirty = true;
        });
    };
});

/**
 * Resend verification SMS to the customer
 *
 */
app.directive('resendSms', ['defaultService', function(defaultService){
    return {
        link: function(scope, elem, attr){
            elem.on('click', function(e){
                //send SMS
                elem.html(' <i class="fa fa-spinner fa-spin" style="font-size:24px"></i> Resending...');
                defaultService.resendSms()
                .then(function(response){
                   if(response.status){
                      swal("SMS Sent!", response.feedback, "success");
                   }
                   else{
                      swal("Error", response.feedback, "error");
                   }
                   elem.html('Resend');
                })
                .then(function(error){
                    console.log(JSON.stringify(error));
                });
            });
        }
    };
}]);
}());