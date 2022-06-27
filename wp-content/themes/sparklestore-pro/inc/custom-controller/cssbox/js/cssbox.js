/**
 * CssBox JS
 */
wp.customize.controlConstructor['sparklewp-cssbox'] = wp.customize.Control.extend(
	{
		ready: function () {

			'use strict';

			var control = this;

			this.container.on(
				'change keyup input',
				'.cssbox-field',
				function(e){
					e.preventDefault();
					var $            = jQuery;
					var cssbox_field = $( this );

					if ( ! cssbox_field.hasClass( 'cssbox_link' ) ) {
						var dataValue = cssbox_field.val(),
						device_wrap   = cssbox_field.closest( '.cssbox-device-wrap' );

						if ( device_wrap.find( '.cssbox_link' ).is( ':checked' ) ) {
							device_wrap.find( '.cssbox-field' ).each(
								function(){
									$( this ).val( dataValue );
								}
							);
						}
					}
					control.updateValue();
				}
			);
		},

		/**
		 * Update
		 */
		updateValue: function () {
			'use strict';
			var control = this;

			var valueToPush = {};
			control.container.find( '.cssbox-field' ).each(
				function(){

					var $      = jQuery;
					var device = $( this ).attr( 'data-device' ),
					dataName   = $( this ).attr( 'data-single-name' );

					if (typeof valueToPush[device] === 'undefined') {
						valueToPush[device] = {};
					}
					if ( $( this ).attr( 'type' ) === 'checkbox') {
						if ($( this ).is( ':checked' )) {
							var dataValue = 1;
						} else {
							var dataValue = '';
						}
					} else {
						var dataValue = $( this ).val();
					}
					valueToPush[device][dataName] = dataValue;
				}
			);
			var collector = jQuery( control ).find( '.cssbox-collection-value' );
			collector.val( JSON.stringify( valueToPush ) );
			control.setting.set( JSON.stringify( valueToPush ) );
		},
	}
);
