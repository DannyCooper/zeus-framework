<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function yourprefix_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function yourprefix_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object
 */
function yourprefix_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo $classes; ?>">
		<p><label for="<?php echo $id; ?>"><?php echo $label; ?></label></p>
		<p><input id="<?php echo $id; ?>" type="text" name="<?php echo $name; ?>" value="<?php echo $value; ?>"/></p>
		<p class="description"><?php echo $description; ?></p>
	</div>
	<?php
}

/**
 * Manually render a field column display.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object
 */
function yourprefix_display_text_small_column( $field_args, $field ) {
	?>
	<div class="custom-column-display <?php echo $field->row_classes(); ?>">
		<p><?php echo $field->escaped_value(); ?></p>
		<p class="description"><?php echo $field->args( 'description' ); ?></p>
	</div>
	<?php
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function yourprefix_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

add_action( 'cmb2_admin_init', 'yourprefix_register_demo_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function yourprefix_register_demo_metabox() {
	$prefix = 'yourprefix_demo_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Test Metabox', 'zeus-framework' ),
		'object_types'  => array( 'page', ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
	) );

	$cmb_demo->add_field( array(
		'name'       => esc_html__( 'Test Text', 'zeus-framework' ),
		'desc'       => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'         => $prefix . 'text',
		'type'       => 'text',
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
		// 'column'          => true, // Display field value in the admin post-listing columns
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Test Text Small', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'textsmall',
		'type' => 'text_small',
		// 'repeatable' => true,
		// 'column' => array(
		// 	'name'     => esc_html__( 'Column Title', 'zeus-framework' ), // Set the admin column title
		// 	'position' => 2, // Set as the second column.
		// );
		// 'display_cb' => 'yourprefix_display_text_small_column', // Output the display of the column values through a callback.
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Test Text Medium', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'textmedium',
		'type' => 'text_medium',
	) );

	$cmb_demo->add_field( array(
		'name'       => esc_html__( 'Read-only Disabled Field', 'zeus-framework' ),
		'desc'       => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'         => $prefix . 'readonly',
		'type'       => 'text_medium',
		'default'    => esc_attr__( 'Hey there, I\'m a read-only field', 'zeus-framework' ),
		'save_field' => false, // Disables the saving of this field.
		'attributes' => array(
			'disabled' => 'disabled',
			'readonly' => 'readonly',
		),
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Custom Rendered Field', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'render_row_cb',
		'type' => 'text',
		'render_row_cb' => 'yourprefix_render_row_cb',
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Website URL', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'url',
		'type' => 'text_url',
		// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
		// 'repeatable' => true,
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Test Text Email', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'email',
		'type' => 'text_email',
		// 'repeatable' => true,
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Test Time', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'time',
		'type' => 'text_time',
		// 'time_format' => 'H:i', // Set to 24hr format
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Time zone', 'zeus-framework' ),
		'desc' => esc_html__( 'Time zone', 'zeus-framework' ),
		'id'   => $prefix . 'timezone',
		'type' => 'select_timezone',
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Test Date Picker', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'textdate',
		'type' => 'text_date',
		// 'date_format' => 'Y-m-d',
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Test Date Picker (UNIX timestamp)', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'textdate_timestamp',
		'type' => 'text_date_timestamp',
		// 'timezone_meta_key' => $prefix . 'timezone', // Optionally make this field honor the timezone selected in the select_timezone specified above
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Test Date/Time Picker Combo (UNIX timestamp)', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'datetime_timestamp',
		'type' => 'text_datetime_timestamp',
	) );

	// This text_datetime_timestamp_timezone field type
	// is only compatible with PHP versions 5.3 or above.
	// Feel free to uncomment and use if your server meets the requirement
	// $cmb_demo->add_field( array(
	// 	'name' => esc_html__( 'Test Date/Time Picker/Time zone Combo (serialized DateTime object)', 'zeus-framework' ),
	// 	'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
	// 	'id'   => $prefix . 'datetime_timestamp_timezone',
	// 	'type' => 'text_datetime_timestamp_timezone',
	// ) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Test Money', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'textmoney',
		'type' => 'text_money',
		// 'before_field' => '£', // override '$' symbol if needed
		// 'repeatable' => true,
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Test Color Picker', 'zeus-framework' ),
		'desc'    => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'      => $prefix . 'colorpicker',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
		// 'attributes' => array(
		// 	'data-colorpicker' => json_encode( array(
		// 		'palettes' => array( '#3dd0cc', '#ff834c', '#4fa2c0', '#0bc991', ),
		// 	) ),
		// ),
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Test Text Area', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'textarea',
		'type' => 'textarea',
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Test Text Area Small', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'textareasmall',
		'type' => 'textarea_small',
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Test Text Area for Code', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'textarea_code',
		'type' => 'textarea_code',
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Test Title Weeeee', 'zeus-framework' ),
		'desc' => esc_html__( 'This is a title description', 'zeus-framework' ),
		'id'   => $prefix . 'title',
		'type' => 'title',
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Test Select', 'zeus-framework' ),
		'desc'             => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'               => $prefix . 'select',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'standard' => esc_html__( 'Option One', 'zeus-framework' ),
			'custom'   => esc_html__( 'Option Two', 'zeus-framework' ),
			'none'     => esc_html__( 'Option Three', 'zeus-framework' ),
		),
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Test Radio inline', 'zeus-framework' ),
		'desc'             => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'               => $prefix . 'radio_inline',
		'type'             => 'radio_inline',
		'show_option_none' => 'No Selection',
		'options'          => array(
			'standard' => esc_html__( 'Option One', 'zeus-framework' ),
			'custom'   => esc_html__( 'Option Two', 'zeus-framework' ),
			'none'     => esc_html__( 'Option Three', 'zeus-framework' ),
		),
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Test Radio', 'zeus-framework' ),
		'desc'    => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'      => $prefix . 'radio',
		'type'    => 'radio',
		'options' => array(
			'option1' => esc_html__( 'Option One', 'zeus-framework' ),
			'option2' => esc_html__( 'Option Two', 'zeus-framework' ),
			'option3' => esc_html__( 'Option Three', 'zeus-framework' ),
		),
	) );

	$cmb_demo->add_field( array(
		'name'     => esc_html__( 'Test Taxonomy Radio', 'zeus-framework' ),
		'desc'     => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'       => $prefix . 'text_taxonomy_radio',
		'type'     => 'taxonomy_radio',
		'taxonomy' => 'category', // Taxonomy Slug
		// 'inline'  => true, // Toggles display to inline
	) );

	$cmb_demo->add_field( array(
		'name'     => esc_html__( 'Test Taxonomy Select', 'zeus-framework' ),
		'desc'     => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'       => $prefix . 'taxonomy_select',
		'type'     => 'taxonomy_select',
		'taxonomy' => 'category', // Taxonomy Slug
	) );

	$cmb_demo->add_field( array(
		'name'     => esc_html__( 'Test Taxonomy Multi Checkbox', 'zeus-framework' ),
		'desc'     => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'       => $prefix . 'multitaxonomy',
		'type'     => 'taxonomy_multicheck',
		'taxonomy' => 'post_tag', // Taxonomy Slug
		// 'inline'  => true, // Toggles display to inline
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Test Checkbox', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'checkbox',
		'type' => 'checkbox',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Test Multi Checkbox', 'zeus-framework' ),
		'desc'    => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'      => $prefix . 'multicheckbox',
		'type'    => 'multicheck',
		// 'multiple' => true, // Store values in individual rows
		'options' => array(
			'check1' => esc_html__( 'Check One', 'zeus-framework' ),
			'check2' => esc_html__( 'Check Two', 'zeus-framework' ),
			'check3' => esc_html__( 'Check Three', 'zeus-framework' ),
		),
		// 'inline'  => true, // Toggles display to inline
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Test wysiwyg', 'zeus-framework' ),
		'desc'    => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'      => $prefix . 'wysiwyg',
		'type'    => 'wysiwyg',
		'options' => array( 'textarea_rows' => 5, ),
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Test Image', 'zeus-framework' ),
		'desc' => esc_html__( 'Upload an image or enter a URL.', 'zeus-framework' ),
		'id'   => $prefix . 'image',
		'type' => 'file',
	) );

	$cmb_demo->add_field( array(
		'name'         => esc_html__( 'Multiple Files', 'zeus-framework' ),
		'desc'         => esc_html__( 'Upload or add multiple images/attachments.', 'zeus-framework' ),
		'id'           => $prefix . 'file_list',
		'type'         => 'file_list',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'oEmbed', 'zeus-framework' ),
		'desc' => sprintf(
			/* translators: %s: link to codex.wordpress.org/Embeds */
			esc_html__( 'Enter a youtube, twitter, or instagram URL. Supports services listed at %s.', 'zeus-framework' ),
			'<a href="https://codex.wordpress.org/Embeds">codex.wordpress.org/Embeds</a>'
		),
		'id'   => $prefix . 'embed',
		'type' => 'oembed',
	) );

	$cmb_demo->add_field( array(
		'name'         => 'Testing Field Parameters',
		'id'           => $prefix . 'parameters',
		'type'         => 'text',
		'before_row'   => 'yourprefix_before_row_if_2', // callback
		'before'       => '<p>Testing <b>"before"</b> parameter</p>',
		'before_field' => '<p>Testing <b>"before_field"</b> parameter</p>',
		'after_field'  => '<p>Testing <b>"after_field"</b> parameter</p>',
		'after'        => '<p>Testing <b>"after"</b> parameter</p>',
		'after_row'    => '<p>Testing <b>"after_row"</b> parameter</p>',
	) );

}

