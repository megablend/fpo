function onSignInCallback(authResult) {
  if (authResult['access_token']) {
    // Successfully authorized.
    gapi.client.load('plus','v1', function(){
      // once we get this call back, gapi.client.plus.* will exist
      var request = gapi.client.plus.people.get({
        'userId': 'me'
      });
      request.execute(function(resp) {
        var data = {
          id: resp['id'],
          full_name: resp['displayName'],
          gender: resp['gender'],
          cover_url: resp['image']['url'],
          email: resp['emails'][0]['value'],
          gp_id: resp['id'],
          gp_token: 'N/A'
        };

        $.post('/login/gplus', data).success(function(data) {
          if (data.error) {
            // display the error message.
            cAlert(data.message)
          } else {
            // redirect to the location provided by the server.
            if (data.result && data.result.redirectUrl) {
              _data = data
              $('#success-screen').modal('show')
            }
          }
        }).error(function(d) {
          cAlert('Unknown error. Please check your internet connection.')
        })
      });
    });

    // console.log(authResult)
  } else if (authResult['error']) {
    // There was an error.
    // Possible error codes:
    //   "access_denied" - User denied access to your app
    //   "immediate_failed" - Could not automatially log in the user
    // console.log('There was an error: ' + authResult['error']);
  }
}

function cAlert(message) {
  $('.alert-message').text(message)
  $('#alert-screen').modal('show')
}

$(function() {
  $('.okay-button').on('click', function() {
    if (_data.result && _data.result.redirectUrl)
      location.href = _data.result.redirectUrl
  })
});
