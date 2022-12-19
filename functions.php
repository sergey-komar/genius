<?php
/**
 * geniuswp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package geniuswp
 */

function genius_enqueue_scripts(){
	wp_enqueue_style('genius-general', get_template_directory_uri().'/assets/css/general.css', [], '2022', 'all');

	wp_enqueue_script('genius-script', get_template_directory_uri().'/assets/js/script.js', [], 2022, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	} //Работоспособность ответа на комментарий
}

add_action('wp_enqueue_scripts', 'genius_enqueue_scripts');




function genius_show_meta(){
	echo'Hello';
}
add_action('wp_body_open', 'genius_show_meta');

//Добавляем класс в зависимости от того как какой странице находимся такой класс и добавляем
function genius_body_class($classes){

	if(is_front_page()){
		$classes [] = 'test';
	}else{
		if(is_singular()){
			$classes [] = 'test1';
		}
	}
	return $classes;
}
add_filter('body_class', 'genius_body_class');
//Добавляем класс в зависимости от того как какой странице находимся такой класс и добавляем



function genius_register_menus(){
	register_nav_menus([
		'header_nav' => 'навигация в шапке',
		'footer_nav' => 'навигация в футере'
	]);
	
	
// Поддержка html 5 тегов
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_theme_support( 'post-thumbnails' );
	add_image_size('car-cover', 300, 200, true);//Если 4 парамертр стоит true, то картинка будет точно такой какой задали, если нет этого параметра то будет 300 и по высоте будет масштабироваться


	add_theme_support( 'title-tag' );
	add_theme_support('post-formats', [
		'video',
		'image',
		'gallery'
	]);
	add_post_type_support( 'car', 'post-formats');//Привязывает определённый пост тайп к пост форматам. В данном случаи привязываем car 
}

add_action('after_setup_theme','genius_register_menus', 0);



require get_template_directory() . '/inc/widget-about.php';//подключаем свой виджет


function geniuswp_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'geniuswp' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'geniuswp' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Сайдбар для машин', 'geniuswp' ),
			'id'            => 'carsidebar',
			'description'   => esc_html__( 'сайдбар на стрнаицах машин', 'geniuswp' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_widget('geniuswp_About_Widget');//Регистрируем свой виджет
}
add_action( 'widgets_init', 'geniuswp_widgets_init' );





function genius_register_post_type(){
 
	register_post_type('car', array(
		'labels'             => array(
			'name'               => __('Машины'), // Основное название типа записи
			'singular_name'      => __('Машины'), // отдельное название записи типа Book
			'add_new'            => __('Добавить Машины'),
			'add_new_item'       => __('Добавить новые Машины'),
			'edit_item'          => __('Редактировать Машины'),
			'new_item'           => __('Новые Машины'),
			'view_item'          => __('Посмотреть Машины'),
			'search_items'       => __('Найти Машины'),
			'not_found'          => __('Машин не найдено'),
			'not_found_in_trash' => __('В корзине услуг не найдено'),
			'parent_item_colon'  => __(''),
			'menu_name'          => __('Машины')
	
		  ),
		  'public'             => true,
		  'has_archive'        => true,
		  'publicly_queryable' => true,
		  'show_ui'            => true,
		  'show_in_menu'       => true,
		  'query_var'          => true,
		  'rewrite'            => true,
		  'capability_type'    => 'post',
		  'menu_icon'			 => 'dashicons-businessperson',
		//   'hierarchical'       => true, при помощи page-attributes добавляем древовидную структуру
		  'menu_position'      => null,
		  // 'taxonomies'          => array( 'category' ),//Добавляем категории
		  'supports'           => array('title','editor','thumbnail','excerpt','custom-fields','comments', 'author','page-attributes', 'post-formats'),
		//   'show_in_rest'      => true//Включает редактор гутенберг
	));

	register_taxonomy( 'brand', [ 'car' ], [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Категории',
			'add_new_item'      => 'Добавить категорию',
			'menu_name'         => 'Brand',
		
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'hierarchical'          => true,
		'show_ui'               => true,
		'query_var'             => true,
		'show_admin_column'     => true,//СТАНОВИТСЯ ВИДНО В АДМИНКЕ НАДПИСЬ РЯДОМ С ЗАПИСЬЮ
		// 'rewrite'             => true
		'rewrite'               => array('slug'=>'brands')
	] );

	register_taxonomy( 'manufacture', [ 'car' ], [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Год производства',
			'add_new_item'      => 'Добавить Год производства',
			'menu_name'         => 'Год производства',
		
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'hierarchical'          => true,
		'show_ui'               => true,
		'query_var'             => true,
		'show_admin_column'     => true,//СТАНОВИТСЯ ВИДНО В АДМИНКЕ НАДПИСЬ РЯДОМ С ЗАПИСЬЮ
		// 'rewrite'             => true
		'rewrite'               => array('slug'=>'manufacture')
	] );

}
add_action('init', 'genius_register_post_type');








if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function geniuswp_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on geniuswp, use a find and replace
		* to change 'geniuswp' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'geniuswp', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	
	

	
	

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'geniuswp_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'geniuswp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function geniuswp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'geniuswp_content_width', 640 );
}
add_action( 'after_setup_theme', 'geniuswp_content_width', 0 );




/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

