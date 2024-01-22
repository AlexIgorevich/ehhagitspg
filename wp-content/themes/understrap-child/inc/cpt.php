<?php
add_action('init', 'register_post_types_and_taxonomies');

function register_post_types_and_taxonomies()
{

    //Taxonomy for Real estate CPT

    register_taxonomy('estate_taxonomy', ['real_estate'], [
        'label' => '',
        'labels' => [
            'name' => esc_html__('Типы недвижимости','understrap'),
            'singular_name' => esc_html__('Тип недвижимости','understrap'),
            'search_items' => esc_html__('Поиск','understrap'),
            'all_items' => esc_html__('Все типы недвижимости','understrap'),
            'view_item ' => esc_html__('Показать','understrap'),
            'edit_item' => esc_html__('Редактировать','understrap'),
            'update_item' => esc_html__('Обновить','understrap'),
            'add_new_item' => esc_html__('Добавить новый тип недвижимости','understrap'),
            'new_item_name' => esc_html__('Новое название','understrap'),
            'menu_name' => esc_html__('Типы недвижимости','understrap'),
            'back_to_items' => esc_html__('Назад к типам недвижимости','understrap'),
        ],
        'description' => '',
        'public' => true,
        'hierarchical' => false,
        'rewrite' => true,
    ]);

    //Real estate CPT

    register_post_type('real_estate', [
        'label' => null,
        'labels' => [
            'name' => esc_html__('Объект недвижимости','understrap'),
            'singular_name' => esc_html__('Объект недвижимости','understrap'),
            'add_new' => esc_html__('Добавить объект недвижимости','understrap'),
            'add_new_item' => esc_html__('Добавление объекта недвижимости','understrap'),
            'edit_item' => esc_html__('Редактирование объекта недвижимости','understrap'),
            'new_item' => esc_html__('Новый объект недвижимости','understrap'),
            'view_item' => esc_html__('Смотреть объект недвижимости','understrap'),
            'search_items' => esc_html__('Поиск','understrap'),
            'not_found' => esc_html__('Ничего не найдено','understrap'),
            'not_found_in_trash' => esc_html__('Не найдено в корзине','understrap'),
            'menu_name' => esc_html__('Объекты недвижимости','understrap'),
        ],
        'description' => '',
        'public' => true,
        'show_in_menu' => null,
        'show_in_rest' => null,
        'rest_base' => null,
        'menu_position' => null,
        'menu_icon' => 'dashicons-admin-home',
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => ['title', 'editor', 'thumbnail'],
        'taxonomies' => [],
        'has_archive' => false,
        'rewrite' => true,
        'query_var' => true,
    ]);

    //City CPT

    register_post_type('city', [
        'label' => null,
        'labels' => [
            'name' => esc_html__('Город','understrap'),
            'singular_name' => esc_html__('Город','understrap'),
            'add_new' => esc_html__('Добавить город','understrap'),
            'add_new_item' => esc_html__('Добавление город','understrap'),
            'edit_item' => esc_html__('Редактирование город','understrap'),
            'new_item' => esc_html__('Новый город','understrap'),
            'view_item' => esc_html__('Смотреть город','understrap'),
            'search_items' => esc_html__('Поиск','understrap'),
            'not_found' => esc_html__('Ничего не найдено','understrap'),
            'not_found_in_trash' => esc_html__('Не найдено в корзине','understrap'),
            'menu_name' => esc_html__('Города','understrap'),
        ],
        'description' => '',
        'public' => true,
        'show_in_menu' => null,
        'show_in_rest' => null,
        'rest_base' => null,
        'menu_position' => null,
        'menu_icon' => 'dashicons-admin-multisite',
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => ['title', 'editor', 'thumbnail'],
        'taxonomies' => [],
        'has_archive' => false,
        'rewrite' => true,
        'query_var' => true,
    ]);
}