<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
	<meta name="description" content="Side maded on Wordpress by Recipe team">

	<?php wp_head(); ?>

	<title><?php wp_title(); ?></title>

</head>

<body>

	<header id="header" class="header">
		<?php
		$header_cta = get_field('header_cta', 'option');
		$cta_text = $header_cta['text'] ?? 'Записатись на консультацію';
		$cta_link = $header_cta['link'] ?? '#contacts';
		if (strpos($cta_link, '#') === 0 && !is_front_page()) {
			$cta_link = home_url($cta_link);
		}
		?>
		<div class="container header__container">
			<div class="header__logo">
				<?php
				if (has_custom_logo()) {
					the_custom_logo();
				} else {
					echo '<a href="' . esc_url(home_url('/')) . '" class="custom-logo-link" rel="home"><img width="58" height="57" src="' . esc_url(get_template_directory_uri() . '/assets/img/logo.svg') . '" class="custom-logo" alt="Dzherela Hels"></a>';
				}
				?>
			</div>

			<nav class="header__nav">
				<?php get_template_part('templates/navigation', null, array('location' => 'menu-header')); ?>
			</nav>

			<div class="header__action">
				<?php
				get_template_part('templates/button', null, [
					'text' => $cta_text,
					'link' => $cta_link,
					'type' => 'primary',
					'icon_name' => 'consultation_arrow',
				]);
				?>
			</div>

			<button class="header__burger" type="button" data-lenis-prevent>
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/burger.svg" alt="Menu" width="16"
					height="8">
			</button>
		</div>
	</header>

	<section class="popup-menu" id="popup-menu">
		<div class="container popup-menu__container">
			<div class="popup-menu__header">
				<div class="popup-menu__close">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/close.svg" alt="Close"
						width="16" height="16">
				</div>
			</div>
			<nav class="popup-menu__nav">
				<?php get_template_part('templates/navigation', null, array('location' => 'menu-header')); ?>
			</nav>
			<div class="popup-menu__action">
				<?php
				get_template_part('templates/button', null, [
					'text' => $cta_text,
					'link' => $cta_link,
					'type' => 'primary',
					'icon_name' => 'consultation_arrow',
				]);
				?>
			</div>
	</section>
	</div>