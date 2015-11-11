<?php
/**
 * The template for displaying the footer from Boletim Page
 *
 */

?>
    	<?php do_action('quark_before_footer'); ?>
      <!-- Begin #pre-footer -->
      <footer id="pre-footer" role="contentinfo">
        <div class="site">
                <div class="gk-cols" data-cols="3">
                  <div class="social">
                    <div class="expediente">
                      <h4>Expediente</h4>
                      <h5>Edição</h5>

                      ABNER MATHEUS JOAOc<br/>
                      <br/>
                      <h5>Redação</h5>
                      ALEXANDRE AUGUSTO MILANI REIS<br/>
                      ARICIA CHRISTOFARO FERNANDES<br/>
                      <br/>

                      <h5>Correspondentes</h5>
                      ARTUR SILVA BOARETTO<br/>
                      BIANCA PORTELA COSTA<br/>
                      CAROLINA BERTI DE SOUZA CORREA<br/>
                    </div>
                  </div>
                    <div class="subscribe">

                        <h4>Contato</h4>
                      <p>Email: contato(a)trabalhoindigenista.org.br</p>

                      <h5>São Paulo - SP</h5>
                      Rua Euclides de Andrade, 91<br/>
                      Jardim Vera Cruz - São Paulo - SP CEP 05.030-030<br/>
                      SEDE Fone: +55 (11) 2935.7769<br/>
                      Celulares: +55 (11) 8745.0927, 8745.1137<br/><br/>

                      <h5>Brasília - DF</h5>
                      SCLN 210 Bloco C Sala 217<br/>
                      Brasília-DF Cep: 70.862-530<br/>
                      Fone: +55 (61) 3349-7769<br/>
                      Fax: +55 (61) 3347-5559<br/>
                      <br/>
                    </div>
                    <div class="subscribe">
                        <h4>Receba o boletim</h4>
                        Mantenha-se informado sobre a situação dos povos isolados.
                        <form>
                          <input type="text" placeholder="E-mail">
                          <button>
                            <span class="screen-reader-text">Enviar</span>
                          </button>
                        </form><p>
                        <h4>Redes Sociais</h4>
                        <ul>
                            <li class="facebook">
                            <a href="https://www.facebook.com/trabalhoindigenista"><span class="screen-reader-text">Facebook</span></a>
                            </li>
                            <li class="twitter">
                            <a href="https://twitter.com/cti_indigenismo"><span class="screen-reader-text">Twitter</span></a>
                            </li>
                            <li class="youtube">
                            <a href="https://www.youtube.com/user/TrabalhoIndigenista"><span class="screen-reader-text">Youtube</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
        </div>
      </footer>
      <!-- End of #pre-footer -->
    	<footer id="gk-footer" role="contentinfo">
    		<div class="site">
                <div class="gk-cols" data-cols="3">

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
                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo-fundo-amazonia-alpha.png" alt="Fundo Amazônia">
                    </div>


                </div>
            </div>
            <div class="site">
        		<div id="gk-copyrights">
                    <p class="copyright">Developed by <a href="http://hacklab.com.br/" class="hacklab"><span class="screen-reader-text">hacklab</a></a> with <a href="https://wordpress.org/">Wordpress</a></p>
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
