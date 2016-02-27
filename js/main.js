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
	var mw = false;

	$(document).ready(function($){

		rhdInit();

		// Resize events
		$window.on('resize', function(){
			//setUnsetMousewheel();
		});

	});


	/* ==========================================================================
		Functions
	============================================================================= */

	function rhdInit() {
		//setUnsetMousewheel();

		toggleBurger();
	}


	function setUnsetMousewheel() {
		if ( $window.height() < $window.width() && mw === false ) {
			mousewheelOn();
			mw = true;
		} else {
			mousewheelOff();
			mw = false;
		}
	}


	function mousewheelOn() {
		$('html, body, *').mousewheel(function(e, delta) {
			e.preventDefault();
			this.scrollLeft -= (delta * 40);
		});
	}

	function mousewheelOff() {
		$('html, body, *').mousewheel(function(e, delta) {
			// Nothing to see here...
		});
	}


	// Adapted from Hamburger Icons: https://github.com/callmenick/Animating-Hamburger-Icons
	function toggleBurger() {
		var toggles = $(".c-hamburger");

		toggles.click(function(e){
			e.preventDefault();
			$(this).toggleClass('is-active');
			$("#rhd-nav-menu").slideToggle();
		});
	}


})(jQuery);