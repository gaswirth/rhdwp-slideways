/* ==========================================================================
	Setup
   ========================================================================== */

var $window = jQuery(window),
	$body = jQuery('body'),
	$main = jQuery('#main');

var	isFrontPage = ( $body.hasClass('front-page') === true ) ? true : false,
	isMobile = ( $body.hasClass('mobile') === true ) ? true : false,
	isTablet = ( $body.hasClass('tablet') === true ) ? true : false;

	var $gallery = jQuery("#photos .gallery"),
	$gridItem = jQuery("#photos .gallery .gallery-item");


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
		});
	});


	/* ==========================================================================
		Functions
	============================================================================= */

	function rhdInit() {
		toggleBurger();

		orient = getOrient();

		var numSections = $("#content section").length;
		var i = 0;

		$('#content section').each(function(){
			$(this).imagesLoaded(function(){
				i++;
			});
		});

		var interval = setInterval( function(){
			if ( i == numSections ) {
				clearInterval(interval);
				setTotalWidth();
				$('#hamburger').fadeIn('slow', function(){
					$('#loader').fadeOut('slow');
				});
				return;
			}
		},
		100);

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

		rhdPackery();
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
		$('body').addClass('h-sized');
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


	function rhdPackery() {
		$gallery.imagesLoaded(function(){
			$gallery.packery({
				columnWidth: '.gallery-item-sizer',
				gutter: '.gutter-sizer',
				itemSelector: '.gallery-item',
				percentPosition: true
			});
		});

		$gallery.on('click', '.gallery-item', function(event){
			var $item = $(event.currentTarget);
			$item.toggleClass('gigante');

			if ( $item.is('.gigante') ){
				$gallery.packery( 'fit', event.currentTarget, 0 );
			} else {
				$gallery.packery('shiftLayout');
			}
		});
	}

})(jQuery);