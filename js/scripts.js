$(window).on("scroll", function () {
    if ($(this).scrollTop() > 75) {
        $("body").addClass("fullbody");
    }
    else {
        $("body").removeClass("fullbody");
    }
    if ($(this).scrollTop() > 250) {
        $("body").addClass("scrolledHeader"); // <-- Add it to body
    }
    else {
        $("body").removeClass("scrolledHeader");
    }
});