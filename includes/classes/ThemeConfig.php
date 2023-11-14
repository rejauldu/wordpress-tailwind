<?php

namespace Ict4Today\I4T;

trait ThemeConfig {
	/**
	 * Method setupThemeConfig
	 * Setup the theme configuration for the theme.
	 * ex: menus, title-tag, html5, custom-logo, registering nav menus etc.
	 *
	 * @return void
	 */
	public function setupThemeConfig() {
		$this->themeSupport();
		$this->registerMenus();
	}
	
	/**
	 * Method themeSupport
	 * Add theme support for the my-iclinic theme
	 *
	 * @return void
	 */
	public function themeSupport() {
		add_theme_support('menus');
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support('woocommerce', ['thumbnail_image_width' => 360]);
		add_theme_support('custom-background');
		add_theme_support('custom-header');
		add_theme_support('custom-logo');
		add_theme_support('automatic-feed-links');
		add_theme_support('html5', [
			'comment-list',
			'comment-form',
			'search-form',
			'gallery',
			'caption',
			'style',
			'script'
		]);
		add_theme_support('customize-selective-refresh-widgets');
		
		
		// add_image_size('woocommerce_thumbnail', 50, 50, true);
		// add_image_size('woocommerce_single', 600, 600, true);
		// add_filter('post_thumbnail_size', 'custom_product_thumbnail_size');
	}
	
	/**
	 * Register navigation menu for the theme
	 *
	 * @return void
	 */
	public static function registerMenus() {
		register_nav_menus([
			'headerMenu' => __('Header Menu'),
			'footerMenu' => __('Footer Menu')
		]);
	}
	
	function custom_product_thumbnail_size($size) {
		if ($size === 'product-medium') {
			return [360, 360, ['center', 'center']];
		} elseif ($size === 'product-full') {
			return [800, 800, ['center', 'center']];
		}
		return $size;
	}

	function register_custom_gutenberg_block() {
		// Register the block's JavaScript file.
		wp_register_script(
			'custom-block',
			get_template_directory_uri() . '/custom-blocks/index.js',
			array('wp-blocks', 'wp-editor', 'wp-components', 'wp-i18n')
		);

		// Register the block using 'register_block_type'.
		register_block_type('ict4today/custom-block', array(
			'editor_script' => 'custom-block',
		));
	}
}
