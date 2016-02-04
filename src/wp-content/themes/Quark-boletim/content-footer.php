<?php

	/*
		Template for the content item footer
	*/

?>

<?php do_action('quark_before_post_meta'); ?>
<footer class="entry-meta">
	<?php do_action('quark_before_post_tags'); ?>
	<div class="entry-tags">
		<?php
			// Translators: used between list items, there is a space after the comma.
			$tag_list = get_the_tag_list();
			if ( $tag_list ) {
				echo '<span class="tags-links">' . $tag_list . '</span>';
			}
		?>
	</div>
	<?php do_action('quark_after_post_tags'); ?>

	<?php
		if ('post' == get_post_type() && get_theme_mod('quark_related_posts', '1') == '1') {
			//for use in the loop, list 5 post titles related to first tag on current post
			$tags = wp_get_post_tags($post->ID);
			if ($tags) {
				do_action('quark_before_related_posts');
				$first_tag = $tags[0]->term_id;
				$args=array(
					'tag__in' => array($first_tag),
					'post__not_in' => array($post->ID),
					'posts_per_page' => 5,
					'ignore_sticky_posts' => 1
				);
				/*$my_query = new WP_Query($args);
				if( $my_query->have_posts() ) {
					echo '<div class="entry-related">';
					echo '<h3>' . __('Related Posts', 'quark') . '</h3>';

					while ($my_query->have_posts()) {
						$my_query->the_post();
						?>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to ', 'quark'); ?><?php the_title_attribute(); ?>" class="inverse">
							<?php the_post_thumbnail('medium'); ?>
							<strong><?php the_title(); ?></strong>
						</a>
						<?php
					}

					echo '</div>';
				}
				wp_reset_query();
				do_action('quark_after_related_posts');*/
			}
		}
	?>
</footer><!-- .entry-meta -->
<?php do_action('quark_after_post_meta'); ?>
<?php

// EOF
