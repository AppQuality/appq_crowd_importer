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

	if ( file_exists( $file ) )
	{
		require $file;
	}
}

/**
 * getDataFromRedash
 *
 *
 * @param $query_id
 * @param $apiToken
 * @param $params
 *
 * @return     bool|string
 * @since      1.0.0
 * @author     Luca Cannarozzo (@cannarocks)
 * @date       26/03/2021 09:02
 *
 * @Last modified by:   Luca Cannarozzo (@cannarocks)
 * @Last modified time: 26/03/2021 09:02
 *
 *
 */
function ci_getDataFromRedash( $query_id, $apiToken, $params )
{
	try
	{
		$curl = curl_init();

		curl_setopt_array( $curl, array(
			CURLOPT_URL            => 'http://data.app-quality.com/api/queries/' . $query_id . '/results',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => '',
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => 'POST',
			CURLOPT_POSTFIELDS     => sprintf( '{ "parameters": %s}', $params ),
			CURLOPT_HTTPHEADER     => array(
				'Authorization: Key ' . $apiToken,
				'Content-Type: application/json'
			),
		) );

		$response = json_decode( curl_exec( $curl ) );
		curl_close( $curl );

		return ! empty( $response ) && property_exists( $response, 'query_result' ) ? $response->query_result : false;
	} catch ( Exception $ex )
	{
		error_log( $ex->getMessage() );

		return false;
	}

}


/**
 * ci_createBugFromData
 *
 *
 * @param $bug
 * @param $newCpId
 * @param $user_id
 *
 * @return bool|int
 * @since      1.0.0
 * @author     Luca Cannarozzo (@cannarocks)
 * @date       26/03/2021 17:23
 *
 * @Last modified by:   Luca Cannarozzo (@cannarocks)
 * @Last modified time: 26/03/2021 17:23
 */
function ci_createBugFromData($bug, $newCpId, $user_id)
{
	if(array_key_exists( 'id', $bug))
	{
		global $wpdb;
		unset( $bug["id"]);
		if(array_key_exists( 'media', $bug ))
		{
			$medias = json_decode( "[". $bug['media'] ."]", true);
			unset( $bug["media"]);
		}

		$bug['campaign_id'] = $newCpId;
		$bug['wp_user_id'] = $user_id;
		$bug['reviewer'] = 0;

		$res = $wpdb->insert( $wpdb->prefix . 'appq_evd_bug', $bug);

		if($res)
		{
			$bug_id = $wpdb->insert_id;
			if(count( $medias ) > 0)
			{
				foreach ($medias as $media)
				{
					$media['bug_id'] = $bug_id;
					$wpdb->insert(
						$wpdb->prefix . 'appq_evd_bug_media',
						$media
					);
				}
			}

			return $bug_id;
		}
	}

	return  false;

}
