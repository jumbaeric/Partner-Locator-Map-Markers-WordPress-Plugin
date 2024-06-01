<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://jumbaeric.com
 * @since      1.0.0
 *
 * @package    Loxup
 * @subpackage Loxup/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Loxup
 * @subpackage Loxup/includes
 * @author     Eric jumba kedogo <jumbaeric@gmail.com>
 */
class Loxup
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Loxup_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('LOXUP_VERSION')) {
			$this->version = LOXUP_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'loxup';

		$this->load_dependencies();
		$this->set_locale();
		$this->require_acf();
		$this->partners_cpt();
		$this->location_taxonomy();
		$this->partner_tag_taxonomy();
		$this->partners_acf();
		$this->add_admin_options();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Loxup_Loader. Orchestrates the hooks of the plugin.
	 * - Loxup_i18n. Defines internationalization functionality.
	 * - Loxup_Admin. Defines all hooks for the admin area.
	 * - Loxup_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-loxup-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-loxup-i18n.php';

		/**
		 * The class responsible for requiring acf to be downloaded.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-loxup-require-acf.php';

		/**
		 * The class responsible for admin settings.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-loxup-partner-options.php';

		/**
		 * The class responsible for registering Partners cpt.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-loxup-partners-cpt.php';

		/**
		 * The class responsible for registering location Taxonomy.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-loxup-location-taxonomy.php';


		/**
		 * The class responsible for registering Partners custom fields.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-loxup-partners-acf-fields.php';

		/**
		 * The class responsible for registering location Taxonomy.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-loxup-partner-tag-taxonomy.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-loxup-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-loxup-public.php';

		$this->loader = new Loxup_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Loxup_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{
		$this->loader->add_action('plugins_loaded', new Loxup_i18n(), 'load_plugin_textdomain');
	}

	// Require ACF Plugin to be activated as it is required by Loxam Plugin
	private function require_acf()
	{
		$this->loader->add_action('tgmpa_register', new Loxup_Require_Acf(), 'register');
	}

	private function add_admin_options(){
		$this->loader->add_action('admin_init', new Loxup_Partner_Options(), 'loxup_register_settings');
		$this->loader->add_action('admin_menu', new Loxup_Partner_Options(), 'loxup_add_settings_page');
	}

	// Register Partners Custom Post Type
	private function partners_cpt()
	{
		$this->loader->add_action('init', new Loxup_Partners_Cpt(), 'register');
	}

	// Register Location Taxonomy
	private function location_taxonomy()
	{
		$this->loader->add_action('init', new Loxup_Location_Taxonomy(), 'register');
	}

	// Register Partner Tag Taxonomy
	private function partner_tag_taxonomy()
	{
		$this->loader->add_action('init', new Loxup_Partner_Tag_Taxonomy(), 'register');
	}

	// Register Partners Custom Fields
	private function partners_acf()
	{
		// Add action hook to register ACF fields for partners
		$this->loader->add_action('acf/init', new Loxup_Partners_Acf_Fields(), 'register');

		$this->loader->add_filter('acf/location/rule_values/post_type', new Loxup_Partners_Acf_Fields(), 'loxup_add_custom_acf_rule_values');
	}

	// add custom partners cpt endpoint to fit all permalink structures
	public function customPartnersCptEndpoint()
	{
		$this->loader->add_action('init', new Loxup_Partners_Cpt(), 'loxup_add_partner_endpoint');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new Loxup_Admin($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public = new Loxup_Public($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles', 9999);
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts', 9999);
		$this->loader->add_filter('template_include', $plugin_public, 'set_custom_partner_template', 9999);

		// public ajax requests
		$this->loader->add_action('wp_ajax_filter_partners', $plugin_public, 'filter_partners', 9999);
		$this->loader->add_action('wp_ajax_nopriv_filter_partners', $plugin_public, 'filter_partners', 9999);
		$this->loader->add_action('wp_ajax_filter_partners_markers', $plugin_public, 'filter_partners_markers', 9999);
		$this->loader->add_action('wp_ajax_nopriv_filter_partners_markers', $plugin_public, 'filter_partners_markers', 9999);

		$this->loader->add_action('wp_ajax_get_partner_locations', $plugin_public, 'get_partner_locations', 9999);
		$this->loader->add_action('wp_ajax_nopriv_get_partner_locations', $plugin_public, 'get_partner_locations', 9999);

		// $this->loader->add_action('wp_ajax_get_business_location_callback', $plugin_public, 'get_business_location_callback', 9999);
		// $this->loader->add_action('wp_ajax_nopriv_get_business_location_callback', $plugin_public, 'get_business_location_callback', 9999);

		$plugin_public->register_shortcodes();
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Loxup_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
