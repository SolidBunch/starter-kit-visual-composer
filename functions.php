<?php //phpcs:ignorefile

use StarterKitModule\VisualComposer\Helper;
use StarterKitModule\VisualComposer\Hooks;


add_filter( 'starter_kit_register_module', static function ( array $class_map ) {
	$class_map['hooks'] = Hooks::class;

	return $class_map;
}, 10 );

if ( ! function_exists( 'sk_load_composer_layout' ) ) {
	/**
	 * Load layout for header / footer built through Visual Composer
	 *
	 * @param string $layout_type
	 *
	 * @return string
	 */
	function sk_load_composer_layout( $layout_type = 'header' ) {
		return Helper::load_composer_layout( $layout_type );
	}
}
