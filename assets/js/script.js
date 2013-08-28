$(function() {

    $('.like-button').click(function() {
        var button = this;

        $.post($(button).attr('href'), {}, function(data) {
            $(button).toggleClass('red').toggleClass('green').html(data);
        });
        
        return false;
    });



});