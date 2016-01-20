<?php
/*
Template Name: Frontpage
*/

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
	'category_name' => 'noticias',
	'orderby' => 'menu_order',
	'posts_per_page' => 2
);
$loop_news = new WP_Query( $args_global );
//var_dump($loop_news);

get_header('frontpage'); ?>

	<?php do_action('quark_before_content'); ?>
		<div id="frontpage-wrap" role="main">

            <div class="frontpage-block box news">
                <h2 class="section-title" data-sr="enter bottom and move 50px wait .1s">
                <?php _e("Notícias","SLUG");?></h2>

                <!-- notícia em destaque -->
                <div class="news-container site gk-cols" data-cols="1">
                    <div class="news-box" data-sr="enter bottom and move 50px wait .2s">
                        <div class="news-thumb" style="background-image:url('http://lorempixel.com/1920/400/');" ></div>
                        <h3 class="news-title"><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan dapibus blandit</a></h3>
                        <div class="news-excerpt"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan dapibus blandit. Vestibulum feugiat scelerisque diam. Vestibulum vitae pharetra dui. Curabitur ut dictum erat. Nam a finibus augue. Integer tempus malesuada pharetra. Integer aliquet diam quis ante iaculis, et imperdiet tellus iaculis.</p></div>
                        <a class="btn" href="#">Leia mais</a>
                    </div>
                </div>

				<div class="news-container site gk-cols" data-cols="2">
					<?php while ( $loop_news->have_posts()): $loop_news->the_post(); ?>
                    <div class="news-box" data-sr="enter bottom and move 50px wait .2s">
                        <?php
                        $thumb_id = get_post_thumbnail_id();
                        $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
                        ?>
                        <div class="news-thumb" style="background-image:url('<?php echo $thumb_url[0]; ?>');" ></div>
                        <h3 class="news-title"><a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?></a></h3>
                        <div class="news-excerpt"><?php the_excerpt(); ?></div>
                        <a class="btn" href="<?php the_permalink(); ?>">Leia mais</a>
                    </div>
				    <?php endwhile; wp_reset_query();?>
                </div>
                <div class="more-news site" data-sr="enter bottom and move 50px wait .4s">
                <a href="<?php echo site_url(); ?>/category/noticias/"><b>Mais notícias</b>clique aqui</a></div>
            </div>

            <?php if ( $loop_global->have_posts() ) : ?>
                <?php while ( $loop_global->have_posts() ) : $loop_global->the_post(); ?>
                    <?php
                    $args = array(
                      'post_parent' => $post->ID,
                      'post_type'   => 'page',
                      'posts_per_page' => 1,
                      'post_status' => 'publish'
                    );

                    $background_image = '';
                    // check if there is a featured image - it willbe used as a parallax background
                    if(has_post_thumbnail()) {
                        $background_image = ' style="background-image: url(\''.wp_get_attachment_url(get_post_thumbnail_id()).'\');"';
                    }

                    $additional_classes = '';

                    if(stripos(get_the_content(), 'very-big-spaces') !== FALSE) {
                        $additional_classes .= ' very-big-spaces';
                    }

                    if(stripos(get_the_content(), 'bigger-spaces') !== FALSE) {
                        $additional_classes .= ' bigger-spaces';
                    }

                    if(stripos(get_the_content(), 'small-spaces') !== FALSE) {
                        $additional_classes .= ' small-spaces';
                    }

                    if(stripos(get_the_content(), 'gk-description-wrap') !== FALSE) {
                        $additional_classes .= ' gk-description';
                    }

                    if(stripos(get_the_content(), 'gk-testimonials') !== FALSE) {
                        $additional_classes .= ' testimonials';
                    }

                    if(stripos(get_the_content(), 'gray-bg') !== FALSE) {
                        $additional_classes .= ' gray-bg';
                    }

                    if(stripos(get_the_content(), 'dark-bg') !== FALSE) {
                        $additional_classes .= ' dark-bg';
                    }

                    if(stripos(get_the_content(), 'newsletter-gk') !== FALSE) {
                        $additional_classes .= ' newsletter';
                    }

                    if(stripos(get_the_content(), 'small-text') !== FALSE) {
                        $additional_classes .= ' small-text';
                    }

                    if(has_post_thumbnail()) {
                        $additional_classes .= ' parallax-bg';
                    }

                    $page_function = get_post_meta( $post->ID, 'page_function', true );

                    $children = get_children($args); ?>

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
                          'post_parent' => $post->ID, // the ID from your loop
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

                    <?php else : ?>
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
