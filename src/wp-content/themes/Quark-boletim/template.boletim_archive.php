<?php
/*
Template Name: Arquivo de Boletins
*/

$args_global = array(
    'post_type' => 'page',
    'order' => 'DESC',
    'category_name' => 'boletim',
    'orderby' => 'menu_order',
    'posts_per_page' => 12
);

$loop_news = new WP_Query( $args_global );

$is_id = get_the_ID();

get_header('boletim'); 
do_action('quark_before_content');
?>
<div id="frontpage-wrap" role="main">
    <div class="frontpage-block box boletim">
        <div class="boletim-container site gk-cols" data-cols="3">
        <?php 
        while ( $loop_news->have_posts()): $loop_news->the_post();
            if ( get_the_ID() != $is_id ) :
        ?>
            <div class="boletim-box" data-sr="enter bottom and move 50px wait .2s">
                <?php
                $thumb_id = get_post_thumbnail_id();
                $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
                $caption = get_post($thumb_id)->post_excerpt;
                ?>
                <div class="boletim-thumb" style="background-image:url('<?php echo $thumb_url[0]; ?>');" >
                    <a href="<?php the_permalink(); ?>">
                        <h3 class="boletim-title"><?php the_title(); ?></h3>
                    </a>
                </div>
                <span class="caption"><?php echo $caption; ?></span>
            </div>
        <?php
            endif;
        endwhile;
        wp_reset_query();
        ?>
        </div>
    </div>
</div><!-- frontpage-wrap -->
<?php do_action('quark_after_content'); ?>
<?php get_footer('boletim'); ?>
