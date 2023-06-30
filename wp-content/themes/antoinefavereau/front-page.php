<?php
get_header();
?>

<section id="home">
    <img id="homeAvatar" src="<?= get_template_directory_uri() ?>/assets/dist/images/ReadyPlayerMe-Avatar 1.png" alt="avatar">
    <div class="description">
        <h1>
            <span>ANTOINE</span>
            <span>FAVEREAU</span>
        </h1>
        <p>
            <!-- Je suis étudiant en école d'ingénieur en informatique et freelance en développement web. -->
            I am a french student in computer engineering school and freelance in web development.
        </p>
        <button id="discoverButton" class="hover_button scrollToButton" data-target="#parcours">
            <span>discover</span>
        </button>
    </div>
    <svg class="arrowDown scrollToButton hover" data-target="#parcours" width="50" height="50" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="currentcolor">
        <path d="M6 9l6 6 6-6" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg>
</section>
<section id="parcours">
    <div class="parcoursTitle">
        <svg class="shape" width="1450" height="414" viewBox="0 0 1450 414" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g filter="url(#filter0_d_404_346)">
                <path d="M0 0H1400L1366.14 85.9782C1329.8 178.247 1241.36 239.453 1142.21 240.951L514.282 250.439C336.939 253.118 161.982 291.751 0 364V0Z" fill="url(#paint0_linear_404_346)" />
            </g>
            <defs>
                <filter id="filter0_d_404_346" x="-50" y="-50" width="1500" height="464" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                    <feOffset />
                    <feGaussianBlur stdDeviation="25" />
                    <feComposite in2="hardAlpha" operator="out" />
                    <feColorMatrix type="matrix" values="0 0 0 0 0.0635417 0 0 0 0 0.0635417 0 0 0 0 0.0635417 0 0 0 1 0" />
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_404_346" />
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_404_346" result="shape" />
                </filter>
                <linearGradient id="paint0_linear_404_346" x1="1400" y1="0.000120356" x2="3.15929e-05" y2="364" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FCA311" />
                    <stop offset="1" stop-color="#B0730E" />
                </linearGradient>
            </defs>
        </svg>
        <svg class="shape sm" width="360" height="153" viewBox="0 0 360 153" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g filter="url(#filter0_d_480_145)">
                <path d="M0 0H360V83C240.877 103.516 119.123 103.516 0 83V0Z" fill="url(#paint0_linear_480_145)" />
            </g>
            <defs>
                <filter id="filter0_d_480_145" x="-50" y="-46" width="460" height="198.387" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                    <feOffset dy="4" />
                    <feGaussianBlur stdDeviation="25" />
                    <feComposite in2="hardAlpha" operator="out" />
                    <feColorMatrix type="matrix" values="0 0 0 0 0.0627451 0 0 0 0 0.0627451 0 0 0 0 0.0627451 0 0 0 0.25 0" />
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_480_145" />
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_480_145" result="shape" />
                </filter>
                <linearGradient id="paint0_linear_480_145" x1="360" y1="1.69403e-05" x2="-5.38826e-06" y2="114" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FCA311" />
                    <stop offset="1" stop-color="#B4750F" />
                </linearGradient>
            </defs>
        </svg>
        <h2 class="title">Background</h2>
    </div>
    <div class="verticalLine"></div>
    <div class="parcoursLIst">
        <?php
        query_posts(array(
            'category_name' => 'parcours'
        ));
        if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="item">
                    <h2 class="title"><?= get_the_title() ?></h2>
                    <p class="text upAnimation"><?= get_field("texte") ?></p>
                </div>
        <?php endwhile;
        endif;
        ?>
    </div>
</section>
<section id="competences">
    <h2>SKILLS</h2>

    <div class="swiper swiperCompetences">
        <div class="swiper-wrapper">
            <?php
            query_posts(array(
                'category_name' => 'competences'
            ));
            if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="swiper-slide">
                        <img src="<?= esc_url(get_field('image')['url']) ?>" alt="<?= get_the_title() ?>" title="<?= get_the_title() ?>">
                    </div>
            <?php endwhile;
            endif;
            ?>
        </div>
        <div class="swiper-button-next hover"></div>
        <div class="swiper-button-prev hover"></div>
    </div>
</section>
<section id="projects">
    <h2>My projects</h2>
    <div class="projectList">
        <?php
        query_posts(array(
            'category_name' => 'projets'
        ));
        if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="item upAnimation">
                    <img <?= get_field('lien') ? 'class="hover link" onclick="window.open(\'' . get_field('lien') . '\', \'_blank\')"' : ''; ?> src="<?= esc_url(get_field('image')['url']) ?>" alt="<?= get_the_title() ?>">
                    <div class="content">
                        <h3>
                            <?php if (get_field('lien')) : ?>
                                <a class="hover text" href="<?= esc_url(get_field('lien')) ?>" target="_blank">
                                    <?= get_the_title() ?>
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" stroke-width="1.5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M21 3h-6m6 0l-9 9m9-9v6" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M21 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h6" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round"></path>
                                    </svg>
                                </a>
                            <?php else : ?>
                                <?= get_the_title() ?>
                            <?php endif; ?>
                        </h3>
                        <p><?= get_field('texte') ?></p>
                    </div>
                </div>
        <?php endwhile;
        endif;
        ?>
    </div>
