<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( $is_album_feed ) {
} else {
    //[ $efbl_feed_width, $efbl_feed_height, $type, $attr ] = getimagesize( $feed_img );
    $efbl_ver = 'free';
    if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
        $efbl_ver = 'pro';
    }
    $efbl_free_popup_type = 'data-imagelink="' . $feed_img . '"';
    $efbl_free_popup_class = null;
    if ( 'added_video' == $feed_type && !empty( $video_source ) ) {
        $efbl_free_popup_type = 'data-video="' . $video_source . '"';
        $efbl_free_popup_class = 'efbl_popup_video';
    }
    if ( $feed_img ) {
        ?>

        <div class="efbl-row-content">
            <div class="efbl-row-wrapper efbl-story-wrapper">
				<?php 
        if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'instagram_premium', true ) ) {
            ?>
                    <a class="efbl_feed_fancy_popup efbl-row-box" target="_blank"
                       href="<?php 
            echo esc_url( $story->permalink_url );
            ?>">
                        <img src="<?php 
            echo esc_url( $feed_img );
            ?>">
                        <div class="efbl-overlay">

							<?php 
            if ( $efbl_skin_values['design']['show_feed_open_popup_icon'] ) {
                ?>

                                <i class="icon icon-esf-plus efbl-plus"
                                   aria-hidden="true"></i>

								<?php 
            }
            ?>
							<?php 
            if ( $feed_type == 'added_video' || $feed_attachment_type == 'video_inline' ) {
                ?>
                                <i class="icon icon-esf-clone icon-esf-video-camera"
                                   aria-hidden="true"></i>
								<?php 
            }
            if ( isset( $story->attachments->data['0']->subattachments->data ) && !empty( $story->attachments->data['0']->subattachments->data ) ) {
                ?>
                                <i class="icon icon-esf-clone efbl_multimedia"
                                   aria-hidden="true"></i>
								<?php 
            }
            ?>
                        </div>

                    </a>
				<?php 
        } else {
            ?>
                    <span class="efbl_feed_fancy_popup efbl-row-box"
                          data-fancybox="efbl_feed_fancy_popup_<?php 
            esc_attr_e( $popup_id );
            ?>"
                          data-type="ajax"
                          data-src="<?php 
            esc_attr_e( $efbl_feed_popup_url );
            ?>"
                          href="javascript:;"
                          style="background-image: url(<?php 
            echo esc_url( $feed_img );
            ?>)">
                <img src="<?php 
            echo esc_url( $feed_img );
            ?>">
                <div class="efbl-overlay">


					<?php 
            if ( $efbl_skin_values['design']['show_feed_open_popup_icon'] ) {
                ?>

                        <i class="icon icon-esf-plus efbl-plus"
                           aria-hidden="true"></i>

						<?php 
            }
            ?>
	                <?php 
            if ( $feed_type == 'added_video' || $feed_attachment_type == 'video_inline' ) {
                ?>
                        <i class="icon icon-esf-clone icon-esf-video-camera"
                           aria-hidden="true"></i>
		                <?php 
            }
            if ( isset( $story->attachments->data['0']->subattachments->data ) && !empty( $story->attachments->data['0']->subattachments->data ) ) {
                ?>
                        <i class="icon icon-esf-clone efbl_multimedia"
                           aria-hidden="true"></i>
		                <?php 
            }
            ?>
                </div>

            </span>
				<?php 
        }
        ?>

            </div>
        </div>

		<?php 
    }
}