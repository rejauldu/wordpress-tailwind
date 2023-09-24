<?php

namespace Ict4Today\I4T;

trait LocalizeScripts {
	/**
	 * Method localizeJsScripts
	 *
	 * Localize JavaScript scripts with php data through variables
	 * @return void
	 */
	public function localizeJsScripts(): void {
		$handlers = [ 'contact-form' ];

		foreach ( $handlers as $handler ) {
			wp_localize_script( $handler, 'globalVariables', [
				'siteUrl'      => site_url( '/' ),
				'restUrl'      => site_url( '/' ) . 'wp-json/wp/v2',
				'themeRestUrl' => site_url( '/' ) . 'wp-json/i4t/v1',
				'assetsUrl'    => I4T_PATH_URL . 'assets/',
				'nonce'        => wp_create_nonce( 'wp_rest' ),
			] );
		}
	}
}
