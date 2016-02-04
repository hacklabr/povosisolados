<?php

	/*
		Template for the entry header
	*/

?>
<?php if(is_singular()) : ?>
    <?php if ( has_post_thumbnail() && !post_password_required() ) : ?>
        <?php
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($_post->ID), "header-boletim" );
        $url = $thumb[0];
        $thumb_id = get_post_thumbnail_id();
        $caption = get_post($thumb_id)->post_excerpt;
        ?>
    <?php endif; ?>
    <header class="entry-header" style="background-image:url('<?php echo $url; ?>');">
        <span class="caption"><?php echo $caption; ?></span>

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

                    echo '<span>' . __( 'Postado por: ', 'quark' ) . '</span>';
                    printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
                        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                        esc_attr( sprintf( __( 'Ver todos os posts por %s', 'quark' ), get_the_author() ) ),
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
                        echo __('Publicado em ', 'quark');
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
            esc_attr( sprintf( __( 'Ver todos os posts por %s', 'quark' ), get_the_author() ) ),
            get_the_author()
        );
    ?>
    </span></li>

    <?php if(current_user_can('edit_posts') || current_user_can('edit_pages')) : ?>
    <li>
        <?php edit_post_link(__( 'Edit', 'perfetta'), '<span class="edit-link">', '</span>'); ?>
    </li>
    <?php endif; ?>
</ul>
<?php endif; ?>

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


                <!--<div class="entry-gplus-button">
                                        <img src="/wp-content/themes/Quark-boletim/images/email.png">
                                    </div> -->

        </div>
        <?php do_action('quark_after_social_icons'); ?>

    <?php endif; ?>
<?php endif; ?>
