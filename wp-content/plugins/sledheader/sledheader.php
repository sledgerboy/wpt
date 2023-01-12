<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @since             1.0.0
 * @package           Sledheader
 *
 * @wordpress-plugin
 * Plugin Name:       sledheader
 * Plugin URI:        https://localhost/plugins/sled
 * Description:       The simple plugin for WP posts. It helps to make a headers more informative.
 * Version:           1.0.0
 * Author:            Sled
 * Author URI:        https://localhost/sled
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sledheader
 * Domain Path:       /languages
 * Requires at least: 2.5
 * Requires PHP: 8.2
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Update it as you release new versions.
 */
define( 'SLEDHEADER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sledheader-activator.php
 */
function activate_sledheader() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sledheader-activator.php';
	Sledheader_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sledheader-deactivator.php
 */
function deactivate_sledheader() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sledheader-deactivator.php';
	Sledheader_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sledheader' );
register_deactivation_hook( __FILE__, 'deactivate_sledheader' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sledheader.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sledheader() {

	$plugin = new Sledheader();
	$plugin->run();

}
run_sledheader();
