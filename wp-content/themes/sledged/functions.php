<?php
/**
 * Sledged functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage sled_theme
 * @since Sledged 1.0
 */



function wp_corenavi() {
	global $wp_query;
	$total = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
	$a['total'] = $total;
	$a['mid_size'] = 3; // сколько ссылок показывать слева и справа от текущей
	$a['end_size'] = 1; // сколько ссылок показывать в начале и в конце
	$a['prev_text'] = '&laquo;'; // текст ссылки "Предыдущая страница"
	$a['next_text'] = '&raquo;'; // текст ссылки "Следующая страница"

	if ( $total > 1 ) echo '<nav class="pagination">';
	echo paginate_links( $a );
	if ( $total > 1 ) echo '</nav>';
}

if ( ! function_exists( 'sledged_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Sledged 1.0
	 *
	 * @return void
	 */
	function sledged_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'post-thumbnails' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

	}

endif;

add_action( 'after_setup_theme', 'sledged_support' );

if ( ! function_exists( 'sledged_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @since Sledged 1.0
	 *
	 * @return void
	 */
	function sledged_styles() {

		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'sledged-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'sledged-style' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'sledged_styles' );

add_action( 'wp_enqueue_scripts', 'sled_jquery_scripts' );

function sled_jquery_scripts() {

	wp_enqueue_script( 'jquery' );

	wp_register_script( 'filter', get_stylesheet_directory_uri() . '/filter.js', array( 'jquery' ), time(), true );
	wp_enqueue_script( 'filter' );

}

wp_localize_script( 'truescript', 'true_obj', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

add_action( 'wp_ajax_myfilter', 'true_filter_function' );
add_action( 'wp_ajax_nopriv_myfilter', 'true_filter_function' );

function true_filter_function(){

	$args = array(
		'orderby' => 'date',
		'order'	=> $_POST[ 'date' ]
	);

	if( isset( $_POST[ 'categoryfilter' ] )) {
		$args[ 'tax_query' ] = array(
			array(
				'category' => '',
				'field' => 'id',
				'terms' => $_POST[ 'categoryfilter' ]
			)
		);
	}
	if( isset( $_POST[ 'featured_image' ] ) && 'on' == $_POST[ 'featured_image' ] ) {
		$args[ 'meta_query' ][] = array(
			'key' => '_thumbnail_id',
			'compare' => 'EXISTS'
		);
	}

	query_posts( $args );

	if ( have_posts() ) {
		while ( have_posts() ) : the_post();
			echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
		endwhile;
	} else {
		echo 'Ничего не найдено';
	}

	die();
}