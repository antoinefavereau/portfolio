<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>

<body>
    <div class="progressBar">
        <div class="progressBarInner"></div>
    </div>
    <button class="toTopButton scrollToButton" data-target="#top">
        <svg width="32px" height="32px" stroke-width="2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="currentcolor">
            <path d="M6 15l6-6 6 6" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </button>
    <?php if (is_front_page()) : ?>
        <div id="menu">
            <div class="background"></div>
            <div class="content">
                <a href="<?= get_category_link(get_cat_ID('games')) ?>" id="gamesButton" class="cursorButton" target="_blank">
                    <svg width="40" height="40" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M43.7501 43.75C50.0001 52.5 59.8726 46.0375 57.5001 37.5C53.9376 24.6775 52.0001 17.54 50.9926 13.77C50.7045 12.6905 50.0685 11.7361 49.1831 11.0545C48.2978 10.373 47.2124 10.0024 46.0951 10H13.9051C11.6101 10 9.61011 11.5625 9.05262 13.7875C6.95012 22.1575 5.08262 29.505 2.86012 37.5C0.490119 46.0375 10.3601 52.5 16.6101 43.75M45.0001 21.25L45.0276 21.275M41.2251 17.5L41.2526 17.525M41.2251 25L41.2526 25.025M37.5001 21.25L37.5276 21.275M17.5001 17.5V25M13.7501 21.25H21.2501" stroke="black" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M20 40C21.3261 40 22.5979 39.4732 23.5355 38.5355C24.4732 37.5979 25 36.3261 25 35C25 33.6739 24.4732 32.4021 23.5355 31.4645C22.5979 30.5268 21.3261 30 20 30C18.6739 30 17.4021 30.5268 16.4645 31.4645C15.5268 32.4021 15 33.6739 15 35C15 36.3261 15.5268 37.5979 16.4645 38.5355C17.4021 39.4732 18.6739 40 20 40ZM40 40C41.3261 40 42.5979 39.4732 43.5355 38.5355C44.4732 37.5979 45 36.3261 45 35C45 33.6739 44.4732 32.4021 43.5355 31.4645C42.5979 30.5268 41.3261 30 40 30C38.6739 30 37.4021 30.5268 36.4645 31.4645C35.5268 32.4021 35 33.6739 35 35C35 36.3261 35.5268 37.5979 36.4645 38.5355C37.4021 39.4732 38.6739 40 40 40Z" stroke="black" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

                <ul class="navList">
                    <li class="item hover scrollToButton" data-target="#background"><?= pll_e("background") ?></li>
                    <li class="item hover scrollToButton" data-target="#skills"><?= pll_e("skills") ?></li>
                    <li class="item hover scrollToButton" data-target="#projects"><?= pll_e("projects") ?></li>
                    <li class="item hover scrollToButton" data-target="#services"><?= pll_e("services") ?></li>
                    <li class="item hover scrollToButton" data-target="#footer"><?= pll_e("contact") ?></li>
                </ul>
                <div class="links">
                    <a href="https://www.linkedin.com/in/antoine-favereau" class="cursorButton" title="linkedin" target="_blank">
                        <svg width="60" height="60" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23.3333 56.6667V33.3333M70 26.6667V53.3333C70 57.7536 68.2441 61.9928 65.1184 65.1184C61.9928 68.2441 57.7536 70 53.3333 70H26.6667C22.2464 70 18.0072 68.2441 14.8816 65.1184C11.7559 61.9928 10 57.7536 10 53.3333V26.6667C10 22.2464 11.7559 18.0072 14.8816 14.8816C18.0072 11.7559 22.2464 10 26.6667 10H53.3333C57.7536 10 61.9928 11.7559 65.1184 14.8816C68.2441 18.0072 70 22.2464 70 26.6667Z" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M36.6666 56.6667V45.8334M36.6666 45.8334V33.3334M36.6666 45.8334C36.6666 33.3334 56.6666 33.3334 56.6666 45.8334V56.6667M23.3333 23.3667L23.3666 23.3301" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <a href="https://github.com/IIgolderII" class="cursorButton" title="github" target="_blank">
                        <svg width="60" height="60" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M53.3334 73.4235V63.8568C53.4585 62.2673 53.2437 60.6695 52.7035 59.1694C52.1632 57.6694 51.3098 56.3015 50.2001 55.1568C60.6667 53.9901 71.6667 50.0235 71.6667 31.8235C71.6659 27.1695 69.8757 22.6941 66.6667 19.3235C68.1863 15.2518 68.0788 10.7513 66.3667 6.75679C66.3667 6.75679 62.4334 5.59012 53.3334 11.6901C45.6934 9.61953 37.6401 9.61953 30.0001 11.6901C20.9001 5.59012 16.9667 6.75679 16.9667 6.75679C15.2547 10.7513 15.1472 15.2518 16.6667 19.3235C13.4338 22.7191 11.6418 27.235 11.6667 31.9235C11.6667 49.9901 22.6667 53.9568 33.1334 55.2568C32.0367 56.39 31.191 57.7415 30.6511 59.2232C30.1113 60.7049 29.8894 62.2837 30.0001 63.8568V73.4235M30.0001 66.7568C20.0001 70.0001 11.6667 66.7568 6.66675 56.7568" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <a href="https://gitlab.com/antoinefavereau45" class="cursorButton" title="gitlab" target="_blank">
                        <svg width="60" height="60" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M56.8565 8.47999C56.899 8.34797 56.9817 8.23248 57.0929 8.14963C57.2041 8.06677 57.3384 8.02066 57.477 8.01773C57.6157 8.01479 57.7518 8.05518 57.8665 8.13325C57.9811 8.21133 58.0685 8.32322 58.1165 8.45332L68.4966 36.1533L73.1566 48.5867C73.2076 48.7233 73.2125 48.873 73.1703 49.0127C73.1282 49.1524 73.0414 49.2744 72.9232 49.36L40.3899 73.0467C40.276 73.1293 40.1389 73.1738 39.9982 73.1738C39.8575 73.1738 39.7204 73.1293 39.6065 73.0467L7.07322 49.36C6.95635 49.2741 6.87066 49.1525 6.82916 49.0135C6.78765 48.8746 6.79259 48.7259 6.84322 48.59L11.5032 36.1567L12.0599 34.6567L21.8732 8.45332C21.9213 8.32322 22.0087 8.21133 22.1233 8.13325C22.2379 8.05518 22.3741 8.01479 22.5127 8.01773C22.6514 8.02066 22.7857 8.06677 22.8969 8.14963C23.0081 8.23248 23.0907 8.34797 23.1332 8.47999L31.3665 33.8133C31.4107 33.9464 31.4957 34.0621 31.6094 34.1441C31.7231 34.2261 31.8597 34.2701 31.9999 34.27H47.9999C48.1405 34.2699 48.2774 34.2253 48.3912 34.1427C48.5049 34.0601 48.5896 33.9436 48.6332 33.81L56.8565 8.47999Z" stroke="currentcolor" stroke-width="2" />
                        </svg>
                    </a>
                    <a href="https://codepen.io/IIgolderII" class="cursorButton" title="codepen" target="_blank">
                        <svg width="60" height="60" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M70 30V50M70 30L40 10M70 30L40 50M10 50V30M10 30L40 50M10 30L40 10M40 70V50M40 10V30" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M40 70L10 50L40 30L70 50L40 70Z" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <header id="header">
        <a href="<?= get_home_url() ?>" id="logo" class="cursorButton">
            <svg width="100" height="88" viewBox="0 0 100 88" xmlns="http://www.w3.org/2000/svg">
                <g>
                    <path d="M57.0532 0H42.9431L0 74.1673L7.66775 87.4438H92.3286L100.002 74.1562L57.0532 0ZM16.5794 72.9642L49.9981 15.0384L83.4169 72.9642H16.5794Z" />
                    <path d="M40.5406 69.9807C39.267 69.9807 37.1691 67.7918 38.3127 65.911L55.2078 36.7755C56.409 34.7332 58.9042 34.6738 60.0182 36.7755L66.3306 47.5344C66.618 48.0076 66.7699 48.5506 66.7699 49.1042C66.7699 49.6578 66.618 50.2008 66.3306 50.6739L55.5624 69.4256C55.3247 69.7542 54.337 69.9937 53.5535 69.9826L40.5406 69.9807Z" />
                    <path d="M73.2316 5.38783C74.0188 3.87656 76.8687 3.79302 77.6875 5.38783L84.1336 16.5033C84.3568 16.9185 84.4737 17.3825 84.4737 17.8539C84.4737 18.3254 84.3568 18.7894 84.1336 19.2046L79.6072 27.097C78.8478 28.2592 76.1223 28.1868 75.4113 27.097L68.7275 15.5546C68.3729 14.9307 68.3562 13.9505 68.7275 13.3508L73.2316 5.38783Z" />
                </g>
            </svg>
        </a>
        <div id="nav">
            <div id="language">
                <?php $langs_array = pll_the_languages(array('dropdown' => 1, 'hide_current' => 0, 'raw' => 1)); ?>
                <?php foreach ($langs_array as $lang) : ?>
                    <a href="<?= $lang['url'] ?>" class="hover<?= ($lang['slug'] == pll_current_language()) ? " active" : "" ?>">
                        <?= $lang['slug'] ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php if (is_front_page()) : ?>
                <button id="menuButton" class="cursorButton" title="menu">
                    <div></div>
                    <div></div>
                </button>
            <?php endif; ?>
        </div>
    </header>