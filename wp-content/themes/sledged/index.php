<?php get_header();

global $post;
global $wp_query;
    $wp_query = new WP_Query(array(
	    'posts_per_page' => '3', // кол-во записей на страницу
		'post_type' => 'post', // тип записи.
		'paged' => get_query_var('paged') ?: 1 // страница пагинации
	));
$category_post = get_the_category( $post->ID );
$catofpost = $category_post[0]->cat_name;

echo '<form action="" method="POST" id="filter">';
echo '<button>Apply</button><input type="hidden" name="action" value="myfilter">';
if ($terms = get_terms(array('category' => '', 'orderby' => 'name'))) {
	echo '<select name="categoryfilter"><option>Choose cat ...</option>';
	foreach ( $terms as $term ) {
		echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';
	}
	echo '</select>';
};
echo '</form>';

?>



<main id="main" class="site-main">

	<div id="response" class="content">

		<?php while (have_posts() ) { the_post(); ?>

            <div class="content_post">
                <h3><?php the_title();?></h3>
                <p>posted on <?php the_time("F jS, Y") ?></p>
                <p><?php echo $catofpost?></p>
                <?php echo get_the_post_thumbnail(); ?>
                <p><?php echo get_the_excerpt(); ?></p>
                <hr>

            </div>
        <?php };

        if (function_exists('wp_corenavi')) wp_corenavi();

        wp_reset_query(); ?>

    </div>

	<?php get_sidebar();?>
</main>
<div class="delimetr"></div>
<?php get_footer();?>
