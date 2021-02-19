/* write your own custom js, this script will load at footer */

$(document).ready(function () {

    $('.navbar-collapse .navbar-nav > li.menu-item-has-children, .navbar-collapse .navbar-nav > li.menu-item-has-mega-menu').on('click', function () {
        $(this).toggleClass('active');
    });

    $('.navbar-collapse .navbar-nav > li.menu-item-has-children > .sub-menu li.menu-item-has-children, .navbar-collapse .navbar-nav > li.menu-item-has-mega-menu > li').on('click', function () {
        $(this).parents('.menu-item-has-children').addClass('active');
        $(this).toggleClass('active');
    });

    $('.footer-widget .widget-ul-wrapper ul li a').attr('target', '_blank');
    
});