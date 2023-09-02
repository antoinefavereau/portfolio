<?php
get_header();
?>

<section id="top">
    <div class="backgroundContainer">
        <svg class="backgroundSvg" xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentcolor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" pathLength="1" />
            <path d="M3 5a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1v-10z" pathLength="1" />
            <path d="M7 20h10" pathLength="1" />
            <path d="M9 16v4" pathLength="1" />
            <path d="M15 16v4" pathLength="1" />
        </svg>
        <svg class="backgroundSvg" xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentcolor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" pathLength="1" />
            <path d="M6 5a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-14z" pathLength="1" />
            <path d="M11 4h2" pathLength="1" />
            <path d="M12 17v.01" pathLength="1" />
        </svg>
        <svg class="backgroundSvg" width="24px" height="24px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.5 6L10 18.5M6.5 8.5L3 12l3.5 3.5M17.5 8.5L21 12l-3.5 3.5" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" pathLength="1"></path>
        </svg>
        <svg class="backgroundSvg" width="24px" stroke-width="1.5" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 21H8c-1.105 0-2-.894-2-1.999V14c0-1-1.5-2-1.5-2S6 11 6 10V5a2 2 0 012-2h1M15 21h1c1.105 0 2-.894 2-1.999V14c0-1 1.5-2 1.5-2S18 11 18 10V5a2 2 0 00-2-2h-1" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" pathLength="1"></path>
        </svg>
    </div>
    <div class="text">
        <h1 class="topSectionUpElasticAnimation">Antoine<span class="underscore">_ </span>Favereau</h1>
        <p class="topSectionUpElasticAnimation"><?= pll_e("French student in computer engineering school and freelance in web development.") ?></p>
    </div>
    <button class="discover button scrollToButton topSectionUpElasticAnimation" data-target="#background"><?= pll_e("discover") ?></button>
    <svg class="bottom" width="1920" height="100" viewBox="0 0 1920 100" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 0.000183105C960 100 960 100 1920 0.000183105V100H0V0.000183105Z" fill="#EEEEEE" />
        <path d="M-2 23C963 113.5 966.5 114.5 1921 24.5" stroke="#222831" stroke-opacity="0.3" stroke-width="4" />
    </svg>
</section>

<section id="background" class="section">
    <h2 class="h2"><?= pll_e("background") ?></h2>
    <h1 class="h1"><?= pll_e("See my studies and experience") ?></h1>
    <div class="content">
        <div class="verticalLine"></div>
        <div class="parcoursLIst">
            <?php
            query_posts(array(
                'category_name' => "parcours-" . pll_current_language()
            ));
            if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="item">
                        <h3 class="title"><?= get_the_title() ?></h3>
                        <p class="text">
                            <?= get_field("texte") ?>
                        </p>
                    </div>
            <?php endwhile;
            endif;
            ?>
        </div>
    </div>
</section>

<section id="skills" class="section">
    <h2 class="h2"><?= pll_e("skills") ?></h2>
    <h1 class="h1"><?= pll_e("All the technologies I am familiar with") ?></h1>
    <div class="skillsList">
        <ul class="hexGrid">
            <?php
            query_posts(array(
                'category_name' => "competences-" . pll_current_language()
            ));
            if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <li class="hex">
                        <div class="hexIn">
                            <img src="<?= esc_url(get_field('image')['url']) ?>" alt="<?= get_the_title() ?>">
                            <p><?= get_the_title() ?></p>
                        </div>
                    </li>
            <?php endwhile;
            endif;
            ?>
        </ul>
    </div>
</section>

<section id="projects" class="section">
    <h2 class="h2"><?= pll_e("projects") ?></h2>
    <h1 class="h1"><?= pll_e("The different projects I worked on") ?></h1>
    <ul class="projectsList">

        <?php
        query_posts(array(
            'category_name' => "projets-" . pll_current_language()
        ));
        if (have_posts()) : while (have_posts()) : the_post(); ?>
                <li class="item">
                    <p class="number">01</p>
                    <h3 class="responsiveTitle"><a href="" target="_blank"><?= get_the_title() ?></a></h3>
                    <a href="<?= esc_url(get_field('lien')) ?>" class="imgContainer" target="_blank">
                        <img src="<?= esc_url(get_field('image')['url']) ?>" alt="<?= get_the_title() ?>">
                    </a>
                    <div class="description">
                        <h3 class="title"><a href="<?= esc_url(get_field('lien')) ?>" target="_blank"><?= get_the_title() ?></a></h3>
                        <p class="text">
                            <?= get_field('texte') ?>
                        </p>
                    </div>
                </li>
                <li>
                    <hr>
                </li>
        <?php endwhile;
        endif;
        ?>
    </ul>
</section>

<section id="services" class="section">
    <h2 class="h2"><?= pll_e("services") ?></h2>
    <h1 class="h1"><?= pll_e("You have a project ?") ?></h1>
    <div class="background"></div>
    <ul class="servicesList">
        <li class="item">
            <h3><?= pll_e("Front-end") ?></h3>
            <ul class="infoList">
                <li><?= pll_e("need your design") ?></li>
                <li><?= pll_e("quick result") ?></li>
            </ul>
            <button class="button" data-value="Front-end">
                <?= pll_e("select") ?>
            </button>
        </li>
        <li class="item">
            <h3><?= pll_e("Basic website") ?></h3>
            <ul class="infoList">
                <li><?= pll_e("branding or biography") ?></li>
                <li><?= pll_e("portfolio") ?></li>
                <li><?= pll_e("blog") ?></li>
                <li><?= pll_e("landing page or single page") ?></li>
            </ul>
            <button class="button" data-value="Basic website">
                <?= pll_e("select") ?>
            </button>
        </li>
        <li class="item">
            <h3><?= pll_e("E-commerce") ?></h3>
            <ul class="infoList">
                <li><?= pll_e("content management system") ?></li>
                <li><?= pll_e("online sales") ?></li>
            </ul>
            <button class="button" data-value="E-commerce">
                <?= pll_e("select") ?>
            </button>
        </li>
    </ul>
</section>

<?php
get_footer();
