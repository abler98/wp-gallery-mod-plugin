<?php

/*
Plugin Name: Мод стандартной галереи
Plugin URI: http://example.ru/wp-gallery-mod
Description: WordPress плагин, который изменит вывод стандартной галереи.
Version: 1.0
Author: abler98
Author URI: https://github.com/abler98
*/

function print_gallery_css() {
	wp_print_styles( 'gallery' );
}

function print_gallery_head_js() {
	wp_print_scripts( 'masonry' );
}

function print_gallery_footer_js() {
	wp_print_scripts( 'gallery' );
}

wp_register_script( 'gallery', plugins_url( 'gallery.js', __FILE__ ) );
wp_register_style( 'gallery', plugins_url( 'gallery.css', __FILE__ ) );

add_action( 'wp_head', 'print_gallery_css' );
add_action( 'wp_head', 'print_gallery_head_js' );
add_action( 'wp_footer', 'print_gallery_footer_js' );

/*
 * Lazy Loading
 */

function inject_gallery_lazy_loading_attributes( $attr ) {
	$attr['data-src'] = $attr['src'];
	$attr['src'] = admin_url( 'images/loading.gif' );
	return $attr;
}

add_filter( 'wp_get_attachment_image_attributes', 'inject_gallery_lazy_loading_attributes' );
