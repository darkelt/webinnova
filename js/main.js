;(function () {
	
	'use strict';

	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
			BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
			iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
			Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
			Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
			any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	var fullHeight = function() {

		if ( !isMobile.any() ) {
			$('.js-fullheight').css('height', $(window).height());
			$(window).resize(function(){
				$('.js-fullheight').css('height', $(window).height());
			});
		}

	};

	// iPad and iPod detection	
	var isiPad = function(){
		return (navigator.platform.indexOf("iPad") != -1);
	};

	var isiPhone = function(){
	    return (
			(navigator.platform.indexOf("iPhone") != -1) || 
			(navigator.platform.indexOf("iPod") != -1)
	    );
	};

	// Main Menu Superfish
	var mainMenu = function() {

		$('#fh5co-primary-menu').superfish({
			delay: 0,
			animation: {
				opacity: 'show'
			},
			speed: 'fast',
			cssArrows: true,
			disableHI: true
		});

	};

	var sliderMain = function() {
		
	  	$('#fh5co-hero .flexslider').flexslider({
			animation: "fade",
			slideshowSpeed: 5000,
			directionNav: true,
			start: function(){
				setTimeout(function(){
					$('.slider-text').removeClass('animated fadeInUp');
					$('.flex-active-slide').find('.slider-text').addClass('animated fadeInUp');
				}, 500);
			},
			before: function(){
				setTimeout(function(){
					$('.slider-text').removeClass('animated fadeInUp');
					$('.flex-active-slide').find('.slider-text').addClass('animated fadeInUp');
				}, 500);
			}

	  	});

	  	$('#fh5co-hero .flexslider .slides > li').css('height', $(window).height());	
	  	$(window).resize(function(){
	  		$('#fh5co-hero .flexslider .slides > li').css('height', $(window).height());	
	  	});

	};


	// Offcanvas and cloning of the main menu
	var offcanvas = function() {

		var $clone = $('#fh5co-menu-wrap').clone();
		$clone.attr({
			'id' : 'offcanvas-menu'
		});
		$clone.find('> ul').attr({
			'class' : '',
			'id' : ''
		});

		$('#fh5co-page').prepend($clone);

		// click the burger
		$('.js-fh5co-nav-toggle').on('click', function(){

			if ( $('body').hasClass('fh5co-offcanvas') ) {
				$('body').removeClass('fh5co-offcanvas');
			} else {
				$('body').addClass('fh5co-offcanvas');
			}
			// $('body').toggleClass('fh5co-offcanvas');

		});

		$('#offcanvas-menu').css('height', $(window).height());

		$(window).resize(function(){
			var w = $(window);


			$('#offcanvas-menu').css('height', w.height());

			if ( w.width() > 769 ) {
				if ( $('body').hasClass('fh5co-offcanvas') ) {
					$('body').removeClass('fh5co-offcanvas');
				}
			}

		});	

	}

	

	// Click outside of the Mobile Menu
	var mobileMenuOutsideClick = function() {
		$(document).click(function (e) {
	    var container = $("#offcanvas-menu, .js-fh5co-nav-toggle");
	    if (!container.is(e.target) && container.has(e.target).length === 0) {
	      if ( $('body').hasClass('fh5co-offcanvas') ) {
				$('body').removeClass('fh5co-offcanvas');
			}
	    }
		});
	};


	// Animations

	var contentWayPoint = function() {
		var i = 0;
		$('.animate-box').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('animated') ) {
				
				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .animate-box.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							el.addClass('fadeInUp animated');
							el.removeClass('item-animate');
						},  k * 200, 'easeInOutExpo' );
					});
					
				}, 100);
				
			}

		} , { offset: '85%' } );
	};

	

	// Document on load.
	$(function(){
		mainMenu();
		offcanvas();
		mobileMenuOutsideClick();
		contentWayPoint();
		sliderMain();
		fullHeight();
		

	});


}());

