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
									<label for="campaign_id">Redash User API Token</label>
									<input type="text" name="api-token" id="campaign_id"
									       placeholder="Redash token of an authorized user..." class="regular-text"
									       required/>
									<span class="description">Paste here the value of <a
												href="http://data.app-quality.com/users/me">API Key</a></span>
								</div>
								<div class="form-group">
									<label for="campaign_id">Campaign ID</label>
									<input type="number" name="campaign-id" id="campaign_id"
									       placeholder="CP_ID: for example 1234" class="regular-text" required/>
								</div>
								<div class="form-group">
									<label for="campaign_id">Tester ID</label>
									<input type="number" name="campaign-id" id="campaign_id"
									       placeholder="We have to assign the imported bugs to a real user, write here the tester_id"
									       class="regular-text" required/>
								</div>
								<input type="hidden" name="action" value="appq_crowd_importer_action">
								<input type="hidden" name="nonce" value="<?= wp_create_nonce('appq_crowd_importer_action' .  get_current_tester_id()) ?>">
								<br>
								<br>
								<button class="button-primary" type="submit">
									<?php esc_attr_e( 'Start import', 'appqcrowdimporter' ); ?>
								</button>
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
									'With this form you\'ll be able to import an existing functional campaign with bugs.\n A few notes:',
									'appqcrowdimporter'
								); ?>
							</p>
							<ol>
								<li><?= __( 'If you choose a campaign without bugs, an error will be raised', 'appqcrowdimporter' ) ?></li>
								<li><?= __( 'This tool <strong>DOESN\'T</strong> import support pages (i.e. manual and preview pages', 'appqcrowdimporter' ) ?></li>
								<li><?= __( 'Every bug will be assigned to an existent tester (i.e. an user registered in this crowd istance)', 'appqcrowdimporter' ) ?></li>
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
