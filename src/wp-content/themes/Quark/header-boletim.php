<?php
/**
 * The Header template for Boletim page
 *
 */

global $post;

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

				<h1><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/marca-boletim.png" alt="Boletim Povoso Isolados da Amazônia"></h1>

				<div>
					<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'quark' ); ?>"><?php _e( 'Skip to content', 'quark' ); ?></a>

	                <div id="gk-mobile-menu">
                     	<span id="gk-mobile-menu-text"><?php _e('Boletins','quark'); ?></span>
                    	<i id="static-aside-menu-toggler"></i>
	                </div>

                 </div>
			</div>
			<?php
						//the_post_thumbnail('full');
						$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			?>
			<div id="gk-header-mod" style="background-image:url('<?php echo $url; ?>');">
				<div class="frontpage-block-wrap">
					<?php do_action('quark_before_header'); ?>

					<?php if ( have_posts() ) : ?>
					<div class="gk-header-mod-wrap">

								        <?php while ( have_posts() ) : the_post(); ?>
						<h3>	
							<?php
								the_title();
							?>
						</h3>
							<?php
								the_content();
							?>
						<?php endwhile; ?>

						<?php wp_reset_query(); ?>

						<?php if(get_theme_mod('quark_header_mouse_icon',1) == 1) : ?>
		                    <span class="mouse-icon"><span><span></span></span></span>
		                <?php endif; ?>
                    </div>
					<?php endif; ?>
					<?php do_action('quark_after_header'); ?>
				</div>
			</div>
		</header><!-- #masthead -->
