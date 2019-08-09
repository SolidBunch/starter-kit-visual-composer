<?php
/**
 * Visual Composer Hooks file - collect all hooks here
 *
 * LICENSE: GPL-3.0
 *
 * @package    StarterKit/Controllers
 * @author     SolidBunch <contact@solidbunch.com>
 * @since      File available since Release 1.0.0
 */

namespace StarterKitModule\VisualComposer;

use Exception;
use StarterKit\Hooks\HooksInterface;
use function is_vc;

/**
 * Class VisualComposer
 *
 * @package StarterKit\Hooks
 */
class Hooks implements HooksInterface {

	/**
	 * @var Controller
	 */
	protected $controller;

	/**
	 * Controllers constructor.
	 *
	 * @param Controller $controller
	 */
	public function __construct( Controller $controller ) {
		$this->controller = $controller;
	}

	/**
	 * @inheritDoc
	 */
	public function register(): bool {
		if ( $this->controller === null ) {
			return false;
		}

		add_filter( 'vc_shortcodes_css_class', [ $this->controller, 'custom_css_classes_for_vc_grid' ], 10, 2 );

		// Remove default VC elements.
		add_action( 'vc_after_init', [ $this->controller, 'setup_vc' ] );

		add_action( 'init', [ $this->controller, 'register_post_type' ], 5 );


		return true;
	}
}
