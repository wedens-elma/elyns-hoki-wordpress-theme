<?php
/**
 * Elyns Hoki Theme Functions
 *
 * @package elyns-hoki
 * @version 1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'ELYNS_VERSION', '1.1.0' );
define( 'ELYNS_DIR', get_template_directory() );
define( 'ELYNS_URI', get_template_directory_uri() );

/* ============================================================
   THEME SETUP
   ============================================================ */
function elyns_theme_setup() {
    $GLOBALS['content_width'] = 1200;

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form','comment-form','comment-list','gallery','caption','style','script' ] );
    add_theme_support( 'custom-logo', [
        'height'      => 80,
        'width'       => 220,
        'flex-height' => true,
        'flex-width'  => true,
    ] );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'elyns-hoki' ),
        'footer'  => __( 'Footer Navigation', 'elyns-hoki' ),
    ] );

    add_image_size( 'product-card', 600, 440, true );
    add_image_size( 'product-hero', 900, 675, true );
    add_image_size( 'gallery-thumb', 600, 450, true );
    add_image_size( 'hero-bg', 1920, 1080, true );
}
add_action( 'after_setup_theme', 'elyns_theme_setup' );

/* ============================================================
   ENQUEUE ASSETS
   ============================================================ */
function elyns_enqueue_assets() {
    wp_enqueue_style(
        'elyns-fonts',
        'https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap',
        [],
        null
    );

    wp_enqueue_style( 'elyns-style', get_stylesheet_uri(), [ 'elyns-fonts' ], ELYNS_VERSION );
    wp_enqueue_script( 'elyns-main', ELYNS_URI . '/assets/js/main.js', [], ELYNS_VERSION, true );

    wp_localize_script( 'elyns-main', 'elynsSiteData', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'elyns_nonce' ),
        'homeUrl' => home_url(),
    ] );

    if ( is_page_template( 'page-contact.php' ) || is_page( 'contact' ) ) {
        wp_enqueue_script( 'elyns-contact', ELYNS_URI . '/assets/js/contact.js', [ 'elyns-main' ], ELYNS_VERSION, true );
    }
}
add_action( 'wp_enqueue_scripts', 'elyns_enqueue_assets' );

