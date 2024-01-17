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
    <link rel="icon" href="/wp-content/themes/benmiles-wp/img/ben-miles_favicon.png">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="<?php echo $args['bodyClass']; ?>">
	
<header id="site-header">
	<div class="container">

		<!-- Branding -->
		<?php if(is_front_page()){ ?>
		<a class="brand" href="#intro" target="_self">
		<?php } else {; ?>
		<a class="brand" href="<?php bloginfo('url'); ?>" target="_self">
		<?php } ?>
			<?php echo displaySVG('ben-miles_logo'); ?>
			<h1 class="site-title"><?php bloginfo('name'); ?></h1>
			<h2 class="site-description"><?php bloginfo('description'); ?></h2>
		</a>

		<!-- Mobile Menu Toggle -->
		<button id="nav-toggle" type="button" aria-expanded="false" aria-label="Toggle Navigation">
			<?php echo displaySVG('menu'); ?>
		</button>
			
		<!-- Navigation -->
		<nav id="nav">
			<ul>
			<?php if(is_front_page()){ ?>
				<li class="nav-item">
					<a class="nav-link" href="#about" target="_self">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#portfolio" target="_self">Portfolio</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#contact" target="_self">Contact</a>
				</li>
			<?php } else {; ?>
				<li class="nav-item">
					<a class="nav-link" href="/about" target="_self">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/portfolio" target="_self">Portfolio</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/contact" target="_self">Contact</a>
				</li>
			<?php } ?>
			</ul>
		</nav>
		
	</div>
</header>