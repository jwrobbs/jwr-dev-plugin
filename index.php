<?php
/**
 * JWR Shared Options
 * Plugin Name:       JWR Dev Plugin
 * Plugin URI:        https://github.com/jwrobbs/jwr-dev-plugin
 * Description:       Adds scripts and widgets for devs.
 * Version:           0.2.1
 * Author:            Josh Robbs <josh@joshrobbs.com>
 * Author URI:        https://joshrobbs.com
 * Text Domain:       jwr
 * Requires PHP:      8.0
 *
 * @package JWR_Dev_Plugin
 * @author Josh Robbs <josh@joshrobbs.com>
 */

namespace JWR\DevPlugin;

use JWR_Dev_Plugin\Classes\Admin_Page;
use JWR_Dev_Plugin\Classes\AME_Styler;

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'JWR_DEV_PLUGIN_PATH' ) ) {
	// Plugin path constant.
	define( 'JWR_DEV_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'JWR_DEV_PLUGIN_URL' ) ) {
	// Plugin URL constant.
	define( 'JWR_DEV_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

require_once __DIR__ . '/helpers/plugin-updates.php';

// Admin pages.
require_once __DIR__ . '/classes/class-admin-page.php';
require_once __DIR__ . '/classes/class-admin-subpage.php';
Admin_Page::init();

// AME Styler.
require_once __DIR__ . '/classes/class-ame-styler.php';
AME_Styler::init();
