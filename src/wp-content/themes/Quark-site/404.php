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
get_header('frontpage'); ?>

<div id="primary" class="entry-header no-image content-area">
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


					<h2><?php _e( 'A página que você procura não foi encontrada.', 'quark' ); ?></h2>

					<?php
					$lang = explode('-', get_bloginfo('language'));
					$lang = $lang[0];
					?>

					<div id="gk-search">
						<?php get_search_form(); ?>
					</div>

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
<p class="error-links"><a href="<?php echo site_url(); ?>"><?php _e('Volte para a homepage','quark'); ?></a></p>
<script>
document.title = <?= _e( 'A página que você procura não foi encontrada.', 'quark' ); ?>
jQuery(document).ready(function(){
	jQuery('.error-links').hide();
});
</script>

<?php get_footer('frontpage'); ?>
