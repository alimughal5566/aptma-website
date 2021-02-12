/* write your own custom js, this script will load at footer */

$(document).ready(function () {

    console.log('start');

    $('.navbar-collapse .navbar-nav > li.menu-item-has-children, .navbar-collapse .navbar-nav > li.menu-item-has-mega-menu').on('click', function () {
        $(this).toggleClass('active');
    });

    // $('.single-events-list-item').on({
    //     mouseenter: function () {
    //         $(this).find('.content-area .detail-wrap').show('linear');
    //     },
    //     mouseleave: function () {
    //         $(this).find('.content-area .detail-wrap').hide('100');
    //     }
    // });

    // $('.navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li.menu-item-has-children').on('click', function () {
    //     $(this).toggleClass('active');
    // });

    console.log('end');

});