<?php

function my_theme_styles()
{
    wp_enqueue_style('theme-css', get_template_directory_uri() . '/assets/dist/css/theme.css');
}
add_action('wp_enqueue_scripts', 'my_theme_styles');

function my_theme_scripts()
{
    wp_enqueue_script('scrollingList-js', get_template_directory_uri() . '/assets/dist/js/ScrollingList.js');
    wp_enqueue_script('script-js', get_template_directory_uri() . '/assets/sources/js/script.js');
}
add_action('wp_enqueue_scripts', 'my_theme_scripts');
