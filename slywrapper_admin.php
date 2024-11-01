<?php

// Action and Filter Hooks														// PURPOSE:
register_activation_hook(__FILE__, 'slywrapper_add_defaults');					//  	set up all options in the database
register_uninstall_hook(__FILE__, 'slywrapper_delete_plugin_options');			//		remove all options registerd for slywrapper
add_action('admin_init', 'slywrapper_init' );									//		enqueue the colour pickers and other scripts
add_action('admin_menu', 'slywrapper_add_options_page');						//		add the page to admin
//add_filter( 'plugin_action_links', 'slywrapper_plugin_action_links', 10, 2 );	//		Not being used at the mo!!!!!! 

// Delete options table entries ONLY when plugin deactivated AND deleted
function posk_delete_plugin_options() {
	delete_option('slywrapper_options');
}

// Define default option settings
function slywrapper_add_defaults() {
	$tmp = get_option('slywrapper_options'); // Check if option exists
    if(($tmp['chk_default_options_db']=='1')||(!is_array($tmp))) {
		delete_option('slywrapper_options'); // so we don't have to reset all the 'off' checkboxes too! (don't think this is needed but leave for now)
		$arr = array(	"textarea_one" => "This type of control allows a large amount of information to be entered all at once. Set the 'rows' and 'cols' attributes to set the width and height.",
						"textarea_two" => "This text area control uses the TinyMCE editor to make it super easy to add formatted content.",
						"panel_width" => "700",
						"frame_width" => "900",
						"height" => "600",
						"color" => "#036",
						"active_color" => "#06F"
		);
		update_option('slywrapper_options', $arr);
	}
}

// Init plugin options to white list our options
function slywrapper_init(){
	wp_enqueue_style( 'farbtastic' );
  	wp_enqueue_script( 'farbtastic' );
	register_setting( 'slywrapper_plugin_options', 'slywrapper_options' );	// fairly sure this isn't needed
}

// Add menu page
function slywrapper_add_options_page() {
	add_options_page('Sly Wrapper options page', 'Sly Wrapper', 'manage_options', __FILE__, 'slywrapper_render_form');
}

// Render the Plugin options form
function slywrapper_render_form() {
	?>
	<div class="wrap">
		
		<!-- Display Plugin Icon, Header, and Description -->
		<div class="icon32" id="icon-options-general"><br></div>
		<h2>Sly Wrapper Options</h2>
		<p>Customise the settings below to get the best out of the Sly Wrapper plugin for you wordpress site. </p>

		<!-- Beginning of the Plugin Options Form -->
		<form method="post" action="options.php">
			<?php settings_fields('slywrapper_plugin_options'); ?>
			<?php $options = get_option('slywrapper_options'); ?>
            
            <table class="form-table">
            	<tr valign="top">
					<th scope="row"><label for="slywrapper_options[frame_width]"><strong>Frame width<span> *</span>: </strong></label></th>
                    <td><input name="slywrapper_options[frame_width]" type="text" value="<?php echo $options['frame_width']; ?>" /></li></td>
				</tr>
                <tr valign="top">
					<th scope="row"><label for="slywrapper_options[panel_width]"><strong>Panel width<span> *</span>: </strong></label></th>
                    <td><input name="slywrapper_options[panel_width]" type="text" value="<?php echo $options['panel_width']; ?>" /></li></td>
				</tr>
                <tr valign="top">
					<th scope="row"><label for="slywrapper_options[height]"><strong>Height<span> *</span>: </strong></label></th>
                    <td><input name="slywrapper_options[height]" type="text" value="<?php echo $options['height']; ?>" /></li></td>
				</tr>
                <tr valign="top">
					<th scope="row"><label for="slywrapper_options[color]"><strong>Controls color<span> *</span>: </strong></label></th>
                    <td><input name="slywrapper_options[color]" type="text" id="color" value="<?php echo $options['color']; ?>" />
                    <div id="color-colorpicker"></div></li></td>
				</tr>
                <tr valign="top">
					<th scope="row"><label for="slywrapper_options[active-color]"><strong>Active control color<span> *</span>: </strong></label></th>
                    <td><input name="slywrapper_options[active-color]" type="text" id="active-color" value="<?php echo $options['active-color']; ?>" />
                    <div id="active-color-colorpicker"></div></li></td>
				</tr>
            </table>
            
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
        <div>
        <a href="htpp://www.alcwynparker.co.uk"> Alcwyn Parker </a><br />
        
        <img src="<?php
			// get file location
			$file = dirname(__FILE__) . '/slywrapper.php';
			// get path
			$plugin_path = plugin_dir_url($file);
			echo $plugin_path . 'images/fox.png';
		?>" /></div>
	</div>
<script type="text/javascript">
 
jQuery(document).ready(function() {
	var color = jQuery.farbtastic('#color-colorpicker');
    color.linkTo('#color');
	color.setColor('<?php echo $options['color']; ?>');
	
	var active_color = jQuery.farbtastic('#active-color-colorpicker');
    active_color.linkTo('#active-color');
	active_color.setColor('<?php echo $options['active-color']; ?>')
});
 
</script>
	<?php	
}