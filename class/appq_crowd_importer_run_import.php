<?php
/**
 * appq_crowd_importer_run_import.php
 *
 * @link       https://www.linkedin.com/in/cannarozzoluca/
 * @since      1.0.0
 * @author Luca Cannarozzo (@cannarocks)
 * @date 25/03/2021 18:28
 *
 *
 * @Last modified by:   Luca Cannarozzo (@cannarocks)
 * @Last modified time: 25/03/2021 18:28
 *
 * @package crowdappquality
 *
 */

function appq_crowd_importer_run_import()
{
	$sourceCpId = isset( $_POST['from-campaign-id'] ) ? intval( $_POST['from-campaign-id'] ) : false;
	$targetCpId = isset( $_POST['target-campaign-id'] ) ? intval( $_POST['target-campaign-id'] ) : false;
	$apiToken   = isset( $_POST['api-token'] ) ? sanitize_text_field( $_POST['api-token'] ) : false;
	$testerId   = isset( $_POST['tester-id'] ) ? intval( $_POST['tester-id'] ) : false;
	$nonce      = isset( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : false;

	if ( ! wp_verify_nonce( $nonce, 'appq_crowd_importer_action' . get_current_tester_id() )
	     || ! $sourceCpId || !$targetCpId || ! $apiToken || ! $testerId )
	{
		wp_send_json_error('Error 400: Bad Request');
	}else
	{
		$p = sprintf( '{ "campaign_id" : %d}', $sourceCpId);
		$response = ci_getDataFromRedash( 171, $apiToken, $p);

		if($response && property_exists( $response, 'data') && property_exists( $response->data, 'rows'))
		{

			$bugs = $response->data->rows;
			$wp_user_id = get_tester_data( 'wp_user_id', $testerId);

			if(!$wp_user_id) wp_send_json_error('Error 500: user doesn\'t exists.');

			/**
			 * Import Bugs
			 */
			$bugsImported = 0;
			$failed = 0;
			foreach ($bugs as $bug)
			{
				$res = ci_createBugFromData( (array) $bug, $targetCpId, $wp_user_id);
				if($res) $bugsImported++;
				else $failed++;
			}
			if($bugsImported > 0)
			{
				wp_send_json_success(['uploaded' => $bugsImported, 'errors' => $failed]);
			}else
			{
				wp_send_json_error(['uploaded' => $bugsImported, 'errors' => $failed]);
			}
		}else
		{
			wp_send_json_error('Please check if you have all the necessary authorizations to execute this redash query (Sometimes Redash requires a second request in order to fill the query results cache).');
		}
	}
}

add_action( 'wp_ajax_appq_crowd_importer_action', 'appq_crowd_importer_run_import' );
