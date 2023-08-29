<?php
get_header();
?>
<main id="games">
    <h1>My games</h1>

    <div id="gameList">
        <?php
        query_posts(array(
            'category_name' => 'games'
        ));
        if (have_posts()) : while (have_posts()) : the_post(); ?>
                <a class="item hover link" href="<?= esc_url(get_field('link')) ?>" target="_blank">
                    <img src="<?= esc_url(get_field('image')['url']) ?>" alt="<?= get_the_title() ?>">
                    <p class="title"><?= get_the_title() ?></p>
                </a>
        <?php endwhile;
        endif;
        ?>
    </div>
</main>

<?php
get_footer();
