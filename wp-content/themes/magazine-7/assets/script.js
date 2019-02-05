(function (e) {
    "use strict";
    var n = window.AFTHRAMPES_JS || {};
    n.stickyMenu = function () {
        e(window).scrollTop() > 350 ? e("#masthead").addClass("nav-affix") : e("#masthead").removeClass("nav-affix")
    },
        n.mobileMenu = {
            init: function () {
                this.toggleMenu(), this.menuMobile(), this.menuArrow()
            },
            toggleMenu: function () {
                e('#masthead').on('click', '.toggle-menu', function (event) {
                    var ethis = e('.main-navigation .menu .menu-mobile');
                    if (ethis.css('display') == 'block') {
                        ethis.slideUp('300');
                    } else {
                        ethis.slideDown('300');
                    }
                    e('.ham').toggleClass('exit');
                });
                e('#masthead .main-navigation ').on('click', '.menu-mobile a i', function (event) {
                    event.preventDefault();
                    var ethis = e(this),
                        eparent = ethis.closest('li'),
                        esub_menu = eparent.find('> .sub-menu');
                    if (esub_menu.css('display') == 'none') {
                        esub_menu.slideDown('300');
                        ethis.addClass('active');
                    } else {
                        esub_menu.slideUp('300');
                        ethis.removeClass('active');
                    }
                    return false;
                });
            },
            menuMobile: function () {
                if (e('.main-navigation .menu > ul').length) {
                    var ethis = e('.main-navigation .menu > ul'),
                        eparent = ethis.closest('.main-navigation'),
                        pointbreak = eparent.data('epointbreak'),
                        window_width = window.innerWidth;
                    if (typeof pointbreak == 'undefined') {
                        pointbreak = 991;
                    }
                    if (pointbreak >= window_width) {
                        ethis.addClass('menu-mobile').removeClass('menu-desktop');
                        e('.main-navigation .toggle-menu').css('display', 'block');
                    } else {
                        ethis.addClass('menu-desktop').removeClass('menu-mobile').css('display', '');
                        e('.main-navigation .toggle-menu').css('display', '');
                    }
                }
            },
            menuArrow: function () {
                if (e('#masthead .main-navigation div.menu > ul').length) {
                    e('#masthead .main-navigation div.menu > ul .sub-menu').parent('li').find('> a').append('<i class="fa fa-angle-down">');
                }
            }
        },


        n.DataBackground = function () {
            var pageSection = e(".data-bg");
            pageSection.each(function (indx) {
                if (e(this).attr("data-background")) {
                    e(this).css("background-image", "url(" + e(this).data("background") + ")");
                }
            });

            e('.bg-image').each(function () {
                var src = e(this).children('img').attr('src');
                e(this).css('background-image', 'url(' + src + ')').children('img').hide();
            });
        },


        /* Slick Slider */
        n.SlickCarousel = function () {

            e(".default-slider-mode").slick({
                centerMode: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 12000,
                infinite: true,
                nextArrow: '<span class="slide-icon slide-icon-1 slide-next slide-next-1 fa fa-arrow-right"></span>',
                prevArrow: '<span class="slide-icon slide-icon-1 slide-prev slide-prev-1 fa fa-arrow-left"></span>',
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,

                        }
                    },
                    {
                        breakpoint: 678,
                        settings: {
                            slidesToShow: 2,
                            centerPadding: '15px',

                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            centerPadding: '15px',

                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]

            });

            e(".full-slider-mode").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 12000,
                infinite: true,
                nextArrow: '<span class="slide-icon slide-next icon-right fa fa-arrow-right"></span>',
                prevArrow: '<span class="slide-icon slide-prev icon-left fa fa-arrow-left"></span>',
                //appendArrows: e('.af-navcontrols')
            });



            e(".posts-slider").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 10000,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-icon-1 slide-next slide-next-1 fa fa-arrow-right"></i>',
                prevArrow: '<i class="slide-icon slide-icon-1 slide-prev slide-prev-1 fa fa-arrow-left"></i>',
            });

            e(".trending-posts-carousel").slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 10000,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-icon-1 slide-next slide-next-1 fa fa-arrow-right"></i>',
                prevArrow: '<i class="slide-icon slide-icon-1 slide-prev slide-prev-1 fa fa-arrow-left"></i>',
                responsive: [
                    {
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },

                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            e(".posts-carousel").slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 10000,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-icon-1 slide-next slide-next-1 fa fa-arrow-right"></i>',
                prevArrow: '<i class="slide-icon slide-icon-1 slide-prev slide-prev-1 fa fa-arrow-left"></i>',
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },

                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            e(".gallery-columns-1").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 10000,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-icon-1 slide-next fa fa-arrow-right"></i>',
                prevArrow: '<i class="slide-icon slide-icon-1 slide-prev fa fa-arrow-left"></i>',
                dots: true
            });



        },

        n.Preloader = function () {
            e(window).load(function () {
                e('#loader-wrapper').fadeOut();
                e('#af-preloader').delay(500).fadeOut('slow');

            });
        },

        n.Search = function () {
            e(window).load(function () {
                e(".af-search-click").on('click', function(){
                    e("#af-search-wrap").toggleClass("af-search-toggle");
                });
            });
        },

        n.Offcanvas = function () {
            e('.offcanvas-nav').sidr({
                side: 'left'
            });

            e('.sidr-class-sidr-button-close').click(function () {
                e.sidr('close', 'sidr');
            });
        },

        // SHOW/HIDE SCROLL UP //
        n.show_hide_scroll_top = function () {
            if (e(window).scrollTop() > e(window).height() / 2) {
                e("#scroll-up").fadeIn(300);
            } else {
                e("#scroll-up").fadeOut(300);
            }
        },

        n.scroll_up = function () {
            e("#scroll-up").on("click", function () {
                e("html, body").animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        },



        n.MagnificPopup = function () {
            e('div.zoom-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                closeOnContentClick: false,
                closeBtnInside: false,
                mainClass: 'mfp-with-zoom mfp-img-mobile',
                image: {
                    verticalFit: true,
                    titleSrc: function (item) {
                        return item.el.attr('title');
                    }
                },
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300,
                    opener: function (element) {
                        return element.find('img');
                    }
                }
            });

            e('.gallery').each(function() {
                e(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery: {
                        enabled:true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        opener: function (element) {
                            return element.find('img');
                        }
                    }
                });
            });
        },


        n.em_sticky = function () {
            jQuery('.home #secondary').theiaStickySidebar({
                additionalMarginTop: 30
            });
        },

        e(document).ready(function () {
            n.mobileMenu.init(), n.DataBackground(), n.em_sticky(), n.MagnificPopup(), n.SlickCarousel(), n.Preloader(), n.Search(), n.Offcanvas(), n.scroll_up();
        }), e(window).scroll(function () {
        n.stickyMenu(), n.show_hide_scroll_top();
    }), e(window).resize(function () {
        n.mobileMenu.menuMobile();
    })
})(jQuery);