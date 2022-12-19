<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package geniuswp
 */

get_header();
?>

	<main id="primary" class="site-main">

	<h1>Страница машины</h1>

		<div>
			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
		<?php

				global $post;

				// $paged = get_query_var('paged');
				// 		if($paged == get_query_var('paged')){
				// 			get_query_var('paged');
				// 		}else{
				// 			1;
				// 		}
				
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 3;
				$cars = new WP_Query([
					'post_type'      => 'car',
					'posts_per_page' => 2,
					'paged'          => $paged
				]);
			if($cars->have_posts()) : while($cars->have_posts()) : $cars->the_post()?>

			<?php get_template_part('parts/content');?>

		<?php endwhile; ?>
			 <div class="pagination">
			 		<?php
					$big = 999999999; // need an unlikely integer

					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $cars->max_num_pages
					) );
					
					
					 ?>
					
			 </div>
		<?php else :?>
			
			<?php get_template_part('parts/content-none');?>
		<?php endif;
			wp_reset_postdata();
		?>
		</div>

	</main><!-- #main -->

<?php
get_sidebar('cars');
get_footer();
