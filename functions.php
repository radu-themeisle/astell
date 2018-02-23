<?php
if ( !defined( 'ABSPATH' ) ) exit;

if ( !function_exists( 'astell_child_parent_css' ) ):
    function astell_child_parent_css() {
        wp_enqueue_style( 'astell_child_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'bootstrap' ) );
        if( is_rtl() ) {
            wp_enqueue_style( 'astell_child_parent_rtl', trailingslashit( get_template_directory_uri() ) . 'style-rtl.css', array( 'bootstrap' ) );
        }

    }
endif;
add_action( 'wp_enqueue_scripts', 'astell_child_parent_css', 10 );

/**
 * Import options from the parent theme
 *
 * @since 1.0.0
 */
function astell_child_get_parent_options() {
    $astell_mods = get_option( 'theme_mods_astell-pro' );
    if ( ! empty( $astell_mods ) ) {
        foreach ( $astell_mods as $astell_mod_k => $astell_mod_v ) {
            set_theme_mod( $astell_mod_k, $astell_mod_v );
        }
    }
}
add_action( 'after_switch_theme', 'astell_child_get_parent_options' );


/**
 * Register Fonts
 *
 * @return string
 */
function astell_fonts_url() {

    $font_familiy = 'Montserrat:300,400,700';

    $query_args = array(
        'family' => urlencode( $font_familiy ),
        'subset' => urlencode( 'latin,latin-ext' ),
    );
    $fonts_url  = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

    return $fonts_url;
}

function astell_enqueue_scripts()
{
    wp_dequeue_script( 'hestia_fonts' );

    $hestia_headings_font = get_theme_mod('hestia_headings_font');
    $hestia_body_font = get_theme_mod('hestia_body_font');
    if (empty($hestia_headings_font) || empty($hestia_body_font)) {
        wp_enqueue_style('hestia_fonts', astell_fonts_url(), array(), HESTIA_VERSION);
    }
}

// Insert Latest blogposts author at bottom of card
function latest_blogposts_author($id){
    $post_author_id = get_post_field( 'post_author', $id );
    $display_name = get_the_author_meta('display_name', $post_author_id);
echo 'By: ' . $display_name;
}
add_action('hestia_frontpage_blog_card_bottom_author','latest_blogposts_author');

// Insert Latest blogposts date at bottom of card
function latest_blogposts_date(){
    the_time('jS F');
}
add_action('hestia_frontpage_blog_card_bottom_date','latest_blogposts_date');

// Make Homepage slider default 'right'
function astell_slider_layout() {
    return 'right';
}
add_filter( 'hestia_default_slider_alignment', 'astell_slider_layout');