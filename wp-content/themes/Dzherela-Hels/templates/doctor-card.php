<?php
/**
 * Doctor Card Component
 * 
 * @package Dzherela-Hels
 */

$post_id = $args['post_id'] ?? 0;
$title = $args['title'] ?? '';
$experience = $args['experience'] ?? '';
$category = $args['category'] ?? '';
$content = $args['content'] ?? '';
$permalink = $args['permalink'] ?? '#';

// Get featured image
$thumbnail_id = get_post_thumbnail_id($post_id);
$thumbnail_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'large') : '';

// Унікальний ID для картки
$card_id = 'doctor-card-' . $post_id;
$has_badges = $experience || $category;
?>

<div class="doctor-card" id="<?php echo esc_attr($card_id); ?>">
    <div class="doctor-card__image-wrapper">

        <!-- Badges -->
        <?php if ($has_badges): ?>
            <div class="doctor-card__badges">
                <?php if ($experience): ?>
                    <div class="doctor-card__badge doctor-card__badge--experience">
                        <span class="doctor-card__badge-value"><?php echo esc_html($experience); ?></span>
                        <span class="doctor-card__badge-label">досвіду</span>
                    </div>
                <?php endif; ?>

                <?php if ($category): ?>
                    <div class="doctor-card__badge doctor-card__badge--category">
                        <span class="doctor-card__badge-label">спеціаліст</span>
                        <span class="doctor-card__badge-value"><?php echo esc_html($category); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Image -->
        <?php if ($thumbnail_url): ?>
            <div class="doctor-card__image-container">
                <?php get_picture([
                    'src' => $thumbnail_url,
                    'class' => 'doctor-card__image',
                    'alt' => $title,
                    'lazy' => true,
                ]); ?>
            </div>
        <?php endif; ?>

        <!-- Content overlay at bottom -->
        <?php if ($title || $content): ?>
            <div class="doctor-card__overlay">
                <div class="doctor-card__content">
                    <?php if ($title): ?>
                        <p><span><?php echo esc_html($title); ?></span></p>
                    <?php endif; ?>
                    <?php echo $content; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="doctor-card__footer">
        <?php
        get_template_part('templates/button', null, [
            'text' => 'Записатись на прийом',
            'link' => '#contacts',
            'type' => 'primary',
            'icon_name' => 'consultation_arrow',
            'class' => 'doctor-card__button',
        ]);
        ?>
    </div>
</div>