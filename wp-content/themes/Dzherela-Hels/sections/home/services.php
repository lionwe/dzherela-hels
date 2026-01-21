<?php
/**
 * Services Section
 * 
 * @package Dzherela-Hels
 */

// ACF field values
$header_content = get_field('services_header_content');
$bg_image = get_field('services_bg_image');
$bottom_image = get_field('services_bottom_image');
$selected_services = get_field('services_selection');

// Determine services to display
$services_posts = [];

if ($selected_services) {
    $services_posts = $selected_services;
} else {
    // Fallback if no services are selected manually
    $services_query = new WP_Query([
        'post_type' => 'services',
        'posts_per_page' => 7, // Default limit
        'orderby' => 'menu_order',
        'order' => 'ASC',
    ]);
    $services_posts = $services_query->posts;
}

$services_count = count($services_posts);
$show_bottom_image = ($services_count <= 7);
?>

<section id="services" class="services">
    <?php if ($bg_image): ?>
        <img class="services__bg" src="<?php echo esc_url($bg_image['url']); ?>"
            alt="<?php echo esc_attr($bg_image['alt'] ?: 'Фон секції послуг'); ?>" loading="lazy">
    <?php endif; ?>

    <div class="container">
        <?php if ($header_content): ?>
            <div class="services__header">
                <?php echo $header_content; ?>
                <span class="services__underline"></span>
            </div>
        <?php endif; ?>

        <?php if ($services_posts): ?>
            <div class="services__slider swiper">
                <div class="services__grid swiper-wrapper">
                    <?php
                    $index = 0;
                    foreach ($services_posts as $post):
                        setup_postdata($post);
                        $index++;

                        // Get service tags
                        $service_tags = get_the_terms($post->ID, 'service_tag');
                        ?>
                        <div class="swiper-slide">
                            <?php
                            get_template_part('templates/services-card', null, [
                                'index' => $index,
                                'title' => get_the_title($post),
                                'excerpt' => get_the_excerpt($post),
                                'tags' => $service_tags,
                            ]);
                            ?>
                        </div>
                    <?php endforeach;
                    wp_reset_postdata();
                    ?>

                    <?php if ($show_bottom_image && $bottom_image): ?>
                        <div class="services__bottom-image">
                            <img src="<?php echo esc_url($bottom_image['url']); ?>"
                                alt="<?php echo esc_attr($bottom_image['alt'] ?: 'Зображення послуг'); ?>" loading="lazy">
                        </div>
                    <?php endif; ?>
                </div>

                <div class="services__controls">
                    <div class="services__nav-buttons">
                        <button type="button" class="services__nav-btn services__prev" aria-label="Previous slide">
                            <span class="services__nav-icon">
                                <?php echo file_get_contents(get_template_directory() . '/assets/img/svg/arrow-prev.svg'); ?>
                            </span>
                        </button>
                        <button type="button" class="services__nav-btn services__next" aria-label="Next slide">
                            <span class="services__nav-icon">
                                <?php echo file_get_contents(get_template_directory() . '/assets/img/svg/arrow-next.svg'); ?>
                            </span>
                        </button>
                    </div>
                    <div class="services__pagination"></div>
                </div>

                <?php if ($bottom_image): ?>
                    <div class="services__mobile-image">
                        <img src="<?php echo esc_url($bottom_image['url']); ?>"
                            alt="<?php echo esc_attr($bottom_image['alt'] ?: 'Зображення послуг'); ?>" loading="lazy">
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>