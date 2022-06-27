<?php
/**
 * Customizer  Builder
 * @package SparkleStore Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'sparklewp_customizer_builder_sanitize_field_recursive' ) ) {

	function sparklewp_customizer_builder_sanitize_field_recursive( $value ) {
		if ( ! is_array( $value ) ) {
			$value = wp_kses_post( $value );
		} else {
			if ( is_array( $value ) ) {
				foreach ( $value as $k => $v ) {
					$value[ $k ] = sparklewp_customizer_builder_sanitize_field_recursive( $v );
				}
			}
		}
		return $value;
	}
}

if ( ! function_exists( 'sparklewp_customizer_builder_sanitize_field' ) ) {

	function sparklewp_customizer_builder_sanitize_field( $input ) {
		$input = wp_unslash( $input );
		if ( ! is_array( $input ) ) {
			$input = json_decode( urldecode_deep( $input ), true );
		}
		$output = sparklewp_customizer_builder_sanitize_field_recursive( $input );
		$output = json_encode( $output );
		return $output;
	}
}

/**
 * Add Builder to WP Customize
 *
 * Class SparkleWP_Customizer_Builder
 */
class SparkleWP_Customizer_Builder {

	/**
	 * Main Instance
	 *
	 * Insures that only one instance of SparkleWP_Customizer_Builder exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since    1.2.8
	 * @access   public
	 *
	 * @return object
	 */
	public static function instance() {

		// Store the instance locally to avoid private static replication
		static $instance = null;

		// Only run these methods if they haven't been ran previously
		if ( null === $instance ) {
			$instance = new SparkleWP_Customizer_Builder;
		}

		// Always return the instance
		return $instance;
	}

	/**
	 * Run functionality with hooks
	 *
	 * @since    1.2.8
	 * @access   public
	 *
	 * @return void
	 */
	function run() {

		if ( is_admin() ) {
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue' ) );
			add_action( 'customize_controls_print_footer_scripts', array( $this, 'builder_template' ) );
		}

	}

	/**
	 * Get all builders registered.
	 *
	 * Insures that every builder is registered by sparklewp_builders filter
	 *
	 * @since    1.2.8
	 * @access   public
	 *
	 * @return array
	 */
	public function get_builders() {
		$builders = array();
		$builders = apply_filters( 'sparklewp_builders', $builders );
		return $builders;
	}

	/**
	 * Callback functions for customize_controls_enqueue_scripts,
	 * Enqueue script and style for builder
	 *
	 * @since    1.2.8
	 * @access   public
	 *
	 * @return void
	 */
	function enqueue() {
		wp_enqueue_style('customizer-builder', SPARKLESTORE_PRO_URL . '/inc/library/customizer-builder/assets/css/builder.css', array(), SPARKLESTORE_PRO_VERSION);
		wp_enqueue_script(
			'customizer-builder',
			SPARKLESTORE_PRO_URL . '/inc/library/customizer-builder/assets/js/builder' . SPARKLESTORE_PRO_SCRIPT_PREFIX . '.js',
			array(
				'customize-controls',
				'jquery-ui-resizable',
				'jquery-ui-droppable',
				'jquery-ui-draggable',
			),
			SPARKLESTORE_PRO_VERSION,
			true
		);

		wp_localize_script(
			'customizer-builder',
			'SparkleWP_Customizer_Builder',
			array(
				'footer_moved_widgets_text' => '',
				'builders'                  => $this->get_builders(),
				'is_rtl'                    => is_rtl(),
				'desktop_label'             => esc_html__( 'Desktop', 'sparklestore-pro' ),
				'mobile_tablet_label'       => esc_html__( 'Mobile/Tablet', 'sparklestore-pro' ),
			)
		);
	}



