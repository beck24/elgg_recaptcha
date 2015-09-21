define(['require', 'jquery', 'elgg'], function(require, $, elgg) {
    require(['google_recaptcha']);
});

// needs to be global function to be called by recaptcha js
function elgg_recaptcha_render() {
    // move recaptcha divs into position before loading the recaptcha js
    $('div.g-recaptcha[data-form]').each(function(index, item) {
        var selector = $(item).attr('data-form');
        $(item).removeAttr('data-form');
        var $submit = $('form' + selector + ' input[type="submit"]').filter(':last');
        var $elggfoot = $('form'+ selector + ' .elgg-foot').filter(':last');

        // stick in the .elgg-foot div if available
        // otherwise just above last submit
        if ($elggfoot.length) {
            $(item).prependTo($elggfoot);
        }
        else {
            $(item).insertBefore($submit);
        }
    });
    
    $('div.g-recaptcha').each(function(index, item) {
        grecaptcha.render(item, {
            sitekey: $(item).attr('data-sitekey'),
            theme: $(item).attr('data-theme'),
            size: $(item).attr('data-size'),
            type: $(item).attr('data-type')
        });
    });
}