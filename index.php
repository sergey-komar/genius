<?php


get_header();
?>
		<div>
		<?php
			if(have_posts()) : while(have_posts()) : the_post()?>

			<?php get_template_part('parts/content');?>

		<?php endwhile;
			// posts_nav_link( ' . ', 'Назад', 'Вперёд' );//Используется на архивных страницах
			// the_posts_pagination( [
			// 	'prev_text' => 'вперёд',
			// 	'next_text' => 'назад'
			// ]);
			 echo paginate_links();

		else :?>
			
			<?php get_template_part('parts/content-none');?>
		<?php endif;?>
		</div>
<?php
get_sidebar('cars');
get_footer();
