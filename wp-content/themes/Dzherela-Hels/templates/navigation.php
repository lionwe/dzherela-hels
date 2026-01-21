<?php
/**
 * Navigation Template
 */

$menu_location = $args['location'] ?? 'menu-header';

if (has_nav_menu($menu_location)) {
    wp_nav_menu([
        'theme_location' => $menu_location,
        'container' => false,
        'menu_class' => 'nav-list',
        'fallback_cb' => false,
        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth' => 1,
    ]);
}
