<?php

namespace StarterKitModule\VisualComposer;

use WP_Query;

class Helper {
	/**
	 * Get default composer layout
	 *
	 * @param string $layout_type
	 *
	 * @return WP_Query
	 */
	public static function get_default_layout( $layout_type = 'header' ) {
		$args                 = [
			'post_type'      => 'composerlayout',
			'posts_per_page' => 1,
			'post_status'    => 'publish',
			'meta_query'     => [
				'relation' => 'AND',
				[
					'key'   => '_layouttype',
					'value' => $layout_type,
				],
				[
					'key'   => '_appointment',
					'value' => 'default',
				],

			]
		];
		$default_layout_query = new WP_Query( $args );
		wp_reset_query();

		return $default_layout_query;
	}

	/**
	 * Get all composer layouts
	 *
	 * @param string $layout_type
	 *
	 * @return WP_Query
	 */
	public static function get_layouts( $layout_type = 'header' ) {

		$args    = [
			'post_type'      => 'composerlayout',
			'posts_per_page' => - 1,
			'post_status'    => 'publish',
			'meta_query'     => [
				'composerlayout_layouttype' => [
					'key'   => '_layouttype',
					'value' => $layout_type,
				],
			],
			'order'          => 'ASC',
		];
		$layouts = new WP_Query( $args );
		wp_reset_query();

		return $layouts;
	}

	/**
	 * @param string $layout_type
	 *
	 * @return string
	 */
	public static function load_composer_layout( $layout_type = 'header' ): string {
		global $post;
		$default_layout = '';

		if ( is_home() ) {
			$post_id = get_option( 'page_for_posts' );
		} else {
			$post_id = $post ? $post->ID : 0 ;
		}

		if ( $post_id
		     && ( is_singular() || is_home() )
		     && ( $this_layout_id = get_post_meta( $post_id, '_this_' . $layout_type, true ) )
		) { // appointment: may be anyone
			if ( $this_layout_id === '_none_' ) { // layout disabled;
				return '';
			}
			$layout = get_post( $this_layout_id );
			if ( $layout && $layout->post_status === 'publish' ) {
				return do_shortcode( apply_filters( 'the_content', $layout->post_content ) );
			}

			$default_layout_query = self::get_default_layout( $layout_type );

			if ( $default_layout_query->posts && $default_layout_query->posts[0]->post_status === 'publish' ) {
				return do_shortcode( apply_filters( 'the_content',
					$default_layout_query->posts[0]->post_content ) );
			}

		} else {

			$layouts = self::get_layouts( $layout_type );

			if ( $layouts->posts ) {
				foreach ( $layouts->posts as $layout ) {
					$_appointment = get_post_meta( $layout->ID, '_appointment', true );

					if ( ( $post_id && ( $post_type = get_post_type( $post_id ) ) && $_appointment === $post_type && is_singular() ) ||  // appointment: Any from Post Types (compatibility:post)
					     ( $_appointment === 'is-home' && is_home() ) ||  // appointment: is-home
					     ( $_appointment === 'is-search' && is_search() ) ||  // appointment: is-search
					     ( $_appointment === 'is-archive' && is_archive() ) ||  // appointment: is-archive
					     ( $_appointment === 'is-404' && is_404() ) ) { // appointment: is-404
						return do_shortcode( apply_filters( 'the_content', $layout->post_content ) );
					}

					if ( $_appointment === 'default' ) {  // appointment: default
						$default_layout = $layout;
					}
				}

				if ( $default_layout ) {
					return do_shortcode( apply_filters( 'the_content', $default_layout->post_content ) );
				}

			}
		}

		return '';
	}
}
