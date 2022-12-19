<?php
?>
<article <?php post_class('');?>>

    <?php
        if(has_post_thumbnail(get_the_ID())){
           the_post_thumbnail('car-cover');
        }
      
    ?>
    <h1><?php the_title();?></h1> 
    <div><?php the_content();?></div>
    <a href="<?php the_permalink();?>">Читать подробнее</a>
</article>