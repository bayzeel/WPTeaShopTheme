<?php

// Add scripts
function load_style_script(){
    wp_enqueue_script('modernizr-js', get_template_directory_uri() . '/js/modernizr.js', array(), null);
    /*wp_enqueue_script('jquery-google', 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');*/
    wp_enqueue_script('cs-jquery', get_template_directory_uri() . '/js/jquery-1.11.1.min.js', array(), null);
    wp_enqueue_script('flexslider-js', get_template_directory_uri() . '/js/jquery.flexslider.js', array(), null);
    wp_enqueue_script('elevatezoom-js', get_template_directory_uri() . '/js/jquery.elevatezoom.js', array(), null);
    wp_enqueue_script('magnigicpopup-js', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array(), null);
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/js/custom.js', array(), null);

    wp_enqueue_style('flexslider-style', get_template_directory_uri() . '/css/flexslider.css');
    wp_enqueue_style('magnigicpopup-style', get_template_directory_uri() . '/css/magnific-popup.css');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.css');
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
}
add_action( 'wp_enqueue_scripts', 'load_style_script' );

// Disable woocommerce pretty photo scripts
add_action( 'wp_print_scripts', 'my_deregister_javascript', 100 );

function my_deregister_javascript() {
    wp_deregister_script( 'prettyPhoto' );
    wp_deregister_script( 'prettyPhoto-init' );
}

// Disable woocommerce pretty photo style
add_action( 'wp_print_styles', 'my_deregister_styles', 100 );

function my_deregister_styles() {
    wp_deregister_style( 'woocommerce_prettyPhoto_css' );
}

// Add menus
register_nav_menus(array(
    'header_menu' => 'Menu in header',
    'footer_menu' => 'Menu in footer'
));

// Add slider
add_action('init', 'slider_index');

function slider_index(){
    register_post_type('slider', array(
        'public' => true,
        'supports' => array('title', 'thumbnail', 'custom-fields'),
        'menu_position' => 100,
        'menu_icon' => admin_url() . 'images/media-button-video.gif',
        'labels' => array(
            'name' => 'Slider',
            'all_items' => 'All slides',
            'add_new' => 'New slide',
            'add_new_item' => 'Add slide'
        )
    ));
}

// Add thumbnails support
add_theme_support('post-thumbnails');

// Remove default woocommerce style and hook current theme style
define('WOOCOMMERCE_USE_CSS', false);
add_theme_support( 'woocommerce' );

// Remove default images size
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );
function remove_width_attribute( $html ) {
    $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
    return $html;
}

// Widget in footer
register_sidebar(array(
    'name' => 'Social Networks in footer',
    'id' => 'soc-networks',
    'description' => 'Use this widget for display links for your social media accounts',
    'before_widget' => '',
    'after_widget' => ''
    )
);

// Add second WYSIWYG to product page
add_action( 'add_meta_boxes', 'product_details_add' );
add_action( 'save_post', 'product_details_save' );
function product_details_add() {
    add_meta_box( 'product_details', 'Product Details', 'product_details_call', 'product', 'normal', 'high' );
}

function product_details_call( $post ) {
    wp_nonce_field( plugin_basename( __FILE__ ), 'product_details_noncename' );
    $field_value = get_post_meta( $post->ID, 'product_details_meta', false );
    wp_editor( $field_value[0], 'product_details_meta' );
}

function product_details_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
    if ( ( isset ( $_POST['product_details_noncename'] ) ) && ( ! wp_verify_nonce( $_POST['product_details_noncename'], plugin_basename( __FILE__ ) ) ) )
        return;
    if ( ( isset ( $_POST['post_type'] ) ) && ( 'page' == $_POST['post_type'] )  ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }
    }
    else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }
    if ( isset ( $_POST['product_details_meta'] ) ) {
        update_post_meta( $post_id, 'product_details_meta', $_POST['product_details_meta'] );
    }
}
/*
function custom_woo_before_shop_link() {
    add_filter('woocommerce_loop_add_to_cart_link', 'custom_woo_loop_add_to_cart_link', 10, 2);
    add_action('woocommerce_after_shop_loop', 'custom_woo_after_shop_loop');
}
add_action('woocommerce_before_shop_loop', 'custom_woo_before_shop_link');

function custom_woo_loop_add_to_cart_link($button, $product) {
    // not for variable, grouped or external products
    if (!in_array($product->product_type, array('variable', 'grouped', 'external'))) {
        // only if can be purchased
        if ($product->is_purchasable()) {
            // show qty +/- with button
            ob_start();
            woocommerce_simple_add_to_cart();
            $button = ob_get_clean();
            // modify button so that AJAX add-to-cart script finds it
            $replacement = sprintf('data-product_id="%d" data-quantity="1" $1 add_to_cart_button product_type_simple ', $product->id);
            $button = preg_replace('/(class="single_add_to_cart_button)/', $replacement, $button);
        }
    }
    return $button;
}
*/