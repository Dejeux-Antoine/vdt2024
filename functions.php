<?php

function vdt2024_enqueue_styles() {
    wp_enqueue_style('vdt-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'vdt2024_enqueue_styles');

function vdt2024_setup() {
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'vdt2024'),
    ));
}
add_action('after_setup_theme', 'vdt2024_setup');

