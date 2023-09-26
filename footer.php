<div class="fixed right-5 bottom-5 p-4 rounded-lg shadow-[rgba(0,0,0,0.15)_0_0_15px_0px] z-10 bg-white">
	<a href="/cart">
		<?php echo getSVG('assets/images/svg/cart.svg', 'w-6 h-6 text-black hover:text-theme-primary'); ?>
	</a>
</div>
<footer class="bg-slate-100">
	
	<div class="container mx-auto grid gap-1 sm:gap-5 sm:grid-cols-3 md:grid-cols-4 text-center sm:text-left py-5">
		<div class="hidden md:block">
			<?php
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
				if ( has_custom_logo() ) {
					echo '<a class="navbar-brand" href="/"><img class="h-15 py-8" src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '"></a>';
				} else {
					echo '<a class="navbar-brand" href="/">Logo</a>';
				}
			?>
			<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
		</div>
		
		<div class="py-3">
			<p class="mb-5 text-xl">Links</p>
			<?php
			$menu_locations = get_nav_menu_locations();
			$menu_items = wp_get_nav_menu_items( $menu_locations['footer'] );
			if($menu_items) {?>
			<ul>
				<?php
				foreach ( (array) $menu_items as $key => $menu_item ) {
					if ( ! $menu_item->menu_item_parent ) {
						echo "<li><a href='$menu_item->url'>";
						echo $menu_item->title;
						echo "</a></li>";
					}
				}
				?>
			</ul>
			<?php } ?>
		</div>
		<div class="py-3">
			<p class="mb-5 text-xl">Product categories</p>
			<?php
				$cats = getProductCategories(5);
				if($cats) {?>
					<ul>
						<?php
						foreach ( (array) $cats as $key => $item ) {
							if ( ! $item->menu_item_parent ) {
								echo "<li><a href='$item->url'>";
								echo $item->name;
								echo "</a></li>";
							}
						}
						?>
					</ul>
			<?php } ?>
		</div>
		<div class="py-3">
			<p class="mb-5 text-xl">Contact Details</p>
			<p>Address: 3548 Columbia Mine Road,<br/>
				Wheeling, West Virginia,<br/>
				26003 Contact : 304-559-3023<br/>
				304-650-2694<br/>
				E-mail : shopnow@open2.com<br/>
				contact@open.com</p>
		</div>
	</div>
	<div class="border-y text-center py-2">
		<?php bloginfo('name'); ?> - &copy; <?php echo date('Y');?>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>