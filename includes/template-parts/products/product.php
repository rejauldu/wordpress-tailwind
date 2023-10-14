<?php extract($args);
$image = get_the_post_thumbnail_url($product->ID, 'full');
$wcProductObject = wc_get_product( $product->ID );

// Get the product price
if ( $wcProductObject->is_type( 'variable' ) ) {
    // Variable product price
    $price = $wcProductObject->get_variation_price();
} else {
    // Regular product price
    $price = $wcProductObject->get_regular_price();
}
?>
<div
    class="shadow-md rounded-lg overflow-hidden hover:shadow-lg group">
    <div class="grid gap-2 md:gap-6 content-start pb-6 justify-items-center text-center">
        <!--Product image -->
        <a href="<?php echo $product->guid ?? '' ?>" class='cursor-pointer bg-color14 overflow-hidden'>
            <img
                src="<?php echo $image ?? J3_PATH_URL . 'assets/images/section-images/placeholder.webp' ?>"
                alt=""
                class="w-full h-full object-contain group-hover:scale-110 transition-all duration-300"
                width="360"
                height="360"
                loading='lazy'
            />
        </a>
        <h5 class="line-clamp-1"><?php echo $product->post_name ?></h5>
        <span>BDT <?php echo $price ?></span>
        <a href="<?php echo $product->guid?? '' ?>" class="transition-all duration-500 hover:opacity-50 text-color16 whitespace-nowrap px-6 py-2 bg-gradient-to-r from-theme-primary to-theme-secondary text-center text-xl tracking-normal rounded-[1rem] hover:no-underline text-white">View product</a>
    </div>
</div>
