<?php

namespace Ict4Today\I4T\API;

use WP_REST_Request;

/**
 * The `EndpointInterface` interface defines the contract for an API endpoint.
 *
 * Implementing classes must adhere to this interface and provide implementations for its methods.
 * The interface defines methods related to the HTTP method, endpoint name, callback function, and permission callback
 * for an API endpoint.
 *
 * @since 1.0.0
 */
interface EndpointInterface {
	/**
	 * Method for the request.
	 *
	 * \WP_REST_Server::CREATABLE, \WP_REST_Server::READABLE, \WP_REST_Server::EDITABLE, \WP_REST_Server::DELETABLE,
	 */
	public function method();

	/**
	 * Method endpoint
	 *
	 * Return endpoint name.
	 *
	 * @return string
	 */
	public function endpoint(): string;

	/**
	 * Endpoint callback function.
	 *
	 * @param WP_REST_Request $request
	 */
	public function callback( WP_REST_Request $request ): void;

	/**
	 * Permission callback for individual endpoint.
	 *
	 * @return bool
	 */
	public function permissionCallback(): bool;
}
