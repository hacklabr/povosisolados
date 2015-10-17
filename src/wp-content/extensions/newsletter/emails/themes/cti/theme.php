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

if (isset($theme_options['theme_posts'])) {
    $filters = array();
    
    if (empty($theme_options['theme_max_posts'])) $filters['showposts'] = 10;
    else $filters['showposts'] = (int)$theme_options['theme_max_posts'];
    
    if (!empty($theme_options['theme_categories'])) {
        $filters['category__in'] = $theme_options['theme_categories'];
    }    
    if (!empty($theme_options['theme_post_types'])) {
        $filters['post_type'] = $theme_options['theme_post_types'];
    }    
    
    $posts = get_posts($filters);
}

?><!DOCTYPE html>
<html>
    <head>
        <!-- Not all email client take care of styles inserted here -->
        <style type="text/css" media="all">
            a {
                text-decoration: none;
                color: #9F2032;
            }
        </style>
    </head>
    <body style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 14px; color: #fff; margin: 0 auto; padding: 0;">

    <table bgcolor="#CCAE6D" cellspacing="0" cellpadding="0" width="600" style="margin: 0 auto;">
      <!-- top header -->
      <tr bgcolor="#9F2032">
        <td align="left" bgcolor="#9F2032" colspan="2" style="color: #fff; font-size: 20px; font-weight: bold; padding: 15px 10px;">Boletim trimestral</td>
        <td align="right" bgcolor="#9F2032" style="color: #fff; font-size: 20px; font-weight: bold; text-transform: uppercase; padding: 15px 10px;">Boletim 71</td>
      </tr>
      <tr>

        <!-- newsletter banner -->
        <td background="<?php echo $theme_url ?>/images/banner.jpg" colspan="3" height="400">
          
          <table style="margin-left: 15px;">
            <tr>
              <!-- newsletter title and subtitle -->
              <td align="left" bgcolor="#230e0f">
                <div style="color: #fff; font-size: 20px; font-weight: bold; padding: 10px 10px 0px 10px; text-transform: uppercase;">Guarani terras indígenas</div>
                <div style="color: #fff; font-size: 14px; font-weight: normal; padding: 0px 10px 10px 10px; ">Lançamento: Atlas Das Terras Guaranis No Sul e Sudeste do Brasil 2015</div>
              </td>
            </tr>
            <tr>
              <!-- blank space -->
              <td height="10"></td>
            </tr>
            <tr>
              <!-- read more button -->
              <td height="45"><a href="#" style="background-color:#9F2032; color: #fff; font-size: 20px; font-weight: bold; padding: 10px 20px; text-transform: uppercase;">Leia mais</a></td>
            </tr>
          </table>

        </td>
      </tr>
      <tr>
        <!-- posts section -->
        <?php if (!empty($posts)) { ?>
        <td bgcolor="#CCAE6D" colspan="3">
            <table>
                <tr>
                <?php foreach ($posts as $post) { setup_postdata($post); ?>
                    <td width="270" valign="top" style="padding: 18px 0px 0px 18px;">
                    <a target="_blank" href="#" href="<?php echo get_permalink($post); ?>">
                        <img height="150" width="270" src="<?php echo newsletter_get_post_image($post->ID); ?>"></a>
                        <div style="background-color: #230e0f; color: #fff; font-size: 14px; font-weight: bold; margin-top: -3px; padding: 10px 15px;">
                          <a target="_blank" href="<?php echo get_permalink(); ?>" style="color: #fff;">
                              <?php the_title(); ?>
                          </a>
                        </div> 
                    </td>
                <?php } ?>
                </tr>
            <</table>            
        </td>
        <?php } ?>
      </tr>
      <tr>
        <!-- blank space -->
        <td bgcolor="#CCAE6D" colspan="3" height="18"></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#9F2032" colspan="3" style="padding: 10px;" valign="top">
          <a href="#" style="color: #fff;"><img src="<?php echo $theme_url ?>/images/facebook.png" height="25"></a>
          <a href="#" style="color: #fff; margin: 0 10px 0 5px"><img src="<?php echo $theme_url ?>/images/twitter.png"></a>
          <a href="#" style="color: #fff;"><img src="<?php echo $theme_url ?>/images/youtube.png"></a>
        </td>
      </tr>
      <tr bgcolor="#CCAE6D">
        <td align="center" bgcolor="#CCAE6D" style="padding: 15px 5px;">
            <img src="<?php echo $theme_url ?>/images/logo-cti.png" alt="Centro de Trabalho Indigenista">
        </td>
        <td align="center" bgcolor="#CCAE6D" style="color: #9F2032; font-size: 12px; padding: 15px 5px;">
            <b>Centro de Trabalho Indigenista</b><br>
            Fone BSB: +55 (61) 3349-7769<br>
            Fone SP: +55  (11) 2935-7768</td>
        <td align="center" bgcolor="#CCAE6D">
            <a target="_blank" href="{profile_url}" style="color: #9F2032; font-size: 12px; padding: 15px 5px;">
            <b>Não deseja mais receber?</b><br>
            Clique aqui para<br>se descadastrar</a>
        </td>
      </tr>
    </table>


    <p style="text-align: center; font-size: small;"><a target="_blank" href="{email_url}">View this email online</a></p>

  </body>
</html>