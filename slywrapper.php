<?php
/*
Plugin Name: Sly wrapper
Plugin URI: http://www.alcwynparker.co.uk
Description: A UI wrapper for the Sly jquery plugin
Version: 1.0
Author: Alcwyn Parker
Author URI: http://www.alcwynparker.co.uk
License: MIT
*/

// ADMIN PANEL (Rough and unfinished)
include_once('slywrapper_admin.php');

// Solution found: http://wordpress.org/support/topic/enqueue-and-load-a-css-file-only-if-string-in-content-matches#post-1344676
add_filter('the_posts', 'check_for_slywrapper');

/*
Stop wordpress from loading the scripts and css is they are not needed
by looking for [sly in the content
*/
function check_for_slywrapper($posts){
	if ( empty($posts) ) return $posts;

	$shortcode_found = false;
	foreach ( $posts as $post ){
		if ( stripos($post->post_content, '[sly') ){
			$shortcode_found = true;
			break;
		}
	}

	if ( $shortcode_found ){
		enqueue_slywrapper_scripts();
		enqueue_slywrapper_styles();
	}
	return $posts;
}

/*
enqueue scripts
*/
function enqueue_slywrapper_scripts()
{
	// get file location
	$file = dirname(__FILE__) . '/slywrapper.php';
	// get path
	$plugin_path = plugin_dir_url($file);
	
	wp_register_script( 'slywrapper_library', $plugin_path . 'js/jquery.sly.min.js' , array('jquery'), false, true );
	wp_register_script( 'slywrapper_script', $plugin_path . 'js/script.js' , array( 'slywrapper_library'), false, true );
	
	wp_enqueue_script( 'slywrapper_script' );
	
}

/*
enqueue styles
*/
function enqueue_slywrapper_styles()
{
	// get file location
	$file = dirname(__FILE__) . '/slywrapper.php';
	// get path
	$plugin_path = plugin_dir_url($file);
	
	wp_register_style( 'slywrapper_style', $plugin_path . 'css/style.css' );
	wp_enqueue_style( 'slywrapper_style' );
}

enqueue_slywrapper_scripts();
enqueue_slywrapper_styles();

/*
Add the slywrapper to the content
*/
function process_sly($attr) {
	$options = get_option('slywrapper_options');
	// register and then add the style 
	//wp_register_style( $handle, $src );
	//wp_enqueue_style( $handle, $src );
	
	// get the post cat for sly UI
	$cat = $attr[cat];
	$scale = 40;
	//Set the width and height
	$frame_width = 'width:' . $options['frame_width'] . 'px;';
	if (isset($attr[frame_width])) $frame_width = $attr[frame_width];
	
	$panel_width = 'width:' . $options['panel_width'] . 'px;';
	if (isset($attr[panel_width])) $frame_width = $attr[panel_width];
	
	$height = 'height:' . $options['height'] . 'px;';
	if (isset($attr[height])) $height = 'height:' . $attr[height] . 'px;';
	
	// construct the inline style (tut tut)
	$panel_style = $panel_width . $height;
	$frame_style = $frame_width . $height;
	
	// Start the query loop for desired cat
	global $post;
	$args = array( 'numberposts' => 0, 'category_name' => $cat, 'orderby' => 'title', 'order'=> 'ASC' );
	$posts = get_posts( $args );
	
	$controls = '';
	$panels = '';
	
	// check there are posts
	if( !empty($posts) )
	{
		// used to order the controls and link them to the scrolling panels
		$count = 0;
		
		// loop through all the posts
		foreach ($posts as $post)
		{
			// add the post details to global object
			setup_postdata($post);
			// add a control for the controls string
			$controls = $controls . '<li class="sly-link"><a href="' .$count . '">' . $post->post_title . '</a></li>';
			// add the post to the panels string
			$panels = $panels . '<li class="sly-panel" style="' . $panel_style. '">' . do_shortcode($post->post_content) . '</li>';
			$count++;
		}
	}
	
	// wrap the panels and controls
	$panels = '<div class="sly-wrapper"><div class="sly-frame" style="' . $frame_style . '"><ul class="sly-slidee">' . $panels . '</ul></div>';  
	$controls = '<div class="sly-controls" data-color="' . $options[color] . '" data-active-color="' . $options['active-color'] . '"><ul>' . $controls . '</ul></div></div>';
	
	// pass the content back to wordpres
	return $controls . $panels;
}

// register the shortcode
add_shortcode('sly', 'process_sly');

?>