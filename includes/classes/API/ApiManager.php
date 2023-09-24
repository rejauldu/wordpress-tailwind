<?php

namespace Ict4Today\I4T\API;


use Ict4Today\I4T\API\Endpoints\ContactUs;

/**
 * The `ApiManager` trait provides functionality for registering API endpoints with the WordPress REST API.
 *
 * This trait includes properties and methods related to managing API endpoints for a plugin.
 * It allows registering endpoints by looping through the `endpoints` array, which holds instances of classes
 * representing individual endpoints. The `registerApiEndPoints` method is responsible for registering each
 * endpoint using the `register_rest_route` function.
 *
 * @since 1.0.0
 */
trait ApiManager {
	/**
	 * Route for the endpoint.
	 */
	protected string|array $endpoints = [];
	
	/**
	 * API namespace
	 */
	private string $namespace = 'i4t/v1';
	
	
	/**
	 * Registers API endpoints for the plugin.
	 *
	 * This function is responsible for registering the API endpoints with the WordPress REST API.
	 * It loops through the `endpoints` array, which contains instances of classes representing the individual endpoints,
	 * and registers each endpoint using the `register_rest_route` function.
	 *
	 * @return void
	 */
	public function registerApiEndPoints(): void {
		// Endpoint url '/wp-json/j3/v1/contact-us'
		$this->endpoints[] = new ContactUs();
		
		foreach ($this->endpoints as $endpoint) {
			register_rest_route(
				$this->namespace,
				$endpoint->endpoint(),
				[
					'methods'             => $endpoint->method(),
					'callback'            => [$endpoint, 'callback'],
					'permission_callback' => [$endpoint, 'permissionCallback']
				]
			);
		}
	}
	
	/**
	 * Method addHTTPHeaders
	 *
	 * Add the required HTTP headers to the REST API request
	 *
	 * @return void
	 */
	public function addHTTPHeaders(): void {
		$originURL = '*';
		
		// Check if production environment or not
		if (MODE === 'production') {
			$originURL = site_url();
		}
		
		header('Access-Control-Allow-Origin: ' . $originURL);
		header('Access-Control-Allow-Credentials: true');
	}
}
