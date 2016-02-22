<?php
/*
Template Name: Frontpage
*/
$frontpage = get_the_ID();
//create arguments for custom main loop
$args_global = array(
	'post_type' => 'page',
	'post_parent' => get_the_ID(),
	'order' => 'ASC',
	'orderby' => 'menu_order',
	'posts_per_page' => 100
);
$loop_global = new WP_Query( $args_global );

// set counters
$counter = 0;

// settings connected with the slider
$slider_autoanim = 'false';
if(get_theme_mod('quark_slider_autoanim', 1) == 1) {
    $slider_autoanim = 'true';
}
$slider_preview = 'false';
if(get_theme_mod('quark_slider_preview', 0) == 1) {
    $slider_preview = 'true';
}
$slider_interval = get_theme_mod('quark_slider_interval','5000');

// settings connected with the tabs
$tab_autoanim = 'disabled';
if(get_theme_mod('quark_tab_autoanim', 0) == 1) {
    $tab_autoanim = 'enabled';
}
$tab_interval = get_theme_mod('quark_tab_interval','5000');

$args_global = array(
	'post_type' => 'post',
	'order' => 'DESC',
	'post__in' => get_option( 'sticky_posts' ),
	'orderby' => 'menu_order',
	'posts_per_page' => 2
);
$loop_news = new WP_Query( $args_global );
//var_dump($loop_news);

$cfg = DestaquesHome::getOption(pll_current_language());


