<?php
/**
 *
 * 404 Page
 *
 **/

$error_bg = get_template_directory_uri() . '/images/header_bg.jpg';
if(get_theme_mod('quark_error_bg', '') !== '') {
	$error_bg = get_theme_mod('quark_error_bg');
}
get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site site-content" role="main">
			<?php do_action('quark_before_content'); ?>
			<article id="post" <?php post_class(); ?>>
				<div>
					<div class="content-wrapper">
						<header>
						<h1 class="header">
                            <?php _e( '404', 'quark' ); ?>
                        </h1>
						</header>


						<h2><?php _e( 'The page you were looking for could not be found.', 'quark' ); ?></h2>

						<?php
		                	$lang = explode('-', get_bloginfo('language'));
							$lang = $lang[0];
		                ?>

						<script type="text/javascript">
						var GOOG_FIXURL_LANG = '<?php echo $lang;?>';
						var GOOG_FIXURL_SITE = '<?php echo site_url(); ?>';
						</script> 

						<script type="text/javascript" src="https://linkhelp.clients.google.com/tbproxy/lh/wm/fixurl.js"></script>


						<?php if (is_active_sidebar('content_bottom')) : ?>
						<?php do_action('quark_before_content_bottom'); ?>
						<div id="content-bottom" role="complementary">
							<?php dynamic_sidebar('content_bottom'); ?>
						</div>
						<?php do_action('quark_before_content_bottom'); ?>
						<?php endif; ?>

					</div>		
				</div>
			</article><!-- #post -->
			<?php do_action('quark_after_content'); ?>
		</div><!-- #content -->
	</div><!-- #primary -->
	<p class="error-links"><a href="<?php echo site_url(); ?>"><?php _e('Back to our homepage','quark'); ?></a></p>

<?php get_footer(); ?>
