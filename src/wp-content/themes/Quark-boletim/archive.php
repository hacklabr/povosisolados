<?php
/**
 *
 * Archive page
 *
 **/

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content site" role="main">

			<?php do_action('quark_before_content'); ?>
			<?php if ( have_posts() ) : ?>
			<div class="site">
				<div class="content-wrapper">
					<?php if (is_active_sidebar('content_top')) : ?>
					<?php do_action('quark_before_content_top'); ?>
					<div id="content-top" role="complementary">
						<?php dynamic_sidebar('content_top'); ?>
					</div>
					<?php do_action('quark_after_content_top'); ?>
					<?php endif; ?>

					<header class="bigtitle no-desc">
						<h1 class="header">
	                        <span>
	        					<?php if ( is_day() ) : ?>
	        						<?php printf( __( 'Daily Archives: %s', 'quark' ), '<span>' . get_the_date() . '</span>' ); ?>
	        					<?php elseif ( is_month() ) : ?>
	        						<?php printf( __( 'Monthly Archives: %s', 'quark' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
	        					<?php elseif ( is_year() ) : ?>
	        						<?php printf( __( 'Yearly Archives: %s', 'quark' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
	        					<?php else : ?>
	        						<?php _e( 'Blog Archives', 'quark' ); ?>
	        					<?php endif; ?>
	                        </span>
						</h1>
					</header>

					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('archive-article archive-page'); ?>>
							<?php get_template_part( 'content', 'header'); ?>
						</article>
					<?php endwhile; ?>

					<?php quark_paging_nav(); ?>

					<?php if (is_active_sidebar('content_bottom')) : ?>
					<?php do_action('quark_before_content_bottom'); ?>
					<div id="content-bottom" role="complementary">
						<?php dynamic_sidebar('content_bottom'); ?>
					</div>
					<?php do_action('quark_before_content_bottom'); ?>
					<?php endif; ?>
				</div>

				<?php if (is_active_sidebar('sidebar')) : ?>
				<?php do_action('quark_before_sidebar'); ?>
				<aside id="sidebar" role="complementary">
					<?php dynamic_sidebar('sidebar'); ?>
				</aside>
				<?php do_action('quark_after_sidebar'); ?>
		<?php endif; ?>

			</div>
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
			<?php do_action('quark_after_content'); ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