function elyns_admin_assets( $hook ) {
    global $post;

    $screen = get_current_screen();
    $is_product = $screen && 'product' === $screen->post_type;
    $is_page    = $screen && 'page' === $screen->post_type;

    if ( ! $is_product && ! $is_page ) {
        return;
    }

    wp_enqueue_media();
    wp_enqueue_script( 'elyns-admin-media', ELYNS_URI . '/assets/js/admin-media.js', [ 'jquery' ], ELYNS_VERSION, true );
    wp_enqueue_style( 'elyns-admin-style', false, [], ELYNS_VERSION );
    wp_add_inline_style( 'elyns-admin-style', '
        .elyns-admin-gallery-preview{display:flex;gap:10px;flex-wrap:wrap;margin:12px 0}
        .elyns-admin-gallery-preview .elyns-admin-thumb{width:84px;height:84px;border:1px solid #dcdcde;border-radius:6px;overflow:hidden;background:#f6f7f7;display:flex;align-items:center;justify-content:center}
        .elyns-admin-gallery-preview img{width:100%;height:100%;object-fit:cover;display:block}
        .elyns-admin-help{color:#646970;font-size:12px;margin-top:6px}
    ' );
}
add_action( 'admin_enqueue_scripts', 'elyns_admin_assets' );

/* ============================================================
   CUSTOM POST TYPE AND TAXONOMY: PRODUCTS
   ============================================================ */
function elyns_register_product_cpt() {
    $labels = [
        'name'                  => _x( 'Products', 'Post Type General Name', 'elyns-hoki' ),
        'singular_name'         => _x( 'Product', 'Post Type Singular Name', 'elyns-hoki' ),
        'menu_name'             => __( 'Products', 'elyns-hoki' ),
        'name_admin_bar'        => __( 'Product', 'elyns-hoki' ),
        'add_new'               => __( 'Add New Product', 'elyns-hoki' ),
        'add_new_item'          => __( 'Add New Product', 'elyns-hoki' ),
        'new_item'              => __( 'New Product', 'elyns-hoki' ),
        'edit_item'             => __( 'Edit Product', 'elyns-hoki' ),
        'view_item'             => __( 'View Product', 'elyns-hoki' ),
        'all_items'             => __( 'All Products', 'elyns-hoki' ),
        'search_items'          => __( 'Search Products', 'elyns-hoki' ),
        'not_found'             => __( 'No products found.', 'elyns-hoki' ),
        'not_found_in_trash'    => __( 'No products found in Trash.', 'elyns-hoki' ),
        'featured_image'        => __( 'Product Image', 'elyns-hoki' ),
        'set_featured_image'    => __( 'Set product image', 'elyns-hoki' ),
        'remove_featured_image' => __( 'Remove product image', 'elyns-hoki' ),
        'use_featured_image'    => __( 'Use as product image', 'elyns-hoki' ),
    ];

    register_post_type( 'product', [
        'label'               => __( 'Product', 'elyns-hoki' ),
        'labels'              => $labels,
        'supports'            => [ 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'page-attributes' ],
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-carrot',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'rewrite'             => [ 'slug' => 'products', 'with_front' => false ],
        'capability_type'     => 'post',
        'show_in_rest'        => true,
    ] );

    register_taxonomy( 'product_category', [ 'product' ], [
        'labels' => [
            'name'          => __( 'Product Categories', 'elyns-hoki' ),
            'singular_name' => __( 'Product Category', 'elyns-hoki' ),
            'search_items'  => __( 'Search Product Categories', 'elyns-hoki' ),
            'all_items'     => __( 'All Product Categories', 'elyns-hoki' ),
            'edit_item'     => __( 'Edit Product Category', 'elyns-hoki' ),
            'update_item'   => __( 'Update Product Category', 'elyns-hoki' ),
            'add_new_item'  => __( 'Add New Product Category', 'elyns-hoki' ),
            'menu_name'     => __( 'Categories', 'elyns-hoki' ),
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => [ 'slug' => 'product-category' ],
    ] );
}
add_action( 'init', 'elyns_register_product_cpt', 0 );

/* ============================================================
   PRODUCT CUSTOM FIELDS
   ============================================================ */
function elyns_add_product_meta_boxes() {
    add_meta_box(
        'elyns_product_details',
        __( 'Product Details', 'elyns-hoki' ),
        'elyns_render_product_meta_box',
        'product',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'elyns_add_product_meta_boxes' );

function elyns_render_product_meta_box( $post ) {
    wp_nonce_field( 'elyns_product_save', 'elyns_product_nonce' );

    $fields = [
        '_product_short_desc'    => [ 'label' => 'Short Description', 'help' => 'Shown on product cards and archive pages.', 'type' => 'textarea', 'rows' => 3 ],
        '_product_applications'  => [ 'label' => 'Applications / Common Uses', 'help' => 'One item per line.', 'type' => 'textarea', 'rows' => 4 ],
        '_product_qualities'     => [ 'label' => 'Key Qualities', 'help' => 'One item per line, shown as tags.', 'type' => 'textarea', 'rows' => 4 ],
        '_product_full_desc'     => [ 'label' => 'Full Description', 'help' => 'Shown on product detail page. If empty, the main editor content is used.', 'type' => 'textarea', 'rows' => 5 ],
        '_product_spec_note'     => [ 'label' => 'Specification Note', 'type' => 'textarea', 'rows' => 3, 'placeholder' => 'Detailed specifications, packaging, and availability can be discussed based on buyer requirements.' ],
        '_product_cta_text'      => [ 'label' => 'CTA Button Text', 'type' => 'text', 'placeholder' => 'Inquire About This Product' ],
        '_product_cta_link'      => [ 'label' => 'CTA Button Link', 'type' => 'url', 'placeholder' => '/contact' ],
        '_product_display_order' => [ 'label' => 'Display Order', 'help' => 'Lower number appears first.', 'type' => 'number', 'placeholder' => '0' ],
    ];

    echo '<table class="form-table" style="width:100%;">';
    foreach ( $fields as $key => $field ) {
        $value = get_post_meta( $post->ID, $key, true );
        echo '<tr><th scope="row" style="width:220px;padding:12px 0;vertical-align:top;">';
        echo '<label for="' . esc_attr( $key ) . '" style="font-weight:600;">' . esc_html( $field['label'] ) . '</label>';
        if ( ! empty( $field['help'] ) ) {
            echo '<p class="elyns-admin-help">' . esc_html( $field['help'] ) . '</p>';
        }
        echo '</th><td style="padding:8px 0;">';

        if ( 'textarea' === $field['type'] ) {
            echo '<textarea id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" rows="' . (int) $field['rows'] . '" style="width:100%;font-family:inherit;" placeholder="' . esc_attr( $field['placeholder'] ?? '' ) . '">' . esc_textarea( $value ) . '</textarea>';
        } else {
            echo '<input type="' . esc_attr( $field['type'] ) . '" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '" style="width:100%;" placeholder="' . esc_attr( $field['placeholder'] ?? '' ) . '">';
        }

        echo '</td></tr>';
    }
    echo '</table>';

    $gallery_ids = get_post_meta( $post->ID, '_product_gallery', true );
    echo '<hr style="margin:18px 0;">';
    echo '<h3>' . esc_html__( 'Product Gallery Images', 'elyns-hoki' ) . '</h3>';
    echo '<p class="elyns-admin-help">Choose images from the WordPress Media Library. No attachment ID typing is needed.</p>';
    elyns_render_media_gallery_field( '_product_gallery', $gallery_ids );
}

function elyns_render_media_gallery_field( $field_name, $ids_csv = '' ) {
    $ids = elyns_sanitize_id_csv( $ids_csv );
    echo '<input type="hidden" class="elyns-media-gallery-input" id="' . esc_attr( $field_name ) . '" name="' . esc_attr( $field_name ) . '" value="' . esc_attr( $ids ) . '">';
    echo '<div class="elyns-admin-gallery-preview" data-preview-for="' . esc_attr( $field_name ) . '">';
    if ( $ids ) {
        foreach ( explode( ',', $ids ) as $id ) {
            $thumb = wp_get_attachment_image_url( absint( $id ), 'thumbnail' );
            if ( $thumb ) {
                echo '<span class="elyns-admin-thumb"><img src="' . esc_url( $thumb ) . '" alt=""></span>';
            }
        }
    }
    echo '</div>';
    echo '<button type="button" class="button elyns-select-gallery" data-target="' . esc_attr( $field_name ) . '">' . esc_html__( 'Add / Manage Images', 'elyns-hoki' ) . '</button> ';
    echo '<button type="button" class="button elyns-clear-gallery" data-target="' . esc_attr( $field_name ) . '">' . esc_html__( 'Clear Gallery', 'elyns-hoki' ) . '</button>';
}

function elyns_save_product_meta( $post_id ) {
    if ( ! isset( $_POST['elyns_product_nonce'] ) ) return;
    if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['elyns_product_nonce'] ) ), 'elyns_product_save' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $textarea_fields = [ '_product_short_desc', '_product_applications', '_product_qualities', '_product_full_desc', '_product_spec_note' ];
    foreach ( $textarea_fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) ) );
        }
    }

    if ( isset( $_POST['_product_gallery'] ) ) {
        update_post_meta( $post_id, '_product_gallery', elyns_sanitize_id_csv( wp_unslash( $_POST['_product_gallery'] ) ) );
    }

    if ( isset( $_POST['_product_cta_text'] ) ) {
        update_post_meta( $post_id, '_product_cta_text', sanitize_text_field( wp_unslash( $_POST['_product_cta_text'] ) ) );
    }

    if ( isset( $_POST['_product_cta_link'] ) ) {
        update_post_meta( $post_id, '_product_cta_link', esc_url_raw( wp_unslash( $_POST['_product_cta_link'] ) ) );
    }

    if ( isset( $_POST['_product_display_order'] ) ) {
        update_post_meta( $post_id, '_product_display_order', (string) absint( $_POST['_product_display_order'] ) );
    }
}
add_action( 'save_post_product', 'elyns_save_product_meta' );

