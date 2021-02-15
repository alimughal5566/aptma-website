/* write your own custom js, this script will load at footer */

$(document).ready(function () {

    $('.navbar-collapse .navbar-nav > li.menu-item-has-children, .navbar-collapse .navbar-nav > li.menu-item-has-mega-menu').on('click', function () {
        $(this).toggleClass('active');
    });


});