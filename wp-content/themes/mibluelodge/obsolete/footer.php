	    <!-- footer -->
        <footer id="footer">
            <div class="container-fluid">
                <div class="row justify-content-center">
					<div class="col-lg-10 text-center">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/merritt-island-lodge-no-353-free-and-accepted-masons_logo.png" alt="Merritt Island Lodge No. 353 Free & Accepted Masons - Logo" style="width: 100px; height: auto;">
						<h2><?php echo get_bloginfo('name'); ?> 
						<br/><?php echo get_bloginfo('description'); ?></h2>
						<hr>
						<nav class="navbar navbar-expand-sm" id="navbar-footer">
							<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-footer" aria-controls="navbar-footer" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse justify-content-center" id="navbar-footer">
								<?php wp_nav_menu(['container' => false, 'menu_class' => 'navbar-nav mb-2 mb-lg-0', 'theme_location' => 'footer', 'walker' => new WP_Bootstrap_Navwalker()]); ?>
							</div>
						</nav>
					</div>
                </div>
            </div>
			
			<div class="container-fluid">
				<!-- copyright -->
				<div class="copyright">
					Copyright (©) <?php echo date('Y'); ?> <a href="<?php bloginfo('url'); ?>" target="_self">Merritt Island Lodge No. 353 F&AM</a>. All Rights Reserved. Site by <a href="https://benmiles.com/" target="_blank">Ben Miles</a>.
				</div>
				<!-- social media links -->
				<nav class="nav" id="nav-social-footer">
					<div class="social-media">
						<?php wp_nav_menu(['container' => false, 'menu_class' => 'nav mb-2 mb-lg-0', 'theme_location' => 'social', 'walker' => new WP_Bootstrap_Navwalker()]); ?>
					</div>
				</nav>
			</div>

        </footer>
        <!-- / footer -->

		<?php wp_footer(); ?>

    </body>
</html>
