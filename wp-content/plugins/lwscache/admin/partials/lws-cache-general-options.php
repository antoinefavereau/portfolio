<?php
/**
 * Display general options of the plugin.
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      2.0.0
 *
 * @package    LWSCache
 * @subpackage LWSCache/admin/partials
 */

global $lws_cache_admin;

$error_log_filesize = false;

$args = array(
    'enable_purge'                     => FILTER_SANITIZE_STRING,
    'enable_stamp'                     => FILTER_SANITIZE_STRING,
    'purge_method'                     => FILTER_SANITIZE_STRING,
    'is_submit'                        => FILTER_SANITIZE_STRING,
    'redis_hostname'                   => FILTER_SANITIZE_STRING,
    'redis_port'                       => FILTER_SANITIZE_STRING,
    'redis_prefix'                     => FILTER_SANITIZE_STRING,
    'purge_homepage_on_edit'           => FILTER_SANITIZE_STRING,
    'purge_homepage_on_del'            => FILTER_SANITIZE_STRING,
    'purge_url'                        => FILTER_SANITIZE_STRING,
    'log_level'                        => FILTER_SANITIZE_STRING,
    'log_filesize'                     => FILTER_SANITIZE_STRING,
    'smart_http_expire_save'           => FILTER_SANITIZE_STRING,
    'cache_method'                     => FILTER_SANITIZE_STRING,
    'enable_map'                       => FILTER_SANITIZE_STRING,
    'enable_log'                       => FILTER_SANITIZE_STRING,
    'purge_archive_on_edit'            => FILTER_SANITIZE_STRING,
    'purge_archive_on_del'             => FILTER_SANITIZE_STRING,
    'purge_archive_on_new_comment'     => FILTER_SANITIZE_STRING,
    'purge_archive_on_deleted_comment' => FILTER_SANITIZE_STRING,
    'purge_page_on_mod'                => FILTER_SANITIZE_STRING,
    'purge_page_on_new_comment'        => FILTER_SANITIZE_STRING,
    'purge_page_on_deleted_comment'    => FILTER_SANITIZE_STRING,
    'smart_http_expire_form_nonce'     => FILTER_SANITIZE_STRING,
);

$all_inputs = filter_input_array(INPUT_POST, $args);

if (isset($all_inputs['smart_http_expire_save']) && wp_verify_nonce($all_inputs['smart_http_expire_form_nonce'], 'smart-http-expire-form-nonce')) {
    unset($all_inputs['smart_http_expire_save']);
    unset($all_inputs['is_submit']);

    $nginx_settings = wp_parse_args(
        $all_inputs,
        $lws_cache_admin->lws_cache_default_settings()
    );

    if ((! is_numeric($nginx_settings['log_filesize'])) || (empty($nginx_settings['log_filesize']))) {
        $error_log_filesize = __('Log file size must be a number.', 'LWSCache');
        unset($nginx_settings['log_filesize']);
    }

    if ($nginx_settings['enable_map']) {
        $lws_cache_admin->update_map();
    }

    update_site_option('rt_wp_lws_cache_options', $nginx_settings);
    ?>
<script>
	jQuery(document).ready(function() {
		jQuery('.lwscache_div_title_cache').after(
			"<?php echo "<div class='updated notice is-dismissible'><p>" . esc_html__('Settings saved.', 'LWSCache') . "</p></div>";?>"
			);
	});
</script>
<?php

}

$lws_cache_settings = $lws_cache_admin->lws_cache_settings();
$log_path           = $lws_cache_admin->functional_asset_path();
$log_url            = $lws_cache_admin->functional_asset_url();

/**
 * Get setting url for single multiple with subdomain OR multiple with subdirectory site.
 */
$nginx_setting_link = '#';
if (is_multisite()) {
    if (SUBDOMAIN_INSTALL === false) {
        $nginx_setting_link = 'https://easyengine.io/wordpress-nginx/tutorials/multisite/subdirectories/fastcgi-cache-with-purging/';
    } else {
        $nginx_setting_link = 'https://easyengine.io/wordpress-nginx/tutorials/multisite/subdomains/fastcgi-cache-with-purging/';
    }
} else {
    $nginx_setting_link = 'https://easyengine.io/wordpress-nginx/tutorials/single-site/fastcgi-cache-with-purging/';
}
?>

<!-- On test si le plugin est compatible avec le domaine -->

