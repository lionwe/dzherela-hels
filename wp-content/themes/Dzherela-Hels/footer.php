<footer id="footer" class="page-footer">
    <div class="container">

        <div class="page-footer__content">
            <?php if (has_nav_menu('menu-footer')): ?>
                <div class="page-footer__menu">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'menu-footer',
                        'container' => false,
                        'menu_class' => 'footer-menu',
                        'depth' => 1,
                        'fallback_cb' => '__return_false',
                    ]);
                    ?>
                </div>
            <?php endif; ?>

            <div class="page-footer__separator"></div>

            <div class="page-footer__socials">
                <?php
                $socials = [
                    'facebook' => [
                        'url' => get_field('social_facebook', 'option'),
                        'icon' => get_field('social_facebook_icon', 'option'),
                    ],
                    'instagram' => [
                        'url' => get_field('social_instagram', 'option'),
                        'icon' => get_field('social_instagram_icon', 'option'),
                    ],
                    'tiktok' => [
                        'url' => get_field('social_tiktok', 'option'),
                        'icon' => get_field('social_tiktok_icon', 'option'),
                    ],
                    'telegram' => [
                        'url' => get_field('social_telegram', 'option'),
                        'icon' => get_field('social_telegram_icon', 'option'),
                    ],
                    'youtube' => [
                        'url' => get_field('social_youtube', 'option'),
                        'icon' => get_field('social_youtube_icon', 'option'),
                    ],
                ];

                foreach ($socials as $network => $data):
                    if (!empty($data['url']) && !empty($data['icon'])):
                        $icon_url = $data['icon']['url'] ?? $data['icon'];
                        $icon_alt = $data['icon']['alt'] ?? $network;
                        ?>
                        <a href="<?php echo esc_url($data['url']); ?>" class="social-link" target="_blank"
                            aria-label="<?php echo esc_attr(ucfirst($network)); ?>">
                            <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($icon_alt); ?>">
                        </a>
                        <?php
                    endif;
                endforeach;
                ?>
            </div>
        </div>

        <div class="page-footer__divider"></div>

        <?php
        $dev_credit = get_field('developer_credit', 'option');
        if ($dev_credit):
            $dev_text = $dev_credit['text'] ?? '';
            $dev_link = $dev_credit['link'] ?? '';
            ?>
            <div class="page-footer__credit">
                <?php if ($dev_link): ?>
                    <a href="<?php echo esc_url($dev_link); ?>" target="_blank" rel="nofollow noopener">
                        <?php echo esc_html($dev_text); ?>
                    </a>
                <?php else: ?>
                    <span><?php echo esc_html($dev_text); ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>

    <button id="scroll-to-top" class="scroll-to-top" aria-label="Scroll to top">
        <?php echo file_get_contents(get_template_directory() . '/assets/img/svg/arrow-next.svg'); ?>
    </button>
</footer>
<?php wp_footer(); ?>

</body>

</html>