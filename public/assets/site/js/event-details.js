var app = angular.module('truppr-event', ['SimplePagination']);
app.controller('PaidEventController', ['$scope', '$http', function($scope, $http) {

  // contact Stripe only if the event is not free.
  if (!evt.free && !evt.pay_cash) {
    $http.get(jsRoutes.controllers.API.options().url)
      .success(function(data) {
        $scope.Options = data;
        $scope.loadStripeHandler();
      });
  }

  // retrieve an event's details from the server.
  $http.get(jsRoutes.controllers.API.event(evt.id).url)
    .success(function(data) {
      $scope.event = data;
    });

  $scope.loadStripeHandler = function() {
    // make sure Stripe Checkout have been loaded.
    if (StripeCheckout) {
      // define the Stripe.js handler.
      $scope.handler = StripeCheckout.configure({
        key: $scope.Options.STRIPE_PUBLIC_KEY,
        token: function(token, args) {
          var chargeCardUrl = jsRoutes.controllers.Events.chargeCard().url;
          // Use the token to create the charge.
          $http.post(chargeCardUrl, {'token': token.id,
            team_id: $scope.teamId, event_id: $scope.event.id})
            .success(function(data) {
              if (data.success) {
                alert(data.message)
                // redirect to the event details page.
                location.href = jsRoutes.controllers.Events.details2(
                  $scope.event.id, $scope.event.slug).url;
              }
            });
        }
      });
    }
  };

  $scope.payForEvent = function(teamId) {
    if (evt.member) {
      alert("You are already a member in this event.");
      return;
    }
    $scope.teamId = teamId;

    if (evt.free || evt.cash) {
      var joinEventUrl = jsRoutes.controllers.Events.join($scope.teamId, $scope.event.id).url;
      // Use the token to create the charge.
      $http.post(joinEventUrl, {team_id: $scope.teamId, event_id: $scope.event.id})
        .success(function(data) {
          if (data.success) {
            alert(data.message)
            // redirect to the event details page.
            location.href = jsRoutes.controllers.Events.details2(
              $scope.event.id, $scope.event.slug).url;
          }
        });
    } else {
//      if ($scope.event.fee_currency === "NGN") {
//        // compute the total amount in the specified currency.
//        var convertCurrencyUrl = jsRoutes.controllers.API.
//          convertCurrency("NGN", "USD", $scope.event.fee_amount).url;
//
//        $http.get(convertCurrencyUrl)
//          .success(function(data) {
//            if (data.success) {
//              // show the UI to allow users make payment.
//              $scope.checkout(data);
//            }
//          }).error(function() {
//            alert('An error occurred. Please check your internet connection.');
//          });
//      } else {
//        // show the UI to allow users make payment.
//        $scope.checkout($scope.event.fee_amount);
//      }
    	$scope.checkout($scope.event.fee_amount)
    }
  };

  $scope.checkout = function(data) {
    // Open Checkout with further options
    $scope.handler.open({
      name: 'truppr',
      description: 'Payment for ' + $scope.event.name,
      image: '/assets/img/logo_small_b.png',
      currency: $scope.feeCurrency(),
      amount: function() {
        if (typeof(data) === 'object') {
          return data.result.amount * 100;
        } else return data * 100;
      }()
    });
  };

  $scope.feeCurrency = function() {
//    if ($scope.event.fee_currency === 'NGN') return 'USD';
//    else return $scope.event.fee_currency;
	return $scope.event.fee_currency;
  };
}]);

app.controller('PhotosController', ['$scope', '$http', 'Pagination', function($scope, $http, Pagination) {
  // get a new instance of the Pagination factory.
  $scope.pagination = Pagination.getNew(8);

  // initialize the list of photos.
  $scope.photos = [];
  $scope.selectedPhoto = {};

  $scope.thumbnailUrl = function (photo) {
    if (photo.cloud_based === true) {
      var path = photo.path.substring(0, photo.path.lastIndexOf('/'));
      // return the thumbnail version of the path.
      return path + "/thumb-" + photo.file_name;
    } else {
      return jsRoutes.controllers.Events.thumbnailUrl(photo.file_name).url;
    }
  };

  $scope.photoUrl = function (photo) {
    if (photo.cloud_based === true) {
      return photo.path;
    } else {
      return jsRoutes.controllers.Events.photoUrl(photo.file_name).url;
    }
  };

  $scope.slideshow = function() {
    $('.gallery').magnificPopup({
      delegate: 'a.gallery_thumb',
      type: 'image',
      gallery: {enabled: true}
    });
  };

  $scope.hasPhotos = function() {
    return $scope.photos.length !== 0;
  };

  $scope.deletePhoto = function(photo) {
    if (confirm('Sure you want to delete this photo?')) {
      // send a network request to delete the photo.
      $http.delete(jsRoutes.controllers.Events.deletePhoto(photo.id, evt.id).url).
        success(function(data) {
          if (data.success) {
            // remove the photo from the UI.
            $scope.photos = $scope.photos.filter(function(_photo) {
              return photo.id !== _photo.id;
            });
          } else {
            alert(data.message);
          }
        });
    }
  };

  $http.get(jsRoutes.controllers.API.photos(evt.id).url).
    success(function(data) {
      if (data.error) {
        alert(data.message);
      } else {
        // update the scope's photos.
        $scope.photos = data;

        // calculate the total number of pages available.
        $scope.pagination.numPages = Math.ceil(data.length / $scope.pagination.perPage);
      }
    });
}]);

