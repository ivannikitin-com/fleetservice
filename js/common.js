if( $( window ).width() < 992 ) {
	document.addEventListener( "DOMContentLoaded", function() {

		/*		let btn = document.querySelector("#masthead .navbar-toggler");
				let nav = document.querySelector(".nav-main");

				function mobileMenu() {
					let btnstate = btn.getAttribute("aria-expanded");*/

		let btns = document.querySelectorAll( ".navbar-toggler.btn__navbarmain" );
		let nav = document.querySelector( ".nav-main" );

		function mobileMenu( element ) {

			let btnstate = element.closest( 'button.navbar-toggler.btn__navbarmain' ).getAttribute( "aria-expanded" );

			if( btnstate == "false" ) {
				document.body.classList.add( "menu-open" );
				let backdrop = document.createElement( "div" );
				backdrop.classList.add( "modal-backdrop", "show" );
				nav.before( backdrop );
			} else {
				backdrop = document.querySelector( ".modal-backdrop" );
				if( backdrop ) {
					backdrop.remove();
				}
				document.body.classList.remove( "menu-open" );
			}
		}

		/*btn.onclick = mobileMenu;*/

		btns.forEach( element => {
			element.addEventListener( 'click', function( event ) {
				//event.stopPropagation();
				mobileMenu( event.target );
			} );
		} );
		//btn.onclick = mobileMenu;

	} );
}

