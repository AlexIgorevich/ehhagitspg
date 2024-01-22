<?php

add_action('re_get_fields', 're_get_fields_html', 10, 1);

function re_get_fields_html($id)
{
    $square_fields = [];
    $address = '';
    $price = '';
    $floor = '';
    $types = get_the_terms($id, 'estate_taxonomy');
    $types_output = [];

    if ($types) {
        foreach ($types as $type) {
            $types_output[] = $type->name;
        }
    }

    if ($types_output) {
        $types_output = sprintf(__('Тип: %s', 'understrap'), implode(', ', $types_output));
    }
    if (class_exists('ACF')) {
        if (get_field('address', $id)) {
            $address = sprintf(__('Адрес: %s', 'understrap'), get_field('address', $id));
        }
        if (get_field('price', $id)) {
            $price = sprintf(__('%s $', 'understrap'), get_field('price', $id));
        }
        if (get_field('floor', $id)) {
            $floor = sprintf(__('Этаж: %s', 'understrap'), get_field('floor', $id));
        }
        if (get_field('square', $id)) {
            $square_fields[] = sprintf(__('Общая площадь: %sm<sup>2</sup>', 'understrap'), get_field('square', $id));
        }
        if (get_field('living_space', $id)) {
            $square_fields[] = sprintf(__('Жилая площадь: %sm<sup>2</sup>', 'understrap'), get_field('living_space', $id));
        }
        $square_fields = implode(' / ', $square_fields);
    }

    echo $address ? "<div class='info-text'>$address</div>" : '';
    echo $types_output ? "<div class='info-text'>$types_output</div>" : '';
    echo $square_fields ? "<div class='info-text'>$square_fields</div>" : '';
    echo $floor ? "<div class='info-text'>$floor</div>" : '';
    echo $price ? "<div class='mb-2'><b>$price</b></div>" : '';
}


$my_widget = new City_Widget();

add_action( 'pre_get_posts', 'change_post_type_at_index' );

function change_post_type_at_index( $query ) {

    if( $query->is_main_query() && $query->is_home() ) {
        $query->set( 'post_type', ['real_estate']);
    }
}