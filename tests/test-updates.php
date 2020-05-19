<?php
/**
 * Class TestUpdates
 *
 * @since   1.0.0
 * @package Awesome9\Updates
 * @author  Awesome9 <me@awesome9.co>
 */

namespace Awesome9\Updates\Test;

use Awesome9\Updates\Updates;

/**
 * Updates test case.
 */
class TestUpdates extends \WP_UnitTestCase {

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_should_throw_if_vars_not_array_exception() {
		Updates::get()
			->hooks();
	}
}
