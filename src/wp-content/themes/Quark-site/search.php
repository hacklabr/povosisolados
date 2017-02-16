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

					<?php if($_GET['s'] != ''): ?>
						<h1 class="entry-title">
							<span>
								<?php printf( __( 'Resultado da busca para: %s', 'quark' ), get_search_query() ); ?>
							</span>
						</h1>
					<?php endif; ?>

					<div id="gk-search">
						<?php get_search_form(); ?>
					</div>

					<div class="searchintro">
						<p>
							<strong><?php printf( __( '%s resultados encontrados.' ), $wp_query->found_posts ); ?></strong>
						</p>
					</div>

				</div>
			</header>
			<div class="site">
				<div class="content-wrapper" style="padding-top:50px">
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

					<nav class="navigation paging-navigation" role="navigation">
						<h3 class="screen-reader-text"><?php _e( 'Posts navigation', 'quark' ); ?></h3>
						<div class="nav-links">
							<?php if ( get_next_posts_link() ) {
								$page_prev = '';
								$page_next = '';
								
								if(isset($_GET['paged']) && $_GET['paged'] != ''){
									$page_prev = '&paged=' . (((int)$_GET['paged']) - 1);
									$page_next = '&paged=' . (((int)$_GET['paged']) + 1);
								}
								?>
								<div class="nav-previous">
									<a href="/?s=<?= $_GET['s'] . $page_prev ?>">
										<?= __( '<span class="meta-nav">&larr;</span> Posts antigos', 'quark' ) ?>
									</a>
								</div>
								<?php 
							} ?>
							<?php if ( get_previous_posts_link() ) : ?>
								<div class="nav-next">
									<a href="/?s=<?= $_GET['s'] . $page_next ?>">
										<?= __( '<span class="meta-nav">&larr;</span> Posts novos', 'quark' ) ?>
									</a>
								</div>
							<?php endif; ?>
						</div>
					</nav>

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
<script>document.title = 'Resultados de Busca'</script>
<?php get_footer('frontpage'); ?>