function elyns_sanitize_id_csv( $value ) {
    $value = is_array( $value ) ? implode( ',', $value ) : (string) $value;
    $ids = array_filter( array_map( 'absint', explode( ',', $value ) ) );
    return implode( ',', array_unique( $ids ) );
}

function elyns_lines_to_array( $text ) {
    $lines = preg_split( '/\r\n|\r|\n/', (string) $text );
    $lines = array_map( 'trim', $lines );
    return array_values( array_filter( $lines ) );
}

/* ============================================================
   CUSTOMIZER SETTINGS
   ============================================================ */
function elyns_customizer_settings( $wp_customize ) {
    $wp_customize->add_section( 'elyns_contact', [
        'title'    => __( 'Contact Information', 'elyns-hoki' ),
        'priority' => 30,
    ] );

    $contact_fields = [
        'elyns_phone'           => [ 'label' => 'WhatsApp Number', 'default' => '6287845195050' ],
        'elyns_phone_display'   => [ 'label' => 'WhatsApp Display Text', 'default' => '0878 4519 5050' ],
        'elyns_email'           => [ 'label' => 'Email Address', 'default' => 'sales@elynshoki.com' ],
        'elyns_address'         => [ 'label' => 'Full Address', 'type' => 'textarea', 'default' => 'GRIYA AIRA TANDEAN BLOK E 11, JL. K F TANDEAN BANDAR UTAMA, TEBING TINGGI, SUMUT 20613' ],
        'elyns_map_embed'       => [ 'label' => 'Google Maps Embed URL', 'type' => 'textarea', 'default' => '' ],
        'elyns_inquiry_intro'   => [ 'label' => 'Inquiry Form Intro Text', 'type' => 'textarea', 'default' => 'Tell us your product needs and our team will get back to you with suitable information.' ],
    ];

    foreach ( $contact_fields as $id => $args ) {
        $sanitize = in_array( $id, [ 'elyns_email' ], true ) ? 'sanitize_email' : 'wp_kses_post';
        $wp_customize->add_setting( $id, [ 'default' => $args['default'], 'sanitize_callback' => $sanitize ] );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, $id, [
            'label'   => __( $args['label'], 'elyns-hoki' ),
            'section' => 'elyns_contact',
            'type'    => $args['type'] ?? 'text',
        ] ) );
    }

    $wp_customize->add_section( 'elyns_hero', [
        'title'    => __( 'Homepage Hero', 'elyns-hoki' ),
        'priority' => 20,
    ] );

    $hero_fields = [
        'elyns_hero_badge'      => [ 'label' => 'Hero Badge Text', 'default' => 'Indonesian Agricultural Commodity Exporter' ],
        'elyns_hero_headline'   => [ 'label' => 'Hero Headline', 'type' => 'textarea', 'default' => 'Supplying Indonesian Agricultural Commodities to Global Markets' ],
        'elyns_hero_desc'       => [ 'label' => 'Hero Supporting Text', 'type' => 'textarea', 'default' => 'PT. ELYNS HOLONG KOMODITI supplies selected agricultural commodities for business partners across the global market.' ],
        'elyns_hero_cta1_text'  => [ 'label' => 'Primary CTA Text', 'default' => 'View Our Products' ],
        'elyns_hero_cta1_link'  => [ 'label' => 'Primary CTA Link', 'default' => '/products' ],
        'elyns_hero_cta2_text'  => [ 'label' => 'Secondary CTA Text', 'default' => 'Contact Us' ],
        'elyns_hero_cta2_link'  => [ 'label' => 'Secondary CTA Link', 'default' => '/contact' ],
    ];

    foreach ( $hero_fields as $id => $args ) {
        $wp_customize->add_setting( $id, [ 'default' => $args['default'], 'sanitize_callback' => 'wp_kses_post' ] );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, $id, [
            'label'   => __( $args['label'], 'elyns-hoki' ),
            'section' => 'elyns_hero',
            'type'    => $args['type'] ?? 'text',
        ] ) );
    }

    $wp_customize->add_setting( 'elyns_hero_image', [ 'sanitize_callback' => 'absint' ] );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'elyns_hero_image', [
        'label'     => __( 'Hero Background Image', 'elyns-hoki' ),
        'section'   => 'elyns_hero',
        'mime_type' => 'image',
    ] ) );

    $wp_customize->add_section( 'elyns_cta', [
        'title'    => __( 'Final CTA Section', 'elyns-hoki' ),
        'priority' => 35,
    ] );

    $cta_fields = [
        'elyns_cta_title'    => [ 'label' => 'CTA Title', 'type' => 'textarea', 'default' => 'Looking for Reliable Indonesian Agricultural Commodities?' ],
        'elyns_cta_desc'     => [ 'label' => 'CTA Description', 'type' => 'textarea', 'default' => 'Tell us your product requirements and our team will help you explore suitable supply options.' ],
        'elyns_cta_btn_text' => [ 'label' => 'CTA Button Text', 'default' => 'Contact Us Today' ],
        'elyns_cta_btn_link' => [ 'label' => 'CTA Button Link', 'default' => '/contact' ],
    ];

    foreach ( $cta_fields as $id => $args ) {
        $wp_customize->add_setting( $id, [ 'default' => $args['default'], 'sanitize_callback' => 'wp_kses_post' ] );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, $id, [
            'label'   => __( $args['label'], 'elyns-hoki' ),
            'section' => 'elyns_cta',
            'type'    => $args['type'] ?? 'text',
        ] ) );
    }

    $wp_customize->add_section( 'elyns_footer', [
        'title'    => __( 'Footer Settings', 'elyns-hoki' ),
        'priority' => 40,
    ] );

    $wp_customize->add_setting( 'elyns_footer_desc', [
        'default'           => 'PT. ELYNS HOLONG KOMODITI supplies selected Indonesian agricultural commodities for business and export needs.',
        'sanitize_callback' => 'wp_kses_post',
    ] );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'elyns_footer_desc', [
        'label'   => __( 'Footer Company Description', 'elyns-hoki' ),
        'section' => 'elyns_footer',
        'type'    => 'textarea',
    ] ) );

    $wp_customize->add_setting( 'elyns_footer_copyright', [
        'default'           => 'Copyright &copy; ' . date( 'Y' ) . ' PT. ELYNS HOLONG KOMODITI. All rights reserved.',
        'sanitize_callback' => 'wp_kses_post',
    ] );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'elyns_footer_copyright', [
        'label'   => __( 'Copyright Text', 'elyns-hoki' ),
        'section' => 'elyns_footer',
        'type'    => 'text',
    ] ) );
}
add_action( 'customize_register', 'elyns_customizer_settings' );

