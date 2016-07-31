$(function() {
    $('span.rating.rate').on('mouseout', function() {
        // retrieve all associated rating stars and reverse their arrangement.
        var stars = $(this).children('span.star').get().reverse();
        // make the stars inactive first.
        $(stars).removeClass('active');
        // retrieve the rating value.
        var rating = $(this).data('rating');

        for (var i = 0; i < parseInt(rating); i++) {
            // make the star active.
            $(stars[i]).addClass('active');
        }
    }).on('mouseover', function() {
        // make the stars active first.
        $(this).children('span.star').removeClass('active');
    });

    $('span.star').on('click', function() {
        // get the rating component.
        var component = $(this).parent('span.rating.rate');
        // get the player id.
        var playerId = component.data('player-id');
        // get the value of the rating.
        var rateValue = $(this).data('value');

        $.ajax({
            url: '/player/rate',
            type: 'put',
            dataType: 'json',
            data: {
                'player_id': playerId,
                'value': rateValue
            },
            success: function(data) {
                if (data.error) {
                    // show the error message.
                    alert(data.message);
                } else if (data.success) {
                    // get the new overall rating.
                    var rating = data.rating;
                    var oldRating = component.data('rating');

                    // update the rating only if there's a change.
                    if (rating !== parseInt(oldRating)) {
                        component.data('rating', rating);
                    }
                    // retrieve all the stars.
                    var stars = component.children('span.star').get().reverse();

                    for (var i = 0; i < rating; i++) {
                        // make the star active.
                        $(stars[i]).addClass('active');
                    }
                }
            }
        });
    });
});
