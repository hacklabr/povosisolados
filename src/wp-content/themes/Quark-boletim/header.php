<?php
/**
 * The Header template for our theme
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1.0">
	<title><?php wp_title('|', true, 'right'); ?></title>
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
	$dark_img = '';
	if (get_theme_mod('quark_dark_image', 1) == 1) {
		if (is_category() || is_author() || is_search() || is_404() || (is_singular() && !is_attachment())) {
		//	$dark_img = 'dark-bg';
		} else {
			$dark_img = '';
		}
	}

	if (get_theme_mod('quark_js_parallax', 1) == 1) {
	//	$dark_img .= ' js-parallax';
	}

	$logo_image = get_theme_mod('quark_logo', '');
	$dark_logo_image = get_theme_mod('quark_logo_dark', '');
?>

<body <?php body_class($dark_img); ?> data-mobile-width="<?php echo get_theme_mod('quark_mobile_width', 640); ?>" data-tablet-width="<?php echo get_theme_mod('quark_tablet_width', 1040); ?>">
	<?php if (get_theme_mod('quark_page_loader', 1) == 1) : ?>
		<div id="gk-page-preloader"></div>
	<?php endif; ?>

	<!--[if lte IE 8]>
	<div id="ie-toolbar"><div><?php _e('You\'re using an unsupported version of Internet Explorer. Please <a href="http://windows.microsoft.com/en-us/internet-explorer/products/ie/home">upgrade your browser</a> for the best user experience on our site. Thank you.', 'quark') ?></div></div>
	<![endif]-->
	<div id="gk-bg">
		<header id="gk-header" role="banner">
			<div id="gk-header-nav" <?php if((get_theme_mod('quark_menu_fixed', 1) == 1 && get_theme_mod('quark_menu_classic', 0) == 1)) { echo 'class="gk-fixed"'; } ?>>
				<div>
					<?php if(get_theme_mod('quark_logo', '') == '') : ?>
						<a class="gk-logo text" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<!-- <span><?php bloginfo( 'name' ); ?> -->
								<?php if(get_theme_mod('quark_slogan_switch', 0) == 1) : ?>
									<small class="gk-logo-slogan"><?php bloginfo( 'description' ); ?></small>
								<?php endif; ?>
							</span>
						</a>
					<?php else : ?>
						<a class="gk-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<img src="<?php echo $logo_image; ?>"
							<?php if($dark_logo_image != '') : ?>data-dark="<?php echo $dark_logo_image; ?>"<?php endif; ?>
        					<?php if($dark_logo_image != '') : ?>data-light="<?php echo $logo_image; ?>"<?php endif; ?>
        	 				alt="<?php bloginfo( 'name' ); ?>" />
						</a>
					<?php endif; ?>

					<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'quark' ); ?>"><?php _e( 'Skip to content', 'quark' ); ?></a>

					<?php if(get_theme_mod('quark_menu_classic', 0) == 1) : ?>
						<?php do_action('steakhouse_before_mainmenu'); ?>
	                    <nav class="main-navigation" role="navigation">
	                        <?php wp_nav_menu( array( 'theme_location' => 'mainmenu', 'menu_class' => 'nav-menu', 'fallback_cb' => false ) ); ?>
	                    </nav><!-- #site-navigation -->
	                    <?php do_action('steakhouse_after_mainmenu'); ?>
					<?php endif; ?>

                    <div id="gk-mobile-menu" class="site">
                     	<span id="gk-mobile-menu-text"><?php _e('Menu','quark'); ?></span>
                    	<i id="static-aside-menu-toggler"></i>
                 	</div>
                 </div>
			</div>

            <?php do_action('quark_plugin_messages'); ?>

			<?php if (is_active_sidebar('header')) : ?>
			<div id="gk-header-widget" role="complementary">
				<div class="widget-area">
					<?php do_action('quark_before_header'); ?>
					<?php dynamic_sidebar('header'); ?>
					<?php do_action('quark_after_header'); ?>
				</div>
			</div>
			<?php endif; ?>
		</header><!-- #masthead -->

		<div id="page" class="hfeed">
			<div id="main" class="site-main">
				<?php if (is_active_sidebar('top1')) : ?>
				<?php do_action('quark_before_top1'); ?>
				<div id="gk-top1" role="complementary" class="site">
					<div class="widget-area gk-3-cols" data-cols="<?php echo GK_Utils::count_sidebar_widgets('top1', 3); ?>">
						<?php dynamic_sidebar('top1'); ?>
					</div>
				</div>
				<?php do_action('quark_after_top1'); ?>
				<?php endif; ?>

				<?php if (is_active_sidebar('top2')) : ?>
				<?php do_action('quark_before_top2'); ?>
				<div id="gk-top2" role="complementary" class="site">
					<div class="widget-area gk-3-cols" data-cols="<?php echo GK_Utils::count_sidebar_widgets('top2', 3); ?>">
						<?php dynamic_sidebar('top2'); ?>
					</div>
				</div>
				<?php do_action('quark_after_top2'); ?>
				<?php endif; ?>
