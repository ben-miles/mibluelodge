	    <!-- footer -->
        <footer id="footer">
            <div class="container">
                <div class="row">
					<div class="col-10">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/merritt-island-lodge-no-353-free-and-accepted-masons_logo.png" alt="Merritt Island Lodge No. 353 Free & Accepted Masons - Logo">
						<h2><?php echo get_bloginfo('name'); ?> 
						<br/><?php echo get_bloginfo('description'); ?></h2>
						<hr>
						<div>
							<?php wp_nav_menu(['container' => false, 'menu_class' => 'navbar-nav ms-auto mb-2 mb-lg-0', 'theme_location' => 'footer', 'walker' => new WP_Bootstrap_Navwalker()]); ?>
						</div>
					</div>
                </div>
            </div>

			<div class="container-fluid">
				<!-- copyright -->
				<div class="copyright">
					Copyright (©) <?php echo date('Y'); ?> <a href="<?php bloginfo('url'); ?>" target="_self">Merritt Island Lodge No. 353 F&AM</a>. All Rights Reserved. Site by <a href="https://benmiles.com/" target="_blank">Ben Miles</a>.
				</div>
				<!-- social media links -->
				<div class="social-media">
					<ul style="list-style:none;display:flex;flex-direction:row;">
						<li>
							<a href="https://www.facebook.com/MIBlueLodge353/" target="_blank">
								<?php echo displaySVG('facebook'); ?>
								<span>Facebook</span>
							</a>
						</li>
						<li>
							<a href="https://www.instagram.com/mibluelodge353/" target="_blank">
								<?php echo displaySVG('instagram'); ?>
								<span>Instagram</span>
							</a>
						</li>
						<li>
							<a href="https://twitter.com/mibluelodge353" target="_blank">
								<?php echo displaySVG('twitter-x'); ?>
								<span>Twitter/X</span>
							</a>
						</li>
						<li>
							<a href="https://www.youtube.com/@merrittislandlodgeno.353fa9" target="_blank">
								<?php echo displaySVG('youtube'); ?>
								<span>YouTube</span>
							</a>
						</li>
					</ul>
				</div>
			</div>

        </footer>
        <!-- / footer -->

		<?php wp_footer(); ?>

    </body>
</html>
