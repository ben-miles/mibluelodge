<?php

if ( !isset( $esf_insta_user_data->error ) && empty( $esf_insta_user_data->error ) ) {
    do_action( 'esf_insta_before_feed_header', $esf_insta_user_data );
    $stories = '';
    $stories_exists = false;
    $esf_insta_stories_popup_url = '';
    if ( $show_stories ) {
    }
    if ( $mif_instagram_type == 'personal' ) {
        $mif_self_name = $mif_instagram_personal_accounts[$user_id]['username'];
        $mif_self_username = $mif_self_name;
    } else {
        $mif_self_name = $esf_insta_user_data->name;
        $mif_self_username = $esf_insta_user_data->username;
    }
    $mif_self_name = apply_filters( 'esf_insta_feed_header_name', $mif_self_name, $esf_insta_user_data );
    if ( $hashtag && !empty( $hashtag ) ) {
        $mif_self_username = 'explore/tags/' . $hashtag;
        $mif_self_name = '#' . $hashtag;
    }
    ?>

	<div class="esf_insta_header">
		<div class="esf_insta_header_inner_wrap">

			<?php 
    if ( $profile_picture && $mif_values['show_dp'] && !$hashtag ) {
        ?>

				<div class="esf_insta_header_img 
				<?php 
        if ( $stories_exists ) {
            ?>
					 esf-insta-has-stories <?php 
        }
        ?>">

					<?php 
        if ( $stories_exists ) {
            ?>
						<a class="esf_insta_stories_popup" href="javascript;"
						   data-fancybox="esf_insta_stories_popup_<?php 
            echo esc_attr( $user_id );
            ?>"
						   title="@<?php 
            echo esc_attr( $mif_self_name );
            ?>"
						   data-type="ajax"
						   data-src="<?php 
            esc_attr_e( $esf_insta_stories_popup_url );
            ?>">
					<?php 
        } else {
            ?>
						<a href="<?php 
            echo esc_url( $this->instagram_url );
            ?>/<?php 
            esc_attr_e( $mif_self_username );
            ?>"
						   title="@<?php 
            echo esc_attr_e( $mif_self_name );
            ?>"
						   target="<?php 
            esc_attr_e( $link_target );
            ?>">
					<?php 
        }
        ?>

							<?php 
        ?>

						<?php 
        do_action( 'esf_insta_before_feed_header_image', $esf_insta_user_data );
        ?>

							<img src="<?php 
        echo esc_url( apply_filters( 'esf_insta_feed_header_image', $profile_picture, $esf_insta_user_data ) );
        ?>"/>

							<?php 
        if ( $hashtag && !empty( $hashtag ) ) {
            ?>

								<span class="esf-insta-hashtag-overlay"><i
											class="icon icon-esf-instagram"></i></span>

							<?php 
        }
        ?>

							<?php 
        do_action( 'esf_insta_after_feed_header_image', $esf_insta_user_data );
        ?>
					</a>
				</div>

				<?php 
    }
    ?>
			<div class="esf_insta_header_content">
				<div class="esf_insta_header_meta">

					<?php 
    if ( $mif_self_name ) {
        ?>

						<div class="esf_insta_header_title">

							<?php 
        do_action( 'esf_insta_before_feed_header_title', $esf_insta_user_data );
        ?>

							<h4>
								<a href="<?php 
        echo esc_url( $this->instagram_url );
        ?>/<?php 
        esc_attr_e( $mif_self_username );
        ?>"
								   title="@<?php 
        esc_attr_e( $mif_self_username );
        ?>"
								   target="<?php 
        esc_attr_e( $link_target );
        ?>">
									<?php 
        esc_html_e( $mif_self_name );
        ?>
								</a>
							</h4>

							<?php 
        do_action( 'esf_insta_after_feed_header_title', $esf_insta_user_data );
        ?>

						</div>

					<?php 
    }
    ?>

					<?php 
    if ( $mif_instagram_type !== 'personal' && isset( $esf_insta_user_data->followers_count ) && $esf_insta_user_data->followers_count > 0 && !$hashtag ) {
        if ( $mif_values['show_no_of_followers'] ) {
            ?>

							<div class="esf_insta_followers"
								 title="<?php 
            echo __( 'Followers', 'easy-facebook-likebox' );
            ?>">

								<?php 
            do_action( 'esf_insta_before_feed_header_followers', $esf_insta_user_data );
            ?>

								<i class="icon icon-esf-user"
								   aria-hidden="true"></i><?php 
            echo esf_insta_readable_count( apply_filters( 'esf_insta_feed_header_followers', $esf_insta_user_data->followers_count, $esf_insta_user_data ) );
            ?>

								<?php 
            do_action( 'esf_insta_after_feed_header_followers', $esf_insta_user_data );
            ?>
							</div>

							<?php 
        }
    }
    ?>


				</div>
				<?php 
    if ( $mif_instagram_type !== 'personal' && isset( $esf_insta_user_data->biography ) && !$hashtag ) {
        if ( $mif_values['show_bio'] ) {
            do_action( 'esf_insta_before_feed_header_bio', $esf_insta_user_data );
            ?>

						<p class="esf_insta_bio"><?php 
            echo sanitize_text_field( apply_filters( 'esf_insta_feed_header_bio', $esf_insta_user_data->biography, $esf_insta_user_data ) );
            ?></p>

						<?php 
            do_action( 'esf_insta_after_feed_header_bio', $esf_insta_user_data );
        }
    }
    ?>
			</div>
		</div>
	</div>

	<?php 
    do_action( 'esf_insta_after_feed_header', $esf_insta_user_data );
}