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
    $filters['showposts'] = 6;
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

if (!empty($posts)) {
  $args_editorial = array(
    'post_type' => 'post',
    'order' => 'ASC',
    'category_name' => $boletim_name ,
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
                color: #9F2032;
            }
        </style>
    </head>
    <body style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 14px; color: #fff; margin: 0 auto; padding: 0;">

    <table bgcolor="#CCAE6D" cellspacing="0" cellpadding="0" width="800" style="margin: 0 auto;">
      <!-- top header -->
      <tr bgcolor="#9F2032">
        <td align="left" bgcolor="#9F2032" colspan="2" style="color: #fff; font-size: 20px; font-weight: bold; padding: 15px 10px;">Boletim Povos Isolados na Amazônia</td>
        <td align="right" bgcolor="#9F2032" style="color: #fff; font-size: 20px; font-weight: bold; text-transform: uppercase; padding: 15px 10px;">Edição ##</td>
      </tr>
      <tr>

        <!-- newsletter banner -->
        <td background="<?php echo wp_get_attachment_url( get_post_thumbnail_id($editorial_post->ID)); ?>" colspan="3" height="400">

          <table style="margin-left: 15px;">
            <tr>
              <!-- newsletter title and subtitle -->
              <td align="left" bgcolor="#230e0f">
                <div style="color: #fff; font-size: 20px; font-weight: bold; padding: 10px 10px 0px 10px; text-transform: uppercase;"><?php echo $editorial_post->post_title; ?></div>
                <div style="color: #fff; font-size: 14px; font-weight: normal; padding: 0px 10px 10px 10px; "><?php echo $editorial_post->post_excerpt; ?></div>
              </td>
            </tr>
            <tr>
              <!-- blank space -->
              <td height="10"></td>
            </tr>
            <tr>
              <!-- read more button -->
              <td height="45"><a href="<?php echo get_permalink($editorial_post->ID); ?>" style="background-color:#9F2032; color: #fff; font-size: 20px; font-weight: bold; padding: 10px 20px; text-transform: uppercase;">Leia mais</a></td>
            </tr>
          </table>

        </td>
      </tr>
      <?php if (!empty($posts)) { ?>
      <tr>
        <!-- posts section -->
        <td bgcolor="#CCAE6D" colspan="3">
          <table>

            <tr>
            <?php foreach ($posts as $key=>$post) : ?>
            <?php setup_postdata($post); ?>
              <td width="360" valign="top" style="padding: 24px 0px 0px 24px;">
                <a target="_blank" href="#" href="<?php echo get_permalink($post); ?>">
                  <img height="200" width="360" src="<?php echo newsletter_get_post_image($post->ID); ?>">
                </a>
                <div style="background-color: #230e0f; color: #fff; font-size: 14px; font-weight: bold; margin-top: -3px; padding: 10px 15px;">
                  <a target="_blank" href="<?php echo get_permalink(); ?>" style="color: #fff;">
                  <?php the_title(); ?>
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
        <td bgcolor="#CCAE6D" colspan="3" height="18"></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#9F2032" colspan="3" style="padding: 10px;" valign="top">
          <a href="<?php echo $link_facebook;?>" style="color: #fff;"><img src="<?php echo $theme_url ?>/images/facebook.png" height="25"></a>
          <a href="<?php echo $link_twitter;?>" style="color: #fff; margin: 0 10px 0 5px"><img src="<?php echo $theme_url ?>/images/twitter.png"></a>
          <a href="<?php echo $link_youtube;?>" style="color: #fff;"><img src="<?php echo $theme_url ?>/images/youtube.png"></a>
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
