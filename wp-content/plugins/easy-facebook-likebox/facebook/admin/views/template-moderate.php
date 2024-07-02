<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( empty( $feed_img ) ) {
    $feed_img = EFBL_PLUGIN_URL . 'frontend/assets/images/feed-placeholder-img.png';
    $is_placeholder = true;
} else {
    $is_placeholder = false;
}
if ( empty( $post_text ) && isset( $story->attachments->data['0']->title ) ) {
    $post_text = $story->attachments->data['0']->title;
}
if ( $feed_img ) {
    ?>

	<div class="efbl-col-lg-4 efbl-col-12 
	<?php 
    ?>
	" 
	<?php 
    ?>
>
		<div class="efbl-grid-wrapper efbl-story-wrapper">
			 <span class="efbl_feed_fancy_popup efbl-grid-box" style="background-image: url(<?php 
    echo esc_url( $feed_img );
    ?>)">
				<img style="display: none;" src="<?php 
    echo esc_url( $feed_img );
    ?>">
				<div class="efbl-overlay">
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
    if ( $is_placeholder ) {
        ?>
					   <div class="efbl-content-holder">
							<p><?php 
        echo wp_trim_words( $post_text, 10, '' );
        ?></p>
					   </div>
					<?php 
    }
    ?>
				</div>
			</span>
		</div>
	</div>

<?php 
}