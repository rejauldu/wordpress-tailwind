<footer class="container-fluid bg-dark text-deep-light">
	
	<div class="row">
		
			
			<div class="col-12 col-sm-6 col-md-3 py-3">
				<h4 class="ps-3">LINKS</h4>
				<?php
				$menu_locations = get_nav_menu_locations();
				$menu_items = wp_get_nav_menu_items( $menu_locations['footer'] );
				if($menu_items) {?>
				<ul class='list-group bg-transparent d-flex flex-row flex-sm-column'>
					<?php
					foreach ( (array) $menu_items as $key => $menu_item ) {
						if ( ! $menu_item->menu_item_parent ) {
							echo "<li class='list-group-item bg-transparent border-0 py-0'><a class='text-decoration-none text-light-secondary ".i4t_check_active_menu($menu_item, 'text-white')."' href='$menu_item->url'>";
							echo $menu_item->title;
							echo "</a></li>";
						}
					}
					?>
				</ul>
			<?php } ?>
			</div>
			
			<div class="col-12 col-sm-6 col-md-3 py-3">
				<h4 class="ps-3">LEGAL</h4>
				<ul class='list-group bg-transparent d-flex flex-row flex-sm-column'>
					<li class='list-group-item bg-transparent border-0 py-0'>
						<a class='text-decoration-none text-light-secondary' href="/terms-and-conditions">Terms & Conditions</a>
					</li>
					<li class='list-group-item bg-transparent border-0 py-0'>
						<a class='text-decoration-none text-light-secondary' href="/privacy-policy">Privacy Policy</a>
					</li>
				</ul>
			</div>
			
			<div class="col-12 col-sm-6 col-md-3 py-3">
				<h4 class="ps-3">PAYMENTS</h4>
			</div>
			
			<div class="col-12 col-sm-6 col-md-3 py-3">
				<a href="https://facebook.com/ict4today" class="text-decoration-none text-light-secondary">Facebook</a>
				<a href="https://youtube.com/ict4today" class="text-decoration-none text-light-secondary">Youtube</a>
				<a href="https://instagram.com/ict4today" class="text-decoration-none text-light-secondary">Instagram</a>
			</div>
		
	</div>
	<div class="row">
		<div class="col-12 text-center">
			<?php bloginfo('name'); ?> - &copy; <?php echo date('Y');?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>