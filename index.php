<?php
/**
 * JWR Shared Options
 * Plugin Name:       JWR Dev Plugin
 * Plugin URI:        https://github.com/jwrobbs/jwr-dev-plugin
 * Description:       Adds scripts and widgets for devs.
 * Version:           0.1.4
 * Author:            Josh Robbs <josh@joshrobbs.com>
 * Author URI:        https://joshrobbs.com
 * Text Domain:       jwr
 * Requires PHP:      8.0
 *
 * @package JWR_Dev_Plugin
 * @author Josh Robbs <josh@joshrobbs.com>
 */

namespace JWR\DevPlugin;

use JWR_Dev_Plugin\Admin_Page;

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'JWR_DEV_PLUGIN' ) ) {
	define( 'JWR_DEV_PLUGIN', __FILE__ );
}

require_once __DIR__ . '/helpers/plugin-updates.php';

// Classes.
require_once __DIR__ . '/classes/class-admin-page.php';
require_once __DIR__ . '/classes/class-admin-subpage.php';

Admin_Page::init();
