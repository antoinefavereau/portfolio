<?php

/**
 * Plugin Name:       LWS Hide Login
 * Plugin URI:        https://www.lws.fr/
 * Description:       Secure your access to the admin page with this plugin !
 * Version:           2.0.2
 * Requires PHP:      7.0
 * Author:            LWS
 * Author URI:        https://www.lws.fr
 * Tested up to:      6.0
 * Domain Path:       /languages
 *
 * @since             1.0
 * @package           lwshidelogin
*/

if (! defined('ABSPATH')) {
    exit;
}

define('LWS_HL_URL', plugin_dir_url(__FILE__));
define('LWS_HL_DIR', plugin_dir_path(__FILE__));
global $lws_hl_is_login;


/**
 * Load translations
 */
add_action('init', 'lws_hl_traduction');
function lws_hl_traduction()
{
    load_plugin_textdomain('lws-hide-login', false, dirname(plugin_basename(__FILE__)) . '/languages');
}

register_uninstall_hook(__FILE__, 'lws_hl_on_uninstall');
function lws_hl_on_uninstall()
{
    delete_option('lws_aff_new_login');
    delete_option('lws_aff_new_redirection');
    delete_site_option('lws_aff_new_login');
    delete_site_option('lws_aff_new_redirection');
}

add_action('admin_notices', 'lws_hl_admin_notice_warn_not_activated');

function lws_hl_admin_notice_warn_not_activated()
{
    if (!get_option('lws_aff_new_login') && get_current_screen()->base != ('toplevel_page_lws-hl-config') && (!is_multisite() || (is_multisite() && !is_plugin_active_for_network(plugin_basename(__FILE__))))) {
        echo '<div style="padding:10px" class="notice notice-warning is-dismissible">' .
         esc_html__('The LWS Hide Login plugin is activated on this website but no configuration has been created.', 'lws-hide-login') . esc_html__(' Your login page is not secure.', 'lws-hide-login') .
          '<br>' . esc_html__('Please go in the ', 'lws-hide-login') . '<a href="'. esc_url(admin_url('admin.php?page=lws-hl-config')) . '">' .
          esc_html__("plugin's settings", 'lws-hide-login') . '</a>' . esc_html__(' to create one.', 'lws-hide-login') . ' </div>';
    }
}

add_action('network_admin_notices', 'lws_hl_network_admin_notice_warn_not_activated');
function lws_hl_network_admin_notice_warn_not_activated()
{
    if (get_current_screen()->base != ('toplevel_page_lws-hl-config-network-network') && is_multisite() && is_plugin_active_for_network(plugin_basename(__FILE__)) && !get_site_option('lws_aff_new_login')) {
        echo '<div style="padding:10px" class="notice notice-warning is-dismissible">' .
         esc_html__('The LWS Hide Login plugin is activated on this website but no configuration has been created.', 'lws-hide-login') . esc_html__(' Your login page is not secure.', 'lws-hide-login') .
          '<br>' . esc_html__('Please go in the ', 'lws-hide-login') . '<a href="'. esc_url(network_admin_url('admin.php?page=lws-hl-config-network')) . '">' .
          esc_html__("plugin's settings", 'lws-hide-login') . '</a>' . esc_html__(' to create one.', 'lws-hide-login') . ' </div>';
    }
}


if (is_multisite() && ! function_exists('is_plugin_active_for_network') || ! function_exists('is_plugin_active')) {
    require_once(ABSPATH . '/wp-admin/includes/plugin.php');
}

add_filter('login_url', 'lws_hl_login_url', 10, 3);
function lws_hl_login_url($login_url, $redirect, $force_reauth)
{
    if (get_site_option('lws_aff_new_login') || get_option('lws_aff_new_login')) {
        if (is_404()) {
            nocache_headers();
            return '#';
        }

        if ($force_reauth === false) {
            return $login_url;
        }

        if (empty($redirect)) {
            return $login_url;
        }

        $redirect = explode('?', $redirect);

        if ($redirect[0] === admin_url('options.php')) {
            $login_url = admin_url();
        }
    }

    return $login_url;
}



