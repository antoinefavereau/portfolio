<?php
get_header();
?>

<div id="maintenance">maintenance en cours</div>
<section id="home">
    <img id="homeAvatar" src="<?= get_template_directory_uri() ?>/assets/dist/images/ReadyPlayerMe-Avatar 1.png" alt="avatar">
    <div class="description">
        <h1><span>ANTOINE</span><br><span>FAVEREAU</span></h1>
        <p>
            Je suis étudiant en école d’ingénieur en informatique et freelance en développement web.
        </p>
        <button id="discoverButton" class="hover_button">
            <span>découvrir</span>
        </button>
    </div>
    <svg class="arrowDown" width="50" height="50" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="currentcolor">
        <path d="M6 9l6 6 6-6" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg>
</section>
<section id="parcours">
    <div class="parcoursContainer">
        <div class="brand" data-text="PARCOURS" data-left="0"></div>
        <div class="divParcours">
            <div class="parcoursLeft">
                <?php
                query_posts(array(
                    'category_name' => 'parcours'
                ));
                if (have_posts()) : while (have_posts()) : the_post();
                        echo '<div class="parcours" data-id="' . get_the_ID() . '" data-titre-cours="' . get_the_title() . '" data-titre-long="' . get_field("titre_long") . '" data-date-debut="' . get_field("date_debut") . '" data-date-fin="' . get_field("date_fin") . '" data-texte="' . get_field("texte") . '"></div>';
                    endwhile;
                endif;
                ?>
                <div class="barreVerticale"></div>
                <div class="barreSelection" data-label=""></div>
            </div>
            <div class="parcoursRight">
                <h2 class="titre"></h2>
                <p class="texte"></p>
            </div>
        </div>
    </div>
</section>
<section id="competences">

</section>
<svg class="toTop" width="80px" height="80px" transform="rotate(-90)">
    <circle cx="40" cy="40" r="30" />
</svg>
<div id="cursor"></div>

<?php
get_footer();