function formhash(form, password) {
    // Crea una entrada de elemento nuevo, esta será nuestro campo de contraseña con hash. 
    var p = document.createElement("input");
 
    // Agrega el elemento nuevo a nuestro formulario. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Asegúrate de que la contraseña en texto simple no se envíe. 
    password.value = "";
 
    // Finalmente envía el formulario. 
    form.submit();
}
 
function regformhash(form, uid, email, password, conf, telephone1, opera, direc, country, state,date) {
     // Verifica que cada campo tenga un valor
    if (uid.value == ''         || 
          email.value == ''     || 
          password.value == ''  || 
          conf.value == '') {
 
        alert('Deberá brindar toda la información solicitada. Por favor, intente de nuevo');
        return false;
    }
 	if (form.username.value == "") {
        alert("Su usuario no puede estar en blanco!!");
        form.username.focus();
        return false;
    }
		if (form.country.value == "") {
        alert("Debe ingresar su País");
        form.username.focus();
        return false;
    }
	if (form.state.value == "") {
        alert("Debe ingresar su Ciudad");
        form.username.focus();
        return false;
    }
	if (form.direc.value == "") {
        alert("Debe ingresar su dirección");
        form.username.focus();
        return false;
    }
		if (form.date.value == "") {
        alert("Debe ingresar su Fecha de nacimiento");
        form.username.focus();
        return false;
    }
	
	if (form.telephone1.value == "") {
        alert("Debe ingresar por lo menos un numero telefonico");
        form.username.focus();
        return false;
    }
	    if (form.opera.value == "") {
        alert("Debe ingresar el operador telefonico");
        form.username.focus();
        return false;
    }
    // Verifica que la contraseña tenga la extensión correcta (mín. 6 caracteres)
    // La verificación se duplica a continuación, pero se incluye para que el
    // usuario tenga una guía más específica.
    if (password.value.length < 6) {
        alert('La contraseña deberá tener al menos 6 caracteres. Por favor, inténtelo de nuevo');
        form.password.focus();
        return false;
    }
 
    // Por lo menos un número, una letra minúscula y una mayúscula 
    // Al menos 6 caracteres
 
    
    // Verifica que la contraseña y la confirmación sean iguales
    if (password.value != conf.value) {
        alert('La contraseña y la confirmación no coinciden. Por favor, inténtelo de nuevo');
        form.password.focus();
        return false;
    }
 
    // Crea una entrada de elemento nuevo, esta será nuestro campo de contraseña con hash. 
    var p = document.createElement("input");
 
    // Agrega el elemento nuevo a nuestro formulario. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Asegúrate de que la contraseña en texto simple no se envíe. 
    password.value = "";
    conf.value = "";
 
    // Finalmente envía el formulario. 
    form.submit();
    return true;
}


function pwdhash(form,password) {

 // Verifica que la contraseña tenga la extensión correcta (mín. 6 caracteres)
    // La verificación se duplica a continuación, pero se incluye para que el
    // usuario tenga una guía más específica.
    if (password.value.length < 6) {
        alert('La contraseña deberá tener al menos 6 caracteres. Por favor, inténtelo de nuevo');
        form.password.focus();
        return false;
    }
 
    // Por lo menos un número, una letra minúscula y una mayúscula 
    // Al menos 6 caracteres
 
  
 
    // Verifica que la contraseña y la confirmación sean iguales
    if (password.value != conf.value) {
        alert('La contraseña y la confirmación no coinciden. Por favor, inténtelo de nuevo');
        form.password.focus();
        return false;
    }
 
    // Crea una entrada de elemento nuevo, esta será nuestro campo de contraseña con hash. 
    var p = document.createElement("input");
 
    // Agrega el elemento nuevo a nuestro formulario. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Asegúrate de que la contraseña en texto simple no se envíe. 
    password.value = "";
    conf.value = "";
 
    // Finalmente envía el formulario. 
    form.submit();
    return true;
}