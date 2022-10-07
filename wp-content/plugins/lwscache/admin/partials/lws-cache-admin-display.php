<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.lws.fr
 * @since      1.0
 *
 * @package    LWSCache
 * @subpackage LWSCache/admin/partials
 */

global $pagenow;
$tabs_list = array(
    array('caching', __('LWS Cache', 'LWSCache')),
    array('plugins', __('Our plugins', 'LWSCache')),
);



$plugins = array(
        'lws-hide-login' => array('LWS Hide Login', __('This plugin <strong>hide your administration page</strong> (wp-admin) and lets you <strong>change your login page</strong> (wp-login). It offers better security as hackers will have more trouble finding the page.', 'LWSCache'), true),
        'lws-cleaner' => array('LWS Cleaner', __('This plugin lets you <strong>clean your WordPress website</strong> in a few clics to gain speed: posts, comments, terms, users, settings, plugins, medias, files.', 'LWSCache'), true),
        'lws-sms' => array('LWS SMS', __('This plugin, designed specifically for WooCommerce, lets you <strong>send SMS automatically to your customers</strong>. You will need an account at LWS and enough credits to send SMS. Create personnalized templates, manage your SMS and sender IDs and more!', 'LWSCache'), false),
        'lws-affiliation' => array('LWS Affiliation', __('With this plugin, you can add banners and widgets on your website and use those with your <strong>affiliate account LWS</strong>. Earn money and follow the evolution of your gains on your website.', 'LWSCache'), false),
        'lwscache' => array('LWSCache', __('Based on the Varnich cache technology and NGINX, LWSCache let you <strong>speed up the loading of your pages</strong>. This plugin helps you automatically manage your LWSCache when editing pages, posts... and purging all your cache. Works only if your server use this cache.', 'LWSCache'), false),
        'lws-tools' => array('LWS Tools', __('This plugin provides you with several tools and shortcuts to manage, secure and optimise your WordPress website. Updating plugins and themes, accessing informations about your server, managing your website parameters, etc... Personnalize every aspect of your website!', 'LWSCache'), false)
    );

$plugins_showcased = array('lws-hide-login', 'lws-cleaner', 'lws-tools');

$plugins_activated = array();
$all_plugins = get_plugins();

foreach ($plugins as $slug => $plugin) {
    if (is_plugin_active($slug . '/' . $slug . '.php')) {
        $plugins_activated[$slug] = "full";
    } elseif (array_key_exists($slug . '/' . $slug . '.php', $all_plugins)) {
        $plugins_activated[$slug] = "half";
    }
}

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<!-- TODO -->
<!-- 

    Quand cache pas dispo, bloc rouge sort du bloc (j'imagine que j'ai quelques lignes de code à changer)
    Onglets disparaissent
    Page Our Plugin affichée par défaut


 -->
<!-- END TODO -->


