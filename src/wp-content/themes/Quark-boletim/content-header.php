<?php

	/*
		Template for the entry header
	*/

?>
<?php if(is_singular()) : ?>
    <header class="entry-header<?php if ( '' == get_the_post_thumbnail()) : ?> no-image<?php endif; ?>">
        <?php if ( has_post_thumbnail() && !post_password_required() ) : ?>
            <?php do_action('photo_before_post_image'); ?>
            <?php the_post_thumbnail(); ?>
            <?php do_action('photo_after_post_image'); ?>
        <?php endif; ?>
            
        <div class="entry-title-wrap">
             <?php if(get_post_format() != '') : ?>
                <span class="format gk-format-<?php echo get_post_format(); ?>"></span>
            <?php endif; ?>
            <h1 data-sr="enter bottom and move 50px" class="entry-title">
                <?php the_title(); ?>
            </h1>

            <?php
                if ('post' == get_post_type() || 'page' == get_post_type() ) {
                    $date_format = esc_html(get_the_date('l, j F Y'));
                    $subtitle = get_post_meta(get_the_ID(), 'quark_subtitle', true);

                    if($subtitle != '') {
                        echo '<p class="gk-subtitle">' .$subtitle. '</p>';
                    } else {

                        if(get_theme_mod('quark_date_format', 'default') == 'wordpress') {
                            $date_format = get_the_date(get_option('date_format'));
                        }

                        echo sprintf('<time data-sr="enter bottom and move 50px and wait .2s" class="entry-date" datetime="'. esc_attr(get_the_date('c')) . '">'. $date_format . '</time>');
                    }
                }
            ?>
        </div>

        <?php if(is_single() || is_page() && (has_post_thumbnail())) : ?>
            <?php echo quark_post_thumbnail_caption(); ?>
        <?php endif; ?>

        <?php if(get_theme_mod('quark_header_mouse_icon',1) == 1) : ?>
            <span class="mouse-icon"><span><span></span></span></span>
        <?php endif; ?>

    </header>
<?php else : ?>
    <header>
        <h2 class="entry-title<?php if(is_sticky()) : ?> sticky<?php endif; ?>">
            <a href="<?php the_permalink(); ?>" rel="bookmark" class="inverse">
                <?php the_title(); ?>
            </a>
        </h2>

        <ul class="item-info">
            <?php if(get_post_format() != '') : ?>
            <li>
                <span class="format gk-format-<?php echo get_post_format(); ?>"></span>
            </li>
            <?php endif; ?>

            <?php
                if ('post' == get_post_type() ) {
                    $date_format = esc_html(get_the_date('l, j F Y'));

                    if(get_theme_mod('quark_date_format', 'default') == 'wordpress') {
                        $date_format = get_the_date(get_option('date_format'));
                    }

                    echo sprintf('<li class="quark-date"><time class="entry-date" datetime="'. esc_attr(get_the_date('c')) . '">'. $date_format . '</time></li>');
                }
            ?>
            <?php if(!is_author()) : ?>
                <li> <span>
                <?php

                    echo '<span>' . __( 'Posted by: ', 'quark' ) . '</span>';
                    printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
                        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                        esc_attr( sprintf( __( 'View all posts by %s', 'quark' ), get_the_author() ) ),
                        get_the_author()
                    );
                ?>
                </span></li>
            <?php endif; ?>
            <?php if(is_author()) : ?>
                <?php
                    // Translators: used between list items, there is a space after the comma.
                    $categories_list = get_the_category_list( __( ', ', 'quark' ) );
                    if ( $categories_list ) :
                ?>
                <li>
                    <?php
                        echo __('Published in ', 'quark');
                        echo '<span class="categories-links">' . $categories_list . '</span>';
                    ?>
                </li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </header>
<?php endif; ?>


<?php if(is_single()) : ?>
<ul class="item-info">
   
    <?php
        // Translators: used between list items, there is a space after the comma.
        $categories_list = get_the_category_list( __( ', ', 'quark' ) );
        if ( $categories_list ) :
    ?>
    <li>
        <?php
            echo '<span class="categories-links">' . $categories_list . '</span>';
        ?>
    </li>
    <?php endif; ?>

    <li> <span>
    <?php

        echo '<span>' . __( 'Posted by: ', 'quark' ) . '</span>';
        printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            esc_attr( sprintf( __( 'View all posts by %s', 'quark' ), get_the_author() ) ),
            get_the_author()
        );
    ?>
    </span></li>

    <?php if (!post_password_required() && (comments_open() || get_comments_number())) : ?>
    <li class="comments-link">
        <?php comments_popup_link( __( 'Leave a comment', 'quark' ), __( '1 Comment', 'quark' ), __( '% Comments', 'quark' ) ); ?>
    </li>
    <?php endif; ?>

    <?php if(current_user_can('edit_posts') || current_user_can('edit_pages')) : ?>
    <li>
        <?php edit_post_link(__( 'Edit', 'perfetta'), '<span class="edit-link">', '</span>'); ?>
    </li>
    <?php endif; ?>
</ul>
<?php endif; ?>
