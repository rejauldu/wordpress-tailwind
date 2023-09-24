<?php

namespace Ict4Today\I4T\API\Endpoints;

use Ict4Today\I4T\API\EndpointInterface;
use Ict4Today\I4T\API\Utils;
use Throwable;
use WP_REST_Request;
use WP_REST_Server;
use WpOrg\Requests\Exception;

class ContactUs implements EndpointInterface {
	use Utils;

	private object|null $requestBody = null;
	private array|null $data = null;

	/**
	 * Returns the HTTP method for the request.
	 *
	 * This function returns the HTTP method that should be used for the API request.
	 * The returned value indicates that the endpoint is creatable.
	 *
	 * @return string The HTTP method for the request. Possible values are \WP_REST_Server::CREATABLE.
	 */
	public function method(): string {
		return WP_REST_Server::CREATABLE;
	}

	/**
	 * Returns the endpoint name.
	 *
	 * This function returns the name of the endpoint.
	 * The returned value is 'get-a-quote'.
	 *
	 * @return string The endpoint name.
	 */
	public function endpoint(): string {
		return 'contact-us';
	}

	/**
	 * Endpoint callback function.
	 *
	 * @param WP_REST_Request $request
	 *
	 * @throws Exception|Throwable
	 */
	public function callback( WP_REST_Request $request ): void {
		try {
			$this->validateNonce( $request );
			$requestBody       = $request->get_body();
			$this->requestBody = json_decode( $requestBody );
			$this->checkData();
			$this->saveData();
			$this->sendEmail();

			wp_send_json_success( [
				'status'  => 'success',
				'message' => esc_html__( 'Form submitted successfully', TEXT_DOMAIN ),
			] );
		} catch ( \Exception $error ) {
			wp_send_json_error( [
				'status'  => 'error',
				'message' => esc_html__( $error->getMessage(), TEXT_DOMAIN )
			], $error->getCode() );
		}
	}

	/**
	 * Method checkData
	 *
	 * Check if required data is available in the request body
	 *
	 * @return void
	 * @throws Exception
	 */
	public function checkData(): void {
		if ( ! $this->requestBody ) {
			throw new Exception( "Request body is empty", 400 );
		}
		if ( ! isset( $this->requestBody->name ) || ! $this->requestBody->name ) {
			throw new Exception( "Name is not found in the request body", 400 );
		}
		if ( ! isset( $this->requestBody->email ) || ! $this->requestBody->email ) {
			throw new Exception( "Email is not found in the request body", 400 );
		}
		if ( ! isset( $this->requestBody->phone ) || ! $this->requestBody->phone ) {
			throw new Exception( "Phone number is not found in the request body", 400 );
		}
	}

	/**
	 * Save the data as a post, upload files, and add attachment IDs to the post metadata
	 *
	 *
	 * @return int
	 * @throws Exception
	 */
	public function saveData(): int {
		$postId = wp_insert_post( [
			'post_type'   => 'contact-request',
			'post_title'  => $this->requestBody->name,
			'post_status' => 'private'
		] );

		if ( is_wp_error( $postId ) ) {
			throw new Exception( "Unable to save the data", 500 );
		}

		$this->data = [
			'name'    => $this->requestBody->name,
			'email'   => $this->requestBody->email,
			'phone'   => $this->requestBody->phone,
			'message' => $this->requestBody->message,
		];

		foreach ( $this->data as $key => $value ) {
			update_post_meta( intval( $postId ), '_' . $key, sanitize_text_field( $value ) );
		}

		return $postId;
	}

	/**
	 * Send the email to the user & admin
	 * @throws Throwable
	 */
	public function sendEmail(): void {
		$this->sendEmailToUser();
		$this->sendEmailsToAdmin();
	}


	/**
	 * Send the email to the user
	 *
	 * @throws Throwable
	 */
	public function sendEmailToUser(): void {
		$to      = $this->requestBody->email;
		$subject = 'We have received your contact request';

		ob_start();

		include I4T_PATH . 'includes/email-templates/contact-us/client/index.php';

		$message = ob_get_clean();

		$headers = [ 'Content-Type: text/html; charset=UTF-8' ];

		if ( ! wp_mail( $to, $subject, $message, $headers ) ) {
			throw new Exception( "Unable to send the mail to user", 500 );
		}
	}


	/**
	 * Send the email to the admin
	 *
	 * @throws Throwable
	 */
	public function sendEmailsToAdmin(): void {
		$to      = $this->getAdminEmails();
		$subject = 'We have received a contact request';
		$data    = $this->data;

		ob_start();

		include I4T_PATH . 'includes/email-templates/contact-us/admin/index.php';

		$message = ob_get_clean();

		$headers = [ 'Content-Type: text/html; charset=UTF-8' ];

		if ( ! wp_mail( $to, $subject, $message, $headers ) ) {
			throw new Exception( "Unable to send the mail to admin", 500 );
		}
	}

	/**
	 * Permission callback for individual endpoint.
	 *
	 * @return mixed
	 */
	public function permissionCallback(): bool {
		return true;
	}
}
