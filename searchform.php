<form  method="get" id="searchform" action="<?php echo home_url( '/' ) ?>">
   <input class="header__form-input"  type="text" name="s" value="<?php  get_search_query(); ?>">
   <input type="submit">

   
   <!-- ищем только в постах -->
   <input type="hidden" value="post" name="post_type">
    <!-- ищем только в постах -->
</form>