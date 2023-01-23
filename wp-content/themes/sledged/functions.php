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

function sled_jquery_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_register_script( 'filter', get_stylesheet_directory_uri() . '/filter.js', array( 'jquery' ), time(), true );
	wp_enqueue_script( 'filter' );
}

add_action('wp_ajax_myfilter', 'sled_filter_function');

function sled_filter_function(){
	$args = array(
		'orderby' => 'date',
		'order'	=> $_POST['date']
	);
 
	if( isset( $_POST['categoryfilter'] ) )
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $_POST['categoryfilter']
			)
		);
 
		// if post thumbnail is set
		if( isset( $_POST['featured_image'] ) && $_POST['featured_image'] == 'on' )
			$args['meta_query'][] = array(
				'key' => '_thumbnail_id',
				'compare' => 'EXISTS'
			);
	
		$query = new WP_Query( $args );
	
		if( $query->have_posts() ) :
			while( $query->have_posts() ): $query->the_post();
			$category_post = get_the_category( $post->ID );
			$catofpost = $category_post[0]->cat_name;
			$date = get_the_date( $format, $post->ID );

			echo '<div class="content_post">';
			echo '<h3>' . $query->post->post_title . '</h3>';
			echo '<p>posted on ' . $date . '</p>';
			echo '<p>Category: ' . $catofpost . '</p>';
			echo get_the_post_thumbnail();
			echo '<p>Excerpt: ' . get_the_excerpt() . '</p>';
			echo '<hr>';
			echo '</div>';

		endwhile;
		wp_reset_postdata();
	else :
		echo 'No posts found';
	endif;
	
	die();
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


add_action( 'wp_enqueue_style', 'sledged_styles' );
add_action( 'after_setup_theme', 'sledged_support' );
add_action( 'wp_enqueue_scripts', 'sled_jquery_scripts' );
