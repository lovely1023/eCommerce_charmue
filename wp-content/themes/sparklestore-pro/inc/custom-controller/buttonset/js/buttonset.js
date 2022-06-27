/**
 * Buttonset JS
 */
wp.customize.controlConstructor['sparklewp-buttonset'] = wp.customize.Control.extend(
	{
		ready: function () {

			'use strict';

			var control = this;

			// Change the value
			this.container.on(
				'click',
				'input',
				function () {
					control.setting.set( jQuery( this ).val() );
				}
			);
		}
	}
);

/**
 * Responsive ButtonSet JS
 * */
wp.customize.controlConstructor['sparklewp-responsive-buttonset'] = wp.customize.Control.extend(
	{
		ready: function () {

			'use strict';

			var control = this;

			this.container.on(
				'click',
				'input',
				function(e){
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
			control.container.find( '.sparklewp-responsive-buttonset-device-wrap' ).each(
				function(){
					var $         = jQuery;
					var device    = $( this ).attr( 'data-device' );
					var inputname = $( this ).attr( 'data-inputname' );
					var dataValue = $( this ).find( 'input[name=' + inputname + ']:checked' ).val();

					valueToPush[device] = dataValue;
				}
			);
			var collector = jQuery( control ).find( '.sparklewp-responsive-buttonset-collection-value' );
			collector.val( JSON.stringify( valueToPush ) );
			control.setting.set( JSON.stringify( valueToPush ) );
		},
	}
);

