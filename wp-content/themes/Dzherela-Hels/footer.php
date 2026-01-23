<footer class="page-footer">
    <div class="container">

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
</footer>
<?php wp_footer(); ?>

</body>

</html>