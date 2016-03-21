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
	var mw = false,
		orient = null;

	$(document).ready(function($){

		rhdInit();

		// Resize events
		$window.on('resize', function(){
			orient = getOrient();

			setTotalWidth();

			//setUnsetMousewheel();
		});
	});


	/* ==========================================================================
		Functions
	============================================================================= */

	function rhdInit() {
		//setUnsetMousewheel();

		toggleBurger();

		orient = getOrient();

		$('#content').imagesLoaded(function(){
			setTotalWidth();
		});

		$("#site-navigation .menu-item a").on('click', function(e){
			var elemID = $(this).attr('href'),
				elemLeft = $(elemID).offset().left,
				cush = $window.width() * 0.05;

			e.preventDefault();

			$('html, body').animate({
				scrollLeft: elemLeft - cush
			});
		});

		$("#site-title a").on('click', function(e){
			e.preventDefault();

			$('html, body').animate({
				scrollLeft: 0
			});
		});

/*
		$('.column-slide').each(function(){
			$(this).children('.section-content').columnize({
				width: 400,
				height: $(this).height()
			});
		});
*/
	}


	function getOrient() {
		if ( $window.height() < $window.width() )
			return 'land';

		else
			return 'port';
	}


	function setTotalWidth() {
		var w = 0;

		if ( orient == 'land' ) {
			$("#content > section").each(function(){
				var $this = $(this);
				w += parseInt($this.width(), 10) + parseInt($this.css('paddingLeft'), 10) + parseInt($this.css('paddingRight'), 10);
			});
		}

		w=w+2; // Safety pixel

		$('html, body').width(w);
	}


	function setUnsetMousewheel() {
		if ( orient == 'land' && mw === false ) {
			mousewheelOn();
			mw = true;
		} else if ( orient == 'port' && mw === true ) {
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