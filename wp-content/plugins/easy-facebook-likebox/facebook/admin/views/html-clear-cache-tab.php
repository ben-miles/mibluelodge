<?php
/**
 * Admin View: Tab - Clear Cache
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$FTA          = new Feed_Them_All();
$fta_settings = $FTA->fta_get_settings();

?>
<div id="efbl-cached" class="col s12 efbl_tab_c slideLeft <?php echo esc_attr( $active_tab == 'efbl-cached' ? 'active' : '' ); ?>">
	<h5>
		<?php esc_html_e( 'Cached Data', 'easy-facebook-likebox' ); ?>
	</h5>
	<p>
		<?php esc_html_e( 'Following are the pages cached data from Facebook API. Delete the cache to refresh your feeds manually', 'easy-facebook-likebox' ); ?>
	</p>

	<?php

	$efbl_trans_posts = $this->get_cache( 'posts' );
	$efbl_trans_group = $this->get_cache( 'group' );
	$efbl_trans_bio   = $this->get_cache( 'bio' );

	if ( $efbl_trans_posts || $efbl_trans_group || $efbl_trans_bio ) {
		?>
	<button class="btn clear-all-cache"><?php esc_html_e( 'Clear all', 'easy-facebook-likebox' ); ?></button>
		<?php
	}

	if ( $efbl_trans_bio ) {
		?>
		<ul class="collection with-header efbl_bio_collection">
			<li class="collection-header">
				<h5><?php esc_html_e( 'Page(s) Bio', 'easy-facebook-likebox' ); ?></h5>
			</li>

			<?php
			foreach ( $efbl_trans_bio as $key => $value ) {
				$pieces     = explode( '-', $key );
				$trans_name = array_pop( $pieces );

				$approved_pages = $fta_settings['plugins']['facebook']['approved_pages'];

				$bio_name = '';

				if ( isset( $approved_pages[ $trans_name ] ) ) {

					$efbl_post = $approved_pages[ $trans_name ];

					$bio_name = $efbl_post['name'];

				}

				?>

				<li class="collection-item <?php esc_attr_e( $key ); ?>">
					<div><?php esc_html_e( $bio_name ); ?>
						<a href="javascript:void(0);"
						   data-efbl_collection="efbl_bio_collection"
						   data-efbl_trans="<?php esc_attr_e( $key ); ?>"
						   class="secondary-content efbl_del_trans"><span class="dashicons dashicons-trash right"></span></a>
					</div>
				</li>

			<?php } ?>
		</ul>
		<?php
	}

	if ( $efbl_trans_posts ) {
		?>

		<ul class="collection with-header efbl_posts_collection">
			<li class="collection-header">
				<h5><?php esc_html_e( 'Page(s) Feed', 'easy-facebook-likebox' ); ?></h5>
			</li>

			<?php
			foreach ( $efbl_trans_posts as $key => $value ) {

				$filter = '';

				$pieces = explode( '_', $key );

				$page_name = array_pop( $pieces );

				$second_pieces = explode( '-', $page_name );

				$page_name = $second_pieces['0'];

				$key = str_replace( ' ', '', $key );

				$filter = $pieces['3'];
				?>

				<li class="collection-item <?php esc_attr_e( $key ); ?>">
					<div><?php esc_html_e( $page_name ); ?> <?php
					if ( $filter ) :
						?>
						(<?php echo esc_html( ucfirst( $filter ) ); ?>) <?php endif; ?>
						<a href="javascript:void(0);"
						   data-efbl_trans="<?php esc_attr_e( $key ); ?>"
						   class="secondary-content efbl_del_trans"><span class="dashicons dashicons-trash right"></span></a>
					</div>
				</li>

			<?php } ?>
		</ul>
		<?php
	}
	if ( $efbl_trans_group ) {
		?>

		<ul class="collection with-header efbl_posts_collection">
			<li class="collection-header">
				<h5><?php esc_html_e( 'Group(s) Feed', 'easy-facebook-likebox' ); ?></h5>
			</li>

			<?php
			foreach ( $efbl_trans_group as $key => $value ) {

				$pieces    = explode( '_', $key );
				$page_name = $pieces[4];

				if ( isset( $fta_settings['plugins']['facebook']['approved_groups'] ) ) {
					$approved_groups = $fta_settings['plugins']['facebook']['approved_groups'];
					$approved_groups = $approved_groups;
					$post_key        = array_search( $page_name, array_column( $approved_groups, 'id' ) );
					$page_name       = $approved_groups[ $post_key ]->name;
				}


				$key = str_replace( ' ', '', $key );

				?>

				<li class="collection-item <?php esc_attr_e( $key ); ?>">
					<div><?php esc_html_e( $page_name ); ?>
						<a href="javascript:void(0);"
						   data-efbl_trans="<?php esc_attr_e( $key ); ?>"
						   class="secondary-content efbl_del_trans"><span class="dashicons dashicons-trash right"></span></a>
					</div>
				</li>

			<?php } ?>
		</ul>
	<?php } ?>

</div>
