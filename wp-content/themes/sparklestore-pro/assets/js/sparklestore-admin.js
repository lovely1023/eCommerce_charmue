jQuery(document).ready(function($){

	var sparklestore_pro_upload;
	var sparklestore_pro_selector;
    function sparklestore_pro_add_file(event, selector) {

		var upload = $(".uploaded-file"), frame;
		var $el = $(this);
		sparklestore_pro_selector = selector;

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( sparklestore_pro_upload ) {
			sparklestore_pro_upload.open();
		} else {
			// Create the media frame.
			sparklestore_pro_upload = wp.media.frames.sparklestore_pro_upload =  wp.media({
				// Set the title of the modal.
				title: $el.data('choose'),

				// Customize the submit button.
				button: {
					// Set the text of the button.
					text: $el.data('update'),
					// Tell the button not to close the modal, since we're
					// going to refresh the page when the image is selected.
					close: false
				}
			});

			// When an image is selected, run a callback.
			sparklestore_pro_upload.on( 'select', function() {
				// Grab the selected attachment.
				var attachment = sparklestore_pro_upload.state().get('selection').first();
				sparklestore_pro_upload.close();
                sparklestore_pro_selector.find('.upload').val(attachment.attributes.url);
				if ( attachment.attributes.type == 'image' ) {
					sparklestore_pro_selector.find('.screenshot').empty().hide().append('<img src="' + attachment.attributes.url + '"><a class="remove-image">'+ sparklestore_pro_remove.remove +'</a>').slideDown('fast');
				}
				sparklestore_pro_selector.find('.upload-button-wdgt').unbind().addClass('remove-file').removeClass('upload-button-wdgt').val(sparklestore_pro_remove.remove);
				sparklestore_pro_selector.find('.of-background-properties').slideDown();
				sparklestore_pro_selector.find('.remove-image, .remove-file').on('click', function() {
					sparklestore_pro_remove_file( $(this).parents('.section') );
				});
			});
		}
		// Finally, open the modal.
		sparklestore_pro_upload.open();
	}

	function sparklestore_pro_remove_file(selector) {
		selector.find('.remove-image').hide();
		selector.find('.upload').val('');
		selector.find('.of-background-properties').hide();
		selector.find('.screenshot').slideUp();
		selector.find('.remove-file').unbind().addClass('upload-button-wdgt').removeClass('remove-file').val(sparklestore_pro_remove.upload);
		if ( $('.section-upload .upload-notice').length > 0 ) {
			$('.upload-button-wdgt').remove();
		}
		selector.find('.upload-button-wdgt').on('click', function(event) {
			sparklestore_pro_add_file(event, $(this).parents('.section'));
            
		});
	}

	$('body').on('click','.remove-image, .remove-file', function() {
		sparklestore_pro_remove_file( $(this).parents('.section') );
    });

    $(document).on('click', '.upload-button-wdgt', function( event ) {
    	sparklestore_pro_add_file(event, $(this).parents('.section'));
    });


    /**
     * Repeater Fields
    */
	function sparklestore_pro_refresh_repeater_values(){
		$(".sparklestore-repeater-field-control-wrap").each(function(){			
			var values = []; 
			var $this = $(this);			
			$this.find(".sparklestore-repeater-field-control").each(function(){
			var valueToPush = {};
			$(this).find('[data-name]').each(function(){
				var dataName = $(this).attr('data-name');
				var dataValue = $(this).val();
				valueToPush[dataName] = dataValue;
			});
			values.push(valueToPush);
			});
			$this.next('.sparklestore-repeater-collector').val(JSON.stringify(values)).trigger('change');
		});
	}

    $('#customize-theme-controls').on('click','.sparklestore-repeater-field-title',function(){
        $(this).next().slideToggle();
        $(this).closest('.sparklestore-repeater-field-control').toggleClass('expanded');
    });
    $('#customize-theme-controls').on('click', '.sparklestore-repeater-field-close', function(){
    	$(this).closest('.sparklestore-repeater-fields').slideUp();;
    	$(this).closest('.sparklestore-repeater-field-control').toggleClass('expanded');
    });
    $("body").on("click",'.sparklestore-add-control-field', function(){
		var $this = $(this).parent();
		if(typeof $this != 'undefined') {
            var field = $this.find(".sparklestore-repeater-field-control:first").clone();
            if(typeof field != 'undefined'){                
                field.find("input[type='text'][data-name]").each(function(){
                	var defaultValue = $(this).attr('data-default');
                	$(this).val(defaultValue);
                });
                field.find("textarea[data-name]").each(function(){
                	var defaultValue = $(this).attr('data-default');
                	$(this).val(defaultValue);
                });
                field.find("select[data-name]").each(function(){
                	var defaultValue = $(this).attr('data-default');
                	$(this).val(defaultValue);
                });

                field.find(".attachment-media-view").each(function(){
                    var defaultValue = $(this).find('input[data-name]').attr('data-default');
                    $(this).find('input[data-name]').val(defaultValue);
                    if(defaultValue){
                        $(this).find(".thumbnail-image").html('<img src="'+defaultValue+'"/>').prev('.placeholder').addClass('hidden');
                    }else{
                        $(this).find(".thumbnail-image").html('').prev('.placeholder').removeClass('hidden');   
                    }
                });

				field.find('.sparklestore-fields').show();

				$this.find('.sparklestore-repeater-field-control-wrap').append(field);

                field.addClass('expanded').find('.sparklestore-repeater-fields').show(); 
                $('.accordion-section-content').animate({ scrollTop: $this.height() }, 1000);
                sparklestore_pro_refresh_repeater_values();
            }

		}
		return false;
	 });
	
	$("#customize-theme-controls").on("click", ".sparklestore-repeater-field-remove",function(){
		if( typeof	$(this).parent() != 'undefined'){
			$(this).closest('.sparklestore-repeater-field-control').slideUp('normal', function(){
				$(this).remove();
				sparklestore_pro_refresh_repeater_values();
			});			
		}
		return false;
	});

	$("#customize-theme-controls").on('keyup change', '[data-name]',function(){
		 sparklestore_pro_refresh_repeater_values();
		 return false;
	});


	// Set all variables to be used in scope
	var frame;
	// ADD IMAGE LINK
	$('.customize-control-repeater').on( 'click', '.sparklestore-upload-button', function( event ){
		event.preventDefault();
		var imgContainer = $(this).closest('.sparklestore-fields-wrap').find( '.thumbnail-image'),
		placeholder = $(this).closest('.sparklestore-fields-wrap').find( '.placeholder'),
		imgIdInput = $(this).siblings('.upload-id');

		// Create a new media frame
		frame = wp.media({
		    title: 'Select or Upload Image',
		    button: {
		    text: 'Use Image'
		    },
		    multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected in the media frame...
		frame.on( 'select', function() {
			// Get media attachment details from the frame state
			var attachment = frame.state().get('selection').first().toJSON();
			// Send the attachment URL to our custom image input field.
			imgContainer.html( '<img src="'+attachment.url+'" style="max-width:100%;"/>' );
			placeholder.addClass('hidden');
			// Send the attachment id to our hidden input
			imgIdInput.val( attachment.url ).trigger('change');
		});

		// Finally, open the modal on click
		frame.open();
	});


	// DELETE IMAGE LINK
	$('.customize-control-repeater').on( 'click', '.sparklestore-delete-button', function( event ){

		event.preventDefault();
		var imgContainer = $(this).closest('.sparklestore-fields-wrap').find( '.thumbnail-image'),
		placeholder = $(this).closest('.sparklestore-fields-wrap').find( '.placeholder'),
		imgIdInput = $(this).siblings('.upload-id');

		// Clear out the preview image
		imgContainer.find('img').remove();
		placeholder.removeClass('hidden');

		// Delete the image id from the hidden input
		imgIdInput.val( '' ).trigger('change');

	});


	/*Drag and drop to change order*/
	$(".sparklestore-repeater-field-control-wrap").sortable({
		orientation: "vertical",
		update: function( event, ui ) {
			sparklestore_pro_refresh_repeater_values();
		}
	});


	/** 
	  * Preloader Selection 
	*/  
	$(".sparklestore-preloader").click(function (e) {
	    e.preventDefault();
	    var preloader = $(this).attr("preloader");	    
	    $(this).parents(".sparklestore-preloader-container").find('.sparklestore-preloader').removeClass('active');
	    $(this).addClass('active');
	    $(this).parents(".sparklestore-preloader-container").next('input:hidden').val(preloader).change();
	});


	/** 
     * Import Demo Data Ajax Function Area 
    */ 
    $("#demo_import").click(function (){
        $import_true = confirm('Are you sure to import dummy content ? It will overwrite the existing data.');
            if($import_true == false) return;
        var imp = $(this).next('div');
        imp.addClass('demo-loading');

        $(".import-message").html("The Demo Contents are Loading. It might take a while. Please keep patience.");
        $("#demo_import").fadeOut();
        $.ajax({
           url: ajaxurl,
           data: ({
            'action': 'sparklestore_pro_demo_import',            
           }),
           success: function(response){
                imp.removeClass('demo-loading');
                alert("Demo Contents Successfully Imported");
                location.reload();
           }
        });
    });

});
