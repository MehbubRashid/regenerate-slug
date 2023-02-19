<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/MehbubRashid
 * @since             1.0.0
 * @package           Regenerate_Slug
 *
 * @wordpress-plugin
 * Plugin Name:       Regenerate Slug
 * Plugin URI:        https://github.com/MehbubRashid
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Mehbub Rashid
 * Author URI:        https://github.com/MehbubRashid
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       regenerate-slug
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
define( 'RGSG_VERSION', '1.0.0' );

/**
 * Define plugin path and plugin url.
 */
define( 'RGSG_PATH', plugin_dir_path( __FILE__ ) );
define( 'RGSG_URL', plugin_dir_url( __FILE__ ) );
define( 'RGSG_ASSETS_URL', plugin_dir_url( __FILE__ ) . 'assets/' );
define( 'RGSG_ASSETS_VERSION', time() );

/**
 * The code that runs during plugin activation.
 */
function rgsg_activate() {
	
}

/**
 * The code that runs during plugin deactivation.
 */
function rgsg_deactivate() {
	
}

register_activation_hook( __FILE__, 'rgsg_activate' );
register_deactivation_hook( __FILE__, 'rgsg_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function rgsg_run() {

	$plugin = new Rgsg_Plugin();

}
rgsg_run();
