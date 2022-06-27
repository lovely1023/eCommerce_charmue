<?php
/**
 * The background field.
 *
 * @package Meta Box
 */

/**
 * The Background field.
 */
class RWMB_Background_Field extends RWMB_Field {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
		wp_enqueue_style( 'rwmb-background', RWMB_CSS_URL . 'background.css', '', RWMB_VER );

		RWMB_Color_Field::admin_enqueue_scripts();
		RWMB_File_Input_Field::admin_enqueue_scripts();
	}

	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field settings.
	 *
	 * @return string
	 */
	public static function html( $meta, $field ) {
		$meta = wp_parse_args(
			$meta,
			array(
				'color'      => '',
				'image'      => '',
				'repeat'     => '',
				'attachment' => '',
				'position'   => '',
				'size'       => '',
			)
		);

		$output = '<div class="rwmb-background-row">';

		// Color.
		$color   = RWMB_Color_Field::normalize(
			array(
				'type'       => 'color',
				'id'         => "{$field['id']}_color",
				'field_name' => "{$field['field_name']}[color]",
			)
		);
		$output .= RWMB_Color_Field::html( $meta['color'], $color );

		$output .= '</div><!-- .rwmb-background-row -->';
		$output .= '<div class="rwmb-background-row">';

		// Image.
		$image   = RWMB_File_Input_Field::normalize(
			array(
				'type'        => 'file_input',
				'id'          => "{$field['id']}_image",
				'field_name'  => "{$field['field_name']}[image]",
				'placeholder' => __( 'Background Image', 'sparklestore-pro' ),
			)
		);
		$output .= RWMB_File_Input_Field::html( $meta['image'], $image );

		$output .= '</div><!-- .rwmb-background-row -->';
		$output .= '<div class="rwmb-background-row">';

		// Repeat.
		$repeat  = RWMB_Select_Field::normalize(
			array(
				'type'        => 'select',
				'id'          => "{$field['id']}_repeat",
				'field_name'  => "{$field['field_name']}[repeat]",
				'placeholder' => esc_html__( '-- Background Repeat --', 'sparklestore-pro' ),
				'options'     => array(
					'no-repeat' => esc_html__( 'No Repeat', 'sparklestore-pro' ),
					'repeat'    => esc_html__( 'Repeat All', 'sparklestore-pro' ),
					'repeat-x'  => esc_html__( 'Repeat Horizontally', 'sparklestore-pro' ),
					'repeat-y'  => esc_html__( 'Repeat Vertically', 'sparklestore-pro' ),
					'inherit'   => esc_html__( 'Inherit', 'sparklestore-pro' ),
				),
			)
		);
		$output .= RWMB_Select_Field::html( $meta['repeat'], $repeat );

		// Position.
		$position = RWMB_Select_Field::normalize(
			array(
				'type'        => 'select',
				'id'          => "{$field['id']}_position",
				'field_name'  => "{$field['field_name']}[position]",
				'placeholder' => esc_html__( '-- Background Position --', 'sparklestore-pro' ),
				'options'     => array(
					'top left'      => esc_html__( 'Top Left', 'sparklestore-pro' ),
					'top center'    => esc_html__( 'Top Center', 'sparklestore-pro' ),
					'top right'     => esc_html__( 'Top Right', 'sparklestore-pro' ),
					'center left'   => esc_html__( 'Center Left', 'sparklestore-pro' ),
					'center center' => esc_html__( 'Center Center', 'sparklestore-pro' ),
					'center right'  => esc_html__( 'Center Right', 'sparklestore-pro' ),
					'bottom left'   => esc_html__( 'Bottom Left', 'sparklestore-pro' ),
					'bottom center' => esc_html__( 'Bottom Center', 'sparklestore-pro' ),
					'bottom right'  => esc_html__( 'Bottom Right', 'sparklestore-pro' ),
				),
			)
		);
		$output  .= RWMB_Select_Field::html( $meta['position'], $position );

		// Attachment.
		$attachment = RWMB_Select_Field::normalize(
			array(
				'type'        => 'select',
				'id'          => "{$field['id']}_attachment",
				'field_name'  => "{$field['field_name']}[attachment]",
				'placeholder' => esc_html__( '-- Background Attachment --', 'sparklestore-pro' ),
				'options'     => array(
					'fixed'   => esc_html__( 'Fixed', 'sparklestore-pro' ),
					'scroll'  => esc_html__( 'Scroll', 'sparklestore-pro' ),
					'inherit' => esc_html__( 'Inherit', 'sparklestore-pro' ),
				),
			)
		);
		$output    .= RWMB_Select_Field::html( $meta['attachment'], $attachment );

		// Size.
		$size    = RWMB_Select_Field::normalize(
			array(
				'type'        => 'select',
				'id'          => "{$field['id']}_size",
				'field_name'  => "{$field['field_name']}[size]",
				'placeholder' => esc_html__( '-- Background Size --', 'sparklestore-pro' ),
				'options'     => array(
					'inherit' => esc_html__( 'Inherit', 'sparklestore-pro' ),
					'cover'   => esc_html__( 'Cover', 'sparklestore-pro' ),
					'contain' => esc_html__( 'Contain', 'sparklestore-pro' ),
				),
			)
		);
		$output .= RWMB_Select_Field::html( $meta['size'], $size );
		$output .= '</div><!-- .rwmb-background-row -->';

		return $output;
	}

	/**
	 * Format a single value for the helper functions. Sub-fields should overwrite this method if necessary.
	 *
	 * @param array    $field   Field parameters.
	 * @param array    $value   The value.
	 * @param array    $args    Additional arguments. Rarely used. See specific fields for details.
	 * @param int|null $post_id Post ID. null for current post. Optional.
	 *
	 * @return string
	 */
	public static function format_single_value( $field, $value, $args, $post_id ) {
		if ( empty( $value ) ) {
			return '';
		}
		$output = '';
		$value  = array_filter( $value );
		foreach ( $value as $key => $subvalue ) {
			$subvalue = 'image' === $key ? 'url(' . esc_url( $subvalue ) . ')' : $subvalue;
			$output  .= 'background-' . $key . ': ' . $subvalue . ';';
		}
		return $output;
	}
}
