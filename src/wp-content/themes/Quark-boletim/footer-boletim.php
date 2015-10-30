<?php
/**
 * The template for displaying the footer from Boletim Page
 *
 */

?>
    	<?php do_action('quark_before_footer'); ?>
    	<footer id="gk-footer" role="contentinfo">
    		<div class="site">
                <div class="gk-cols" data-cols="5">
                    <div class="logo cti">
                        <h4>Realização</h4>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo-cti.png" alt="Centro de Trabalho Indigenista">
                    </div>
                    <div class="logo funai">
                        <h4>Parceria</h4>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo-funai.png" alt="FUNAI">
                    </div>
                    <div class="logo amazonia">
                        <h4>Apoio</h4>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo-fundo-amazonia.png" alt="Fundo Amazônia">
                    </div>
                    <div class="subscribe">
                        <h4>Receba o boletim</h4>
                        <form>
                            <input type="text" placeholder="E-mail">
                            <button>
                                <span class="screen-reader-text">Enviar</span>
                            </button>
                        </form>
                    </div>
                    <div class="social">
                        <h4>Siga o CTI</h4>
                        <ul>
                            <li class="facebook">
                            <a href="https://www.facebook.com/trabalhoindigenista"><span class="screen-reader-text">Facebook</span></a>
                            </li>
                            <li class="twitter">
                            <a href="https://twitter.com/cti_indigenismo"><span class="screen-reader-text">Twitter</span></a>
                            </li>
                            <li class="youtube">
                            <a href=""><span class="screen-reader-text">Youtube</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="site">
        		<div id="gk-copyrights">
                    <p class="copyright"><?php echo get_theme_mod('quark_copyright_text', 'Developed  by <a href="http://hacklab.com.br/" class="hacklab"><span class="screen-reader-text">hacklab</a></a> with <a href="https://wordpress.org/">Wordpress</a>'); ?></p>
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
            <h2 class="aside-title-boletim"><?php the_title(); ?></h2>
            <h2 class="aside-title">Nesta edição</h2>

            <?php
            the_post();
            $category = $post->post_name;
            $args_global = array(
              'post_type' => 'post',
              'order' => 'DESC',
              'category_name' => $category,
              'posts_per_page' => -1
            );
            $loop_news = new WP_Query( $args_global ); ?>

            <nav id="aside-navigation" class="main-navigation" role="navigation">
              <div class="menu-menu-boletim-container">
              <!-- <?php wp_nav_menu( array( 'theme_location' => 'boletimmenu', 'menu_class' => 'nav-aside-menu', 'fallback_cb' => false ) ); ?> -->
              <ul>
                <?php while ( $loop_news->have_posts()): $loop_news->the_post(); ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                <?php endwhile; wp_reset_query();?>
              </ul>
              </div>

            </nav><!-- #aside-navigation -->

            <h2 class="aside-title">Boletins Anteriores</h2>

            <?php
            $args_global = array(
              'post_type' => 'page',
              'order' => 'DESC',
              'category_name' => 'boletim',
              'posts_per_page' => -1
            );
            $loop_boletim = new WP_Query( $args_global ); ?>

            <nav id="aside-navigation" class="main-navigation" role="navigation">
              <div class="menu-menu-boletim-container">
              <!-- <?php wp_nav_menu( array( 'theme_location' => 'boletimmenu', 'menu_class' => 'nav-aside-menu', 'fallback_cb' => false ) ); ?> -->
              <ul>
                <?php while ( $loop_boletim->have_posts()): $loop_boletim->the_post(); ?>
                <li>
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
                <?php endwhile; wp_reset_query();?>
              </ul>
              </div>

            </nav><!-- #aside-navigation -->


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
