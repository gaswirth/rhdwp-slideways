/* ==========================================================================
	Setup
   ========================================================================== */

var $window = jQuery(window),
	$body = jQuery('body'),
	$main = jQuery('#main');

var isSingle = ( $body.hasClass('single') ) ? true : false,
	isGrid = ( $main.hasClass('grid') === true ) ? true : false,
	isPaged = $body.hasClass('paged');

var	isFrontPage = ( $body.hasClass('front-page') === true ) ? true : false,
	isMobile = ( $body.hasClass('mobile') === true ) ? true : false,
	isTablet = ( $body.hasClass('tablet') === true ) ? true : false;

// Site Data object: siteData


/* ==========================================================================
	Let 'er rip... (DOM Ready)
   ========================================================================== */

// Init
var cycleType = null;
var playlistId = 'PLAYLIST_ID';

(function($){
	$(document).ready(function($){

		// FitText
		// fitText(document.getElementById('site-title'), 0.82);


		// Window resizing
		var resizeId;
		

		// News Scrolling
		if ( $window.width() < 640 )
			rhdCycleInit(false);
		else
			rhdCycleInit(true);


		// YouTube TV
		if ( !isMobile ) {
			$("#ytv").ytv({
				playlist: playlistId,
				autoplay: false,
			});
		} else { // Fallback to default YouTube playlist
			$("#ytv")
				.addClass('ytv-mobile')
				.html('<iframe id="ytplayer" type="text/html" src="https://www.youtube.com/embed/videoseries?list=' + playlistId + '" width="100%" height="100%" frameborder="0" />');
		}

	});


	/* ==========================================================================
		Functions
	============================================================================= */

	function rhdCycleInit( is_carousel ) {
		if ( is_carousel === true ) {
			$( '.news-entries' ).cycle({
				fx: 'carousel',
				timeout: 0,
				autoHeight: "calc",
				allowWrap: false,
				next: "#next",
				prev: "#prev",
				slides: "> article",
				carouselVisible: 3,
				carouselFluid: true,
				log: false
			});
			cycleType = 'multi';
		} else {
			$( '.news-entries' ).cycle({
				fx: 'scrollHorz',
				allowWrap: false,
				timeout: 0,
				next: "#next",
				prev: "#prev",
				slides: "> article",
				log: false
			});
			cycleType = 'single';
		}
	}
})(jQuery);