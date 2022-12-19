<?php
/**
 * Template Name: Главная страница
 */

 get_header();
?>
  
		<div>

        <?php

                global $post;

                // $paged = get_query_var('paged');
                // 		if($paged == get_query_var('paged')){
                // 			get_query_var('paged');
                // 		}else{
                // 			1;
                // 		}

                $paged = (get_query_var('page')) ? get_query_var('page') : 1;
                $cars = new WP_Query([
                    'post_type'      => 'car',
                    'posts_per_page' => 2,
                    'paged'          => $paged
                ]);
                if($cars->have_posts()) : while($cars->have_posts()) : $cars->the_post()?>

                <?php get_template_part('parts/content', 'car');?>

                <?php endwhile; ?>
                <div class="pagination">
                    <?php
                    $big = 999999999; // need an unlikely integer

                    echo paginate_links( array(
                        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format' => '?paged=%#%',
                        'current' => max( 1, get_query_var('page') ),
                        'total' => $cars->max_num_pages
                    ) );
                    
                    
                    ?>
                    
                </div>
                <?php else :?>
                <?php endif;
                wp_reset_postdata();
                ?>
                </div>





        <?php
            global $post;
            $blogpost = new WP_Query([
                'post_type' => 'post',
                'post_per_page' => -1
            ]);
        ?>
		<?php
			if( $blogpost->have_posts()) : while( $blogpost->have_posts()) :  $blogpost->the_post()?>

			<?php get_template_part('parts/content');?>

		<?php endwhile; else :?>
			
			<?php get_template_part('parts/content-none');?>
		<?php endif;
         wp_reset_postdata();
        ?>
		</div>


<?php
get_sidebar('cars');
 echo "Sergey";
 get_sidebar('cars');