<?php do_action( 'efbl_before_free_popup' ); ?>

<div id="efblcf_holder" class="white-popup efbl-feed-popup-holder">

			<div class="efbl_popup_wraper">

				<div class="efbl_popup_left_container">
				  <img src="" class="efbl_popup_image" />
				  <iframe src="" class="efbl_popup_if_video" ></iframe>
				  <video src="" class="efbl_popup_video" id="html_video" controls></video>
				</div>
				 <div class="efbl_popupp_footer">
				 </div>
				  <div class="efbl_popup_footer_logo" style="margin: 10px auto !important;border-radius: 10px !important;background-color: rgba(0, 0, 0, 0.35) !important;width: 225px !important;padding: 5px  8px !important;cursor: pointer !important;opacity: .6;-webkit-transition: all ease-in-out .5s;-moz-transition: all ease-in-out .5s;-o-transition: all ease-in-out .5s;transition: all ease-in-out .5s;text-align: center;position: absolute !important;display: block !important;visibility: visible !important;z-index: 99 !important;left: 50%;transform: translate(-50%, 0); -webkit-transform: translate(-50%, 0); -moz-transform: translate(-50%, 0); -o-transform: translate(-50%, 0);">
					<div data-class="efbl_redirect_home" style="display: block !important;visibility: visible !important;z-index: 99 !important;opacity: 1 !important;"><img style="float: left;width: 25px !important;height: auto !important;margin: 0 auto !important;display: block !important;visibility: visible !important;z-index: 99 !important;opacity: 1 !important;box-shadow: none !important;border-radius: 3px !important;" src="<?php echo esc_url( FTA_PLUGIN_URL ); ?>/admin/assets/images/plugin_icon.png" /><span style="font-size: 12px;color: #fff;float: left;margin-top: 4px;margin-left: 5px;display: block !important;visibility: visible !important;z-index: 99 !important;opacity: 1 !important;">Powered by Easy Social Feed</span></div>
				 </div>

			</div>
		</div>
<?php do_action( 'efbl_after_free_popup' ); ?>
