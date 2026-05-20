<?php
if (!defined('ABSPATH')) { exit; }

add_action('after_setup_theme', function () {
    add_theme_support('wp-block-styles');
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor.css');
    add_theme_support('responsive-embeds');
    add_theme_support('title-tag');
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('dakshin-chakra-style', get_stylesheet_uri(), [], wp_get_theme()->get('Version'));
    wp_enqueue_script('dakshin-chakra-navigation', get_theme_file_uri('/assets/js/navigation.js'), [], wp_get_theme()->get('Version'), true);
});
