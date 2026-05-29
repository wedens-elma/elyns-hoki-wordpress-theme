<?php
/**
 * Gallery Page Meta Box
 * Allows the owner to manage gallery images from the WordPress page editor.
 *
 * @package elyns-hoki
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function elyns_add_gallery_meta_box() {
    add_meta_box(
        'elyns_page_gallery',
        __( 'Page Gallery Images', 'elyns-hoki' ),
        'elyns_render_gallery_meta_box',
        'page',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'elyns_add_gallery_meta_box' );

function elyns_render_gallery_meta_box( $post ) {
    wp_nonce_field( 'elyns_gallery_save', 'elyns_gallery_nonce' );
    $ids = get_post_meta( $post->ID, '_page_gallery_ids', true );
    ?>
    <p class="elyns-admin-help">
        Use this field for the Gallery page and homepage gallery preview. Choose images directly from the WordPress Media Library.
    </p>
    <?php elyns_render_media_gallery_field( '_page_gallery_ids', $ids ); ?>
    <?php
}

function elyns_save_gallery_meta( $post_id ) {
    if ( ! isset( $_POST['elyns_gallery_nonce'] ) ) return;
    if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['elyns_gallery_nonce'] ) ), 'elyns_gallery_save' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['_page_gallery_ids'] ) ) {
        update_post_meta( $post_id, '_page_gallery_ids', elyns_sanitize_id_csv( wp_unslash( $_POST['_page_gallery_ids'] ) ) );
    }
}
add_action( 'save_post_page', 'elyns_save_gallery_meta' );
