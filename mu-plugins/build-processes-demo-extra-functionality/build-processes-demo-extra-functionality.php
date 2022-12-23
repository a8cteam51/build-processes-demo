<?php
/**
 * The Build Processes Demo extra functionality plugin bootstrap file.
 *
 * @since       0.1.0
 * @version     0.1.0
 * @author      WP Special Projects
 * @license     GPL-3.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:             Build Processes Demo Extra Functionality
 * Description:             An extra functionality plugin for a custom theme. Could include post types, metaboxes etc. Do not use for blocks!
 * Version:                 0.1.0
 * Requires at least:       6.1
 * Requires PHP:            8.1
 * Author:                  WP Special Projects
 * Author URI:              https://wpspecialprojects.wordpress.com/
 * License:                 GPL-3.0-or-later
 * License URI:             https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:             build-processes-demo-extra-functionality
 * Domain Path:             /languages
 */

defined( 'ABSPATH' ) || exit;

// Loads the extra functionality plugin's translated strings.
function bpd_ef_load_textdomain(): void {
	load_muplugin_textdomain( 'build-processes-demo-extra-functionality', dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'bpd_ef_load_textdomain' );

// Registers and/or enqueues the extra functionality plugin's scripts and stylesheets.
function bpd_ef_enqueue_assets(): void {
	$asset_meta = array(
		'dependencies' => array(),
		'version'      => filemtime( __DIR__ . '/assets/css/build/extra.css' ),
	);
	wp_enqueue_style( 'build-processes-demo-ef', plugin_dir_url( __DIR__ ) . 'assets/css/build/extra.css', $asset_meta['dependencies'], $asset_meta['version'] );

	$asset_meta = require __DIR__ . '/assets/js/build/index.asset.php';
	wp_enqueue_script( 'build-processes-demo-ef', plugin_dir_url( __DIR__ ) . 'assets/js/build/index.js', $asset_meta['dependencies'], $asset_meta['version'], true );
}
add_action( 'wp_enqueue_scripts', 'bpd_ef_enqueue_assets' );

// Include the rest of the extra functionality plugin's files.
foreach ( glob( __DIR__ . '/includes/*.php' ) as $bpd_ef_filename ) {
	if ( preg_match( '#/includes/_#i', $bpd_ef_filename ) ) {
		continue; // Ignore files prefixed with an underscore.
	}

	include $bpd_ef_filename;
}
