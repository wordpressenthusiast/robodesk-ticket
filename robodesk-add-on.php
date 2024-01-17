<?php

/**
 * @link              https://robodesk.co
 * @since             1.0.0
 * @package           Robodesk
 *
 * Plugin Name:       Robodesk Tickets Addon
 * Plugin URI:       
 * Description:       Plugin Description
 * Version:           1.0.0
 * Author:            Robodesk
 * Author URI:        https://robodesk.co
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.en.html
 * Text Domain:       robodesk
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')){
    die;
}

/**
 * Currently plugin version.
 */
define( 'ROBODESK_TICKETS_ADDON_VERSION', '1.0.0' );

define( 'PLUGIN_ROOT_DIR', plugin_dir_path( __FILE__ ) );


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( is_plugin_active( 'robodesk/robodesk.php' ) ) {
	$init_file = PLUGIN_ROOT_DIR .'/robodesk-add-on-loader.php'; 
	require_once $init_file;

} else {
	if ( ! function_exists( 'robodesk_add_on_notification' ) ) {
		function robodesk_add_on_notification() {
			?>
			<div id="message" class="error">
				<p><?php _e( 'Please install and activate Robodesk to use Robodesk add on .', 'robodesk' ); ?></p>
			</div>
			<?php
		}
	}
	add_action( 'admin_notices', 'robodesk_add_on_notification' );
}

    

   

/*end of file*/