<div class="lws_cache_main_bloc">
    <div class="lws_cache_adbloc">
        <div class="lws_cache_adbloc_left">
            <span class="lws_cache_ad_title"><?php echo esc_html('LWSCache'); ?></span>
            <span class="lws_cache_ad_subtext"> <?php esc_html_e('by', 'LWSCache'); ?></span>
            <img class="lws_cache_ad_img"
                src="<?php echo esc_url(plugins_url('icons/logo_lws.png', __DIR__))?>"
                alt="LWS Logo" width="238px" height="60px">
        </div>
        <div class="lws_cache_adbloc_right">
            <span class="lws_cache_ad_t1"> <?php esc_html_e('Discover LWS efficient, fast and secure web hosting!', 'LWSCache'); ?></span>
            <br>
            <img style="vertical-align:sub; margin-right:5px"
                src="<?php echo esc_url(plugins_url('icons/wordpress_blanc.svg', __DIR__))?>"
                alt="LWS Cache Logo" width="20px" height="20px">
            <span class="lws_cache_ad_t2"> <?php esc_html_e('15% off your WordPress-optimized hosting with the code: ', 'LWSCache'); ?></span>
            <br>
            <div style="margin-top:10px">
                <label onclick="lwscache_copy_clipboard(this)" class="lws_cache_ad_label lwscache_tooltip" readonly
                    text="WPEXT15">
                    <span><?php echo esc_html('WPEXT15'); ?></span>
                    <img style="vertical-align: middle; padding-left: 47px;"
                        src="<?php echo esc_url(plugins_url('icons/copier.svg', __DIR__))?>"
                        alt="Logo Copy Element" width="15px" height="18px">
                </label>
                <a target="_blank"
                    href="<?php echo esc_url('https://www.lws.fr/hebergement_wordpress.php');?>"><button
                        type="button" class="lws_cache_ad_button"><?php esc_html_e("Let's go!", 'LWSCache'); ?></button></a>
            </div>
        </div>
    </div>
    <div class="lws_cache_subtitlebloc">
        <img style="margin-top:20px"
            src="<?php echo esc_url(plugins_url('icons/lws_cache.svg', __DIR__))?>"
            alt="LWS Cache Logo" width="100px" height="100px">
        <div class="lws_cache_title-text">
            <p class="lws_cache_text_p"><?php esc_html_e('This plugin automatically manage the purge of all cache files generated by LWSCache on this webserver. It is possible to configurate the automatic purge when you are making changes to pages, articles, messages...', 'LWSCache'); ?>
            </p>
            <p class="lws_cache_text_p"><?php esc_html_e("The cache generated by LWSCache allows faster loadings of your code (e.g : HTML, CSS, JS, Images, ...) resulting in better page speed. The upgraded speed is an important SEO factor.", 'LWSCache'); ?>
            </p>
            <p class="lws_cache_text_p"><a href='https://aide.lws.fr/a/1579' target="_blank"><?php esc_html_e("Learn more", 'LWSCache'); ?></a>
            </p>
        </div>
    </div>

    <?php if(!isset($_SERVER['lwscache'])) : ?>
    <div class="notif_cache">
        <?php esc_html_e('Your site is not compatible with this plugin.', 'LWSCache'); ?>
    </div>

    <?php else : ?>

    <!-- On test si le cache nginx a bien été activé sur le panel Client -->
    <!-- Si pas activé on affiche un message rouge -->
    <?php if($_SERVER['lwscache'] != 'On') : ?>
    <div class="notif_cache">
        <p><?php esc_html_e('The plugin cannot currently work with your service because LWSCache caching has not been enabled in your client panel.', 'LWSCache'); ?>
        </p>
        <p><?php esc_html_e('We invite you to activate this feature by logging into your LWS account and following', 'LWSCache'); ?>
            <a href='https://aide.lws.fr/a/1573' target='_blank'><?php esc_html_e('this documentation', 'LWSCache'); ?></a>.
        </p>
        <p><?php esc_html_e('After the activation, it will be taken into consideration for a maximum of 15 minutes.', 'LWSCache'); ?>
        </p>
    </div>
    <?php endif ?>
    <?php endif ?>

    <div class="lwscache_main_content">

        <div class="lwscache_list_block_content">

            <?php if(isset($_SERVER['lwscache'])) : ?>
            <?php if($_SERVER['lwscache'] == 'On') : ?>
            <div class="tab_lwscache" id='tab_lwscache_block'>
                <div id="tab_lwscache" role="tablist" aria-label="Onglets_lwscache">
                    <?php foreach ($tabs_list as $tab) : ?>
                    <button
                        id="<?php echo esc_attr('nav-' . $tab[0]); ?>"
                        class="tab_nav_lwscache <?php echo $tab[0] == 'caching' ? esc_attr('active') : ''; ?>"
                        data-toggle="tab" role="tab"
                        aria-controls="<?php echo esc_attr($tab[0]);?>"
                        aria-selected="<?php echo $tab[0] == 'caching' ? esc_attr('true') : esc_attr('false'); ?>"
                        tabindex="<?php echo $tab[0] == 'caching' ? esc_attr('0') : '-1'; ?>">
                        <?php echo esc_html($tab[1]); ?>
                    </button>
                    <?php endforeach ?>
                    <div id="selector" class="selector_tab">&nbsp;</div>
                </div>
            </div>
            <?php endif ?>
            <?php endif ?>

            <div class="tab-pane main-tab-pane" id="caching" role="tabpanel" aria-labelledby="nav-caching" tabindex="0"
                <?php echo isset($_SERVER['lwscache']) ? ($_SERVER['lwscache'] == 'On' ? '' : esc_attr('hidden')) : esc_attr('hidden') ?>>
                <div id="post-body" class="lwscache_configpage">
                    <?php include plugin_dir_path(__FILE__) . 'lws-cache-general-options.php'; ?>
                </div>
            </div>

            <div class="tab-pane main-tab-pane" id="plugins" role="tabpanel" aria-labelledby="nav-plugins" tabindex="-1"
                <?php echo isset($_SERVER['lwscache']) ? ($_SERVER['lwscache'] == 'On' ? esc_attr('hidden') : '') : '' ?>>
                <div id="post-body" class="lwscache_configpage">
                    <?php include plugin_dir_path(__FILE__) . 'lws-cache-our-plugins.php'; ?>
                </div>
            </div>
        </div>

        <div class="lwscache_list_block_ad">
            <div class="lwscache_block_ad">
                <div style="display: flex; justify-content: space-between; margin-bottom:15px">
                    <span style="margin-top:5px">
                        <img style="vertical-align:sub; margin-right:5px"
                            src="<?php echo esc_url(plugins_url('icons/plugin_lws_tools.svg', __DIR__))?>"
                            alt="LWS Cache Logo" width="25px" height="23px">
                        <span class="lwscache_block_ad_text"><?php echo esc_html('LWS Tools');?></span>
                    </span>
                    <button class="lwscache_button_ad_block" onclick="install_plugin(this)" value="lws-tools"
                        id="lws-tools">
                        <span>
                            <img style="vertical-align:sub; margin-right:5px"
                                src="<?php echo esc_url(plugins_url('icons/securise.svg', __DIR__))?>"
                                alt="LWS Cache Logo" width="20px" height="19px">
                            <span class="lwscache_button_text"><?php esc_html_e('Install', 'LWSCache'); ?></span>
                        </span>
                        <span class="hidden" name="loading" style="padding-left:5px">
                            <img style="vertical-align:sub; margin-right:5px"
                                src="<?php echo esc_url(plugins_url('icons/loading.svg', __DIR__))?>"
                                alt="" width="18px" height="18px">
                        </span>
                        <span class="hidden" name="activate"><?php echo esc_html_e('Activate', 'LWSCache'); ?></span>
                        <span class="hidden" name="validated">
                            <img style="vertical-align:sub; margin-right:5px" width="18px" height="18px"
                                src="<?php echo esc_url(plugins_url('icons/check_blanc.svg', __DIR__))?>">
                            <?php esc_html_e('Activated', 'LWSCache'); ?>
                        </span>
                    </button>
                </div>
                <span class="lwscache_text_ad">
                    <?php esc_html_e('Toolkits and shortcuts to manage, secure and optimise your WordPress website.', 'LWSCache'); ?>
                </span>
            </div>

            <div class="lwscache_block_ad">
                <div style="display: flex; justify-content: space-between; margin-bottom:15px">
                    <span style="margin-top:5px">
                        <img style="vertical-align:sub; margin-right:5px"
                            src="<?php echo esc_url(plugins_url('icons/plugin_lws_hide_login.svg', __DIR__))?>"
                            alt="LWS Cache Logo" width="25px" height="23px">
                        <span class="lwscache_block_ad_text"><?php echo esc_html('Hide Login');?></span>
                    </span>
                    <button class="lwscache_button_ad_block" onclick="install_plugin(this)" value="lws-hide-login"
                        id="lws-hide-login">
                        <span>
                            <img style="vertical-align:sub; margin-right:5px"
                                src="<?php echo esc_url(plugins_url('icons/securise.svg', __DIR__))?>"
                                alt="LWS Cache Logo" width="20px" height="19px">
                            <span class="lwscache_button_text"><?php esc_html_e('Install', 'LWSCache'); ?></span>
                        </span>
                        <span class="hidden" name="loading" style="padding-left:5px">
                            <img style="vertical-align:sub; margin-right:5px"
                                src="<?php echo esc_url(plugins_url('icons/loading.svg', __DIR__))?>"
                                alt="" width="18px" height="18px">
                        </span>
                        <span class="hidden" name="activate"><?php echo esc_html_e('Activate', 'LWSCache'); ?></span>
                        <span class="hidden" name="validated">
                            <img style="vertical-align:sub; margin-right:5px" width="18px" height="18px"
                                src="<?php echo esc_url(plugins_url('icons/check_blanc.svg', __DIR__))?>">
                            <?php esc_html_e('Activated', 'LWSCache'); ?>
                        </span>
                    </button>
                </div>
                <span class="lwscache_text_ad">
                    <?php esc_html_e("Hide your administration page (wp-admin) and change your login page's URL (wp-login)", 'LWSCache'); ?>
                </span>
            </div>

            <div class="lwscache_block_ad">
                <div style="display: flex; justify-content: space-between; margin-bottom:15px">
                    <span style="margin-top:5px">
                        <img style="vertical-align:sub; margin-right:5px"
                            src="<?php echo esc_url(plugins_url('icons/plugin_lws_cleaner.svg', __DIR__))?>"
                            alt="LWS Cache Logo" width="25px" height="22px">
                        <span class="lwscache_block_ad_text"><?php echo esc_html('LWS Cleaner');?></span>
                    </span>
                    <button class="lwscache_button_ad_block" onclick="install_plugin(this)" value="lws-cleaner"
                        id="lws-cleaner">
                        <span>
                            <img style="vertical-align:sub; margin-right:5px"
                                src="<?php echo esc_url(plugins_url('icons/securise.svg', __DIR__))?>"
                                alt="LWS Cache Logo" width="20px" height="19px">
                            <span class="lwscache_button_text"><?php esc_html_e('Install', 'LWSCache'); ?></span>
                        </span>
                        <span class="hidden" name="loading" style="padding-left:5px">
                            <img style="vertical-align:sub; margin-right:5px"
                                src="<?php echo esc_url(plugins_url('icons/loading.svg', __DIR__))?>"
                                alt="" width="18px" height="18px">
                        </span>
                        <span class="hidden" name="activate"><?php echo esc_html_e('Activate', 'LWSCache'); ?></span>
                        <span class="hidden" name="validated">
                            <img style="vertical-align:sub; margin-right:5px" width="18px" height="18px"
                                src="<?php echo esc_url(plugins_url('icons/check_blanc.svg', __DIR__))?>">
                            <?php esc_html_e('Activated', 'LWSCache'); ?>
                        </span>
                    </button>
                </div>
                <span class="lwscache_text_ad">
                    <?php esc_html_e('Clean your WordPress website in a few clics to gain in speed: posts, medias...', 'LWSCache'); ?>
                </span>
            </div>
        </div>
    </div>
