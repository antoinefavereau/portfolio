<?php

get_header();

?>
<div id="archivesJeux">
    <div class="container row row-cols-3 mx-auto">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center mb-3"><?= the_title() ?></h5>
                            <hr>
                            <p class="card-text"><?= get_field("description") ?></p>
                            <a href="<?= get_field("lien") ?>" class="btn d-block">Voir le jeu</a>
                        </div>
                    </div>
                </div>
        <?php endwhile;
        endif; ?>
    </div>
</div>


<?php
get_footer();
