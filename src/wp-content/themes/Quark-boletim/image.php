<?php
/**
 * The template for displaying image attachments
 *
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content site" role="main">
			<?php do_action('quark_before_content'); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>

				<div class="content-wrapper">
					<?php if (is_active_sidebar('content_top')) : ?>
					<?php do_action('quark_before_content_top'); ?>
					<div id="content-top" role="complementary">
						<?php dynamic_sidebar('content_top'); ?>
					</div>
					<?php do_action('quark_after_content_top'); ?>
					<?php endif; ?>

					<header>
				        <h1>
				            <?php the_title(); ?>
				        </h1>
				    </header>

					<div class="entry-content entry-attachment">
						<div class="attachment">
							<?php quark_the_attached_image(); ?>

							<?php if ( has_excerpt() ) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div>
							<?php endif; ?>
						</div><!-- .attachment -->

						<?php if ( ! empty( $post->post_content ) ) : ?>
						<div class="entry-description">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'quark' ), 'after' => '</div>' ) ); ?>
						</div><!-- .entry-description -->
						<?php endif; ?>

						<nav id="image-navigation" class="paging-navigation" role="navigation">
							<span class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Anterior', 'quark' ) ); ?></span>
							<span class="nav-next"><?php next_image_link( false, __( 'Próximo <span class="meta-nav">&rarr;</span>', 'quark' ) ); ?></span>
						</nav><!-- #image-navigation -->
					</div>

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
			</article><!-- #post -->
			<?php do_action('quark_after_content'); ?>

			<?php comments_template(); ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
