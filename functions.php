<?php
/**
 * Viral News Center functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Viral News Center
 */

if ( ! defined( 'MAGAZINE_EXPRESS_URL' ) ) {
    define( 'MAGAZINE_EXPRESS_URL', esc_url( 'https://www.themagnifico.net/products/viral-news-wordpress-theme', 'viral-news-center') );
}
if ( ! defined( 'MAGAZINE_EXPRESS_TEXT' ) ) {
    define( 'MAGAZINE_EXPRESS_TEXT', __( 'Viral News Center Pro','viral-news-center' ));
}
if ( ! defined( 'MAGAZINE_EXPRESS_CONTACT_SUPPORT' ) ) {
define('MAGAZINE_EXPRESS_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/viral-news-center','viral-news-center'));
}
if ( ! defined( 'MAGAZINE_EXPRESS_REVIEW' ) ) {
define('MAGAZINE_EXPRESS_REVIEW',__('https://wordpress.org/support/theme/viral-news-center/reviews/#new-post','viral-news-center'));
}
if ( ! defined( 'MAGAZINE_EXPRESS_LIVE_DEMO' ) ) {
define('MAGAZINE_EXPRESS_LIVE_DEMO',__('https://demo.themagnifico.net/viral-news-center/','viral-news-center'));
}
if ( ! defined( 'MAGAZINE_EXPRESS_GET_PREMIUM_PRO' ) ) {
define('MAGAZINE_EXPRESS_GET_PREMIUM_PRO',__('https://www.themagnifico.net/products/viral-news-wordpress-theme','viral-news-center'));
}
if ( ! defined( 'MAGAZINE_EXPRESS_PRO_DOC' ) ) {
define('MAGAZINE_EXPRESS_PRO_DOC',__('https://demo.themagnifico.net/eard/wathiqa/viral-news-center-doc/ ','viral-news-center'));
}
if ( ! defined( 'MAGAZINE_EXPRESS_BUY_TEXT' ) ) {
    define( 'MAGAZINE_EXPRESS_BUY_TEXT', __( 'Buy Viral News Center Pro','viral-news-center' ));
}
if ( ! defined( 'MAGAZINE_EXPRESS_FREE_DOC' ) ) {
define('MAGAZINE_EXPRESS_FREE_DOC',__('https://demo.themagnifico.net/eard/wathiqa/viral-news-center-free-doc/ ','viral-news-center'));
}

function viral_news_center_enqueue_styles() {
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.css');
    $viral_news_center_parentcss = 'magazine-express-style';
    $viral_news_center_theme = wp_get_theme(); wp_enqueue_style( $viral_news_center_parentcss, get_template_directory_uri() . '/style.css', array(), $viral_news_center_theme->parent()->get('Version'));
    wp_enqueue_style( 'viral-news-center-style', get_stylesheet_uri(), array( $viral_news_center_parentcss ), $viral_news_center_theme->get('Version'));
    wp_enqueue_script('viral-news-center-child-theme-js', esc_url(get_theme_file_uri()) . '/assets/js/child-theme-script.js', array( 'jquery' ), true );
    wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );  
}

add_action( 'wp_enqueue_scripts', 'viral_news_center_enqueue_styles' );


function viral_news_center_admin_scripts() {
    // demo CSS
    wp_enqueue_style( 'viral-news-center-demo-css', get_theme_file_uri( 'assets/css/demo.css' ) );
    }
add_action( 'admin_enqueue_scripts', 'viral_news_center_admin_scripts' );

