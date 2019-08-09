<?php //phpcs:ignorefile

use StarterKitModule\VisualComposer\Helper;
use StarterKitModule\VisualComposer\Hooks;
use \StarterKitModule\VisualComposer\Controller;


add_filter( 'starter_kit_register_module', static function ( array $class_map ) {
	$class_map['hooks'][ Hooks::class ] = Hooks::class;
	//$class_map[ Controller::class ]     = DI\create( Controller::class );

	return $class_map;
}, 10 );

if ( ! function_exists( 'is_vc' ) ) {
	/**
	 * Make sure that Visual Composer is active
	 **/
	function is_vc() {
		return in_array(
			'js_composer/js_composer.php',
			apply_filters( 'active_plugins', get_option( 'active_plugins' ) ),
			true
		);
	}
}
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