function elyns_get( $key, $fallback = '' ) {
    return get_theme_mod( $key, $fallback ) ?: $fallback;
}

/* ============================================================
   WIDGET AREAS
   ============================================================ */
function elyns_register_sidebars() {
    register_sidebar( [
        'name'          => __( 'Product Sidebar', 'elyns-hoki' ),
        'id'            => 'product-sidebar',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ] );
}
add_action( 'widgets_init', 'elyns_register_sidebars' );

/* ============================================================
   QUERY HELPERS
   ============================================================ */
function elyns_get_products( $limit = -1, $orderby = 'meta_value_num', $meta_key = '_product_display_order', $exclude = [] ) {
    $args = [
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => $limit,
        'orderby'        => $orderby,
        'order'          => 'ASC',
        'post__not_in'   => $exclude,
    ];

    if ( 'meta_value_num' === $orderby ) {
        $args['meta_key'] = $meta_key;
        $args['orderby']  = [ 'meta_value_num' => 'ASC', 'date' => 'DESC' ];
    }

    return new WP_Query( $args );
}

function elyns_get_whatsapp_url( $message = 'Hello, I would like to inquire about your agricultural products.' ) {
    $number = preg_replace( '/\D/', '', elyns_get( 'elyns_phone', '6287845195050' ) );
    return 'https://wa.me/' . $number . '?text=' . rawurlencode( $message );
}

