const $side_navbar = $(".side-navbar");
const $pos_page = $(".pos-page");
const $main_header = $(".header");

$(function () {
    /* hide unnecessary elements */
    $side_navbar.addClass("shrink");
    // remove header html

    /* show necessary elements */
    $pos_page.removeClass("d-none");
});
