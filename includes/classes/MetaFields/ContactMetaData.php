<?php

namespace Ict4Today\I4T\MetaFields;

use Ict4Today\I4T\API\Utils;

trait ContactMetaData {
	use Utils;

	/**
	 * Method registerReviewMetaBox
	 *
	 * Show the meta box area in the post edit screen
	 *
	 * @param object $post
	 *
	 * @return void
	 */
	public function registerContactMetaBox( object $post ): void {
		add_meta_box(
			'contactData',
			'Contact Data:',
			[ $this, 'contactMetaHTML' ],
			[ 'contact-request' ],
			'normal',
			'high'
		);
	}

	/**
	 * Method botConversationHTML
	 *
	 * HTML template for the meta box area
	 *
	 * @param object $post
	 *
	 * @return void
	 */
	public function contactMetaHTML( object $post ): void {
		$metaKeys = [
			'email'   => 'Email',
			'phone'   => 'Phone',
			'message' => 'Message',
		];

		foreach ( $metaKeys as $key => $name ) {
			$metaValue = get_post_meta( $post->ID, '_' . $key, true ) ?? '';

			echo '
		        <div>
		            <div style="display: flex; justify-content: flex-start; align-items: center; gap: 0.5rem;">
		                <strong style="font-size: 15px">' . $name . ':</strong>
		                <p style="letter-spacing: 0.5px">' . $metaValue . '</p>
		            </div>
		        </div>
		    ';
		}
	}
}