/**
 * Enqueue any CSS or JS script needed
 */
add_action('admin_enqueue_scripts', 'lws_hl_scripts');
function lws_hl_scripts()
{
    wp_enqueue_style('lws_hl-css', LWS_HL_URL . "css/lws_hl_css.css");
}

/**
 * Create plugin menu in wp-admin
 */
add_action('admin_menu', 'lws_hl_menu_admin');
function lws_hl_menu_admin()
{
    $menu_slug = 'lws-hl-config';
    add_menu_page(__('LWS Hide Login - Settings', 'lws-hide-login'), 'LWS Hide Login', 'read', $menu_slug, 'lws_hl_create_page', LWS_HL_URL . 'images/plugin_lws_hide_login.svg');
}

/**
 * Generate the setting page in admin
 */
function lws_hl_create_page()
{
    if (isset($_POST['lws_hl_form_change_redirect'])) {
        empty($change_login = sanitize_text_field($_POST['input_change_login'])) ? delete_option('lws_aff_new_login') : update_option('lws_aff_new_login', $change_login);
        $form_updated = empty($change_login) ? __('The login page has been reverted to default.', 'lws-hide-login') : __('The login page has been successfully updated.', 'lws-hide-login');
    }

    if (isset($_POST['lws_hl_form_change_404'])) {
        $change_redirection = sanitize_text_field($_POST['input_change_redirection']);
        if (empty($change_redirection)) {
            update_option('lws_aff_new_redirection', ' ');
        } else {
            update_option('lws_aff_new_redirection', $change_redirection);
        }
        $form_updated = __('The redirection has been successfully updated.', 'lws-hide-login');
    }

    include __DIR__ . '/view/lws_hl_tabs.php';
}

if (is_multisite() && is_plugin_active_for_network(plugin_basename(__FILE__))) {
    add_action('network_admin_menu', 'lws_hl_menu_admin_network');
    function lws_hl_menu_admin_network()
    {
        $menu_slug = 'lws-hl-config-network';
        $plugin_active_network = is_plugin_active_for_network(plugin_basename(__FILE__));
        add_menu_page(__('LWS Hide Login - Settings', 'lws-hide-login'), 'LWS Hide Login', 'read', $menu_slug, 'lws_hl_create_page_network', LWS_HL_URL . 'images/plugin_lws_hide_login.svg');
    }
}

function lws_hl_create_page_network()
{
    if (isset($_POST['lws_hl_form_change_redirect'])) {
        empty($change_login = sanitize_text_field($_POST['input_change_login'])) ? delete_site_option('lws_aff_new_login') : update_site_option('lws_aff_new_login', $change_login);
        $form_updated = empty($change_login) ? __('The login page has been reverted to default.', 'lws-hide-login') : __('The login page has been successfully updated.', 'lws-hide-login');
    }

    if (isset($_POST['lws_hl_form_change_404'])) {
        $change_redirection = sanitize_text_field($_POST['input_change_redirection']);
        update_site_option('lws_aff_new_redirection', $change_redirection);
        $form_updated = __('The redirection has been successfully updated.', 'lws-hide-login');
    }

    include __DIR__ . '/view/lws_hl_tabs.php';
}


/*AJAX DOWNLOAD AND ACTIVATE PLUGINS*/

//AJAX DL Plugin//
add_action("wp_ajax_lwshidelogin_downloadPlugin", "wp_ajax_install_plugin");
//

