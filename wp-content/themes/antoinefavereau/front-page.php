<?php

get_header();

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

?>

<div id="loader">
    <span></span>
</div>

<section id="home" class="vw-100 vh-100" style="background-image: url('<?= get_template_directory_uri() ?>/assets/dist/images/Image de fond.jpg');">
    <header class="position-absolute top-0 start-0 w-100 d-flex justify-content-sm-end justify-content-around pt-3 pb-5">
        <a href="#about" class="lienHeader p-2 text-decoration-none text-reset">
            <span class="d-none d-sm-block">ABOUT</span>
            <svg class="d-sm-none" width="40" height="40" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <title>About</title>
                <path d="M5 20V19C5 15.134 8.13401 12 12 12V12C15.866 12 19 15.134 19 19V20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 12C14.2091 12 16 10.2091 16 8C16 5.79086 14.2091 4 12 4C9.79086 4 8 5.79086 8 8C8 10.2091 9.79086 12 12 12Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
        <a href="#portfolio" class="lienHeader p-2 text-decoration-none text-reset">
            <span class="d-none d-sm-block">PORTFOLIO</span>
            <svg class="d-sm-none icon icon-tabler icon-tabler-briefcase" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <title>Portfolio</title>
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <rect x="3" y="7" width="18" height="13" rx="2" />
                <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                <line x1="12" y1="12" x2="12" y2="12.01" />
                <path d="M3 13a20 20 0 0 0 18 0" />
            </svg>
        </a>
        <a href="#contact" class="lienHeader p-2 text-decoration-none text-reset">
            <span class="d-none d-sm-block">CONTACT</span>
            <svg class="d-sm-none icon icon-tabler icon-tabler-notebook" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <title>Contact</title>
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18" />
                <line x1="13" y1="8" x2="15" y2="8" />
                <line x1="13" y1="12" x2="15" y2="12" />
            </svg>
        </a>
    </header>
    <div class="titre position-absolute top-50 start-0 translate-middle-y">
        <h1>Antoine<br>Favereau<span></span></h1>
        <h2 class="mt-5">> Développeur web.</h2>
    </div>
    <div class="scrollIndicator position-absolute end-0 bottom-0 me-5 mb-5"></div>
</section>

<section id="about" class="position-relative w-100 px-4 px-sm-5">
    <svg class="angle d-none d-lg-block position-absolute bottom-0 end-0" width="200" height="200" viewBox="0 0 210 210" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M205 5V205H5" stroke="#B9B9B9" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
    <div class="w-100 row gx-0 row-cols-1 row-cols-lg-2">
        <div class="col">
            <h1 class="position-relative text-uppercase text-center fw-bold mx-auto">about</h1>
            <div class="liste d-flex flex-column container text-start">
                <h2 id="btnAboutFormations" class="active py-3 my-2">Formations</h2>
                <h2 id="btnAboutCompetences" class="py-3 my-2">Compétences</h2>
                <h2 id="btnAboutExperiences" class="py-3 my-2">Expériences</h2>
            </div>
        </div>
        <div class="col position-relative">
            <div id="swiperAboutFormations" class="active swiper swiperAbout">
                <div class="swiper-wrapper">
                    <?php foreach ($formations as $formation) : ?>
                        <div class="swiper-slide py-4 px-3 px-sm-4 overflow-auto">
                            <h3 class="text-uppercase text-center mt-3"><?= $formation['info'] ?></h3>
                            <ul class="mt-5 ps-3">
                                <?php foreach ($formation['details'] as $detail) : ?>
                                    <li>
                                        <p class="text-start"><?= $detail ?></p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div id="swiperAboutCompetences" class="swiper swiperAbout">
                <div class="swiper-wrapper">
                    <?php foreach ($competences as $competence) : ?>
                        <div class="swiper-slide py-4 px-3 px-sm-4 overflow-auto">
                            <h3 class="text-uppercase text-center mt-3"><?= $competence['info'] ?></h3>
                            <ul class="mt-5 ps-3">
                                <?php foreach ($competence['details'] as $detail) : ?>
                                    <li>
                                        <p class="text-start"><?= $detail ?></p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div id="swiperAboutExperiences" class="swiper swiperAbout">
                <div class="swiper-wrapper">
                    <?php foreach ($experiences as $experience) : ?>
                        <div class="swiper-slide py-4 px-3 px-sm-4 overflow-auto">
                            <h3 class="text-uppercase text-center mt-3"><?= $experience['info'] ?></h3>
                            <ul class="mt-5 ps-3">
                                <?php foreach ($experience['details'] as $detail) : ?>
                                    <li>
                                        <p class="text-start"><?= $detail ?></p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section>

