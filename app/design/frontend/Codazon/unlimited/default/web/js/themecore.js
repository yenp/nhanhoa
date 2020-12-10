/**
 * Copyright © 2017 Codazon, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

require(['jquery', 'owlslider'], function($, owlSlider) {

!function(a,b,c,d){var e=a(b);a.fn.lazyload=function(f){function g(){var b=0;i.each(function(){var c=a(this);if(!j.skip_invisible||c.is(":visible"))if(a.abovethetop(this,j)||a.leftofbegin(this,j));else if(a.belowthefold(this,j)||a.rightoffold(this,j)){if(++b>j.failure_limit)return!1}else c.trigger("appear"),b=0})}var h,i=this,j={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:b,data_attribute:"original",skip_invisible:!0,appear:null,load:null,placeholder:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"};return f&&(d!==f.failurelimit&&(f.failure_limit=f.failurelimit,delete f.failurelimit),d!==f.effectspeed&&(f.effect_speed=f.effectspeed,delete f.effectspeed),a.extend(j,f)),h=j.container===d||j.container===b?e:a(j.container),0===j.event.indexOf("scroll")&&h.bind(j.event,function(){return g()}),this.each(function(){var b=this,c=a(b);b.loaded=!1,(c.attr("src")===d||c.attr("src")===!1)&&c.is("img")&&c.attr("src",j.placeholder),c.one("appear",function(){if(!this.loaded){if(j.appear){var d=i.length;j.appear.call(b,d,j)}a("<img />").bind("load",function(){var d=c.attr("data-"+j.data_attribute);c.hide(),c.is("img")?c.attr("src",d):c.css("background-image","url('"+d+"')"),c[j.effect](j.effect_speed),b.loaded=!0;var e=a.grep(i,function(a){return!a.loaded});if(i=a(e),j.load){var f=i.length;j.load.call(b,f,j)}}).attr("src",c.attr("data-"+j.data_attribute))}}),0!==j.event.indexOf("scroll")&&c.bind(j.event,function(){b.loaded||c.trigger("appear")})}),e.bind("resize",function(){g()}),/(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion)&&e.bind("pageshow",function(b){b.originalEvent&&b.originalEvent.persisted&&i.each(function(){a(this).trigger("appear")})}),a(c).ready(function(){g()}),this},a.belowthefold=function(c,f){var g;return g=f.container===d||f.container===b?(b.innerHeight?b.innerHeight:e.height())+e.scrollTop():a(f.container).offset().top+a(f.container).height(),g<=a(c).offset().top-f.threshold},a.rightoffold=function(c,f){var g;return g=f.container===d||f.container===b?e.width()+e.scrollLeft():a(f.container).offset().left+a(f.container).width(),g<=a(c).offset().left-f.threshold},a.abovethetop=function(c,f){var g;return g=f.container===d||f.container===b?e.scrollTop():a(f.container).offset().top,g>=a(c).offset().top+f.threshold+a(c).height()},a.leftofbegin=function(c,f){var g;return g=f.container===d||f.container===b?e.scrollLeft():a(f.container).offset().left,g>=a(c).offset().left+f.threshold+a(c).width()},a.inviewport=function(b,c){return!(a.rightoffold(b,c)||a.leftofbegin(b,c)||a.belowthefold(b,c)||a.abovethetop(b,c))},a.extend(a.expr[":"],{"below-the-fold":function(b){return a.belowthefold(b,{threshold:0})},"above-the-top":function(b){return!a.belowthefold(b,{threshold:0})},"right-of-screen":function(b){return a.rightoffold(b,{threshold:0})},"left-of-screen":function(b){return!a.rightoffold(b,{threshold:0})},"in-viewport":function(b){return a.inviewport(b,{threshold:0})},"above-the-fold":function(b){return!a.belowthefold(b,{threshold:0})},"right-of-fold":function(b){return a.rightoffold(b,{threshold:0})},"left-of-fold":function(b){return!a.rightoffold(b,{threshold:0})}})}(jQuery,window,document);

    $('body').on('contentUpdated', function () {
        require(['mage/apply/main'], function(mage) {
            if (mage) {
                mage.apply();
            }
        });
    });
    
    /* Common value */
    var mBreakpoint = 768,
    $window = $(window), winwidth = window.innerWidth, deskPrefix = 'desk_', mobiPrefix = 'mobi_', disHovImg = $('body').hasClass('product-disable-hover-img'),
    deskEvent = 'cdz_desktop', mobiEvent = 'cdz_mobile', winWidthChangedEvent = 'cdz_window_width_changed';
    
    /* jQuery functions */
    $.fn.searchToggle = function(options) {
        var defaultConf = {
            toggleBtn: '[data-role=search_toggle]',
            searchForm: '[data-role=search_form]',
            toggleClass: 'input-opened',
            mbClass: 'mb-search'
        };
        var conf = $.extend({}, defaultConf, options);
        return this.each(function() {
            var $element = $(this),
            $searchForm = $(conf.searchForm, $element),
            $searchBtn = $(conf.toggleBtn, $element);
            var mbSearch = function() {
                $element.addClass(conf.mbClass);
                $searchForm.removeClass('hidden-xs');
            };
            var dtSearch = function() {
                $element.removeClass(conf.mbClass);
                $searchForm.addClass('hidden-xs');
            };
            if (themecore.isMbScreen()) {
                mbSearch();
            } else {
                dtSearch();
            }
            $window.on(deskEvent, dtSearch).on(mobiEvent, mbSearch);
            $searchBtn.on('click', function() {
                $element.toggleClass(conf.toggleClass);
            });
        });
    }
    

    
    /* Common functions */
    window.themecore = function() {
        return this;
    };
    themecore.stickyMenu = function() {
        $('.js-sticky-menu').attr('data-mage-init', '{"themewidgets": {"codazon.stickyMenu": {}}}');
    }
    themecore.backToTop = function() {
        if ($('#back-top').length == 0) {
            $('<div id="back-top" class="back-top" data-role="back_top"><a title="Top" href="#top">Top</a></div>').appendTo('body');
        }
        $('[data-role="back_top"]').each(function() {
            var $bt = $(this);
            $bt.click(function(e) {
                e.preventDefault();
                $('html, body').animate({'scrollTop':0},800);
            });
            function toggleButton(hide) {
                if(hide){
                    $bt.fadeOut(300);
                }else{
                    $bt.fadeIn(300);
                }
            }
            var hide = ($(window).scrollTop() < 100);
            toggleButton(hide);
            $(window).scroll(function() {
                var newState = ($(window).scrollTop() < 100);
                if(newState != hide){
                    hide = newState;
                    toggleButton(hide);
                }
            });
        });
    }
    themecore.b64DecodeUnicode = function(str) {
        return decodeURIComponent(Array.prototype.map.call(atob(str), function (c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
    };
    themecore.isMbScreen = function(breakpoint) {
        if (typeof breakpoint === 'undefined') {
            breakpoint = mBreakpoint;
        }
        return (window.innerWidth < breakpoint);
    };
    themecore.isDtScreen = function(breakpoint) {
        if (typeof breakpoint === 'undefined') {
            breakpoint = mBreakpoint;
        }
        return (window.innerWidth >= breakpoint);
    };
    themecore.triggerAdaptScreen = function(breakpoint) {
        var self = this;
        if (typeof breakpoint === 'undefined') {
            breakpoint = mBreakpoint;
        }
        var eventSuffix =  (breakpoint == mBreakpoint)? '' : '_' + breakpoint;
        var winwidth = window.innerWidth;
        var triggerMedia = function() {
            if (self.isMbScreen(breakpoint)) {
                $window.trigger(mobiEvent + eventSuffix);
            } else {
                $window.trigger(deskEvent + eventSuffix);
            }
        }
        var checkAdpatChange = function() {
            var curwidth = window.innerWidth;
            if ( ((winwidth < breakpoint) && (curwidth >= breakpoint) ) || 
               ( (winwidth >= breakpoint) && (curwidth < breakpoint)) )
            {
                $window.trigger('adaptchange' + eventSuffix);
                triggerMedia();
            }
            winwidth = curwidth;
        }
        var t = false;
        $window.resize(function() {
            if(t) clearTimeout(t);
            t = setTimeout(function() {
                checkAdpatChange();
            }, 50);
        });
        triggerMedia();
    };
    themecore.autoTrigger = function() {
        $('body').on('click', '[data-autotrigger]', function(e) {
            e.preventDefault();
            var $trigger = $(this), $triggerTarget = $($trigger.data('autotrigger')).first();
            $triggerTarget.trigger('click');
        });
    }
    themecore.moveElToNewContainer = function(fromPrefix, toPrefix) {
        $('[id^="' + fromPrefix + '"]').each(function() {
            var $element = $(this),
            $children = $element.children(),
            fromId = $element.attr('id'),
            toId = toPrefix + fromId.substr(fromPrefix.length);
            $children.appendTo('#' +toId);
        });
    };
    themecore.moveFromSourceElement = function() {
        $('[data-movefrom]').each(function() {
            var $dest = $(this), $source = $($dest.data('movefrom')).first();
            $dest.replaceWith($source);
        });
    };
    themecore.setupMobile = function() {
        themecore.moveElToNewContainer(deskPrefix, mobiPrefix);
    };
    themecore.setupDesktop = function() {
        themecore.moveElToNewContainer(mobiPrefix, deskPrefix);
    };
    themecore.lazyImage = function() {        
        $('[data-role=lazy-img]').each(function() {
            var $img = $(this);
            if ($img.hasClass('product-image-photo hovered-img') && disHovImg) {
                $img.remove();
            } else {
                $img.attr('src', $img.data('src')).removeAttr('data-role').removeAttr('data-src');
            }
        });
    };
    themecore.qtyControl = function() {
        $('body').off('click.cdzQtyControl').on('click.cdzQtyControl','[data-role=change_cart_qty]', function (e) {
            var $btn = $(this);
            if ($btn.data('role') != 'change_cart_qty') {
                $btn = $btn.parents('[data-role=change_cart_qty]').first();
            }
            var qty = $btn.data('qty'),
            $pr = $btn.parents('.cart-qty').first(),
            $qtyInput = $('input.qty',$pr),
            curQty = $qtyInput.val()?parseInt($qtyInput.val()):0;
            curQty += qty;
            (curQty < 1) ? (curQty = 1) : null;
            $qtyInput.val(curQty).attr('value', curQty).trigger('change');
        });
    }
    
    themecore.winWidthChangedEvent = function() {
        var curwidth = window.innerWidth;
        $(window).on('resize', function() {
            if (window.innerWidth != curwidth) {
                curwidth = window.innerWidth;
                $(window).trigger(winWidthChangedEvent, [curwidth]);
            }
        });
    };
    themecore.scrollTo = function() {
        $('body').on('click', '[data-scollto]', function(e) {
            e.preventDefault();
            var $button = $(this);
            var $dest = $($button.data('scollto'));
            if ($dest.is(':visible')) {
                $('html, body').animate({scrollTop: $dest.offset().top - 100}, 300);
            } else {
                console.log($dest);
                if ($dest.parents('[role=tabpanel]').length) {
                    $('a.switch[href="#' + $dest.parents('[role=tabpanel]').first().attr('id') + '"]').click();
                    setTimeout(function() {
                        $('html, body').animate({scrollTop: $dest.offset().top - 100}, 300);
                    }, 300);
                }
            }
        });
    };
    themecore.updateFormKey = function() {
        var formKey = $('input[name="form_key"]').first().val();
        $('.product-item form [name="form_key"]').val(formKey);
    }
    
    themecore.cdzLazyImage = function() {
        $('[data-lazysrc]').each(function() {
            var $img = $(this);
            if ($img.attr('width') && $img.attr('height') && (!$img.parent().hasClass('abs-img'))) {
                $img.wrap($('<span class="abs-img">').css({paddingBottom: (100*$img.attr('height'))/$img.attr('width') + '%'}));
            }
            $img.attr('data-original', $img.data('lazysrc')).removeAttr('data-lazysrc').lazyload();
        });
    }
    
    themecore.init = function() {
        var self = this;
        this.triggerAdaptScreen();
        this.triggerAdaptScreen(1200);
        this.winWidthChangedEvent();
        var sht = false;
        $window.on(deskEvent, this.setupDesktop)
            .on(mobiEvent, this.setupMobile)
            .on(winWidthChangedEvent, function() {
                if (sht) clearTimeout(sht);
                sht = setTimeout(self.makeSameHeight, 300);
            });
        self.cdzLazyImage();
        $('body').on('contentUpdated cdzResize', function() {
            if (sht) clearTimeout(sht);
                sht = setTimeout(self.makeSameHeight, 100);
            self.cdzLazyImage();
        });
        if (this.isMbScreen()) {
            this.setupMobile();
        } else {
            this.setupDesktop();
        }
        
		this.toggleMobileMenu();
        this.verticalMenu();
        this.autoTrigger();
        this.qtyControl();
        this.sectionMenu();
        this.remoteSliderNav();
        
        this.backToTop();
        this.scrollTo();
        this.mobiProductViewTabs();
        
        $(document).ready(function() {
            self.mbtoolbar();
            self.toggleContent();
            self.moveFromSourceElement();
            self.attachCustomerInfo();
            if (self.isMbScreen()) {
                self.setupMobile();
            } else {
                self.setupDesktop();
            }
        });
        $('body').on('contentUpdated', function() {
            self.toggleContent();
            self.lazyImage();
        });
        
        self.makeSameHeight();
        var onLoaded = function () {
            self.ajaxHandler();
            self.stickyMenu();
            self.makeSameHeight();
            self.updateFormKey();
            self.qtyControl();
            setTimeout(self.lazyImage, 500);
        }
        if (window.windowLoaded) {
            onLoaded();
        } else {
            $(window).on('load', onLoaded);
        }
    };
    themecore.ajaxHandler = function() {
        $(document).ajaxStart(function() {
            $('body').addClass('cdz-ajax-loading');
        });
        $(document).ajaxStop(function() {
            $('body').removeClass('cdz-ajax-loading');
        });
    };
    themecore.remoteSliderNav = function() {
        $('body').on('click', '[data-targetslider]', function() {
            var $btn = $(this), sliderId = $btn.data('targetslider'),
            $slider = $('#' + sliderId).find('.owl-carousel');
            if ($slider.length) {
                if ($btn.hasClass('owl-prev')) {
                    $slider.trigger('prev.owl.carousel');
                } else {
                    $slider.trigger('next.owl.carousel');
                }
            }
        });
    };
    themecore.attachCustomerInfo = function() {
        function loadCustomerInfo() {
            if ($('[data-customerinfo]').length) {
                $.ajax({
                    url: codazon.customerDataUrl,
                    type: "get",
                    cache: false,
                    success: function(data) {
                        if (data.customer) {
                            var customer = data.customer;
                            if (customer) {
                                $('[data-customerinfo]').each(function() {
                                    var $info = $(this), info = $info.data('customerinfo');
                                    $info.removeAttr('data-customerinfo');
                                    if (customer[info]) {
                                        $info.replaceWith(customer[info].replace(/(<([^>]+)>)/ig,''));
                                    }
                                });
                            }
                        }
                    }
                });
            }
        }
        loadCustomerInfo();
        $('body').on('contentUpdated', loadCustomerInfo);
    };
    themecore.mbtoolbar = function() {
        var $toolbar = $('#mb-bottom-toolbar');
        var $btnSlider = $('[data-role=group-slider]', $toolbar);
        var $switcher = $('[data-role=switch-group]');
        var clicked = false;
        $btnSlider.owlCarousel({
            items: 1,
            dots: false,
            nav: false,
            animateIn: 'changing',
            animateOut: false,
            touchDrag: false,
            mouseDrag: false,
            rtl: $('body').hasClass('rtl-layout'),
            onChanged: function(property) {
                if (clicked) {
                    var dotsCount = $switcher.find('.dot').length;
                    $switcher.toggleClass('return');
                    $switcher.find('.dot').each(function(i, el){
                        var $dot = $(this);
                        setTimeout(function() {
                            $dot.removeClass('wave-line').addClass('wave-line');
                            setTimeout(function() {
                                $dot.removeClass('wave-line');
                            }, 1000);
                        }, i*100);
                    });
                    setTimeout(function() {
                        $btnSlider.find('.owl-item').removeClass('changing animated');
                    },300);
                    clicked = false;
                }
            }
        });
        var owl = $btnSlider.data('owl.carousel');
        var slideTo = 0;
        $switcher.on('click', function(e) {
            clicked = true;
            e.preventDefault();
            slideTo = !slideTo;
            owl.to(slideTo, 1, true);
        });
        var $currentDisplay = false, $currentPlaceholder = $('<div class="mb-toolbar-placeholder">').hide().appendTo('body');
        var $toolbarContent = $toolbar.find('[data-role=mb-toolbar-content]').first();
        var eventType = (typeof window.orientation == 'undefined') ? 'click' : 'touchend';
        $toolbar.find('[data-action]').on(eventType, function(e) {
            e.preventDefault();
            var $btn = $(this);
            var action = $btn.data('action');
            if (action.display) {
                if (!$toolbar.hasClass('content-opened')) {
                    $toolbar.addClass('content-opened');
                    if (action.display.element) {
                        if ($(action.display.element).length) {
                            $currentDisplay = $(action.display.element).first();
                            $currentPlaceholder.insertBefore($currentDisplay);
                            $currentDisplay.appendTo($toolbarContent);
                        }
                    }
                } else {
                    $toolbar.removeClass('content-opened')
                    if ($currentDisplay) {
                        $currentDisplay.insertAfter($currentPlaceholder);
                        $currentDisplay = false;
                    }
                }
            }
            if (action.trigger) {
                $(action.trigger.target).trigger(action.trigger.event);
            }
        });
        $toolbar.on('click', '[data-role=close-content]', function() {
            $toolbar.removeClass('content-opened');
            if ($currentDisplay) {
                $currentDisplay.insertAfter($currentPlaceholder);
                $currentDisplay = false;
            }
        });
    };
    themecore.makeSameHeight = function() {
        $('[data-sameheight]').each(function() {
            var $element = $(this);
            if ($element.is(':visible')) {
                var sameHeightArray = $element.data('sameheight').split(',');
                $.each(sameHeightArray, function(i, sameHeight) {
                    var maxHeight = 0;
                    $element.find(sameHeight).css({minHeight: ''}).each(function() {
                        var $sItem = $(this);
                        var height = $sItem.outerHeight();
                        if (height > maxHeight) {
                            maxHeight = height;
                        }
                    }).css({minHeight: maxHeight});
                });
            }
        });
    };
    themecore.sectionMenu = function() {
        if ($('[data-secmenuitem]').length) {
            var processing = false;
            var topSpace = 100;
            var $wrap = $('<div class="section-menu-wrap hidden-xs">');
            var $menu = $('<div class="section-menu">');
            $wrap.appendTo('body');
            $menu.appendTo($wrap);
            var sections = [];
            $('[data-secmenuitem]').each(function() {
                var $section = $(this);
                var $menuItem = $('<div class="menu-item">');
                var data = $section.data('secmenuitem');
                var icon = data.icon, title = data.title;
                $menuItem.html('<i class="' + icon + '"></i>');
                if (title) {
                    $menuItem.append('<div class="item-label"><span>' + title + '</span></div>');
                }
                $menuItem.appendTo($menu);
                $menuItem.on('click', function() {
                    if (!processing) {
                        var sectionTop = $section.offset().top - topSpace;
                        $menuItem.addClass('active').siblings().removeClass('active');
                        processing = true;
                        $('html, body').animate({scrollTop: sectionTop}, 300, 'linear', function() {
                            setTimeout(function() {
                                processing = false;
                            },100);
                        });
                    }
                });
                $section.removeAttr('data-secmenuitem');
                sections.push({
                    menuItem: $menuItem,
                    section: $section
                });
            });
            
            var title = 'Back to Top';
            var $home = $('<div class="menu-item go-top"><i class="sec-icon fa fa-arrow-circle-up"></i></div>')
                .append('<div class="item-label"><span>' + title + '</span></div>')
                .prependTo($menu).on('click', function() {
                $('html, body').animate({scrollTop: 0});
            });
            if ($window.scrollTop() > window.innerHeight - topSpace) {
                $wrap.addClass('open');
            } else {
                $wrap.removeClass('open');
            }
            $window.on('scroll', function() {
                if (themecore.isDtScreen() && !processing) {
                    $.each(sections, function(id, item) {                        
                        var elTop = item.section.offset().top - topSpace,
                        elBot = elTop + item.section.outerHeight(),
                        winTop = $window.scrollTop(),
                        winBot = winTop + window.innerHeight;
                        
                        if (winTop > window.innerHeight - topSpace) {
                            $wrap.addClass('open');
                        } else {
                            $wrap.removeClass('open');
                        }
                        var cond1 = (elTop <= winTop) && (elBot >= winTop);
                        var cond2 = (elTop >= winTop) && (elTop <= winBot);
                        var cond3 = (elTop >= winTop) && (elBot <= winBot);
                        var cond4 = (elTop <= winTop) && (elBot >= winBot);
                        if (cond1 || cond2 || cond3 || cond4) {
                            item.menuItem.addClass('active').siblings().removeClass('active');
                            return false;
                        }
                    });
                }
            });
        }
    }
    themecore.checkVisible = function($element){
        var cond1 = ($element.get(0).offsetWidth > 0) && ($element.get(0).offsetHeight > 0);
        var cond2 = ($element.is(':visible'));
        var winTop = $(window).scrollTop(),
        winBot = winTop + window.innerHeight,
        elTop = $element.offset().top,
        elHeight = $element.outerHeight(true),
        elBot = elTop + elHeight;
        var cond3 = (elTop <= winTop) && (elBot >= winTop),
        cond4 = (elTop >= winTop) && (elTop <= winBot),
        cond5 = (elTop >= winTop) && (elBot <= winBot),
        cond6 = (elTop <= winTop) && (elBot >= winBot),
        cond7 = true;
        if ($element.parents('md-tab-content').length > 0) {
            cond7 = $element.parents('md-tab-content').first().hasClass('md-active');
        }
        return cond1 && cond2 && (cond3 || cond4 || cond5 || cond6) && cond7;
    };
    themecore.toggleContent = function() {
        var self = this;
        $('[data-cdz-toggle]').each(function() {            
            var $link = $(this),
            contentId = $link.data('cdz-toggle').replace('#', ''),
            $content = $('#' + contentId);
            if ($content.length) {
                $content.attr('data-role', 'cdz-toggle-content');
                $link.removeAttr('data-cdz-toggle');
                $link.on('click', function() {
                    if (self.isMbScreen()) {
                        $content.toggleClass('active');
                        if ($content.hasClass('active')) {
                            $link.addClass('active');
                        } else {
                            $link.removeClass('active');
                        }
                        $content.slideToggle(300);
                    }
                });
                $window.on(deskEvent, function() {
                    $link.removeClass('active');
                });
            }
        });
        $('[data-role=cdz-toggle-content]').each(function() {
            var $content = $(this);
            if (self.isMbScreen()) {
                $content.hide();
            }
            $window.on(deskEvent, function() {
                $content.css({display: ''}).removeClass('active');
            }).on(mobiEvent, function() {
                $content.css({display: 'none'}).removeClass('active');
            });
            $content.removeAttr('data-role');
        });
    };
    
    themecore.mobiProductViewTabs = function() {
        if ($('body').hasClass('catalog-product-view')) {
            $('body').on('click', '.product.info.detailed a.data.switch', function() {
                if (window.innerWidth < mBreakpoint) {
                    var $tab = $(this);
                    setTimeout(function() {
                        if ($tab.offset().top < window.scrollY) {
                            $('html, body').animate({'scrollTop': ($tab.offset().top - 100)}, 300);
                        }
                    }, 150);
                }
            });
        }
    };
    themecore.verticalMenu = function () {
        if (window.codazon.alignVerMenuHeight) {
            function alignMenu($menu) {
                var $menuwrap = $menu.parents('[data-role=menu-content]').first();
                if ($menuwrap.length && $menuwrap.parents('.column.main').length) {
                    var $slideshow = $('[data-role="cdz-slideshow"]').first(), height, t = false, eventName = winWidthChangedEvent + '.vmenu lazyLoadInitialized.vmenu';
                    cont = $menuwrap.data('align_container'), $cont = $(cont); $menu.addClass('aligned');
                    if ($cont.length == 0) {
                        $cont = $slideshow.parent();
                    }
                    if ($cont.length) {
                        var calcHeight = function() {
                            $menuwrap.removeClass('fixed-height-menu');
                            $menu.css('position', 'absolute');
                            height = $cont.outerHeight(false);
                            $menu.css('position', '');
                            var menuHeight = $menu.height();
                            if (height < menuHeight) {
                                $menuwrap.addClass('fixed-height-menu').css({height: height});
                            }
                        }
                        calcHeight();
                        $(window).off(eventName).on(eventName, function(e) {
                            if (t) clearTimeout(t);
                            $menuwrap.removeClass('fixed-height-menu').css({height: ''});
                            t = setTimeout(calcHeight, 500);
                        });
                    }
                }
            }
            $('.column.main [data-role=menu-content] .cdz-menu').each(function() {
                alignMenu($(this));
            });
            $('body').on('cdzmenu.initialized', function(e, $menu) {
                alignMenu($menu);
            });
        }
    };
    themecore.toggleMobileMenu = function() {
		$('[data-role=menu-title]').each(function() {
			var $title = $(this),
			$menu = $title.parent().find('[data-role=menu-content]');
			$menu.removeClass('hidden-xs');
			var onMobile = function() {
				$menu.hide();
			}
			var onDesktop = function() {
				$menu.css({display: ''});
			}
			var toggle = function() {
				if (window.innerWidth < mBreakpoint) {
					onMobile();
				} else {
					onDesktop();
				}
			}
			$title.on('click', function() {
				if (window.innerWidth < mBreakpoint) {
					$menu.slideToggle(200);
				}
			});
			$(window).on(mobiEvent, function() {
				onMobile();
			}).on(deskEvent, function(){
				onDesktop();
			});
			toggle();
		});
	}
    themecore.init();
    /* Handler */
});