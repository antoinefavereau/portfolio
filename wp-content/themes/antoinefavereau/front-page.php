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
            Je suis étudiant en école d'ingénieur en informatique et freelance en développement web.
        </p>
        <button id="discoverButton" class="hover_button scrollToButton" data-target="#parcours">
            <span>découvrir</span>
        </button>
    </div>
    <svg class="arrowDown" width="50" height="50" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="currentcolor">
        <path d="M6 9l6 6 6-6" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg>
</section>
<section id="parcours">
    <div class="parcoursTitle">
        <svg class="shape" width="1450" height="414" viewBox="0 0 1450 414" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g filter="url(#filter0_d_348_143)">
                <path d="M0 0H1400L1366.14 85.9782C1329.8 178.247 1241.36 239.453 1142.21 240.951L514.282 250.439C336.939 253.118 161.982 291.751 0 364V0Z" fill="#FCA311" />
            </g>
            <defs>
                <filter id="filter0_d_348_143" x="-50" y="-50" width="1500" height="464" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                    <feOffset />
                    <feGaussianBlur stdDeviation="25" />
                    <feComposite in2="hardAlpha" operator="out" />
                    <feColorMatrix type="matrix" values="0 0 0 0 0.0635417 0 0 0 0 0.0635417 0 0 0 0 0.0635417 0 0 0 1 0" />
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_348_143" />
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_348_143" result="shape" />
                </filter>
            </defs>
        </svg>
        <h2 class="title">Mon parcours</h2>
    </div>
    <div class="parcoursLIst">
        <?php
        query_posts(array(
            'category_name' => 'parcours'
        ));
        if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="item">
                    <h2 class="title"><?= get_the_title() ?></h2>
                    <p class="text"><?= get_field("texte") ?></p>
                </div>
        <?php endwhile;
        endif;
        ?>
    </div>
    <!-- <div class="parcoursContainer">
        <div id="parcoursTitleList"><span>PARCOURS</span></div>
        <div class="divParcours">
            <div class="parcoursLeft">
                <div class="barreVerticale"></div>
                <div class="barreSelection" data-label=""></div>
            </div>
            <div class="parcoursRight">
                <?php
                query_posts(array(
                    'category_name' => 'parcours'
                ));
                if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <div class="parcoursRightContainer" data-id="<?= get_the_ID() ?>" data-titre-cours="<?= get_the_title() ?>" data-date-debut="<?= get_field("date_debut") ?>" data-date-fin="<?= get_field("date_fin") ?>">
                            <h2 class="titre"><?= get_field("titre_long") ?></h2>
                            <p class="texte"><?= get_field("texte") ?></p>
                        </div>
                <?php endwhile;
                endif;
                ?>
            </div>
        </div>
        <div class="progressBarContainer"><div class="progressBar"></div></div>
    </div> -->
</section>
<!-- <section id="competences">
    <div id="competencesTitleList"><span>COMPÉTENCES</span></div>
</section> -->
<!-- <svg class="toTop scrollToButton" data-target="#home" width="80px" height="80px" transform="rotate(-90)">
    <circle cx="40" cy="40" r="30" />
</svg> -->
<div id="cursor"></div>

<?php
get_footer();
