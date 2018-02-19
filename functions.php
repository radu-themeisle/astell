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