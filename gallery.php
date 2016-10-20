<?php

/*
Plugin Name: Мод стандартной галереи
Plugin URI: http://example.ru/wp-gallery-mod
Description: WordPress плагин, который изменит вывод стандартной галереи.
Version: 1.0
Author: abler98
Author URI: https://github.com/abler98
*/

wp_register_script( 'gallery', plugin_dir_url( __FILE__ ) . 'gallery.js' );
wp_register_style( 'gallery', plugin_dir_url( __FILE__ ) . 'gallery.css' );

wp_enqueue_script( 'masonry' );
wp_enqueue_script( 'gallery', false, [ 'jquery-masonry' ], false, true );
wp_enqueue_style( 'gallery' );

/*
 * Lazy Loading
 */

function inject_gallery_lazy_loading_attributes( $attr ) {
	$attr['data-src'] = $attr['src'];
	$attr['src'] = admin_url( 'images/loading.gif' );
	return $attr;
}

add_filter( 'wp_get_attachment_image_attributes', 'inject_gallery_lazy_loading_attributes' );