/* ============================================================
   CONTACT FORM AJAX HANDLER
   ============================================================ */
function elyns_contact_form_handler() {
    check_ajax_referer( 'elyns_nonce', 'nonce' );

    $name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
    $email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
    $company = sanitize_text_field( wp_unslash( $_POST['company'] ?? '' ) );
    $phone   = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
    $product = sanitize_text_field( wp_unslash( $_POST['product'] ?? '' ) );
    $qty     = sanitize_text_field( wp_unslash( $_POST['quantity'] ?? '' ) );
    $dest    = sanitize_text_field( wp_unslash( $_POST['destination'] ?? '' ) );
    $message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

    if ( empty( $name ) || empty( $email ) || ! is_email( $email ) ) {
        wp_send_json_error( [ 'message' => 'Please provide a valid name and email.' ] );
    }

    $to      = elyns_get( 'elyns_email', 'sales@elynshoki.com' );
    $subject = 'New Product Inquiry from ' . $name;
    $body    = "Name: $name\nCompany: $company\nEmail: $email\nPhone or WhatsApp: $phone\n\nProduct Interest: $product\nEstimated Quantity: $qty\nDestination: $dest\n\nMessage:\n$message";
    $headers = [ 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $email ];

    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( [ 'message' => 'Your inquiry has been sent. We will get back to you shortly.' ] );
    }

    wp_send_json_error( [ 'message' => 'Message could not be sent. Please try WhatsApp or email us directly.' ] );
}
add_action( 'wp_ajax_elyns_contact', 'elyns_contact_form_handler' );
add_action( 'wp_ajax_nopriv_elyns_contact', 'elyns_contact_form_handler' );

