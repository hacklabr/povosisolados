<?php
/**
 *
 * The template for displaying search form
 *
 **/
?>

<form role="search" method="get" id="searchform" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <div><label class="screen-reader-text" for="s"><?php _e('Search for:','quark'); ?></label>
        <input type="text" value="" name="s" id="s" class="search-field" placeholder="<?php _e('Search...','quark'); ?>"/>
        <input type="submit" class="btn" value="<?php _e('Search','quark'); ?>" />
    </div>
</form>