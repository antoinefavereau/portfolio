<?php

$formations = array(
    array(
        "info" => "Cesi",
        "details" => array(
            "Première année de cycle ingénieur (en cours)",
            "Deuxième année de prépa intégrée",
            "Première année de prépa intégrée",
        ),
    ),
    array(
        "info" => "Lycée François Villon",
        "details" => array(
            "Terminale scientifique option Sciences de l'Ingénieur",
            "1ère scientifique option Sciences de l'Ingénieur",
            "2nd générale options Sciences de l'Ingénieur et Création et Innovation Technologiques",
        ),
    ),
);

$competences = array(
    array(
        "info" => "Développement WEB",
        "details" => array(
            "PHP, HTML, CSS, JavaScript",
            "Bootstrap, JQuery, Smarty",
            "Wordpress, Prestashop, Drupal",
            "création de plusieurs sites web",
        ),
    ),
    array(
        "info" => "Bases de données",
        "details" => array(
            "dictionnaire de données, MCD, MLD, MPD, requêtes SQL",
            "projet de site web et d'application avec BDD",
        ),
    ),
    array(
        "info" => "Conception et programmation objet",
        "details" => array(
            "langage C++/CLI",
            "projet d'application en lien avec une base de données",
        ),
    ),
);

$experiences = array(
    array(
        "info" => "CDD Xapiema",
        "details" => array(
            "du 18 juillet au 9 septembre 2022 (2 mois)",
            "développement web",
            "<a href='http://www.xapiema.fr/' target='blanc'>Lien du site</a>",
        ),
    ),
    array(
        "info" => "Stage Xapiema",
        "details" => array(
            "du 4 avril au 15 juillet 2022 (15 semaines)",
            "développement web",
            "<a href='http://www.xapiema.fr/' target='blanc'>Lien du site</a>",
        ),
    ),
);

$portfolio = array(
    array(
        "info" => "Les échappées à vélo",
        "details" => array(
            "Chez Xapiema",
            "Participation au développement",
            "Site Wordpress",
        ),
        "image" => get_template_directory_uri() . "/assets/dist/images/echappees a velo.jpg",
        "lien" => "https://www.echappeesavelo.fr/",
    ),
    array(
        "info" => "Europe 22",
        "details" => array(
            "Chez Xapiema",
            "Participation au développement",
            "Site Wordpress",
            "En cours",
        ),
        "image" => get_template_directory_uri() . "/assets/dist/images/europe22.jpg",
        "lien" => get_template_directory_uri() . "/assets/dist/images/europe22.jpg",
    ),
    array(
        "info" => "SRMA",
        "details" => array(
            "Chez Xapiema",
            "Participation au développement",
            "Site Wordpress",
            "En cours",
        ),
        "image" => get_template_directory_uri() . "/assets/dist/images/srma.jpg",
        "lien" => get_template_directory_uri() . "/assets/dist/images/srma.jpg",
    ),
);

$socialMedias = array(
    array(
        'svg' => '
            <svg stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M3 16V8C3 5.23858 5.23858 3 8 3H16C18.7614 3 21 5.23858 21 8V16C21 18.7614 18.7614 21 16 21H8C5.23858 21 3 18.7614 3 16Z" stroke="currentColor" stroke-width="1.5"/>
                <path d="M17.5 6.51L17.51 6.49889" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        ',
        'couleur' => 'radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%,#d6249f 60%,#285AEB 90%)',
        'lien' => 'https://www.instagram.com/antoine_fav/',
    ),
    array(
        'svg' => '
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-linkedin" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <rect x="4" y="4" width="16" height="16" rx="2" />
                <line x1="8" y1="11" x2="8" y2="16" />
                <line x1="8" y1="8" x2="8" y2="8.01" />
                <line x1="12" y1="16" x2="12" y2="11" />
                <path d="M16 16v-3a2 2 0 0 0 -4 0" />
            </svg>
        ',
        'couleur' => '#0A66C2',
        'lien' => 'https://www.linkedin.com/in/antoine-favereau-a15740229/',
    ),
    array(
        'svg' => '
        <svg stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M21 9V15" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M3 15V9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12 21V15" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12 3V9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12 15L3 9L12 3L21 9L12 15Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12 21L3 15L12 9L21 15L12 21Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        ',
        'couleur' => '#000',
        'lien' => 'https://codepen.io/IIgolderII',
    ),
);
