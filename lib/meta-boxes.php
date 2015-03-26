<?php

/* Get post objects for select field options */ 
function get_post_objects( $query_args ) {
$args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
) );
$posts = get_posts( $args );
$post_options = array();
if ( $posts ) {
    foreach ( $posts as $post ) {
        $post_options [ $post->ID ] = $post->post_title;
    }
}
return $post_options;
}


/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_igv_';

	$home_id = get_option('page_on_front');

	/**
	 * Metaboxes declarations here
   * Reference: https://github.com/WebDevStudios/CMB2/blob/master/example-functions.php
	 */
	$info = new_cmb2_box( array(
		'id'            => $prefix . 'info',
		'title'         => __( 'Information', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
		'show_on'      => array( 'id' => array( $home_id, ) ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	$info->add_field( array(
		'name' => __( 'Address', 'cmb2' ),
		'id'   => $prefix . 'address',
		'type' => 'text',
		// 'repeatable' => true,
	) );

	$info->add_field( array(
		'name' => __( 'Email', 'cmb2' ),
		'id'   => $prefix . 'email',
		'type' => 'text_email',
		// 'repeatable' => true,
	) );

}
?>
