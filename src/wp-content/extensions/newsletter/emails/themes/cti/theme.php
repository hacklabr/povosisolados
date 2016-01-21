<?php
/*
 * Name: CTI Newsletter
 * Type: standard
 * Some variables are already defined:
 *
 * - $theme_options An array with all theme options
 * - $theme_url Is the absolute URL to the theme folder used to reference images
 * - $theme_subject Will be the email subject if set by this theme
 *
 */
global $newsletter, $post;

$filters = array();

if (empty($theme_options['theme_max_posts'])) {
    $filters['showposts'] = 12;
} else {
    $filters['showposts'] = (int)$theme_options['theme_max_posts'];
}

if (!empty($theme_options['theme_categories'])) {
    $filters['category__in'] = $theme_options['theme_categories'];
}

if (!empty($theme_options['theme_post_types'])) {
    $filters['post_type'] = $theme_options['theme_post_types'];
}

/*
 * Links for Social Links (icons) footer
 */

$link_facebook = (!empty($theme_options['theme_facebook'])) ? $theme_options['theme_facebook'] : '#';
$link_twitter  = (!empty($theme_options['theme_twitter']) )? $theme_options['theme_twitter'] : '#';
$link_youtube  = (!empty($theme_options['theme_youtube']) )? $theme_options['theme_youtube'] : '#';

$posts = get_posts($filters);
$boletim_name = get_post_meta($posts[0]->ID, "boletim");
$boletim_obj = get_posts( array('name' => $boletim_name,
                                'post_type' => 'page',
                                'meta_key' => 'is_boletim',
                                'meta_value' => 'boletim',
                              ));
$boletim_obj = $boletim_obj[0];
$category_obj = get_category_by_slug($boletim_name);
$category_id = $category_obj->term_id;

