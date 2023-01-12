<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Sledheader
 * @subpackage Sledheader/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Sledheader
 * @subpackage Sledheader/public
 * @author     Sled
 */
class Sledheader_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $sledheader    The ID of this plugin.
	 */
	private $sledheader;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $sledheader       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $sledheader, $version ) {

		$this->sledheader = $sledheader;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sledheader_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sledheader_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->sledheader, plugin_dir_url( __FILE__ ) . 'css/sledheader-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sledheader_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sledheader_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->sledheader, plugin_dir_url( __FILE__ ) . 'js/sledheader-public.js', array( 'jquery' ), $this->version, false );

	}

}
