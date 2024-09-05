<?php
/**
 * Update manger class
 *
 * @since   1.0.0
 * @package Awesome9\Updates
 * @author  Awesome9 <me@awesome9.co>
 */

namespace Awesome9\Updates;

use InvalidArgumentException;

/**
 * Updates class
 */
abstract class Updates {

	/**
	 * Get updates that need to run.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	abstract public function get_updates(): array;

	/**
	 * Get folder path
	 *
	 * @since  1.0.0
	 *
	 * @return string
	 */
	abstract public function get_folder(): string;

	/**
	 * Get plugin version number
	 *
	 * @since  1.0.0
	 *
	 * @return string
	 */
	abstract public function get_version(): string;

	/**
	 * Get plugin option name.
	 *
	 * @since  1.0.0
	 *
	 * @return string
	 */
	abstract public function get_option_name(): string;

	/**
	 * Bind all hooks.
	 *
	 * @since 1.0.0
	 *
	 * @throws InvalidArgumentException When folder not defined.
	 * @throws InvalidArgumentException When version not defined.
	 * @throws InvalidArgumentException When option name not defined.
	 *
	 * @return void
	 */
	public function hooks(): void {
		if ( empty( $this->get_folder() ) ) {
			throw new InvalidArgumentException( 'Please set the folder path for update files.' );
		}

		if ( empty( $this->get_version() ) ) {
			throw new InvalidArgumentException( 'Please set the plugin version number.' );
		}

		if ( empty( $this->get_option_name() ) ) {
			throw new InvalidArgumentException( 'Please set option name to save version in database.' );
		}

		add_action( 'admin_init', [ $this, 'do_updates' ] );
	}

	/**
	 * Check if need any update
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function do_updates(): void {
		if ( ! current_user_can( 'update_plugins' ) ) {
			return;
		}

		$installed_version = get_option( $this->get_option_name() );

		// Maybe it's the first install.
		if ( ! $installed_version ) {
			$this->save_version();
			return;
		}

		if ( version_compare( $installed_version, $this->get_version(), '<' ) ) {
			$this->perform_updates();
		}
	}

	/**
	 * Perform all updates
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function perform_updates(): void {
		$installed_version = get_option( $this->get_option_name() );

		foreach ( $this->get_updates() as $version => $path ) {
			if ( version_compare( $installed_version, $version, '<' ) ) {
				include $this->get_folder() . $path;
				$this->save_version( $version );
			}
		}

		$this->save_version();
	}

	/**
	 * Save version info.
	 *
	 * @since 1.0.0
	 *
	 * @param string $version Version number to save.
	 *
	 * @return void
	 */
	private function save_version( $version = false ): void {
		if ( empty( $version ) ) {
			$version = $this->get_version();
		}

		update_option( $this->get_option_name(), $this->get_version() );
	}
}
