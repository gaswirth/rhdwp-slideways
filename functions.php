<?php
/**
 * RHD Base
 *
 * ROUNDHOUSE DESIGNS
 *
 * @package WordPress
 * @subpackage rhd
 **/


/* ==========================================================================
   Initialization
   ========================================================================== */

function rhd_init()
{
	// Constants
	define( "RHD_THEME_DIR", get_template_directory_uri() );
	define( "RHD_IMG_DIR", get_template_directory_uri() . '/img' );

	$updir = wp_upload_dir();
	define( "RHD_UPLOAD_URL", $updir['baseurl'] );
}
add_action( 'after_setup_theme', 'rhd_init' );

/* Disable Editor */
define( 'DISALLOW_FILE_EDIT', true );


/* ==========================================================================
   Scripts + Styles
   ========================================================================== */

function rhd_enqueue_styles()
{
	wp_register_style( 'rhd-main', RHD_THEME_DIR . '/css/main.css', array(), '1', 'all' );
	wp_register_style( 'rhd-enhanced', RHD_THEME_DIR . '/css/enhanced.css', array(), '1', 'all' );
	wp_register_style( 'google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Roboto:400,700,400italic' );

	if ( !rhd_is_mobile() ) {
		wp_enqueue_style( 'rhd-enhanced' );
	}

	wp_register_style( 'normalize', RHD_THEME_DIR . '/css/normalize.css', null, null, 'all' );

	wp_enqueue_style( 'rhd-main' );
	wp_enqueue_style( 'normalize' );
	wp_enqueue_style( 'google-fonts' );
}
add_action( 'wp_enqueue_scripts', 'rhd_enqueue_styles' );

function rhd_enqueue_scripts()
{
	wp_register_script( 'rhd-plugins', RHD_THEME_DIR . '/js/plugins.js', array( 'jquery' ), null, true );
	wp_register_script( 'imagesloaded', RHD_THEME_DIR . '/js/vendor/imagesloaded/imagesloaded.pkgd.min.js', array( 'jquery' ), null, true );
	wp_register_script( 'jquery.columnizer', RHD_THEME_DIR . '/js/vendor/jquery.columnizer/src/jquery.columnizer.min.js', array(), null, true );

	$main_deps = array(
		'rhd-plugins',
		'jquery',
		'imagesloaded',
		'jquery.columnizer',
	);

	wp_register_script( 'rhd-main', RHD_THEME_DIR . '/js/main.js', $main_deps, null, true );

	wp_enqueue_script( 'rhd-plugins' );
	wp_enqueue_script( 'rhd-main' );

	if ( is_singular() )
		wp_enqueue_script( 'comment-reply' );
}
add_action('wp_enqueue_scripts', 'rhd_enqueue_scripts');


function rhd_add_editor_styles()
{
	//Google Fonts in admin editor
	$font_url = '//fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Roboto:400,700,400italic';
	$font_url = str_replace( ',', '%2C', $font_url );
	$font_url = str_replace( ':', '%3A', $font_url );
    add_editor_style( $font_url );


	add_editor_style( RHD_THEME_DIR . '/css/editor.css' );
}
add_action( 'after_setup_theme', 'rhd_add_editor_styles' );


/* ==========================================================================
   Sidebars + Menus
   ========================================================================== */

// Sidebars
function rhd_register_sidebars()
{
	register_sidebar(array(
		'name'			=> __( 'Sidebar', 'rhd' ),
		'id'			=> 'sidebar',
		'before_title'	=> '<h2 class="widget-title">',
		'after_title'	=> '</h2>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>'
	));
}
add_action( 'widgets_init', 'rhd_register_sidebars' );

// Menus
/**
 * RHD_Walker_Nav class.
 *
 * Adds newlines after each </li> closing tag.
 *
 * @extends Walker_Nav_Menu
 */
class RHD_Walker_Nav extends Walker_Nav_Menu {
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
}

register_nav_menu( 'primary', 'Main Site Navigation' );


// Includes and Requires
//include_once( 'includes/rhd-admin-panel.php' );


/* ==========================================================================
   Registrations, Theme Support, Thumbnails
   ========================================================================== */

// Theme Support
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
}


// Enable themes auto-update
add_filter( 'allow_minor_auto_core_updates', '__return_true' );


// Content Width
if ( ! isset( $content_width ) ) {
	$content_width = 620;

}


/**
 * rhd_attachment_display_settings function.
 *
 * @access public
 * @return void
 */
function rhd_attachment_display_settings()
{
	//update_option( 'image_default_align', 'left' );
	update_option( 'image_default_link_type', 'none' );
	update_option( 'image_default_size', 'large' );
}
add_action( 'after_setup_theme', 'rhd_attachment_display_settings' );


// Adds RSS feed links to for posts and comments.
add_theme_support( 'automatic-feed-links' );

function rhd_image_sizes()
{
	add_image_size( 'news-item', 300, 300, true );
}
add_action( 'after_setup_theme', 'rhd_image_sizes' );

// Allow shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );


/* ==========================================================================
   Roundhouse Admin Branding
   ========================================================================== */

// External login link
function rhd_branding_login()
{
	return "//roundhouse-designs.com/";
}
add_filter('login_headerurl', 'rhd_branding_login');


// Site Title as "login message" (underneath RHD logo)
function rhd_login_message() {
	echo '<h1 class="rhd-login-site-title">' . get_bloginfo('name') . "</h1>\n";
}
add_action( 'login_message', 'rhd_login_message' );


// Roundhouse Branding CSS
function rhd_login()
{
	wp_enqueue_style( 'rhd_login', get_stylesheet_directory_uri() . '/rhd/rhd-login.css' );
}
add_action('login_head', 'rhd_login');


function rhd_admin()
{
	wp_enqueue_style( 'rhd_admin', get_stylesheet_directory_uri() . '/rhd/rhd-admin.css' );
}
add_action('admin_head', 'rhd_admin');


// Custom WordPress Footer
function rhd_footer_admin ()
{
	return '&copy; ' . date("Y") . ' - Roundhouse <img class="rhd-admin-colophon-logo" src="//assets.roundhouse-designs.com/images/rhd-black-house.png" alt="Roundhouse Designs"> Designs';
}
add_filter('admin_footer_text', 'rhd_footer_admin');


// Remove 'Editor' panel
function rhd_remove_editor_menu()
{
  remove_action('admin_menu', '_add_themes_utility_last', 101);
}
add_action('_admin_menu', 'rhd_remove_editor_menu', 1);


// Globally disable WP toolbar
add_filter( 'show_admin_bar', '__return_false' );


/* ==========================================================================
   Helpers
   ========================================================================== */

/**
 * rhd_is_mobile function.
 *
 * @access public
 * @return void
 */
function rhd_is_mobile()
{
	$mobile_browser = 0;

	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
	    $mobile_browser++;
	}

	if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
	    $mobile_browser++;
	}

	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
	$mobile_agents = array(
	    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
	    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
	    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
	    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
	    'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
	    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
	    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
	    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
	    'wapr','webc','winw','winw','xda ','xda-');

	if (in_array($mobile_ua,$mobile_agents)) {
	    $mobile_browser++;
	}

	if ( array_key_exists( 'ALL_HTTP', $_SERVER ) ) {
		if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini') > 0) {
		    $mobile_browser++;
		}
	}

	if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
	    $mobile_browser = 0;
	}

	if ( $mobile_browser > 0 ) {
		$mobile_browser = TRUE;
	} else {
		$mobile_browser = FALSE;
	}

	return $mobile_browser;
}


/**
 * get_the_slug function.
 *
 * @access public
 * @return void
 */
function get_the_slug()
{
	$post_data = get_post( $post->ID, ARRAY_A );
	$slug = $post_data['post_name'];
	return $slug;
}


/**
 * Function: rhd_strip_thumbnail_dimensions
 *
 * Strip WP inline image dimensions
 *
 * @param $html
 **/
add_filter( 'post_thumbnail_html', 'rhd_strip_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'rhd_strip_thumbnail_dimensions', 10 );

function rhd_strip_thumbnail_dimensions( $html )
{
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}


/**
 * rhd_add_async function.
 *
 * @access public
 * @param mixed $url
 * @return void
 */
function rhd_add_async( $url )
{
	if ( strpos( $url, '#async') === false )
		return $url;
	elseif ( is_admin() )
		return str_replace( '#async', '', $url );
	else
		return str_replace( '#async', '', $url ) . "' async";
}
add_filter( 'clean_url', 'rhd_add_async', 11, 1 );


/**
 * rhd_gallery_atts function.
 *
 * @access public
 * @param mixed $out
 * @param mixed $pairs
 * @param mixed $atts
 * @return void
 */
function rhd_gallery_atts( $out, $pairs, $atts )
{
	$atts = shortcode_atts(
		array(
			'link' => 'file'
		), $atts );

	$out['link'] = $atts['link'];

/*
	Other example defaults:
	$out['columns'] = $atts['columns'];
	$out['size'] = $atts['size'];
*/

	return $out;
}
add_filter( 'shortcode_atts_gallery', 'rhd_gallery_atts', 10, 3 );


/**
 * rhd_enhance_excerpts function.
 *
 * @access public
 * @param mixed $text
 * @return void
 */
function rhd_enhance_excerpts( $text )
{
	global $post;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace('\]\]\>', ']]&gt;', $text);
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
		$text = strip_tags($text, '<a>');
		$excerpt_length = 80;
		$words = explode(' ', $text, $excerpt_length + 1);
		if ( count( $words ) > $excerpt_length) {
			array_pop( $words );
			array_push( $words, '... <a class="readmore" href="'. get_permalink($post->ID) . '">Continue reading &rarr;</a>' );
			$text = implode(' ', $words);
        }
	}
	return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'rhd_enhance_excerpts');


/**
 * Function: rhd_title_check_hidden
 *
 * Hides widget titles contained within parentheses '()'
 *
 * @param string $title
 **/