get_header('frontpage'); ?>

	<?php do_action('quark_before_content'); ?>
		<div id="frontpage-wrap" role="main">

            <div class="frontpage-block box news">
                <h2 class="section-title" data-sr="enter bottom and move 50px wait .1s">
                <?php _e('Notícias','cti');?></h2>

                <!-- notícia em destaque -->
                <div class="news-container site gk-cols" data-cols="1">
                    <?php
                    global $post;
                    $destaque = DestaquesHome::getPost('destaque');
                    $original_post = $post;
                    $post = $destaque;

                    $thumb_id = get_post_thumbnail_id();
                    $thumb_url = wp_get_attachment_image_src($thumb_id,'large', true);

                    ?>
                    <div class="news-box" data-sr="enter bottom and move 50px wait .2s">
                        <div class="news-thumb-destaque" style="background-image:url('<?php echo $thumb_url[0] ?>');" ></div>
                        <h3 class="news-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                        <div class="news-excerpt"><?php the_excerpt(); ?></div>
                        <a class="btn" href="#"><?php _e('Leia mais', 'cti') ?></a>
                    </div>
                    <?php $post = $original_post; ?>
                </div>

				<div class="news-container site gk-cols" data-cols="2">
					<?php while ( $loop_news->have_posts()): $loop_news->the_post(); ?>
                    <div class="news-box" data-sr="enter bottom and move 50px wait .2s">
                        <?php
                        $thumb_id = get_post_thumbnail_id();
                        $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
                        ?>
                        <?php if($thumb_id): ?>
                        <div class="news-thumb" style="background-image:url('<?php echo $thumb_url[0]; ?>');" ></div>
                        <?php endif; ?>
                        <h3 class="news-title"><a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?></a></h3>
                        <div class="news-excerpt"><?php the_excerpt(); ?></div>
                        <a class="btn" href="<?php the_permalink(); ?>"><?php _e('Leia mais', 'cti') ?></a>
                    </div>
				    <?php endwhile; wp_reset_query();?>
                </div>
                <div class="more-news site" data-sr="enter bottom and move 50px wait .4s">
                <a href="<?php echo site_url(); ?>/category/noticias/"><b><?php _e('Mais notícias','cti') ?></b><?php _e('clique aqui', 'cti') ?></a></div>
            </div>
            <div class="frontpage-block box">
                <div class='site'>
                    <div class="gk-cols links" data-cols="3">
                        <?php foreach([0,1,2] as $i): $link = $cfg['links'][$i]; ?>
                            <div class="box-links" data-sr="enter bottom and move 50px wait .<?php echo $i + 1; ?>s"><a href="<?php echo $link['url'] ?>"><span class="txt"><?php echo $link['titulo'] ?></span><span class="img"><img class=" size-full wp-image-450" src="<?php echo $link['img'] ?>" alt="<?php echo $link['titulo'] ?>" /></span></a></div>
                        <?php endforeach; ?>
                    </div>
                    <div class="gk-cols links" data-cols="2">
                        <?php
                        global $post;
                        $destaque = DestaquesHome::getPost('campanha');
                        $original_post = $post;
                        $post = $destaque;

                        $thumb_id = get_post_thumbnail_id();
                        $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
                        ?>
                        <div class="box-img" data-sr="enter bottom and move 50px wait .4s">
                            <?php if($thumb_id): ?>
                            <a href="<?php the_permalink() ?>"><span class="img"><img class="alignnone size-full wp-image-363" src="<?php echo $thumb_url[0] ?>" alt="<?php the_title() ?>" width="509" height="240" /></span></a>
                            <?php endif; ?>

                            <div class="img-legend"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div>
                        </div>
                        <?php $post = $original_post; ?>
                        <div class="box-video" data-sr="enter bottom and move 50px wait .5s"><?php echo stripslashes($cfg['video']) ?></div>
                    </div>
                </div>
            </div>


            <?php if ( $loop_global->have_posts() ) : ?>
                <?php while ( $loop_global->have_posts() ) : $loop_global->the_post(); ?>
                    <?php
                    $args = array(
                      'post_parent' => $frontpage->ID,
                      'post_type'   => 'page',
                      'posts_per_page' => 1,
                      'post_status' => 'publish'
                    );

                    $background_image = '';
                    // check if there is a featured image - it willbe used as a parallax background

                    $page_function = get_post_meta( $post->ID, 'page_function', true );

                    $children = get_children($args); ?>
										<?php //var_dump($children); ?>


                    <?php if(!empty($children) && $page_function == 'slider') : ?>

                    <div class="box slideshow">
                        <div id="gk-is-storefront-<?php echo $post->ID;?>" class="gk-is-wrapper-gk_quark site" data-sr="scale up 50% over 0.8s" data-interval="<?php echo $slider_interval; ?>" data-autoanimation="<?php echo $slider_autoanim; ?>" data-preview="<?php echo $slider_preview; ?>">

                        <?php
                            $query = new WP_Query( array ( 'post_type' => 'page', 'post_parent' => $post->ID, 'order' => 'ASC') );
                            $counter_slides = 0;
                            while ( $query->have_posts() ) : $query->the_post();

                                $figure_class = '';

                                if($counter_slides == 0) {
                                    $figure_class = ' class="gk-current"';
                                }

                                if($counter_slides == 1) {
                                    $figure_class = ' class="gk-next"';
                                }

                                $slide_url = get_post_meta( $post->ID, 'slide_url', true );

                            ?>
                                <figure<?php echo $figure_class; ?>>
                                <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>" <?php if($slide_url != '') : ?>data-link="<?php echo $slide_url; ?>"<?php endif; ?>>

                                    <figcaption>
                                        <h2>
                                            <?php if($slide_url != '') : ?><a href="<?php echo $slide_url;?>" class="inverse"><?php endif; ?>
                                            <?php the_title(); ?>
                                            <?php if($slide_url != ''): ?></a><?php endif; ?>
                                        </h2>
                                        <?php echo do_shortcode(str_replace(array('<p></p>'), '', get_the_content())); ?>
                                    </figcaption>
                                </figure>
                                <?php $counter_slides++; ?>
                            <?php endwhile; ?>

                            <?php if(get_theme_mod('quark_slider_slider', 1) == 1) : ?>
                            <div class="gk-slider">
                                <span class="gk-slider-bar"></span>
                                <span class="gk-slider-button"></span>
                            </div>
                            <?php endif; ?>

                                <?php if(get_theme_mod('quark_slider_pagination', 1) == 1) : ?>
                                <ul class="gk-is-quark-pagination">
                                <?php
                                    for($j = 0; $j < $counter_slides; $j++) {
                                        echo '<li'.($j == 0 ? ' class="active"' : '').'>'.($j+1).'</li>';
                                    }
                                ?>
                                </ul>
                                <?php endif; ?>
                        </div>
                    </div>

                    <?php elseif(!empty($children) && $page_function == 'tabs') : ?>
                    <?php

                        $args_tabs = array(
                          'post_parent' => $frontpage->ID, // the ID from your loop
                          'post_type'   => 'page',
                          'posts_per_page' => -1,
                          'post_status' => 'publish',
                          'order' => 'ASC'
                        );

                    ?>
                        <div class="gk-page">
                            <div class="frontpage-block<?php echo $additional_classes; ?>">
                            <div id="gk-tabs" class="transparent-tabs">
                                <div class="gk-tabs" data-event="click" data-autoanim="<?php echo $tab_autoanim; ?>" data-speed="1" data-interval="<?php echo $tab_interval; ?>" data-anim="opacity">
                                    <div class="gk-tabs-wrap">

                                        <?php
                                            $tabs = array();
                                            $tabs_content = array();
                                            $tabs_bg = array();
                                            $posts = get_posts($args_tabs);
                                            foreach ($posts as $post) {
                                                array_push($tabs, get_the_title());
                                                array_push($tabs_content, $post->post_content);
                                                if (has_post_thumbnail($post->ID)) {
                                                    array_push($tabs_bg, wp_get_attachment_url(get_post_thumbnail_id($post_ID)));
                                                }
                                            }

                                        ?>

                                        <ol class="gk-tabs-nav">
                                            <?php
                                                for($i = 0; $i < count($tabs); $i++) {
                                                    echo '<li'.(($i == 0) ? ' class="active"' : '').'>' .$tabs[$i]. '</li>';
                                                }
                                            ?>
                                        </ol>

                                        <div class="gk-tabs-container">
                                            <?php
                                            for($j = 0; $j < count($tabs_content); $j++) {
                                                if ($tabs_bg[$j] != '') {
                                                    $tab_background = ' style="background-image: url(\''.$tabs_bg[$j].'\');"';
                                                } else {
                                                    $tab_background = '';
                                                }

                                                 $additional_classes = '';

                                                 if(stripos($tabs_content[$j], 'very-big-spaces') !== FALSE) {
                                                    $additional_classes .= ' very-big-spaces';
                                                 }

                                                 if(stripos($tabs_content[$j], 'bigger-spaces') !== FALSE) {
                                                    $additional_classes .= ' bigger-spaces';
                                                 }

                                                 if(stripos($tabs_content[$j], 'color-bg') !== FALSE) {
                                                    $additional_classes .= ' color-bg';
                                                 }

                                                 if(stripos($tabs_content[$j], 'gray-bg') !== FALSE) {
                                                    $additional_classes .= ' gray-bg';
                                                 }

                                                 if(stripos($tabs_content[$j], 'dark-bg') !== FALSE) {
                                                    $additional_classes .= ' dark-bg';
                                                 }

                                                 if(stripos($tabs_content[$j], 'parallax-bg') !== FALSE) {
                                                    $additional_classes .= ' parallax-bg';
                                                 }

                                                 echo '<div class="gk-tabs-item'.(($j == 0) ? ' active' : '').'"><div class="box '.$additional_classes.'" '. $tab_background .'>' . do_shortcode($tabs_content[$j]). '</div></div>';
                                            }

                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>


                <?php elseif(!empty($children) && $page_function == 'preview') :  /*?>
                    <?php
                        $args_tabs = array(
                          'post_parent' => $frontpage->ID, // the ID from your loop
                          'post_type'   => 'page',
                          'posts_per_page' => -1,
                          'post_status' => 'publish',
                          'order' => 'ASC'
                        );
					?>
					   <div class="frontpage-block box map <?php echo $additional_classes; ?>">

							<h2 class="section-title" data-sr="enter bottom and move 50px wait .1s"><?php _e('Mapa Interativo', 'cti') ?></h2>
							<div class="gk-cols site" data-cols="2">
								<div>
									<a class="btn-map-frontpage" href="#" target="_blank"><?php echo get_the_title(); ?></a>
								</div>
                                <div>
								    <?php echo get_the_content(); ?>
                                </div>
							</div>

						</div><!-- frontpage-wrap -->

				<?php */ else : ?>
                    <?php if(has_post_thumbnail()) : ?>
                        <div class="gk-clearfix">
                    <?php endif; ?>
                    <div class="frontpage-block box<?php echo $additional_classes; ?>" <?php echo $background_image; ?>>

                        <div class="site">
                            <?php echo do_shortcode(str_replace(array('<p></p>'), '', get_the_content())); ?>
                        </div>
                    </div>
                    <?php if(has_post_thumbnail()) : ?>
                        </div>
                    <?php endif; ?>


                    <?php endif; ?>
                    <?php $counter++; ?>
                    <?php endwhile; ?>

                <?php wp_reset_query(); ?>
            <?php endif; ?>
        </div><!-- frontpage-wrap -->
	<?php do_action('quark_after_content'); ?>
<?php get_footer('frontpage'); ?>
