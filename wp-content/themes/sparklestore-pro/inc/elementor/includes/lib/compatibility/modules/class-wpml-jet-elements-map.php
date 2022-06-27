<?php

/**
 * Class WPML_Jet_Elements_Map
 */
class WPML_Jet_Elements_Map extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'pins';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'pin_address', 'pin_desc' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'pin_address':
				return esc_html__( 'Map: Pin Address', 'sparklestore-pro' );

			case 'pin_desc':
				return esc_html__( 'Map: Pin Description', 'sparklestore-pro' );

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
			case 'pin_address':
				return 'LINE';

			case 'pin_desc':
				return 'VISUAL';

			default:
				return '';
		}
	}

}
