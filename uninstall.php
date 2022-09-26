<?php
/**
 * Fired when the plugin is uninstalled.
 * @package LibraryBookSearch
*/
// If uninstall not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

// Access the database via SQL
global $wpdb;
$wpdb->query( "DELETE FROM {$wpdb->posts} WHERE post_type = 'book'" );
$wpdb->query( "DELETE FROM {$wpdb->postmeta} WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
$wpdb->query( "DELETE FROM {$wpdb->term_relationships} WHERE object_id NOT IN (SELECT id FROM wp_posts)" );