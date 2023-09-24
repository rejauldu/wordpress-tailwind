<?php

namespace Ict4Today\I4T;

use Ict4Today\I4T\API\ApiManager;
use Ict4Today\I4T\MetaFields\ContactMetaData;
use Ict4Today\I4T\PostTypes\ContactRequest;


class ActionHooks {
	use EnqueueFiles;
	use ThemeConfig;
	use LocalizeScripts;
	use ApiManager;
	use ContactRequest;
	use ContactMetaData;


	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'wpEnqueueScriptsHookCallback' ] );
		add_action( 'after_setup_theme', [ $this, 'setupThemeConfig' ] );
		add_action( 'init', [ $this, 'initHookCallback' ], 0 );

		// Register REST API endpoints
		add_action( 'rest_api_init', [ $this, 'registerApiEndPoints' ] );

		$this->initHookCallback();
	}

	/**
	 * Method initHookCallback
	 *
	 * Call back for hook 'init'
	 * @return void
	 */
	public function initHookCallback(): void {
		$this->registerContactRequestPost();

		$this->addMetaFields();
	}

	/**
	 * Method wpEnqueueScriptsHookCallback
	 *
	 * Call back for hook 'wp_enqueue_scripts'
	 * @return void
	 */
	public function wpEnqueueScriptsHookCallback(): void {
		$this->enqueueAssetFiles();
		$this->localizeJsScripts();
	}

	/**
	 * Method addMetaFields
	 *
	 * Register and save meta fields
	 *
	 * @return void
	 */
	public function addMetaFields(): void {
		add_action( 'add_meta_boxes_contact-request', [ $this, 'registerContactMetaBox' ], 10, 1 );
	}
}
