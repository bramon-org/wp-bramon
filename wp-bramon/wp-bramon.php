<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://bramonmeteor.org
 * @since             1.0.0
 * @package           wp-bramon
 *
 * @wordpress-plugin
 * Plugin Name:       WP Bramon
 * Plugin URI:        http://bramonmeteor.org/wp-bramon/
 * Description:       BRAMON API Wordpress plugin.
 * Version:           1.0.0
 * Author:            Thiago Paes
 * Author URI:        http://bramonmeteor.org/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-bramon
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Put here your API Key
if ( ! defined( 'BRAMON_API_KEY' ) ) {
	define('BRAMON_API_KEY', '');
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'Wp_Bramon_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-bramon-activator.php
 */
function activate_Wp_Bramon() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-bramon-activator.php';
	Wp_Bramon_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-bramon-deactivator.php
 */
function deactivate_Wp_Bramon() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-bramon-deactivator.php';
	Wp_Bramon_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Wp_Bramon' );
register_deactivation_hook( __FILE__, 'deactivate_Wp_Bramon' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-bramon.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Wp_Bramon() {

	$plugin = new Wp_Bramon();
	$plugin->run();

}
run_Wp_Bramon();
