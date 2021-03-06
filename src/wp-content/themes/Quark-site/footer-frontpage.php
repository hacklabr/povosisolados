<?php
/**
 * The template for displaying the footer from Boletim Page
 *
 */
 global $post_original;

?>

      <?php do_action('quark_before_footer'); ?>
        <footer id="gk-footer" role="contentinfo">
            <div class="site">
                <div class="gk-cols" data-cols="3">
                    <?php dynamic_sidebar('footer_1'); ?>
                    <?php dynamic_sidebar('footer_2'); ?>
                    <?php dynamic_sidebar('footer_3'); ?>
                </div>
            </div>
            <div class="site">
                <div id="gk-copyrights">
                    <p class="copyright"><?php _e('Desenvolvido por', 'quark'); ?><a href="http://hacklab.com.br/" class="hacklab"><span class="screen-reader-text">hacklab</a></a><?php _e('com','quark'); ?> <a href="https://wordpress.org/">Wordpress</a></p>
                </div>
            </div>

        </footer><!-- end of #gk-footer -->
        <?php do_action('quark_after_footer'); ?>
    </div><!-- #gk-bg -->

    <?php do_action('quark_before_asidemenu'); ?>
    <i id="close-menu">&times;</i>
    
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
