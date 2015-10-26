<?php
/**
 * The template for displaying a "No posts found" message
 */
?>

<header class="entry-header<?php if(get_theme_mod('quark_search_bg','') == '') : ?> no-image<?php endif; ?>">
    <?php if(get_theme_mod('quark_search_bg','') !== '') : ?>
        <img src="<?php echo get_theme_mod('quark_search_bg',''); ?>" class="author-image-bg" alt="<?php echo get_the_author(); ?>">
    <?php endif; ?>
    <div class="entry-title-wrap site">
        
        <h1 class="entry-title">
            <span>
                <?php _e( 'Nothing Found', 'quark' ); ?>
            </span>
        </h1>

        <div class="site">
        <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
            <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'quark' ), admin_url( 'post-new.php' ) ); ?></p>
        <?php elseif ( is_search() ) : ?>
            <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'quark' ); ?></p>
            <?php get_search_form(); ?>
        <?php else : ?>
            <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'quark' ); ?></p>
            <?php get_search_form(); ?>
        <?php endif; ?>
    </div><!-- .page-content -->

    </div>
</header>
