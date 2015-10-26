<?php
/**
 * The template for displaying the footer
 *
 */

?>
				<?php if (is_active_sidebar('bottom1')) : ?>
				<?php do_action('quark_before_bottom1'); ?>
				<div id="gk-bottom1" role="complementary" class="site">
					<div class="widget-area gk-3-cols" data-cols="<?php echo GK_Utils::count_sidebar_widgets('bottom1', 3); ?>">
						<?php dynamic_sidebar('bottom1'); ?>
					</div>
				</div>
				<?php do_action('quark_after_bottom1'); ?>
				<?php endif; ?>

				<?php if (is_active_sidebar('bottom2')) : ?>
				<?php do_action('quark_before_bottom2'); ?>
				<div id="gk-bottom2" role="complementary" class="site">
					<div class="widget-area gk-3-cols" data-cols="<?php echo GK_Utils::count_sidebar_widgets('bottom2', 3); ?>">
						<?php dynamic_sidebar('bottom2'); ?>
					</div>
				</div>
				<?php do_action('quark_after_bottom2'); ?>
				<?php endif; ?>

				<?php if (is_active_sidebar('bottom3')) : ?>
				<?php do_action('quark_before_bottom3'); ?>
				<div id="gk-bottom3" role="complementary" class="site">
					<div class="widget-area gk-3-cols" data-cols="<?php echo GK_Utils::count_sidebar_widgets('bottom3', 3); ?>">
						<?php dynamic_sidebar('bottom3'); ?>
					</div>
				</div>
				<?php do_action('quark_after_bottom3'); ?>
				<?php endif; ?>

				<?php if (is_active_sidebar('bottom4')) : ?>
				<?php do_action('quark_before_bottom4'); ?>
				<div id="gk-bottom4" role="complementary">
					<div class="widget-area gk-3-cols" data-cols="<?php echo GK_Utils::count_sidebar_widgets('bottom4', 3); ?>">
						<?php dynamic_sidebar('bottom4'); ?>
					</div>
				</div>
				<?php do_action('quark_after_bottom4'); ?>
				<?php endif; ?>

				<?php if (is_active_sidebar('bottom5')) : ?>
				<?php do_action('quark_before_bottom5'); ?>
				<div id="gk-bottom5" role="complementary">
					<div class="widget-area gk-3-cols" data-cols="<?php echo GK_Utils::count_sidebar_widgets('bottom5', 3); ?>">
						<?php dynamic_sidebar('bottom5'); ?>
					</div>
				</div>
				<?php do_action('quark_after_bottom5'); ?>
				<?php endif; ?>
			</div><!-- #main -->
		</div><!-- #page -->

    	<?php do_action('quark_before_footer'); ?>
    	<footer id="gk-footer" role="contentinfo">
    		<div class="site">
	    		<div id="gk-footer-nav">
	             	<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'footer-menu', 'fallback_cb' => false ) ); ?>
	          	</div>

	    		<div id="gk-copyrights">
	                <p class="copyright"><?php echo get_theme_mod('quark_copyright_text', 'WordPress Theme by <a href="https://www.gavick.com">GavickPro.com</a>'); ?></p>
	            </div>
            </div>
    	</footer><!-- end of #gk-footer -->
    	<?php do_action('quark_after_footer'); ?>
    </div><!-- #gk-bg -->

	<?php if(get_theme_mod('quark_menu_classic', 0) == 0) : ?>
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

            <nav id="aside-navigation" class="main-navigation" role="navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'mainmenu', 'menu_class' => 'nav-aside-menu', 'fallback_cb' => false ) ); ?>
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
    <?php endif; ?>

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
