<?php
/**
 * AME Styler
 *
 * Requires Admin Menu Editor.
 * Adds collapsing sections and background colors to Admin Menu.
 *
 * @link https://wordpress.org/plugins/admin-menu-editor/
 *
 * @package JWR_Dev_Plugin
 * @author Josh Robbs <josh@joshrobbs.com>
 */

namespace JWR_Dev_Plugin\Classes;

defined( 'ABSPATH' ) || exit;

/**
 * AME Styler
 */
class AME_Styler {

	/**
	 * Initialize the admin menu system.
	 */
	public static function init() {
		if ( ! is_plugin_active( 'admin-menu-editor/menu-editor.php' ) ) {
			return;
		}

		\add_action( 'admin_head', array( __CLASS__, 'add_styles_to_head' ) );
		\add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_admin_assets' ) );
		\add_action( 'admin_init', array( __CLASS__, 'register_options' ) );

		$options_page = new Admin_Subpage(
			'Admin Menu Styler',
			'Admin Menu Styler',
			'admin-menu-styler',
			array( __CLASS__, 'render_options_page' )
		);
		Admin_Page::add_subpage( $options_page );
	}

	/**
	 * Render the options page.
	 *
	 * @return void
	 */
	public static function render_options_page() {
		?>
		<div class="wrap">
			<h1>Admin Menu Styler</h1>
			<p>Use the fields below to style the admin menu.</p>
			<form method="post" action="options.php">
				<?php
				settings_fields( 'admin-menu-styler' );
				do_settings_sections( 'admin-menu-styler' );
				submit_button();
				?>
			</form>
		</div>
		<?php

		// Add settings section.
		add_settings_section(
			'admin-menu-styler',
			'Admin Menu Styler',
			array( __CLASS__, 'render_settings_section' ),
			'admin-menu-styler'
		);
	}

	/**
	 * Add styles to the head.
	 *
	 * @return void
	 */
	public static function add_styles_to_head() {

		// Initial variables. They will be converted to options.
		$header_bg     = '#002244';
		$header_text   = '#ffffff';
		$a_header_bg   = '#820000';
		$a_header_text = '#ffffff';

		// There are no guards currently. This lets you use whatever valid format you want.
		$header_bg     = $header_bg ?? '#002244';
		$header_text   = $header_text ?? '#ffffff';
		$a_header_bg   = $a_header_bg ?? '#820000';
		$a_header_text = $a_header_text ?? '#ffffff';

		$style = <<<HTML
			<style id='admin-menu-styler'>
				#adminmenu li[class*="-menu-section-header"] {
					background-color: {$header_bg};
					color: {$header_text};
				}
		
				#adminmenu li[class*="-menu-section-header"] > a.menu-top:focus,
				#adminmenu li[class*="-menu-section-header"] > a.menu-top:hover {
					background-color: {$a_header_bg};
					color: {$a_header_text};
				}
		
				#adminmenu li[class*="-menu-section-item"] {
					display: none;
				}
			</style>
		HTML;

		// No kses. It breaks the style.
		echo $style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Enqueue admin assets.
	 *
	 * @return void
	 */
	public static function enqueue_admin_assets() {
		wp_enqueue_script(
			'jwr-admin-menu-style',
			JWR_DEV_PLUGIN_URL . 'js/admin-styler.js',
			array(),
			filemtime( JWR_DEV_PLUGIN_PATH . 'js/admin-styler.js' ),
			true
		);
	}

	/**
	 * Register options.
	 */
	public static function register_options() {
		// Register settings.
		register_setting( 'admin-menu-styler', 'header_bg_color' );
		register_setting( 'admin-menu-styler', 'header_text_color' );
		register_setting( 'admin-menu-styler', 'a_header_bg_color' );
		register_setting( 'admin-menu-styler', 'a_header_text_color' );

		// Add settings section.
		add_settings_section(
			'admin-menu-styler',
			'Admin Menu Styler',
			array( __CLASS__, 'render_settings_section' ),
			'admin-menu-styler'
		);

		// Add settings fields.
		add_settings_field(
			'header_bg_color',
			'Header Background Color',
			array( __CLASS__, 'render_header_bg_color_field' ),
			'admin-menu-styler',
			'admin-menu-styler'
		);
		add_settings_field(
			'header_text_color',
			'Header Text Color',
			array( __CLASS__, 'render_header_text_color_field' ),
			'admin-menu-styler',
			'admin-menu-styler'
		);
		add_settings_field(
			'a_header_bg_color',
			'Active Header Background Color',
			array( __CLASS__, 'render_a_header_bg_color_field' ),
			'admin-menu-styler',
			'admin-menu-styler'
		);
		add_settings_field(
			'a_header_text_color',
			'Active Header Text Color',
			array( __CLASS__, 'render_a_header_text_color_field' ),
			'admin-menu-styler',
			'admin-menu-styler'
		);
	}
}
