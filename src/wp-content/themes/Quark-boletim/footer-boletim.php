<?php
/**
 * The template for displaying the footer from Boletim Page
 *
 */
 global $post_original;

?>

      <?php do_action('quark_before_footer'); ?>
      <!-- Begin #pre-footer -->
      <footer id="pre-footer" role="contentinfo">
        <div class="site">
                <div class="gk-cols" data-cols="3">
                  <div class="social">
                    <div class="expediente">
                      <?php dynamic_sidebar('prefooter_esquerda'); ?>
                    </div>
                  </div>
                    <div class="expediente">
                      <?php dynamic_sidebar('prefooter_centro'); ?>
                    </div>
                    <div class="subscribe">
                        <h4><?php _e('Receba o boletim' , 'quark'); ?></h4>
                        <?php _e('Mantenha-se informado sobre a situação dos povos indígenas isolados', 'SLUG'); ?>
                        <form>
                          <input type="text" placeholder="E-mail">
                          <button>
                            <span class="screen-reader-text"><?php _e('Enviar', 'quark'); ?></span>
                          </button>
                        </form><p>
                        <?php dynamic_sidebar('prefooter_direita'); ?>
                    </div>
                </div>
        </div>
      </footer>
      <!-- End of #pre-footer -->
        <footer id="gk-footer" role="contentinfo">
            <div class="site">
                <div class="gk-cols" data-cols="5">
                    <?php dynamic_sidebar('footer_1'); ?>
                    <?php dynamic_sidebar('footer_2'); ?>
                    <?php dynamic_sidebar('footer_3'); ?>
                    <?php dynamic_sidebar('footer_4'); ?>
                    <?php dynamic_sidebar('footer_5'); ?>
                </div>
            </div>
            <div class="site">
                <div id="gk-copyrights">
                    <p class="copyright"><?php _e('Desenvolvido por', 'slug'); ?><a href="http://hacklab.com.br/" class="hacklab"><span class="screen-reader-text">hacklab</a></a> with <a href="https://wordpress.org/">Wordpress</a></p>
                </div>
            </div>

        </footer><!-- end of #gk-footer -->
        <?php do_action('quark_after_footer'); ?>
    </div><!-- #gk-bg -->

    <?php do_action('quark_before_asidemenu'); ?>
    <i id="close-menu">&times;</i>
    <aside id="aside-menu">
        <div>

            <?php if (is_active_sidebar('menu_top')) : ?>
            <?php do_action('quark_before_menu_top'); ?>
            <div id="gk-menu-top">
                <div class="widget-area">
                    <?php dynamic_sidebar('menu_top'); ?>
                </div>
            </div>

            <?php do_action('quark_after_menu_top'); ?>
            <?php endif; ?>

            <?php get_search_form(); ?>
            <?php  if ( $post->post_type == "page"): ?>
              <h2 class="aside-title-boletim"><?php the_title(); ?></h2>
            <?php else: ?>
            	  <h2 class="aside-title-boletim"></h2>
            <?php endif; ?>
            <div class="language">
                <ul>
                  <?php pll_the_languages(array('dropdown' => 0, 'show_flags'=>1,'show_names'=>0));?>
                </ul>
            </div>

            <?php  if ( $post->post_type == "post"): ?>

              <h2 class="aside-title-boletim"><?php   ?></h2>
            <?php endif; ?>
            <h2 class="aside-title"><?php _e('Nesta edição', 'slug'); ?></h2>

            <?php
            the_post();
            if ( $post->post_type == "page") {
                $category = $post_original->post_name;
            }
            if ( $post->post_type == "post") {
                $category = get_post_meta($post->ID, 'boletim', true);
            }
            $args_global = array(
              'post_type' => 'post',
              'order' => 'DESC',
              'meta_key' => 'boletim',
              'meta_value' => $category,
              'posts_per_page' => -1
            );

            $loop_news = get_posts($args_global);

            wp_reset_query(); ?>


            <nav id="aside-navigation" class="main-navigation" role="navigation">
              <div class="menu-menu-boletim-container">
              <!-- <?php wp_nav_menu( array( 'theme_location' => 'boletimmenu', 'menu_class' => 'nav-aside-menu', 'fallback_cb' => false ) ); ?> -->
              <ul class="articles">
                <?php foreach ( $loop_news as $_post ){    ?>

                <li><a href="<?php echo get_permalink($_post->ID); ?>"><?php echo $_post->post_title; ?></a></li>
                <?php }; wp_reset_query();?>
              </ul>
              </div>

            </nav><!-- #aside-navigation -->

            <h2 class="aside-title"><?php _e('Boletins Anteriores', 'quark'); ?></h2>

            <?php
            $args_global = array(
              'post_type' => 'page',
              'order' => 'DESC',
              'meta_query' => array(
                                array(
                                  'key' => 'is_boletim',
                                  'value' => 'boletim',
                                  'compare' => 'IN',
                                )
                              ),
              'posts_per_page' => 10
            );
            $loop_boletim = new WP_Query( $args_global );
            wp_reset_query();?>


            <nav id="aside-navigation" class="main-navigation" role="navigation">
              <div class="menu-menu-boletim-container">
              <!-- <?php wp_nav_menu( array( 'theme_location' => 'boletimmenu', 'menu_class' => 'nav-aside-menu', 'fallback_cb' => false ) ); ?> -->
              <ul class="articles">
                <?php while ( $loop_boletim->have_posts()): $loop_boletim->the_post(); ?>
                <li>
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
                <?php endwhile; wp_reset_query();?>
              </ul>
              </div>

            </nav><!-- #aside-navigation -->

            <?php
                $archive_link = get_page_by_path('archive-boletins');
                $archive_link = ($archive_link) ? get_the_permalink($archive_link->ID) : false;
            ?>
            <?php if ( $archive_link ) : ?>
                <div class="entry-thumbnail-wrap">
                    <a href="<?php echo $archive_link; ?>" class="btn">Veja mais boletins</a>
                </div>
            <?php endif;?>

            <?php if (is_active_sidebar('menu_bottom')) : ?>
            <?php do_action('quark_before_menu_bottom'); ?>
            <div id="gk-menu-bottom">
                <div class="widget-area">
                    <?php dynamic_sidebar('menu_bottom'); ?>
                </div>
            </div>
            <?php do_action('quark_after_menu_bottom'); ?>
            <?php endif; ?>

        </div>
    </aside><!-- #aside-menu -->
    <?php do_action('quark_after_asidemenu'); ?>

    <?php if(get_theme_mod('quark_login_popup', 1) == 1) : ?>
    <div id="gk-login-popup">
         <a href="#" id="gk-login-popup-close">&times;</a>
         <?php get_template_part('login', 'popup'); ?>
    </div>
    <div id="gk-login-popup-overlay"></div>
    <?php endif; ?>

    <!-- Root element of PhotoSwipe. Must have class pswp. -->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div>

                    <div class="pswp__preloader"></div>

                    <button class="pswp__button pswp__button--fs" title="<?php _e('Toggle fullscreen','quark'); ?>"></button>
                    <button class="pswp__button pswp__button--zoom" title="<?php _e('Zoom in/out','quark'); ?>"></button>
                    <button class="pswp__button pswp__button--share" title="<?php _e('Share','quark'); ?>"></button>
                    <button class="pswp__button pswp__button--close" title="<?php _e('Close(Esc)','quark'); ?>"></button>
                </div>

                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div>

                <button class="pswp__button pswp__button--arrow--left" title="<?php _e('Previous (arrow left)','quark'); ?>"></button>
                <button class="pswp__button pswp__button--arrow--right" title="<?php _e('Next (arrow right)','quark'); ?>"></button>

                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>
