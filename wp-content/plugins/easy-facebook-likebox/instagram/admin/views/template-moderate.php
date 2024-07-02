<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( $feed->media_url ) {
    ?>

	<div class="esf-insta-col-lg-4 esf-insta-col-12 
	<?php 
    ?>
	" 
	<?php 
    ?>
>
		<div class="esf-insta-grid-wrapper esf-insta-story-wrapper">

			<span class="esf_insta_feed_fancy_popup esf_insta_grid_box"
				  style="background-image: url(<?php 
    echo esc_url( $thumbnail_url );
    ?>)">
				<img style="display: none;" src="<?php 
    echo esc_url( $thumbnail_url );
    ?>">

					<div class="esf-insta-overlay">
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
				</span>
		</div>
	</div>

<?php 
}