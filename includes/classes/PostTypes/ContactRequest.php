<?php

namespace Ict4Today\I4T\PostTypes;

trait ContactRequest {
	/**
	 * Method register
	 *
	 * Register Custom Post Type Contact Request in WP dashboard
	 * @return void
	 */
	public function registerContactRequestPost(): void {
		$labels = [
			'name'                  => _x( 'Contact Requests', 'Post Type General Name', TEXT_DOMAIN ),
			'singular_name'         => _x( 'Contact Request', 'Post Type Singular Name', TEXT_DOMAIN ),
			'menu_name'             => _x( 'Contact Requests', 'Admin Menu text', TEXT_DOMAIN ),
			'name_admin_bar'        => _x( 'Contact Request', 'Add New on Toolbar', TEXT_DOMAIN ),
			'archives'              => __( 'Contact Request Archives', TEXT_DOMAIN ),
			'attributes'            => __( 'Contact Request Attributes', TEXT_DOMAIN ),
			'parent_item_colon'     => __( 'Parent Contact Request:', TEXT_DOMAIN ),
			'all_items'             => __( 'All Contact Requests', TEXT_DOMAIN ),
			'add_new_item'          => __( 'Add New Contact Request', TEXT_DOMAIN ),
			'add_new'               => __( 'Add New', TEXT_DOMAIN ),
			'new_item'              => __( 'New Contact Request', TEXT_DOMAIN ),
			'edit_item'             => __( 'Edit Contact Request', TEXT_DOMAIN ),
			'update_item'           => __( 'Update Contact Request', TEXT_DOMAIN ),
			'view_item'             => __( 'View Contact Request', TEXT_DOMAIN ),
			'view_items'            => __( 'View Contact Requests', TEXT_DOMAIN ),
			'search_items'          => __( 'Search Contact Request', TEXT_DOMAIN ),
			'not_found'             => __( 'Not found', TEXT_DOMAIN ),
			'not_found_in_trash'    => __( 'Not found in Trash', TEXT_DOMAIN ),
			'featured_image'        => __( 'Featured Image', TEXT_DOMAIN ),
			'set_featured_image'    => __( 'Set featured image', TEXT_DOMAIN ),
			'remove_featured_image' => __( 'Remove featured image', TEXT_DOMAIN ),
			'use_featured_image'    => __( 'Use as featured image', TEXT_DOMAIN ),
			'insert_into_item'      => __( 'Insert into Contact Request', TEXT_DOMAIN ),
			'uploaded_to_this_item' => __( 'Uploaded to this Contact Request', TEXT_DOMAIN ),
			'items_list'            => __( 'Contact Requests list', TEXT_DOMAIN ),
			'items_list_navigation' => __( 'Contact Requests list navigation', TEXT_DOMAIN ),
			'filter_items_list'     => __( 'Filter Contact Requests list', TEXT_DOMAIN )
		];

		$args = [
			'label'               => __( 'Contact Request', TEXT_DOMAIN ),
			'description'         => __( '', TEXT_DOMAIN ),
			'labels'              => $labels,
			'menu_icon'           => 'dashicons-phone',
			'supports'            => [ 'title' ],
			'taxonomies'          => [],
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'hierarchical'        => false,
			'exclude_from_search' => false,
			'show_in_rest'        => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'post'
		];

		// Post type key. Must not exceed 20 characters and may only contain lowercase alphanumeric characters, dashes, and underscores
		register_post_type( 'contact-request', $args );
	}
}
