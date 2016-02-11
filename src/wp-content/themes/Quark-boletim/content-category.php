<?php
/**
 * The default template for displaying content
 * Used for both single and index/archive/search.
 *
 */

?>

<article class="news-box">
	<?php
    $thumb_id = get_post_thumbnail_id();
    $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
    ?>
    <div class="news-thumb" style="background-image:url('<?php echo $thumb_url[0]; ?>');" ></div>
    <h3 class="news-title"><a href="<?php the_permalink(); ?>">
    <?php the_title(); ?></a></h3>
    <div class="news-excerpt"><?php the_excerpt(); ?></div>
    <a class="btn" href="<?php the_permalink(); ?>">Leia mais</a>
</article><!-- #post -->
