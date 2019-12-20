<?php

namespace iThemesSecurity\PasswordlessLogin\Integration;

interface Integration {

	/**
	 * The name of the integration.
	 *
	 * For example, "WooCommerce"
	 *
	 * @return string
	 */
	public function get_name();

	/**
	 * The integration's slug.
	 *
	 * @return string
	 */
	public function get_slug();

	/**
	 * Run the integration.
	 *
	 * @return void
	 */
	public function run();
}
