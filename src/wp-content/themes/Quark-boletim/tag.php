<?php
/**
 * The template for displaying Category pages
 *
 */

get_header('boletim'); ?>

    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">

            <?php do_action('quark_before_content'); ?>
            <?php if ( have_posts() ) : 
                $category_images = unserialize(get_option('gk_taxonomy_images'));
                $category = get_the_category();
            ?>
                <header class="entry-header<?php if($category_images[$category[0]->term_id] == '') : ?> no-image<?php endif; ?>">
                    <?php if($category_images[$category[0]->term_id] !== '') : ?>
                        <?php 
                            $img = gk_taxonomy_image($category[0]->term_id, 'category-image', '', false);
                        ?>

                        <?php if($img) : ?>
                            <?php echo $img; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <div class="entry-title-wrap">
                        <h1 data-sr="enter bottom and move 50px" class="header">
                            <span>
                                <?php echo single_cat_title( '', false ); ?>
                            </span>
                        </h1>
                        <?php if ( category_description() ) : 
                             $cat_desc = strip_tags(category_description());
                        ?>
                            <p data-sr="enter bottom and move 50px and wait .2s"><?php echo preg_replace('@\[br\]@', '<br />', $cat_desc); ?></p>
                        <?php endif; ?>
                    </div>

                    <?php if(get_theme_mod('quark_header_mouse_icon',1) == 1) : ?>
                        <span class="mouse-icon"><span><span></span></span></span>
                    <?php endif; ?>
                    
                </header><!-- .archive-header -->
                <div class="site">
                    <div class="content-wrapper">
                        <?php if (is_active_sidebar('content_top')) : ?>
                        <?php do_action('quark_before_content_top'); ?>
                        <div id="content-top" role="complementary">
                            <?php dynamic_sidebar('content_top'); ?>
                        </div>
                        <?php do_action('quark_after_content_top'); ?>
                        <?php endif; ?>

                        <div class="site gk-cols" data-cols="2">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <div><?php get_template_part( 'content-category', get_post_format() ); ?></div>
                        <?php endwhile; ?>
                        </div>
                        
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

<?php get_footer(); ?>
