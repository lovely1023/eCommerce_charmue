<?php


function sparklestore_pro_sanitize_text($input) {
  return wp_kses_post(force_balance_tags($input));
}
/**
 * Sanitize checkbox.
 * @param  $input Whether the checkbox is input.
 */
function sparklestore_pro_sanitize_checkbox( $input ) {
  return ( ( isset( $input ) && true === $input ) ? true : false );
}

/**
 * Repeat Fields Sanitization
*/
function sparklestore_pro_sanitize_repeater($input) {

  $input_decoded = json_decode($input, true);

  if (!empty($input_decoded)) {
      foreach ($input_decoded as $boxes => $box) {
          foreach ($box as $key => $value) {
              $input_decoded[$boxes][$key] = wp_kses_post($value);
          }
      }

      return json_encode($input_decoded);
  }

  //return $input;
}

/**
* Sanitization Select.
*/
function sparklestore_pro_sanitize_select( $input, $setting ){
  //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
  $input = sanitize_key($input);
  //get the list of possible select options 
  $choices = $setting->manager->get_control( $setting->id )->choices;
  //return input if valid or return default option
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );  
}

/**
 * Switch Sanitization Function.
 *
 * @since 1.1
 */
function sparklestore_pro_sanitize_switch($input) {

    $valid_keys = array(
      'enable'  => esc_html__( 'Enable', 'sparklestore-pro' ),
      'disable' => esc_html__( 'Disable', 'sparklestore-pro' )
    );

    if ( array_key_exists( $input, $valid_keys ) ) {
      return $input;
    } else {
      return '';
    }
}

function sparklestore_pro_sanitize_hex_color($hex_color, $setting) {
  // Sanitize $input as a hex value without the hash prefix.
  $hex_color = sanitize_hex_color($hex_color);

  // If $input is a valid hex value, return it; otherwise, return the default.
  return (!is_null($hex_color) ? $hex_color : $setting->default );
}

function sparklestore_pro_sanitize_html($html) {
  return wp_filter_post_kses($html);
}
/**
 * Number with blank value sanitization callback
 *
 */
function sparklestore_pro_sanitize_number_blank($val) {
  return is_numeric($val) ? $val : '';
}

function sparklestore_pro_sanitize_choices($input, $setting) {
  global $wp_customize;

  $control = $wp_customize->get_control($setting->id);

  if (array_key_exists($input, $control->choices)) {
      return $input;
  } else {
      return $setting->default;
  }
}

function sparklestore_pro_sanitize_choices_array($input, $setting) {
  global $wp_customize;

  if (!empty($input)) {
      $input = array_map('absint', $input);
  }

  return $input;
}

function sparklestore_pro_sanitize_color_alpha($color) {
  $color = str_replace('#', '', $color);
  if ('' === $color) {
      return '';
  }

  // 3 or 6 hex digits, or the empty string.
  if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', '#' . $color)) {
      // convert to rgb
      $colour = $color;
      if (strlen($colour) == 6) {
          list( $r, $g, $b ) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
      } elseif (strlen($colour) == 3) {
          list( $r, $g, $b ) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
      } else {
          return false;
      }
      $r = hexdec($r);
      $g = hexdec($g);
      $b = hexdec($b);
      return 'rgba(' . join(',', array('r' => $r, 'g' => $g, 'b' => $b, 'a' => 1)) . ')';
  }

  return strpos(trim($color), 'rgb') !== false ? $color : false;
}

/**
* Sanitize GPS Latitude and Longitude
*/
function sparklestore_pro_sanitize_lat_long($coords) {
  if (preg_match('/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?),[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', $coords)) {
      return $coords;
  } else {
      return 'error';
  }
}

function sparklestore_pro_sanitize_image($image, $setting) {
  /*
   * Array of valid image file types.
   *
   * The array includes image mime types that are included in wp_get_mime_types()
   */
  $mimes = array(
      'jpg|jpeg|jpe' => 'image/jpeg',
      'gif' => 'image/gif',
      'png' => 'image/png',
      'bmp' => 'image/bmp',
      'tif|tiff' => 'image/tiff',
      'ico' => 'image/x-icon'
  );
  // Return an array with file extension and mime_type.
  $file = wp_check_filetype($image, $mimes);
  // If $image has a valid mime_type, return it; otherwise, return the default.
  return ( $file['ext'] ? $image : $setting->default );
}


