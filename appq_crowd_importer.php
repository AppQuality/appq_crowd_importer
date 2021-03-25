<?php
/**
 * Add admin panel in order to allow Crowd data import
 *
 * @package   appq_crowd_importer
 * @author    Luca Cannarozzo <luca.cannarozzo@app-quality.com>
 * @license   GPL-3.0
 * @link      https://github.com/AppQuality/appq_crowd_importer
 * @copyright 2021 Luca Cannarozzo, AppQuality
 *
 * @wordpress-plugin
 * Plugin Name:       CrowdAppQuality Importer
 * Plugin URI:       https://github.com/AppQuality/appq_crowd_importer
 * Description:       Add admin panel in order to import campaigns and bug from the official Crowd AppQuality platform.
 * Version:           1.0.0
 * Author:            Luca Cannarozzo
 * Author URI:        https://github.com/cannarocks
 * Text Domain:       appq-crowd-importer
 * License:           GPL-3.0
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/AppQuality/appq_crowd_importer
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) )
{
	die;
}

$file = plugin_dir_path( __FILE__ ) . "enqueue.php";
require $file;

$file = plugin_dir_path( __FILE__ ) . "register.php";
require $file;

$file = plugin_dir_path( __FILE__ ) . "functions.php";
require $file;

$classes = glob(plugin_dir_path( __FILE__ ) . "/class/*.php");

foreach($classes as $file)
{
	require $file;
}

function load_appq_crowd_importer_textdomain()
{
	load_plugin_textdomain( 'appqcrowdimporter', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'load_appq_crowd_importer_textdomain' );

