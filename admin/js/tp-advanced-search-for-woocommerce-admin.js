(function( $ ) {
	'use strict';

	jQuery(document).ready(function($) {

		$("#tp-advanced-search-tabs").tabs();

		$('#tpasfw_display_shop_categories').select2({
			width: '90%'
		});

		$('#tpasfw_site_logo_button').click(function(e) {
			e.preventDefault();
			var image = wp.media({ 
				title: 'Upload Image',
				multiple: false
			}).open()
			.on('select', function(e){
				var uploaded_image = image.state().get('selection').first();
				var image_url = uploaded_image.toJSON().url;
				$('#tpasfw_site_logo').val(image_url);
			});
		});

		//---------------------------------------------
		$("#tpasfw_save_license_key").click( function(e) {

            e.preventDefault();
			
			var license_type = $("#tpasfw_save_license_key").data('type');
			//alert(license_type);
			//return false;
            var license_key = $("#tpasfw_license_key").val();

			if(license_key == null || license_key == '' || !license_key){
				$("#tpasfw_license_key_ajax_response").html('<span class="tpa_error_warning">'+tpasfwParam.lkeysms1+'</span>');
			} //if(license_key == null)
			else{
				$.ajax({
					method: "POST",
					//dataType : "json",
					url : tpasfwParam.ajaxurl,
					data : {
						action: "tpasfw_rest_api_ajax",
						license_type : license_type,
						license_key : license_key
					},
					beforeSend: function() {
						$('.tpasfw-ring-mask').show();
					},
					success: function(response) {
						$('.tpasfw-ring-mask').hide();
						$("#tpasfw_license_key_ajax_response").html(response);
						$("#tpasfw_license_key_ajax_response").append("<div>Registration closes in <span id='time' class='time'>05</span></div>");
						var fiveMinutes = 5,
						display = $('#time');
						startTimer(fiveMinutes, display);
						setTimeout(function() {
							location.reload();
						}, 6000);

					}
				});
			} //else
        });
		//---------------------------------------------
		// Function to update the selected class based on the checked radio
		function updateSelectedRadio() {
			$('.tpasfw-icon-radio').removeClass('selected'); // Remove the class from all labels
			$('.tpasfw-icon-radio input[type="radio"]:checked').closest('.tpasfw-icon-radio').addClass('selected'); // Add the class to the checked radio's label
		}
	
		// Update the selected class on page load
		updateSelectedRadio();
	
		// Update the selected class whenever a radio button changes
		$('.tpasfw-icon-radio input[type="radio"]').change(function() {
			updateSelectedRadio();
		});
		//---------------------------------------------
		$('select[name="tpasfw_loading_type"]').change(function() {
			var loadingType = $(this).val();
			var loadingHtml = '';
	
			switch (loadingType) {
				case '1':
					loadingHtml = '<div class="lds-facebook"><div></div><div></div><div></div></div>';
					break;
				case '2':
					loadingHtml = '<div class="lds-dual-ring"></div>';
					break;
				case '3':
					loadingHtml = '<div class="lds-circle"><div></div></div>';
					break;
				case '4':
					loadingHtml = '<div class="lds-ring"><div></div><div></div><div></div><div></div></div>';
					break;
				case '5':
					loadingHtml = '<div class="lds-heart"><div></div></div>';
					break;
				case '6':
					loadingHtml = '<div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
					break;
				case '7':
					loadingHtml = '<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>';
					break;
				case '8':
					loadingHtml = '<div class="lds-default"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
					break;
				case '9':
					loadingHtml = '<div class="lds-ripple"><div></div><div></div></div>';
					break;
				case '10':
					loadingHtml = '<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
					break;
				default:
					loadingHtml = '<div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
			}
	
			$('#tpasfw_loading_preview').html(loadingHtml);
		});
		//---------------------------------------------
		$('#search_terms_table').DataTable({
			// "width": "100%",
			"searching": false, // Disable the search box
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": tpasfwParam.ajaxurl,
				"type": "POST",
				"data": {
					"action": "tpasfw_get_search_terms"
				}
			},
			"columns": [
				{ "data": "search_term" },
				{ "data": "search_count" },
				{ "data": "last_searched" },
				{ "data": "has_results",
					"render": function (data, type, row) {
						return data == '1' ? '<span class="dashicons dashicons-yes"></span>' : '<span class="dashicons dashicons-no"></span>'; // Check if data is '1' for 'Yes'
					}
				}
			]
		});

		// Move the 'dataTables_length' element to a new location
		$('.dataTables_length').appendTo('.tpasfw_search_table_actions');
		
		$('#deleteAll').on('click', function() {
			if (confirm('Are you sure you want to delete all rows?')) {
				$.post(tpasfwParam.ajaxurl, { action: 'tpasfw_delete_all_search_terms' }, function(response) {
					table.ajax.reload(); // Reload the DataTable
				});
			}
		});
	
		$('#deleteNoResults').on('click', function() {
			if (confirm('Are you sure you want to delete all rows with no results?')) {
				$.post(tpasfwParam.ajaxurl, { action: 'tpasfw_delete_no_results_search_terms' }, function(response) {
					table.ajax.reload(); // Reload the DataTable
				});
			}
		});
		//---------------------------------------------
		$('#tpasfw_image_type').on('change', function() {
			// Check the selected value
			if ($(this).val() === 'flipper') {
				// If the value is 'flipper', update the description
				$('.tpasfw_image_type_desc').text('The settings below refer only for gallery type.');
			} else {
				// If the value is not 'flipper', clear the description
				$('.tpasfw_image_type_desc').text('');
			}
		});

		$('#tpasfw_image_type').trigger('change');
		//---------------------------------------------
		$('#tpasfw-clear-cache-button').click(function() {
			var button = $(this);
			button.text('Clearing...');
			$.ajax({
				url: tpasfwParam.ajaxurl,
				type: 'POST',
				data: {
					action: 'tpasfw_clear_all_cache'
				},
				success: function(response) {
					$('#tpasfw-clear-cache-result').html(response);
					button.text('Clear Cache');
				},
				error: function() {
					$('#tpasfw-clear-cache-result').html('Error clearing cache.');
					button.text('Clear Cache');
				}
			});
		});
		//---------------------------------------------
	});

})( jQuery );

function startTimer(duration, display) {
	var timer = duration, minutes, seconds;
	setInterval(function () {
		minutes = parseInt(timer / 60, 10)
		seconds = parseInt(timer % 60, 10);

		minutes = minutes < 10 ? "0" + minutes : minutes;
		seconds = seconds < 10 ? "0" + seconds : seconds;

		display.text(seconds);

		if (--timer < 0) {
			timer = duration;
		}
	}, 1000);
}