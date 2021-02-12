;
(function ($) {
    "use strict";

    $(document).ready(function () {
        var rtlEnable = $('html').attr('dir');
        var sliderRtlValue = typeof rtlEnable === 'undefined' || rtlEnable === 'ltr' ? false : true;
        if ($(window).width() < 992) {
            $(document).on('click', '.navbar-area .navbar-nav li.menu-item-has-mega-menu>a', function (e) {
                e.preventDefault();
            });
            $(document).on('click', '.navbar-area .navbar-nav li.menu-item-has-children>a', function (e) {
                e.preventDefault();
            });
        }
        /**-----------------------------
         *  Navbar fix
         * ---------------------------*/
        // $(document).on('click', '.navbar-area .navbar-nav li.menu-item-has-children>a', function(e) {
        //     e.preventDefault();
        // })

        /*--------------------
           wow js init
       ---------------------*/
        new WOW().init();

        /*-------------------------
            magnific popup activation
        -------------------------*/
        $('.video-play-btn,.video-popup,.small-vide-play-btn,.video-play').magnificPopup({
            type: 'video'
        });
        $('.image-popup').magnificPopup({
            type: 'image',
            gallery: {
                // options for gallery
                enabled: true
            },
        });

        /*------------------
           back to top
       ------------------*/
        $(document).on('click', '.back-to-top', function () {
            $("html,body").animate({
                scrollTop: 0
            }, 2000);
        });
        /*------------------------------
           counter section activation
       -------------------------------*/
        var counternumber = $('.count-num');
        if (counternumber.length > 1) {
            counternumber.rCounter();
        }

        /*-------------------------------
            case study filter
        ---------------------------------*/
        var $caseStudyThreeContainer = $('.case-studies-masonry');
        if ($caseStudyThreeContainer.length > 0) {
            $('.case-studies-masonry').imagesLoaded(function () {
                var caseMasonry = $caseStudyThreeContainer.isotope({
                    itemSelector: '.masonry-item', // use a separate class for itemSelector, other than .col-
                    masonry: {
                        gutter: 0
                    }
                });
                $(document).on('click', '.case-studies-menu li', function () {
                    var filterValue = $(this).attr('data-filter');
                    caseMasonry.isotope({
                        filter: filterValue
                    });
                });
            });
            $(document).on('click', '.case-studies-menu li', function () {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
            });
        }
        /*--------------------------------
            Case Study Gallery Carousel
         --------------------------------*/

        var $teamMemberCarousel = $('.team-member-style-01');
        if ($teamMemberCarousel.length > 0) {
            $('.team-carousel').owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: false,
                nav: true,
                rtl: sliderRtlValue,
                navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    460: {
                        items: 2,
                        nav: false
                    },
                    599: {
                        items: 2,
                        nav: false
                    },
                    768: {
                        items: 2,
                        nav: false
                    },
                    960: {
                        items: 3
                    },
                    1200: {
                        items: 4
                    },
                    1920: {
                        items: 4
                    }
                }
            });
        }
        /*--------------------------------
            Case Study Gallery Carousel
         --------------------------------*/

        var $rekatedCaseStudyCarousel = $('.related-case-study-carousel');
        if ($rekatedCaseStudyCarousel.length > 0) {
            $rekatedCaseStudyCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: false,
                nav: true,
                rtl: sliderRtlValue,
                navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    460: {
                        items: 1,
                        nav: false
                    },
                    599: {
                        items: 2,
                        nav: false
                    },
                    768: {
                        items: 2,
                        nav: false
                    },
                    960: {
                        items: 3
                    },
                    1200: {
                        items: 3
                    },
                    1920: {
                        items: 3
                    }
                }
            });
        }

        /*--------------------------------
            Case Study Gallery Carousel
         --------------------------------*/

        var $caseStudyGalleryCarousel = $('.case-study-gallery-carousel');
        if ($caseStudyGalleryCarousel.length > 0) {
            $caseStudyGalleryCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 2000,
                margin: 30,
                dots: false,
                nav: true,
                rtl: sliderRtlValue,
                navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                responsive: {
                    0: {
                        items: 1
                    },
                    460: {
                        items: 1
                    },
                    599: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    960: {
                        items: 1
                    },
                    1200: {
                        items: 1
                    },
                    1920: {
                        items: 1
                    }
                }
            });
        }
        /*---------------------------
            Testimonial carousel
        ---------------------------*/
        var $TestimonialOneCarousel = $('.testimonial-carousel');
        if ($TestimonialOneCarousel.length > 0) {
            $TestimonialOneCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: true,
                rtl: sliderRtlValue,
                nav: false,
                navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>'],
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                responsive: {
                    0: {
                        items: 1
                    },
                    460: {
                        items: 1
                    },
                    599: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    960: {
                        items: 1
                    },
                    1200: {
                        items: 1
                    },
                    1920: {
                        items: 1
                    }
                }
            });
        }
        /*---------------------------
            Testimonial carousel Two
        ---------------------------*/
        var $TestimonialTwoCarousel = $('.testimonial-carousel-02');
        if ($TestimonialTwoCarousel.length > 0) {
            $TestimonialTwoCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: true,
                nav: false,
                rtl: sliderRtlValue,
                navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>'],
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                responsive: {
                    0: {
                        items: 1
                    },
                    460: {
                        items: 1
                    },
                    599: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    960: {
                        items: 2
                    },
                    1200: {
                        items: 2
                    },
                    1920: {
                        items: 2
                    }
                }
            });
        }

        /*---------------------------
            Blog Grid carousel
        ---------------------------*/
        var $blogGridCarousel = $('.blog-grid-carousel');
        if ($blogGridCarousel.length > 0) {
            $blogGridCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: true,
                nav: true,
                rtl: sliderRtlValue,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                responsive: {
                    0: {
                        items: 1
                    },
                    360: {
                        items: 1
                    },
                    575: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    960: {
                        items: 4
                    },
                    1200: {
                        items: 4
                    },
                }
            });
        }

        /*---------------------------
            Event Grid carousel
        ---------------------------*/

        var $eventsGridCarousel = $('.events-grid-carousel');
        if ($eventsGridCarousel.length > 0) {
            $eventsGridCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: true,
                nav: true,
                rtl: sliderRtlValue,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                responsive: {
                    0: {
                        items: 1
                    },
                    360: {
                        items: 1
                    },
                    575: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    960: {
                        items: 4
                    },
                    1200: {
                        items: 4
                    },
                }
            });
        }

        /*---------------------------
            Publications Grid carousel
        ---------------------------*/

        var $publicationGridCarousel = $('.publication-grid-carousel');
        if ($publicationGridCarousel.length > 0) {
            $publicationGridCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: true,
                nav: true,
                rtl: sliderRtlValue,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                responsive: {
                    0: {
                        items: 1
                    },
                    360: {
                        items: 1
                    },
                    575: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    960: {
                        items: 2
                    },
                    1200: {
                        items: 3
                    },
                }
            });
        }

        /*---------------------------
            Books Grid carousel
        ---------------------------*/

        var $booksGridCarousel = $('.books-grid-carousel');
        if ($booksGridCarousel.length > 0) {
            $booksGridCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: true,
                nav: true,
                rtl: sliderRtlValue,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                responsive: {
                    0: {
                        items: 1
                    },
                    360: {
                        items: 1
                    },
                    575: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    960: {
                        items: 4
                    },
                    1200: {
                        items: 4
                    },
                }
            });
        }

        /*---------------------------
            Videos Grid carousel
        ---------------------------*/

        var $videosGridCarousel = $('.video-grid-carousel');
        if ($videosGridCarousel.length > 0) {
            $videosGridCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: true,
                nav: true,
                rtl: sliderRtlValue,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                responsive: {
                    0: {
                        items: 1
                    },
                    360: {
                        items: 1
                    },
                    575: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    960: {
                        items: 4
                    },
                    1200: {
                        items: 4
                    },
                }
            });
        }

        /*---------------------------
             advertise carousel
        ---------------------------*/

        var $advertiseGridCarousel = $('.advertise-grid-carousel');
        if ($advertiseGridCarousel.length > 0) {
            $advertiseGridCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: true,
                nav: true,
                rtl: sliderRtlValue,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                responsive: {
                    0: {
                        items: 1
                    },
                    360: {
                        items: 1
                    },
                    575: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    960: {
                        items: 4
                    },
                    1200: {
                        items: 4
                    },
                }
            });
        }


        /*---------------------------
             case studies carousel
        ---------------------------*/
        $('.case-studies-slider-active').owlCarousel({
            loop: true,
            items: 3,
            nav: true,
            margin: 30,
            center: true,
            rtl: sliderRtlValue,
            navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
            responsive: {
                0: {
                    items: 1,
                    margin: 10,
                    nav: false,
                },
                600: {
                    items: 1,
                    margin: 10,
                    nav: false,
                },
                768: {
                    items: 1,
                    margin: 10,
                },
                992: {
                    items: 1,
                    center: false
                },
                1024: {
                    items: 2
                },
                1200: {
                    items: 3
                },
                1366: {
                    items: 3
                },
                1440: {
                    items: 3
                }
            }
        })

        // Clinet - active
        $('.client-active-area').owlCarousel({
            loop: true,
            items: 5,
            nav: true,
            margin: 100,
            dots: false,
            rtl: sliderRtlValue,
            navText: ['<span data-icon="&#x23;"></span>', '<span data-icon="&#x24;"></span>'],
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        })
        if ($('.price-plan-slider').length > 0) {
            // price plan - active
            $('.price-plan-slider').owlCarousel({
                loop: true,
                nav: true,
                margin: 30,
                dots: false,
                rtl: sliderRtlValue,
                navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2,
                        nav: true,
                    },
                    992: {
                        items: 3,
                        nav: true,
                    },
                    1200: {
                        items: 3
                    }
                }
            });
        }

        /*---------------------------
            header carousel
        ---------------------------*/
        var $headerCarousel = $('.header-slider-one');
        if ($headerCarousel.length > 0) {
            $headerCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: true,
                rtl: sliderRtlValue,
                nav: true,
                navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
                responsive: {
                    0: {
                        items: 1,
                        nav: false,
                    },
                    460: {
                        items: 1,
                        nav: false,
                    },
                    599: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    960: {
                        items: 1
                    },
                    1200: {
                        items: 1
                    },
                    1920: {
                        items: 1
                    }
                }
            });
        }

        /*---------------------------
            slider carousel
        ---------------------------*/

        var $sliderCarousel = $('.slider-grid-carousel');
        $sliderCarousel.owlCarousel({
            loop: true,
            autoplay: true, //true if you want enable autoplay
            autoPlayTimeout: 1000,
            margin: 30,
            dots: false,
            nav: true,
            rtl: sliderRtlValue,
            navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                460: {
                    items: 1,
                    nav: false
                },
                599: {
                    items: 1,
                    nav: false
                },
                768: {
                    items: 1,
                    nav: false
                },
                960: {
                    items: 1
                },
                1200: {
                    items: 1
                },
                1920: {
                    items: 1
                }
            }
        });


        /*----------------------
            Search Popup
        -----------------------*/
        var bodyOvrelay = $('#body-overlay');
        var searchPopup = $('#search-popup');

        $(document).on('click', '#body-overlay,.search-popup-close-btn', function (e) {
            e.preventDefault();
            bodyOvrelay.removeClass('active');
            searchPopup.removeClass('show');
        });
        $(document).on('click', '#search', function (e) {
            e.preventDefault();
            searchPopup.addClass('show');
            bodyOvrelay.addClass('active');
        });

    });

    $(window).on('scroll', function () {

        //back to top show/hide
        var ScrollTop = $('.back-to-top');
        if ($(window).scrollTop() > 1000) {
            ScrollTop.fadeIn(1000);
        } else {
            ScrollTop.fadeOut(1000);
        }

    });


    $(window).on('load', function () {

        /*-----------------
            preloader
        ------------------*/
        var preLoder = $("#preloader");
        preLoder.fadeOut(1000);

        /*-----------------
            back to top
        ------------------*/
        var backtoTop = $('.back-to-top')
        backtoTop.fadeOut();

    });


})(jQuery);