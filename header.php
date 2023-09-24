<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width">
		<title><?php bloginfo('name'); ?></title>
		<?php wp_head(); ?>
	</head>
	
<body <?php body_class(); ?>>
	<nav class="navbar navbar-expand-sm" id="navbar">
		<div class="container mx-auto">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header-menu">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="i4t-collapse navbar-collapse" id="header-menu">
				<ul class='navbar-nav'>
					<?php
					$menu_locations = get_nav_menu_locations();
					$menu_items = wp_get_nav_menu_items( $menu_locations['headerMenu'] );
					if($menu_items) {
						foreach ( (array) $menu_items as $key => $menu_item ) {
							if ( ! $menu_item->menu_item_parent ) {
								echo "<li class='menu-item'><a class='".i4t_check_active_menu($menu_item)."' href='$menu_item->url'>";
								echo $menu_item->title;
								echo "</a></li>";
							}
						}
					}
					?>
				</ul>
			</dv>
		</div>
	</nav>
	