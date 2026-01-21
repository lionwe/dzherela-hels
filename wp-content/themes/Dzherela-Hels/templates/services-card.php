<?php
/**
 * Services Card Template
 * 
 * @package Dzherela-Hels
 * 
 * @param array $args {
 *     @type int    $index     Card index for counter
 *     @type string $title     Service title
 *     @type string $excerpt   Service excerpt
 *     @type array  $tags      Service tags (WP_Term objects)
 *     @type string $permalink Service permalink
 * }
 */

$index = $args['index'] ?? 1;
$title = $args['title'] ?? '';
$excerpt = $args['excerpt'] ?? '';
$tags = $args['tags'] ?? [];
$permalink = $args['permalink'] ?? '#';
?>

<article class="service-card" data-index="<?php echo esc_attr($index); ?>">
    <div class="service-card__content">
        <div class="service-card__top">
            <?php if ($tags && !is_wp_error($tags)): ?>
                <div class="service-card__tags">
                    <?php foreach ($tags as $tag): ?>
                        <span class="service-card__tag">
                            <?php echo esc_html($tag->name); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="service-card__bottom">
            <?php if ($title): ?>
                <h3 class="service-card__title">
                    <span class="service-card__title-text">
                        <?php echo esc_html($title); ?>
                    </span>
                </h3>
            <?php endif; ?>

            <?php if ($excerpt): ?>
                <p class="service-card__excerpt">
                    <?php echo esc_html($excerpt); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</article>