//AJAX Activate Plugin//
add_action("wp_ajax_lwshidelogin_activatePlugin", "lws_hl_activate_plugin");
function lws_hl_activate_plugin()
{
    $plugin_active_network = is_plugin_active_for_network(plugin_basename(__FILE__));
    if (isset($_POST['ajax_slug'])) {
        if (is_multisite() && $plugin_active_network) {
            switch (sanitize_textarea_field($_POST['ajax_slug'])) {
                case 'lwscache':
                    activate_plugin('lwscache/lwscache.php', '', true);
                    break;
                case 'lws-sms':
                    activate_plugin('lws-sms/lws-sms.php', '', true);
                    break;
                case 'lws-tools':
                    activate_plugin('lws-tools/lws-tools.php', '', true);
                    break;
                case 'lws-affiliation':
                    activate_plugin('lws-affiliation/lws-affiliation.php', '', true);
                    break;
                case 'lws-cleaner':
                    activate_plugin('lws-cleaner/lws-cleaner.php', '', true);
                    break;
            }
        } else {
            switch (sanitize_textarea_field($_POST['ajax_slug'])) {
                case 'lwscache':
                    activate_plugin('lwscache/lwscache.php');
                    break;
                case 'lws-sms':
                    activate_plugin('lws-sms/lws-sms.php');
                    break;
                case 'lws-tools':
                    activate_plugin('lws-tools/lws-tools.php');
                    break;
                case 'lws-affiliation':
                    activate_plugin('lws-affiliation/lws-affiliation.php');
                    break;
                case 'lws-cleaner':
                    activate_plugin('lws-cleaner/lws-cleaner.php');
                    break;
            }
        }
    }
    wp_die();
}
//

/*END AJAX*/

/**
 * Deactivate wp-login and activate the new URL
 */
add_action('plugins_loaded', 'lws_hl_plugin_on_page_loaded');
function lws_hl_plugin_on_page_loaded()
{
    global $pagenow, $lws_hl_is_login_network, $lws_hl_is_login;
    $request = parse_url(rawurldecode($_SERVER['REQUEST_URI']));
    if (get_site_option('lws_aff_new_login') || get_option('lws_aff_new_login')) {
        if (is_multisite() && is_plugin_active_for_network(plugin_basename(__FILE__))) {
            if ((strpos(rawurldecode($_SERVER['REQUEST_URI']), 'wp-login.php') || $request['path'] == site_url('wp-login', 'relative')) && ! is_admin()) {
                $lws_hl_is_login_network = true;
                $pagenow = 'index.php';
            } elseif ((strpos(rawurldecode($_SERVER['REQUEST_URI']), 'wp-register.php') || $request['path'] == site_url('wp-register', 'relative')) && ! is_admin()) {
                $lws_hl_is_login_network = true;
                $pagenow = 'index.php';
            } elseif ($request['path'] == site_url(get_site_option('lws_aff_new_login'), 'relative')) {
                $lws_hl_is_login_network = false;
                $pagenow = 'wp-login.php';
            }
        } else {
            if ((strpos(rawurldecode($_SERVER['REQUEST_URI']), 'wp-login.php') || $request['path'] == site_url('wp-login', 'relative')) && ! is_admin()) {
                $lws_hl_is_login = true;
                $pagenow = 'index.php';
            } elseif ((strpos(rawurldecode($_SERVER['REQUEST_URI']), 'wp-register.php') || $request['path'] == site_url('wp-register', 'relative')) && ! is_admin()) {
                $lws_hl_is_login = true;
                $pagenow = 'index.php';
            } elseif ($request['path'] == site_url(get_option('lws_aff_new_login'), 'relative')) {
                $lws_hl_is_login = false;
                $pagenow = 'wp-login.php';
            }
        }
    }
}

/**
 * Take care of the redirections
 */