/* ============================================================
   SEO HELPERS
   ============================================================ */
function elyns_meta_description() {
    if ( is_singular( 'product' ) ) {
        $desc = get_post_meta( get_the_ID(), '_product_short_desc', true );
        if ( ! $desc ) $desc = get_the_excerpt();
        if ( $desc ) {
            echo '<meta name="description" content="' . esc_attr( wp_strip_all_tags( $desc ) ) . '">' . "\n";
        }
    }
}
add_action( 'wp_head', 'elyns_meta_description' );

/* ============================================================
   SEED DEFAULT EDITABLE CONTENT
   ============================================================ */
function elyns_seed_default_pages() {
    $pages = [
        'home' => [ 'title' => 'Home', 'template' => '', 'content' => '' ],
        'about' => [ 'title' => 'About Us', 'template' => 'page-about.php', 'content' => '' ],
        'products' => [ 'title' => 'Products', 'template' => 'page-products.php', 'content' => 'Browse our range of selected Indonesian agricultural commodities for B2B supply, export, and distribution needs.' ],
        'quality-sustainability' => [ 'title' => 'Quality & Sustainability', 'template' => 'page-quality-sustainability.php', 'content' => '' ],
        'gallery' => [ 'title' => 'Gallery', 'template' => 'page-gallery.php', 'content' => '' ],
        'contact' => [ 'title' => 'Contact', 'template' => 'page-contact.php', 'content' => '' ],
    ];

    $created_ids = [];
    foreach ( $pages as $slug => $page ) {
        $existing = get_page_by_path( $slug );
        if ( $existing ) {
            $page_id = $existing->ID;
        } else {
            $page_id = wp_insert_post( [
                'post_title'   => $page['title'],
                'post_name'    => $slug,
                'post_type'    => 'page',
                'post_status'  => 'publish',
                'post_content' => $page['content'],
            ] );
        }

        if ( $page_id && ! is_wp_error( $page_id ) && ! empty( $page['template'] ) ) {
            update_post_meta( $page_id, '_wp_page_template', $page['template'] );
        }
        $created_ids[ $slug ] = $page_id;
    }

    if ( ! empty( $created_ids['home'] ) ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $created_ids['home'] );
    }
}

