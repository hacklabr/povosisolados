<?php
/**
 * The default template for displaying content
 * Used for both single and index/archive/search.
 *
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(is_single() ? 'single-page' : 'archive-page'); ?>>
	<?php get_template_part( 'content', 'header'); ?>
		<?php if ( is_home() || is_search() || is_archive() || is_tag()) : // Only display Excerpts for Search ?>
		<div class="entry entry-summary">
			<?php get_template_part( 'content', 'featured'); ?>
				<?php the_excerpt(); ?>
				<?php if(get_theme_mod('quark_category_read_more',0) == 1) : ?>
					<a href="<?php echo get_permalink(get_the_ID()); ?>" class="readon"><?php _e('Read more', 'quark'); ?></a>
				<?php endif; ?>
			<?php if(is_single()) : ?>
				<?php get_template_part( 'content', 'footer' ); ?>
			<?php endif; ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="site">
			<div class="content-wrapper entry entry-content">
				<?php if (is_active_sidebar('content_top')) : ?>
				<?php do_action('quark_before_content_top'); ?>
				<div id="content-top" role="complementary">
					<?php dynamic_sidebar('content_top'); ?>
				</div>
				<?php do_action('quark_after_content_top'); ?>
				<?php endif; ?>

				<?php the_content(''); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'quark' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

				<?php if(is_single()) : ?>
					<?php get_template_part( 'content', 'footer' ); ?>
				<?php endif; ?>

				<?php if (is_active_sidebar('content_bottom')) : ?>
				<?php do_action('quark_before_content_bottom'); ?>
				<div id="content-bottom" role="complementary">
					<?php dynamic_sidebar('content_bottom'); ?>
				</div>
				<?php do_action('quark_after_content_bottom'); ?>
				<?php endif; ?>
			</div><!-- .entry-content -->

			<?php if (is_active_sidebar('sidebar')) : ?>
			<?php do_action('quark_before_sidebar'); ?>
			<aside id="sidebar" role="complementary">
				<?php dynamic_sidebar('sidebar'); ?>
			</aside>
			<?php do_action('quark_after_sidebar'); ?>
		<?php endif; ?>
			<div class="navigation-buttons">
			<?php
					next_post_link('<span class="navgation-post left">%link</span>', "&#8592;" , TRUE);
					previous_post_link('<span class="navgation-post right">%link</span>', '&#8594;' , TRUE);
			?>
			</div>
		</div><!-- .site -->
	<?php endif; ?>
</article><!-- #post -->
