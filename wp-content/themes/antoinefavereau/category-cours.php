<?php

get_header();

if (have_posts()) : while (have_posts()) : the_post(); ?>

        <a href="<?= the_permalink() ?>"><?= the_title() ?></a>

<?php endwhile;
endif;

get_footer();
