<?php

/**
 * Class WPML_Jet_Elements_Portfolio
 */
class WPML_Jet_Elements_Portfolio extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'image_list';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'item_category', 'item_title', 'item_desc', 'item_button_text' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'item_category':
				return esc_html__( 'Portfolio: Item Category', 'sparklestore-pro' );

			case 'item_title':
				return esc_html__( 'Portfolio: Item Title', 'sparklestore-pro' );

			case 'item_desc':
				return esc_html__( 'Portfolio: Item Description', 'sparklestore-pro' );

			case 'item_button_text':
				return esc_html__( 'Portfolio: Item Link Text', 'sparklestore-pro' );

			default:
				return '';
		}
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch( $field ) {
			case 'item_category':
				return 'LINE';

			case 'item_title':
				return 'LINE';

			case 'item_desc':
				return 'VISUAL';

			case 'item_button_text':
				return 'LINE';

			default:
				return '';
		}
	}

}
