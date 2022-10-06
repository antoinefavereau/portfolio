<?php

get_header();

require('variables.php');

?>

<div id="loader">
    <span></span>
</div>

<aside id="sideBar" class="position-fixed h-100 d-flex flex-column justify-content-between align-items-center">
    <a class="logo" href="">
        <img src="<?= get_template_directory_uri() ?>/assets/dist/images/logo.png" alt="logo">
    </a>
    <div class="d-flex flex-grow-1 flex-column justify-content-around align-items-center my-2">
        <a href="#home" data-bs-toggle="tooltip" data-bs-title="Home">
            <svg class="icon icon-tabler icon-tabler-home" width="60" height="60" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <title>Home</title>
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <polyline points="5 12 3 12 12 3 21 12 19 12" />
                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
            </svg>
        </a>
        <a href="#about">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <title>About</title>
                <path d="M5 20V19C5 15.134 8.13401 12 12 12V12C15.866 12 19 15.134 19 19V20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 12C14.2091 12 16 10.2091 16 8C16 5.79086 14.2091 4 12 4C9.79086 4 8 5.79086 8 8C8 10.2091 9.79086 12 12 12Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
        <a href="#portfolio">
            <svg class="icon icon-tabler icon-tabler-briefcase" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <title>Portfolio</title>
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <rect x="3" y="7" width="18" height="13" rx="2" />
                <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                <line x1="12" y1="12" x2="12" y2="12.01" />
                <path d="M3 13a20 20 0 0 0 18 0" />
            </svg>
        </a>
        <a href="#contact">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" color="currentcolor">
                <path d="M7 9l5 3.5L17 9" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M2 17V7a2 2 0 012-2h16a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2z" stroke="currentcolor"></path>
            </svg>
        </a>
    </div>
    <?= get_category_link('cours') ?>
    <a class="cours w-100" href="<?= get_category_link(get_cat_ID('cours')) ?>">
        <svg class="d-block mx-auto" width="60" height="60" viewBox="0 0 24 24" fill="none">
            <path d="M5 19.5V5a2 2 0 012-2h11.4a.6.6 0 01.6.6V21M9 7h6M6.5 15H19M6.5 18H19M6.5 21H19" stroke="currentcolor" stroke-linecap="round"></path>
            <path d="M6.5 18c-1 0-1.5-.672-1.5-1.5S5.5 15 6.5 15M6.5 21c-1 0-1.5-.672-1.5-1.5S5.5 18 6.5 18" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </a>
</aside>

<main id="main" class="position-relative">
    <section id="home" class="position-relative w-100 vh-100">
        <div class="position-absolute start-50 top-50 translate-middle d-flex flex-column align-items-center">
            <img id="imagePhoto" src="<?= get_template_directory_uri() ?>/assets/dist/images/photo2.jpg" alt="photo de profil">
            <h1 class="mt-3 text-center">Antoine Favereau</h1>
            <h2 class="mt-1 text-center">Je suis un <span class="txt-type" data-speed="60" data-wait="20" data-words='["étudiant ingénieur", "développeur web en freelance", "génie"]'></span></h2>
        </div>
        <div class="scrollIndicator position-absolute end-0 bottom-0 me-5 mb-5"></div>
    </section>

    <section id="about" class="position-relative w-100 px-4 px-sm-5">
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
                    <svg width="70" height="40" viewBox="0 0 91 54" fill="none">
                        <path d="M88.9167 27.1667L2.00002 27.1667" stroke="currentcolor" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M26.8333 2.33341L1.99998 27.1667" stroke="currentcolor" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M26.8333 52L1.99998 27.1667" stroke="currentcolor" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="swiper-button-next-arrow mx-5">
                    <svg width="70" height="40" viewBox="0 0 91 54" fill="none">
                        <path d="M2 26.8333H88.9167" stroke="currentcolor" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M64.0834 51.6666L88.9167 26.8333" stroke="currentcolor" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M64.0834 2L88.9167 26.8333" stroke="currentcolor" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="position-relative w-100">
        <h1 class="position-relative text-uppercase text-center fw-bold mx-auto">Contact</h1>
        <!-- <h4 class="opacity-75 text-center text-nowrap mt-5">Me contacter pour <span class="txt-type" data-speed="80" data-wait="15" data-words='["un projet ?", "une question ?", "une proposition ?"]'></span></h4> -->
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
            <button type="submit" id="contact_submit" class="position-relative start-50 translate-middle-x border-0 mt-5 mb-5 py-3 px-5 rounded-pill">
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
</main>


<script src="<?= get_template_directory_uri() ?>\assets\sources\js\front-page.js"></script>

<?php
get_footer();
