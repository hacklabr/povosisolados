/**
 * Functionality specific to Quark.
 **/

(function($) {
    // transparent tabs color change
    function gkTabEventTrigger(i, wrapper) {
        if(wrapper.hasClass('transparent-tabs')) {
            var tabs = wrapper.find('.gk-tabs-item');
            var css_class = 'dark-tabs';

            if(
                $(tabs[i]).find('.box').first().hasClass('color-bg') ||
                $(tabs[i]).find('.box').first().hasClass('dark-bg') ||
                $(tabs[i]).find('.box').first().hasClass('parallax-bg')
            ) {
                css_class = '';
            }

            if(css_class !== '') {
                wrapper.find('.gk-tabs-nav').first().addClass('dark-tabs');
            } else {
                wrapper.find('.gk-tabs-nav').first().removeClass('dark-tabs');
            }
        }
    }

    $(document).ready(function(){
        // Set tabs color if necessary
        $('.gk-tabs').each(function(el, i) {
            el = $(el);
            if(el.parent().hasClass('transparent-tabs')) {
                var css_class = 'dark-tabs';
                if(
                    el.first('.gk-tabs-item').find('.box').first().hasClass('color-bg') ||
                    el.first('.gk-tabs-item').find('.box').first().hasClass('dark-bg') ||
                    el.first('.gk-tabs-item').find('.box').first().hasClass('parallax-bg')
                ) {
                    css_class = '';
                }

                if(css_class !== '') {
                    el.find('.gk-tabs-nav').first().addClass(css_class);
                }
            }
        });

        // Logo switching
        if($('.gk-logo').find('img').length) {
           var logo_img = $('.gk-logo').find('img').first();

           if(logo_img.attr('data-dark') && $(document.body).hasClass('dark-bg')) {
               logo_img.attr('src', logo_img.attr('data-dark'));
           }
        }

        // smooth anchor scrolling
        jQuery('a[href*="#"]').on('click', function (e) {
            e.preventDefault();
            if(this.hash.length > 1) {
	            if(this.hash == '#respond') {
	                var target = jQuery(this.hash);
	                jQuery('html, body').stop().animate({
	                    'scrollTop': target.offset().top
	                }, 1000, 'swing', function () {
	                    window.location.hash = target.selector;
	                });
	            } else {
	                if(this.hash !== '' && this.href.replace(this.hash, '') == window.location.href.replace(window.location.hash, '')) {
	                    var target = jQuery(this.hash);

	                    if(target.length) {
	                        jQuery('html, body').stop().animate({
	                            'scrollTop': target.offset().top
	                        }, 1000, 'swing', function () {
	                            window.location.hash = target.selector;
	                        });
	                    } else {
	                        window.location = jQuery(this).attr('href');
	                    }
	                } else {
	                    window.location = jQuery(this).attr('href');
	                }
	            }
            }
        });

        // Fit videos
        $(".video-wrapper").fitVids();

        // Social icons
        if(jQuery('.gk-social-icons').length) {
            var social_icons = jQuery('.gk-social-icons');
            social_icons.click(function() {
                var item = jQuery(this);

                if(!item.attr('data-click-block') || item.attr('data-click-block') == '') {
                    if(item.hasClass('clicked')) {
                        item.removeClass('show');
                        setTimeout(function() {
                            item.removeClass('clicked');
                            item.attr('data-click-block', '');
                        }, 350);
                    } else {
                        item.addClass('clicked');
                        item.attr('data-click-block', 'true');

                        setTimeout(function() {
                            item.addClass('show');
                        }, 50);

                        setTimeout(function() {
                            item.attr('data-click-block', '');
                        }, 300);
                    }
                }
            });
        }

        jQuery(document).on('click', function (e) {
            var item = jQuery(".gk-social-icons");
            if (jQuery(e.target).closest(".gk-social-icons").length === 0) {
                item.removeClass('show');
                setTimeout(function() {
                    item.removeClass('clicked');
                    item.attr('data-click-block', '');
                }, 350);
            }
        });

        // login popup
        if(jQuery('.gk-login-popup').length && jQuery('#gk-login-popup').length) {
           var popup = jQuery('#gk-login-popup');
           var overlay = jQuery('#gk-login-popup-overlay');
           var close = jQuery('#gk-login-popup-close');

           jQuery('.gk-login-popup > a').click(function(e) {
               e.preventDefault();

               overlay.css('display', 'block');
               popup.css('display', 'block');

               setTimeout(function() {
                   overlay.addClass('gk-active');
                   popup.addClass('gk-active');
               }, 50);
           });

           jQuery(overlay).add(close).click(function() {
               overlay.removeClass('gk-active');
               popup.removeClass('gk-active');

               setTimeout(function() {
                   overlay.css('display', 'none');
                   popup.css('display', 'none');
               }, 650);
           });
        }

        // Testimonials
        var testimonials = jQuery('.gk-testimonials');

        if(testimonials.length > 0) {
            testimonials.each(function(i, wrapper) {
                wrapper = jQuery(wrapper);
                wrapper.attr('data-block', 'false');
                var amount = wrapper.data('amount');
                var testimonial_pagination = jQuery('<ul>', { class: 'gk-testimonials-pagination' });
                var quotes = wrapper.find('blockquote');
                var current_page = 0;
                var sliding_wrapper = wrapper.find('div div');

                for(var j = 0; j < amount; j++) {
                    var titem = '<li' + (j === 0 ? ' class="active"' : '') + '>' + (j+1) + '</li>';
                    testimonial_pagination.html(testimonial_pagination.html() + titem);
                }

                testimonial_pagination.appendTo(wrapper);
                var pages = testimonial_pagination.find('li');
                // hide quotes
                quotes.each(function(i, quote) {
                    if(i > 0) {
                        jQuery(quote).addClass('hidden');
                    }
                });
                // navigation
                pages.each(function(i, page) {
                    page = jQuery(page);
                    page.click(function() {
                        jQuery(quotes[current_page]).addClass('hidden');
                        current_page = i;
                        jQuery(quotes[current_page]).removeClass('hidden');
                        pages.removeClass('active');
                        jQuery(pages[current_page]).addClass('active');
                        sliding_wrapper.css('margin-left', -1 * (current_page * 100) + "%");
                        wrapper.attr('data-block', 'true');
                    });
                });

                // auto-animation
                setTimeout(function() {
                    testimonials_auto_animate();
                }, 3000);

                function testimonials_auto_animate() {
                    if(wrapper.attr('data-block') == 'false') {
                        jQuery(quotes[current_page]).addClass('hidden');
                        current_page = current_page + 1;

                        if(current_page >= pages.length) {
                            current_page = 0;
                        }

                        jQuery(quotes[current_page]).removeClass('hidden');
                        pages.removeClass('active');
                        jQuery(pages[current_page]).addClass('active');
                        sliding_wrapper.css('margin-left', -1 * (current_page * 100) + "%");
                    } else {
                        wrapper.attr('data-block', 'false');
                    }

                    setTimeout(function() {
                        testimonials_auto_animate();
                    }, 5000);
                }
            });
        }

        // Scroll effects
        var frontpage_header = jQuery('#gk-header');
        var header_mod = jQuery('#gk-header-mod');
        var frontpage_img = jQuery('#gk-header-mod .parallax-img');

        if(
            frontpage_header &&
            frontpage_img &&
            jQuery(window).width() > 720
        ) {
            jQuery(window).scroll(function() {
                var win_scroll = jQuery(window).scrollTop();
                var header_height = frontpage_header.height();

                if(win_scroll < header_height) {
                    animate_header(win_scroll, header_height);
                }
            });

            var animate_header = function(win_scroll, header_height) {
                var progress = (win_scroll / header_height);
                frontpage_img.css('top', 50 + (50 * progress) + '%');
            };
        }

        if(
            frontpage_header &&
            frontpage_img
        ) {
            var adjust_header = function() {
                var mod_h = header_mod.outerHeight();
                var img_h = frontpage_img.outerHeight();
                var mod_w = header_mod.outerWidth();
                var img_w = frontpage_img.outerWidth();

                if(img_h < mod_h) {
                    frontpage_img.attr('class', 'parallax-img gk-vertical');
                } else if(img_w < mod_w) {
                    frontpage_img.attr('class', 'parallax-img gk-horizontal');
                }
            };

            adjust_header();

            jQuery(window).load(function() {
                adjust_header();
            });

            jQuery(window).resize(function() {
                adjust_header();
            });
        }

        // Menu text hiding
        var menu_text = jQuery('#gk-mobile-menu-text');
        var menu_text_w = menu_text.outerWidth() + "px";
        var menu_wrap = menu_text.parent();
        var main_nav = jQuery('#gk-header-nav');
        menu_text.css('width', menu_text_w);
        var win = jQuery(window);

        /* jQuery(window).scroll(menu_scroll);

        function menu_scroll() {
            var y = win.scrollTop();
            menu_wrap.css('top', (y >= 0 ? y : 0) + "px");

            if(y <= 50) {
                if(main_nav.hasClass('inactive')) {
                    main_nav.removeClass('inactive');
                }
            } else {
                if(!main_nav.hasClass('inactive')) {
                    main_nav.addClass('inactive');
                }
            }
        }*/

        if(jQuery('body').hasClass('dark-bg')) {
            var header = false;
            if(jQuery('.archive .site-content').length) {
                header = jQuery('.archive .site-content').children('header');
            } else if(jQuery('.single-page').length) {
                header = jQuery('.single-page').children('header');
            } else if(jQuery('#gk-header-mod').length) {
                header = jQuery('#gk-header-mod');
            } else if(jQuery('.one-page').length) {
                header = jQuery('.one-page').children('header');
            }

            win.scroll(header_menu_scroll);
        }

        function header_menu_scroll() {
            var h = header ? header.outerHeight() : 0;
            var y = win.scrollTop();

            if(y <= h) {
                if(main_nav.hasClass('show-dark')) {
                    main_nav.removeClass('show-dark');
                }
            } else {
                if(!main_nav.hasClass('show-dark')) {
                    main_nav.addClass('show-dark');
                }
            }
        }


        // Category header scroll effect
        if(jQuery('.archive .entry-header > img').length) {
            var header = jQuery('.archive .entry-header');
            var img = header.children('img');

            win.scroll(header_scroll);
        }

        if(jQuery('.one-page .entry-header > img').length) {
            var header = jQuery('.one-page .entry-header');
            var img = header.children('img');

            win.scroll(header_scroll);
        }

        // Article header scroll effect
        if(jQuery('.single-page > header > img').length) {
            var header = jQuery('.single-page').children('header');
            var img = header.children('img');

            win.scroll(header_scroll);
        }

        // Frontpage header scroll effect
        if(jQuery('.parallax-img').length) {
            var header = jQuery('#gk-header-mod');
            var img = header.children('img');

            win.scroll(header_scroll);
        }


        function header_scroll() {
            var h = header.outerHeight();
            var y = win.scrollTop();
            if(y <= h) {
                var progress = (y / h);
                img.css('top', 50 + (50 * progress) + '%');
            }
        }

        // Mouse icon animation
        if(jQuery('.mouse-icon').length) {
            var icons = jQuery('.mouse-icon');

            setTimeout(function() {
                mouse_icon_animation()
            }, 1000);

            function mouse_icon_animation() {
                icons.addClass('animate');

                setTimeout(mouse_icon_remove, 160);
                setTimeout(mouse_icon_add, 320);
                setTimeout(mouse_icon_remove, 480);
                setTimeout(mouse_icon_animation, 2500);
            }

            function mouse_icon_add() {
                icons.addClass('animate');
            }

            function mouse_icon_remove() {
                icons.removeClass('animate');
            }
        }

        // Social icons
        if(jQuery('.gk-social-icons').length) {
            var social_icons = jQuery('.gk-social-icons');
            social_icons.click(function() {
                var item = jQuery(this);

                if(!item.attr('data-click-block') || item.attr('data-click-block') == '') {
                    if(item.hasClass('clicked')) {
                        item.removeClass('show');
                        setTimeout(function() {
                            item.removeClass('clicked');
                            item.attr('data-click-block', '');
                        }, 350);
                    } else {
                        item.addClass('clicked');
                        item.attr('data-click-block', 'true');

                        setTimeout(function() {
                            item.addClass('show');
                        }, 50);

                        setTimeout(function() {
                            item.attr('data-click-block', '');
                        }, 300);
                    }
                }
            });
        }

        // Video link
        if(jQuery('.gk-video-link').length) {
            jQuery('.gk-video-link').click(function(e) {
                e.preventDefault();
                var link = jQuery(this);

                var popup = jQuery('<div id="gk-video-overlay"><a href="#close">&times;</a><iframe src="'+link.attr('data-url')+'" width="'+link.attr('data-width')+'" height="'+link.attr('data-height')+'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>');

                link.parent().append(popup);
                var video_element = popup.find('iframe');
                setTimeout(function() {
                    video_element.addClass('loaded');
                }, 1000);

                popup.addClass('show');

                setTimeout(function() {
                    popup.addClass('open');
                }, 50);

                popup.find('a[href="#close"]').click(function(e) {
                    e.preventDefault();

                    popup.removeClass('open');

                    setTimeout(function() {
                        popup.removeClass('show');
                        popup.remove();
                    }, 350);
                });
            });
        }

        // Classic menu
        var menu_ID = false;

        if ($('#gk-header-nav .nav-menu').length) {
            menu_ID = '#gk-header-nav .nav-menu';
        }

        if($(menu_ID).length > 0) {
            // set the menu config only if it is visible
            if($(window).outerWidth() > $(document.body).attr('data-tablet-width')) {
                gk_quark_classic_menu_init();
        }
        // evaluate the menu initialization on every window resize
        $(window).resize(function() {
            // it will be evaluated only if it wasn't evaluated earlier
            if($(window).outerWidth() > $(document.body).attr('data-tablet-width')) {
                gk_quark_classic_menu_init();
            }
        });

            // Overlay menu
            $('#gk-mobile-menu').click(function(e) {
                e.preventDefault();

                if($('#gk-menu-overlay').length === 0) {
                    var menu_wrap = $('<div id="gk-menu-overlay"></div><div id="gk-menu-overlay-wrap"><span id="gk-menu-overlay-close">&times;</span></div>');
                    $(document.body).append(menu_wrap);
                    $('#gk-menu-overlay-wrap').append($('#gk-header-nav .nav-menu').clone());

                    $('#gk-menu-overlay-wrap').click(function(e) {
                        e.stopPropagation();
                    });

                    $('#gk-menu-overlay-close').click(function() {
                        $('#gk-menu-overlay').removeClass('gk-active');
                        $('#gk-menu-overlay-wrap').removeClass('gk-active');

                        setTimeout(function() {
                            $('#gk-menu-overlay').removeClass('gk-show');
                            $('#gk-menu-overlay-wrap').removeClass('gk-show');
                        }, 350);
                    });

                    $('#gk-menu-overlay').click(function() {
                        $('#gk-menu-overlay-close').trigger('click');
                    });

                    $('#gk-menu-overlay-wrap').find('a[href^="#"]').click(function() {
                        $('#gk-menu-overlay-close').trigger('click');
                    });
                }

                $('#gk-menu-overlay-wrap').css('top', $(window).scrollTop());
                $('#gk-menu-overlay').addClass('gk-show');
                $('#gk-menu-overlay-wrap').addClass('gk-show');

                setTimeout(function() {
                    $('#gk-menu-overlay').addClass('gk-active');
                    $('#gk-menu-overlay-wrap').addClass('gk-active');
                }, 50);
            });
        }

        // Aside menu
        if(jQuery('#aside-menu').length > 0) {
            var toggler = $('#gk-mobile-menu');

            toggler.click(function() {
                gkOpenAsideMenu();
            });

            jQuery('#close-menu').click( function() {
                gkOpenAsideMenu();
            });

            $('#aside-menu').find('a[href^="#"]').click(function() {
                $('#close-menu').trigger('click');
            });

            // detect android browser
            var ua = navigator.userAgent.toLowerCase();
            var isAndroid = ua.indexOf("android") > -1 && !window.chrome;

            if(isAndroid) {
                $(document.body).addClass('android-stock-browser');
            }
            // Android stock browser fix for the aside menu
            if($(document.body).hasClass('android-stock-browser') && $('#aside-menu').length) {
                $('#gk-mobile-menu').click(function() {
                    window.scrollTo(0, 0);
                });
                // menu dimensions
                var asideMenu = $('#aside-menu');
                var menuHeight = $('#aside-menu').outerHeight();
                //
                window.scroll(function() {
                    if(asideMenu.hasClass('menu-open')) {
                        // get the necessary values and positions
                        var currentPosition = $(window).scrollTop();
                        var windowHeight = $(window).height();

                        // compare the values
                        if(currentPosition > menuHeight - windowHeight) {
                            $('#close-menu').trigger('click');
                        }
                    }
                });
            }

            function gkOpenAsideMenu() {
                jQuery('#gk-bg').toggleClass('menu-open');
                jQuery('.boletim #primary').toggleClass('menu-open');

                if(jQuery('#aside-menu').hasClass('menu-open')) {
                    setTimeout(function() {
                        jQuery('#aside-menu').removeClass('menu-open');
                        jQuery('#gk-bg').removeClass('menu-visible');
                        jQuery('.boletim #primary').removeClass('menu-visible');
                    }, 350);
                } else {
                    jQuery('#aside-menu').addClass('menu-open');
                    jQuery('#gk-bg').addClass('menu-visible');
                    jQuery('.boletim #primary').addClass('menu-visible');
                }

                if(!jQuery('#close-menu').hasClass('menu-open')) {
                    setTimeout(function() {
                        jQuery('#close-menu').toggleClass('menu-open');
                    }, 300);
                } else {
                    jQuery('#close-menu').removeClass('menu-open');
                }
            }
        }
    });

    // Fixed menu
    if($('#gk-header-nav').hasClass('gk-fixed')) {

        var header = $('#gk-header');
        var page_nav = $('#gk-header-nav');
        var prev_scroll_value = 0;

        var logo_img = jQuery('.gk-logo').find('img').first();
        var image_logo_exists = jQuery('.gk-logo').find('img').length;
        var dark_logo_img = logo_img.attr('data-dark');
        var light_logo_img = logo_img.attr('data-light');
        var dark_bg_class = jQuery(document.body).hasClass('dark-bg');

        function menu_scroll() {
            var new_scroll_value = $(window).scrollTop() >= 0 ? $(window).scrollTop() : 0;
            var local_diff = new_scroll_value - prev_scroll_value;
            var current = parseInt($(page_nav).css('top'));
            var h = 10;

            if(new_scroll_value >= h) {
                if(
                    !$(page_nav).hasClass('gk-fixed-nav')
                ) {
                    $(page_nav).addClass('gk-fixed-nav');
                    $(page_nav).css('top', '0px');
                    current = 0;

                    // Logo switching
                    if(image_logo_exists && dark_logo_img) {
                        logo_img.attr('src', dark_logo_img);
                    }
                }

                if(new_scroll_value >= prev_scroll_value) {
                    $(page_nav).css('top', (current - local_diff >= 0 ? current - local_diff : 0) + "px");
                }
            } else {
                if($(page_nav).hasClass('gk-fixed-nav')) {
                    $(page_nav).removeClass('gk-fixed-nav');
                    $(page_nav).css('top', 0);

                    // Logo switching
                    if(image_logo_exists) {
                        if(dark_logo_img && dark_bg_class) {
                            logo_img.attr('src', dark_logo_img);
                        } else {
                            logo_img.attr('src', light_logo_img);
                        }
                    }
                }
            }

            prev_scroll_value = new_scroll_value;
        }

        $(window).scroll(menu_scroll);
    }

    // image show on frontpage
    $(document).ready(function(){
        $(".gk-is-wrapper-gk_quark").each(function(i, wrapper){
            var slideshow = new gkQuarkIS($(wrapper));
        });

        function gkQuarkIS(wrapper) {
            this.slides = wrapper.find('figure');
            this.current_slide = 0;
            this.animation_timer = false;
            this.swipe_min_move = 30;
            this.swipe_max_time = 500;
            this.slider_click = false;
            this.breakpoints = [0];
            this.breakpoints_inc = 0;
            this.breakpoint_limiter = 0;
            //
            this.pagination = wrapper.find('.gk-is-quark-pagination');

            if(this.pagination.length) {
                this.pagination_items = this.pagination.find('li');
            }
            // helper handler
            var $this = this;
            // generating breakpoints;
            this.slider = wrapper.find('.gk-slider');

            if(this.slider.length) {
                this.slider_bar = wrapper.find('.gk-slider-bar');
                this.slider_button = wrapper.find('.gk-slider-button');

                var breakpoints_amount = this.slides.length - 1;
                this.breakpoints_inc = 100 / breakpoints_amount;
                this.breakpoint_limiter = this.breakpoints_inc / 2;

                for(var i = 1, l = breakpoints_amount; i <= l; i++) {
                    this.breakpoints.push(this.breakpoints_inc * i);
                }

                wrapper.mousemove(function(e) {
                    e.preventDefault();
                    if($this.slider_click) {
                        var x = e.pageX - $this.slider.offset().left;
                        var result = (x / $this.slider.outerWidth()) * 100;
                        if(result >= 0 && result <= 100) {
                            $this.slider_button.css('left', result + "%");
                            $this.slider_bar.css('width', result + "%");
                            var next_slide = 0;
                            while(result >= $this.breakpoints[next_slide] + $this.breakpoint_limiter) {
                                next_slide++;
                            }
                            $this.anim(next_slide);
                        }
                    }
                });

                this.slider.mousedown(function(e) {
                    e.preventDefault();
                    $this.slider_click = true;
                });

                wrapper.mouseup(function(e) {
                    e.preventDefault();
                    $this.slider_click = false;
                    $this.slider_button.css('left', ($this.breakpoints_inc * $this.current_slide) + "%");
                    $this.slider_bar.css('width', ($this.breakpoints_inc * $this.current_slide) + "%");
                });
            }

            wrapper.find('figure img').each(function(i, img) {
                if($(img).is('[data-link]')) {
                    $(img).click(function() {
                        window.location.href = $(img).attr('data-link');
                    });
                } else {
                    $(img).css('cursor','default');
                }
            });

            this.anim = function(next_slide) {
                if(next_slide !== this.current_slide) {
                    this.slides.removeClass('gk-prev-prev');
                    this.slides.removeClass('gk-prev');
                    this.slides.removeClass('gk-current');
                    this.slides.removeClass('gk-next');

                    for(var i = 0, l = this.slides.length; i < l; i++) {
                        switch(i) {
                            case next_slide - 2:
                                $(this.slides[i]).addClass('gk-prev-prev');
                                break;
                            case next_slide - 1:
                                $(this.slides[i]).addClass('gk-prev');
                                break;
                            case next_slide:
                                $(this.slides[i]).addClass('gk-current');
                                break;
                            case next_slide + 1:
                                $(this.slides[i]).addClass('gk-next');
                                break;
                        }
                    }

                    if($this.pagination.length) {
                        this.pagination_items.removeClass('active');
                        $(this.pagination_items[next_slide]).addClass('active');
                    }

                    if($this.slider.length && !$this.slider_click) {
                        $this.slider_button.css('left', ($this.breakpoints_inc * next_slide) + "%");
                        $this.slider_bar.css('width', ($this.breakpoints_inc * next_slide) + "%");
                    }
                }

                this.current_slide = next_slide;
            };

            this.autoanim = function() {
                if(!$this.slider_click) {
                    if($this.current_slide < $this.slides.length - 1) {
                        $this.anim($this.current_slide + 1);
                    } else {
                        $this.anim(0);
                    }
                }

                setTimeout(function() {
                    $this.autoanim();
                }, wrapper.attr('data-interval'));
            };

            /* Run auto animation */
            if(wrapper.attr('data-autoanimation') === 'true') {
                setTimeout(function() {
                    $this.autoanim();
                }, wrapper.attr('data-interval'));
            }
            /* Touch events */
            var arts_pos_start_x = 0;
            var arts_pos_start_y = 0;
            var arts_time_start = 0;
            var arts_swipe = false;

            wrapper.bind('touchstart', function(e) {
                arts_swipe = true;
                var touches = e.originalEvent.changedTouches || e.originalEvent.touches;

                if(touches.length > 0) {
                    arts_pos_start_x = touches[0].pageX;
                    arts_pos_start_y = touches[0].pageY;
                    arts_time_start = new Date().getTime();
                }
            });

            wrapper.bind('touchmove', function(e) {
                var touches = e.originalEvent.changedTouches || e.originalEvent.touches;

                if(touches.length > 0 && arts_swipe) {
                    if(
                        Math.abs(touches[0].pageX - arts_pos_start_x) > Math.abs(touches[0].pageY - arts_pos_start_y)
                    ) {
                        e.preventDefault();
                    } else {
                        arts_swipe = false;
                    }
                }
            });

            wrapper.bind('touchend', function(e) {
                var touches = e.originalEvent.changedTouches || e.originalEvent.touches;

                if(touches.length > 0 && arts_swipe) {
                    if(
                        Math.abs(touches[0].pageX - arts_pos_start_x) >= $this.swipe_min_move &&
                        new Date().getTime() - arts_time_start <= $this.swipe_max_time
                    ) {
                        if(touches[0].pageX - arts_pos_start_x > 0 && $this.current_slide > 0) {
                            $this.anim($this.current_slide - 1);
                        } else if(touches[0].pageX - arts_pos_start_x < 0 && $this.current_slide < $this.slides.length - 1) {
                            $this.anim($this.current_slide + 1);
                        }
                    }
                }
            });
        }
    });
    // Tabs on the frontpage
    jQuery(document).find('.transparent-tabs > .gk-tabs').each(function (i, el) {
        el = jQuery(el);
        var animation_speed = el.attr('data-speed') * 0.2;
        var animation_interval = el.attr('data-interval') * 1.0;
        var autoanim = el.attr('data-autoanim');
        var eventActivator = el.attr('data-event');
        var active_tab = 0;

        var tabs = el.find('.gk-tabs-item');
        var items = el.find('.gk-tabs-nav li');
        var tabs_wrapper = jQuery(el.find('.gk-tabs-container')[0]);
        var current_tab = active_tab;
        var previous_tab = null;
        var amount = tabs.length;
        var blank = false;
        var falsy_click = false;
        var tabs_h = [];
        //
        jQuery(tabs).css('opacity', 0);
        jQuery(tabs[active_tab]).css({
            'opacity': '1',
            'position': 'relative',
            'z-index': 2
        });

        jQuery(tabs).each(function (i, item) {
            tabs_h[i] = jQuery(item).outerHeight();
        });

        // add events to tabs
        items.each(function (i, item) {
            item = jQuery(item);
            item.bind(eventActivator, function () {
                if (i !== current_tab) {
                    previous_tab = current_tab;
                    current_tab = i;
                    gkTabEventTrigger(current_tab, el.parent());

                    if (typeof gk_tab_event_trigger !== 'undefined') {
                        gk_tab_event_trigger(current_tab, previous_tab, el.parent().parent().attr('id'));
                    }

                    tabs_wrapper.css('height', tabs_wrapper.outerHeight() + 'px');

                    var previous_tab_animation = {
                        'opacity': 0
                    };
                    var current_tab_animation = {
                        'opacity': 1
                    };
                    //
                    jQuery(tabs[previous_tab]).animate(previous_tab_animation, animation_speed / 2, function () {
                        jQuery(tabs[previous_tab]).css({
                            'position': 'absolute',
                            'top': '0',
                            'z-index': '1'
                        });

                        jQuery(tabs[current_tab]).css({
                            'position': 'relative',
                            'z-index': '2'
                        });

                        jQuery(tabs[previous_tab]).removeClass('active');
                        jQuery(tabs[current_tab]).addClass('active');

                        tabs_wrapper.animate({
                                "height": tabs_h[i]
                            },
                            animation_speed / 2,
                            function () {
                                tabs_wrapper.css('height', 'auto');
                            });
                        //
                        setTimeout(function () {
                            // anim
                            jQuery(tabs[current_tab]).animate(current_tab_animation, animation_speed);
                        }, animation_speed / 2);
                    });
                    // common operations for both types of animation
                    if (!falsy_click) {
                        blank = true;
                    } else {
                        falsy_click = false;
                    }
                    jQuery(items[previous_tab]).removeClass('active');
                    jQuery(items[current_tab]).addClass('active');
                }
            });
        });
        //
        if (autoanim === 'enabled') {
            setInterval(function () {
                if (!blank) {
                    falsy_click = true;
                    if (current_tab < amount - 1) {
                        jQuery(items[current_tab + 1]).trigger(eventActivator);
                    } else {
                        jQuery(items[0]).trigger(eventActivator);
                    }
                } else {
                    blank = false;
                }
            }, animation_interval);
        }

    });


    // New parallax engine
    if(jQuery('body').hasClass('js-parallax') && jQuery(window).width() > 640) {
        var parallax_containers = [];
        var parallax_heights = [];
        var parallax_tops = [];
        var window_h = jQuery(window).outerHeight();
        var parallax_progress = [];
        var parallax_layers = [];

        jQuery('.parallax-bg').each(function(i, parallax_wrap) {
            parallax_wrap = jQuery(parallax_wrap);
            // check the wrapper
            if(!parallax_wrap.children('.box-wrap').length) {
                parallax_wrap.html('<div class="box-wrap">' + parallax_wrap.html() + '</div>');
            }
            // don't add position: relative to the tabs content
            if(!parallax_wrap.parent().hasClass('gk-tabs-item')) {
                parallax_wrap.parent().css('position', 'relative');
            }

            var content = parallax_wrap.children('.box-wrap');
            var parallax_layer = jQuery('<div class="parallax-bg-layer"></div>');
            parallax_layer.css('background-image', parallax_wrap.css('background-image'));
            parallax_wrap.css({
                'background-image': '',
                'z-index': '1'
            });
            parallax_layer.css({
                'width': '100%',
                'height': '150%',
                'position': 'absolute',
                'z-index': '0',
                'top': '0',
                'background-size': 'cover'
            });
            parallax_layer.appendTo(parallax_wrap.parent());
            parallax_containers.push(parallax_wrap);
        });

        jQuery(parallax_containers).each(function(i, container) {
            container = jQuery(container);

            parallax_heights.push(container.outerHeight());
            parallax_tops.push(container.offset().top);
            parallax_layers.push(jQuery(container.parent().find('.parallax-bg-layer')));
        });

        jQuery(window).resize(function() {
            parallax_heights = [];
            parallax_tops = [];

            jQuery(parallax_containers).each(function(i, container) {
                container = jQuery(container);
                parallax_heights.push(container.outerHeight());
                parallax_tops.push(container.offset().top);
            });
        });

        jQuery(window).scroll(function() {
            var scroll = jQuery(document).scrollTop();

            jQuery(parallax_tops).each(function(i, top) {
                if(
                    scroll >= top - window_h &&
                    scroll <= top + parallax_heights[i]
                ) {
                    var progress = (scroll - (top + window_h)) / (top + parallax_heights[i]);
                    jQuery(parallax_layers[i]).css('top', parallax_heights[i] * 0.6 * progress + 'px');
                }
            });
        });

        var scroll = jQuery(document).scrollTop();

        jQuery(parallax_tops).each(function(i, top) {
            if(
                scroll >= top - window_h &&
                scroll <= top + parallax_heights[i]
            ) {
                var progress = (scroll - (top + window_h)) / (top + parallax_heights[i]);
                jQuery(parallax_layers[i]).css('top', parallax_heights[i] * 0.6 * progress + 'px');
            }
        });
    }

function gk_quark_classic_menu_init() {
    var menu_ID = false;

        if ($('#gk-header-nav .nav-menu').length) {
            menu_ID = '#gk-header-nav .nav-menu';
        }

        if (menu_ID) {
            // fix for the iOS devices
            $(menu_ID + ' li').each(function (i, el) {

                if ($(el).children('.sub-menu').length > 0) {
                    $(el).addClass('haschild');
                }
            });
            // main element for the iOS fix - adding the onmouseover attribute
            // and binding with the data-dblclick property to emulate dblclick event on
            // the mobile devices
            $(menu_ID + ' li a').each(function (i, el) {
                el = $(el);

                el.attr('onmouseover', '');

                if (el.parent().hasClass('haschild') && $(document.body).attr('data-tablet') !== null) {
                    el.click(function (e) {
                        if (el.attr("data-dblclick") === undefined) {
                            e.stop();
                            el.attr("data-dblclick", new Date().getTime());
                        } else {
                            var now = new Date().getTime();
                            if (now - el.attr("data-dblclick") < 500) {
                                window.location = el.attr('href');
                            } else {
                                e.stop();
                                el.attr("data-dblclick", new Date().getTime());
                            }
                        }
                    });
                }
            });
            // main menu element handler
            var base = $(menu_ID);
            // if the main menu exists
            if (base.length > 0) {
                base.find('li.haschild').each(function (i, el) {
                    el = $(el);

                    if (el.children('.sub-menu').length > 0) {
                        var content = $(el.children('.sub-menu').first());
                        //var prevh = content.outerHeight();
                        var prevw = content.outerWidth();
                        var duration = 250;

                        var fxStart = {
                            //'height': 0,
                            'width': prevw,
                            'opacity': 0,
                            'display': 'none'
                        };
                        var fxEnd = {
                            //'height': prevh,
                            'width': prevw,
                            'opacity': 1,
                            'display': 'block'
                        };

                        content.css(fxStart);
                        content.css({
                            'left': 'auto',
                            'overflow': 'hidden',
                            'display': 'none'
                        });

                        el.mouseenter(function () {
                            content.css('display', 'block');

                            if (content.attr('data-base-margin') !== null) {
                                content.css({
                                    'margin-left': content.attr('data-base-margin') + "px"
                                });
                            }

                            var pos = content.offset();
                            var winWidth = $(window).outerWidth();
                            var winScroll = $(window).scrollLeft();

                            if (pos.left + prevw > (winWidth + winScroll)) {
                                var diff = (winWidth + winScroll) - (pos.left + prevw) - 5;
                                var base = parseInt(content.css('margin-left'), 10);
                                var margin = base + diff;

                                if (base > 0) {
                                    margin = -prevw + 10;
                                }
                                content.css('margin-left', margin + "px");

                                if (content.attr('data-base-margin') === null) {
                                    content.attr('data-base-margin', base);
                                }
                            }
                            //
                            content.stop(false, false, false);

                            content.stop().animate(
                                fxEnd,
                                {
                                    "duration": duration,
                                    "queue": false,
                                    "complete": function() {
                                                    if(content.outerHeight() === 0){
                                                        content.css('overflow', 'hidden');
                                                    } else if(
                                                        content.outerHeight(true) - prevh < 30 &&
                                                        content.outerHeight(true) - prevh >= 0
                                                    ) {
                                                        content.css('overflow', 'visible');
                                                    }
                                                }
                                }
                            );
                        });
                        el.mouseleave(function () {
                            content.css({
                                'overflow': 'hidden',
                                'display': 'none'
                            });
                            //
                            content.stop().animate(
                                fxStart,
                                {
                                    "duration": duration,
                                    "queue": false,
                                    "complete": function() {
                                                    if(content.outerHeight() === 0){
                                                        content.css('overflow', 'hidden');
                                                    } else if(
                                                        content.outerHeight(true) - prevh < 30 &&
                                                        content.outerHeight(true) - prevh >= 0
                                                    ) {
                                                        content.css('overflow', 'visible');
                                                    }
                                                    content.css('display', 'none');
                                                }
                                }
                            );
                        });
                    }
                });

                base.find('li.haschild').each(function (i, el) {
                    el = $(el);
                    var content = $(el.children('.sub-menu').first());
                    content.css({
                        'display': 'none'
                    });
                });


            }
        }
    }

})(jQuery);