	/**
	 * Callback functions for customize_controls_print_footer_scripts,
	 * Add Builder Template
	 *
	 * @since    1.2.8
	 * @access   public
	 *
	 * @return void
	 */
	function builder_template() {
		?>
		<script type="text/html" id="tmpl-sparkle-builder-panel">
			<div class="sparklewp-customize-builder">
				<div class="sparklewp-cb-inner">
					<div class="sparklewp-cb-header">
						<div class="sparklewp-cb-devices-switcher">
						</div>
						<div class="sparklewp-cb-actions">
							<a class="button button-secondary sparklewp-panel-close" href="#">
								<span class="close-text"><?php esc_html_e( 'Close', 'sparklestore-pro' ); ?></span>
								<span class="panel-name-text">{{ data.title }}</span>
							</a>
						</div>
					</div>
					<div class="sparklewp-cb-body"></div>
				</div>
			</div>
		</script>

		<script type="text/html" id="tmpl-sparklewp-cb-panel">
			<# if ( data.device != 'all' ) { #>
				<div class="sparklewp-cp-rows">
					<# if ( ! _.isUndefined( data.rows.top ) ) { #>
					<div class="sparklewp-row-top sparklewp-cb-row" data-id="{{ data.id }}_top">
						<div class="sparklewp-row-inner">
							<div class="builder-grid-row">
								<?php
								for ( $i = 1; $i <= 12; $i ++ ) {
									echo '<div></div>';
								}
								?>
							</div>
							<div class="sparklewp-cb-items grid-stack gridster" data-id="top"></div>
						</div>
						<a class="sparklewp-cb-row-settings" title="{{ data.rows.top }}" data-id="top" href="#"></a>
					</div>
					<#  } #>

					<# if ( ! _.isUndefined( data.rows.main ) ) { #>
					<div class="sparklewp-row-main sparklewp-cb-row" data-id="{{ data.id }}_main">
						<div class="sparklewp-row-inner">
							<div class="builder-grid-row">
								<?php
								for ( $i = 1; $i <= 12; $i ++ ) {
									echo '<div></div>';
								}
								?>
							</div>
							<div class="sparklewp-cb-items grid-stack gridster" data-id="main"></div>
						</div>
						<a class="sparklewp-cb-row-settings" title="{{ data.rows.main }}" data-id="main" href="#"></a>
					</div>
					<#  } #>

					<# if ( ! _.isUndefined( data.rows.bottom ) ) { #>
					<div class="sparklewp-row-bottom sparklewp-cb-row" data-id="{{ data.id }}_bottom">
						<div class="sparklewp-row-inner">
							<div class="builder-grid-row">
								<?php
								for ( $i = 1; $i <= 12; $i ++ ) {
									echo '<div></div>';
								}
								?>
							</div>
							<div class="sparklewp-cb-items grid-stack gridster" data-id="bottom"></div>
						</div>
						<a class="sparklewp-cb-row-settings" title="{{ data.rows.bottom }}" data-id="bottom" href="#"></a>
					</div>
					<#  } #>
				</div>
			<# } #>

			<# if ( data.device == 'all' ) { #>
				<# if ( ! _.isUndefined( data.rows.sidebar ) ) { #>
					<div class="sparklewp-cp-sidebar">
						<div class="sparklewp-row-bottom sparklewp-cb-row" data-id="{{ data.id }}_sidebar">
							<div class="sparklewp-row-inner">
								<div class="sparklewp-cb-items sparklewp-sidebar-items" data-id="sidebar"></div>
							</div>
							<a class="sparklewp-cb-row-settings" title="{{ data.rows.sidebar }}" data-id="sidebar" href="#"></a>
						</div>
						<p class="info"><?php esc_html_e( 'Menu Icon Sidebar will display when Menu Icon is clicked on frontend', 'sparklestore-pro' ); ?></p>
					</div>
				<# } #>
			<# } #>
			<button type="button" class="button button-primary spwp-add-new-item">
				<span class="dashicons dashicons-plus"></span>
				<?php esc_html_e( ' Add a Item', 'sparklestore-pro' ); ?>
			</button>
		</script>

		<script type="text/html" id="tmpl-sparklewp-cb-item">
			<div class="grid-stack-item item-from-list for-s-{{ data.section }}"
				 title="{{ data.name }}"
				 data-id="{{ data.id }}"
				 data-section="{{ data.section }}"
				 data-control="{{ data.control }}"
				 data-gs-x="{{ data.x }}"
				 data-gs-y="{{ data.y }}"
				 data-gs-width="{{ data.width }}"
				 data-df-width="{{ data.width }}"
				 data-gs-height="1"
			>
				<div class="item-tooltip" data-section="{{ data.section }}">{{ data.name }}</div>
				<div class="grid-stack-item-content">
					<i class="
					<# if ( data.icon ) { #>
						   {{ data.icon }}
					<# }
					else { #>
						  dashicons dashicons-info
					<# }#>
					"></i>
					<div class="spwp-customizzer-builder-item-desc">
						<h3 class="sparklewp-cb-item-name" data-section="{{ data.section }}">{{ data.name }}</h3>
						<# if ( data.desc ) { #>
							<span class="sparklewp-customizzer-builder-item-desc">{{ data.desc }}</span>
						<# } #>
					</div>
					<span class="sparklewp-cb-item-remove sparklewp-cb-icon"></span>
					<span class="sparklewp-cb-item-setting sparklewp-cb-icon" data-section="{{ data.section }}"></span>
				</div>
			</div>
		</script>

		<?php
	}
}

if ( ! function_exists( 'sparklewp_customizer_builder' ) ) {

	function sparklewp_customizer_builder() {

		return SparkleWP_Customizer_Builder::instance();
	}
	sparklewp_customizer_builder()->run();
}
