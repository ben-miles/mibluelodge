<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php wp_head(); ?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php is_front_page() ? bloginfo('description') . ' - ' . bloginfo('name') : wp_title(' - ',TRUE,'right') . bloginfo('name'); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Web Design & Development Portfolio of Ben Miles">
    <meta name="author" content="Ben Miles">
    <link rel="icon" href="/wp-content/themes/mibluelodge/img/ben-miles_favicon.png">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="<?php echo $args['bodyClass']; ?>">
	
<header id="site-header">
	<nav class="navbar navbar-expand-lg bg-body-tertiary" id="nav">
		<div class="container-fluid">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/merritt-island-lodge-no-353-free-and-accepted-masons_logo.png" alt="Merritt Island Lodge No. 353 Free & Accepted Masons - Logo" class="d-inline-block align-text-top">
				Merritt Island Lodge No. 353
				<span>Free & Accepted Masons</span>
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<?php wp_nav_menu(['container' => false, 'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0', 'walker' => new WP_Bootstrap_Navwalker()]); ?>
				<a class="navbar-brand d-flex align-items-center" href="<?php echo home_url(); ?>">
			</div>
		</div>
	</nav>
</header>