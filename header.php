<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width">
		<title><?php bloginfo('name'); ?></title>
		<?php wp_head(); ?>
	</head>
	
<body <?php body_class(); ?>>
	<nav class="navbar navbar-expand-sm">
		<div class="container mx-auto">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header-menu">
				<span class="navbar-toggler-icon"></span>
			</button>
			<?php
				$args = array(
					'theme_location' => 'primary',
					'container_class' => 'i4t-collapse navbar-collapse',
					'menu_class'     => 'navbar-nav'
				);
			?>
			<?php wp_nav_menu(  $args ); ?>
		</div>
	</nav>