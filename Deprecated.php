<?php
/**
 * Backwards compatibility layer for Requests.
 *
 * Allows for Composer to autoload the old PSR-0 classes via the custom autoloader.
 * This prevents issues with _extending final classes_ (which was the previous solution).
 *
 * Please see the Changelog for the 2.0.0 release for upgrade notes.
 *
 * @package Requests
 *
 * @deprecated 2.0.0 Use the PSR-4 class names instead.
 */
const REQUESTS_SILENCE_PSR0_DEPRECATIONS = true;

if (class_exists('WpOrg\Requests\Autoload') === false) {
	require_once dirname(__DIR__) . '/src/Autoload.php';
}
print_r(WpOrg\Requests\Autoload::register());
WpOrg\Requests\Autoload::register();