<?php
/**
 * The Header template for Boletim page
 *
 */

global $post;
global $post_original;
$post_original = $post;

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->

	<?php if(get_theme_mod('quark_cookie_enable', 1) == 1) : ?>
		<?php get_template_part('cookielaw'); ?>
	<?php endif; ?>

	<?php do_action('quark_head'); ?>
	<?php wp_head(); ?>
</head>

<?php
	$front_class = 'boletim';
?>

<body <?php body_class($front_class); ?> data-mobile-width="<?php echo get_theme_mod('quark_mobile_width', 640); ?>" data-tablet-width="<?php echo get_theme_mod('quark_tablet_width', 1040); ?>">
	<?php if (get_theme_mod('quark_page_loader', 1) == 1) : ?>
		<div id="gk-page-preloader"></div>
	<?php endif; ?>

	<!--[if lte IE 8]>
	<div id="ie-toolbar"><div><?php _e('You\'re using an unsupported version of Internet Explorer. Please <a href="http://windows.microsoft.com/en-us/internet-explorer/products/ie/home">upgrade your browser</a> for the best user experience on our site. Thank you.', 'quark') ?></div></div>
	<![endif]-->

	<div id="gk-bg">
		<?php do_action('quark_plugin_messages'); ?>

        <header id="gk-header" role="banner">
			<div id="gk-header-nav">
				<?php
					$the_slug = get_post_meta($post_original->ID, 'boletim', true);
					$args = array(
					  'name'        => $the_slug,
					  'post_type'   => 'page',
					  'post_status' => 'publish',
					  'numberposts' => 1
					);
					$linkposts = get_posts($args);
					if( $linkposts ) :
					  $boletim_url = get_permalink($linkposts[0]->ID);
					else:
						$boletim_url = get_home_url();
					endif;
				?>
				<a href="<?php echo $boletim_url ?>"><h1> <span class="screen-reader-text"><?php _e('Boletim Povos Isolados da Amazônia', 'quark'); ?></span></h1></a>

				<div>
					<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'quark' ); ?>"><?php _e( 'Skip to content', 'quark' ); ?></a>

	                <div id="gk-mobile-menu">
                     	<span id="gk-mobile-menu-text"><?php _e('Boletins','quark'); ?></span>
                    	<i id="static-aside-menu-toggler"></i>
	                </div>

                 </div>
			</div>
			<?php
						if ( get_post_type() == "page" ) {

						$category = $post->post_name;
						$args_editorial = array(
							'post_type' => 'post',
							'order' => 'ASC',
							'category_name' => $category ,
							'meta_key' => 'is_editorial',
							'meta_value' => 'editorial',
							'posts_per_page' => 1
						);

						$loop_editorial = get_posts($args_editorial);
						foreach ( $loop_editorial as $_post ){
						$url = wp_get_attachment_url( get_post_thumbnail_id($_post->ID) );
					  }; wp_reset_query(); ?>

					<div id="gk-header-mod" style="background-image:url('<?php echo $url; ?>');">
		<?php } ?>
				<div class="frontpage-block-wrap">
					<?php do_action('quark_before_header'); ?>

					<?php if ( have_posts() ) : ?>
					<div class="gk-header-mod-wrap">
						<?php
						$category = $post->post_name;
						$args_editorial = array(
							'post_type' => 'post',
							'order' => 'ASC',
							'category_name' => $category ,
							'meta_key' => 'is_editorial',
							'meta_value' => 'editorial',
							'posts_per_page' => 1
						);

						$loop_editorial = get_posts($args_editorial);
						foreach ( $loop_editorial as $_post ){
					  ?>
						<h2><?php _e('Editorial','quark'); ?></h2>

						<div class="box-title">
							<a href="<?php echo get_permalink($_post->ID); ?>">
							<h3><?php echo $_post->post_title; ?></h3>
							<?php echo $_post->post_excerpt; ?>
							</a>
						</div>

						<?php }; wp_reset_query(); ?>
                    </div>

					<?php endif; ?>
					<?php do_action('quark_after_header'); ?>
				</div>

			</div>
		</header><!-- #masthead -->
