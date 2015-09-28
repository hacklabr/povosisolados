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

    <?php if(is_singular() && get_theme_mod('quark_'.(is_page() ? 'page' : 'post').'_social_icons', '1') == '1') : ?>
        <?php do_action('quark_before_social_icons'); ?>
        <?php if(get_theme_mod('quark_popup_social_icons',1) == 1) : ?>
			 <span class="gk-social-icons">
	  		  	<i class="fa fa-share-alt"></i>
	  		  	
	  		  	<span>
	  		  		<?php if(get_theme_mod('quark_popup_social_fb', 1) == 1) : ?>
	  		  			<a href="https://www.facebook.com/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank"><i class="fa fa-facebook"></i> Facebook</a>
	  		  		<?php endif; ?>
	  		  		
	  		  		<?php if(get_theme_mod('quark_popup_social_twitter', 1) == 1) : ?>
	  		  			<a href="http://twitter.com/intent/tweet?source=sharethiscom&amp;url=<?php echo get_permalink(); ?>" target="_blank"><i class="fa fa-twitter"></i> Twitter</a>
	  		  		<?php endif; ?>
	  		  		
	  		  		<?php if(get_theme_mod('quark_popup_social_gplus', 1) == 1) : ?>
	  		  			<a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" target="_blank"><i class="fa fa-google-plus"></i> Google+</a>
	  		  		<?php endif; ?>
	  		  		
	  		  		<?php if(get_theme_mod('quark_popup_social_pinterest', 1) == 1) : ?>
	  		  			<a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());"><i class="fa fa-pinterest-p"></i> Pinterest</a>
	  		  		<?php endif; ?>

	  		  		<?php if(get_theme_mod('quark_popup_social_linked', 0) == 1) : ?>
		          		<a href="https://www.linkedin.com/cws/share?url=<?php echo get_permalink(); ?>"><i class="fa fa-linkedin"></i> LinkedIn</a>
		          	<?php endif; ?>
		          		
		          	<?php if(get_theme_mod('quark_popup_social_vk', 0) == 1) : ?>
		          		<a href="http://vkontakte.ru/share.php?url=<?php echo get_permalink(); ?>"><i class="fa fa-vk"></i> VK</a>
		          	<?php endif; ?>
	  		  	</span>
	  		  </span>

    	<?php else : ?>

	        <div class="entry-social-sharing">
	            
				<?php if(get_theme_mod('quark_social_twitter', 1) == 1) : ?>
		            <?php do_action('quark_before_twitter_icon'); ?>
		            <div class="entry-twitter-button">
		                <a href="https://twitter.com/share" class="twitter-share-button" data-count="vertical">Tweet</a>
		                <?php if(get_theme_mod('quark_cookie_enable', 1) == 1) : ?>
		                	<script type="text/plain" class="cc-onconsent-social" src="//platform.twitter.com/widgets.js"></script>
		            	<?php else : ?>
							<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
		        		<?php endif; ?>
		            </div>
		            <?php do_action('quark_after_twitter_icon'); ?>
	        	<?php endif; ?>

				<?php if(get_theme_mod('quark_social_fb', 1) == 1) : ?>
					<?php do_action('quark_before_fb_icon'); ?>
		            <div class="entry-facebook-button">
		                <?php if(get_theme_mod('quark_cookie_enable', 1) == 1) : ?>
		                	<script type="text/plain" class="cc-onconsent-social">
		                <?php else : ?>
		                	<script type="text/javascript">
		                <?php endif; ?>
	                        var root = document.createElement('div');
	                        root.id = 'fb-root';
	                        jQuery('.entry-facebook-button')[0].appendChild(root);
	                        (function(d, s, id) {
	                            var js, fjs = d.getElementsByTagName(s)[0];
	                            if (d.getElementById(id)) {return;}
	                            js = d.createElement(s); js.id = id;
	                            js.src = document.location.protocol + "//connect.facebook.net/en_US/all.js#xfbml=1";
	                            fjs.parentNode.insertBefore(js, fjs);
	                        }(document, 'script', 'facebook-jssdk'));
		                </script>
		                <div class="fb-like" data-width="150" data-layout="box_count" data-action="like" data-show-faces="false"></div>
		            </div>
		            <?php do_action('quark_after_fb_icon'); ?>
	        	<?php endif; ?>

				<?php if(get_theme_mod('quark_social_gplus', 1) == 1) : ?>
					<?php do_action('quark_before_gplus_icon'); ?>
		            <div class="entry-gplus-button">
		                <div class="g-plusone" data-size="tall"></div>
		                <?php
		                	$lang = explode('-', get_bloginfo('language'));
							$lang = $lang[0];
		                ?>
		                <?php if(get_theme_mod('quark_cookie_enable', 1) == 1) : ?>
		               		<script type="text/plain" class="cc-onconsent-social">
		                <?php else : ?>
		                	<script type="text/javascript">
		                <?php endif; ?>
		                window.___gcfg = {lang: '<?php echo $lang; ?>'};

		                (function() {
		                    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		                    po.src = 'https://apis.google.com/js/platform.js';
		                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		                })();
		                </script>
		            </div>
		            <?php do_action('quark_after_gplus_icon'); ?>
	        	<?php endif; ?>


	        </div>
	        <?php do_action('quark_after_social_icons'); ?>

    	<?php endif; ?>
    <?php endif; ?>

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
