<?php
/**
 * The template for displaying all pages
 *
 */

$video_code = quark_video_code();

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php do_action('quark_before_content'); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('single-page'); ?>>

						<?php get_template_part( 'content', 'header'); ?>
						<div class="site">
							<div class="content-wrapper entry entry-content">
							<?php if (is_active_sidebar('content_top')) : ?>
							<?php do_action('quark_before_content_top'); ?>
							<div id="content-top" role="complementary">
								<?php dynamic_sidebar('content_top'); ?>
							</div>
							<?php do_action('quark_after_content_top'); ?>
							<?php endif; ?>

								<?php the_content(); ?>

								<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'quark' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
							

	                        <?php get_template_part( 'content', 'footer' ); ?>

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

                    	</div>

				</article><!-- #post -->

				<?php comments_template(); ?>
			<?php endwhile; ?>
			<?php do_action('quark_after_content'); ?>

			
		</div><!-- #content -->		
	</div><!-- #primary -->

<?php get_footer(); ?>
