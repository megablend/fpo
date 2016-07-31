var truppr = angular.module('truppr', []);

truppr.controller('TrainerSearchCtrl', ['$scope', '$http', function(scope, http) {
  // stores messaging data.
  scope.messaging = {};

  scope.composeMessage = function($event) {
    $event.preventDefault();

    if (angular.element($event.target).data('signed-in')) {
      // get the user's id.
      scope.messaging.userId = angular.element($event.target).data('user-id');
      // get the user's full name.
      scope.messaging.fullName = angular.element($event.target).data('full-name');

      $('#compose-msg-screen').modal();
    } else location.href = '/login';
  };

  // sends the composed message.
  scope.send = function() {
    // retrieve the message.
    var message = angular.element('#compose-msg-screen #message').val();

    // compose the recipient info.
    var postData = {};
    postData['to[0]'] = scope.messaging.userId;
    postData['content'] = message;

    // make a request, sending the message.
    http.post('/messages/send', postData).success(function(data) {
      if (data.error) {
        angular.element('#compose-msg-screen .error-box').
              removeClass('hidden').html(data.message).fadeIn();
      } else {
        // hide the modal dialog.
        var composeBox = angular.element('#compose-msg-screen').modal('hide');
        // clear all input fields.
        composeBox.find('#message').val('');
        composeBox.find('.error-box').addClass('hidden').html('').fadeOut();

        // show a success message.
        $('#success-msg-screen').modal();
      }
    });
  };
}]);
