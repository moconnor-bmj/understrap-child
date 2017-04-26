/* The function
----------------------------------------- */
(function(jQuery) {
 	jQuery.fn.equalHeightColumns = function(minHeight, maxHeight, breakPoint) {
 		var items = this;
 		breakPoint = breakPoint || 0;
 
 		// Bind functionality to appropriate events
 		jQuery(window).bind('load orientationchange resize', function() {
 			tallest = (minHeight) ? minHeight : 0;
 			items.each(function() {
 				jQuery(this).outerHeight('auto');
 				if(jQuery(this).outerHeight() > tallest) {
 					tallest = jQuery(this).outerHeight();
 				}
 			});
 
 			// Get viewport width (taking scrollbars into account)
 			var e = window;
 			a = 'inner';
 			if (!('innerWidth' in window )) {
 				a = 'client';
 				e = document.documentElement || document.body;
 			}
 			width = e[ a+'Width' ];
 
 			// Equalize column heights if above the specified breakpoint
 			if ( width >= breakPoint ) {
 				if((maxHeight) && tallest > maxHeight) tallest = maxHeight;
 				return items.each(function() {
 					jQuery(this).outerHeight(tallest);
 				});
 			}
 		});
 	}
 
 })(jQuery);