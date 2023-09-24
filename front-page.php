<?php get_header(); ?>
<section class="position-relative">
	<img class="w-100 h-100" src="<?php echo get_theme_file_uri(); ?>/assets/images/banner.webp" />
	<div class="container-fluid position-absolute top-0 h-100">
		<div class="row h-100">
			<div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
				<div >
					<h1><a class="text-decoration-none text-light" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
					<h5 class="text-light"><?php bloginfo('description'); ?></h5>
					<div>
						<a class="btn btn-warning" href="/fruits">All fruits</a>
						<a class="btn btn-primary" href="/mangoes">Mangoes</a>
						<span class="text-red-500">Tailwind</span>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	
</section>
	<div class="">

			<?php if (have_posts()) :
				while (have_posts()) : the_post();

				the_content();

				endwhile;

				else :
					echo '<p>No content found</p>';

				endif; ?>
			
	</div>
	<?php get_footer();

?>