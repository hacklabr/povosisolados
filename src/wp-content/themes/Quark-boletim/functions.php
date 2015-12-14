<?php
/**
 *
 * Quark functions and definitions
 *
 */

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

// loading the necessary elements
get_template_part('comments', 'template');
get_template_part('theme', 'customizer');
get_template_part('addons/class.gkutils');
get_template_part('addons/class.tgm');

if ( ! function_exists( 'quark_excerpt' ) ) :
/**
 *
 * Functions used to generate post excerpt
 *
 * @return HTML output
 *
 **/

function quark_excerpt($text) {
    return $text . '&hellip;';
}
add_filter( 'get_the_excerpt', 'quark_excerpt', 999 );
endif;

if ( ! function_exists( 'quark_excerpt_more' ) ) :
function quark_excerpt_more($text) {
    return '';
}

add_filter( 'excerpt_more', 'quark_excerpt_more', 999 );
endif;

if ( ! function_exists( 'quark_setup' ) ) :
/**
 * Quark setup.
 *
 * Sets up theme defaults and registers the various WordPress features
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 *
 *
 * @return void
 */
function quark_setup() {
	global $content_width;

	if ( ! isset( $content_width ) ) $content_width = 900;

	/*
	 * Makes Quark available for translation.
	 *
	 */
	load_theme_textdomain( 'quark', get_template_directory() . '/languages' );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'gallery', 'image', 'link', 'quote', 'video'
	) );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menu( 'mainmenu', __( 'Main Menu', 'quark' ) );
	register_nav_menu( 'footer', __( 'Footer Menu', 'quark' ) );
  register_nav_menu( 'boletimmenu', __( 'Boletim Menu', 'boletim') );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );

    // Enabling parsing the shortcodes in the widgets
    add_filter('widget_text', 'do_shortcode');

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	// Support for custom header image on the frontpage
	$defaults = array(
		'default-image' => get_template_directory_uri() . '/images/header_bg.jpg',
		'flex-height'            => true,
		'flex-width'             => true,
		'default-text-color'     => '#fff',
		'header-text'            => false,
		'uploads'                => true,
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
		'width'					 => 1400,
		'height' 				 => 814,
	);

	add_theme_support( 'custom-header', $defaults );

	add_theme_support('widget-customizer');
}
add_action( 'after_setup_theme', 'quark_setup' );
endif;

if ( ! function_exists( 'quark_add_editor_styles' ) ) :
/**
 * Enqueue scripts for the back-end.
 *
 * @return void
 */
function quark_add_editor_styles() {
    add_editor_style('editor.css');
}
add_action('init', 'quark_add_editor_styles');
endif;

if ( ! function_exists( 'quark_scripts' ) ) :
/**
 * Enqueue scripts for the front end.
 *
 * @return void
 */
