<?php
/**
 * The template for displaying all single posts
 */

get_header("frontpage"); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php do_action('quark_before_content'); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
				<?php comments_template(); ?>
			<?php endwhile; ?>
			<?php do_action('quark_after_content'); ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer("frontpage"); ?>
