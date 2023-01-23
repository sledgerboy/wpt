<?php get_header();

global $post;
global $wp_query;
    $wp_query = new WP_Query(array(
	    'posts_per_page' => '2', // кол-во записей на страницу
		'post_type' => 'post', // тип записи.
		'paged' => get_query_var('paged') ?: 1 // страница пагинации
	));
$category_post = get_the_category( $post->ID );
$catofpost = $category_post[0]->cat_name;
?>

<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
	<?php
		if( $terms = get_terms( array( 'taxonomy' => 'category', 'orderby' => 'name' ) ) ) : 
			echo '<select class="select-css" name="categoryfilter"><option value="">Select category...</option>';
			foreach ( $terms as $term ) :
				echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
			endforeach;
			echo '</select>';
		endif;
	?>
	<input type="hidden" name="action" value="myfilter">
</form>

<main id="main" class="site-main">
    
	<div id="response" class="content">

		<?php while (have_posts() ) { the_post(); ?>

            <div class="content_post">
                <h3><?php the_title();?></h3>
                <p>posted on <?php the_time("F jS, Y") ?></p>
                <p>Category: <?php echo $catofpost?></p>
                <?php echo get_the_post_thumbnail(); ?>
                <p>Excerpt: <?php echo get_the_excerpt(); ?></p>
                <hr>
            </div>

        <?php };

        if (function_exists('wp_corenavi')) wp_corenavi();

        wp_reset_query(); ?>

    </div>
    
    <div id="infob"></div>

    <?php get_sidebar();?>

</main>

<?php get_footer();?>