</section>

<section id="contact">
    <div class="left">
        <div class="content upAnimation">
            <h2>Contact me</h2>
            <ul>
                <li><a class="hover text" href="mailto:antoinefavereau45@gmail.com">antoinefavereau45@gmail.com</a></li>
                <li><a class="hover text" href="tel:+33677455362">06 77 45 53 62</a></li>
                <li>D207, 2 rue de la Folie 45000 Orléans</li>
            </ul>
            <div class="links">
                <a class="hover" href="https://www.linkedin.com/in/antoine-favereau" target="_blank" title="linkedin">
                    <svg width="50" height="50" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M23.3333 56.6667V33.3333M70 26.6667V53.3333C70 57.7536 68.2441 61.9928 65.1184 65.1184C61.9928 68.2441 57.7536 70 53.3333 70H26.6667C22.2464 70 18.0072 68.2441 14.8816 65.1184C11.7559 61.9928 10 57.7536 10 53.3333V26.6667C10 22.2464 11.7559 18.0072 14.8816 14.8816C18.0072 11.7559 22.2464 10 26.6667 10H53.3333C57.7536 10 61.9928 11.7559 65.1184 14.8816C68.2441 18.0072 70 22.2464 70 26.6667Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M36.6667 56.6667V45.8334M36.6667 45.8334V33.3334M36.6667 45.8334C36.6667 33.3334 56.6667 33.3334 56.6667 45.8334V56.6667M23.3334 23.3667L23.3667 23.3301" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
                <a class="hover" href="https://github.com/IIgolderII" target="_blank" title="github">
                    <svg width="50" height="50" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M53.3333 73.4235V63.8568C53.4583 62.2673 53.2436 60.6695 52.7033 59.1694C52.1631 57.6694 51.3097 56.3015 50.2 55.1568C60.6666 53.9901 71.6666 50.0235 71.6666 31.8235C71.6658 27.1695 69.8756 22.6941 66.6666 19.3235C68.1861 15.2518 68.0787 10.7513 66.3666 6.75679C66.3666 6.75679 62.4333 5.59012 53.3333 11.6901C45.6933 9.61953 37.6399 9.61953 30 11.6901C20.9 5.59012 16.9666 6.75679 16.9666 6.75679C15.2545 10.7513 15.1471 15.2518 16.6666 19.3235C13.4337 22.7191 11.6417 27.235 11.6666 31.9235C11.6666 49.9901 22.6666 53.9568 33.1333 55.2568C32.0366 56.39 31.1908 57.7415 30.651 59.2232C30.1111 60.7049 29.8893 62.2837 30 63.8568V73.4235M30 66.7568C20 70.0001 11.6666 66.7568 6.66663 56.7568" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
                <a class="hover" href="https://gitlab.com/antoinefavereau45" target="_blank" title="gitlab">
                    <svg width="50" height="50" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M56.8567 8.47999C56.8992 8.34797 56.9818 8.23248 57.093 8.14963C57.2042 8.06677 57.3385 8.02066 57.4772 8.01773C57.6158 8.01479 57.752 8.05518 57.8666 8.13325C57.9812 8.21133 58.0686 8.32322 58.1167 8.45332L68.4967 36.1533L73.1567 48.5867C73.2078 48.7233 73.2126 48.873 73.1705 49.0127C73.1283 49.1524 73.0415 49.2744 72.9233 49.36L40.39 73.0467C40.2761 73.1293 40.139 73.1738 39.9983 73.1738C39.8576 73.1738 39.7205 73.1293 39.6067 73.0467L7.07334 49.36C6.95647 49.2741 6.87079 49.1525 6.82928 49.0135C6.78777 48.8746 6.79271 48.7259 6.84334 48.59L11.5033 36.1567L12.06 34.6567L21.8733 8.45332C21.9214 8.32322 22.0088 8.21133 22.1234 8.13325C22.2381 8.05518 22.3742 8.01479 22.5128 8.01773C22.6515 8.02066 22.7858 8.06677 22.897 8.14963C23.0082 8.23248 23.0908 8.34797 23.1333 8.47999L31.3667 33.8133C31.4108 33.9464 31.4958 34.0621 31.6095 34.1441C31.7232 34.2261 31.8598 34.2701 32 34.27H48C48.1406 34.2699 48.2775 34.2253 48.3913 34.1427C48.505 34.0601 48.5898 33.9436 48.6333 33.81L56.8567 8.47999Z" stroke-width="2" />
                    </svg>
                </a>
                <a class="hover" href="https://codepen.io/IIgolderII" target="_blank" title="codepen">
                    <svg width="50" height="50" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M70 30V50M70 30L40 10M70 30L40 50M10 50V30M10 30L40 50M10 30L40 10M40 70V50M40 10V30" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M40 70L10 50L40 30L70 50L40 70Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="map">
        <iframe width="100px" height="100px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2674.9492585991375!2d1.9124978!3d47.8986674!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e4e4cefe5667e9%3A0x3071ccdfc009558c!2sResidence%20Dessaux!5e0!3m2!1sfr!2sfr!4v1686310383966!5m2!1sfr!2sfr"></iframe>
    </div>
</section>

<div id="cursor"></div>

<?php
get_footer();
