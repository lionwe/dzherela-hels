<?php
/**
 * Our Doctors Section
 * 
 * @package Dzherela-Hels
 */

// ACF field values
$section_title = get_field('doctors_section_title');
$selected_doctors = get_field('doctors_section_selection');

// Determine doctors to display
$doctors_posts = [];

if ($selected_doctors) {
    $doctors_posts = $selected_doctors;
} else {
    // Fallback if no doctors are selected manually
    $doctors_query = new WP_Query([
        'post_type' => 'doctors',
        'posts_per_page' => 6,
        'orderby' => 'menu_order',
        'order' => 'ASC',
    ]);
    $doctors_posts = $doctors_query->posts;
}
?>

<section id="our-doctors" class="our-doctors">
    <div class="container">
        <div class="our-doctors__wrapper">
            <!-- Left Column: Title & Navigation -->
            <div class="our-doctors__left">
                <div class="our-doctors__header">
                    <h2 class="our-doctors__title">
                        <?php echo esc_html($section_title ?: 'Наші лікарі'); ?>
                    </h2>
                    <span class="our-doctors__underline"></span>
                </div>

                <div class="our-doctors__controls">
                    <div class="our-doctors__nav-buttons">
                        <button type="button" class="our-doctors__nav-btn our-doctors__prev"
                            aria-label="Previous slide">
                            <span class="our-doctors__nav-icon">
                                <?php echo file_get_contents(get_template_directory() . '/assets/img/svg/arrow-prev.svg'); ?>
                            </span>
                        </button>
                        <button type="button" class="our-doctors__nav-btn our-doctors__next" aria-label="Next slide">
                            <span class="our-doctors__nav-icon">
                                <?php echo file_get_contents(get_template_directory() . '/assets/img/svg/arrow-next.svg'); ?>
                            </span>
                        </button>
                    </div>
                    <div class="our-doctors__pagination"></div>
                </div>
            </div>

            <!-- Right Column: Slider -->
            <?php if ($doctors_posts): ?>
                <div class="our-doctors__right">
                    <div class="our-doctors__slider swiper">
                        <div class="our-doctors__grid swiper-wrapper">
                            <?php
                            foreach ($doctors_posts as $post):
                                setup_postdata($post);

                                // Get doctor ACF fields
                                $experience = get_field('doctor_experience', $post->ID);
                                $category = get_field('doctor_category', $post->ID);
                                $content = apply_filters('the_content', $post->post_content);
                                ?>
                                <div class="swiper-slide">
                                    <?php
                                    get_template_part('templates/doctor-card', null, [
                                        'post_id' => $post->ID,
                                        'title' => get_the_title($post),
                                        'experience' => $experience,
                                        'category' => $category,
                                        'content' => $content,
                                        'permalink' => get_permalink($post),
                                    ]);
                                    ?>
                                </div>
                            <?php endforeach;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>