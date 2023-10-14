<?php get_header(); ?>
<section class="bg-gray-100">
	<div class="container mx-auto grid md:grid-cols-[1fr_auto]">
		<div class="grid gap-6 content-center p-5 text-center sm:text-left">
			<span class="text-6xl italic"><?php bloginfo('description'); ?></span>
			<h1><?php bloginfo('name'); ?></h1>
			<p>Direct to your home</p>
			<div>
				<?php get_template_part('includes/template-parts/buttons/btn-secondary'); ?>
			</div>
			
		</div>
		<img alt="Girl with shopping cart" width="461" height="541" class="w-100 h-100" src="<?php echo get_theme_file_uri(); ?>/assets/images/masthead-images/cart-girl.webp" />
	</div>
</section>
	<div class="container mx-auto">

			<?php if (have_posts()) :
				while (have_posts()) : the_post();

				the_content();

				endwhile;

				else :
					echo '<p>No content found</p>';

				endif; ?>
			
	</div>
<?php get_template_part('includes/template-parts/products/index', '', [
	'postPerPage' => 20
]); ?>
<?php get_footer();?>