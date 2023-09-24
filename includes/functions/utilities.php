<?php

/**
 * Function getSVG
 * Include svg image with a span wrapper
 *
 * @param string $imagePath [explicits description]
 * @param string $class     [explicits description]
 *
 * @return void
 */
function getSVG(string $imagePath, string $class = '') {
	if (!$imagePath) {
		return null;
	}
	
	echo '<span class="block ' . esc_attr($class) . '">';
	include I4T_PATH . $imagePath;
	echo '</span>';
}

/**
 * Retrieves an array of product categories with associated products.
 *
 * @param int $numberOfCategories Optional. The number of categories to retrieve.
 * @return array|WP_Error An array of term objects representing the product categories with associated products,
 *                                or a WP_Error object if there was an error retrieving the categories.
 */
function getProductCategories(int $numberOfCategories = 0): array|WP_Error {
	$args = [
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
		'number'     => $numberOfCategories,
		'orderby'    => 'count',
		'order'      => 'DESC'
	];
	
	return get_terms($args);
}


/**
 * Retrieves products based on given categories and orders them by an array of product IDs.
 *
 * @param array $categories An array of category IDs.
 * @param array $orderedProductIDs An array of product IDs for custom ordering.
 *
 * @return array An array of ordered product posts.
 */
function getProductsByCategories(array $categories = [], array $orderedProductIDs = []): array {
	$args = [
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => 50,
		'tax_query'      => [
			[
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $categories,
			],
		],
		'post__in'       => $orderedProductIDs,
		'orderby'        => 'post__in',
	];
	
	$query = new WP_Query($args);
	
	if ($query->have_posts()) {
		return $query->get_posts();
	}
	
	return [];
}

/**
 * Retrieves the product categories associated with a given product ID.
 *
 * @param int $productId The ID of the product.
 *
 * @return array An array of WP_Term objects representing the product categories.
 */
function getProductCategoriesByID(int $productId): array {
	// Get the product categories
	$categories = wp_get_post_terms($productId, 'product_cat');
	
	if (!empty($categories) && !is_wp_error($categories)) {
		return $categories;
	}
	
	return [];
}

/**
 * Retrieves an array of random WordPress products.
 *
 * This function queries the WordPress database for products and returns a random selection of products.
 *
 * @param array $args Optional. An array of arguments to customize the query. Default is an empty array.
 *                    - 'postPerPage' (int): The number of products to retrieve per page. Default is -1 (retrieve all).
 *
 * @return array An array of random product posts.
 */
function getProducts(array $args = []): array {
	$postPerPage = $args['postPerPage'] ?? -1;
	
	$queryArgs = [
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => $postPerPage,
		'orderby'        => 'rand', // Order by random
	];
	
	$query = new WP_Query($queryArgs);
	
	if ($query->have_posts()) {
		return $query->get_posts();
	}
	
	return [];
}

/**
 * Get an array of products by their category slugs.
 *
 * Retrieves products based on the provided category slugs.
 * If no category slugs are provided, it retrieves products from all categories.
 *
 * @param array|string $slugs       An array of category slugs to search for, or an empty array to retrieve products from all categories.
 * @param int          $postPerPage Optional. The number of products to retrieve per page. Default is 10.
 * @return array                    An array of product objects matching the category slugs, or an empty array if no products found.
 */
function getProductsByCategorySlug($slugs = [], $postPerPage = 10): array {
    if (count($slugs) === 0) {
        $args = [
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => $postPerPage,
        ];
    } else {
        $args = [
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => $postPerPage,
            'tax_query'      => [
                [
                    'taxonomy' => 'product_cat', // Replace 'product_cat' with the actual taxonomy slug for your product categories
                    'field'    => 'slug',
                    'terms'    => (array) $slugs,
                ],
            ],
        ];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        return $query->get_posts();
    }

    return [];
}


/**
 * Retrieves the WooCommerce attributes for a product based on the provided product ID.
 *
 * @param int $productId The ID of the product.
 *
 * @return array An array of attribute values for the specified product ID.
 */
function getWoocommerceAttributes(int $productId): array {
	$color_attribute = 'pa_color'; // Replace with your attribute name
	
	// Get the product object
	$product = wc_get_product($productId);
	
	// Get the product attributes
	$product_attributes = $product->get_attributes();
	
	// Initialize an empty array to store the attribute values
	$attribute_values = [];
	
	// Loop through the attributes to find the desired attribute by name
	foreach ($product_attributes as $attribute) {
		if ($attribute->get_name() === $color_attribute) {
			// Get the attribute values
			$attribute_values = $attribute->get_options();
			break; // Exit the loop once the attribute is found
		}
	}
	
	// Return the attribute values
	return $attribute_values;
}
/**
 * Retrieves product categories based on given slugs and orders them accordingly.
 *
 * @param array $slugs An array of category slugs.
 *
 * @return array An array of product category objects.
 */
function getProductCategoriesBySlug(array $slugs = []): array {
    $args = [
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
        'slug'       => $slugs,
    ];

    $categories = get_terms($args);

    // Order categories based on the provided array of slugs
    $orderedCategories = [];
    foreach ($slugs as $slug) {
        foreach ($categories as $category) {
            if ($slug === $category->slug) {
                $orderedCategories[] = $category;
                break;
            }
        }
    }

    return $orderedCategories;
}

/**
 * Retrieves the title of the current WordPress page.
 *
 * This function uses the WordPress function get_queried_object() to get the current page object.
 * If the current page object is a valid post object (WP_Post), it returns the page title.
 * If the current page is not a valid post object or not within the WordPress context, it returns an empty string.
 *
 * @return string The title of the current page, or an empty string if the title cannot be retrieved.
 */
function getPageTitle() {
	$current_page = get_queried_object();
	if ($current_page) {
		$page_title = $current_page->post_title;
		return $page_title;
	}
	return '';
}

/**
 * Checks if a given menu item URL matches the current page URL and returns the specified class if they match.
 *
 * @param object $menu_item The menu item to compare with.
 * @param string $class     The class to return if the URLs match (default: 'active').
 *
 * @return string Returns the specified class if the URLs match; otherwise, an empty string.
 */
function i4t_check_active_menu( $menu_item, $class = 'active' ) {
    $actual_link = ( isset( $_SERVER['HTTPS'] ) ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if ( $actual_link == $menu_item->url ) {
        return $class;
    }
    return '';
}

function dd( $v ) {
	echo '<pre>';
    var_dump($v);
	echo '</pre>';
	exit;
}