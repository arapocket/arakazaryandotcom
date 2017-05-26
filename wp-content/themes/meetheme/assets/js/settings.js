jQuery(document).ready(function($) {
	"use strict";
	try {

	/* ==========================================================================
	#PieChart For Skills Page
	========================================================================== */

	$('.chart').easyPieChart({
	easing: 'easeOutBounce',
	onStep: function(from, to, percent) {
	$(this.el).find('.percent').text(Math.round(percent));
	}
	});


	/* ==========================================================================
	#Carousel Popup For Portfolio Page
	========================================================================== */

	$('.portfolio-con .owl-carousel').owlCarousel({
			items : 1,
			navigation : true,
			slideSpeed : 300,
			paginationSpeed : 400,
			singleItem : true,
			autoPlay: 5000,
		});
		

	if ($('.introduction').hasClass('page-full')){
		$(window).load(function(){

			$(".owl-carousel.introduction-carousel").owlCarousel({
				items : 1,
				navigation : true,
				slideSpeed : 300,
				paginationSpeed : 400,
				singleItem : true,
				autoPlay: 5000,
				afterInit: function(){
					$('.introduction .owl-wrapper-outer').height($(window).height());
					$('.introduction .owl-carousel .owl-item').width($('.content-scroller').width()+20);
					$('.introduction .owl-carousel .owl-wrapper').width($('.introduction .owl-carousel .owl-item').width() * $('.introduction .owl-carousel .owl-item').length);	
				}
			});			
		});
	} else {
		$(".owl-carousel.introduction-carousel").owlCarousel({
			items : 1,
			navigation : true,
			slideSpeed : 300,
			paginationSpeed : 400,
			singleItem : true,
			autoPlay: 5000,
		});	
	}

	/* ==========================================================================
	#Text Rotator
	========================================================================== */
	$('#rotate').rotaterator({fadeSpeed:800, pauseSpeed:800});

	/* ==========================================================================
	#Orientation change event
	========================================================================== */
	$(window).on('orientationchange', function(event) {
		// window.location.href = window.location.href;
	});

	}catch (ex) {}

	/* ==========================================================================
   	#Progress Bar For Skills Page
   	========================================================================== */
	// progressBar(99, $('#progressBar'));
	// progressBar(80, $('#progressBar2'));
	// progressBar(60, $('#progressBar3'));

	/* ==========================================================================
   	#Mobile Menu
   	========================================================================== */
	var $menu = $('#menu1'),
	$menulink = $('.menu-link');
	$menulink.click(function() {
		$menulink.toggleClass('active');
		$menu.toggleClass('active');
		return false;
	});
	$('nav#menu1 a').click(function() {
		$('#menu1').removeClass('active');
	});


	/* ==========================================================================
   	#iPad,iPhone,iPod Keyboard issue with position fixed
   	========================================================================== */
	var iPad = navigator.userAgent.toLowerCase().indexOf("ipad");
	var iPhone = navigator.userAgent.toLowerCase().indexOf("iphone");
	var iPod = navigator.userAgent.toLowerCase().indexOf("ipod");
	if(iPad > -1 || iPhone > -1 || iPod > -1)
	{
		window.onscroll = function() {
			$('.totop-link').css('position','absolute');
			$('.totop-link').css('top',(window.pageYOffset + window.innerHeight - 39) + 'px');
		};
	}

	/* ==========================================================================
   	#Title change
   	========================================================================== */	
	var customtitle = $('title').text();
	var blogname = $('body').attr('data-title');
	
	$('body a.pluton-menu').click(function(){
		var this_title = $(this).find('span').text();
		setTimeout(function(){
			$('title').text(this_title + ' | '+ blogname);
		}, 500);

	});

	$('article').click(function(){
		var thistitle = $(this).find('h2').text();
		if ($(this).is('article:first')){
			setTimeout(function(){
				$('title').text(customtitle); 
			}, 500);
		} else if ($(this).hasClass('introduction-end')){
			setTimeout(function(){
				$('title').text('Thank You | '+ blogname);
			}, 500);		
		} else {
			setTimeout(function(){
				$('title').text(thistitle+ ' | '+ blogname); 
			}, 500);		
		}
	});

	if ($(window).width() > 768){
		
		$('.content.introduction-end, .content.introduction-end .jspContainer, .content.introduction-end .jspPane').width($(window).width() - 180);
		var widthListPr = 0;
		$('.content-scroller article').each(function(){ widthListPr =widthListPr + $(this).width() + 100000 });
		$('.content-scroller .content-wrapper').width(widthListPr);

		if ($('.content:last-child').hasClass('introduction-end')){}else{$('.content:last-child, .content:last-child .jspContainer, .content:last-child .jspPane').width($(window).width()-180);}

		if ($('body').hasClass('home')){
			$('html').css({'overflow':'hidden'});
		}

		$('.content.page-full, .content.page-full .jspContainer, .content.page-full .jspPane').width($(window).width()-180);
	}
	
	/* ==========================================================================
   	#Introduction slider
   	========================================================================== */		
	$(window).resize(function(){
		$('.introduction .owl-carousel .owl-wrapper, .introduction .owl-carousel .owl-item').height($(window).height());
	});
	$('.introduction .owl-carousel .owl-wrapper, .introduction .owl-carousel .owl-item').height($(window).height());
	
	/* ==========================================================================
   	#Portfolio
   	========================================================================== */		
	if ($('.figure-inner').length) {
	    $( '.figure-inner' ).jScrollPane();
	}
	
	/* ==========================================================================
	#Preloader
	========================================================================== */
	$(window).load(function(){
		$('.preload').hide(500);
		$('.grid-gallery').height($('.grid').height());
		$('.portfolio .jspContainer').height($('.grid').height());
		
		if( $('.isotope').length ) {
			var $container = $('.isotope');
	        $container.isotope({
	        	itemSelector: '.isotope-item', 
	        	masonry:{
	        		gutter:0,
	        		columnWidth:'.grid-sizer'
	        	}
	        });
		}
	});
	
});