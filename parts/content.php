<?php
?>
<article <?php post_class();?>>
    <h1><?php the_title();?></h1>
    <div><?php the_content();?></div>
    <a href="<?php the_permalink();?>">Читать подробнее</a>
</article>