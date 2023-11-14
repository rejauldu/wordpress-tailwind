<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width">
		<title><?php bloginfo('name'); ?></title>
		<?php wp_head(); ?>
	</head>
	
<body <?php body_class(); ?>>
	<div class="container md:mx-auto">
		<div class="grid grid-flow-col items-center mx-2">
			<?php
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
				if ( has_custom_logo() ) {
					echo '<a class="navbar-brand" href="/"><img width="64" height="64" class="h-16 my-6" src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '"></a>';
				} else {
					echo '<a class="navbar-brand" href="/">Logo</a>';
				}
			?>
			<div class="justify-self-stretch hidden sm:block"><?php get_search_form(); ?></div>
			<div class="justify-self-end flex gap-5 px-4">
				<a href="/cart">
					<?php echo getSVG('assets/images/svg/heart.svg', 'w-6 h-6 text-black hover:text-theme-primary'); ?>
				</a>
				<a href="/user">
					<?php echo getSVG('assets/images/svg/user.svg', 'w-6 h-6 text-black hover:text-theme-primary'); ?>
				</a>
				<a href="/cart">
					<?php echo getSVG('assets/images/svg/cart.svg', 'w-6 h-6 text-black hover:text-theme-primary'); ?>
				</a>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-sm">
		<div class="container mx-auto">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header-menu">
				<span class="navbar-toggler-icon"></span>
			</button>
			<?php
				$args = array(
					'theme_location' => 'headerMenu',
					'container_class' => 'i4t-collapse navbar-collapse',
					'menu_class'     => 'navbar-nav'
				);
			?>
			<?php wp_nav_menu(  $args ); ?>
		</div>
	</nav>