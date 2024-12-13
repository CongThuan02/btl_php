(function ($) {
    "use strict";

    // chế độ sáng tối

    $(".index__switch").on('click', function () {
        if ($("body").hasClass("dark")) {
            $("body").removeClass("dark");
            $(".index__switch").removeClass("index__switched");
        } else {
            $("body").addClass("dark");
            $(".index__switch").addClass("index__switched");
        }
    });
})(jQuery);