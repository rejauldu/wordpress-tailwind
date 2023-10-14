<!-- #format-tailwind -->

<?php
extract($args);

$products = getProducts($args);
?>

<section class="overflow-hidden bg-color11 py-4 md:py-8 relative" id="products">
	<div class="grid gap-12 md:gap-20 !px-0">
		<h2 class="text-center">
			<?php echo $heading ?? 'Popular products' ?>
		</h2>
		<div class="container mx-auto">
			<div class="grid md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-6 gap-2 md:gap-4 xl:gap-8">
				<?php foreach($products as $product) {?>
					<?php get_template_part('includes/template-parts/products/product', '', [
						'product' => $product
					]); ?>
				<?php }?>
			</div>
		</div>
		

	</div>
</section>