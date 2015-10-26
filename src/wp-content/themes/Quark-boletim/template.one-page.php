<?php
/*
Template Name: One Page
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

get_header(); ?>

<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

    <article class="one-page">

        <header class="entry-header<?php if ( '' == get_the_post_thumbnail()) : ?> no-image<?php endif; ?>">
            <?php if ( has_post_thumbnail() && !post_password_required() ) : ?>
                <?php do_action('photo_before_post_image'); ?>
                <?php the_post_thumbnail(); ?>
                <?php do_action('photo_after_post_image'); ?>
            <?php endif; ?>
            <?php if ( have_posts() ) : ?>    
                <div class="entry-title-wrap">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                    
                    <?php wp_reset_query(); ?>
                </div>
                <?php if(get_theme_mod('quark_header_mouse_icon',1) == 1) : ?>
                    <span class="mouse-icon"><span><span></span></span></span>
                <?php endif; ?>
            <?php endif; ?>
        </header>

    </article>
        <?php do_action('quark_before_content'); ?>
            <div id="frontpage-wrap" role="main">
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
                        } ?>

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

                        <?php $counter++; ?>
                        <?php endwhile; ?>  

                    <?php wp_reset_query(); ?>
                <?php endif; ?>
            </div><!-- frontpage-wrap -->
            <?php do_action('quark_after_content'); ?>
        </div>
    </div>
</div><!-- #main-->
</div><!-- #page -->
<?php get_footer('frontpage'); ?>