add_action('wp_loaded', 'lws_hl_redirect_page', 1);
function lws_hl_redirect_page()
{
    global $pagenow, $lws_hl_is_login, $lws_hl_is_login_network;
    $path = basename($_SERVER['REQUEST_URI']);
    
    if (get_site_option('lws_aff_new_login') || get_option('lws_aff_new_login')) {
        if (is_multisite() && is_plugin_active_for_network(plugin_basename(__FILE__))) {
            if (! (isset($_GET['action']) && isset($_POST['post_password']) && $_GET['action'] == 'postpass')) {
                if ($lws_hl_is_login_network) {
                    nocache_headers();
                    if (get_site_option('lws_aff_new_redirection')) {
                        wp_safe_redirect(get_site_url() . "/" . get_site_option('lws_aff_new_redirection'));
                    } else {
                        wp_safe_redirect(get_site_url() . "/404");
                    }
                    exit;
                } elseif ($pagenow == 'wp-login.php') {
                    global $user_login, $error;
                    $redirect_admin = admin_url();
                    $redirect_url = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : "";
                
                    if (is_user_logged_in() && !isset($_REQUEST['action'])) {
                        nocache_headers();
                        wp_safe_redirect(apply_filters('lws_hl_redirect_if_connected_login', $redirect_admin, $redirect_url));
                        exit();
                    }
                
                    require_once(ABSPATH . 'wp-login.php');
                    exit;
                }
                
                if (is_admin() && ! is_user_logged_in() && ! defined('WP_CLI') && !wp_doing_ajax() && ! defined('DOING_CRON') && $pagenow !== 'admin-post.php') {
                    nocache_headers();
                    if (get_site_option('lws_aff_new_redirection')) {
                        wp_safe_redirect(get_site_url() . "/" . get_site_option('lws_aff_new_redirection'));
                    } else {
                        wp_safe_redirect(get_site_url() . "/404");
                    }
                    exit;
                }
            }
        } else {
            if (! (isset($_GET['action']) && isset($_POST['post_password']) && $_GET['action'] == 'postpass')) {
                if ($lws_hl_is_login) {
                    nocache_headers();
                    if (get_option('lws_aff_new_redirection')) {
                        wp_safe_redirect(get_site_url() . "/" . get_option('lws_aff_new_redirection'));
                    } else {
                        wp_safe_redirect(get_site_url() . "/404");
                    }
                    exit;
                } elseif ($pagenow == 'wp-login.php') {
                    global $user_login, $error;
                    $redirect_admin = admin_url();
                    $redirect_url = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : "";
                
                    if (is_user_logged_in() && !isset($_REQUEST['action'])) {
                        nocache_headers();
                        wp_safe_redirect(apply_filters('lws_hl_redirect_if_connected_login', $redirect_admin, $redirect_url));
                        exit();
                    }
                
                    require_once(ABSPATH . 'wp-login.php');
                    exit;
                }
                
                if (is_admin() && ! is_user_logged_in() && ! defined('WP_CLI') && !wp_doing_ajax() && ! defined('DOING_CRON') && $pagenow !== 'admin-post.php') {
                    nocache_headers();
                    if (get_option('lws_aff_new_redirection')) {
                        wp_safe_redirect(get_site_url() . "/" . get_option('lws_aff_new_redirection'));
                    } else {
                        wp_safe_redirect(get_site_url() . "/404");
                    }
                    exit;
                }
            }
        }
    }
}

add_filter('site_url', 'lws_hl_siteurl');
add_filter('wp_redirect', 'lws_hl_redirect');

function lws_hl_siteurl($url)
{
    return lws_hl_filter_login($url);
}

function lws_hl_redirect($location)
{
    return lws_hl_filter_login($location);
}

/**
 * If URL sent contains wp-login.php,
 * recreate an url with the custom link instead
 */
function lws_hl_filter_login($url)
{
    if (strpos($url, 'wp-login.php')) {
        $args = explode('?', $url);
        if (get_site_option('lws_aff_new_login') || get_option('lws_aff_new_login')) {
            if (isset($args[1])) {
                parse_str($args[1], $args);
                if (is_multisite() && is_plugin_active_for_network(plugin_basename(__FILE__))) {
                    $url = add_query_arg($args, get_site_url() . "/" . get_site_option('lws_aff_new_login'));
                } else {
                    $url = add_query_arg($args, get_site_url() . "/" . get_option('lws_aff_new_login'));
                }
            } else {
                if (is_multisite() && is_plugin_active_for_network(plugin_basename(__FILE__))) {
                    $url = get_site_url() . "/" . get_site_option('lws_aff_new_login');
                } else {
                    $url = get_site_url() . "/" . get_option('lws_aff_new_login');
                }
            }
        }
    }

    return $url;
}
