<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package geniuswp
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open()?>

	<?php
	wp_nav_menu([
		'theme_location' => 'header_nav'
	]);
	?>


<!-- <button id="button">Отправить</button>
<div id="car_content" style="background: #f5f5f5; border:1px solid #000;"></div> -->

	
	<!-- Выводим поиск -->
<?php get_search_form( );?>
	<!-- Выводим поиск -->


<!-- //Выводим то что есть в папке parts -->
<?php get_template_part('parts/part', 'two');?>
<!-- //Выводим то что есть в папке parts -->
<br>
<!-- Проверяем является эта страница таксономией, если да то выводим один контент, если нет, то выводим другой контент -->
<?php
if(is_tax('brand', 'bmw')){
	echo'Страница таксономии';
}else{
	echo'Обычная страница';
}
?>
<!-- Проверяем является эта страница таксономией, если да то выводим один контент, если нет, то выводим другой контент -->


	
	