<section id="portfolio" class="position-relative w-100 px-4 px-sm-5">
    <svg class="angle d-none d-lg-block position-absolute top-0 start-0 ms-5 mt-5" width="200" height="200" viewBox="0 0 210 210" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M205 5H5V205" stroke="#B9B9B9" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
    <h1 class="position-relative text-uppercase text-center fw-bold mx-auto">portfolio</h1>
    <div id="swiperPortfolio" class="swiper mx-3 mx-sm-4 mx-lg-5">
        <div class="swiper-wrapper">
            <?php foreach ($portfolio as $realisation) : ?>
                <div class="swiper-slide">
                    <img src="<?= $realisation['image'] ?>" class="w-100 h-100" alt="">
                    <a href="<?= $realisation['lien'] ?>" class="description d-block text-reset text-decoration-none position-absolute w-100 h-100 start-0 bottom-0 p-3" target="blanc">
                        <h3 class="text-center fw-bold"><?= $realisation['info'] ?></h3>
                        <hr>
                        <ul class="mt-5">
                            <?php foreach ($realisation['details'] as $detail) : ?>
                                <li class="my-3"><?= $detail ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </a>
                    <svg class="d-block position-absolute end-0 bottom-0 me-4 mb-4" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 3L15 3M21 3L12 12M21 3V9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M21 13V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V5C3 3.89543 3.89543 3 5 3H11" stroke="currentColor" stroke-linecap="round" />
                    </svg>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="d-flex justify-content-center mt-5 mb-2">
            <div class="swiper-button-prev-arrow mx-5">
                <svg width="70" height="40" viewBox="0 0 91 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M88.9167 27.1667L2.00002 27.1667" stroke="white" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M26.8333 2.33341L1.99998 27.1667" stroke="white" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M26.8333 52L1.99998 27.1667" stroke="white" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div class="swiper-button-next-arrow mx-5">
                <svg width="70" height="40" viewBox="0 0 91 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 26.8333H88.9167" stroke="white" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M64.0834 51.6666L88.9167 26.8333" stroke="white" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M64.0834 2L88.9167 26.8333" stroke="white" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </div>
    </div>
</section>

<section id="contact" class="position-relative w-100">
    <svg class="angle d-none d-lg-block position-absolute top-0 end-0 me-5 mt-5" width="200" height="200" viewBox="0 0 210 210" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M5 5H205V205" stroke="#B9B9B9" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
    <h1 class="position-relative text-uppercase text-center fw-bold mx-auto">Contact</h1>
    <h4 class="opacity-75 text-center text-nowrap mt-5">Me contacter pour <span class="txt-type" data-speed="80" data-wait="15" data-words='["un projet ?", "une question ?", "une proposition ?"]'></span></h4>
    <!-- <aside id="socialMedias" class="position-absolute d-flex flex-column ms-5">
        <?php foreach ($socialMedias as $socialMedia) : ?>
            <a class="position-relative p-3" href="<?= $socialMedia['lien'] ?>" target="blanc">
                <div class="bgImage position-absolute start-0 top-0 w-100 h-100" style="background: <?= $socialMedia['couleur'] ?>"></div>
                <?= $socialMedia['svg'] ?>
            </a>
        <?php endforeach; ?>
    </aside> -->
    <form method="post" class="container">
        <div class="row py-4 px-4">
            <div class="col-6 position-relative mt-5 px-3">
                <input id="contact_nom" name="nom" type="text" class="input w-100" placeholder=" ">
                <label class="label" for="contact_nom">Nom</label>
                <div class="ligne"></div>
            </div>
            <div class="col-6 position-relative mt-5 px-3">
                <input id="contact_mail" name="email" type="email" class="input w-100" placeholder=" " required>
                <label for="contact_mail">Mail</label>
                <div class="ligne"></div>
            </div>
            <div class="col-12 position-relative mt-5 px-3">
                <input id="contact_objet" name="objet" type="text" class="input w-100" placeholder=" ">
                <label for="contact_objet">Objet</label>
                <div class="ligne"></div>
            </div>
            <div class="col-12 position-relative mt-5 px-3">
                <textarea id="contact_message" name="message" class="input w-100" rows="4" placeholder=" " required></textarea>
                <label for="contact_message">Message</label>
                <div class="ligne"></div>
            </div>

        </div>
        <button type="submit" id="contact_submit" class="position-relative start-50 translate-middle-x border-0 mt-5 mb-5 py-3 px-5">
            Envoyer
        </button>
    </form>
    <?php
    if (isset($_POST['message'])) {
        $destMail = 'antoinefavereau45@gmail.com';

        $nom = isset($_POST['nom']) ? $_POST['nom'] : 'Anonyme';
        $mail = $_POST['email'];
        $objet = isset($_POST['objet']) ? 'Site : ' . $_POST['objet'] : 'Site : Sans titre';
        $message = $_POST['message'];

        $headers = array(
            'From' => $mail,
            'Reply-To' => $mail,
        );

        $retour = mail($destMail, $objet, $message, $headers);
        if ($retour) {
            echo "<script>alert('Message envoyé.')</script>";
        } else {
            echo "<script>alert('Echec de l\'envoi.')</script>";
        }
    }
    ?>
</section>

<div id="scrollBar" class="position-fixed top-0 start-0"></div>
<button id="goTop" class="position-fixed bottom-0 end-0 p-0 rounded-circle bg-transparent" onclick="goTop()">
    <canvas id="canvasGoTop" class="w-100 h-100"></canvas>
    <svg class="position-absolute start-50 top-50 translate-middle" width="40" height="40" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M58.5 48.75L39 29.25L19.5 48.75" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</button>

<?php
get_footer();
