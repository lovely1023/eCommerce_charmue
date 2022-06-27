<?php

/**
 * Class WPML_Jet_Elements_Slider
 */
class WPML_Jet_Elements_Slider extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'item_list';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'item_title', 'item_subtitle', 'item_desc', 'item_button_primary_text', 'item_button_secondary_text' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'item_title':
				return esc_html__( 'Slider: Slide Title', 'sparklestore-pro' );

			case 'item_subtitle':
				return esc_html__( 'Slider: Slide Subtitle', 'sparklestore-pro' );

			case 'item_desc':
				return esc_html__( 'Slider: Slide Description', 'sparklestore-pro' );

			case 'item_button_primary_text':
				return esc_html__( 'Slider: Slide Button Primary Text', 'sparklestore-pro' );

			case 'item_button_secondary_text':
				return esc_html__( 'Slider: Slide Button Secondary Text', 'sparklestore-pro' );

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
			case 'item_title':
				return 'LINE';

			case 'item_subtitle':
				return 'LINE';

			case 'item_desc':
				return 'VISUAL';

			case 'item_button_primary_text':
				return 'LINE';

			case 'item_button_secondary_text':
				return 'LINE';

			default:
				return '';
		}
	}

}