function quark_scripts() {
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if(is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	// Loads JavaScript file with Modernizr
	wp_enqueue_script( 'quark-modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '', true );

	// Loads JavaScript file with functionality specific to Quark.
	wp_enqueue_script( 'quark-script', get_stylesheet_directory_uri() . '/js/functions.js', array( 'jquery' ), '', true );

	// Loads JavaScript files for PhotoSwipe gallery.
	if(get_theme_mod('quark_photo_swipe', '1') == '1') {
	wp_enqueue_script( 'quark-swipe', get_template_directory_uri() . '/js/photoswipe.min.js', array( 'jquery' ), '', false );
	wp_enqueue_script( 'quark-swipe-ui', get_template_directory_uri() . '/js/photoswipe-ui.min.js', array( 'jquery' ), '', false);
	}

	// Loads JavaScript file for responsive video.
	wp_enqueue_script('quark-video',  get_template_directory_uri() . '/js/jquery.fitvids.js', false, false, true);

	// Loads JavaScript file for the scroll reveal
	if(get_theme_mod('quark_scroll_reveal', '1') == '1') {
		wp_enqueue_script('quark-scroll-reveal',  get_template_directory_uri() . '/js/scrollreveal.js', false, false, true);
	}
}

add_action( 'wp_enqueue_scripts', 'quark_scripts' );
endif;

if ( ! function_exists( 'quark_styles' ) ) :
/**
 * Enqueue styles for the front end.
 *
 * @return void
 */
function quark_styles() {
	// Add normalize stylesheet.
	wp_enqueue_style('quark-normalize', get_template_directory_uri() . '/css/normalize.css', false);

	// Add Google font from the customizer
	wp_enqueue_style('quark-fonts-body', get_theme_mod('quark_body_google_font', '//fonts.googleapis.com/css?family=Open+Sans:300,400,500,700'), false);
	wp_enqueue_style('quark-fonts-header', get_theme_mod('quark_headers_google_font', ''), false);
	wp_enqueue_style('quark-fonts-other', get_theme_mod('quark_other_google_font', ''), false);

	// Font Awesome
	wp_enqueue_style('quark-font-awesome', get_template_directory_uri() . '/css/font.awesome.css', false, '4.3.0' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'quark-style', get_stylesheet_uri());

	// Loads the cookielaw stylesheet
	if(get_theme_mod('quark_cookie_enable', 1) == 1) {
		wp_enqueue_style( 'quark-cookies', get_template_directory_uri() . '/css/cookielaw.css', array('quark-style'));
	}

	// Loads our override.css
	if(file_exists(get_stylesheet_directory_uri() . '/css/override.css') ) {
		wp_enqueue_style( 'quark-override', get_stylesheet_directory_uri() . '/css/override.css', array('quark-style'));
	} else {
		wp_enqueue_style( 'quark-override', get_template_directory_uri() . '/css/override.css', array('quark-style'));
	}

	// Loads RWD stylesheets - from child theme if css files are placed there.
	// small desktop
	if(file_exists(get_stylesheet_directory() . '/css/small.desktop.css') ) {
		wp_enqueue_style( 'quark-small-desktop', get_stylesheet_directory_uri() . '/css/small.desktop.css', array('quark-style'), false, '(max-width: 1920px)');
	} else {
		wp_enqueue_style( 'quark-small-desktop', get_template_directory_uri() . '/css/small.desktop.css', array('quark-style'), false, '(max-width: 1920px)');
	}
	// tablet
	if(file_exists(get_stylesheet_directory() . '/css/tablet.css') ) {
		wp_enqueue_style( 'quark-tablet', get_stylesheet_directory_uri() . '/css/tablet.css', array('quark-style'), false, '(max-width: '.get_theme_mod('quark_tablet_width', '1040').'px)');
	} else {
		wp_enqueue_style( 'quark-tablet', get_template_directory_uri() . '/css/tablet.css', array('quark-style'), false, '(max-width: '.get_theme_mod('quark_tablet_width', '1040').'px)');
	}
	// small tablet
	if(file_exists(get_stylesheet_directory() . '/css/small.tablet.css') ) {
		wp_enqueue_style( 'quark-small-tablet', get_stylesheet_directory_uri() . '/css/small.tablet.css', array('quark-style'), false, '(max-width: '.get_theme_mod('quark_small_tablet_width', '840').'px)');
	} else {
		wp_enqueue_style( 'quark-small-tablet', get_template_directory_uri() . '/css/small.tablet.css', array('quark-style'), false, '(max-width: '.get_theme_mod('quark_small_tablet_width', '840').'px)');
	}
	// mobile
	if(file_exists(get_stylesheet_directory() . '/css/mobile.css') ) {
		wp_enqueue_style( 'quark-mobile', get_stylesheet_directory_uri() . '/css/mobile.css', array('quark-style'), false, '(max-width: '.get_theme_mod('quark_mobile_width', '640').'px)');
	} else {
		wp_enqueue_style( 'quark-mobile', get_template_directory_uri() . '/css/mobile.css', array('quark-style'), false, '(max-width: '.get_theme_mod('quark_mobile_width', '640').'px)');
	}

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'quark-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'quark-style' ) );
	wp_style_add_data( 'quark-ie8', 'conditional', 'lt IE 9' );

	wp_enqueue_style( 'quark-ie9', get_template_directory_uri() . '/css/ie9.css', array( 'quark-style' ) );
	wp_style_add_data( 'quark-ie9', 'conditional', 'IE 9' );
}

add_action( 'wp_enqueue_scripts', 'quark_styles' );
endif;

if ( ! function_exists( 'quark_wp_title' ) ) :
/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */
function quark_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'quark' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'quark_wp_title', 10, 2 );
endif;

if ( ! function_exists( 'quark_widgets_init' ) ) :
/**
 * Register widget area.
 *
 * @return void
 */
function quark_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar widget area', 'quark' ),
		'id'            => 'sidebar',
		'description'   => __( 'Appears at the left/right side of the website.', 'quark' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));

	register_sidebar( array(
		'name'          => __( 'Menu Top', 'quark' ),
		'id'            => 'menu_top',
		'description'   => __( 'Appears before the aside menu.', 'quark' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));

	register_sidebar( array(
		'name'          => __( 'Menu Bottom', 'quark' ),
		'id'            => 'menu_bottom',
		'description'   => __( 'Appears after the aside menu.', 'quark' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));

	register_sidebar( array(
		'name'          => __( 'Header widget area', 'quark' ),
		'id'            => 'header',
		'description'   => __( 'Appears at the top of the website.', 'quark' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));

	register_sidebar( array(
		'name'          => __( 'Top I widget area', 'quark' ),
		'id'            => 'top1',
		'description'   => __( 'Appears at the top of the website.', 'quark' ),
		'before_widget' => '<div class="widget-wrap"><div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));

	register_sidebar( array(
		'name'          => __( 'Top II widget area', 'quark' ),
		'id'            => 'top2',
		'description'   => __( 'Appears at the top of the website.', 'quark' ),
		'before_widget' => '<div class="widget-wrap"><div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));

	register_sidebar( array(
		'name'          => __( 'Content Top', 'quark' ),
		'id'            => 'content_top',
		'description'   => __( 'Appears at the top of the website content.', 'quark' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));

	register_sidebar( array(
		'name'          => __( 'Content Bottom', 'quark' ),
		'id'            => 'content_bottom',
		'description'   => __( 'Appears at the bottom of the website content.', 'quark' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));

	register_sidebar( array(
		'name'          => __( 'Bottom I widget area', 'quark' ),
		'id'            => 'bottom1',
		'description'   => __( 'Appears at the bottom of the website.', 'quark' ),
		'before_widget' => '<div class="widget-wrap"><div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));

	register_sidebar( array(
		'name'          => __( 'Bottom II widget area', 'quark' ),
		'id'            => 'bottom2',
		'description'   => __( 'Appears at the bottom of the website.', 'quark' ),
		'before_widget' => '<div class="widget-wrap"><div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));

	register_sidebar( array(
		'name'          => __( 'Bottom III widget area', 'quark' ),
		'id'            => 'bottom3',
		'description'   => __( 'Appears at the bottom of the website.', 'quark' ),
		'before_widget' => '<div class="widget-wrap"><div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));

	register_sidebar( array(
		'name'          => __( 'Bottom IV widget area', 'quark' ),
		'id'            => 'bottom4',
		'description'   => __( 'Appears at the bottom of the website.', 'quark' ),
		'before_widget' => '<div class="widget-wrap"><div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));

	register_sidebar( array(
		'name'          => __( 'Bottom V widget area', 'quark' ),
		'id'            => 'bottom5',
		'description'   => __( 'Appears at the bottom of the website.', 'quark' ),
		'before_widget' => '<div class="widget-wrap"><div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));


  register_sidebar( array(
		'name'          => __( 'Pre-footer Esquerda', 'quark' ),
		'id'            => 'prefooter_esquerda',
		'description'   => __( 'Aparece na esquerda do pre-footer', 'quark' ),
		'before_widget' => '<div class="expediente">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	));

  register_sidebar( array(
		'name'          => __( 'Pre-footer Centro' , 'quark' ),
		'id'            => 'prefooter_centro',
		'description'   => __( 'Aparece na esquerda do pre-footer', 'quark' ),
    'before_widget' => '<div class="expediente">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	));

  register_sidebar( array(
		'name'          => __( 'Pre-footer Direita', 'quark' ),
		'id'            => 'prefooter_direita',
		'description'   => __( 'Aparece na esquerda do pre-footer', 'quark' ),
    'before_widget' => '<div class="expediente">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	));

  register_sidebar( array(
		'name'          => __( 'Footer 1', 'quark' ),
		'id'            => 'footer_1',
		'description'   => __( 'Primeira área do footer', 'quark' ),
		'before_widget' => '<div class="widget-wrap %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	));

  register_sidebar( array(
		'name'          => __( 'Footer 2', 'quark' ),
		'id'            => 'footer_2',
		'description'   => __( 'Segunda área do footer', 'quark' ),
		'before_widget' => '<div class="widget-wrap %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	));

  register_sidebar( array(
		'name'          => __( 'Footer 3', 'quark' ),
		'id'            => 'footer_3',
		'description'   => __( 'Terceira área do footer', 'quark' ),
		'before_widget' => '<div class="widget-wrap %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	));

  register_sidebar( array(
		'name'          => __( 'Footer 4', 'quark' ),
		'id'            => 'footer_4',
		'description'   => __( 'Quarta área do footer', 'quark' ),
		'before_widget' => '<div class="widget-wrap %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	));

  register_sidebar( array(
		'name'          => __( 'Footer 5', 'quark' ),
		'id'            => 'footer_5',
		'description'   => __( 'Quinta área do footer', 'quark' ),
		'before_widget' => '<div class="widget-wrap %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	));

}
add_action( 'widgets_init', 'quark_widgets_init' );
endif;

if ( ! function_exists( 'quark_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 *
 * @return void
 */
function quark_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h3 class="screen-reader-text"><?php _e( 'Posts navigation', 'quark' ); ?></h3>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Posts antigos', 'quark' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Posts novos <span class="meta-nav">&rarr;</span>', 'quark' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;


if( ! function_exists( 'quark_video_code' ) ) :

function quark_video_code() {
	$video_condition = stripos(get_the_content(), '</iframe>') !== FALSE || stripos(get_the_content(), '</video>') !== FALSE;

	if($video_condition) {
		$video_code = '';

		if(stripos(get_the_content(), '</iframe>') !== FALSE) {
			$start = stripos(get_the_content(), '<iframe');
			$len = strlen(substr(get_the_content(), $start, stripos(get_the_content(), '</iframe>', $start)));
			$video_code = substr(get_the_content(), $start, $len + 9);
		} elseif(stripos(get_the_content(), '</video>') !== FALSE) {
			$start = stripos(get_the_content(), '<video');
			$len = strlen(substr(get_the_content(), $start, stripos(get_the_content(), '</video>', $start)));
			$video_code = substr(get_the_content(), $start, $len + 8);
		}

		return $video_code;
	} else {
		return FALSE;
	}
}

endif;


if (!function_exists( 'quark_the_attached_image' )) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Quark 1.0
 *
 * @return void
 */
function quark_the_attached_image() {
	/**
	 * Filter the image attachment size to use.
	 *
	 * @since Quark 1.0
	 *
	 * @param array $size {
	 *     @type int The attachment height in pixels.
	 *     @type int The attachment width in pixels.
	 * }
	 */
	$attachment_size     = apply_filters( 'quark_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();
	$post                = get_post();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if (!function_exists( 'quark_post_thumbnail_caption' )) :
/**
 *
 * Function to generate the featured image caption
 *
 * @param raw - if you need to get raw text without HTML tags
 *
 * @return HTML output or raw text (depending from params)
 *
 **/

function quark_post_thumbnail_caption($raw = false) {
	global $post;
	// get the post thumbnail ID
	$thumbnail_id = get_post_thumbnail_id($post->ID);
	// get the thumbnail description
	$thumbnail_img = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));
	// return the thumbnail caption
	if ($thumbnail_img && isset($thumbnail_img[0])) {
		if($thumbnail_img[0]->post_excerpt != '') {
			if($raw) {
				return apply_filters('gavern_thumbnail_caption', strip_tags($thumbnail_img[0]->post_excerpt));
			} else {
				return apply_filters('gavern_thumbnail_caption', '<div class="gk-image-caption">'.$thumbnail_img[0]->post_excerpt.'</div>');
			}
		}
	} else {
		return false;
	}
}
endif;


if (!function_exists( 'quark_register_required_plugins' )) :
/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function quark_register_required_plugins() {
    /**
     * Array of plugin arrays. Required keys are name and slug.
     *
     */
     $plugins = array(
          // Plugins pre-packaged with a theme.
          array(
              'name'               => 'GK Widget Rules',
              'slug'               => 'gk-widget-rules',
              'source'             => 'http://www.gavick.com/upd/gk-widget-rules.zip',
              'required'           => true,
              'version'            => ''
          ),

          array(
              'name'               => 'GK News Show Pro',
              'slug'               => 'gk-nsp',
              'source'             => 'http://www.gavick.com/upd/gk-nsp.zip',
              'required'           => true,
              'version'            => ''
          ),

          array(
              'name'               => 'GK Taxonomy Images',
              'slug'               => 'gk-taxonomy-images',
              'source'             => 'http://www.gavick.com/upd/gk-taxonomy-images.zip',
              'required'           => true,
              'version'            => ''
          ),

          array(
              'name'               => 'GK Tabs',
              'slug'               => 'gk-tabs',
              'source'             => 'http://www.gavick.com/upd/gk-tabs.zip',
              'required'           => false,
              'version'            => ''
          )
      );

     /**
      * Array of configuration settings.
      */
     $config = array(
         'id'           => 'tgmpa',
         'menu'         => 'tgmpa-install-plugins',
         'has_notices'  => true,
         'dismissable'  => true,
         'is_automatic' => false,
         'strings'      => array(
            'menu_title'                      => __( 'Install Plugins', 'quark' ),
            'page_title'                      => __( 'Install Required Plugins', 'quark' ),
            'installing'                      => __( 'Installing Plugin: %s', 'quark' ),
            'oops'                            => __( 'Something went wrong with the plugin API.', 'quark' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'quark' ),
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'quark' ),
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'quark' ),
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'quark' ),
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'quark' ),
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'quark' ),
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'quark' ),
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'quark' ),
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'quark' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'quark' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'quark' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'quark' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'quark' ),
            'nag_type'                        => 'updated'
         )
     );

     tgmpa($plugins, $config);
}

add_action('tgmpa_register', 'quark_register_required_plugins');
endif;

//Remove navbar
remove_action('wp_footer','wp_admin_bar_render',1000);
add_filter( 'show_admin_bar' , function() {
    return false;
});

// Register Custom Taxonomy
/*function custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Boletins', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Boletim', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Boletim', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'taxonomia_boletim', array( 'post' ), $args );

}
add_action( 'init', 'custom_taxonomy', 0 );

// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                => _x( 'Boletins', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Boletim', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Boletim', 'text_domain' ),
		'name_admin_bar'      => __( 'Boletim', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'All Items', 'text_domain' ),
		'add_new_item'        => __( 'Add New Item', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'new_item'            => __( 'New Item', 'text_domain' ),
		'edit_item'           => __( 'Edit Item', 'text_domain' ),
		'update_item'         => __( 'Update Item', 'text_domain' ),
		'view_item'           => __( 'View Item', 'text_domain' ),
		'search_items'        => __( 'Search Item', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'Boletim', 'text_domain' ),
		'description'         => __( 'Boletim', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'excerpt', 'author', 'thumbnail', ),
		'taxonomies'          => array('post_tag', ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'boletim', $args );

}
add_action( 'init', 'custom_post_type', 0 );

*/
function create_boletim_categories($post_id) {
	// If this is a revision, get real post ID
  /*
	if ( $parent_id = wp_is_post_revision( $post_id ) )
		$post_id = $parent_id;

	// Get default category ID from options
	$defaultcat = get_option( 'default_category' );

	// Check if this post is in default category
	if ( in_category( $defaultcat, $post_id ) ) {
		// unhook this function so it doesn't loop infinitely
		remove_action( 'save_post', 'set_private_categories' );

		// update the post, which calls save_post again
		wp_update_post( array( 'ID' => $post_id, 'post_status' => 'private' ) );

		// re-hook this function
		add_action( 'save_post', 'set_private_categories' );
	}*/

  $post_ = get_post($post_id);
  $is_boletim = get_post_meta($post_->ID, 'is_boletim', true);
  $parent_boletim = get_post_meta($post_->ID, 'boletim', true);
  $template_slug = get_page_template_slug();
  if ($is_boletim === 'boletim'){
    update_post_meta($post_->ID, '_wp_page_template', 'template.boletim.php');
  }
  if ( $post_->post_type == 'page' && $template_slug === 'template.boletim.php' ){
    wp_create_category($post_->post_name);
  }
  if ( $post_->post_type == 'post' && $parent_boletim) {
    $term = get_category_by_slug($parent_boletim);
    wp_set_post_categories($post_->ID, array($term->term_id), true);
  }
}
add_action( 'save_post', 'create_boletim_categories' );
add_image_size( 'medium_large', '768', '0', false );
add_image_size( 'medium_large', '768', '0', false );
add_image_size( 'destaque-boletim', '540', '250', array( "center", "center") );
add_image_size( 'header-boletim', '1920', '960', array( "center", "center") );
add_image_size( 'newsletter-boletim', '380', '250', array( "center", "center") );
add_image_size( 'newsletter-header', '810', '400', array( "center", "center") );

function box_esquerda( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'largura' => '50%',
		), $atts )
	);

	// Code
  return '<div class="box-esquerda">' . $content . '</div>';
}
add_shortcode( 'box-esquerda', 'box_esquerda' );

function box_direita( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'largura' => '50%',
		), $atts )
	);

	// Code
  return '<div class="box-direita">' . $content . '</div>';
}
add_shortcode( 'box-direita', 'box_direita' );

function box_centro( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'largura' => '50%',
		), $atts )
	);

	// Code
  return '<div class="box-centro">' . $content . '</div>';
}
add_shortcode( 'box-centro', 'box_centro' );

// EOF
