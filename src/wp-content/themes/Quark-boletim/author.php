<?php
/**
 * The template for displaying Author archive pages
 *
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content author-page" role="main">
			<?php do_action('quark_before_content'); ?>
			<?php if ( have_posts() ) : ?>
				<?php the_post(); ?>

				<?php rewind_posts(); ?>
				<header class="entry-header<?php if(get_theme_mod('quark_author_bg','') == '') : ?> no-image<?php endif; ?>">
					<?php if(get_theme_mod('quark_author_bg','') !== '') : ?>
						<img src="<?php echo get_theme_mod('quark_author_bg',''); ?>" class="author-image-bg" alt="<?php echo get_the_author(); ?>">
					<?php endif; ?>
					<div class="author-info bigtitle">
	                    <?php
	                        $author_bio_avatar_size = apply_filters( 'quark_author_bio_avatar_size', 124 );
	                        echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
	                    ?>
	                    <h1 class="entry-title"><span><?php printf( __( '%s', 'quark' ), get_the_author() ); ?></span></h1>

	                    <?php if ( get_the_author_meta( 'description' ) ) : ?>
	                    <p>
	                        <?php echo strip_tags(get_the_author_meta('description')); ?>
	                    </p>
	                    <?php endif; ?>

	                    <?php if(get_the_author_meta('user_url')) : ?>
	                    <p>
	                        <?php _e('Website URL:', 'quark'); ?>
	                        <a href="<?php echo get_the_author_meta('user_url'); ?>"><?php echo get_the_author_meta('user_url'); ?></a>
	                    </p>
	                    <?php endif; ?>
	                </div><!-- .author-info -->
	                <?php if(get_theme_mod('quark_header_mouse_icon',1) == 1) : ?>
			            <span class="mouse-icon"><span><span></span></span></span>
			        <?php endif; ?>
            	</header>
				<div class="site">
					<div class="content-wrapper">

						<?php if (is_active_sidebar('content_top')) : ?>
						<?php do_action('quark_before_content_top'); ?>
						<div id="content-top" role="complementary">
							<?php dynamic_sidebar('content_top'); ?>
						</div>
						<?php do_action('quark_after_content_top'); ?>
						<?php endif; ?>

						<?php while ( have_posts() ) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('tag-page archive-page'); ?>>
								<?php get_template_part( 'content', 'header'); ?>
							</article>
						<?php endwhile; ?>

						<?php quark_paging_nav(); ?>

						<?php if (is_active_sidebar('content_bottom')) : ?>
						<?php do_action('quark_before_content_bottom'); ?>
						<div id="content-bottom" role="complementary">
							<?php dynamic_sidebar('content_bottom'); ?>
						</div>
						<?php do_action('quark_after_content_bottom'); ?>
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
