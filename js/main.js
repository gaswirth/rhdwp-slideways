/* ==========================================================================
	Setup
   ========================================================================== */

var $window = jQuery(window),
	$body = jQuery('body'),
	$main = jQuery('#main');

var	isFrontPage = ( $body.hasClass('front-page') === true ) ? true : false,
	isMobile = ( $body.hasClass('mobile') === true ) ? true : false,
	isTablet = ( $body.hasClass('tablet') === true ) ? true : false;

// Site Data object: siteData


/* ==========================================================================
	Let 'er rip... (DOM Ready)
   ========================================================================== */

(function($){
	$(document).ready(function($){

		rhdInit();

	});


	/* ==========================================================================
		Functions
	============================================================================= */

	function rhdInit() {
		initMousewheel();
	}


	function initMousewheel() {
		$('html, body, *').mousewheel(function(e, delta) {
			e.preventDefault();
			this.scrollLeft -= (delta * 40);
		});
	}


})(jQuery);