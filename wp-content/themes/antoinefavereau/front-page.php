<?php
get_header();
?>

<section id="top">
    <div class="text">
        <h1 class="topSectionUpElasticAnimation">Antoine<span class="underscore">_ </span>Favereau</h1>
        <p class="topSectionUpElasticAnimation">French student in computer engineering school and freelance in web development.</p>
    </div>
    <button class="discover button scrollToButton topSectionUpElasticAnimation" data-target="#background">discover</button>
    <svg class="bottom" width="1920" height="100" viewBox="0 0 1920 100" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 0.000183105C960 100 960 100 1920 0.000183105V100H0V0.000183105Z" fill="#EEEEEE" />
        <path d="M-2 23C963 113.5 966.5 114.5 1921 24.5" stroke="#222831" stroke-opacity="0.3" stroke-width="4" />
    </svg>
</section>

<section id="background" class="section">
    <h2 class="h2">background</h2>
    <h1 class="h1">See my studies and experience</h1>
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
    <h2 class="h2">skills</h2>
    <h1 class="h1">All the technologies I am familiar with</h1>
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
    <h2 class="h2">projects</h2>
    <h1 class="h1">The different projects I worked on</h1>
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
    <h2 class="h2">services</h2>
    <h1 class="h1">You have a project ?</h1>
    <div class="background"></div>
    <ul class="servicesList">
        <li class="item">
            <h3>Front-end</h3>
            <ul class="infoList">
                <li>need your design</li>
                <li>quick result</li>
            </ul>
            <button class="button" data-value="Front-end">
                select
            </button>
        </li>
        <li class="item">
            <h3>Basic website</h3>
            <ul class="infoList">
                <li>branding or biography</li>
                <li>portfolio</li>
                <li>blog</li>
                <li>landing page or single page</li>
            </ul>
            <button class="button" data-value="Basic website">
                select
            </button>
        </li>
        <li class="item">
            <h3>E-commerce</h3>
            <ul class="infoList">
                <li>content management system</li>
                <li>online sales</li>
            </ul>
            <button class="button" data-value="E-commerce">
                select
            </button>
        </li>
    </ul>
</section>

<?php
get_footer();
