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
    <svg class="arrowDown" width="50" height="50" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="currentcolor">
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
        <h2 class="title">My cursus</h2>
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
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
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
                <div class="item">
                    <a class="" href="<?= esc_url(get_field('lien')) ?>" target="_blank">
                        <img src="<?= esc_url(get_field('image')['url']) ?>" alt="<?= get_the_title() ?>">
                    </a>
                    <div class="content">
                        <h3><?= get_the_title() ?></h3>
                        <p><?= get_field('texte') ?></p>
                    </div>
                </div>
        <?php endwhile;
        endif;
        ?>
    </div>
</section>
<!-- <svg class="toTop scrollToButton" data-target="#home" width="80px" height="80px" transform="rotate(-90)">
    <circle cx="40" cy="40" r="30" />
</svg> -->
<div id="cursor"></div>

<?php
get_footer();
