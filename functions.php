<?php
/**
 * functions.php
 *
 * @link       https://www.linkedin.com/in/cannarozzoluca/
 * @since      1.0.0
 * @author Luca Cannarozzo (@cannarocks)
 * @date 25/03/2021 15:16
 *
 *
 * @Last modified by:   Luca Cannarozzo (@cannarocks)
 * @Last modified time: 25/03/2021 15:16
 *
 * @package crowdappquality
 *
 */

function crowd_importer_render()
{
	$file = plugin_dir_path( __FILE__ ) . "/views/admin_panel.php";

	if ( file_exists( $file ) ) require $file;
}
