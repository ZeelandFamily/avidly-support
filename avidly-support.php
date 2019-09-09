<?php /*
Plugin Name: Avidly Support plugin
Plugin URI: http://avidlyagency.com
Description: Creates a REST API endpoint for monitoring the status of core and plugin updates of our client sites and adds helpful features for the devs and users, like a HelpScout Beacon
Version: 0.1
Author: Niku Hietanen / Avidly
Author URI: http://avidlyagency.com
License: GPL3
*/
namespace Avidly\SupportClient;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/bootstrap.php';
require_once __DIR__ . '/src/Admin/bootstrap.php';

// Load plugin.php & update.php to run the needed core admin functions if not logged in.
if ( ! function_exists( 'get_plugins' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
	require_once ABSPATH . 'wp-admin/includes/update.php';
}

define( 'AVIDLY_SUPPORT_OPTION_KEY', 'avidly-support-secret' );
define( 'AVIDLY_SUPPORT_HELPSCOUT_BEACON', 'avidly-support-helpscout-beacon' );
define( 'AVIDLY_SUPPORT_HELPSCOUT_BEACON_FRONT', 'avidly-support-helpscout-beacon-front' );
define( 'UPDATE_SERVER', 'https://test.foo' );

add_action( 'init', __NAMESPACE__ . '\\bootstrap' );
add_action( 'plugins_loaded', __NAMESPACE__ . '\\Admin\\bootstrap' );

$check_updates = \Puc_v4_Factory::buildUpdateChecker(
	UPDATE_SERVER . 'plugin.json',
	__FILE__,
	'avidly-support'
);