$(function() {
  // activate the hidden "instruction" tab.
  $('a[href=#instruction]').tab('show');
  // activate the text box as a token field.
  $('textarea[name=emails]').tokenField({
    max: evt.max
  });

  $("textarea[name=truppr_ids]").tokenInput("/messages/users/search", {
    theme: 'facebook',
    preventDuplicates: true,
    propertyToSearch: 'full_name',
    hintText: 'Type in a user\'s name'
  });

  $('a.remove').on('click', function(e) {
    e.preventDefault();
    var route = jsRoutes.controllers.Application.convenerRemovePlayer();

    if (confirm('Are you sure you want to remove this player?')) {
      $.ajax({
        url: route.url,
        type: route.method,
        dataType: 'json',
        data: {
          player_id: $(this).data('player-id'),
          event_id: evt.id
        },
        success: function(data) {
          if (data.success) {
            // refresh the current page.
            window.location.reload();
          } else if (data.error) {
            // show the error message.
            alert(data.message);
          }
        }
      });
    }
  });

  $('a.remove-me').on('click', function(e) {
    e.preventDefault();
    var route = jsRoutes.controllers.Application.playerRemoveSelf();

    if (confirm('This operation is not reversible.\n' +
      'If this is a paid event, you may not be refunded.\n\n' +
      'Are you sure you want to remove yourself from this event?')) {
      $.ajax({
        url: route.url,
        type: route.method,
        dataType: 'json',
        data: {
          event_id: evt.id
        },
        success: function(data) {
          if (data.success) {
            // reload the current page.
            window.location.reload();
          } else if (data.error) {
            // show the error message.
            alert(data.message);
          }
        }
      });
    }
  });

  $('a.delete-link').on('click', function(e) {
    e.preventDefault();
    var route = jsRoutes.controllers.Events.delete(evt.id);

    if (confirm('Are you sure you want to delete this event?')) {
      $.ajax({
        url: route.url,
        type: route.method,
        dataType: 'json',
        success: function(data) {
          if (data.success) {
            // redirect to the specified url.
            window.location.href = data.redirect_url;
          } else if (data.error) {
            // show the error message.
            alert(data.message);
          }
        }
      });
    }
  });

  $('a.invite').on('click', function(e) {
    e.preventDefault();
    $('#friend-invites').modal({
      keyboard: true
    });
  });

  $('button.invite-friends').on('click', function() {
    var mde = $('ul.invite-mode').find('li.active');

    if (mde.length === 1) {
      var mode = $(mde[0]).data('mode');
      var platform = $(mde[0]).data('platform');

      if (mode === 'EM') {
        platform = 'EM';
      }
      var route = jsRoutes.controllers.Events.invite();

      // composes data to be sent.
      var platformData = function() {
        if (mode === 'EM') {
          return $('input[name=emails]').val().split(',').filter(function(e) {return "" !== e});
        } else {
          if (platform === 'TR') {
            return $('#truppr_ids').val().split(',').filter(function(e) {return "" !== e});
          } else if (platform === 'FB') {
            return [];
          } else {
            return [];
          }
        }
      }

      if (platformData().length !== 0) {
        // invite the users in the field.
        $.ajax({
          url: route.url,
          type: route.method,
          dataType: 'json',
          data: {
            'event_id': evt.id,
            'data': platformData(),
            'category': mode,
            'platform': platform
          },
          success: function(data) {
            if (data.error) {
              // show the error message.
              alert(data.message);
            } else {
              if (mode === 'EM') {
                // clear the tokens.
                // there's no better way to do this now, so we'll just click each token's 'x' button.
                $('form[name=email-invites]').find('.token-x').each(function() {
                  $(this).click();
                });
              } else {
                if (platform === 'TR') {
                  $('form[name=truppr-invites]').find('#truppr_ids').tokenInput('clear');
                }
              }

              // show the success message.
              alert(data.message);
            }
          }
        });
      } else {
        alert('Please provide all required data.')
      }
    }
  });

  var route2 = jsRoutes.controllers.Application.eventRatings(evt.id);

  // fetch all the ratings for every player in this event.
  $.ajax({
    url: route2.url,
    type: route2.method,
    dataType: 'json',
    success: function(data) {
      if (data.success) {
        // retrieve the ratings and map them.
        $(data.ratings).each(function(index, info) {
          // retrieve the rating.
          var rating = info['rating'];
          // find the component holding the player's rating.
          var component = $('span.rating[data-player-id=' + info['ratee_id'] + ']');
          // update the component's rating value.
          component.data('rating', rating);

          // retrieve the stars and reverse their arrangement.
          var stars = component.children('span.star').get().reverse();

          for (var i = 0; i < rating; i++) {
            // make the star active.
            $(stars[i]).addClass('active');
          }
        });
      }
    }
  });
});