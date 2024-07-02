<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( $feed->media_url ) {
    ?>

	<div class="esf-insta-col-lg-4 esf-insta-col-12 esf-insta-load-opacity">
		<div class="esf-insta-grid-wrapper esf-insta-story-wrapper">

			<?php 
    if ( !efl_fs()->is_plan( 'instagram_premium', true ) && !efl_fs()->is_plan( 'combo_premium', true ) ) {
        ?>

				<a class="esf_insta_feed_fancy_popup esf-lazyload esf_insta_grid_box"
				   href="<?php 
        echo esc_url( $permalink );
        ?>"
				   target="<?php 
        esc_attr_e( $link_target );
        ?>"
                   data-imgsrc="<?php 
        echo esc_url( $thumbnail_url );
        ?>"
				   style="background-image: url(<?php 
        echo esc_url( $thumbnail_url );
        ?>)">

					<div class="esf-insta-overlay">

						<?php 
        if ( $mif_values['show_feed_open_popup_icon'] ) {
            ?>

							<i class="icon icon-esf-plus esf-insta-plus"
							   aria-hidden="true"></i>

						<?php 
        }
        ?>

						<?php 
        if ( $feed->media_type == 'VIDEO' ) {
            ?>
							<i class="icon icon-esf-clone icon-esf-video-camera"
							   aria-hidden="true"></i>
							<?php 
        }
        if ( $feed->media_type == 'CAROUSEL_ALBUM' ) {
            ?>
							<i class="icon icon-esf-clone esf-insta-multimedia"
							   aria-hidden="true"></i>
						<?php 
        }
        ?>
					</div>
				</a>
			<?php 
    }
    ?>
		</div>
	</div>

<?php 
}