<?php

// Listing des bannières
define('SHORTINIT', true);
require_once($_GET['path'] . 'wp-load.php');
global $wpdb;
$banners = $wpdb->get_results("SELECT option_value FROM `" . $wpdb->options . "` WHERE option_name='_transient_lws_aff_banner'")[0]->option_value;
$banners = json_decode($banners, true);
?>

<html>

<head>
    <title>Preview Widget Affiliation LWS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div>
        <?php foreach ($banners['widget'] as $k => $type) : ?>
        <?php foreach ($type as $widget) : ?>
        <?php if ($widget['id'] == $_GET['id']) : ?>
        <?php echo $widget['code_source'];
            break; ?>
        <?php endif ?>
        <?php endforeach ?>
        <?php endforeach ?>

</body>

</html>