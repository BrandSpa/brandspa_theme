<?php
require_once 'vendor/autoload.php';

//LIBS
include_once 'lib/clean_menu.php';
require_once 'lib/response_json.php';
require_once 'lib/menu_array.php';
require_once 'lib/products.php';

//MIGRATIONS
include_once 'migrations/contacts.php';
include_once 'migrations/quotations.php';

//WIDGETS
include_once 'widgets/header.php';

//SHORTCODES
include_once 'shortcodes/slider.php';
include_once 'shortcodes/quo_fixed.php';
include_once 'shortcodes/contact.php';
include_once 'shortcodes/posts_slider.php';
include_once 'shortcodes/image_hover.php';
include_once 'shortcodes/news.php';

//VISUAL COMPOSER
include_once 'shortcodes/vc/slider.php';
include_once 'shortcodes/vc/quo_fixed.php';
include_once 'shortcodes/vc/contact.php';
include_once 'shortcodes/vc/quo_fixed.php';
include_once 'shortcodes/vc/news.php';
include_once 'shortcodes/vc/posts_slider.php';
include_once 'shortcodes/vc/image_hover.php';
include_once 'shortcodes/custom/fullpageproject.php';
include_once 'shortcodes/custom/slider.php';


//API
include_once 'api/quotations.php';
include_once 'api/contacts.php';

//OPTIONS
include_once 'options/quotations.php';
include_once 'options/contacts.php';

require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

//MENUS


function add_theme_scripts() {
  wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/util/bootstrap-4/css/bootstrap.min.css', array(), '1.1', 'all');
  wp_enqueue_style( 'swipercss', get_template_directory_uri() . '/util/swiper/dist/css/swiper.min.css', array(), '1.1', 'all');
  wp_enqueue_style( 'style', get_stylesheet_uri() );
  wp_enqueue_script( 'swiper', get_template_directory_uri() . '/util/swiper/dist/js/swiper.min.js', array ( 'jquery' ), 1.1, true);
  wp_enqueue_script( 'bootstrapjs', get_template_directory_uri() . '/util/bootstrap-4/js/bootstrap.min.js', array ( 'jquery' ), 1.1, true);
  wp_enqueue_script( 'menujs', get_template_directory_uri() . '/util/menu.js', array ( 'jquery' ), 1.1, true);
  wp_enqueue_script( 'parallax', get_template_directory_uri() . '/util/parallax/src/parallax.min.js', array ( 'swiper' ), 1.1, true);
  wp_enqueue_script( 'sliderjs', get_template_directory_uri() . '/shortcodes/custom/js/slider.js', array ( 'parallax' ), 1.1, true);
  wp_enqueue_style( 'fullpageproject', get_template_directory_uri() . '/shortcodes/custom/css/fullpageproject.css', array(), '1.1', 'all');
  wp_enqueue_style( 'slider', get_template_directory_uri() . '/shortcodes/custom/css/slider.css', array(), '1.1', 'all');
 
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

add_filter('nav_menu_css_class', 'add_classes_on_li', 1, 3);
function add_classes_on_li($classes, $item, $args)
{
    $classes[] = 'nav-item';

    return $classes;
}

add_filter('wp_nav_menu', 'add_classes_on_a');
function add_classes_on_a($ulclass)
{
    return preg_replace('/<a /', '<a class="nav-link"', $ulclass);
}

function brandspa_setup() {
	
	add_theme_support( 'custom-logo', array(
		'height'      => 150,
		'width'       => 400,
		'flex-width' => true,
  ) );
  
  register_nav_menus(
    array(
      'main-menu' => 'Main Navigation'
    )
  );

}
add_action( 'after_setup_theme', 'brandspa_setup' );

function brandspa_the_custom_logo() {
	
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}

}

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
 }
 add_filter('upload_mimes', 'cc_mime_types');

 function brandspa_widgets_init() {

	register_sidebar( array(
		'name'          => 'Home Menu Widget',
		'id'            => 'home_menu_widget',
		'before_widget' => '<div>',
		'after_widget'  => '</div>'
	) );
}
add_action( 'widgets_init', 'brandspa_widgets_init' );