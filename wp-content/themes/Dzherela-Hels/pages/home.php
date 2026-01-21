<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>

<main id="home">
    <?php get_template_part('sections/home/hero'); ?>
    <?php get_template_part('sections/home/advantages'); ?>
    <?php get_template_part('sections/home/services'); ?>
    <?php get_template_part('sections/home/cta'); ?>
</main>

<?php get_footer(); ?>