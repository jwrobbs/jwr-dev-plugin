<?php
/**
 * Admin Page class
 *
 * @package JWR_Dev_Plugin
 * @author Josh Robbs <josh@joshrobbs.com>
 */

namespace JWR_Dev_Plugin\Classes;

use JWR_Dev_Plugin\Classes\Admin_Subpage;

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
	protected $subpages = array();

	/**
	 * Parent slug for the main menu.
	 *
	 * @var string
	 */
	protected static $parent_slug = 'jwr-options';
	/**
	 * Instance of the Admin_Page class.
	 *
	 * @var Admin_Page
	 */
	protected static $instance;

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

		$page_title = 'JWR Options';
		$menu_title = 'JWR Options';
		$slug       = self::$parent_slug;
		// Add the main options page.
		add_menu_page(
			$page_title, // Page title.
			$menu_title, // Menu title.
			'manage_options', // Capability.
			$slug, // Menu slug.
			array( __CLASS__, 'render_main_page' ), // Callback function.
			'dashicons-admin-generic', // Icon.
			80 // Position.
		);

		// Add subpages.
		self::register_subpages();
	}

	/**
	 * Dynamically register subpages.
	 */
	private static function register_subpages() {
		$admin_page  = self::get_instance();
		$parent_slug = self::$parent_slug;
		foreach ( $admin_page->subpages as $subpage ) {
			$result = add_submenu_page(
				$parent_slug,                // Parent slug.
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

		$admin_page             = self::get_instance();
		$admin_page->subpages[] = $subpage;
	}

	/**
	 * Render the main options page.
	 */
	public static function render_main_page() {
		echo '<div class="wrap"><h1>JWR Options</h1><p>Welcome to the Dev Plugin options page.</p></div>';
		echo '<div class="wrap">- Add fields to set titles.</div>';
		echo '<div class="wrap">- Add fields to activate plugin features.</div>';
	}

	/**
	 * Get instance of the Admin_Page class.
	 *
	 * @return Admin_Page
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}
