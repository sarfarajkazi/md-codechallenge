<?php
/**
 * @package LibraryBookSearch
*/
/*
Plugin Name: Library Book Search
Plugin URI: #
Description: Library book search which will be based on book name, author, publisher, price ( use range ), and book rating.
Version: 1.0.0
Author: Sarfaraz Kazi
Author URI: #
Text Domain: library-book-search
*/


// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * Define Constants
 */

define( 'LBS_PLUGIN_NAME_DIR', plugin_dir_path( __FILE__ ) );

define( 'LBS_PLUGIN_NAME_URL', plugin_dir_url( __FILE__ ) );

define( 'LBS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );


/**
 * The code that runs during plugin activation
 */
function activate_lbs_plugin() {
    INC_DIR\core\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_lbs_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_lbs_plugin() {
    INC_DIR\core\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_lbs_plugin' );

/**
 * Initialize all the core classes of the plugin
 *
 */
if ( class_exists( 'INC_DIR\\Init' ) ) {
    INC_DIR\Init::register_services();
}
