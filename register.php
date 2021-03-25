<?php
/**
 * register.php
 *
 * @link       https://www.linkedin.com/in/cannarozzoluca/
 * @since      1.0.0
 * @author Luca Cannarozzo (@cannarocks)
 * @date 25/03/2021 15:10
 *
 *
 * @Last modified by:   Luca Cannarozzo (@cannarocks)
 * @Last modified time: 25/03/2021 15:10
 *
 * @package crowdappquality
 *
 */

function appq_crowd_importer_register()
{

	$page = add_submenu_page(
		'mvc_campaigns',
		'Crowd Importer',
		'Crowd Importer',
		'wp_admin_visibility',
		'crowd_importer',
		'crowd_importer_render'
	);
	add_action( 'load-' . $page, 'appq_crowd_importer_load' );

}
add_action( 'admin_menu', 'appq_crowd_importer_register', 11 );