</div>

<script>
    function lwscache_copy_clipboard(input) {
        navigator.clipboard.writeText(input.innerText);
        setTimeout(function() {
            jQuery('#copied_tip').remove();
        }, 500);
        jQuery(input).append("<div class='tip' id='copied_tip'>" +
            "<?php esc_html_e('Copied!', 'LWSCache');?>" +
            "</div>");
    }
</script>

<?php if(isset($_SERVER['lwscache'])) : ?>
<?php if($_SERVER['lwscache'] == 'On') : ?>
<script>
    const tabs = document.querySelectorAll('.tab_nav_lwscache[role="tab"]');

    // Add a click event handler to each tab
    tabs.forEach((tab) => {
        tab.addEventListener('click', lwscache_changeTabs);
    });

    lwscache_selectorMove(document.getElementById('nav-caching'), document.getElementById('nav-caching').parentNode);

    function lwscache_selectorMove(target, parent) {
        const cursor = document.getElementById('selector');
        var element = target.getBoundingClientRect();
        var bloc = parent.getBoundingClientRect();

        var padding = parseInt((window.getComputedStyle(target, null).getPropertyValue('padding-left')).slice(0, -2));
        var margin = parseInt((window.getComputedStyle(target, null).getPropertyValue('margin-left')).slice(0, -2));
        var begin = (element.left - bloc.left) - margin;
        var ending = target.clientWidth + 2 * margin;

        cursor.style.width = ending + "px";
        cursor.style.left = begin + "px";
    }

    function lwscache_changeTabs(e) {
        var target;
        if (e.target === undefined) {
            target = e;
        } else {
            target = e.target;
        }
        const parent = target.parentNode;
        const grandparent = parent.parentNode.parentNode;

        // Remove all current selected tabs
        parent
            .querySelectorAll('.tab_nav_lwscache[aria-selected="true"]')
            .forEach(function(t) {
                t.setAttribute('aria-selected', false);
                t.classList.remove("active")
            });

        // Set this tab as selected
        target.setAttribute('aria-selected', true);
        target.classList.add('active');

        // Hide all tab panels
        grandparent
            .querySelectorAll('.tab-pane.main-tab-pane[role="tabpanel"]')
            .forEach((p) => p.setAttribute('hidden', true));

        // Show the selected panel
        grandparent.parentNode
            .querySelector(`#${target.getAttribute('aria-controls')}`)
            .removeAttribute('hidden');


        lwscache_selectorMove(target, parent);
    }
