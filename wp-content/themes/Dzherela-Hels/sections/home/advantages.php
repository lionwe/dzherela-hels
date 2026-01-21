<?php
/**
 * Advantages Section
 * 
 * @package Dzherela-Hels
 */

// ACF field values
$bg_image = get_field('advantages_bg_image');
$title = get_field('advantages_title');
$advantages = get_field('advantages_list');
$side_image = get_field('advantages_image');
?>

<section id="advantages" class="advantages">
    <?php if ($bg_image): ?>
        <img class="advantages__bg" src="<?php echo esc_url($bg_image['url']); ?>"
            alt="<?php echo esc_attr($bg_image['alt'] ?: 'Фон секції переваг'); ?>" loading="lazy">
    <?php endif; ?>

    <div class="container">
        <?php if ($title): ?>
            <div class="advantages__header">
                <h2 class="advantages__title"><?php echo esc_html($title); ?></h2>
                <span class="advantages__underline"></span>
            </div>
        <?php endif; ?>

        <div class="advantages__grid">
            <?php if ($advantages): ?>
                <div class="advantages__list">
                    <?php foreach ($advantages as $index => $advantage): ?>
                        <div class="advantages__item">
                            <div class="advantages__item-content">
                                <?php echo $advantage['content']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($side_image): ?>
                <div class="advantages__image">
                    <img src="<?php echo esc_url($side_image['url']); ?>"
                        alt="<?php echo esc_attr($side_image['alt'] ?: 'Зображення переваг'); ?>" loading="lazy">
                </div>
            <?php endif; ?>
        </div>

        <div class="advantages__cta">
            <?php get_template_part('templates/button', null, [
                'text' => 'Записатись на консультацію',
                'link' => '#contacts',
                'type' => 'primary',
                'icon_name' => 'consultation_arrow',
                'class' => 'advantages__button'
            ]); ?>
        </div>
    </div>
</section>