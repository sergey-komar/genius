<?php
echo 'BRAND';
get_header();

$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

echo $term->name;
?>


<div>
		<?php
			if(have_posts()) : while(have_posts()) : the_post()?>

			<?php get_template_part('parts/content', 'car');?>

		<?php endwhile; else :?>
			
			<?php get_template_part('parts/content-none');?>
		<?php endif;?>
		</div>