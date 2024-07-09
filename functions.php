<?php
/*
 * MainterTheme v1.0
*/

function mainter_setup(){

  add_theme_support( 'title-tag' );
 
  add_theme_support( 'post-thumbnails' );

  add_theme_support( 'side-thumbnails' );

  add_theme_support( 'custom-logo' );

  add_theme_support( 'automatic-feed-links' );

  add_theme_support( 'html5', array(
    'search-form',
    'gallery',
    'caption',
  ));

}

add_action('after_setup_theme', 'mainter_setup');

/*
 * Load translations
 */

function mainter_lang(){
    load_theme_textdomain('mainter', get_template_directory() . '/languages');
}

add_action('after_setup_theme', 'mainter_lang');


// @Registrar estilos
function wp_enqueue_styles() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'wp_enqueue_styles');

// Primera imagen del post
function firstImage() {
  global $post, $posts; $first_img = ''; 
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $post->post_content, $matches);
  $first_img = $matches[1][0];
  if(empty($first_img)) {
    $first_img = "https://picsum.photos/seed/picsum/200/300";
  }
  return $first_img;
}

// Eliminar css / javascript
function rmr_remove_wp_block_library_css() {
   wp_dequeue_style( 'wp-block-library'); // Estilos de editor de bloques
   wp_dequeue_style( 'wp-block-library-theme'); // Tema para editor de bloques
   wp_dequeue_style( 'wc-blocks-style' ); // WooCommerce
   wp_dequeue_style( 'global-styles' ); // Estilos globales
   wp_dequeue_style( 'classic-theme-styles'); // Estillos del clasico editor
}

add_action( 'wp_enqueue_scripts', 'rmr_remove_wp_block_library_css', 100 );

// Limpiar etiquetas de wordpress
function remove_headlinks() {
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'start_post_rel_link' );
    remove_action( 'wp_head', 'index_rel_link' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );
    remove_action( 'wp_head', 'adjacent_posts_rel_link' );
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
    remove_action( 'wp_head', 'parent_post_rel_link' );
    remove_filter( 'wp_robots', 'wp_robots_max_image_preview_large');
    remove_action( 'wp_head', 'feed_links', 2 );
    remove_action( 'wp_head', 'feed_links_extra', 3 );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
}
add_action( 'init', 'remove_headlinks' );

// Desactiva el editor de bloques en la gestión de widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );

/** ! Eliminar Gutenberg **/
add_filter( 'use_block_editor_for_post_type', '__return_false', 100);
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
