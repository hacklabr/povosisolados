<?php

require __DIR__ . '/inc/admin-page-destaques-home.php';


add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {
    $existing_mimes['zip'] = 'application/zip';
    $existing_mimes['gz'] = 'application/x-gzip';
    $existing_mimes['rar'] = 'application/x-rar-compressed';

    return $existing_mimes;
}

function theme_name_scripts() {
	wp_enqueue_style( 'style-name', get_template_directory_uri() . '/owl/owl-carousel/owl.carousel.css' );
    wp_enqueue_style( 'style-name2', get_template_directory_uri() . '/owl/owl-carousel/owl.theme.css');
    wp_enqueue_style( 'style-name3', get_template_directory_uri() . '/owl/owl-carousel/owl.transitions.css');
	wp_enqueue_script( 'script-name', get_template_directory_uri() . '/owl/owl-carousel/owl.carousel.min.js', array(), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );

if ( ! function_exists('programas_post_type') ) {

// Register Custom Post Type
function programas_post_type() {

	$labels = array(
		'name'                  => _x( 'Programas', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Programa', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Programa', 'text_domain' ),
		'name_admin_bar'        => __( 'Programa', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Programa', 'text_domain' ),
		'description'           => __( 'Programas do CTI', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'programa', $args );

}
add_action( 'init', 'programas_post_type', 0 );

add_image_size( 'thumb-destaque-noticias', '999', '250', array( "center", "center") ); 
add_image_size( 'thumb-noticias', '480', '250', array( "center", "center") ); 
add_image_size( 'header-frontpage', '1920', '960', array( "center", "center") ); 

}

