(function( $ ) {
	'use strict';

	jQuery(document).ready(function($) {

		//console.log(tpasfw);

		// When the search icon is clicked
		$('.demo-icon.tpasfw-search').click(function() {
			
			// Toggle the display of the search results and overlay
			$('.tpasfw-search-results, .tpasfw-overlay').fadeToggle();

			$('.tpasfw-search-input').focus();
		});
	
		// When the overlay is clicked
		$('.tpasfw-overlay').click(function() {
			// Hide the search results and overlay
			$('.tpasfw-search-results, .tpasfw-overlay').fadeOut();
		});

		$('.tpasfw-close-button').click(function() {
			// Hide the search results and overlay
			$('.tpasfw-search-results, .tpasfw-overlay, .tpasfw-select-container').fadeOut();

			setTimeout(function() {
				$('.tpasfw-search-results-ajax').html('');
				$('.tpasfw-search-input').val('');
				$('#tpasfw-product-orderby').val('default');
			}, 400);

		});

		//----------------------------------------
		
		if( $('.tpasfwopen-search-results').length ) {
			var $searchInput = $('.tpasfwopen-search-results .tpasfw-search-input');
			var $closeButton = $('.tpasfwopen-search-ins-close');

			$searchInput.on('input', function() {
				if ($searchInput.val().length > 0) {
					$closeButton.addClass('tpasfwopenshow');
				} else {
					$closeButton.removeClass('tpasfwopenshow');
					// $('.tpasfw-search-results-ajax').html('');
					$('.tpasfw-search-results-ajax').fadeOut('fast', function() {
						// This function is called after the fadeOut completes
						$(this).html('').fadeIn('fast'); // Optionally fade in after clearing
					});
				}
			});

			$closeButton.on('click', function() {
				$searchInput.val('');
				$closeButton.removeClass('tpasfwopenshow');
				// $('.tpasfw-search-results-ajax').html('');
				$('.tpasfw-search-results-ajax').fadeOut('fast', function() {
					// This function is called after the fadeOut completes
					$(this).html('').fadeIn('fast'); // Optionally fade in after clearing
				});
			});
		}
		//----------------------------------------
		// Event handler for search input
		$('.tpasfw-search-input').on('input', function() {
			var searchValue = $(this).val();
			var orderby = $('#tpasfw-product-orderby').val();
			performSearch(searchValue, orderby);
		});
		
		// Event handler for sorting change
		$(document).on('change', '#tpasfw-product-orderby', function() {
			var orderby = $(this).val();
			var searchValue = $('.tpasfw-search-input').val();

			if (orderby === 'featured' || orderby === 'sale') {
				// Client-side sorting for 'featured' and 'sale'
				sortProducts(orderby);
			} else {
				// AJAX search for other options
				performSearch(searchValue, orderby);
			}
		});
		//----------------------------------------
		// $('.tpasfw-select-container .demo-icon.tpasfw-sort').on('click', function() {
		// 	// Trigger the click on the select dropdown
		// 	console.log('tizzz');
		// 	$('#tpasfw-product-orderby').trigger('click');
		// });
		//----------------------------------------
	});

	function performSearch(searchValue, orderby) {
		if (searchValue.length >= tpasfw.minlength) { // Trigger search for 3 or more characters
			$.ajax({
				url: tpasfwAjax.ajaxurl,
				type: 'POST',
				data: {
					action: 'tpasfw_search_products',
					searchTerm: searchValue,
					orderby: orderby
				},
				beforeSend: function() {
					$(".lds-grid-mask").css("display", "flex");
				},
				success: function(response) {
					$(".lds-grid-mask").addClass("tpasfw-position").hide();
					$('.tpasfw-search-results-ajax').html(response);
					checkResults();
					// Initialize or update carousel
					initializeOwlCarousel();
					initializePagination();
				}
			});
		}
	}

	function sortProducts(orderby) {
		var attribute = orderby === 'featured' ? 'data-featured' : 'data-sale';
		var $products = $('.tpasfw-product');
	
		$products.sort(function(a, b) {
			var valueA = parseInt($(a).attr(attribute));
			var valueB = parseInt($(b).attr(attribute));
			return valueB - valueA; // Descending order
		});
	
		// Append sorted products back to the container
		$('.tpasfw-products-grid').html($products);
		// Reinitialize the Owl Carousel
		initializeOwlCarousel();
		initializePagination();
	}

	function checkResults() {
		if( $('.tpasfw-products-grid').length ) {
			$('.tpasfw-select-container').css("display", "flex");
		}
		else {
			$('.tpasfw-select-container').hide();
		}
	}

	function initializeOwlCarousel() {
		if(tpasfw.image_type == 'gallery') {
			$('.tpasfw-carousel').owlCarousel({
				loop: tpasfw.owlloop === '1',
				margin: 10,
				nav: tpasfw.owlnav === '1',
				dots: tpasfw.owldots === '1',
				rtl: tpasfw.owlrtl === '1',
				autoplay: tpasfw.owlautoplay === '1',
				autoplayTimeout: tpasfw.owlautoplayTimeout,
				autoplayHoverPause: true,
				navText: ["<i class='demo-icon " + tpasfw.owlarrow_left + "'></i>", "<i class='demo-icon " + tpasfw.owlarrow_right + "'></i>"],
				responsive: {
					0: {
						items: 1
					},
					600: {
						items: 1
					},
					1000: {
						items: 1
					}
				}
			});
		}
	}

	function initializePagination() {
		var items = $(".tpasfw-products-grid .tpasfw-product");
		var numItems = items.length;
		var perPage = parseInt(tpasfw.pagination_items, 10);
		// var perPage = 5;
		// console.log(perPage);
		// Create an array as dataSource
		var dataSource = [];
		for (var i = 0; i < numItems; i++) {
			dataSource.push(i);  // Fill the array with index numbers
		}
	
		if (tpasfw.pagination_active) {

			if (numItems > perPage) {
				$("#tpasfw-pagination-container").pagination({
					dataSource: dataSource,
					pageSize: perPage,
					//className: 'paginationjs-theme-blue paginationjs-small',
					callback: function(data, pagination) {
						// Determine which items to show
						var start = pagination.pageNumber * pagination.pageSize - pagination.pageSize;
						var end = start + pagination.pageSize;
						
						// Show the relevant items
						items.hide().slice(start, end).show();
					},
					afterRender: function(){
						// console.log(perPage);
						// console.log('Pagination link clicked'); // Test if this gets logged
						// $('.tpasfw-search-results-ajax').animate({ scrollTop: 0 }, 'slow');
						setTimeout(function() {
							$('.tpasfw-search-results-ajax').animate({ scrollTop: 0 }, 'slow');
						}, 100); // Delay of 500 milliseconds
					}
				});
			}

		}
	}
	
	// Function to check if 'tpasfw' is in the URL
	function hasTpasfwParameter() {
		var urlParams = new URLSearchParams(window.location.search);
		return urlParams.has('tpasfw');
	}

	//---------------------------------------
	
	
})( jQuery );


