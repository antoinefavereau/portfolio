<?php
get_header();
?>

<div class="cours">
    <h1><?= the_title() ?></h1>
    <hr>
    <?= get_field('html_code') ?>

    <div class="sectionButtons">
        <button id="arrowLeft">
            <svg width="35px" height="30px" stroke-width="2" viewBox="0 0 24 24" fill="none">
                <path d="M15 6l-6 6 6 6" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                </path>
            </svg>
        </button>

        <button id="arrowRight">
            <svg width="35px" height="30px" stroke-width="2" viewBox="0 0 24 24" fill="none">
                <path d="M9 6l6 6-6 6" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
    </div>
</div>

<script src="<?= get_template_directory_uri() ?>\assets\sources\js\single.js"></script>

<?php
get_footer();
