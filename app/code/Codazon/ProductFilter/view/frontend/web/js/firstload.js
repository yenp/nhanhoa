/**
 * Copyright © 2020 Codazon, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
define([
    "jquery", "jquery-ui-modules/widget", "domReady!",
],function ($) {
    $.widget('codazon.firstLoad', {
        options: {
            ajaxUrl: null,
            jsonData: null,
            currentUrl: '',
            formKeyInputSelector: 'input[name="form_key"]'
        },
        _checkVisible: function() {
            var $element = this.element;
            var cond1 = ($element.get(0).offsetWidth > 0) && ($element.get(0).offsetHeight > 0),
            cond2 = ($element.is(':visible'));
            var winTop = $(window).scrollTop(),
            winBot = winTop + window.innerHeight,
            elTop = $element.offset().top, elHeight = $element.outerHeight(true),
            elBot = elTop + elHeight;
            var cond3 = (elTop <= winTop) && (elBot >= winTop),
            cond4 = (elTop >= winTop) && (elTop <= winBot), cond5 = (elTop >= winTop) && (elBot <= winBot),
            cond6 = (elTop <= winBot) && (elBot >= winBot), cond7 = true;
            if ($element.parents('md-tab-content').length) {
                cond7 = $element.parents('md-tab-content').first().hasClass('md-active');
            }
            return cond1 && cond2 && (cond3 || cond4 || cond5 || cond6) && cond7;
        },
        _create: function() {
            this.formKey = $(this.options.formKeyInputSelector).first().val();
            this._bindEvents();
        },
        _bindEvents: function() {
            var self = this;
            this._checkVisible() ? this._ajaxFirstLoad() : setTimeout(function() {
                self._bindEvents();
            }, 500);
        },
        _ajaxFirstLoad: function() {
            var self = this;
            var config = this.options;
            config.jsonData.current_url = config.currentUrl;
            $.ajax({
                url: config.ajaxUrl,
                type: "POST",
                data: config.jsonData,
                cache: false,
                success: function(res){
                    if (typeof res.now !== 'undefined') {
                        window.codazon.now = res.now;
                    }
                    if (typeof res.html !== 'undefined') {
                        self.formKey = $(config.formKeyInputSelector).first().val();
                        self.element.html(res.html).removeClass('no-loaded');
                        $('body').trigger('contentUpdated');
                        self.element.find('[name="form_key"]').each(function() {
                            var $field = $(this).val(self.formKey);
                        });
                        $('body').trigger('ajaxProductFirstTimeLoaded');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){
                    console.error(textStatus);
                }
            });
        }
    });
    return $.codazon.firstLoad;
});
