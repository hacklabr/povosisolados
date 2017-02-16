<?php
/**
 * The template for displaying Search results
 *
 */
global $wp_query;
get_header("frontpage");  ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content search-page" role="main">
		
			<?php do_action('quark_before_content'); ?>
			<?php if ( have_posts() ) : ?>

				<header class="entry-header<?php if(get_theme_mod('quark_search_bg','') == '') : ?> no-image<?php endif; ?>">
					<?php if(get_theme_mod('quark_search_bg','') !== '') : ?>
						<img src="<?php echo get_theme_mod('quark_search_bg',''); ?>" class="author-image-bg" alt="<?php echo get_the_author(); ?>">
					<?php endif; ?>
					<div class="entry-title-wrap site">

	                    <h1 class="entry-title">
							<span>
		                    	<?php printf( __( 'Resultado da busca para: %s', 'quark' ), get_search_query() ); ?>
		                    </span>
	                    </h1>

	                    <div id="gk-search">
							<div>
								<?php get_search_form(); ?>
							</div>
						</div>

						<div class="searchintro">
							<p>
								<strong><?php printf( __( 'Total: %s results found.' ), $wp_query->found_posts ); ?></strong>
							</p>
						</div>

	                </div>
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
                            <div><?php get_template_part( 'content-category', get_post_format() ); ?></div>
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

<?php get_footer('boletim'); ?>
