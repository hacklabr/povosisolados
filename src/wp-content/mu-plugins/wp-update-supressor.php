<?php
/*
 * Impede que WordPress verifique por atualizaçoẽs
 */

if ( !defined('WP_AUTO_UPDATE_CORE') ) {
    define('WP_AUTO_UPDATE_CORE', false);
}

if ( !defined('AUTOMATIC_UPDATER_DISABLED') ) {
    define('AUTOMATIC_UPDATER_DISABLED', true);
}

add_filter( 'automatic_updater_disabled', '__return_true');

remove_action( 'admin_init', '_maybe_update_core' );
remove_action( 'wp_version_check', 'wp_version_check' );
remove_action( 'upgrader_process_complete', 'wp_version_check', 10, 0 );

remove_action( 'load-plugins.php', 'wp_update_plugins' );
remove_action( 'load-update.php', 'wp_update_plugins' );
remove_action( 'load-update-core.php', 'wp_update_plugins' );
remove_action( 'admin_init', '_maybe_update_plugins' );
remove_action( 'wp_update_plugins', 'wp_update_plugins' );
remove_action( 'upgrader_process_complete', 'wp_update_plugins', 10, 0 );

remove_action( 'load-themes.php', 'wp_update_themes' );
remove_action( 'load-update.php', 'wp_update_themes' );
remove_action( 'load-update-core.php', 'wp_update_themes' );
remove_action( 'admin_init', '_maybe_update_themes' );
remove_action( 'wp_update_themes', 'wp_update_themes' );
remove_action( 'upgrader_process_complete', 'wp_update_themes', 10, 0 );

remove_action( 'update_option_WPLANG', 'wp_clean_update_cache' , 10, 0 );
remove_action( 'wp_maybe_auto_update', 'wp_maybe_auto_update' );
