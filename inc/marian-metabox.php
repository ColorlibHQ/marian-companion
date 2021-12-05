<?php
function marian_page_metabox( $meta_boxes ) {

	$marian_prefix = '_marian_';
	$meta_boxes[] = array(
		'id'        => 'marian_metaboxes',
		'title'     => esc_html__( 'Page Options', 'marian-companion' ),
		'post_types'=> array( 'page' ),
		'priority'  => 'high',
		'autosave'  => 'false',
		'fields'    => array(
			array(
				'id'    => $marian_prefix . 'page_title',
				'type'  => 'text',
				// 'required'  => true,
				'name'  => esc_html__( 'Page Title', 'marian-companion' ),
			),
			array(
				'id'    => $marian_prefix . 'banner_img',
				'type'  => 'background',
				// 'required'  => true,
				'name'  => esc_html__( 'Banner Image', 'marian-companion' ),
			),
		),
	);


	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'marian_page_metabox' );
