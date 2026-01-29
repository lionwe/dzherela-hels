<?php
/**
 * Contacts Section
 * 
 * @package Dzherela-Hels
 */

$container_bg = get_field('contacts_container_bg');
$badges = get_field('contacts_badges');
$content = get_field('contacts_content');
$form_shortcode = get_field('contacts_form_shortcode');
$right_content = get_field('contacts_right_content');

// Get global options
$phone = get_field('phone_1', 'option');
$address = get_field('address_main', 'option');
$scheduler = get_field('schedule_list', 'option');
?>

<section id="contacts" class="contacts">
    <div class="container">
        <div class="contacts__container-wrap">
            <?php if ($container_bg): ?>
                <img class="contacts__container-wrap--bg" src="<?php echo esc_url($container_bg['url']); ?>"
                    alt="<?php echo esc_attr($container_bg['alt'] ?: 'Background'); ?>" loading="lazy">
            <?php endif; ?>

            <div class="contacts__grid">
                <div class="contacts__left">
                    <?php if ($badges): ?>
                        <div class="contacts__badges">
                            <?php foreach ($badges as $badge): ?>
                                <span class="contacts__badge">
                                    <?php echo esc_html($badge['text']); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($content): ?>
                        <div class="contacts__content">
                            <?php echo $content; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($form_shortcode): ?>
                        <div class="contacts__form">
                            <?php echo do_shortcode($form_shortcode); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="contacts__right">
                    <div class="contacts__right-container">
                        <?php if ($right_content): ?>
                            <div class="contacts__info-header">
                                <?php echo $right_content; ?>
                            </div>
                        <?php endif; ?>

                        <div class="contacts__data-wrapper">
                            <?php if ($phone): ?>
                                <div class="contacts__item">
                                    <div class="contacts__icon-circle">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/tel.svg"
                                            alt="Phone">
                                    </div>
                                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"
                                        class="contacts__text">
                                        <?php echo esc_html($phone); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if ($address): ?>
                                <div class="contacts__item">
                                    <div class="contacts__icon-circle">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/place.svg"
                                            alt="Address">
                                    </div>
                                    <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode(strip_tags($address)); ?>"
                                        target="_blank" rel="noopener noreferrer" class="contacts__text">
                                        <?php echo wp_kses_post($address); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if ($scheduler): ?>

                                <div class="contacts__schedule">
                                    <div class="contacts__icon-clock">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/clock.svg"
                                            alt="Clock">
                                    </div>
                                    <div class="contacts__schedule-list">
                                        <?php foreach ($scheduler as $item): ?>
                                            <div class="contacts__schedule-item"><?php echo esc_html($item['text']); ?></div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($address): ?>
            <div class="contacts__map">
                <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                    src="https://maps.google.com/maps?q=<?php echo urlencode(strip_tags($address)); ?>&t=m&z=15&output=embed&iwloc=near"
                    title="<?php echo esc_attr(strip_tags($address)); ?>"
                    aria-label="<?php echo esc_attr(strip_tags($address)); ?>">
                </iframe>
            </div>
        <?php endif; ?>
</section>