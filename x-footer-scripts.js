// START JQUERY FUNCTIONS
(function($) {


	// Menu scrolling background and back to top - only run on pages that need it
	if ($('body').is("#content-no-padding")) {
		 var headerheight = $('.banner').innerHeight() - $('.key-stats').innerHeight()  - $('#header').innerHeight();

			// initialise
			if ($(this).scrollTop() > headerheight) {
					$('body ').addClass('scrolled');
			}
			// and on scroll
			$(window).scroll(function() {
				if ($(this).scrollTop() > headerheight) {
					$('body ').addClass('scrolled');
				} else {
					$('body').removeClass('scrolled');
				}
			});
	}

	// Change CF7 input submit into button
	// $('.wpcf7-submit').replaceWith('<button class="wpcf7-submit btn btn-primary">Submit</button>');


	// Mobile Menu
	$(".navbar-toggle").on("click", function(e){
		if(!$(this).hasClass('active')) {
		$('.main-menu').addClass('active');
		$(this).addClass('active');
		} else {
		$('.main-menu').removeClass('active');
		$(this).removeClass('active');
		}
	});

	// Menu current pages border transition
	$('.current-menu-item a, .current_page_item a').addClass('active');


	// Back to Top Click
	$(".backtotop").on("click", function(e){
		$( document.body ).animate({
		  scrollTop: 0
		});
		e.preventDefault();
	});

	// Lazy loading
	$('.lazy').Lazy({
       // your configuration goes here
       scrollDirection: 'vertical',
       effect: 'fadeIn',
			 effectTime:500,
			 threshold: 1500,
			 visibleOnly:true,
       // visibleOnly: true,
       onError: function(element) {
           console.log('error loading ' + element.data('src'));
       }
   });

	 // Adding required class to responsive embeds (e.g. videos)
	 $('.embed-responsive iframe').addClass('embed-responsive-item');

	// Open links
 sitedomain = window.location.hostname;
 siteprotocol = window.location.protocol;
 siteaddress = siteprotocol + '//' + sitedomain;
 // console.log(siteaddress);

	$('a')
		.attr({
		rel:"internal"
	  });
	$('a[href^="http://"], a[href^="https://"]')
		.attr({
		target: "_blank",
		rel:"external"
	  });
		$('a[href^="'+siteaddress+'"]')
	  .attr({
		target: "_self",
		rel: "internal"
	  });

	  // open in new window if external or pdf
	$(".container a[href$='pdf']").attr('target','_blank');
	$(".container a[href$='doc']").attr('target','_blank');
	$(".container a[href$='docx']").attr('target','_blank');
	$(".container a[href$='xls']").attr('target','_blank');
	$(".container a[href$='xlsx']").attr('target','_blank');


})(jQuery);
