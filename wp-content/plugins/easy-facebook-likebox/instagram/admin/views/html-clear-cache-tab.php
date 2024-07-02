<?php
/**
 * Admin View: Tab - Clear Cache
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( isset( $fta_settings['plugins']['instagram']['access_token'] ) ) {
	$access_token = $fta_settings['plugins']['instagram']['access_token'];
}

$mif_trans_posts   = $this->get_cache( 'posts' );
$mif_trans_bio     = $this->get_cache( 'bio' );
$mif_trans_stories = $this->get_cache( 'stories' );

?>
<div id="mif-cache" class="mif_tab_c slideLeft <?php echo $active_tab == 'mif-cache' ? 'active' : ''; ?>">
	<div class="mif-swipe-cache_wrap">
		<h5><?php esc_html_e( 'Cached Feeds', 'easy-facebook-likebox' ); ?></h5>
		<p><?php esc_html_e( 'Following are the feeds cached data from Instagram API. Delete the cache to refresh your feeds manually', 'easy-facebook-likebox' ); ?></p>
	   <?php if ( $mif_trans_posts || $mif_trans_bio || $mif_trans_stories ) { ?>
		<button class="btn clear-all-cache"><?php esc_html_e( 'Clear all', 'easy-facebook-likebox' ); ?></button>
			<?php
	   }

	   if ( $mif_trans_bio ) {
			?>

			<ul class="collection with-header mif_bio_collection">
				<li class="collection-header">
					<h5><?php esc_html_e( 'Profile Bio', 'easy-facebook-likebox' ); ?></h5>
				</li>

				<?php
				foreach ( $mif_trans_bio as $key => $value ) {
					$pieces     = explode( '-', $key );
					$trans_name = array_pop( $pieces );

					?>

					<li class="collection-item <?php esc_attr_e( $key ); ?>">
						<div><?php esc_html_e( $trans_name ); ?>
							<a href="javascript:void(0);"
							   data-mif_collection="mif_bio_collection"
							   data-mif_trans="<?php esc_attr_e( $key ); ?>"
							   class="secondary-content mif_del_trans"><span class="dashicons dashicons-trash right"></span></a>
						</div>
					</li>
				<?php } ?>

			</ul>

		   <?php
	   }
	   if ( $mif_trans_stories ) {
			?>

			<ul class="collection with-header mif_bio_collection">
				<li class="collection-header">
					<h5><?php esc_html_e( 'Stories', 'easy-facebook-likebox' ); ?></h5>
				</li>

				<?php
				foreach ( $mif_trans_stories as $key => $value ) {
					$pieces     = explode( '-', $key );
					$trans_name = array_pop( $pieces );

					?>

					<li class="collection-item <?php esc_attr_e( $key ); ?>">
						<div><?php esc_html_e( $trans_name ); ?>
							<a href="javascript:void(0);"
							   data-mif_collection="mif_bio_collection"
							   data-mif_trans="<?php esc_attr_e( $key ); ?>"
							   class="secondary-content mif_del_trans"><span class="dashicons dashicons-trash right"></span></a>
						</div>
					</li>
				<?php } ?>

			</ul>

		   <?php
	   }

	   if ( $mif_trans_posts ) {
			?>

			<ul class="collection with-header mif_users_collection">
				<li class="collection-header">
					<h5><?php esc_html_e( 'Feeds', 'easy-facebook-likebox' ); ?></h5>
				</li>

				<?php
				foreach ( $mif_trans_posts as $key => $value ) {
					$pieces     = explode( '-', $key );
					$trans_name = array_pop( $pieces );
					$trans_name = $pieces['1'];

					if ( strpos( $key, 'hashtag' ) !== false ) {

						$hashtag_pieces = explode( '-', $key );

						if ( isset( $hashtag_pieces['4'] ) ) {
							$trans_name = '#' . $hashtag_pieces['4'];
						}
					}


					?>

					<li class="collection-item <?php esc_attr_e( $key ); ?>">
						<div><?php esc_html_e( $trans_name ); ?>
							<a href="javascript:void(0);"
							   data-mif_collection="mif_users_collection"
							   data-mif_trans="<?php esc_attr_e( $key ); ?>"
							   class="secondary-content mif_del_trans"><span class="dashicons dashicons-trash right"></span></a>
						</div>
					</li>
				<?php } ?>
			</ul>

		   <?php
	   }


	   if ( empty( $mif_trans_posts ) && empty( $mif_trans_bio ) ) {
			?>

			<p><?php esc_html_e( 'Whoops! nothing cached at the moment.', 'easy-facebook-likebox' ); ?></p>

		<?php } ?>
	</div>
</div>
