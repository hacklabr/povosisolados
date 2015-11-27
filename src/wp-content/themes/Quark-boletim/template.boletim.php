<?php
/*
Template Name: Boletim
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
wp_reset_query();
// set counters
$counter = 0;

// settings connected with the tabs
$tab_autoanim = 'disabled';
if(get_theme_mod('quark_tab_autoanim', 0) == 1) {
    $tab_autoanim = 'enabled';
}
$tab_interval = get_theme_mod('quark_tab_interval','5000');

//the_post();
$category = $post->post_name;

$args_global = array(
	'post_type' => 'post',
	'order' => 'DESC',
	'post__in' => get_option('sticky_posts'),
	'meta_key' => 'boletim',
  'meta_value' => $category,
	'orderby' => 'menu_order',
	'posts_per_page' => 6
);
$loop_news = get_posts($args_global);
wp_reset_query();
//var_dump($loop_news);

get_header('boletim'); ?>

	<?php do_action('quark_before_content'); ?>
		<div id="frontpage-wrap" role="main">

            <div class="frontpage-block box boletim">
				<div class="boletim-container site gk-cols" data-cols="3">
						<?php foreach ( $loop_news as $_post ){    ?>
                    <div class="boletim-box" data-sr="enter bottom and move 50px wait .2s">
                        <?php
                        $thumb_id = get_post_thumbnail_id($_post->ID);
                        $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
                        ?>
                        <div class="boletim-thumb" style="background-image:url('<?php echo $thumb_url[0]; ?>');" >
                        <a href="<?php echo get_permalink($_post->ID); ?>">
                        <h3 class="boletim-title"><?php echo $_post->post_title; ?></h3>
                        </a>
                        </div>
                    </div>
				    <?php }; wp_reset_query();?>
                </div>
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

                    $page_function = get_post_meta( $post->ID, 'page_function', true );

                    $children = get_children($args); ?>

                    <?php if(!empty($children) && $page_function == 'tabs'): ?>
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
<?php get_footer('boletim'); ?>