</script>
<?php endif ?>
<?php endif ?>

<script>
    jQuery(document).ready(function() {
        <?php foreach ($plugins_activated as $slug => $activated) : ?>
        <?php if ($activated == "full") : ?>
        <?php if (in_array($slug, $plugins_showcased)): ?>
        var button = jQuery(
            "<?php echo esc_attr("#" . $slug); ?>"
        );
        button.children()[3].classList.remove('hidden');
        button.children()[0].classList.add('hidden');
        button.prop('onclick', false);
        button.addClass('lwscache_button_ad_block_validated');
        <?php endif ?>
        /**/
        var button = jQuery(
            "<?php echo esc_attr("#bis_" . $slug); ?>"
        );
        button.children()[3].classList.remove('hidden');
        button.children()[0].classList.add('hidden');
        button.prop('onclick', false);
        button.addClass('lwscache_button_ad_block_validated');

        <?php elseif ($activated == "half") : ?>
        <?php if (in_array($slug, $plugins_showcased)): ?>
        var button = jQuery(
            "<?php echo esc_attr("#" . $slug); ?>"
        );
        button.children()[2].classList.remove('hidden');
        button.children()[0].classList.add('hidden');
        <?php endif ?>
        /**/
        var button = jQuery(
            "<?php echo esc_attr("#bis_" . $slug); ?>"
        );
        button.children()[2].classList.remove('hidden');
        button.children()[0].classList.add('hidden');
        <?php endif ?>
        <?php endforeach ?>
    });

    function install_plugin(button) {

        bouton_id = button.id;

        button.children[0].classList.add('hidden');
        button.children[3].classList.add('hidden');
        button.children[2].classList.add('hidden');
        button.children[1].classList.remove('hidden');
        button.classList.remove('lwscache_button_ad_block_validated');
        button.setAttribute('disabled', true);

        var data = {
            action: "lwscache_downloadPlugin",
            _ajax_nonce: '<?php echo esc_attr(wp_create_nonce('updates')); ?>',
            slug: button.getAttribute('value'),
        };
        jQuery.post(ajaxurl, data, function(response) {
            var success = response.success;
            var slug = response.data.slug;
            if (!success) {
                if (response.data.errorCode == 'folder_exists') {
                    var data = {
                        action: "lwscache_activatePlugin",
                        ajax_slug: slug,
                    };
                    jQuery.post(ajaxurl, data, function(response) {
                        jQuery('#' + bouton_id).children()[1].classList.add('hidden');
                        jQuery('#' + bouton_id).children()[2].classList.add('hidden');
                        jQuery('#' + bouton_id).children()[3].classList.remove('hidden');
                        jQuery('#' + bouton_id).addClass('lwscache_button_ad_block_validated');
                    });

                }
            } else {
                jQuery('#' + bouton_id).children()[1].classList.add('hidden');
                jQuery('#' + bouton_id).children()[2].classList.remove('hidden');
                jQuery('#' + bouton_id).prop('disabled', false);
            }
        });
    }
</script>