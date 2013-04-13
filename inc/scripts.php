<script>
  document.write('<script src=' +
  ('__proto__' in {} ? 'js/vendor/zepto' : 'js/vendor/jquery') +
  '.js><\/script>')
  </script>
  
  	<script src="js/foundation/foundation.js"></script>
	
	<script src="js/foundation/foundation.alerts.js"></script>
	
	<script src="js/foundation/foundation.clearing.js"></script>
	
	<script src="js/foundation/foundation.cookie.js"></script>
	
	<script src="js/foundation/foundation.dropdown.js"></script>
	
	<script src="js/foundation/foundation.forms.js"></script>
	
	<script src="js/foundation/foundation.joyride.js"></script>
	
	<script src="js/foundation/foundation.magellan.js"></script>
	
	<script src="js/foundation/foundation.orbit.js"></script>
	
	<script src="js/foundation/foundation.placeholder.js"></script>
	
	<script src="js/foundation/foundation.reveal.js"></script>
	
	<script src="js/foundation/foundation.section.js"></script>
	
	<script src="js/foundation/foundation.tooltips.js"></script>
	
	<script src="js/foundation/foundation.topbar.js"></script>
	
  <script>
    $(document).foundation();
  </script>
  
  <script src="js/vendor/jquery.min.js"></script>
  <script src="js/vendor/jquery.isotope.min.js"></script>
  <script src="js/vendor/jquery.imagesloaded.min.js"></script>
  
  
  
  <script>
 	  $(document).ready(function(){
 	  	
 	  	
 	  	var $container = $('.portfolio');
		$container.imagesLoaded(function(){
		  $container.isotope({
		    itemSelector : 'li',
		    layoutMode : 'fitRows'
		  });
		});
 	
 		$('#filters dd a').click(function(){
		  var selector = $(this).attr('data-filter');
		  $container.isotope({ filter: selector });
		  return false;
		});
 	
 	$('#p, #view').click(function(e){
 		e.preventDefault();
 		$('.top-bar-section ul li').removeClass('active');
		$("html,body").animate({ scrollTop: 506 }, 'slow');
		$(this).addClass('active');
		return false; 
 	});
 	$('#s').click(function(e){
 		e.preventDefault();
 		$('.top-bar-section ul li').removeClass('active');
		$("html, body").animate({ scrollTop: 1426 }, "slow");
		$(this).addClass('active');
 	});
 	$('#home').click(function(e){
 		e.preventDefault();
		$("html, body").animate({ scrollTop: 0 }, "fast");
		$(this).addClass('active');
 	});
 	
 	
 	setInterval(changebg, 5000);
 	var local = true;
 	
 	function changebg (){
    	
	    $('.image-banner').animate({opacity: 0}, 'fast', function() {
	        if(local){
		        $(this).css({'background-image': 'url(assets/images/banner2.jpg)'}).animate({opacity: 1});
		        local = false;
	        }else if(!local){
	        	$(this).css({'background-image': 'url(assets/images/banner.jpg)'}).animate({opacity: 1});
	        	local = true;
	        }
	    });
	};
 	
 	
	 $(window).scroll(function() {
	 	console.log($(window).scrollTop());  
	   if ($(window).scrollTop() >= 506){
	   	$('.top-bar').css({'background':'rgba(0,0,0,.5)','border-bottom':'1px solid rgba(255,255,255,.5)'});
	   } else if ($(window).scrollTop() <= 505){
	   	$('.top-bar').css({'background':'rgba(0,0,0,0)','border-bottom':'1px solid rgba(255,255,255,0)'});
	   }
	   
	   
      });
	}); 	
  </script> 
 