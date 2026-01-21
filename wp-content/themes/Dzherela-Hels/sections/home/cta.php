<?php
/**
 * CTA Section
 * 
 * @package Dzherela-Hels
 */

$container_bg = get_field('cta_container_bg');
$badges = get_field('cta_badges');
$content = get_field('cta_content');
$form_shortcode = get_field('cta_form_shortcode');
$right_image = get_field('cta_right_image');
?>

<section class="cta">
    <div class="container">
        <div class="cta__container-wrap">
            <?php if ($container_bg): ?>
                <img class="cta__container-wrap--bg" src="<?php echo esc_url($container_bg['url']); ?>"
                    alt="<?php echo esc_attr($container_bg['alt'] ?: 'Background'); ?>" loading="lazy">
            <?php endif; ?>

            <div class="cta__grid">
                <div class="cta__left">
                    <?php if ($badges): ?>
                        <div class="cta__badges">
                            <?php foreach ($badges as $badge): ?>
                                <span class="cta__badge">
                                    <?php echo esc_html($badge['text']); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($content): ?>
                        <div class="cta__content">
                            <?php echo $content; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($form_shortcode): ?>
                        <div class="cta__form">
                            <?php echo do_shortcode($form_shortcode); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="cta__right">
                    <?php if ($right_image): ?>
                        <img src="<?php echo esc_url($right_image['url']); ?>"
                            alt="<?php echo esc_attr($right_image['alt'] ?: 'CTA Image'); ?>" loading="lazy">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>