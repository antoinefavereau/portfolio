<!-- Beginning of the Widget iframe -->
<?php
define('SHORTINIT', true);
require_once($_GET['path'] . 'wp-load.php');
$path = $_GET['path'];
$query = http_build_query(array('path' => $path));
global $wpdb;
$banners = $wpdb->get_results("SELECT option_value FROM `" . $wpdb->options . "` WHERE option_name='_transient_lws_aff_banner'")[0]->option_value;
$banners = json_decode($banners, true);
?>

<!DOCTYPE html>
<html>

<head>
    <title>LWS Affiliation Widget Configuration</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .lws_aff_widget_title {
            font-size: 16px;
            line-height: 26px;
            letter-spacing: 0px;
            color: #1C469D;
            margin-bottom: 0.5em;
        }

        .lws_aff_preview_text {
            font-size: 16px;
            line-height: 26px;
            letter-spacing: 0px;
            color: #1D2327;
        }

        .no_center {
            text-align: center;
            margin-bottom: 20px;
            margin-top: 5px;
        }

        .input-lws {
            height: unset !important;
            max-width: none !important;
        }

        .select-lws {
            max-width: none;
        }

        .lws_aff_widget_table {
            width: unset;
            margin-right: 30px;
            text-align: left;
            margin-left: 30px;
        }

        .hide_lws {
            display: none;
        }

        .mce-container-lws-body {
            background-color: #EEF1F5;
            font-size: 16px;
        }

        .banner_name {
            text-align: center;
            font-size: 16px;
            line-height: 26px;
            font-weight: 700;
            letter-spacing: 0px;
            color: #1C469D;
            margin-bottom: 10px;
        }

        .widget_config_button_preview {
            text-align: center;
        }

        .button_preview_lws {
            background: #EEF1F5 0% 0% no-repeat padding-box;
            border: 1px solid #959FA7;
            border-radius: 2px;
            opacity: 1;
            padding: 2px 9px;
            display: inline-block;
            line-height: 26px;
            font-size: 14px;
        }


        .tab_affiliation {
            background-color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            margin: 0px 20px;
            border-bottom: 1px solid rgba(28, 34, 38, 0.25);
            margin-top: 30px;
        }

        .tab_nav_affiliation {
            margin: 20px;
            border: none;
            font-size: 16px;
            letter-spacing: 0px;
            color: #1D2327;
            text-transform: uppercase;
            line-height: 26px;
            background: none;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .tab_nav_affiliation.active {
            font-weight: 600;
            cursor: default;
        }

        .caption_banner {
            line-height: 24px;
            letter-spacing: 0px;
            color: #1D2327;
            text-transform: uppercase;
            text-align: center;
            font-weight: 600;
            font-size: 13px;
            margin-bottom: 10px;
            text-align: center;
        }

        .tab_affiliation_banners_site {
            margin-bottom: 5px;
            padding: 0;
            margin-left: 30px;
        }

        .select_aff_banners_div {
            text-align: center;
            margin-top: 20px;
        }

        .select_aff_div {
            background-color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding-top: 20px;
            text-align: center;
            margin: 0px 20px;
            padding-bottom: 20px;
            margin-top: 30px;
            border-bottom: 1px solid rgba(28, 34, 38, 0.25);
        }

        .select_affiliation_banners_site {
            text-align: center
        }

        .tab_nav_affiliation_banner {
            background: #DBE7FF 0% 0% no-repeat padding-box;
            border-radius: 5px;
            text-align: left;
            letter-spacing: 0px;
            color: #1C469D;
            cursor: pointer;
            border: none;
            font-size: 14px;
            font-weight: 600;
            line-height: 26px;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .tab_nav_affiliation_banner.active {
            background: #1C469D 0% 0% no-repeat padding-box;
            cursor: default;
            color: #FFFFFF;
        }

        .tab_content_general_lws {
            background: #FFFFFF 0% 0% no-repeat padding-box;
            margin-left: 20px;
            margin-right: 20px;
            padding-top: 30px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        body {
            color: #444;
            font-family: "Open Sans", sans-serif;
            font-size: 13px;
            line-height: 1.4em;
            /*min-width: 600px;*/
        }

        table {
            width: 80%;
            margin-left: 10%;
            margin-right: 10%;
        }

        th {
            vertical-align: top;
            padding-top: 10px;
        }

        p.help {
            display: block;
            margin-top: 10px;
            margin-bottom: 35px;
            padding: 10px 15px 10px 15px;
            background: #F5F5F5 0% 0% no-repeat padding-box;
            border-radius: 10px;
            text-align: left;
            font-size: 16px;
            line-height: 26px;
            letter-spacing: 0px;
            color: #1D2327;
            opacity: 1;

        }

        input[type="text"],
        select {
            height: 28px;
            border: 1px solid #ddd;
            -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .07);
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, .07);
            background-color: #fff;
            color: #32373c;
            outline: 0;
            -webkit-transition: .05s border-color ease-in-out;
            transition: .05s border-color ease-in-out;
            padding: 3px 5px;
            width: 100%;
            line-height: 28px;
            font-size: 14px;
            max-width: 438px;
        }

        select {
            height: 36px;
            max-width: 450px;
        }

        input[type="text"]:focus,
        select:focus {
            border-color: #5b9dd9;
            -webkit-box-shadow: 0 0 2px rgba(30, 140, 190, .8);
            box-shadow: 0 0 2px rgba(30, 140, 190, .8);
        }

        .hidden {
            display: none;
        }


        .banner_image {
            max-width: 95%;
            cursor: pointer;
            padding: 10px;
            opacity: 0.95;
            margin-bottom: 5px;
            -webkit-transition: all .1s ease-in;
            -moz-transition: all .1s ease-in;
            -o-transition: all .1s ease-in;
            transition: all .1s ease-in;
            padding-left: 0;
            padding-right: 0;
        }

        .banner_size {
            background: #F5F5F5 0% 0% no-repeat padding-box;
            border: 1px solid #BFC0C1;
            padding: 10px 30px;
            margin-bottom: 20px;
            font-weight: bold;
            line-height: 30px;
            margin-top: 20px;
            font-size: 20px;
            text-align: center;
        }

        .widget_name {
            background: #FFEFE5 0% 0% no-repeat padding-box;
            padding: 20px 0px 10px 20px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .widget_config_content {
            width: -webkit-fill-available !important;
            background: #FFFFFF 0% 0% no-repeat padding-box;
            border: 1px solid #1D2327 !important;
            border-radius: 5px;
        }

        .widget_label {
            width: 15%;
        }

        .banner_figure {
            text-align: center;
            border: 1px solid #1C469D;
            border-radius: 3px;
            margin-left: 30px;
            margin-right: 30px;
            margin-bottom: 10px;
        }

        .banner_figure:hover {
            border-color: #DBE7FF;
            opacity: 1;
        }

        .banner_widget {
            border: 1px solid #1C469D;
            margin-right: 30px;
            margin-left: 30px;
            margin-bottom: 10px;
            -webkit-transition: all .1s ease-in;
            -moz-transition: all .1s ease-in;
            -o-transition: all .1s ease-in;
            transition: all .1s ease-in;
        }

        .banner_widget:hover {
            border-color: #DBE7FF;
        }

        .preview_button {
            text-align: center;
            letter-spacing: 0px;
            opacity: 1;
            background: #DBE7FF 0% 0% no-repeat padding-box;
            border-radius: 22px;
            color: #1C469D;
            padding: 0px 15px 0px 15px;
            line-height: 24px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            padding: 10px 20px;
        }

        .config_button {
            text-align: center;
            letter-spacing: 0px;
            opacity: 1;
            background: #1C469D 0% 0% no-repeat padding-box;
            border-radius: 22px;
            color: #FFFFFF;
            padding: 0px 15px 0px 15px;
            line-height: 24px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            padding: 10px 20px;
            margin-top: 0.5em;
        }

        #button_scroll {
            position: fixed;
            /* Fixed/sticky position */
            bottom: 20px;
            /* Place the button at the bottom of the page */
            right: 23px;
            /* Place the button 30px from the right */
            z-index: 99;
            /* Make sure it does not overlap */
            border: none;
            /* Remove borders */
            outline: none;
            /* Remove outline */
            background-color: #1a5ebe;
            /* Set a background color */
            color: white;
            /* Text color */
            cursor: pointer;
            /* Add a mouse pointer on hover */
            padding: 8px;
            /* Some padding */
            border-radius: 10px;
            /* Rounded corners */
            font-size: 16px;
            /* Increase font size */
            box-shadow: 3px 2px 2px rgba(0, 0, 0, 0.5);
        }

        #button_scroll:hover {
            background-color: #555;
            /* Add a dark-grey background on hover */
        }

        .selector_tab {
            position: relative;
            top: 2px;
            left: 0px;
            height: 3px;
            width: 0px;
            background-color: #1C469D;
            z-index: 10;
            transition: left .5s ease 0s;
            margin-top: 2px;
        }

        @media only screen and (max-width: 980px) {
            .banner_figure {
                margin-left: 70px;
                margin-right: 70px;
            }
        }

        @media only screen and (max-width: 900px) {
            .banner_figure {
                margin-right: 2.5px;
                margin-left: 1.5px;
            }

            .banner_image {
                max-width: 99%;
            }


        }

        @media only screen and (max-width: 767px) {
            .banner_size {
                text-align: center;
            }


        }

        @media only screen and (max-width: 600px) {
            .mce-container-lws-body {
                font-size: 14px;
            }

            #button_scroll {
                right: 8px;
                bottom: 10px;
            }
        }

        @media only screen and (max-width: 570px) {
            .table_widget_domaine {
                margin-left: 70px;
                margin-right: 70px;
            }
        }

        @media only screen and (max-width: 530px) {
            .tab_content_lws {
                margin: 0px;
                padding: 0px;
            }

            .tab_nav_affiliation {
                border: 1px solid #9DB3F6;
            }
        }

        @media only screen and (max-width: 490px) {

            .widget_config_content {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 430px) {
            .mce-container-lws-body {
                font-size: 12px;
            }

            .table_widget_domaine {
                margin-left: 25px;
                margin-right: 25px;
            }

        }

        @media only screen and (max-width: 345px) {
            .table_widget_domaine {
                margin-left: 2px;
                margin-right: 2px;
            }
        }
    </style>

</head>

<body class="mce-container-lws-body">

    <div class="tab_affiliation hidden" id="tab_affiliation" role="tablist" aria-label="Onglets Widget">
        <button id="nav-banners" class="tab_nav_affiliation active" data-toggle="tab" role="tab" aria-controls="banners"
            aria-selected="true" tabindex="0">
            Bannières
        </button>
        <button id="nav-widget" class="tab_nav_affiliation" data-toggle="tab" role="tab" aria-controls="widgets_ds"
            aria-selected="false" tabindex="-1">
            Recherche de domaines
        </button>
        <button id="nav-widget-t" class="tab_nav_affiliation" data-toggle="tab" role="tab" aria-controls="widgets_t"
            aria-selected="false" tabindex="-1">
            Tableaux d'offres
        </button>
        <div id="selector" class="selector_tab">&nbsp;</div>
    </div>

    <div class="select_aff_div">
        <select name="tab_site_select" id="tab_site_select" class="select_affiliation_banners_site">
            <option value="nav-banners">
                Bannières
            </option>
            <option value="nav-widget">
                Recherche de domaines
            </option>
            <option value="nav-widget-t">
                Tableaux d'offres
            </option>
        </select>
    </div>

    <button id="button_scroll" class="hide_lws" title="Go to top"><?php echo file_get_contents("../../svg/icon_arrow.svg"); ?></button>

    <div class="tab-content" id="tab_affiliation_content">
        <!-- Bannières -->
        <div class="tab-pane main-tab-pane" id="banners" role="tabpanel" aria-labelledby="nav-banners" tabindex="0">
            <div class="tab_content_general_lws">
                <div class="tab_affiliation_banners_site" id="tab_banners_site" role="tablist"
                    aria-label="Onglets Site Bannières">
                    <?php $count = 0; ?>
                    <?php foreach ($banners['image'] as $n => $site): ?>
                    <button id="nav-site-<?php echo $count; ?>"
                        class="tab_nav_affiliation_banner <?php echo $count == 0 ? "active" : ""?>"
                        data-toggle="tab" role="tab"
                        aria-controls="<?php echo "tab_" . $count; ?>"
                        aria-selected="<?php echo $count == 0 ? "true" : "false" ?>"
                        tabindex="<?php echo $count == 0 ? 0 : -1 ?>">
                        <?php echo($n); ?>
                    </button>
                    <?php $count++; ?>
                    <?php endforeach ?>
                </div>

                <div class="select_aff_banners_div hidden">
                    <select name="tab_banners_site_select" id="tab_banners_site_select"
                        class="select_affiliation_banners_site">
                        <?php $count = 0; ?>
                        <?php foreach ($banners['image'] as $n => $site): ?>
                        <option
                            value="<?php echo "nav-site-" . $count; ?>">
                            <?php echo $n; ?>
                        </option>
                        <?php $count++; ?>
                        <?php endforeach ?>
                    </select>
                </div>

                <?php $count = 0; ?>
                <div class="tab-content" id="tab_affiliation_banner_content">
                    <?php foreach ($banners['image'] as $n => $site): ?>
                    <div class="tab-pane lws-content-page"
                        id="<?php echo "tab_" . $count; ?>"
                        role="tabpanel"
                        aria-labelledby="nav-site-<?php echo $count; ?>"
                        tabindex="<?php echo $count == 0 ? 0 : -1 ?>"
                        <?php echo $count == 0 ? '' : "hidden='true'"?>>
                        <div class="tab_content_lws">
                            <?php foreach ($site as $s => $size): ?>
                            <div id=<?php echo $count . "_" . $s; ?>>
                                <h2 class="banner_size"><?php echo($s); ?>
                                </h2>
                                <?php foreach ($size as $banner): ?>
                                <h4 class="banner_name"><?php echo($banner['name']) ?>
                                </h4>
                                <figure class="banner_figure">
                                    <img loading="lazy" class="banner_image" src="<?php preg_match('@src="([^"]+)"@', $banner['code_source'], $match);
                                    $src = array_pop($match);
                                    echo $src; ?>"
                                        data-source='<figure> <?php echo $banner['code_source'] ?> 
                                            <?php if ($banners['code_promo']['have'] == "yes") : ?><figcaption class="caption_banner"> <?php echo "Profitez de -15% sur vos achats grâce au code promo : " .
                                    $banners['code_promo']['code_p']; ?> </figcaption><?php endif ?></figure>' />
                                    <?php if ($banners['code_promo']['have'] == "yes") : ?>
                                    <figcaption class="caption_banner"> <?php echo "Profitez de -15% sur vos achats grâce au code promo : " . $banners['code_promo']['code_p']; ?>
                                    </figcaption>
                                    <?php endif ?>
                                </figure>
                                <br />
                                <?php endforeach ?>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <?php $count++; ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>

        <!-- Widgets Domaine -->
        <div class="tab-pane main-tab-pane" id="widgets_ds" role="tabpanel" aria-labelledby="nav-widget" hidden='true'
            tabindex="-1">
            <div class="tab_content_general_lws">
                <?php foreach ($banners['widget'] as $k => $type): ?>
                <?php if ($k == 'domain_search'): ?>
                <h4 class="banner_size">Widget recherche nom de domaine</h4>

                <?php foreach ($type as $widget): ?>
                <div class="banner_widget">
                    <div id="div-<?php echo $widget['id'] ?>"
                        style="text-align:center;">
                        <h4 class="lws_aff_widget_title"
                            id="config-name-<?php echo $widget['id'] ?>">
                            <?php echo $widget['name'] ?>
                        </h4>
                        <a class="preview_button" target="_blank"
                            href="preview_widget.php?id=<?php echo $widget['id'] ?>&<?php echo $query?>">Aperçu</a>
                        <a class="config_button"
                            id="open-config-<?php echo $widget['id'] ?>"
                            data-source='<figure> <?php echo $widget['code_source'] ?> 
                                    <?php if ($banners['code_promo']['have'] == "yes") : ?><figcaption class="caption_banner"> <?php echo "Profitez de -15% sur vos achats grâce au code promo : " .
                                     $banners['code_promo']['code_p']; ?> </figcaption><?php endif ?></figure>'>Configurer
                            le Widget</a>
                    </div>
                    <br />

                    <?php preg_match('@src="([^"]+)"@', $widget['code_source'], $match);
                    $src = array_pop($match);
                    $src_prim = substr($src, 0, strpos($src, '/com/')) . '/';
                    ?>
                    <form
                        id="form-<?php echo $widget['id'] ?>"
                        style="display:none;">
                        <br />
                        <input
                            id="url-base-<?php echo $widget['id'] ?>"
                            type="hidden"
                            value="<?php echo $src ?>" />
                        <input
                            id="url-prim-<?php echo $widget['id'] ?>"
                            type="hidden"
                            value="<?php echo $src_prim ?>" />
                        <input
                            id="type-widget-<?php echo $widget['id'] ?>"
                            type="hidden" value="<?php echo $k ?>" />
                        <table class="lws_aff_widget_table">
                            <tr>
                                <th class="widget_label"><label>Extension : </label></th>
                                <td>
                                    <input type="text" class="newtag widget_config_content form-input-tip input-lws"
                                        placeholder="extension" value="com"
                                        id="extensionInput-<?php echo $widget['id'] ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td class="widget_config_help" colspan="2">
                                    <p class="help">Correspond à l'extension qui sera affichée en premier parmi les
                                        suggestions. Pour voir les extensions que nous vendons consultez cette page : <a
                                            href="https://www.lws.fr/tarif_nom_de_domaine.php" target="_blank">Domaine
                                            LWS</a>
                                    </p>
                                </td>
                            </tr>

                            <tr>
                                <th class="widget_label"><label>Thème du bouton : </label></th>
                                <td>
                                    <select class="select-lws widget_config_content"
                                        onChange="lws_aff_change(<?php echo $widget['id'] ?>)"
                                        id="themeSelect-<?php echo $widget['id'] ?>">
                                        <option value="default" selected="selected">default</option>
                                        <option value="primary">primary</option>
                                        <option value="info">info</option>
                                        <option value="success">success</option>
                                        <option value="warning">warning</option>
                                        <option value="danger">danger</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="widget_config_help" colspan="2">
                                    <p class="help">Correspond à la couleur du bouton qui apparaîtra à droite du champ
                                        de recherche</p>
                                </td>
                            </tr>

                            <tr>
                                <th class="widget_label"><label>Texte du bouton : </label></th>
                                <td>
                                    <input type="text"
                                        onchange="lws_aff_change(<?php echo $widget['id'] ?>)"
                                        class="newtag widget_config_content form-input-tip input-lws"
                                        placeholder="extension" value="Commander" maxlength="30"
                                        id="txtButtonInput-<?php echo $widget['id'] ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td class="widget_config_help" colspan="2">
                                    <p class="help">Correspond au texte qui s'affichera à l'intérieur du bouton.</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="widget_config_button_preview">
                                    <p class="lws_aff_preview_text" style="margin: -15px 0 35px 0;">Aperçu du bouton :
                                        <button id="btn-color" type="button"
                                            class="button_preview_lws">Commander</button></<p>
                                </td>
                            </tr>

                            <tr>
                                <th class="widget_label"><label>Cible : </label></th>
                                <td>
                                    <select class="select-lws widget_config_content"
                                        id="targetSelect-<?php echo $widget['id'] ?>">
                                        <option value="blank" selected="selected">blank</option>
                                        <option value="parent">parent</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="widget_config_help" colspan="2">
                                    <p class="help">Spécifie si la redirection vers le site de vente se fait dans la
                                        page courante (parent) ou dans un nouvel onglet (blank).</p>
                                </td>
                            </tr>

                            <tr>
                                <th class="widget_label"><label>Langue : </label></th>
                                <td>
                                    <select class="select-lws widget_config_content"
                                        id="langSelect-<?php echo $widget['id'] ?>">
                                        <option value="fra" selected="selected">Français</option>
                                        <option value="eng">Anglais</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="widget_config_help" colspan="2">
                                    <p class="help">Choisissez la langue d'affichage de votre Widget.</p>
                                </td>
                            </tr>

                        </table>

                        <div class="no_center">
                            <a class="preview_button"
                                id="cancelWidgetConfig-<?php echo $widget['id'] ?>"
                                onclick="">Annuler</a>
                            <a class="config_button"
                                id="validateWidgetConfig-<?php echo $widget['id'] ?>"
                                onclick="">Insérer le Widget</a>
                        </div>
                    </form>

                </div><br />
                <?php endforeach ?>
                <?php endif ?>
                <?php endforeach ?>
            </div>
        </div>

        <!-- Widgets Tableaux -->
        <div class="tab-pane main-tab-pane" id="widgets_t" role="tabpanel" aria-labelledby="nav-widget-t" hidden='true'
            tabindex="-1">
            <div class="tab_content_general_lws">
                <?php foreach ($banners['widget'] as $k => $type): ?>
                <?php if ($k != 'domain_search'): ?>
                <h4 class="banner_size">Tableaux offres</h4>

                <?php foreach ($type as $widget): ?>
                <div class="banner_widget">
                    <div id="div-<?php echo $widget['id'] ?>"
                        style="text-align:center;">
                        <h4 class="lws_aff_widget_title"
                            id="config-name-<?php echo $widget['id'] ?>">
                            <?php echo $widget['name'] ?>
                        </h4>
                        <a class="preview_button" target="_blank"
                            href="preview_widget.php?id=<?php echo $widget['id'] ?>&<?php echo $query?>">Aperçu</a>
                        <a class="config_button"
                            id="open-config-<?php echo $widget['id'] ?>"
                            data-source='<figure> <?php echo $widget['code_source'] ?> <?php if ($banners['code_promo']['have'] == "yes") : ?><figcaption class="caption_banner"> <?php echo "Profitez de -15% sur vos achats grâce au code promo : " . $banners['code_promo']['code_p']; ?> </figcaption><?php endif ?></figure>'>Configurer
                            le Widget</a>
                    </div>
                    <br />

                    <?php preg_match('@src="([^"]+)"@', $widget['code_source'], $match);
                    $src = array_pop($match);
                    if ($k != 'domain_search') {
                        $src_prim = substr($src, 0, strpos($src, '/blank')) . '/';
                    }
                    ?>
                    <form
                        id="form-<?php echo $widget['id'] ?>"
                        style="display:none;">
                        <br />
                        <input
                            id="url-base-<?php echo $widget['id'] ?>"
                            type="hidden"
                            value="<?php echo $src ?>" />
                        <input
                            id="url-prim-<?php echo $widget['id'] ?>"
                            type="hidden"
                            value="<?php echo $src_prim ?>" />
                        <input
                            id="type-widget-<?php echo $widget['id'] ?>"
                            type="hidden" value="<?php echo $k ?>" />
                        <table class="lws_aff_widget_table">
                            <tr>
                                <th class="widget_label"><label>Cible : </label></th>
                                <td>
                                    <select class="select-lws widget_config_content"
                                        id="targetSelect-<?php echo $widget['id'] ?>">
                                        <option value="blank" selected="selected">blank</option>
                                        <option value="parent">parent</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="widget_config_help" colspan="2">
                                    <p class="help">Spécifie si la redirection vers le site de vente se fait dans la
                                        page courante (parent) ou dans un nouvel onglet (blank).</p>
                                </td>
                            </tr>
                            <tr>
                                <th class="widget_label"><label>Langue : </label></th>
                                <td>
                                    <select class="select-lws widget_config_content"
                                        id="langSelect-<?php echo $widget['id'] ?>">
                                        <option value="fra" selected="selected">Français</option>
                                        <option value="eng">Anglais</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="widget_config_help" colspan="2">
                                    <p class="help">Choisissez la langue d'affichage de votre Widget.</p>
                                </td>
                            </tr>
                        </table>

                        <div class="no_center">
                            <a class="preview_button" style=""
                                id="cancelWidgetConfig-<?php echo $widget['id'] ?>"
                                onclick="">Annuler</a>
                            <a class="config_button"
                                id="validateWidgetConfig-<?php echo $widget['id'] ?>"
                                onclick="">Insérer le Widget</a>
                        </div>
                    </form>

                </div><br />
                <?php endforeach ?>
                <?php endif ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</body>

<script>
    if (typeof(jQuery) == "undefined") {
        var iframeBody = document.getElementsByTagName("body")[0];
        var jQuery = function(selector) {
            return parent.jQuery(selector, iframeBody);
        };
        var $ = jQuery;
    }

    console.log(document.getElementsByTagName("body")[0].parentElement.childNodes[2].childNodes);
</script>

<script>
    function lws_aff_change(val) {
        var value = document.getElementById("themeSelect-" + val).value
        var color = document.getElementById("btn-color");
        var text = document.getElementById("txtButtonInput-" + val)
        if ((text.value).length < 1) {
            color.textContent = "Commander";
        } else {
            color.textContent = text.value;
        }
        switch (value) {
            case "default":
                color.style.backgroundColor = '#EEF1F5';
                color.style.color = "black";
                break;
            case "primary":
                color.style.backgroundColor = '#286090';
                color.style.color = "white";
                break;
            case "info":
                color.style.backgroundColor = '#31b0d5';
                color.style.color = "white";
                break;
            case 'success':
                color.style.backgroundColor = '#449d44';
                color.style.color = "white";
                break;
            case "warning":
                color.style.backgroundColor = '#ec971f';
                color.style.color = "white";
                break;
            case "danger":
                color.style.backgroundColor = '#c9302c';
                color.style.color = "white";
                break;
            default:
                break;
        }
    }

    button = jQuery("#button_scroll");

    // When the user scrolls down 300px from the top of the document, show the button
    window.onscroll = function() {
        if (jQuery(document).scrollTop() >= 300) {
            button.removeClass('hide_lws');
        } else {
            button.addClass('hide_lws');
        }
    };

    // When the user clicks on the button, scroll to the top of the document
    button.on('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>

<script>
    var prev_id = null;
    var widget_hidden = false;
    var interval_timeout_lws;

    window.addEventListener('DOMContentLoaded', () => {
        const tabs = document.querySelectorAll('.tab_nav_affiliation[role="tab"]');
        const tabList = document.querySelector('#tab_affiliation[role="tablist"]');

        const tabs_banner = document.querySelectorAll('.tab_nav_affiliation_banner[role="tab"]');
        const tabList_banner = document.querySelector('#tab_affiliation_banners_site[role="tablist"]');

        // Add a click event handler to each tab
        tabs.forEach((tab) => {
            tab.addEventListener('click', lws_aff_changeTabs);
        });

        // Add a click event handler to each tab
        tabs_banner.forEach((tab_b) => {
            tab_b.addEventListener('click', lws_aff_changeTabs_banner);
        });
    });

    function lws_aff_selectorMove(target, parent) {
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

    function lws_aff_changeTabs(e) {
        const target = e.target;
        const parent = target.parentNode;
        const grandparent = parent.parentNode;

        // Remove all current selected tabs
        parent
            .querySelectorAll('.tab_nav_affiliation[aria-selected="true"]')
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

        lws_aff_selectorMove(target, parent);
    }

    function lws_aff_changeTabs_banner(e) {
        const target = e.target;
        const parent = target.parentNode;
        const grandparent = parent.parentNode;

        // Remove all current selected tabs
        parent
            .querySelectorAll('.tab_nav_affiliation_banner[aria-selected="true"]')
            .forEach(function(t) {
                t.setAttribute('aria-selected', false);
                t.classList.remove("active")
            });

        // Set this tab as selected
        target.setAttribute('aria-selected', true);
        target.classList.add('active');

        // Hide all tab panels
        grandparent
            .querySelectorAll('.tab-pane.lws-content-page[role="tabpanel"]')
            .forEach((p) => p.setAttribute('hidden', true));

        // Show the selected panel
        grandparent.parentNode
            .querySelector(`#${target.getAttribute('aria-controls')}`)
            .removeAttribute('hidden');

    }

    // Au clic sur une bannière image
    jQuery('.banner_image').click(function() {
        var argz = {
            source: jQuery(this).data('source'),
            type: 'image',
        };
        top.tinymce.activeEditor.windowManager.setParams(argz);
        top.tinymce.activeEditor.windowManager.close();
    });

    // Affiche le formulaire de configuration du Widget
    jQuery('a[id^="open-config-"]').click(function() {
        var id = jQuery(this).attr('id');
        id = id.split('-');
        jQuery('#form-' + id[2]).show('normal');
        if (prev_id != null && prev_id != id[2]) {
            jQuery('#form-' + prev_id).hide('normal');
        }
        prev_id = id[2];
        clearInterval(interval_timeout_lws);
        interval_timeout_lws = setTimeout(() => {
            document.querySelector('#div-' + id[2]).scrollIntoView({
                behavior: 'smooth',
                block: "center",
            });
        }, 500);


    });
    // Masque le formulaire de configuration du Widget
    jQuery('a[id^="cancelWidgetConfig-"]').click(function() {
        var id = jQuery(this).attr('id');
        id = id.split('-');
        jQuery('#form-' + id[1]).hide('normal');
        prev_id = null;
    });
    // Insertion Widget
    jQuery('a[id^="validateWidgetConfig-"]').click(function() {
        var id = jQuery(this).attr('id');
        id = id.split('-');
        id = id[1];

        // code source
        var source = jQuery('#open-config-' + id).data('source');
        // Url à remplacer
        var urlreplace = jQuery('#url-base-' + id).val();
        // Url prim (sans les paramètres modifiables)
        var urlprim = jQuery('#url-prim-' + id).val();

        //le type de widget
        var type = jQuery('#type-widget-' + id).val();
        if (type == 'domain_search') {
            // Extension
            var extension = encodeURI(jQuery('#extensionInput-' + id).val());
            // theme bouton
            var theme = jQuery('#themeSelect-' + id).val();
            // texte bouton
            var textBtn = encodeURI(jQuery('#txtButtonInput-' + id).val());
            if (textBtn.length < 1) {
                textBtn = "Commander";
            }
            // cible
            var target = jQuery('#targetSelect-' + id).val();
            // langue
            var lang = jQuery('#langSelect-' + id).val();

            source = source.replace(urlreplace, urlprim + extension + '/' + theme + '/' + textBtn + '/' +
                target + '/' + lang);

        } else {
            // cible
            var target = jQuery('#targetSelect-' + id).val();
            // langue
            var lang = jQuery('#langSelect-' + id).val();

            source = source.replace(urlreplace, urlprim + target + '/' + lang);
        }

        var argz = {
            source: source,
            type: type,
        };


        top.tinymce.activeEditor.windowManager.setParams(argz);
        top.tinymce.activeEditor.windowManager.close();
    });

    // <div class="select_aff_div">
    // <select name="tab_site_select" id="tab_site_select" class="select_affiliation_banners_site">

    if (window.innerWidth >= 740) {
        //jQuery('#tab_banners_site').removeClass("hidden");
        //jQuery('#tab_banners_site_select').addClass("hidden");
        jQuery('#tab_affiliation').removeClass("hidden");
        jQuery('#tab_site_select').parent().addClass("hidden");
        lws_aff_selectorMove(document.getElementById('nav-banners'), document.getElementById('nav-banners').parentNode);
    }

    jQuery(window).on('resize', function() {

        if (window.innerWidth <= 740) {
            //jQuery('#tab_banners_site').addClass("hidden");
            //jQuery('#tab_banners_site_select').removeClass("hidden");
            //document.getElementById('tab_banners_site_select').value = document.querySelector(
            //    '.tab_nav_affiliation_banner[aria-selected="true"]').id;


            jQuery('#tab_affiliation').addClass("hidden");
            jQuery('#tab_site_select').parent().removeClass("hidden");
            document.getElementById('tab_site_select').value = document.querySelector(
                '.tab_nav_affiliation[aria-selected="true"]').id;
        } else {
            //jQuery('#tab_banners_site').removeClass("hidden");
            //jQuery('#tab_banners_site_select').addClass("hidden");

            jQuery('#tab_affiliation').removeClass("hidden");
            jQuery('#tab_site_select').parent().addClass("hidden");
            const target = document.getElementById(document.getElementById('tab_site_select').value);
            lws_aff_selectorMove(target, target.parentNode);
        }
    });

    jQuery('#tab_banners_site_select').on('change', function() {
        const target = document.getElementById(this.value);
        const parent = target.parentNode;
        const grandparent = parent.parentNode;

        // Remove all current selected tabs
        parent
            .querySelectorAll('.tab_nav_affiliation_banner[aria-selected="true"]')
            .forEach(function(t) {
                t.setAttribute('aria-selected', false);
                t.classList.remove("active")
            });

        // Set this tab as selected
        target.setAttribute('aria-selected', true);
        target.classList.add('active');

        // Hide all tab panels
        grandparent
            .querySelectorAll('.tab-pane.lws-content-page[role="tabpanel"]')
            .forEach((p) => p.setAttribute('hidden', true));

        // Show the selected panel
        grandparent.parentNode
            .querySelector(`#${target.getAttribute('aria-controls')}`)
            .removeAttribute('hidden');
    });

    jQuery('#tab_site_select').on('change', function() {
        const target = document.getElementById(this.value);
        const parent = target.parentNode;
        const grandparent = parent.parentNode;

        // Remove all current selected tabs
        parent
            .querySelectorAll('.tab_nav_affiliation[aria-selected="true"]')
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
    });
</script>

</html>
<!-- End of the Widget iframe-->