jQuery(document).ready(function(){
    jQuery(".owl-carousel").owlCarousel(
      {
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true
      }
    );
// PhotoSwipe script
    var initPhotoSwipeFromDOM = function(gallerySelector) {
        // parse slide data (url, title, size ...) from DOM elements
        // (children of gallerySelector)
        var parseThumbnailElements = function(el) {
            var thumbElements = jQuery(el).find('a'),
                numNodes = thumbElements.length,
                items = [],
                figureEl,
                linkEl,
                size,
                item;

            thumbElements.each(function(i, link) {
                link = jQuery(link);
                size = link.attr('data-size').split('x');

                // create slide object
                item = {
                    src: link.attr('href'),
                    w: parseInt(size[0], 10),
                    h: parseInt(size[1], 10)
                };

                if(link.attr('data-title') || link.attr('data-desc')) {
                    item.title = '';

                    if(link.attr('data-title')) {
                        item.title += '<h3>' + link.attr('data-title') + '</h3>';
                    }

                    if(link.attr('data-desc')) {
                        item.title += '<span>' + link.attr('data-desc') + '</span>';
                    }
                }

                item.msrc = link.find('img').first().attr('src');
                item.el = link; // save link to element for getThumbBoundsFn
                // Detect the data-order attribute
                if(
                   jQuery(window).outerWidth() > jQuery(document.body).attr('data-mobile-width') &&
                   link.attr('data-order')
               ) {
                    items[parseInt(link.attr('data-order'), 10) - 1] = item;
                } else {
                    items.push(item);
                }
            });

            return items;
        };

        // find nearest parent element
        var closest = function closest(el, fn) {
            return el && ( fn(el) ? el : closest(el.parentNode, fn) );
        };

        // triggers when user clicks on thumbnail
        var onThumbnailsClick = function(e) {
            e.preventDefault();
            // find root element of slide
            var clickedListItem = closest(e.target, function(el) {
                return (el.tagName && el.tagName.toUpperCase() === 'A');
            });

            if(!clickedListItem) {
                return;
            }

            // find index of clicked item by looping through all child nodes
            // alternatively, you may define index via data- attribute
            var clickedGallery = jQuery(clickedListItem).parents('.gk-gallery'),
                childNodes = clickedGallery.find('a'),
                numChildNodes = childNodes.length,
                nodeIndex = 0,
                index;

            for (var i = 0; i < numChildNodes; i++) {
                if(childNodes[i] === clickedListItem) {
                    index = nodeIndex;
                    break;
                }
                nodeIndex++;
            }

            if(
               jQuery(window).outerWidth() > jQuery(document.body).attr('data-mobile-width') &&
               clickedListItem.hasAttribute('data-order')
            ) {
                    index = parseInt(clickedListItem.getAttribute('data-order'), 10) - 1;
                }

            if(index >= 0) {
                // open PhotoSwipe if valid index found
                openPhotoSwipe( index, clickedGallery );
            }
            return false;
        };

        // parse picture index and gallery index from URL (#&pid=1&gid=2)
        var photoswipeParseHash = function() {
            var hash = window.location.hash.substring(1),
            params = {};

            if(hash.length < 5) {
                return params;
            }

            var vars = hash.split('&');
            for (var i = 0; i < vars.length; i++) {
                if(!vars[i]) {
                    continue;
                }
                var pair = vars[i].split('=');
                if(pair.length < 2) {
                    continue;
                }
                params[pair[0]] = pair[1];
            }

            if(params.gid) {
                params.gid = parseInt(params.gid, 10);
            }

            if(!params.hasOwnProperty('pid')) {
                return params;
            }
            params.pid = parseInt(params.pid, 10);
            return params;
        };

        var openPhotoSwipe = function(index, galleryElement, disableAnimation) {
            var pswpElement = document.querySelectorAll('.pswp')[0],
                gallery,
                options,
                items;

            items = parseThumbnailElements(galleryElement);

            // define options (if needed)
            options = {
                index: index,

                // define gallery index (for URL)
                galleryUID: jQuery(galleryElement).attr('data-pswp-uid'),

                getThumbBoundsFn: function(index) {
                    // See Options -> getThumbBoundsFn section of documentation for more info
                    var thumbnail = items[index].el.find('img').first(), // find thumbnail
                        rect = {
                            "left": thumbnail.offset().left,
                            "top": thumbnail.offset().top,
                            "width": thumbnail.outerWidth()
                        };
                    return {x:rect.left, y:rect.top, w:rect.width};
                }

            };

            if(disableAnimation) {
                options.showAnimationDuration = 0;
            }

            // Pass data to PhotoSwipe and initialize it
            gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
            gallery.init();
        };

        // loop through all gallery elements and bind events
        var galleryElements = jQuery(gallerySelector);

        for(var i = 0, l = galleryElements.length; i < l; i++) {
            galleryElements[i].setAttribute('data-pswp-uid', i+1);
            galleryElements[i].onclick = onThumbnailsClick;
        }

        // Parse URL and open gallery if it contains #&pid=3&gid=1
        var hashData = photoswipeParseHash();
        if(hashData.pid > 0 && hashData.gid > 0) {
            openPhotoSwipe( hashData.pid - 1 ,  galleryElements[ hashData.gid - 1 ], true );
        }
    };

    // execute above function if the gallery elements exists
    if(jQuery('.gk-gallery').length) {
        initPhotoSwipeFromDOM(jQuery('.gk-gallery'));
    }
});

// Page preloader
jQuery(window).on("load pageshow", function() {
    if(jQuery('#gk-page-preloader').length > 0) {
        var preloader = jQuery('#gk-page-preloader');
        setTimeout(function() {
            preloader.addClass('gk-to-hide');

            setTimeout(function() {
                preloader.addClass('gk-hidden');
            }, 500);
        }, 500);
    }
});

jQuery(window).on('beforeunload', function() {
    if(jQuery('#gk-page-preloader').length > 0) {
        var preloader = jQuery('#gk-page-preloader');
        preloader.removeClass('gk-hidden');

        setTimeout(function() {
            preloader.removeClass('gk-to-hide');
        }, 25);
    }
});