/*radio button sanitization*/
function viral_news_center_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}
function viral_news_center_sanitize_select( $input, $setting ){
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function viral_news_center_customize_register($wp_customize){

     // Pro Version
    class Viral_News_Center_Customize_Pro_Version extends WP_Customize_Control {
        public $type = 'pro_options';

        public function render_content() {
            echo '<span>For More <strong>'. esc_html( $this->label ) .'</strong>?</span>';
            echo '<a href="'. esc_url($this->description) .'" target="_blank">';
                echo '<span class="dashicons dashicons-info"></span>';
                echo '<strong> '. esc_html( MAGAZINE_EXPRESS_BUY_TEXT,'viral-news-centerp' ) .'<strong></a>';
            echo '</a>';
        }
    }

    // Custom Controls
    function Viral_News_Center_sanitize_custom_control( $input ) {
        return $input;
    }

    //Slider Section
    $wp_customize->add_section('viral_news_center_slider',array(
        'title' => esc_html__('Slider','viral-news-center')
    ));

    $viral_news_center_args = array('numberposts' => -1);
    $post_list = get_posts($viral_news_center_args);
    $i = 0;
    $pst[]='Select';
    foreach($post_list as $post){
        $pst[$post->ID] = $post->post_title;
    }

    $wp_customize->add_setting('viral_news_center_static_blog_1',array(
        'sanitize_callback' => 'viral_news_center_sanitize_choices',
    ));
    $wp_customize->add_control('viral_news_center_static_blog_1',array(
        'type'    => 'select',
        'choices' => $pst,
        'label' => __('Select post to display slider','viral-news-center'),
        'section' => 'viral_news_center_slider',
    ));

   $categories = get_categories();
    $cat_post = array();
    $cat_post[]= 'select';
    $i = 4;
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cat_post[$category->slug] = $category->name;
    }

    $wp_customize->add_setting('viral_news_center_slider_category',array(
        'default'   => 'select',
        'sanitize_callback' => 'viral_news_center_sanitize_select',
    ));
    $wp_customize->add_control('viral_news_center_slider_category',array(
        'type'    => 'select',
        'choices' => $cat_post,
        'label' => __('Select category to display Slider','viral-news-center'),
        'section' => 'viral_news_center_slider',
    ));

    //Slider button text
    $wp_customize->add_setting('viral_news_center_slider_button_text',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('viral_news_center_slider_button_text',array(
        'label' => __('Slider Button Text','magazine-express'),
        'section'=> 'viral_news_center_slider',
        'type'=> 'text'
    ));

     // Pro Version
    $wp_customize->add_setting( 'pro_version_sliders_setting', array(
        'sanitize_callback' => 'Viral_News_Center_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Viral_News_Center_Customize_Pro_Version ( $wp_customize,'pro_version_sliders_setting', array(
        'section'     => 'viral_news_center_slider',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'viral-news-center' ),
        'description' => esc_url( MAGAZINE_EXPRESS_URL ),
        'priority'    => 100
    )));

    //Latest News Section
    $wp_customize->add_section('viral_news_center_latest_news',array(
        'title' => esc_html__('Latest News','viral-news-center')
    ));

    $wp_customize->add_setting('viral_news_center_news_title_1', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('viral_news_center_news_title_1', array(
        'label' => __('Section Title 1', 'viral-news-center'),
        'section' => 'viral_news_center_latest_news',
        'type' => 'text',
    ));

    $categories = get_categories();
    $cat_post = array();
    $cat_post[]= 'select';
    $i = 0;
    foreach($categories as $category){              
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cat_post[$category->slug] = $category->name;
    }

    $wp_customize->add_setting('viral_news_center_news_category',array(
        'default'   => 'select',
        'sanitize_callback' => 'viral_news_center_sanitize_select',
    ));
    $wp_customize->add_control('viral_news_center_news_category',array(
        'type'    => 'select',
        'choices' => $cat_post,
        'label' => __('Select category to display News','viral-news-center'),
        'section' => 'viral_news_center_latest_news',
    ));

    $wp_customize->add_setting('viral_news_center_news_title_2', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('viral_news_center_news_title_2', array(
        'label' => __('Section Title 2', 'viral-news-center'),
        'section' => 'viral_news_center_latest_news',
        'type' => 'text',
    ));

    $categories = get_categories();
    $cat_post = array();
    $cat_post[]= 'select';
    $i = 0;
    foreach($categories as $category){              
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cat_post[$category->slug] = $category->name;
    }

    $wp_customize->add_setting('viral_news_center_news_category',array(
        'default'   => 'select',
        'sanitize_callback' => 'viral_news_center_sanitize_select',
    ));
    $wp_customize->add_control('viral_news_center_news_category',array(
        'type'    => 'select',
        'choices' => $cat_post,
        'label' => __('Select category to display News','viral-news-center'),
        'section' => 'viral_news_center_latest_news',
    ));

    $wp_customize->add_setting('viral_news_center_news_title_2', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('viral_news_center_news_title_2', array(
        'label' => __('Section Title 2', 'viral-news-center'),
        'section' => 'viral_news_center_latest_news',
        'type' => 'text',
    ));

    $categories = get_categories();
    $cat_post = array();
    $cat_post[]= 'select';
    $i = 0;
    foreach($categories as $category){              
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cat_post[$category->slug] = $category->name;
    }

    $wp_customize->add_setting('viral_news_center_news_category_1',array(
        'default'   => 'select',
        'sanitize_callback' => 'viral_news_center_sanitize_select',
    ));
    $wp_customize->add_control('viral_news_center_news_category_1',array(
        'type'    => 'select',
        'choices' => $cat_post,
        'label' => __('Select category to display News','viral-news-center'),
        'section' => 'viral_news_center_latest_news',
    ));

    $wp_customize->add_setting('viral_news_center_news_title_3', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('viral_news_center_news_title_3', array(
        'label' => __('Section Title 3', 'viral-news-center'),
        'section' => 'viral_news_center_latest_news',
        'type' => 'text',
    ));

    $wp_customize->add_setting('viral_news_center_blog_number',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('viral_news_center_blog_number',array(
        'label' => __('No Of Post To Show','viral-news-center'),
        'section' => 'viral_news_center_latest_news',
        'setting' => 'viral_news_center_blog_number',
        'type'    => 'number'
    ));

    $args = array(
    'orderby'      => 'name',
    'order'        => 'ASC',
    'hide_empty'   => false,
    'taxonomy'     => 'category',
    );

    $categories = get_categories($args);
    $cat_posts = array();
    $default = 'select';

    foreach ($categories as $category) {
        $cat_posts[$category->slug] = $category->name;
    }

    $wp_customize->add_setting('viral_news_center_news_category_2', array(
        'default'              => 'select',
        'sanitize_callback'    => 'sanitize_text_field',
    ));

    $wp_customize->add_control('custom_category_control', array(
        'type'     => 'select',
        'choices'  => $cat_posts,
        'label'    => __('Select a category', 'viral-news-center'),
        'section'  => 'viral_news_center_latest_news',
        'settings' => 'viral_news_center_news_category_2',
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_news_cat_setting', array(
        'sanitize_callback' => 'Viral_News_Center_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Viral_News_Center_Customize_Pro_Version ( $wp_customize,'pro_version_news_cat_setting', array(
        'section'     => 'viral_news_center_latest_news',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'viral-news-center' ),
        'description' => esc_url( MAGAZINE_EXPRESS_URL ),
        'priority'    => 100
    )));


}
add_action('customize_register', 'viral_news_center_customize_register');

if ( ! function_exists( 'viral_news_center_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function viral_news_center_setup() {

        add_theme_support( 'responsive-embeds' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        add_image_size('viral-news-center-featured-header-image', 2000, 660, true);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'magazine_express_custom_background_args', array(
            'default-color' => '',
            'default-image' => '',
        ) ) );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 50,
            'width'       => 50,
            'flex-width'  => true,
        ) );

        add_editor_style( array( '/editor-style.css' ) );

        add_theme_support( 'align-wide' );

        add_theme_support( 'wp-block-styles' );
    }
endif;
add_action( 'after_setup_theme', 'viral_news_center_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function viral_news_center_widgets_init() {
        register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'viral-news-center' ),
        'id'            => 'sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'viral-news-center' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ) );
}
add_action( 'widgets_init', 'viral_news_center_widgets_init' );

function viral_news_center_remove_customize_register() {
    global $wp_customize;
    $wp_customize->remove_section( 'magazine_express_color_option' );
    $wp_customize->remove_section( 'magazine_express_top_slider' );
}

add_action( 'customize_register', 'viral_news_center_remove_customize_register', 11 );
