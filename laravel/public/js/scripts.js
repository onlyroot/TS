
jQuery(document).ready(function() {

    $('.page-container form').submit(function() {
        var username = $(this).find('.username').val();
        var password = $(this).find('.password').val();
        var code = $(this).find('.code').val();
        if (username.match(/^\s*$/)) {
            $(this).find('.error').fadeOut('fast', function() {
                $(this).css('top', '27px');

            });
            $(this).find('.error').fadeIn('fast', function() {
                $(this).parent().find('.username').focus();
            });
//            var span = document.createElement("span");
//            span.innerHTML = "账号不能为空";
//            $(this).find('.error').append($("span"));
//            $(this).append($("span"));
            return false;
        }
        if (password.length < 6 || password.length > 15) {
            $(this).find('.error').fadeOut('fast', function() {
                $(this).css('top', '96px');
            });
            $(this).find('.error').fadeIn('fast', function() {
                $(this).parent().find('.password').focus();
            });
            return false;
        }
        if (code.length != 5) {
            $(this).find('.error').fadeOut('fast', function() {
                $(this).css('top', '163px');
            });
            $(this).find('.error').fadeIn('fast', function() {
                $(this).parent().find('.code').focus();
            });
            return false;
        }
    });

    $('.page-container form .username, .page-container form .password').keyup(function() {
        $(this).parent().find('.error').fadeOut('fast');
    });

});