function rhd_title_check_hidden( $title )
{
	if ( stripos($title, '(') !== false && stripos($title, ')') !== false ) {
		$first = substr($title, 0, 1);
		$last = substr($title, -1, 1);

		if ($first == '(' && $last == ')') $title = '';
		else $title = preg_replace('/\((.*?)\)/', '', $title);
	}
	return $title;
}
add_filter('widget_title', 'rhd_title_check_hidden');


/**
 * rhd_body_class function.
 *
 * @access public
 * @return void
 */
function rhd_body_class( $body_classes )
{
	// Basic front page & device detection
	$body_classes[] = ( is_front_page() ) ? 'front-page' : '';
	$body_classes[] = ( rhd_is_mobile() ) ?  'mobile' : '';
	$body_classes[] = ( wp_is_mobile() && !rhd_is_mobile() ) ? 'tablet' : '';
	$body_classes[] = ( !wp_is_mobile() && !rhd_is_mobile() ) ? 'desktop' : '';

	return $body_classes;
}
add_filter( 'body_class', 'rhd_body_class' );


/**
 * rhd_redirect_post function.
 *
 * @access public
 * @return void
 *
 * Redirects users who try to view a single post page
 */
function rhd_redirect_post() {
	if ( is_single() && get_post_type() == 'post' ) {
		wp_safe_redirect( home_url(), 301 );
	exit;
	}
}
add_action( 'template_redirect', 'rhd_redirect_post' );


/**
 * rhd_archive_pagination function.
 *
 * @access public
 * @return void
 */
function rhd_archive_pagination()
{
	$sep = ( get_previous_posts_link() != '' ) ? '<div class="pag-sep"></div>' : null;

	echo '<div class="pagination">';

	echo '<span class="pag-next">' . next_posts_link( '&larr; Older', null ) . '</span>';

	if ( $sep ) {
		echo '<div class="pag-sep"></div>';
	}

	echo '<span class="pag-prev">' . previous_posts_link( 'Newer &rarr;', null ) . '</span>';
	echo '</div>';
}


/**
 * rhd_single_pagination function.
 *
 * @access public
 * @return void
 */
function rhd_single_pagination()
{
	$next = get_previous_post_link( '%link', '&lt; Older' );
	$prev = get_next_post_link( '%link', 'Newer &gt;' );
	$spacer = '<div class="pag-spacer"></div>';

	echo "<div class='single-pagination'>\n";

	echo ( $next != '' ) ? $next : $spacer;

	echo  "<div class='pag-sep'></div>\n";

	echo ( $prev != '' ) ? $prev : $spacer;

	echo "</div>\n";
}


/**
 * rhd_full_bg_caption function.
 *
 * @access public
 * @return void
 */
function rhd_full_bg_caption() {
	$dl_post = get_posts( array( 'post_type' => 'page', 'post_status' => 'publish', 'name' => 'download-resume' ) );

	echo "<div class='full-bg-caption'>" . $dl_post[0]->post_content . "</div>\n";
}


/**
 * rhd_svg_logo_main function.
 *
 * @access public
 * @return void
 */
function rhd_svg_logo() {
	echo '
			<svg id="PLACEHOLDER">
				<!-- SVG CODE HERE -->
			</svg>
		';
}


/* ==========================================================================
	Meta Boxes
   ========================================================================== */

/**
 * rhd_add_ext_link_meta_boxes function.
 *
 * @access public
 * @return void
 */
function rhd_add_ext_link_meta_boxes() {
	add_meta_box(
		'rhd_ext_link_meta',
		__( 'External Link', 'rhd' ),
		'rhd_ext_link_meta_callback',
		'post',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'rhd_add_ext_link_meta_boxes' );

/**
 * rhd_ext_link_meta_callback function.
 *
 * @access public
 * @param mixed $post
 * @return void
 */
function rhd_ext_link_meta_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'rhd_ext_link_meta_meta_box', 'rhd_ext_link_meta_meta_box_nonce' );

	$meta = get_post_meta( $post->ID );
?>

	<p>
	    <label for="rhd-ext-link" class="rhd-ext-link"><?php _e( 'External URL', 'rhd' )?></label>
	    <input type="url" name="rhd-ext-link" id="rhd-ext-link" value="<?php if ( isset ( $meta['_ext-link'] ) ) echo esc_url( $meta['_ext-link'][0] ); ?>" />
	</p>
<?php
}

function rhd_save_ext_link_meta_box_data( $post_id ) {

	// Check if our nonce is set.
	if ( ! isset( $_POST['rhd_ext_link_meta_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['rhd_ext_link_meta_meta_box_nonce'], 'rhd_ext_link_meta_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */

	// Checks for input and saves if needed
	if( isset( $_POST[ 'rhd-ext-link' ] ) ) {
		update_post_meta( $post_id, '_ext-link', esc_url_raw( $_POST[ 'rhd-ext-link' ] ) );
	}
}
add_action( 'save_post', 'rhd_save_ext_link_meta_box_data' );
