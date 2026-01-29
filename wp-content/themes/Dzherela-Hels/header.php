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
					'text' => 'Записатись на консультацію',
					'link' => get_option('page_on_front'),
					'type' => 'primary',
					'icon_name' => 'consultation_arrow',
				]);
				?>
			</div>

			<div class="header__burger">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/burger.svg" alt="Menu" width="16"
					height="8">
			</div>
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
					'text' => 'Записатись на консультацію',
					'link' => get_option('page_on_front'),
					'type' => 'primary',
					'icon_name' => 'consultation_arrow',
				]);
				?>
			</div>
	</section>
	</div>