<!-- Forms containing LWSCache settings options. -->
<form id="post_form" method="post" action="#" name="smart_http_expire_form" class="">
	<div class="lwscache_div_title_cache">
		<h3 class="lwscache_title_cache"> <?php esc_html_e('LWS Cache Settings', 'LWSCache'); ?>
		</h3>
		<button type="submit" name="smart_http_expire_save" id="smart_http_expire_save" class="lwscache_input_save">
			<img class='lws_cache_img_save'
				src='<?php echo esc_url(plugins_url('icons/enregistrer.svg', __DIR__))?>'>
			<span><?php esc_html_e('Save All Changes', 'LWSCache');?></span>
		</button>
	</div>

	<!-- AUTO PURGE BLOCK -->
	<div class="lwscache_div_separator_first">
		<h3 class="lws_cache_title_cache_submenu">
			<span><?php esc_html_e('Purging Options: ', 'LWSCache'); ?></span>
		</h3>
		<h4 class="lwscache_subtitle_menu">
			<input type="checkbox" value="1" id="enable_purge" name="enable_purge" <?php checked($lws_cache_settings['enable_purge'], 1); ?>
			/>
			<label for="enable_purge"><?php esc_html_e('Enable Automatic Purge', 'LWSCache'); ?>
				<span class="lwscache_recommended"> <?php esc_html_e('recommended', 'LWSCache');?></span>
			</label>
		</h4> <!-- End of .inside -->
		<p class="lwscache_margin_class lws_cache_checkbox_input"> <?php esc_html_e('Launch an intelligent purge depending on events happening on your WordPress website.', 'LWSCache'); ?>
		</p>
	</div>
	<!--END -->

	<!-- MAIN BLOCK -->
	<?php if (! (! is_network_admin() && is_multisite())) : ?>
	<div class="" <?php echo (empty($lws_cache_settings['enable_purge'])) ? ' style="display: none;"' : ''; ?>>
		<h3 class="lws_cache_title_cache_submenu">
			<span><?php esc_html_e('Automatic Purging Condition: ', 'LWSCache'); ?></span>
		</h3>
		<div class="">
			<div class="lwscache_div_separator">
				<h4 class="lwscache_subtitle_menu">
					<?php esc_html_e('Purge Homepage', 'LWSCache'); ?>
					<span class="lwscache_recommended"> <?php esc_html_e('recommended', 'LWSCache');?></span>
				</h4>
				<fieldset class="lwscache_margin_class">
					<label for="purge_homepage_on_edit">
						<input class="lws_cache_checkbox_input" type="checkbox" value="1" id="purge_homepage_on_edit"
							name="purge_homepage_on_edit" <?php checked($lws_cache_settings['purge_homepage_on_edit'], 1); ?>
						/>
						<?php esc_html_e('When a post (or page/custom post) is modified or added.', 'LWSCache');?>
					</label>
				</fieldset>
				<fieldset class="lwscache_margin_class">
					<label for="purge_homepage_on_del">
						<input class="lws_cache_checkbox_input" class="lws_cache_checkbox_input" type="checkbox"
							value="1" id="purge_homepage_on_del" name="purge_homepage_on_del" <?php checked($lws_cache_settings['purge_homepage_on_del'], 1); ?>
						/>
						<?php esc_html_e('When a published post (or page/custom post) is trashed or added.', 'LWSCache');?>
					</label>
				</fieldset>
			</div>
			<div class="lwscache_div_separator">
				<h4 class="lwscache_subtitle_menu">
					<?php esc_html_e('Purge Post/Page/Custom Post Type', 'LWSCache'); ?>
					<span class="lwscache_recommended"> <?php esc_html_e('recommended', 'LWSCache');?></span>
				</h4>
				<fieldset class="lwscache_margin_class">
					<label for="purge_page_on_mod">
						<input class="lws_cache_checkbox_input" type="checkbox" value="1" id="purge_page_on_mod"
							name="purge_page_on_mod" <?php checked($lws_cache_settings['purge_page_on_mod'], 1); ?>>
						<?php esc_html_e('When a post is published.', 'LWSCache');?>
					</label>
				</fieldset>
				<fieldset class="lwscache_margin_class">
					<label for="purge_page_on_new_comment">
						<input class="lws_cache_checkbox_input" type="checkbox" value="1" id="purge_page_on_new_comment"
							name="purge_page_on_new_comment" <?php checked($lws_cache_settings['purge_page_on_new_comment'], 1); ?>>
						<?php esc_html_e('When a comment is approved or published.', 'LWSCache');?>
					</label>
				</fieldset>
				<fieldset class="lwscache_margin_class">
					<label for="purge_page_on_deleted_comment">
						<input class="lws_cache_checkbox_input" type="checkbox" value="1"
							id="purge_page_on_deleted_comment" name="purge_page_on_deleted_comment" <?php checked($lws_cache_settings['purge_page_on_deleted_comment'], 1); ?>>
						<?php esc_html_e('When a comment is unapproved or deleted.', 'LWSCache');?>
					</label>
				</fieldset>
			</div>
			<div class="lwscache_div_separator">
				<h4 class="lwscache_subtitle_menu"> <?php esc_html_e('Purge Archives', 'LWSCache'); ?>
				</h4>
				<fieldset class="lwscache_margin_class lwscache_legend_purge_archive">
					<span><?php esc_html_e('(date, category, tag, author, custom taxonomies)', 'LWSCache'); ?></span>
				</fieldset>
				<fieldset class="lwscache_margin_class">
					<label for="purge_archive_on_edit">
						<input class="lws_cache_checkbox_input" type="checkbox" value="1" id="purge_archive_on_edit"
							name="purge_archive_on_edit" <?php checked($lws_cache_settings['purge_archive_on_edit'], 1); ?>
						/>
						<?php esc_html_e('When a post (or page/custom post) is modified or added.', 'LWSCache');?>
						<span class="lwscache_recommended">
							<?php esc_html_e('recommended', 'LWSCache');?>
						</span>
					</label>
				</fieldset>
				<fieldset class="lwscache_margin_class">
					<label for="purge_archive_on_del">
						<input class="lws_cache_checkbox_input" type="checkbox" value="1" id="purge_archive_on_del"
							name="purge_archive_on_del" <?php checked($lws_cache_settings['purge_archive_on_del'], 1); ?>
						/>
						<?php esc_html_e('When a published post (or page/custom post) is trashed.', 'LWSCache');?>
						<span class="lwscache_recommended">
							<?php esc_html_e('recommended', 'LWSCache');?>
						</span>
				</fieldset>
				<fieldset class="lwscache_margin_class">
					<label for="purge_archive_on_new_comment">
						<input class="lws_cache_checkbox_input" type="checkbox" value="1"
							id="purge_archive_on_new_comment" name="purge_archive_on_new_comment" <?php checked($lws_cache_settings['purge_archive_on_new_comment'], 1); ?>
						/>
						<?php esc_html_e('When a comment is approved or published.', 'LWSCache');?>
					</label>
				</fieldset>
				<fieldset class="lwscache_margin_class">
					<label for="purge_archive_on_deleted_comment">
						<input class="lws_cache_checkbox_input" type="checkbox" value="1"
							id="purge_archive_on_deleted_comment" name="purge_archive_on_deleted_comment" <?php checked($lws_cache_settings['purge_archive_on_deleted_comment'], 1); ?>
						/>
						<?php esc_html_e('When a comment is unapproved or deleted.', 'LWSCache');?>
					</label>
				</fieldset>
			</div>
		</div> <!-- End of .inside -->
		<h3 class="lws_cache_title_cache_submenu">
			<span><?php esc_html_e('Complete Purging: ', 'LWSCache'); ?></span>
		</h3>

		<?php
                    $purge_url  = add_query_arg(
    array(
                            'lws_cache_action' => 'purge',
                            'lws_cache_urls'   => 'all',
                        )
);
	    $nonced_url = wp_nonce_url($purge_url, 'lws_cache-purge_all');
	    ?>

		<div class="lwscache_div_purge_all">
			<fieldset class="lwscache_margin_class">
				<h4 style="margin-left:unset" class="lwscache_subtitle_menu"><?php esc_html_e('Purge the entire cache', 'LWSCache'); ?>
				</h4>
				<span style="margin-top:6px" class="lws_cache_checkbox_input"> <?php esc_html_e('Erase every data stocked in cache.', 'LWSCache'); ?></span>
			</fieldset>
			<a href="<?php echo esc_url($nonced_url); ?>">
				<button class="lwscache_button_purge_all_cache">
					<img class="lws_cache_img_delete"
						src='<?php echo esc_url(plugins_url('icons/supprimer.svg', __DIR__))?>'>
					<?php esc_html_e('Purge Entire Cache', 'LWSCache'); ?>
				</button>
			</a>
		</div>
	</div>

	<input type="hidden" value="1" id="enable_log" name="enable_log" />
	<?php endif ?>

	<input type="hidden" name="smart_http_expire_form_nonce"
		value="<?php echo wp_create_nonce('smart-http-expire-form-nonce'); ?>" />
</form><!-- End of #post_form -->