add_action( 'cmb2_admin_init', 'yourprefix_register_about_page_metabox' );
/**
 * Hook in and add a metabox that only appears on the 'About' page
 */
function yourprefix_register_about_page_metabox() {
	$prefix = 'yourprefix_about_';

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_about_page = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__( 'About Page Metabox', 'zeus-framework' ),
		'object_types' => array( 'page', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		'show_on'      => array( 'id' => array( 2, ) ), // Specific post IDs to display this metabox
	) );

	$cmb_about_page->add_field( array(
		'name' => esc_html__( 'Test Text', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'text',
		'type' => 'text',
	) );

}

add_action( 'cmb2_admin_init', 'yourprefix_register_repeatable_group_field_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function yourprefix_register_repeatable_group_field_metabox() {
	$prefix = 'yourprefix_group_';

	/**
	 * Repeatable Field Groups
	 */
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__( 'Repeating Field Group', 'zeus-framework' ),
		'object_types' => array( 'page', ),
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix . 'demo',
		'type'        => 'group',
		'description' => esc_html__( 'Generates reusable form entries', 'zeus-framework' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Entry {#}', 'zeus-framework' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Entry', 'zeus-framework' ),
			'remove_button' => esc_html__( 'Remove Entry', 'zeus-framework' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Entry Title', 'zeus-framework' ),
		'id'         => 'title',
		'type'       => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name'        => esc_html__( 'Description', 'zeus-framework' ),
		'description' => esc_html__( 'Write a short description for this entry', 'zeus-framework' ),
		'id'          => 'description',
		'type'        => 'textarea_small',
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Entry Image', 'zeus-framework' ),
		'id'   => 'image',
		'type' => 'file',
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Image Caption', 'zeus-framework' ),
		'id'   => 'image_caption',
		'type' => 'text',
	) );

}

add_action( 'cmb2_admin_init', 'yourprefix_register_user_profile_metabox' );
/**
 * Hook in and add a metabox to add fields to the user profile pages
 */
function yourprefix_register_user_profile_metabox() {
	$prefix = 'yourprefix_user_';

	/**
	 * Metabox for the user profile screen
	 */
	$cmb_user = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => esc_html__( 'User Profile Metabox', 'zeus-framework' ), // Doesn't output for user boxes
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );

	$cmb_user->add_field( array(
		'name'     => esc_html__( 'Extra Info', 'zeus-framework' ),
		'desc'     => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'       => $prefix . 'extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	$cmb_user->add_field( array(
		'name'    => esc_html__( 'Avatar', 'zeus-framework' ),
		'desc'    => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'      => $prefix . 'avatar',
		'type'    => 'file',
	) );

	$cmb_user->add_field( array(
		'name' => esc_html__( 'Facebook URL', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'facebookurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => esc_html__( 'Twitter URL', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'twitterurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => esc_html__( 'Google+ URL', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'googleplusurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => esc_html__( 'Linkedin URL', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'linkedinurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => esc_html__( 'User Field', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'user_text_field',
		'type' => 'text',
	) );

}

add_action( 'cmb2_admin_init', 'yourprefix_register_taxonomy_metabox' );
/**
 * Hook in and add a metabox to add fields to taxonomy terms
 */
function yourprefix_register_taxonomy_metabox() {
	$prefix = 'yourprefix_term_';

	/**
	 * Metabox to add fields to categories and tags
	 */
	$cmb_term = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => esc_html__( 'Category Metabox', 'zeus-framework' ), // Doesn't output for term boxes
		'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
		'taxonomies'       => array( 'category', 'post_tag' ), // Tells CMB2 which taxonomies should have these fields
		// 'new_term_section' => true, // Will display in the "Add New Category" section
	) );

	$cmb_term->add_field( array(
		'name'     => esc_html__( 'Extra Info', 'zeus-framework' ),
		'desc'     => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'       => $prefix . 'extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	$cmb_term->add_field( array(
		'name' => esc_html__( 'Term Image', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'avatar',
		'type' => 'file',
	) );

	$cmb_term->add_field( array(
		'name' => esc_html__( 'Arbitrary Term Field', 'zeus-framework' ),
		'desc' => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'   => $prefix . 'term_text_field',
		'type' => 'text',
	) );

}

add_action( 'cmb2_admin_init', 'yourprefix_register_theme_options_metabox' );
/**
 * Hook in and register a metabox to handle a theme options page
 */
function yourprefix_register_theme_options_metabox() {

	$option_key = 'yourprefix_theme_options';

	/**
	 * Metabox for an options page. Will not be added automatically, but needs to be called with
	 * the `cmb2_metabox_form` helper function. See wiki for more info.
	 */
	$cmb_options = new_cmb2_box( array(
		'id'      => $option_key . 'page',
		'title'   => esc_html__( 'Theme Options Metabox', 'zeus-framework' ),
		'hookup'  => false, // Do not need the normal user/post hookup
		'show_on' => array(
			// These are important, don't remove
			'key'   => 'options-page',
			'value' => array( $option_key )
		),
	) );

	/**
	 * Options fields ids only need
	 * to be unique within this option group.
	 * Prefix is not needed.
	 */
	$cmb_options->add_field( array(
		'name'    => esc_html__( 'Site Background Color', 'zeus-framework' ),
		'desc'    => esc_html__( 'field description (optional)', 'zeus-framework' ),
		'id'      => 'bg_color',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
	) );

}
