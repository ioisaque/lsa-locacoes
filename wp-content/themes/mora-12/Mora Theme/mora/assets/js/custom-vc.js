function mora_leftside() {
    'use strict';
    var mora_window = jQuery(window).width();
    if(mora_window < 1120) {
        var mora_leftmenu_height = jQuery('#mora-left-side.is-mobile').outerHeight();
        jQuery('#page').css({'padding-top': mora_leftmenu_height});
    }
    else {
        jQuery('#page').css({'padding-top': 0});
    }    
}

jQuery(document).ready(function() {
    mora_leftside();
    jQuery(window).on('resize',mora_leftside);    
});



if ( 'function' !== typeof(window[ 'vc_rowBehaviour' ]) ) {
    'use strict';
	window.vc_rowBehaviour = function () {
		var $ = window.jQuery;

        function moraFullWidth() {
            var $elements = $('[data-vc-full-width="true"]');
            $.each($elements, function(key, item) {
                var $el = $(this);
                $el.addClass("vc_hidden");
                var $el_full = $el.next(".vc_row-full-width");
                if ($el_full.length || ($el_full = $el.parent().next(".vc_row-full-width")), $el_full.length) {
                    var el_margin_left = parseInt($el.css("margin-left"), 10),
                        el_margin_right = parseInt($el.css("margin-right"), 10),
                        navwidth = $('#mora-left-side').width(),
                        windwidth = $(window).width(),
                        conwidth = $('.container').width(),
                        pagewidth = $('#page').width(),
                        diff = (pagewidth - conwidth) / 2,
                        offset = 0 + navwidth - $el_full.offset().left - el_margin_left;
                    if ($el.css({
                            position: "relative",
                            "box-sizing": "border-box",
                            width: pagewidth,
                            left: -diff + 15,
                        }), !$el.data("vcStretchContent")) {
						var padding = (- 1 * offset);

						if ( 0 > padding ) {
							padding = 0;
						}
                        var paddingRight = pagewidth - padding - $el_full.width() + el_margin_left + el_margin_right;
						if ( 0 > paddingRight ) {
							paddingRight = 0;
						}
					$el.css({
                            "padding-left": diff - 15,
                            "padding-right": diff - 15
                        })
                    }
                    $el.attr("data-vc-full-width-init", "true"), $el.removeClass("vc_hidden"), $(document).trigger("vc-full-width-row-single", {
                        el: $el,
                        offset: offset,
                        marginLeft: el_margin_left,
                        marginRight: el_margin_right,
                        elFull: $el_full,
                        width: pagewidth
                    })
                }
            }), $(document).trigger("vc-full-width-row", $elements)
        }

        function parallaxRow() {
            var vcSkrollrOptions, callSkrollInit = !1;
            return window.vcParallaxSkroll && window.vcParallaxSkroll.destroy(), $(".vc_parallax-inner").remove(), $("[data-5p-top-bottom]").removeAttr("data-5p-top-bottom data-30p-top-bottom"), $("[data-vc-parallax]").each(function() {
                var skrollrSpeed, skrollrSize, skrollrStart, skrollrEnd, $parallaxElement, parallaxImage, youtubeId;
                callSkrollInit = !0, "on" === $(this).data("vcParallaxOFade") && $(this).children().attr("data-5p-top-bottom", "opacity:0;").attr("data-30p-top-bottom", "opacity:1;"), skrollrSize = 100 * $(this).data("vcParallax"), $parallaxElement = $("<div />").addClass("vc_parallax-inner").appendTo($(this)), $parallaxElement.height(skrollrSize + "%"), parallaxImage = $(this).data("vcParallaxImage"), youtubeId = vcExtractYoutubeId(parallaxImage), youtubeId ? insertYoutubeVideoAsBackground($parallaxElement, youtubeId) : "undefined" != typeof parallaxImage && $parallaxElement.css("background-image", "url(" + parallaxImage + ")"), skrollrSpeed = skrollrSize - 100, skrollrStart = -skrollrSpeed, skrollrEnd = 0, $parallaxElement.attr("data-bottom-top", "top: " + skrollrStart + "%;").attr("data-top-bottom", "top: " + skrollrEnd + "%;")
            }), !(!callSkrollInit || !window.skrollr) && (vcSkrollrOptions = {
                forceHeight: !1,
                smoothScrolling: !1,
                mobileCheck: function() {
                    return !1
                }
            }, window.vcParallaxSkroll = skrollr.init(vcSkrollrOptions), window.vcParallaxSkroll)
        }

        function fullHeightRow() {
            var $element = $(".vc_row-o-full-height:first");
            if ($element.length) {
                var $window, windowHeight, offsetTop, fullHeight;
                $window = $(window), windowHeight = $window.height(), offsetTop = $element.offset().top, offsetTop < windowHeight && (fullHeight = 100 - offsetTop / (windowHeight / 100), $element.css("min-height", fullHeight + "vh"))
            }
            $(document).trigger("vc-full-height-row", $element)
        }

        function fixIeFlexbox() {
            var ua = window.navigator.userAgent,
                msie = ua.indexOf("MSIE ");
            (msie > 0 || navigator.userAgent.match(/Trident.*rv\:11\./)) && $(".vc_row-o-full-height").each(function() {
                "flex" === $(this).css("display") && $(this).wrap('<div class="vc_ie-flexbox-fixer"></div>')
            })
        }

		$( window ).unbind( 'resize.vcRowBehaviour' ).bind( 'resize.vcRowBehaviour', moraFullWidth );
		$( window ).bind( 'resize.vcRowBehaviour', fullHeightRow );
		moraFullWidth();
		fullHeightRow();
		fixIeFlexbox();
		initVideoBackgrounds();
		parallaxRow();		
	}
}