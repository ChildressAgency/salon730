<?php

	// load jquery
	function jquery_cdn(){
	  if(!is_admin()){
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', false, null, true);
		wp_enqueue_script('jquery');
	  }
	}
	add_action('wp_enqueue_scripts', 'jquery_cdn');

	// load scripts
	function salon730_scripts(){
		global $wp_query;
		wp_register_script(
			'slick-script', 
			'//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', 
			array('jquery'), 
			'', 
			true
		);
		wp_register_script(
			'salon730-script', 
			'/wp-content/themes/salon730/js/salon730-script.js', 
			array('jquery'), 
			'', 
			true
		);
		
		wp_enqueue_script( 'slick-script' );
		wp_enqueue_script( 'salon730-script' );
	}
	add_action('wp_enqueue_scripts', 'salon730_scripts', 100);
	
	// load styles
	function salon730_styles(){
		wp_register_style('slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
		wp_register_style('salon730', get_template_directory_uri() . '/style.css');

		wp_enqueue_style('slick');
		wp_enqueue_style('salon730');
	}
	add_action('wp_enqueue_scripts', 'salon730_styles');

	// load fonts
	function load_fonts() {
		wp_enqueue_style( 'font-awesome', '//use.fontawesome.com/releases/v5.3.1/css/all.css' );
		wp_enqueue_style( 'fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:700|Roboto:400,700|Taviraj:400,500,700' );
	}
	add_action( 'wp_enqueue_scripts', 'load_fonts' );

	// Register Navigation Menus
	register_nav_menus( array(
		'main_menu' => 'Main Menu',
		'footer_menu' => 'Footer Menu',
	) );

	// Custom Blocks Category
	function custom_blocks_category( $categories, $post ){
		return array_merge(
			array(
				array(
					'slug'	=> 'custom-blocks',
					'title'	=> __( 'Custom Blocks', 'custom-blocks' )
				)
			),
			$categories
		);
	}
	add_filter( 'block_categories', 'custom_blocks_category', 10, 2 );

	function custom_editor_styles(){
		wp_enqueue_style( 'editor-styles', get_stylesheet_directory_uri()  .'/css/editor-styles.css' );
	}
	add_action( 'enqueue_block_editor_assets', 'custom_editor_styles' );

	function salon730_color_palette(){
		add_theme_support(
			'editor-color-palette', array(
				array(
					'name'		=> 'Green',
					'slug'		=> 'green',
					'color'		=> '#8bc53f'
				),
				array(
					'name'		=> 'Light Green',
					'slug'		=> 'light-green',
					'color'		=> '#98ca50'
				),
				array(
					'name'		=> 'Dark Grey',
					'slug'		=> 'dark-grey',
					'color'		=> '#4d4d4d'
				),
				array(
					'name'		=> 'Black',
					'slug'		=> 'black',
					'color'		=> '#000000'
				),
				array(
					'name'		=> 'White',
					'slug'		=> 'white',
					'color'		=> '#ffffff'
				),
			)
		);
	}
	add_action( 'after_setup_theme', 'salon730_color_palette' );

	include "functions/options_page.php";
	include "functions/custom-nav-walker.php";
	include "functions/gutenberg-blocks.php";
?>
