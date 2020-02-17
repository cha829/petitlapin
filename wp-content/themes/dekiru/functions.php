<?php
/**
 * dekiru functions and definitions.
 *
 * @package  dekiru
 * @license  GNU General Public License v2.0
 * @since    dekiru 1.0
 */

if ( ! function_exists( 'dekiru_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dekiru_setup() {
	global $content_width;

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on dekiru, use a find and replace
	 * to change 'dekiru' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'dekiru', get_template_directory() . '/languages' );

	/*-------------------------------------------*/
	/*	Set content width
	/* 	(Auto set up to media max with.)
	/*-------------------------------------------*/
	if ( ! isset( $content_width ) ) $content_width = 750;

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array( 'GlobalNav' => esc_html__( 'GlobalNav', 'dekiru' ) ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-header', array(
		'default-image' => '%s/assets/img/default-header.jpg',
		'width' => 850,
		'height' => 400,
		'flex-width' => true,
		'flex-height' => true,
		'header-text' => false,
		'uploads' => true,
	) );

	register_default_headers( array(
		'accelerate' => array(
			'url' => '%s/assets/img/default-header.jpg',
			'thumbnail_url' => '%s/assets/img/default-header.jpg',
			'description' => 'Default Image'
		),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_editor_style( '/assets/css/editor.css' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-logo', array(
		'header-text' => array( 'site-title', 'site-description' ),
	) );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
}
endif;
add_action( 'after_setup_theme', 'dekiru_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dekiru_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'dekiru' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s margin-bottom-40">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="title-v4">',
		'after_title'   => '</h2>',
	) );

    $footer_widget_area_count = 4;

	for ( $i = 1; $i <= $footer_widget_area_count; $i++ ) {
		register_sidebar( array(
			'name'			=> __( 'Footer', 'dekiru' ).$i,
			'id' 			=> 'footer-'.$i,
			'before_widget' => '<section id="%1$s" class="widget %2$s margin-bottom-20">',
			'after_widget'  => '</section>',
			'before_title' 	=> '<h2>',
			'after_title' 	=> '</h2>',
		) );
	}

	register_sidebar( array(
		'name'			=> __( 'Front Page Top', 'dekiru' ),
		'id'			=> 'front-page-top',
		'description'	=> '',
		'before_widget'	=> '',
		'after_widget'	=> '',
		'before_title'	=> '',
		'after_title'	=> '',
	) );

}
add_action( 'widgets_init', 'dekiru_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dekiru_scripts() {

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// CSS
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css' );
	wp_enqueue_style( 'line-icons', get_template_directory_uri() . '/assets/plugins/line-icons/line-icons.css' );
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/plugins/owl-carousel/owl.carousel.css' );
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/plugins/slick/slick.css' );
    wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/plugins/slick/slick-theme.css' );
	wp_enqueue_style( 'dekiru-blog-style', get_template_directory_uri() . '/assets/css/blog.style.css' );
	wp_enqueue_style( 'dekiru-header', get_template_directory_uri() . '/assets/css/header.css' );
	wp_enqueue_style( 'dekiru-footer', get_template_directory_uri() . '/assets/css/footer.css' );
	wp_enqueue_style( 'dekiru-default-style', get_template_directory_uri() . '/assets/css/default.css' );
	wp_enqueue_style( 'dekiru-style', get_stylesheet_uri() );

	// JavaScript
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), '', true );
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/plugins/owl-carousel/owl.carousel.js', array('jquery'), '', true );
    wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/plugins/slick/slick.js', array('jquery'), '', true );
	wp_enqueue_script( 'dekiru-app-js', get_template_directory_uri() . '/assets/js/app.js', array('jquery'), '', true );
	wp_enqueue_script( 'dekiru-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '', true );

}
add_action( 'wp_enqueue_scripts', 'dekiru_scripts' );

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Implement the Custom Walker
 */
require get_template_directory() . '/inc/custom-walker.php';

/**
 * Implement the Bread Crumb
 */
require get_template_directory() . '/inc/bread-crumb.php';