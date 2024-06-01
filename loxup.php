<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://jumbaeric.co.ke/partner-locator-map-markers-wordpress-plugin/
 * @since             1.0.0
 * @package           Partner Locator & Map Markers Wordpress Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Partner Locator & Map Markers Wordpress Plugin
 * Plugin URI:        https://jumbaeric.co.ke/partner-locator-map-markers-wordpress-plugin/
 * Description:       A powerful plugin to display and filter your partners, dealers, or store locations on a customizable Google Map.
 * Version:           1.0.0
 * Author:            Jumbaeric
 * Author URI:        https://github.com/jumbaeric
 * Tags: 			  WordPress, Google Maps, Partner Locator, Dealer Locator, Store Locator, Map Markers, Custom Taxonomy Filter, SEO Friendly, Shortcode, Responsive Design
 * Requires at least: 5.0
 * Tested up to: 	  6.5.3
 * Requires PHP: 	  7.2
 * Stable tag: 		  1.0.0
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       loxup
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('LOXUP_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-loxup-activator.php
 */
function activate_loxup()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-loxup-activator.php';
	Loxup_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-loxup-deactivator.php
 */
function deactivate_loxup()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-loxup-deactivator.php';
	Loxup_Deactivator::deactivate();
}

function loxup_flush_rewrite_rules()
{
	flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'activate_loxup');
register_deactivation_hook(__FILE__, 'deactivate_loxup');

register_activation_hook(__FILE__, 'loxup_flush_rewrite_rules');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-loxup.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_loxup()
{

	$plugin = new Loxup();
	$plugin->run();
}
run_loxup();
