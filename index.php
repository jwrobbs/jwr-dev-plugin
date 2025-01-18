<?php
/**
 * JWR Shared Options
 *
 * @package JWR_Dev_Plugin
 * @author Josh Robbs <josh@joshrobbs.com>
 *
 * @wordpress-plugin
 * Plugin Name:       JWR Dev Plugin
 * Plugin URI:        https://github.com/jwrobbs/jwr-dev-plugin
 * Description:       Adds scripts and widgets for devs.
 * Version:           0.1.1
 * Author:            Josh Robbs <josh@joshrobbs.com>
 * Author URI:        https://joshrobbs.com
 * Text Domain:       jwr
 * Requires PHP:      8.0
 */

namespace JWR\DevPlugin;

use JWR_Dev_Plugin\Admin_Page;

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/helpers/plugin-updates.php';

// Classes.
require_once __DIR__ . '/classes/class-admin-page.php';
require_once __DIR__ . '/classes/class-admin-subpage.php';

Admin_Page::init();