function elyns_seed_default_products() {
    if ( get_option( 'elyns_seeded_default_products' ) ) {
        return;
    }

    $products = [
        [
            'title' => 'Banana Leaf',
            'order' => 1,
            'short' => 'Natural, versatile leaves commonly used for culinary wrapping, food presentation, and traditional cooking needs.',
            'full' => 'Our banana leaves are selected for their natural appearance, freshness, and versatility. They are commonly used in traditional and modern culinary applications as natural wrappers, serving bases, or presentation materials.',
            'applications' => "Food wrapping\nFood presentation\nTraditional cooking\nServing base",
            'qualities' => "Natural food presentation\nTraditional culinary use\nVersatile application\nPlant-based material",
        ],
        [
            'title' => 'Banana Stem',
            'order' => 2,
            'short' => 'A useful agricultural material with potential applications in food, craft, cultural, and sustainable material use.',
            'full' => 'Banana stems are valued for their strong natural structure and practical uses across local applications. They can be used in culinary, craft, cultural, and sustainable material contexts depending on buyer requirements.',
            'applications' => "Culinary use\nCraft material\nCultural use\nSustainable material contexts",
            'qualities' => "Natural agricultural material\nVersatile use\nLocally sourced\nSupports responsible resource utilization",
        ],
        [
            'title' => 'Areca Nuts',
            'order' => 3,
            'short' => 'Selected areca nuts prepared for commodity supply and trading partner needs.',
            'full' => 'Our areca nuts are carefully selected to support business and traditional market needs. With attention to sourcing and product condition, we aim to provide dependable areca nut supply for buyers and trading partners.',
            'applications' => "Commodity supply\nTraditional market needs\nTrading partner supply",
            'qualities' => "Selected commodity product\nTraditional and commercial relevance\nSourcing-focused supply\nExport-oriented availability",
        ],
        [
            'title' => 'Turmeric',
            'order' => 4,
            'short' => 'Natural spice with culinary, herbal, and food ingredient applications.',
            'full' => 'Our turmeric is a natural spice known for its distinctive color, aroma, and culinary value. It is suitable for food ingredient needs, traditional recipes, and broader spice-based applications.',
            'applications' => "Food ingredients\nTraditional recipes\nSpice-based applications\nHerbal preparation needs",
            'qualities' => "Natural spice product\nDistinctive color and aroma\nCulinary and ingredient use\nSelected agricultural sourcing",
        ],
        [
            'title' => 'Ginger',
            'order' => 5,
            'short' => 'Natural spice commonly used in food, beverages, and herbal preparations.',
            'full' => 'Our ginger is selected for its natural aroma, warming taste, and broad use in food and beverage applications. It supports both traditional and modern product needs.',
            'applications' => "Food applications\nBeverage applications\nTraditional recipes\nHerbal preparations",
            'qualities' => "Natural spice product\nFood and beverage application\nTraditional and modern use\nSelected quality",
        ],
        [
            'title' => 'Coffee',
            'order' => 6,
            'short' => 'Selected coffee commodity from Indonesian agricultural supply networks.',
            'full' => 'Our coffee products are sourced from agricultural supply networks with attention to taste, product condition, and consistency. They are suitable for buyers seeking Indonesian coffee commodities for business use.',
            'applications' => "Beverage industry supply\nCoffee trading\nB2B commodity needs\nFood service supply",
            'qualities' => "Indonesian coffee commodity\nSelected beans\nBeverage industry relevance\nB2B supply potential",
        ],
        [
            'title' => 'Lemongrass',
            'order' => 7,
            'short' => 'Natural herb used for culinary, beverage, and aromatic applications.',
            'full' => 'Our lemongrass is selected for its fresh aroma and versatile use in culinary, beverage, and herbal applications. It is suitable for traditional recipes as well as modern food and drink creations.',
            'applications' => "Culinary use\nBeverage use\nHerbal applications\nAromatic ingredient needs",
            'qualities' => "Fresh herbal product\nAromatic ingredient\nCulinary and beverage use\nNatural agricultural sourcing",
        ],
    ];

    foreach ( $products as $product ) {
        $existing = get_page_by_path( sanitize_title( $product['title'] ), OBJECT, 'product' );
        if ( $existing ) {
            continue;
        }

        $post_id = wp_insert_post( [
            'post_title'   => $product['title'],
            'post_name'    => sanitize_title( $product['title'] ),
            'post_type'    => 'product',
            'post_status'  => 'publish',
            'post_excerpt' => $product['short'],
            'post_content' => $product['full'],
            'menu_order'   => $product['order'],
        ] );

        if ( $post_id && ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, '_product_short_desc', $product['short'] );
            update_post_meta( $post_id, '_product_full_desc', $product['full'] );
            update_post_meta( $post_id, '_product_applications', $product['applications'] );
            update_post_meta( $post_id, '_product_qualities', $product['qualities'] );
            update_post_meta( $post_id, '_product_spec_note', 'Detailed specifications, packaging, and availability can be discussed based on buyer requirements.' );
            update_post_meta( $post_id, '_product_cta_text', 'Inquire About This Product' );
            update_post_meta( $post_id, '_product_cta_link', home_url( '/contact' ) );
            update_post_meta( $post_id, '_product_display_order', (string) $product['order'] );
            wp_set_object_terms( $post_id, 'Agricultural Commodities', 'product_category', false );
        }
    }

    update_option( 'elyns_seeded_default_products', 1 );
}

