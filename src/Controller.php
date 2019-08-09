<?php
/**
 * Visual Composer Controller file - fire all hooks here
 *
 * LICENSE: GPL-3.0
 *
 * @package    StarterKitModules\VisualComposer
 * @author     SolidBunch <contact@solidbunch.com>
 * @since      File available since Release 1.0.0
 */

namespace StarterKitModule\VisualComposer;

/**
 * Controller
 *
 * Controller - adds VC support for StarterKit Modular theme.
 *
 * @category   WordPress
 * @package    StarterKitModules\VisualComposer
 * @author     SolidBunch
 * @link       https://solidbunch.com
 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0
 */
class Controller {

	/**
	 * Set Bootstrap 4 classes for VC Grid
	 **/
	public function custom_css_classes_for_vc_grid( $class_string, $tag ) {

		if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {
			$class_string = str_replace( 'vc_row-fluid', 'row-fluid', $class_string );
			$class_string = str_replace( 'vc_row', 'row', $class_string );
			$class_string = str_replace( 'wpb_row', '', $class_string );
			$class_string = str_replace( 'row-o-content-bottom', 'align-items-end', $class_string );
			$class_string = str_replace( 'row-o-content-middle', 'align-items-center', $class_string );
		}

		if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
			$class_string = str_replace( 'vc_col-sm-', 'col-md-', $class_string );
			$class_string = str_replace( 'vc_col-', 'col-', $class_string );
			//Todo
			//$class_string = preg_replace( '/vc_hidden\-([a-z]{2})/', 'd-$1-none', $class_string );

		}

		return $class_string;
	}

	public static function register_post_type() {

		register_post_type( 'composerlayout', [
			'label'               => esc_html__( 'Header / Footer', 'starter-kit' ),
			'description'         => '',
			'public'              => true,
			'show_ui'             => true,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'show_in_nav_menus'   => false,
			'_builtin'            => false,
			'show_in_menu'        => true,
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
			'hierarchical'        => false,
			'menu_position'       => null,
			'rewrite'             => false,
			'query_var'           => true,
			'supports'            => [ 'title', 'editor' ],
			'labels'              => [
				'name'               => esc_html__( 'Header / Footer', 'starter-kit' ),
				'singular_name'      => esc_html__( 'Header / Footer', 'starter-kit' ),
				'menu_name'          => esc_html__( 'Header / Footer', 'starter-kit' ),
				'add_new'            => esc_html__( 'Add New Header / Footer', 'starter-kit' ),
				'add_new_item'       => esc_html__( 'Add New Header / Footer', 'starter-kit' ),
				'edit'               => esc_html__( 'Edit', 'starter-kit' ),
				'edit_item'          => esc_html__( 'Edit Header / Footer', 'starter-kit' ),
				'new_item'           => esc_html__( 'New Header / Footer', 'starter-kit' ),
				'view'               => esc_html__( 'View Header / Footer', 'starter-kit' ),
				'view_item'          => esc_html__( 'View Header / Footer', 'starter-kit' ),
				'search_items'       => esc_html__( 'Search Header / Footer', 'starter-kit' ),
				'not_found'          => esc_html__( 'No Header / Footer Found', 'starter-kit' ),
				'not_found_in_trash' => esc_html__( 'No Header / Footer Found in Trash', 'starter-kit' ),
				'parent'             => esc_html__( 'Parent Header / Footer', 'starter-kit' )
			]
		] );

	}

	/**
	 * Remove default VC shortcodes and some unused options
	 **/
	public static function setup_vc() {

		if ( function_exists( 'vc_set_default_editor_post_types' ) ) {
			$list = [
				'page',
				'composerlayout',
			];
			vc_set_default_editor_post_types( $list );
		}

		vc_remove_element( 'vc_btn' );
		vc_remove_element( 'vc_separator' );
		vc_remove_element( 'vc_section' );
		vc_remove_element( 'vc_icon' );
		vc_remove_element( 'vc_zigzag' );
		vc_remove_element( 'vc_text_separator' );
		vc_remove_element( 'vc_message' );
		vc_remove_element( 'vc_hoverbox' );
		vc_remove_element( 'vc_facebook' );
		vc_remove_element( 'vc_tweetmeme' );
		vc_remove_element( 'vc_googleplus' );
		vc_remove_element( 'vc_pinterest' );
		vc_remove_element( 'vc_gallery' );
		vc_remove_element( 'vc_images_carousel' );
		vc_remove_element( 'vc_tta_tabs' );
		vc_remove_element( 'vc_tta_tour' );
		vc_remove_element( 'vc_tta_accordion' );
		vc_remove_element( 'vc_tta_pageable' );
		vc_remove_element( 'vc_cta' );
		vc_remove_element( 'vc_flickr' );
		vc_remove_element( 'vc_progress_bar' );
		vc_remove_element( 'vc_pie' );
		vc_remove_element( 'vc_round_chart' );
		vc_remove_element( 'vc_basic_grid' );
		vc_remove_element( 'vc_media_grid' );
		vc_remove_element( 'vc_masonry_grid' );
		vc_remove_element( 'vc_masonry_media_grid' );
		vc_remove_element( 'vc_tabs' );
		vc_remove_element( 'vc_tour' );
		vc_remove_element( 'vc_accordion' );
		vc_remove_element( 'vc_custom_heading' );
		vc_remove_element( 'vc_toggle' );
		vc_remove_element( 'vc_line_chart' );
		vc_remove_element( 'vc_posts_slider' );
		vc_remove_element( 'vc_gmaps' );

		vc_remove_param( 'vc_row', 'gap' );

		vc_disable_frontend();
	}

}
