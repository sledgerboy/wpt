<?php
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

if ( ! function_exists( 'add_filter' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'SLEDHEADER_VERSION', '1.0.0' );



class SledHeader {

	public function __construct() {
		add_action('init', [$this,'custom_post_type']);
		add_filter( 'admin_init',  [$this, 'wp_update_php_annotation_custom']);
		add_filter('the_title',  [$this, 'set_the_sled_header']);

	}
 
	public static function sledActivation() {
		flush_rewrite_rules();
		$requires_php = isset( $plugin_data['RequiresPHP'] ) ? $plugin_data['RequiresPHP'] : 7.4;
		$compatible_php = is_php_version_compatible($requires_php);
		$php_display_version = trim(stristr(phpversion(), '-', true));

		$version = date("Ymd") . rand(0,99);
		wp_enqueue_style( 'sledheader.css', plugin_dir_url( __FILE__ ) . 'assets/css/sledheader.css', array(), $version, 'all' );

		if ($compatible_php != 'false') {
			global $pagenow;
			if ( $pagenow == 'plugins.php' ) {
				echo '
					<div style="margin-left:11.5rem;" class="update-message notice ml-5 inline notice-error notice-alt"><p>
					Sledheader plugin error: Your version of PHP is ' . $php_display_version . '. This plugin require at least PHP '. $requires_php . '
					</p>  </div>';
			}
		}
	}

	public static function sledDeactivation() {
		flush_rewrite_rules();
	}

	public static function sledUninstall() {
		flush_rewrite_rules();
	}


	public function custom_post_type() {
		register_post_type('cust', array(
			'public' => true,
			'label' => esc_html__('cust','sledheader'),
			'supports' => array('title','editor','thumbnail')
		));
	}

	public function wp_update_php_annotation_custom(){
		$requires_php = isset( $plugin_data['RequiresPHP'] ) ? $plugin_data['RequiresPHP'] : 7.4;
		$compatible_php = is_php_version_compatible($requires_php);
		$php_display_version = trim(stristr(phpversion(), '-', true));

		if ($compatible_php != 'false') {
			global $pagenow;
			if ( $pagenow == 'plugins.php' ) {
				echo '
					<div style="margin-left:11.5rem;" class="update-message notice ml-5 inline notice-error notice-alt"><p>
					Sledheader plugin error: Your version of PHP is ' . $php_display_version . '. This plugin require at least PHP '. $requires_php . '
					</p>
					</div>';
			}
		}
	}

	public function enqueue_sled_styles() {
		$version = date("Ymd") . rand(0,99);
		wp_enqueue_style( 'sledHeaderStyle', plugins_url('/assets/css/sledheader.css', __FILE__));
	}

	public function set_the_sled_header($the_title) {
		$html = '';
		if (is_front_page()) {
			$html = '<span class="sledheader_datter">' . get_the_date() . '</span>';
		}
		return str_replace($the_title, $the_title . $html, $the_title);
	}

}



if(class_exists('SledHeader')) {

	$sledHeader = new SledHeader('test');
	
	register_activation_hook( __FILE__, array( $sledHeader, 'sledActivation' ) );
	register_deactivation_hook( __FILE__, array( $sledHeader, 'sledDeactivation' ) );
	register_uninstall_hook( __FILE__, array( $sledHeader, 'sledUninstall' ) );
	$sledHeader->enqueue_sled_styles();
}
