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
    $hestia_mods = get_option( 'theme_mods_hestia-pro' );
    if ( ! empty( $hestia_mods ) ) {
        foreach ( $hestia_mods as $hestia_mod_k => $hestia_mod_v ) {
            set_theme_mod( $hestia_mod_k, $hestia_mod_v );
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
add_filter( 'hestia_slider_alignment', 'astell_slider_layout');

//Change the layout of team card, put the avatar on top
function astell_team_avatar() {
    return 'col-md-7';
}
add_filter( 'hestia_team_avatar', 'astell_team_avatar');

//Change general layout to default to full width
function astell_general_layout() {
    return 0;
}

add_filter( 'hestia_default_layout', 'astell_general_layout');



//Set the Blog default layout to alternative
function astell_default_layout() {
    return 'blog_alternative_layout';
}
add_filter( 'hestia_blog_default_layout', 'astell_default_layout');

//Blog no sidebar

function astell_blog_no_sidebar() {
    return true;
}

add_filter( 'hestia_blog_no_sidebar', 'astell_blog_no_sidebar' );

//Set the default accent color to orange
function astell_accent_color() {
    return '#F4874B';
}
add_filter( 'hestia_accent_color_default', 'astell_accent_color');

//Change default picture of contact section

function astell_contact_background() {
    return get_stylesheet_directory_uri() . '/assets/img/sunset.jpg';
}
add_filter( 'hestia_contact_background_default', astell_contact_background);

//Change default pictures of Slider section
//Slider 1
function astell_slider1() {
    return get_stylesheet_directory_uri() . '/assets/img/astell_slider1.jpg';
}
add_filter( 'hestia_slider1', 'astell_slider1');

//Slider 2
function astell_slider2() {
    return get_stylesheet_directory_uri() . '/assets/img/astell_slider2.jpg';
}
add_filter( 'hestia_slider2', 'astell_slider2');

//Slider 3
function astell_slider3() {
    return get_stylesheet_directory_uri() . '/assets/img/astell_slider3.jpg';
}
add_filter( 'hestia_slider3', 'astell_slider3');

//Change default button color of Slider section
//Slider 1 button
function astell_slider1_button() {
    return '#F2AF5B';
}
add_filter( 'hestia_slider1_button', 'astell_slider1_button');

//Slider 2 button
function astell_slider2_button() {
    return '#F2AF5B';
}
add_filter( 'hestia_slider2_button', 'astell_slider2_button');

//Slider 3 button
function astell_slider3_button() {
    return '#F2AF5B';
}
add_filter( 'hestia_slider3_button', 'astell_slider3_button');

//Change default pictures of About section

function astell_about_image() {
    return get_stylesheet_directory_uri() . '/assets/img/background.jpg';
}
add_filter( 'hestia_about_image_filter', 'astell_about_image');

//Add background image to Testimonials section

/* Display overlay (section-image class) on testimonials section only if section has a background */
/* NU MERGE */
function astell_testimonials_image(){

$astell_testimonials_featured = get_stylesheet_directory_uri() . '/assets/img/background.jpg';

if ( ! empty( $astell_testimonials_featured ) ) {

    $astell_testimonials_featured = ' style="background-image: url(\'' . esc_url( $astell_testimonials_featured ) . '\')" ';
}


        echo $astell_testimonials_featured;
}
add_action('hestia_testimonials_section_image', 'astell_testimonials_image');

//Change default pictures of Ribbon section

function astell_ribbon_background() {
    return get_stylesheet_directory_uri() . '/assets/img/background.jpg';
}
add_filter( 'hestia_ribbon_background_default', 'astell_ribbon_background');

//Default footer to 'white_footer'

function astell_footer_style() {
    return 'white_footer';
}

add_filter( 'hestia_default_footer', 'astell_footer_style');

//Modify header gradient color

function astell_header_gradient(){
    return '#F46A4E';
}

add_filter( 'hestia_header_gradient_default', 'astell_header_gradient');

//footer copyright

function astell_credits() {
    return sprintf(
    /* translators: %1$s is Theme Name, %2$s is WordPress */
        esc_html__( '%1$s | Powered by %2$s', 'hestia-pro' ),
        sprintf(
        /* translators: %s is Theme name */
            '<a href="https://themeisle.com/themes/hestia/" target="_blank" rel="nofollow">%s</a>',
            esc_html__( 'Astell', 'hestia-pro' )
        ),
        /* translators: %s is WordPress */
        sprintf(
            '<a href="%1$s" rel="nofollow">%2$s</a>',
            esc_url( __( 'http://wordpress.org', 'hestia-pro' ) ),
            esc_html__( 'R C', 'hestia-pro' )
        )
    );
}

add_filter( 'theme_mod_hestia_general_credits', 'astell_credits');

//navbar text color on hover

function astell_navbar_text_color_hover() {
    return '#F46A4E';
}

add_filter( 'hestia_navbar_text_color_hover', 'astell_navbar_text_color_hover');

//Ribbon text

function astell_ribbon_text() {
    return 'Don&#39;t miss out the latest news!';
}

add_filter( 'hestia_ribbon_text', 'astell_ribbon_text');

//Ribbon button text

function astell_subscribe_button() {
    return 'subscribe now &#9889;';
}

add_filter( 'hestia_subscribe_button', 'astell_subscribe_button');


// Change background image of Subscribe Section

function astell_subscribe_background_default() {
    return get_stylesheet_directory_uri() . '/assets/img/sunset.jpg';
}

add_filter( 'hestia_subscribe_background_default', 'astell_subscribe_background_default');

//Change 'login_headerurl'

function astell_headerurl() {
    return 'https://themeisle.com';
}

add_filter( 'login_headerurl', 'astell_headerurl');


//Change Login url title
function astell_login_logo_url_title() {
    return 'Astell to the tell';
}
add_filter( 'login_headertitle', 'astell_login_logo_url_title' );

//Change the Login Logo

function astell_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url('http://wwwcdn.howdesign.com/wp-content/uploads/glug-animated-logos1.gif');
            height: 235px;
            width:314px;
            background-size: 314px 235px;
            background-repeat: no-repeat;
            padding-bottom: 0;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'astell_login_logo' );