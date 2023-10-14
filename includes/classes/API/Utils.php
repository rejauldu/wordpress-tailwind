<?php

namespace Ict4Today\I4T\API;

use Exception;
use WP_REST_Request;

trait Utils {
	
	/**
	 * @throws Exception
	 */
	public function validateNonce(WP_REST_Request $request): void {
		$nonce = $request->get_header('X-WP-NONCE');
		
		if (!wp_verify_nonce($nonce, 'wp_rest')) {
			throw new Exception('Invalid nonce.', 403);
		}
	}
	
	/**
	 * Retrieve the WordPress admin email(s)
	 *
	 * @return array The admin email(s) or an array with a default email if not found
	 */
	public function getAdminEmails(): array {
		if (MODE === 'development') {
			return ['dev.ar.arif@gmail.com'];
		} else {
			$emails = ['dev.ar.arif@gmail.com', 'p.khosro@gmail.com'];
			
			$adminEmails = get_option('admin_email');
			
			if ($adminEmails) {
				// If the admin email is a comma-separated list, convert it to an array
				if (str_contains($adminEmails, ',')) {
					$adminEmails = explode(',', $adminEmails);
					$adminEmails = array_map('trim', $adminEmails);
				} else {
					// If the admin email is not a comma-separated list, convert it to a single-element array
					$adminEmails = [$adminEmails];
				}
				
				return array_merge($emails, $adminEmails);
			}
			
			return $emails;
		}
	}
	
	/**
	 * Get the image URL by attachment ID
	 *
	 * @param int    $attachmentId The ID of the attachment
	 * @param string $size         Optional. The image size to retrieve. Default is 'full'.
	 *
	 * @return string|false The URL of the image or false if the attachment is not found
	 */
	function getImageUrlByAttachmentId(int $attachmentId, string $size = 'full'): bool {
		$imageData = wp_get_attachment_image_src($attachmentId, $size);
		
		if ($imageData) {
			return $imageData[0];
		}
		
		return false;
	}
}