( function( $ ) {
	$( function() {

		let searchForms = document.querySelectorAll( '.search-form' );

		if( searchForms ) {
			searchForms.forEach( searchForm => {
				let inputS = searchForm.elements[ 's' ];
				inputS.insertAdjacentHTML( 'afterend', '<button type="reset" class="search-reset" title="Кликни, чтобы очистить поле"><span class="sr-only">×</span></button>' );
				let searchReset = searchForm.querySelector( 'button[type="reset"]' );
				inputS.addEventListener( 'input', function( e ) {
					if( e.target.value ) {
						searchReset.style.display = 'block';
					} else {
						searchReset.style.display = 'none';
					}
				} );

				[ 'click', 'touchstart' ].forEach( function( e ) {
					searchReset.addEventListener( e, function( event ) {
						event.preventDefault();
						event.stopPropagation();
						event.target.parentElement.querySelector( '.search-field' ).value = '';
						/* let wrapper = event.target.classList.contains('ysm-active') ? event.target : event.target.closest('.ysm-search-widget'); */
						let wrapper = event.target.closest( '.ysm-search-widget' );
						console.log( wrapper );
						if( wrapper ) {
							wrapper.classList.toggle( 'ysm-hide' );
							searchReset.style.display = "none";
						}
					} );
				} );
			} );

		}

		$( document ).on( 'blur change', '#billing_myfield13, #billing_myfield14, #billing_myfield15, #billing_myfield16, #billing_myfield17', function() {
			if( !$( '.wooccm-file-list' ).find( '.wooccm-file-file' ).length ) {
				var wrapper = $( this ).closest( '.form-row' );
				// you do not have to removeClass() because Woo do it in checkout.js
				var cond13 = /^(\d{10}|\d{12})$/;
				var cond14 = /^(\d{9})$/;
				var cond16_17 = /^(\d{20})$/;
				var error = false;
				if( $( this ).attr( 'id' ) == 'billing_myfield13' && !cond13.test( $( this ).val() ) ) {
					error = true;
				}
				if( $( this ).attr( 'id' ) == 'billing_myfield14' && !cond14.test( $( this ).val() ) ) {
					error = true;
				}
				if( $( this ).attr( 'id' ) == 'billing_myfield15' && !$( this ).val() ) {
					error = true;
				}
				if( ( $( this ).attr( 'id' ) == 'billing_myfield16' || $( this ).attr( 'id' ) == 'billing_myfield17' ) && !cond16_17.test( $( this ).val() ) ) {
					error = true;
				}
				if( error ) { // check if contains numbers
					wrapper.removeClass( 'woocommerce-validated' );
					wrapper.addClass( 'woocommerce-invalid' ); // error
				} else {
					wrapper.addClass( 'woocommerce-validated' ); // success
				}
			}
		} );
		$( document ).on( 'change', 'input#terms', function() {
			console.log( 'inside change' );
			if( $( this ).is( ':checked' ) ) {
				$( '#place_order' ).removeAttr( 'disabled' );
			} else {
				$( '#place_order' ).attr( 'disabled', 'disabled' );
			}
		} );
		if( ( '.single-product table.variations select, select.orderby, select.wppp-select, select#tinvwl_product_actions' ).length ) {
			$( '.single-product table.variations select, select.orderby, select.wppp-select, select#tinvwl_product_actions' ).select2( {
				minimumResultsForSearch: Infinity,
				width: 'element'
			} );
		}
		$( document.body ).on( 'woosq_loaded', function() {
			$( 'table.variations select' ).select2( {
				minimumResultsForSearch: Infinity,
				width: 'element'
			} );
		} );
		if( ( '.wishlist_item input[type="checkbox"], .product-cb input.global-cb[type="checkbox"], .wpcf7 input[type="checkbox"], .mailpoet_checkbox, .mailpoet-subscription-field input[type="checkbox"], #terms[type="checkbox"], #createaccount[type="checkbox"]' ).length ) {
			$( '.wishlist_item input[type="checkbox"], .product-cb input.global-cb[type="checkbox"], .wpcf7 input[type="checkbox"],   #terms[type="checkbox"], #createaccount[type="checkbox"], .mailpoet-subscription-field input[type="checkbox"], .mailpoet_checkbox' ).styler();
		}
		$( document ).on( 'updated_checkout', function() {
			$( '#terms[type="checkbox"]' ).styler();
		} );
		$( document ).on( 'updated_checkout', function() {
			setTimeout( function() {
				$( '#terms input[type="checkbox"]' ).attr( 'disabled', true ).trigger( 'refresh' );
			}, 1 );
		} );
		$( '#billing_myfield18_file' ).on( 'input', function() {
			if( $( 'input#billing_myfield18_file' ).val() ) {
				$( '#billing_company_field abbr.required' ).remove();
				$( '#billing_myfield14_field abbr.required' ).remove();
				$( '#billing_myfield15_field abbr.required' ).remove();
				$( '#billing_myfield16_field abbr.required' ).remove();
				$( '#billing_myfield17_field abbr.required' ).remove();
				$( '#billing_myfield13_field,#billing_myfield14_field,#billing_myfield15_field,#billing_myfield16_field,#billing_myfield17_field' ).removeClass( 'woocommerce-invalid' );
				$( '#billing_myfield14' ).val( '000000000' );
				$( '#billing_myfield15' ).val( '-' );
				$( '#billing_myfield16,#billing_myfield17' ).val( '00000000000000000000' );
			}
		} );
		$( document ).on( 'change', '#billing_address_1', function( e ) {
			e.stopPropagation();
			$( document.body ).trigger( 'update_checkout' );
		} );
		$( document ).on( 'keyup input', '#billing_address_1', function( e ) {
			e.stopPropagation();
			setTimeout( $( document.body ).trigger( 'update_checkout' ), '1000' );
		} );
		$( document ).on( 'wooccm_upload', '#order_review', function() {
			if( !$( '.wooccm-file-list' ).find( '.wooccm-file-file' ).length ) {
				$( '#billing_company_field label' ).append( '<abbr class="required" title="обязательно">*</abbr>' );
				$( '#billing_myfield13_field label' ).append( '<abbr class="required" title="обязательно">*</abbr>' );
				$( '#billing_myfield14_field label' ).append( '<abbr class="required" title="обязательно">*</abbr>' );
				$( '#billing_myfield15_field label' ).append( '<abbr class="required" title="обязательно">*</abbr>' );
				$( '#billing_myfield16_field label' ).append( '<abbr class="required" title="обязательно">*</abbr>' );
				$( '#billing_myfield17_field label' ).append( '<abbr class="required" title="обязательно">*</abbr>' );
			}
		} );

		$( '[data-fancybox="images"]' ).fancybox( {
			/*toolbar: true,*/
			buttons: [
				"zoom",
				//"share",
				//"slideShow",
				"fullScreen",
				//"download",
				//"thumbs",
				"close"
			]
		} );

		if( typeof( imagesLoaded ) != "undefined" ) {
			var $container = $( '#masonry_container' );
			$container.imagesLoaded().done( function() {
				$container.masonry( {
					singleMode: true,
					itemSelector: '.news-item'
				} );
			} );
		}
		$( ".mask, input[type='tel'], input#billing_phone, input#shipping_phone" ).mask( "+7 (999) 999-9999" );
		$( "#wrap-form_header .site-search-toggle" ).on( "click", function() {
			$( "#wrap-form_header" ).toggleClass( "form-visible" );
			$( "#wrap-form_header .search-field" ).focus();
		} );

		$( "#slider_primary.owl-carousel" ).owlCarousel( {
			items: 1,
			dotsEach: true,
			nav: false,
			loop: true,
			autoplay: true,
			responsive: {
				767: {
					nav: true,
				}
			}
		} );

		/*Подключение к отзывам на Главной*/
		$( ".reviews-list .owl-carousel" ).owlCarousel( {
			items: 2,
			nav: true,
			margin: 30,
			navText: false,
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 2
				}
			}
		} );
		$( ".bestsellers .owl-carousel" ).owlCarousel( {
			nav: true,
			margin: 30,
			navText: false,
			autoHeight: true,
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 2
				},
				992: {
					items: 3
				},
				1199: {
					items: 5
				}
			}
		} );
		$( ".related.products .owl-carousel, .up-sells.products .owl-carousel, .cross-sells .products" ).owlCarousel( {
			nav: true,
			margin: 20,
			navText: false,
			autoHeight: true,
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 2
				},
				992: {
					items: 3
				},
				1199: {
					items: 4
				}
			}
		} );
		$( ".testim-list .owl-carousel" ).owlCarousel( {
			nav: true,
			margin: 30,
			navText: false,
			autoHeight: true,
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 2
				},
				992: {
					items: 3
				},
				1199: {
					items: 4
				}
			}
		} );
		$( ".clients-list .owl-carousel" ).owlCarousel( {
			nav: true,
			margin: 30,
			navText: false,
			autoHeight: true,
			responsive: {
				0: {
					items: 2
				},
				768: {
					items: 3
				},
				992: {
					items: 4
				},
				1199: {
					items: 6
				}
			}
		} );

		$( '#menu-catalog-menu .menu-item.current-menu-ancestor > .collapse-menu.collapse' ).addClass( 'show' );
		$( 'li.menu-item.active' ).parents( 'collapse-menu' ).show();
		$( 'a.collapse' ).mouseover( function( event ) {

			let target = event.target;
			let related_target = event.relatedTarget;
			_sister_a = $( this ).parent( 'li' ).closest( 'li' ).children( 'a:first' );


		} );

		/*Отслеживаем событие изменения класса disabled у кнопки "В корзину" и синхронизируем с кнопкой "Купит в 1 клик"*/
		var originalAddClassMethod = jQuery.fn.addClass;
		var originalRemoveClassMethod = jQuery.fn.removeClass;
		jQuery.fn.addClass = function() {
			var result = originalAddClassMethod.apply( this, arguments );
			jQuery( this ).trigger( 'classChanged' );
			return result;
		}
		jQuery.fn.removeClass = function() {
			var result = originalRemoveClassMethod.apply( this, arguments );
			jQuery( this ).trigger( 'classChanged' );
			return result;
		}
		$( document ).on( 'classChanged', '.single_add_to_cart_button', function() {
			if( $( '.oneclickbuy' ).parent().siblings( '.single_add_to_cart_button' ).hasClass( 'disabled' ) ) {
				$( '.oneclickbuy' ).addClass( 'disabled' );
				$( '.oneclickbuy' ).prop( "disabled", true );
			} else {
				$( '.oneclickbuy' ).removeClass( 'disabled' );
				$( '.oneclickbuy' ).prop( "disabled", false );
			}
		} );

		/*Подготовка формы покупки в 1 клик*/
		$( document ).on( 'click', '.oneclick_wrap', function( e ) {
			if( $( '.oneclickbuy' ).hasClass( 'disabled' ) ) {
				e.preventDefault();
				console.log( 'oneclickbuy disabled' );
				if( $( '.single_add_to_cart_button' ).hasClass( 'wc-variation-is-unavailable' ) ) {
					console.info( '.wc-variation-is-unavailable' );
					window.alert( wc_add_to_cart_variation_params.i18n_unavailable_text );
				} else if( $( '.single_add_to_cart_button' ).hasClass( 'wc-variation-selection-needed' ) ) {
					window.alert( wc_add_to_cart_variation_params.i18n_make_a_selection_text );
				}
			}
		} );

		$( '#menu-tip-produktsii,#menu-tip-produktsii-1,#menu-napravleniya-biznesa,#menu-napravleniya-biznesa-1' ).metisMenu( {

			// enabled/disable the auto collapse.
			toggle: true,

			// prevent default event
			preventDefault: true,

			// default classes
			activeClass: 'active',
			collapseClass: 'collapse',
			collapseInClass: 'in',
			collapsingClass: 'collapsing',

			// .nav-link for Bootstrap 4
			triggerElement: 'a.my',

			// .nav-item for Bootstrap 4
			parentTrigger: 'li',

			// .nav.flex-column for Bootstrap 4
			subMenu: 'ul'

		} );
		$( '#menu-tip-produktsii,#menu-tip-produktsii-1,#menu-napravleniya-biznesa,#menu-napravleniya-biznesa-1' ).on( 'click', function( e ) {
			e.stopPropagation();
		} );

		$( document ).on( "click", "a.scrollto, .tm-woocompare-list a.table-link", function() {
			/*$("a.scrollto, .tm-woocompare-list a.table-link").click(function () {*/
			elementClick = $( this ).attr( "href" );
			destination = $( elementClick ).offset().top;
			console.log( destination - 90 );
			$( "html:not(:animated),body:not(:animated)" ).animate( { scrollTop: destination - 90 }, 1100 );
			return false;
		} );

		$( '#menu-catalog-menu li.menu-item-has-children' ).on( 'mouseover click', function() {
			$( '#menu-catalog-menu li.menu-item-has-children' ).children( 'ul.collapse-menu' ).each( function() {
				if( $( this ).css( 'display' ) == 'none' ) {
					$( this ).siblings( 'a.my' ).html( '<span class="dashicons dashicons-plus"></span>' );
				} else {
					$( this ).siblings( 'a.my' ).html( '<span class="dashicons dashicons-minus"></span>' );
				}
			} );
		} );

		if( $( '#menu-catalog-menu ul.collapse-menu' ).css( 'display' ) == 'none' ) {
			$( this ).siblings( 'a.my' ).html( '<span class="dashicons dashicons-plus"></span>' );

		} else {
			$( this ).siblings( 'a.my' ).html( '<span class="dashicons dashicons-minus"></span>' );
		}

		function setCheckoutButtonState() {
			if( $( '.woocommerce-cart .woocommerce-error' ).length != 0 ) {
				$( '.wc-proceed-to-checkout .checkout-button' ).addClass( 'disabled-link' );
				$( '.wc-proceed-to-checkout' ).css( { cursor: "not-allowed" } );
			} else {
				$( '.wc-proceed-to-checkout .checkout-button' ).removeClass( 'disabled-link' );
				$( '.wc-proceed-to-checkout' ).css( { cursor: "default" } );
			}
			if( $( '.woocommerce-checkout .woocommerce-error' ).length != 0 ) {
				$( 'button#place_order' ).addClass( 'disabled' ).prop( 'disabled', true );
			} else {
				$( 'button#place_order' ).removeClass( 'disabled' ).prop( 'disabled', false );
			}
		}
		setCheckoutButtonState();
		$( 'body' ).on( 'updated_cart_totals updated_checkout', function() {
			setTimeout( setCheckoutButtonState, 500 );
		} );

		$( '.woocommerce-cart' ).ajaxComplete( function() {
			$( document.body ).trigger( 'wc_fragment_refresh' );
		} );

	} );
} )( jQuery );

// Функция для проверки, прокручена ли страница
// function isPageScrolled() {
// 	return window.scrollY > 0 || document.documentElement.scrollTop > 0;
// }

window.addEventListener( 'scroll', function() {
	const mystickyNav = document.querySelector( '#mysticky-nav' );
	console.log( mystickyNav.style.top );
} )