if (!empty($posts)) {
  $args_editorial = array(
    'post_type' => 'post',
    'order' => 'ASC',
    'lang' => 'pt',
    'category' => $category_id ,
    'meta_key' => 'is_editorial',
    'meta_value' => 'editorial',
    'posts_per_page' => 1
  );
  $loop_editorial = get_posts($args_editorial);
  foreach ( $loop_editorial as $_post ){
    $editorial_post = $_post;
  }; wp_reset_query();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Not all email client take care of styles inserted here -->
        <style type="text/css" media="all">
            a {
                text-decoration: none;
                color: #4a191b;
            }
        </style>
    </head>
    <body style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 14px; color: #fff; margin: 0 auto; padding: 0;">

    <table bgcolor="#ECDDBF" cellspacing="0" cellpadding="0" width="810" style="margin: 0 auto;">
      <!-- top header -->
      <tr bgcolor="#4a191b">
        <td align="left" bgcolor="#4a191b" colspan="2" style="color: #fff; font-size: 20px; font-weight: bold; padding: 15px 10px;">Boletim Povos Isolados na Amazônia</td>
        <td align="right" bgcolor="#4a191b" style="color: #fff; font-size: 20px; font-weight: bold; text-transform: uppercase; padding: 15px 10px;">
          Edição ##
          <a href="<?php echo get_permalink(pll_get_post($boletim_obj->ID, 'es')); ?>"><img src="/wp-content/themes/Quark-boletim/images/es.png"></a>
          <a href="<?php echo get_permalink(pll_get_post($boletim_obj->ID, 'en')); ?>"><img src="/wp-content/themes/Quark-boletim/images/us.png"><a/>
        </td>
      </tr>
      <tr>
        <!-- newsletter banner -->
        <td colspan="3" height="400">
          <img src="<?php echo newsletter_get_post_image($editorial_post->ID, "newsletter-header"); ?>')" height="400" width="810">
        </td>
      </tr>
      <tr bgcolor="#4a191b">
        <td colspan="3" style="color: #fff; font-size: 15px; font-weight: bold; padding: 15px 10px;">
          <?php echo $editorial_post->post_title; ?>
        </td>
      </tr>
      <tr>
        <div style="color: #fff; font-size: 16px; font-weight: bold; padding: 10px 10px 10px 10px; text-transform: uppercase;"><?php echo $editorial_post->post_title; ?></div>
      </tr>
      <?php if (!empty($posts)) { ?>
      <tr>
        <!-- posts section -->
        <td bgcolor="#FFF4DE" colspan="3">
          <table>

            <tr>
            <?php foreach ($posts as $key=>$post) : ?>
            <?php setup_postdata($post); ?>
              <td width="360" valign="top" style="padding: 22px 0px 0px 15px;">
                <a target="_blank" href="#" href="<?php echo get_permalink($post); ?>">
                  <img height="250" width="380" src="<?php echo newsletter_get_post_image($post->ID, "newsletter-boletim"); ?>">
                </a>
                <div style="color: #000; font-size: 14px; font-weight: bold; margin-top: -3px; padding: 10px 0px;">
                  <a target="_blank" href="<?php echo get_permalink(); ?>" style="color: #000;">
                  <?php the_title(); ?>
                  </a>

                </div>
                <div style="color: #000; font-size: 12px; margin-top: -3px;">
                  <a target="_blank" href="<?php echo get_permalink(); ?>" style="color: #000;">
                  <?php the_excerpt(); ?>
                  </a>
                </div>
              </td>

            <?php
                /*
                 * Fecha TR dinâmicamente
                 */
                if ( $key % 2 AND ($key + 1) !== sizeof($posts) ):
                    echo '</tr>';
                    echo '<tr>';
                elseif( ($key + 1) === sizeof($posts) ):
                    echo '</tr>';
                endif;
            ?>
            <?php endforeach; ?>
          </table>

        </td>
      </tr>
      <?php } ?>
      <tr>
        <!-- blank space -->
        <td bgcolor="#FFF4DE" colspan="3" height="18"></td>
      </tr>
      <tr>
        <td align="center" colspan="3" style="padding-bottom: 15px;" valign="top" style="text-align: center;">
          <a href="/boletins/">Boletins Anteriores</a>
        </td>
      </tr>
      <tr>
        <td align="center" colspan="3" style="padding-bottom: 15px; color: #000;" valign="top" style="text-align: center;">
        </td>
      </tr>
      <tr>
        <td align="center" bgcolor="#4a191b" colspan="3" style="" valign="top">
          <a href="<?php echo $link_facebook;?>" style="color: #fff;"><img src="<?php echo $theme_url ?>/images/facebook.png" height="25"></a>
          <a href="<?php echo $link_twitter;?>" style="color: #fff; margin: 0 10px 0 5px"><img src="<?php echo $theme_url ?>/images/twitter.png"></a>
          <a href="<?php echo $link_youtube;?>" style="color: #fff;"><img src="<?php echo $theme_url ?>/images/youtube.png"></a>
        </td>
      </tr>
      <tr bgcolor="#FFF4DE">
        <td align="center" bgcolor="#FFF4DE" style="padding: 15px 5px;">
            <img src="<?php echo $theme_url ?>/images/logo-cti.png" alt="Centro de Trabalho Indigenista">
        </td>
        <td align="center" bgcolor="#FFF4DE" style="color: #4a191b; font-size: 12px; padding: 15px 5px;">
            <b>Centro de Trabalho Indigenista</b><br>
            Fone BSB: +55 (61) 3349-7769<br>
            Fone SP: +55  (11) 2935-7768</td>
        <td align="center" bgcolor="#FFF4DE">
            <a target="_blank" href="{profile_url}" style="color: #4a191b; font-size: 12px; padding: 15px 5px;">
            <b>Não deseja mais receber?</b><br>
            Clique aqui para<br>se descadastrar</a>
        </td>
      </tr>
    </table>


    <p style="text-align: center; font-size: small;"><a target="_blank" href="{email_url}">View this email online</a></p>

  </body>
</html>
