<div class="esf-insta-post-footer">

	<?php do_action( 'esf_insta_before_feed_meta', $feed ); ?>

	<div class="esf-insta-d-flex esf-insta-justify-content-between">
		<div class="esf-insta-reacted esf-insta-d-flex esf-insta-align-items-center">

			<?php if ( $feed->like_count && $feed->like_count > 0 && $mif_values['show_likes'] ) { ?>

				<div class="esf-insta-reacted-item emotis">

					<i class="icon icon-esf-heart"></i>

					<?php echo esf_insta_readable_count( $feed->like_count ); ?>

				</div>

			<?php } ?>

			<?php if ( $feed->comments_count && $feed->comments_count > 0 && $mif_values['show_comments'] ) { ?>

				<div class="esf-insta-reacted-item">

					<i class="icon icon-esf-comment-o"></i><?php echo esf_insta_readable_count( $feed->comments_count ); ?>

				</div>
			<?php } ?>

		</div>

		<div class="esf-insta-view-share esf-insta-d-flex esf-insta-justify-content-between esf-insta-align-items-center esf-insta-mb-1 esf-insta-mt-1">

			<?php if ( $mif_values['show_feed_view_on_instagram'] ) { ?>

				<a href="<?php echo esc_url( $permalink ); ?>"
				   target="<?php esc_attr_e( $link_target ); ?>"
				   class="esf-insta-view-on-fb no-anchor-style link esf-insta-mr-1">
					<?php echo esc_html( $link_text ); ?>
				</a>

				<?php
			}

			if ( $mif_values['show_feed_share_button'] ) {
				?>

				<div class="esf-share-wrapper">
					<a href="#" class="no-anchor-style link esf-share"><?php echo __( 'Share', 'easy-facebook-likebox' ); ?></a>
					<div class="esf-social-share">
						<button>
							<a class="esf_insta_facebook"
							   href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( $permalink ); ?>"
							   target="<?php esc_attr_e( $link_target ); ?>">
								<i class="icon icon-esf-facebook"></i>
							</a>
						</button>

						<button>
							<a class="esf_insta_twitter"
							   href="https://twitter.com/intent/tweet?text=<?php echo esc_url( $permalink ); ?>"
							   target="<?php esc_attr_e( $link_target ); ?>">
								<i class="icon icon-esf-twitter"></i>
							</a>
						</button>

						<button>
							<a class="esf_insta_linked_in"
							   href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( $permalink ); ?>"
							   target="<?php esc_attr_e( $link_target ); ?>">
								<i class="icon icon-esf-linkedin"></i>
							</a>
						</button>
					</div>
				</div>

			<?php } ?>

		</div>

	</div>

	<?php do_action( 'esf_insta_after_feed_meta', $feed ); ?>

</div>
