<?php
/**
 * enqueue.php
 *
 * @link       https://www.linkedin.com/in/cannarozzoluca/
 * @since      1.0.0
 * @author Luca Cannarozzo (@cannarocks)
 * @date 25/03/2021 15:08
 *
 *
 * @Last modified by:   Luca Cannarozzo (@cannarocks)
 * @Last modified time: 25/03/2021 15:08
 *
 * @package crowdappquality
 *
 */

function appq_crowd_importer_enqueue()
{
	$base_url = plugin_dir_url( __FILE__ );
	wp_enqueue_script( 'appq_crowd_importer_js',$base_url .'/js/scripts.js');
	wp_enqueue_style( 'appq_crowd_importer_css',$base_url .'/css/style.css');

	wp_localize_script( 'appq_crowd_importer_js', 'ajax', array(
		'url' => admin_url( 'admin-ajax.php' )
	) );

}

function appq_crowd_importer_load()
{
	add_action( 'admin_enqueue_scripts', 'appq_crowd_importer_enqueue' );
}
