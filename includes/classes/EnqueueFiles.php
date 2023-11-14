<?php

namespace Ict4Today\I4T;

trait EnqueueFiles {
	public function enqueueAssetFiles(): void {
		$this->loadStyles();
		$this->loadScripts();
		$this->loadReactFiles();
		$this->reCaptcha();
	}

	/**
	 * Method loadStyles
	 * Load the required CSS files for the project
	 * @return void
	 */
	public function loadStyles(): void {
		// wp_enqueue_style( 'i4t-theme', get_stylesheet_uri() );

		if ( MODE !== 'development' ) {
			wp_enqueue_style(
				'i4t',
				I4T_PATH_URL . 'build/styles/main.min.css',
				[],
				VERSION,
				'all'
			);
		}
	}

	/**
	 * Method loadScripts
	 * Load the required JS files for the project
	 * @return void
	 */
	public function loadScripts(): void {
		wp_enqueue_script(
			'i4t',
			I4T_PATH_URL . 'build/scripts/main.min.js',
			[],
			VERSION,
			true
		);

		// wp_enqueue_script(
		// 	'custom-block',
		// 	get_template_directory_uri() . '/custom-blocks/index.js',
		// 	array('wp-blocks', 'wp-editor', 'wp-components', 'wp-i18n'),
		// 	filemtime(get_template_directory() . '/custom-blocks/index.js')
		// );
	}

	/**
	 * Load the react files based on required screens
	 * @return void
	 */
	public function loadReactFiles(): void {
		wp_enqueue_script(
			'contact-form',
			I4T_PATH_URL . 'react-components/contact-form/build/index.js',
			[],
			time(),
			true
		);

		if ( is_page( 'contact-us' ) ) {
			// Component styles
			wp_enqueue_style(
				'contact-form',
				I4T_PATH_URL . 'react-components/contact-form/build/styles/main.min.css',
				[],
				VERSION,
				'all'
			);

			// Component scripts
			wp_enqueue_script(
				'contact-form',
				I4T_PATH_URL . 'react-components/contact-form/build/index.js',
				[],
				VERSION,
				true
			);
		}
	}
	/**
	 * Method load google reCaptcha
	 * Load the required JS files for the project
	 * @return void
	 */
	public function reCaptcha(): void {
		if ( is_page( 'contact-us' ) ) {
			wp_enqueue_script(
				'recaptcha',
				"https://www.google.com/recaptcha/api.js",
				[],
				VERSION,
				true
			);
		}
	}

	function enqueue_custom_block_assets() {
		wp_enqueue_script('custom-block', get_template_directory_uri() . '/custom-blocks/index.js', array('wp-blocks', 'wp-editor', 'wp-components', 'wp-i18n'), null, true);
	}
}
