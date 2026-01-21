<?php
/**
 * Hero Section
 * 
 * @package Dzherela-Hels
 */

// ACF field values
$bg_type = get_field('hero_bg_type') ?: 'video';
$bg_video = get_field('hero_bg_video');
$bg_image = get_field('hero_bg_image');
$content = get_field('hero_content');
$badges = get_field('hero_badges');
$phone = get_field('phone_1', 'option');
$form_shortcode = get_field('hero_form_shortcode');

// Parse WYSIWYG content to extract h1 and description blocks
$title = '';
$descriptions = '';

if ($content) {
	// Extract h1 tag
	if (preg_match('/<h1[^>]*>.*?<\/h1>/is', $content, $h1_match)) {
		$title = $h1_match[0];
	}

	// Extract desktop-only and mobile-only divs, fallback to paragraphs
	if (preg_match_all('/<div[^>]*class=["\'][^"]*(?:desktop-only|mobile-only)[^"]*["\'][^>]*>.*?<\/div>/is', $content, $div_matches)) {
		$descriptions = implode('', $div_matches[0]);
	} elseif (preg_match_all('/<p[^>]*>.*?<\/p>/is', $content, $p_matches)) {
		$descriptions = implode('', $p_matches[0]);
	}
}
?>

<section id="hero" class="hero">
	<?php if ($bg_type === 'video' && $bg_video): ?>
		<video class="hero__bg" autoplay muted loop playsinline>
			<source src="<?php echo esc_url($bg_video); ?>" type="video/mp4">
		</video>
	<?php elseif ($bg_image): ?>
		<img class="hero__bg" src="<?php echo esc_url($bg_image['url']); ?>"
			alt="<?php echo esc_attr($bg_image['alt'] ?: 'Hero background'); ?>">
	<?php endif; ?>

	<!-- 3×3 grid overlay -->
	<div class="hero__grid">
		<?php for ($i = 0; $i < 9; $i++): ?><span></span><?php endfor; ?>
	</div>

	<div class="hero__content container">
		<?php if ($title): ?>
			<div class="hero__title">
				<?php echo $title; ?>
			</div>
		<?php endif; ?>

		<?php if ($descriptions): ?>
			<div class="hero__descriptions">
				<?php echo $descriptions; ?>
			</div>
		<?php endif; ?>

		<div class="hero__badges">
			<?php if ($badges): ?>
				<?php foreach ($badges as $badge): ?>
					<div class="hero__badge"><?php echo $badge['text']; ?></div>
				<?php endforeach; ?>
			<?php endif; ?>

			<?php if ($phone): ?>
				<a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"
					class="hero__badge hero__badge--phone">
					<?php echo esc_html($phone); ?>
				</a>
			<?php endif; ?>
		</div>

		<?php if ($form_shortcode): ?>
			<?php echo do_shortcode($form_shortcode); ?>
		<?php endif; ?>
	</div>
</section>