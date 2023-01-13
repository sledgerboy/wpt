<?php

require_once('class.sledheader.php');

/**
 * sledheader plugin
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
 * Requires PHP: 7.4
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}



/**
 * Currently plugin version.
 */
define( 'SLEDHEADER_VERSION', '1.0.0' );


enqueue_styles();

add_filter( 'admin_init', 'wp_update_php_annotation_custom' );



add_filter('the_title', 'set_the_header');
