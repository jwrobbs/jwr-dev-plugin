<?php
/**
 * Admin Page class
 *
 * @package JWR_Dev_Plugin
 * @author Josh Robbs <josh@joshrobbs.com>
 */

namespace JWR_Dev_Plugin;

use JWR_Dev_Plugin\Admin_Subpage;

defined( 'ABSPATH' ) || exit;

/**
 * Admin Page class
 */
class Admin_Page {
	/**
	 * Store registered subpages.
	 *
	 * @var Subpage_Definition[]
	 */
	private static $subpages = array();

	/**
	 * Initialize the admin menu system.
	 */
	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'register_pages' ), 10 );
	}

	/**
	 * Register the main menu and subpages.
	 */
	public static function register_pages() {
		// Add the main options page.
		add_menu_page(
			'Dev Plugin Options',          // Page title.
			'Dev Plugin',                  // Menu title.
			'manage_options',              // Capability.
			'dev-plugin',                  // Menu slug.
			array( __CLASS__, 'render_main_page' ), // Callback function.
			'dashicons-admin-generic',     // Icon.
			80                             // Position.
		);

		// Add subpages.
		self::register_subpages();
	}

	/**
	 * Dynamically register subpages.
	 */
	private static function register_subpages() {
		foreach ( self::$subpages as $subpage ) {
			add_submenu_page(
				'dev-plugin',                // Parent slug.
				$subpage->get_title(),       // Page title.
				$subpage->get_menu_title(),  // Menu title.
				'manage_options',            // Capability.
				$subpage->get_slug(),        // Menu slug.
				array( $subpage, 'render' ) // Callback function.
			);
		}
	}

	/**
	 * Allow external registration of subpages.
	 *
	 * @param Admin_Subpage $subpage The subpage instance to add.
	 */
	public static function add_subpage( Admin_Subpage $subpage ) {
		self::$subpages[] = $subpage;
	}

	/**
	 * Render the main options page.
	 */
	public static function render_main_page() {
		echo '<div class="wrap"><h1>Dev Plugin Main Options</h1><p>Welcome to the Dev Plugin options page.</p></div>';
	}
}
