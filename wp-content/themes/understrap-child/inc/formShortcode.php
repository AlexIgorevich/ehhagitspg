<?php

add_shortcode('new_form', 'new_object_form');

function new_object_form($args)
{
    if (!class_exists('ACF')) {
        return 'ACF plugin required';
    }

    ob_start();

    get_template_part("templates/shortcodes/form", null, $args);

    return ob_get_clean();
}

add_action('wp_enqueue_scripts', 're_form_ajax', 99);
function re_form_ajax()
{
    wp_localize_script('child-understrap-scripts', 'ajaxData',
        [
            'url' => admin_url('admin-ajax.php'),
            'error' => __('Произошла ошибка, попробуйте позже', 'understrap'),
            'file_error' => __('Файл слишком большой, максимальный размер 5Mb', 'understrap')
        ]
    );

}

if (wp_doing_ajax()) {
    add_action('wp_ajax_re_add_new_object', 're_add_new_object');
    add_action('wp_ajax_nopriv_re_add_new_object', 're_add_new_object');
}
function re_add_new_object()
{
    if (!wp_verify_nonce($_POST['_wpnonce'], 're_form_nonce')) {
        wp_send_json_error();
    }

    $name = trim(sanitize_text_field($_POST['name']));
    $address = trim(sanitize_text_field($_POST['address']));
    $type = intval(trim(sanitize_text_field($_POST['type'])));
    $city = intval(trim(sanitize_text_field($_POST['city'])));
    $square = intval(trim(sanitize_text_field($_POST['square'])));
    $living_space = intval(trim(sanitize_text_field($_POST['living_space'])));
    $floor = intval(trim(sanitize_text_field($_POST['floor'])));
    $price = intval(trim(sanitize_text_field($_POST['price'])));

    $attachment_id = 0;

    if (empty($name) || empty($address) || empty($type) || empty($city) || empty($square) || empty($price)) {
        wp_send_json_error();
    }

    require_once( ABSPATH . 'wp-admin/includes/admin.php' );
    $file_return = wp_handle_upload( $_FILES['image'], ['test_form' => false]);
    if( isset( $file_return['error'] ) || isset( $file_return['upload_error_handler'] ) ) {
        wp_send_json_error();
    } else {
        $filename = $file_return['file'];
        $attachment = [
            'post_mime_type' => $file_return['type'],
            'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
            'post_content' => '',
            'post_status' => 'inherit',
            'guid' => $file_return['url'],

        ];
        $attachment_id = wp_insert_attachment( $attachment, $file_return['url'] );
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
        wp_update_attachment_metadata( $attachment_id, $attachment_data );
    }

    $post_data = array(
        'post_title'    => $name,
        'post_status'   => 'draft',
        'post_author'   => 1,
        'post_parent' => $city,
        'post_type' => 'real_estate',
    );

    $post_id = wp_insert_post( $post_data );

    if( is_wp_error($post_id) ){
        wp_send_json_error();
    }
    else {
        wp_set_object_terms( $post_id, $type, 'estate_taxonomy' );
        update_field('square', $square, $post_id);
        update_field('address', $address, $post_id);
        update_field('price', $price, $post_id);
        update_field('living_space', $living_space, $post_id);
        update_field('floor', $floor, $post_id);
        if( 0 < intval( $attachment_id ) ) {
            set_post_thumbnail( $post_id, $attachment_id );
        }
        wp_send_json_success();
    }

}