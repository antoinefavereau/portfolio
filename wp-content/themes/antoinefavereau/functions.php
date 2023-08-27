<?php

function my_theme_styles()
{
    wp_enqueue_style('theme-css', get_template_directory_uri() . '/assets/dist/css/theme.css');
}
add_action('wp_enqueue_scripts', 'my_theme_styles');

function my_theme_scripts()
{
    wp_enqueue_script('gsap-js', get_template_directory_uri() . '/assets/dist/js/gsap.min.js');
    wp_enqueue_script('animations-js', get_template_directory_uri() . '/assets/sources/js/animations.js');
    wp_enqueue_script('cursor-js', get_template_directory_uri() . '/assets/sources/js/cursor.js');
    wp_enqueue_script('script-js', get_template_directory_uri() . '/assets/sources/js/script.js');
}
add_action('wp_enqueue_scripts', 'my_theme_scripts');

function add_defer_attribute($tag, $handle)
{
    if ($handle !== 'animations-js' && $handle !== 'cursor-js' && $handle !== 'script-js')
        return $tag;
    return str_replace(' src', ' defer="defer" src', $tag);
}

add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
