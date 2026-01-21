<?php
/**
 * Custom Post Types Registration
 *
 * Project: Dzherela Hels
 * Registered CPTs:
 * 1. Services (Послуги) -> Items: Service (Послуга)
 *    - Custom Taxonomy: service_category (Категорії послуг)
 *    - Custom Taxonomy: service_tag (Теги послуг)
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Register Custom Taxonomies for Services
 */
function dzherela_hels_register_taxonomies()
{
    // ============================================
    // Service Categories (Категорії послуг)
    // ============================================
    $labels_service_category = array(
        'name' => _x('Категорії послуг', 'Taxonomy General Name', 'dzherela-hels'),
        'singular_name' => _x('Категорія послуги', 'Taxonomy Singular Name', 'dzherela-hels'),
        'menu_name' => __('Категорії', 'dzherela-hels'),
        'all_items' => __('Всі категорії', 'dzherela-hels'),
        'parent_item' => __('Батьківська категорія', 'dzherela-hels'),
        'parent_item_colon' => __('Батьківська категорія:', 'dzherela-hels'),
        'new_item_name' => __('Нова категорія', 'dzherela-hels'),
        'add_new_item' => __('Додати категорію', 'dzherela-hels'),
        'edit_item' => __('Редагувати категорію', 'dzherela-hels'),
        'update_item' => __('Оновити категорію', 'dzherela-hels'),
        'view_item' => __('Переглянути категорію', 'dzherela-hels'),
        'search_items' => __('Пошук категорій', 'dzherela-hels'),
        'not_found' => __('Категорій не знайдено', 'dzherela-hels'),
    );

    $args_service_category = array(
        'labels' => $labels_service_category,
        'hierarchical' => true, // Like categories
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => false,
        'rewrite' => array('slug' => 'service-category', 'with_front' => false),
        'show_in_rest' => false,
    );

    register_taxonomy('service_category', array('services'), $args_service_category);

    // ============================================
    // Service Tags (Теги послуг)
    // ============================================
    $labels_service_tag = array(
        'name' => _x('Теги послуг', 'Taxonomy General Name', 'dzherela-hels'),
        'singular_name' => _x('Тег послуги', 'Taxonomy Singular Name', 'dzherela-hels'),
        'menu_name' => __('Теги', 'dzherela-hels'),
        'all_items' => __('Всі теги', 'dzherela-hels'),
        'new_item_name' => __('Новий тег', 'dzherela-hels'),
        'add_new_item' => __('Додати тег', 'dzherela-hels'),
        'edit_item' => __('Редагувати тег', 'dzherela-hels'),
        'update_item' => __('Оновити тег', 'dzherela-hels'),
        'view_item' => __('Переглянути тег', 'dzherela-hels'),
        'search_items' => __('Пошук тегів', 'dzherela-hels'),
        'not_found' => __('Тегів не знайдено', 'dzherela-hels'),
        'popular_items' => __('Популярні теги', 'dzherela-hels'),
    );

    $args_service_tag = array(
        'labels' => $labels_service_tag,
        'hierarchical' => false, // Like tags
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => array('slug' => 'service-tag', 'with_front' => false),
        'show_in_rest' => false,
    );

    register_taxonomy('service_tag', array('services'), $args_service_tag);
}

add_action('init', 'dzherela_hels_register_taxonomies', 0);

/**
 * Register all Custom Post Types
 */
function dzherela_hels_register_cpts()
{
    // ============================================
    // 1. Services (Послуги)
    // ============================================
    $labels_services = array(
        'name' => _x('Послуги', 'Post Type General Name', 'dzherela-hels'),
        'singular_name' => _x('Послуга', 'Post Type Singular Name', 'dzherela-hels'),
        'menu_name' => __('Послуги', 'dzherela-hels'),
        'name_admin_bar' => __('Послуга', 'dzherela-hels'),
        'add_new' => __('Додати', 'dzherela-hels'),
        'add_new_item' => __('Додати нову послугу', 'dzherela-hels'),
        'new_item' => __('Нова послуга', 'dzherela-hels'),
        'edit_item' => __('Редагувати послугу', 'dzherela-hels'),
        'view_item' => __('Переглянути послугу', 'dzherela-hels'),
        'all_items' => __('Всі послуги', 'dzherela-hels'),
        'search_items' => __('Пошук послуг', 'dzherela-hels'),
        'not_found' => __('Послуг не знайдено', 'dzherela-hels'),
        'not_found_in_trash' => __('Послуг не знайдено у кошику', 'dzherela-hels'),
        'featured_image' => __('Зображення послуги', 'dzherela-hels'),
        'set_featured_image' => __('Встановити зображення', 'dzherela-hels'),
        'remove_featured_image' => __('Видалити зображення', 'dzherela-hels'),
        'archives' => __('Архів послуг', 'dzherela-hels'),
    );

    $args_services = array(
        'label' => __('Послуги', 'dzherela-hels'),
        'description' => __('Медичні послуги центру', 'dzherela-hels'),
        'labels' => $labels_services,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'),
        'taxonomies' => array('service_category', 'service_tag'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-heart',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'services', 'with_front' => false),
        'show_in_rest' => false, // Classic Editor / ACF
    );

    register_post_type('services', $args_services);
}

add_action('init', 'dzherela_hels_register_cpts');

/**
 * Flush rewrite rules on theme switch
 */
add_action('after_switch_theme', function () {
    dzherela_hels_register_taxonomies();
    dzherela_hels_register_cpts();
    flush_rewrite_rules();
});
