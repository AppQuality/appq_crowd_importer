<?php
/**
 * admin_panel.php
 *
 * @link       https://www.linkedin.com/in/cannarozzoluca/
 * @since      1.0.0
 * @author Luca Cannarozzo (@cannarocks)
 * @date 25/03/2021 15:12
 *
 *
 * @Last modified by:   Luca Cannarozzo (@cannarocks)
 * @Last modified time: 25/03/2021 15:12
 *
 * @package crowdappquality
 *
 */
?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?= __( 'Crowd AppQuality Importer', 'appqcrowdimporter' ) ?></h1>
	<hr class="wp-header-end">

	<!-- START #poststuff -->
	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<div id="import_notice" class="notice notice-success inline" style="display: none;">
				<p id="import_result"></p>
			</div>

			<!-- START main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

						<h2>
							<span><?php esc_attr_e( 'Import Form', 'appqcrowdimporter' ); ?></span>
						</h2>

						<div class="inside">
							<form id="crowd_importer_form" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="api_token">Redash User API Token</label>
									<input type="text" name="api-token" id="api_token"
									       placeholder="Redash token of an authorized user..." class="regular-text"
									       required/>
									<span class="description">Paste here the value of <a
												href="http://data.app-quality.com/users/me">API Key</a></span>
								</div>
								<div class="form-group">
									<label for="from_campaign_id">Import Bugs Campaign ID</label>
									<input type="number" name="from-campaign-id" id="from_campaign_id"
									       placeholder="Select the source campaign id" class="regular-text" required/>
								</div>
								<div class="form-group">
									<label for="target_campaign_id">Import Bugs <strong>to</strong> Campaign ID</label>
									<input type="number" name="target-campaign-id" id="target_campaign_id"
									       placeholder="where do you want to add bugs?" class="regular-text" required/>
								</div>
								<div class="form-group">
									<label for="tester_id">Tester ID</label>
									<input type="number" name="tester-id" id="tester_id"
									       placeholder="We have to assign the imported bugs to a real user, write here the tester_id"
									       class="regular-text" required/>
								</div>
								<input type="hidden" name="action" value="appq_crowd_importer_action">
								<input type="hidden" name="nonce"
								       value="<?= wp_create_nonce( 'appq_crowd_importer_action' . get_current_tester_id() ) ?>">
								<br>
								<br>
								<button class="button-primary" type="submit" id="ci_submit_btn">
									<?php esc_attr_e( 'Start import', 'appqcrowdimporter' ); ?>
								</button>
								<div class="spinner" id="wp_spinner"></div>
							</form>
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->

				</div><!--END .meta-box-sortables .ui-sortable -->

			</div><!-- END post-body-content -->

			<!-- START sidebar -->
			<div id="postbox-container-1" class="postbox-container">
				<div class="meta-box-sortables">
					<div class="postbox">

						<h2>
							<?php _e( 'Information', 'appqcrowdimporter' ); ?>
						</h2>

						<div class="inside">
							<p>
								<?php esc_attr_e(
									'With this form you\'ll be able to import bugs from an existing Campaign to another..\n A few notes:',
									'appqcrowdimporter'
								); ?>
							</p>
							<ol>
								<li><?= __( 'If you choose a campaign without bugs, an error will be raised', 'appqcrowdimporter' ) ?></li>
								<li><?= __( 'This tool <strong>DOESN\'T</strong> import Campaign data and the related support pages (i.e. manual and preview pages', 'appqcrowdimporter' ) ?></li>
								<li><?= __( 'Every bug will be assigned to an existent tester (i.e. an user registered in this crowd instance)', 'appqcrowdimporter' ) ?></li>
							</ol>
						</div>
						<!-- .inside -->

					</div><!--END .postbox -->
				</div><!--END .meta-box-sortables -->
			</div><!-- END #postbox-container-1 .postbox-container -->

		</div><!--END #post-body .metabox-holder .columns-2 -->

		<br class="clear">
	</div><!--END #poststuff -->
</div>
