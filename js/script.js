// init the sly plugin
jQuery(document).ready( function(){
	
	// Get the links
	var links = jQuery('.sly-controls ul li a');
	// Colour the links from the options panel
	jQuery(links).css('background-color', jQuery('.sly-controls').data('color'));
	
	// instantiate the library
	jQuery('.sly-frame').sly({
		horizontal: 1,
		itemNav: "forceCentered",
		dragContent: 1,
		scrollBy: 1
	});

	// Add the active colour to the controls
	jQuery('.sly-link a').click( function(e){
		
		e.preventDefault();
		
		// reset all the controls
		jQuery(links).css('background-color', jQuery('.sly-controls').data('color'));
		
		// fouse the scrolling panel on the post that has been selected from the controls
		jQuery('.sly-frame').sly( 'activate', jQuery(this).attr('href') );
		
		// update the UI to show which post is in focus
		jQuery('.sly-link a').removeClass('sly-link-active');
		jQuery(this).css('background-color', jQuery('.sly-controls').data('active-color'));
		
	});
});