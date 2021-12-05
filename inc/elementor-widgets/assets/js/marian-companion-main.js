(function ($) {
    'use strict';

    if ($.fn.owlCarousel) {
        $(".hero-slides").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            smartSpeed: 800,
            margin: 0,
            dots: false,
            nav: true,
            navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>']
        });
    }

    if ($.fn.owlCarousel) {
        $(".marian-service-slides").owlCarousel({
            items: 3,
            loop: true,
            autoplay: true,
            smartSpeed: 800,
            margin: 30,
            center: true,
            dots: false,
            nav: true,
            startPosition: 1,
            navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                }
            }
        });
    }

    if ($.fn.owlCarousel) {
        $(".marian-workflow-slides").owlCarousel({
            items: 3,
            loop: true,
            autoplay: true,
            smartSpeed: 800,
            margin: 30,
            center: true,
            dots: true,
            startPosition: 1,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                }
            }
        });
    }

    if ($.fn.owlCarousel) {
        $(".marian-team-slides").owlCarousel({
            items: 3,
            loop: true,
            autoplay: true,
            smartSpeed: 800,
            margin: 50,
            center: true,
            nav: true,
            navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                }
            }
        });
    }

    if ($.fn.owlCarousel) {
        $(".testimonials-slides").owlCarousel({
            items: 3,
            loop: true,
            autoplay: true,
            smartSpeed: 1500,
            margin: 0,
            center: true,
            nav: true,
            navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                }
            }
        });
    }

    if ($.fn.barfiller) {

        $('.bar').each(function () {
            var $this = $(this),
                $color = $this.data('color');

            $this.barfiller({
                tooltip: true,
                duration: 1000,
                barColor: $color,
                animateOnResize: true
            });


        })

    }
    if ($.fn.imagesLoaded) {
        $('.marian-portfolio').imagesLoaded(function () {
            // filter items on button click
            $('.portfolio-menu').on('click', 'p', function () {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
            });
            // init Isotope
            var $grid = $('.marian-portfolio').isotope({
                itemSelector: '.single_gallery_item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.single_gallery_item'
                }
            });
        });
    }

    $('.portfolio-menu button.btn').on('click', function () {
        $('.portfolio-menu button.btn').removeClass('active');
        $(this).addClass('active');
    })
    if ($.fn.scrollUp) {
        $.scrollUp({
            scrollSpeed: 1500,
            scrollText: '<i class="fa fa-angle-up"></i>'
        });
    }

    if ($.fn.counterUp) {
        $('.counter').counterUp({
            delay: 10,
            time: 2000
        });
    }


    if ($('#clock').length > 0) {
        var clock = $('#clock');
        var eventTime = clock.data('event-time');
        clock.countdown(eventTime, function (event) {
            $(this).html(event.strftime(
                '<div class="countdown_wrap d-flex"><div  class="single_countdown"><h3>%D</h3><span>Days</span></div><div class="single_countdown"><h3>%H</h3><span>Hours</span></div><div class="single_countdown"><h3>%M</h3><span>Minutes</span></div><div class="single_countdown"><h3>%S</h3><span>Seconds</span></div></div>'
            ));
        });
    }

    // Background video
    var $selector = $('[data-videoid]');

    if ($selector.length) {
        $selector.each(function () {
            var $this = $(this);
            $this.YTPlayer({
                fitToBackground: true,
                videoId: $this.data('videoid')
            });
        });
    }

    // MC Scripts
    var $subscribe = $('.marian-subscribe-newsletter-area');
    if ($subscribe.length) {
        window.fnames = new Array();
        window.ftypes = new Array();
        fnames[0] = 'EMAIL';
        ftypes[0] = 'email';
        fnames[1] = 'FNAME';
        ftypes[1] = 'text';
        fnames[2] = 'LNAME';
        ftypes[2] = 'text';
        fnames[3] = 'ADDRESS';
        ftypes[3] = 'address';
        fnames[4] = 'PHONE';
        ftypes[4] = 'phone';
        fnames[5] = 'BIRTHDAY';
        ftypes[5] = 'birthday';
    }

    // Search listings
    var $form = $('.advanced-filtering-form');
    if ($form.length) {
        var searchBtn = $('.advanced-filtering-form button.boxed-btn2');
        searchBtn.click(function (event) {
            event.preventDefault();
            var output_text = $('.all-listings-together').prev();
            var search_text = $('.search-text').val();
            var search_category = $('.search-category .nice-select .current').text();
            var search_location = $('.search-location .nice-select .current').text();
            var search_area_from = $('.area-from .nice-select .current').text();
            var search_area_to = $('.area-to .nice-select .current').text();
            var price_both = $('.advanced-filtering-form #amount').val();
            var price_both = price_both.split(' - ');
            var price_min = price_both[0];
            var price_max = price_both[1];

            output_text.text('Loading...');
            console.log(search_text + search_category + search_location + search_area_from + search_area_to + price_min + price_max);

            // Custom function for displaying message
            function add_message(message, type) {
                var html = "<div class='alert alert-" + type + "'>" + message + "</div>";
                $(".jam-confirmation-message").empty().append(html);
                $(".jam-confirmation-message").fadeIn();
            }

            // Getting values from the form
            var nonce = $("#_wpnonce").val();
            var data = new FormData();
            data.append('action', 'prop_datas');
            data.append('nonce', nonce);
            data.append('search_text', search_text);
            data.append('search_category', search_category);
            data.append('search_location', search_location);
            data.append('search_area_from', search_area_from);
            data.append('search_area_to', search_area_to);
            data.append('price_min', price_min);
            data.append('price_max', price_max);
            $.ajax({
                url: prop_datas.ajax_url,
                type: 'POST',
                dataType: 'json',
                data: data,
                nonce: nonce,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    console.log(data);
                    $('.all-listings-together').html(data);
                    var search_result_count = $('.all-listings-together span.total-search-count').data('total-search-count');
                    // console.log(search_result_count);
                    if (search_result_count > 0) {
                        output_text.text(search_result_count + ' Listings found');
                    } else {
                        output_text.text('');
                    }
                    // $form[0].reset();
                }
            })

                // Error 
                .fail(function () {
                    add_message(data.message ? data.message : 'Sorry! Something went wrong.', 'danger');
                })

            // Reset all fields
            // .always(function () {
            //     event.target.reset();
            // });

        });
    }

})(jQuery);