function elyns_activation() {
    elyns_register_product_cpt();
    elyns_seed_default_pages();
    elyns_seed_default_products();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'elyns_activation' );

/* ============================================================
   BODY CLASSES AND EXCERPT
   ============================================================ */
function elyns_body_classes( $classes ) {
    if ( is_singular() ) $classes[] = 'singular';
    if ( is_singular( 'product' ) ) $classes[] = 'single-product-page';
    return $classes;
}
add_filter( 'body_class', 'elyns_body_classes' );

function elyns_excerpt_length( $length ) {
    return is_admin() ? $length : 20;
}
add_filter( 'excerpt_length', 'elyns_excerpt_length' );

/* ============================================================
   INCLUDE PARTIALS
   ============================================================ */
require_once ELYNS_DIR . '/inc/gallery-meta.php';

/* ============================================================
   ADMIN NOTICE
   ============================================================ */
function elyns_admin_welcome_notice() {
    $screen = get_current_screen();
    if ( $screen && 'dashboard' === $screen->id ) :
    ?>
    <div class="notice notice-info is-dismissible">
        <p><strong>🌿 Elyns Hoki Theme</strong> is active.
        <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=product' ) ); ?>">Manage products</a> |
        <a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>">Edit site settings</a> |
        <a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>">Edit menus</a>
        </p>
    </div>
    <?php
    endif;
}
add_action( 'admin_notices', 'elyns_admin_welcome_notice' );
