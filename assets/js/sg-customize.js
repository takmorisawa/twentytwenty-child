function showNextWagashi() {
    var date = new Date();
    var month = date.getMonth();
    var date = date.getDate();
    var next_month = date > 16 ? month + 1 : month;
    var targets = jQuery("div[class*=sg-monthly]");
    var space_holder = jQuery(".sg-next-wagashi");
    if (space_holder.length == 0) {
        return;
    }

    target = jQuery(targets[next_month]).clone(true);
    target.appendTo(space_holder);

    headers = jQuery(".sg-next-wagashi h3");
    headers[1].remove();
}

function checkAndShowMonthly() {
    var targets = jQuery(".sg-monthly");
    targets.each(function(index, elm) {
        var margin = 70;
        var target = jQuery(elm);
        var target_top = target.offset().top;
        var win_height = jQuery(window).height();
        var scroll_top = jQuery(window).scrollTop();
        if(scroll_top - margin > target_top - win_height) {
            target.toggleClass("sg-monthly sg-monthly-shown");
        }
    });
}

function getParam($name) {
    var queryString = window.location.search;
    var queryObject = new Object();
    if(queryString){
        queryString = queryString.substring(1);
        var parameters = queryString.split("&");

        for (var i = 0; i < parameters.length; i++) {
            var element = parameters[i].split("=");

            var paramName = decodeURIComponent(element[0]);
            var paramValue = decodeURIComponent(element[1]);

            queryObject[paramName] = paramValue;
        }
    }
    return queryObject;
}

function switchLanguage() {

    if (getParam()["lang"] == "en") {
        var targets = jQuery(".sg-lang-en");
        targets.each(function(index, elm) {
            jQuery(elm).toggleClass("sg-lang-en sg-lang-en-shown");
        });
    }
    else {
        var targets = jQuery(".sg-lang-ja");
        targets.each(function(index, elm) {
            jQuery(elm).toggleClass("sg-lang-ja sg-lang-ja-shown");
        });
    }
}

jQuery(window).load(function() {
    switchLanguage();
    showNextWagashi();
    checkAndShowMonthly();
})
jQuery(window).scroll(function() { checkAndShowMonthly(); })
