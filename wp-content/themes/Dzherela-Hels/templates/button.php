<?php
/**
 * Button Component
 *
 * Usage:
 * get_template_part('template-parts/components/button', null, [
 *   'text'      => 'Детальніше',
 *   'link'      => '#',
 *   'type'      => 'primary', // primary, secondary, social
 *   'icon_name' => 'arrow',   // ACF field name without 'icon_' prefix
 *   'target'    => '_self'
 * ]);
 */

$text = $args['text'] ?? '';
$href = $args['link'] ?? '#';
$type = $args['type'] ?? 'primary';
$icon_name = $args['icon_name'] ?? null;
$target = $args['target'] ?? '_self';
$class_extra = $args['class'] ?? '';

// Get icon from ACF options
$icon_url = null;

if ($icon_name) {
    $field_name = 'icon_' . $icon_name;
    // Check ACF options first
    $icon_val = function_exists('get_field') ? get_field($field_name, 'option') : null;

    if (is_array($icon_val)) {
        $icon_url = $icon_val['url'] ?? null;
    } elseif (is_numeric($icon_val)) {
        $icon_url = wp_get_attachment_url($icon_val);
    } else {
        $icon_url = $icon_val;
    }

    // Fallback: Check if file exists in theme assets/img/svg/
    if (!$icon_url) {
        $local_icon_path = '/assets/img/svg/' . $icon_name . '.svg';
        if (file_exists(get_template_directory() . $local_icon_path)) {
            $icon_url = get_template_directory_uri() . $local_icon_path;
        }
    }
}

// Build CSS classes
$classes = 'btn btn--' . $type;
if (!empty($class_extra)) {
    $classes .= ' ' . $class_extra;
}
if (!$icon_url) {
    $classes .= ' btn--no-icon';
}

// Determine tag and attributes
$tag = ($type === 'button' || $type === 'submit') ? 'button' : 'a';
$attrs = ($tag === 'a') ? 'href="' . esc_url($href) . '" target="' . esc_attr($target) . '"' : 'type="button"';

// Add custom attributes
if (!empty($args['attributes']) && is_array($args['attributes'])) {
    foreach ($args['attributes'] as $attr => $value) {
        $attrs .= ' ' . esc_attr($attr) . '="' . esc_attr($value) . '"';
    }
}
?>

<<?php echo $tag; ?> class="
    <?php echo esc_attr($classes); ?>"
    <?php echo $attrs; ?>>

    <?php if ($text && $type !== 'social'): ?>
        <span class="btn__text">
            <?php echo esc_html($text); ?>
        </span>
    <?php endif; ?>

    <?php if ($icon_url): ?>
        <span class="btn__icon-wrapper">
            <span class="btn__icon"
                style="-webkit-mask-image: url('<?php echo esc_url($icon_url); ?>'); mask-image: url('<?php echo esc_url($icon_url); ?>');"></span>
        </span>
    <?php endif; ?>

</<?php echo $tag; ?>>