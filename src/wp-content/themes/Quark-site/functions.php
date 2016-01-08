<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

function theme_name_scripts() {
	wp_enqueue_style( 'style-name', get_template_directory_uri() . '/owl/owl-carousel/owl.carousel.css' );
  wp_enqueue_style( 'style-name2', get_template_directory_uri() . '/owl/owl-carousel/owl.theme.css');
  wp_enqueue_style( 'style-name3', get_template_directory_uri() . '/owl/owl-carousel/owl.transitions.css');
	wp_enqueue_script( 'script-name', get_template_directory_uri() . '/owl/owl-carousel/owl.carousel.min.js', array(), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );

?>
