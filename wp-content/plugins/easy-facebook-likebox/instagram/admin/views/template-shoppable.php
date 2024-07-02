<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( $insta_settings['shoppable'] ) {
    $shoppable_set = $insta_settings['shoppable'];
} else {
    $shoppable_set = false;
}
$source = '';
$custom_url = '';
$cpt_id = '';
$selected = '';
$click_behaviour = '';
$link_text = '';
if ( $feed->media_url ) {
    ?>

	<div class="esf-insta-col-lg-4 esf-insta-col-12 esf-insta-shoppable-<?php 
    esc_attr_e( $story_id );
    ?>
	<?php 
    ?>
	"
>
		<div class="esf-insta-grid-wrapper esf-insta-story-wrapper">

			<a href="#esf-insta-shoppable-<?php 
    esc_attr_e( $story_id );
    ?>" class="esf_insta_feed_fancy_popup esf_insta_grid_box esf-modal-trigger"
				  style="background-image: url(<?php 
    echo esc_url( $thumbnail_url );
    ?>)">
					<div class="esf-insta-overlay">
                        <div class="ei-icon-wrap">
                            <?php 
    if ( $selected ) {
        ?>
                                <span class="dashicons dashicons-admin-links"></span>
                                <?php 
    } else {
        ?>
                            <span class="dashicons dashicons-plus"></span>
                            <?php 
    }
    ?>
                        </div>
					</div>
				</a>
		</div>
        <div id="esf-insta-shoppable-<?php 
    esc_attr_e( $story_id );
    ?>" class="esf-modal ei-modal fadeIn">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>
                        <span class="dashicons dashicons-products"></span>
		                <?php 
    esc_html_e( 'Shoppable Feed', 'easy-facebook-likebox' );
    ?>
                    </h5>
                    <span class="dashicons modal-close dashicons-no-alt"></span>
                </div>
                <div class="ei-content-wrap">
                    <div class="ei-shoppable-modal-left">
                        <img src="<?php 
    echo esc_url( $thumbnail_url );
    ?>" />
                    </div>
                    <div class="ei-shoppable-modal-right">
                        <form class="ei-shoppable-form" name="ei-shoppable-form">
                        <div class="ei-field-container">
                            <label> <?php 
    esc_html_e( 'Link Source', 'easy-facebook-likebox' );
    ?> </label>
                            <select <?php 
    if ( $is_free ) {
        ?> disabled <?php 
    }
    ?> class="ei-select-source ei-select2" name="source">
                                <option <?php 
    selected( $source, 'caption' );
    ?> value="caption"><?php 
    esc_html_e( 'Original link', 'easy-facebook-likebox' );
    ?></option>
                                <option <?php 
    selected( $source, 'custom' );
    ?> value="custom"><?php 
    esc_html_e( 'Custom URL', 'easy-facebook-likebox' );
    ?></option>
                                <?php 
    if ( $all_post_types ) {
        foreach ( $all_post_types as $key => $value ) {
            ?>
                                        <option <?php 
            selected( $source, $key );
            ?> value="<?php 
            echo esc_attr( $key );
            ?>"><?php 
            echo esc_html( ucfirst( $value ) );
            ?></option>
                                    <?php 
        }
    }
    ?>
                            </select>
                        </div>
                        <div class="ei-field-container ei-others-field ei-custom-url-wrap" <?php 
    if ( $source && $source == 'custom' ) {
        ?> style="display: flex" <?php 
    }
    ?>>
                            <label> <?php 
    esc_html_e( 'Custom URL', 'easy-facebook-likebox' );
    ?> </label>
                            <input <?php 
    if ( $is_free ) {
        ?> disabled <?php 
    }
    ?> type="url" value="<?php 
    echo esc_url( $custom_url );
    ?>" class="ei-custom-url" name="custom_url" />
                        </div>
                        <?php 
    if ( $all_post_types ) {
        foreach ( $all_post_types as $post_type ) {
            if ( $cpts[$post_type] ) {
                ?>
                                <div class="ei-field-container ei-others-field ei-search ei-search-<?php 
                echo esc_attr( $post_type );
                ?>" <?php 
                if ( $source && $source == $post_type ) {
                    ?> style="display: flex" <?php 
                }
                ?>
                                >
                                    <label> <?php 
                esc_html_e( 'Search for ', 'easy-facebook-likebox' );
                ?> <?php 
                echo esc_attr( $post_type );
                ?></label>
                                    <select <?php 
                if ( $is_free ) {
                    ?> disabled <?php 
                }
                ?> class="ei-select2" name="<?php 
                echo esc_attr( $post_type );
                ?>_id">
			                            <?php 
                foreach ( $cpts[$post_type] as $post ) {
                    ?>
                                            <option  <?php 
                    selected( $cpt_id, $post->ID );
                    ?> value="<?php 
                    echo esc_attr( $post->ID );
                    ?>"><?php 
                    echo esc_html( $post->post_title );
                    ?></option>
                                        <?php 
                }
                ?>
                                    </select>
                                </div>
                           <?php 
            }
        }
    }
    ?>
                            <div class="ei-field-container ei-btn-text-wrap">
                                <label> <?php 
    esc_html_e( 'Button/link text', 'easy-facebook-likebox' );
    ?> </label>
                                <input type="text" <?php 
    if ( $is_free ) {
        ?> disabled <?php 
    }
    ?> value="<?php 
    echo esc_attr( $link_text );
    ?>" class="ei-custom-url" name="link_text" />
                            </div>
                            <div class="ei-field-container">
                                <label> <?php 
    esc_html_e( 'Click behaviour', 'easy-facebook-likebox' );
    ?></label>
                                <select <?php 
    if ( $is_free ) {
        ?> disabled <?php 
    }
    ?> class="ei-select2" name="click_behaviour">
                                    <option value="0"><?php 
    echo esc_html_e( '--Select One--', 'easy-facebook-likebox' );
    ?> </option>
                                    <option  <?php 
    selected( $click_behaviour, 'popup' );
    ?> value="popup"><?php 
    echo esc_html_e( 'Popup', 'easy-facebook-likebox' );
    ?></option>
                                    <option  <?php 
    selected( $click_behaviour, 'direct_link' );
    ?> value="direct_link"><?php 
    echo esc_html_e( 'Direct Link', 'easy-facebook-likebox' );
    ?></option>
                                </select>
                            </div>
                            <input type="hidden" name="feed_id" value="<?php 
    echo esc_attr( $story_id );
    ?>">
                            <input type="submit" <?php 
    if ( $is_free ) {
        ?> disabled <?php 
    }
    ?> name="ei-shoppable-form" class="btn <?php 
    if ( $is_free ) {
        ?> disabled <?php 
    }
    ?>" value="<?php 
    esc_html_e( 'Save', 'easy-facebook-likebox' );
    ?>">
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="ei-pagination <?php 
    if ( $i == 0 ) {
        ?> disabled <?php 
    }
    ?> ei-pag-prev" data-type="prev">
                        <span class="dashicons dashicons-arrow-left-alt"></span><?php 
    esc_html_e( 'Previous post', 'easy-facebook-likebox' );
    ?>
                    </div>
                    <div class="ei-pagination ei-pag-next" data-type="next">
	                    <?php 
    esc_html_e( 'Next post', 'easy-facebook-likebox' );
    ?> <span class="dashicons dashicons-arrow-right-alt"></span>
                    </div>
                </div>
            </div>
        </div>
	</div>

<?php 
}