if ( ! function_exists( 'sparklestorepro_sanitize_field_default_css_box' ) ) :

	/**
	 * Sanitize Default Css Box
	 *
	 * @since sparklestorepro 1.0.0
	 *
	 * @param $input
	 * @return array
	 *
	 */
	function sparklestorepro_sanitize_field_default_css_box( $input, $sparklestorepro_setting ) {

		$input_decoded = json_decode( $input, true );
		$output        = array();
		if ( ! empty( $input_decoded ) ) {
			foreach ( $input_decoded as $device_id => $device_details ) {
				foreach ( $device_details as $key => $value ) {
					if ( $key == 'cssbox_link' ) {
						$output[ $device_id ][ $key ] = sparklestore_pro_sanitize_checkbox( $value );
					} else {
						$output[ $device_id ][ $key ] = !empty( $value ) ? intval( $value ) : '';
					}
				}
			}
			return json_encode( $output );
		}
		return $input;

	}
endif;

if ( ! function_exists( 'sparklewp_sanitize_field_background' ) ) :

	/**
	 * Sanitize Field Background
	 *
	 * @since SparkleStore Pro 1.2.8
	 *
	 * @param $input
	 * @return array
	 *
	 */
	function sparklewp_sanitize_field_background( $input, $sparklewp_setting ) {

		$input_decoded = json_decode( $input, true );
		$output        = array();

		if ( ! empty( $input_decoded ) ) {
			foreach ( $input_decoded as $key => $value ) {

				switch ( $key ) :
					case 'background-size':
					case 'background-position':
					case 'background-repeat':
					case 'background-attachment':
						$output[ $key ] = sanitize_key( $value );
						break;

					case 'background-image':
						$output[ $key ] = esc_url_raw( $value );
						break;
					case 'background-color':
					case 'background-hover-color':
					case 'background-color-title':
					case 'title-font-color':
					case 'background-color-post':
					case 'site-title-color':
					case 'site-tagline-color':
					case 'post-font-color':
					case 'text-color':
					case 'text-hover-color':
					case 'title-color':
					case 'link-color':
					case 'link-hover-color':
					case 'on-sale-bg':
					case 'on-sale-color':
					case 'out-of-stock-bg':
					case 'out-of-stock-color':
					case 'rating-color':
					case 'grid-list-color':
					case 'grid-list-hover-color':
					case 'categories-color':
					case 'categories-hover-color':
					case 'deleted-price-color':
					case 'deleted-price-hover-color':
					case 'price-color':
					case 'price-hover-color':
					case 'content-color':
					case 'content-hover-color':
					case 'tab-list-color':
					case 'tab-content-color':
					case 'tab-list-border-color':
					case 'tab-content-border-color':
					case 'background-stripped-color':
					case 'button-color':
					case 'button-hover-color':
					case 'icon-color':
					case 'icon-hover-color':
					case 'meta-color':
					case 'next-prev-color':
					case 'next-prev-hover-color':
					case 'button-bg-color':
					case 'button-bg-hover-color':
						$output[ $key ] = sanitize_hex_color( $value );
						break;
					default:
						$output[ $key ] = sanitize_text_field( $value );
						break;
				endswitch;
			}
			return json_encode( $output );
		}

		return $input;

	}

endif;


if ( ! function_exists( 'sparklewp_sanitize_field_border' ) ) :
	/**
	 * Sanitize Field Border
	 *
	 * @since SparkleStore Pro 1.2.8
	 *
	 * @param $input
	 * @return array
	 *
	 */
	function sparklewp_sanitize_field_border( $input, $sparklewp_setting ) {
		$input_decoded = json_decode( $input, true );

		$output = array();

		if ( ! empty( $input_decoded ) ) {
			foreach ( $input_decoded as $key => $value ) {

				switch ( $key ) :
					case 'border-style':
						$output[ $key ] = sanitize_key( $value );
						break;

					case 'border-width':
					case 'border-shadow-css':
					case 'box-shadow-css':
					case 'border-radius':
						$devices_values = array();
						foreach ( $value as $device => $device_value ) {
							foreach ( $device_value as $single_key => $single_value ) {
								$devices_values[ $device ][ $single_key ] = absint( $single_value );
							}
						}
						$output[ $key ] = $devices_values;
						break;

					default:
						$output[ $key ] = sanitize_text_field( $value );
						break;
				endswitch;
			}
			return json_encode( $output );
		}

		return $input;

	}
endif;

if ( ! function_exists( 'sparklewp_sanitize_field_responsive_buttonset' ) ) :
	/**
	 * Check if Json
	 *
	 * @since 1.2.8
	 * @param  $input ,$setting
	 * @return boolean
	 */
	function sparklewp_sanitize_field_responsive_buttonset( $input ) {

		$range_value            = json_decode( $input, true );
		$range_value['desktop'] = ! empty( $range_value['desktop'] ) ? sanitize_text_field( $range_value['desktop'] ) : '';
		$range_value['tablet']  = ! empty( $range_value['tablet'] ) ? sanitize_text_field( $range_value['tablet'] ) : '';
		$range_value['mobile']  = ! empty( $range_value['mobile'] ) ? sanitize_text_field( $range_value['mobile'] ) : '';

		return json_encode( $range_value );
	}

endif;