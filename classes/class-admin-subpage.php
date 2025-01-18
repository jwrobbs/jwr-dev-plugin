<?php
/**
 * Admin Page class
 *
 * @package JWR_Dev_Plugin
 * @author Josh Robbs <josh@joshrobbs.com>
 */

namespace JWR_Dev_Plugin;

defined( 'ABSPATH' ) || exit;

/**
 * Admin Page class
 */
class Admin_Subpage {
	/**
	 * Constructor to define a subpage.
	 *
	 * @param string       $title      Page title.
	 * @param string       $menu_title Menu title.
	 * @param string       $slug       Menu slug.
	 * @param string|array $callback   Callback function to render the page.
	 */
	public function __construct(
		private string $title,
		private string $menu_title,
		private string $slug,
		private string|array $callback
	) {
		$this->title      = $title;
		$this->menu_title = $menu_title;
		$this->slug       = $slug;
		$this->callback   = $callback;
	}

	/**
	 * Get the page title.
	 *
	 * @return string Page title.
	 */
	public function get_title() {
		return $this->title;
	}

	/**
	 * Get the menu title.
	 *
	 * @return string Menu title.
	 */
	public function get_menu_title() {
		return $this->menu_title;
	}

	/**
	 * Get the menu slug.
	 *
	 * @return string Menu slug.
	 */
	public function get_slug() {
		return $this->slug;
	}
}
