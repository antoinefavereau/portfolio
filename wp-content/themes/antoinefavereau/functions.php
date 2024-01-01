<?php

function my_theme_styles()
{
    wp_enqueue_style('theme-css', get_template_directory_uri() . '/assets/dist/css/theme.css');
}
add_action('wp_enqueue_scripts', 'my_theme_styles');

function my_theme_scripts()
{
    wp_enqueue_script('gsap-js', get_template_directory_uri() . '/assets/dist/js/gsap.min.js');
    wp_enqueue_script('gsap-scroll-trigger-js', get_template_directory_uri() . '/assets/dist/js/ScrollTrigger.min.js');
    wp_enqueue_script('gsap-text-js', get_template_directory_uri() . '/assets/dist/js/TextPlugin.min.js');
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

function handle_contact_form()
{
    if (!isset($_POST['name']) || !isset($_POST['mail']) || !isset($_POST['subject']) || !isset($_POST['message'])) {
        exit;
    }

    $name = $_POST['name'];
    $email = $_POST['mail'];
    $subject = "SITE : " . $_POST['subject'];
    $message = $_POST['message'];

    //php mailer variables
    $to = "antoinefavereau45@gmail.com"; //get_option('admin_email');
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n";

    try {
        $sent = wp_mail($to, $subject, strip_tags($message), $headers);
    } catch (\Throwable $th) {
        wp_send_json_error($th);
    }

    if ($sent) {
        wp_send_json_success();
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_contact_form', 'handle_contact_form');
add_action('wp_ajax_nopriv_contact_form', 'handle_contact_form');

// tranlations

// actions
pll_register_string("antoinefavereau", "discover");

// sections
pll_register_string("antoinefavereau", "background");
pll_register_string("antoinefavereau", "skills");
pll_register_string("antoinefavereau", "projects");
pll_register_string("antoinefavereau", "services");
pll_register_string("antoinefavereau", "contact");

// front page
pll_register_string("antoinefavereau", "French student in computer engineering school and freelance in web development.");
pll_register_string("antoinefavereau", "See my studies and experience");
pll_register_string("antoinefavereau", "All the technologies I am familiar with");
pll_register_string("antoinefavereau", "The different projects I worked on");
pll_register_string("antoinefavereau", "You have a project ?");
pll_register_string("antoinefavereau", "Front-end");
pll_register_string("antoinefavereau", "need your design");
pll_register_string("antoinefavereau", "quick result");
pll_register_string("antoinefavereau", "select");
pll_register_string("antoinefavereau", "Basic website");
pll_register_string("antoinefavereau", "branding or biography");
pll_register_string("antoinefavereau", "portfolio");
pll_register_string("antoinefavereau", "blog");
pll_register_string("antoinefavereau", "landing page or single page");
pll_register_string("antoinefavereau", "E-commerce");
pll_register_string("antoinefavereau", "content management system");
pll_register_string("antoinefavereau", "online sales");

// footer
pll_register_string("antoinefavereau", "Contact me");
pll_register_string("antoinefavereau", "You have an interesting project and want to work with me ?");
pll_register_string("antoinefavereau", "Name");
pll_register_string("antoinefavereau", "Mail");
pll_register_string("antoinefavereau", "Subject");
pll_register_string("antoinefavereau", "Message");
pll_register_string("antoinefavereau", "send");
pll_register_string("antoinefavereau", "Mail sent successfully");
