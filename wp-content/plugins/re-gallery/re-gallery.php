<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://localhost
 * @since             1.0.0
 * @package           Re_Gallery
 *
 * @wordpress-plugin
 * Plugin Name:       Real estate gallery
 * Plugin URI:        https://localhost
 * Description:       Adding a gallery for the Real Estate post type
 * Version:           1.0.0
 * Author:            Alex
 * Author URI:        https://localhost/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       re-gallery
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'RE_GALLERY_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-re-gallery-activator.php
 */
function activate_re_gallery() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-re-gallery-activator.php';
	Re_Gallery_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-re-gallery-deactivator.php
 */
function deactivate_re_gallery() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-re-gallery-deactivator.php';
	Re_Gallery_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_re_gallery' );
register_deactivation_hook( __FILE__, 'deactivate_re_gallery' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-re-gallery.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_re_gallery() {

	$plugin = new Re_Gallery();
	$plugin->run();

}
run_re_gallery();
