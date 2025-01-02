<?php
/**
 * * The template for displaying the header
 *
 * @package your-wp-project
 */
?>
	<!doctype html>
	<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>



	<body class="front-page">
		<a class="screen-reader-shortcut" href="#main-content" tabindex="1">Skip to main content</a>
		<!-- Menu Background -->
		<div class="anywere anywere-home"></div><!-- .Menu Background -->
		<!-- Header -->
		<header id="top" class="home-header"  role="banner">
			<!-- Navigation -->
			<div class="navbar">
				<div class="navbar-part">
					<div class="container">
						<div class="navbar__top">
							<a href="#" class="subscribe-btn"><i class="fab fa-youtube"></i> SUBSCRIBE</a>
							<a href="#" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="Site Logo"></a>
							
							<a href="#" class="logo2"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-sticky.png" alt="Site Logo"></a>
							<div class="flex-wrapper navbar-item">
								<a href="#" class="hamburger-menu item">
									<div class="hamburger-menu-inner">
										<span></span>
										<span class=""></span>
										<span></span>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			
				<div class="container">
					<div class="navbar__bottom">
						<div class="navbar__inner">
							<a href="#" class="logo-sticky"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-sticky-2.png" alt="Site Logo"></a>
							<nav class="nav">
								<ul class="nav__menu">
									<li><a class="nav__item" href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
									<li><a class="nav__item" href="">About</a></li>
									<li><a class="nav__item" href="<?php echo esc_url(site_url('/goat-calculator/')); ?>">GOAT Calculator</a></li>
									<li><a class="nav__item" href="">News</a></li>
								</ul>
							</nav>

							<div class="search-part">
								<div class="search-input-div"><i class="fal fa-search"></i> <input type="text" placeholder="SEARCH HERE...." class="search-input"></div>
							</div>

							<a class="hamburger-menu item" href="javascript:void(0);">
								<div class="hamburger-menu-inner">
									<span></span>
									<span class=""></span>
									<span></span>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div><!-- .Navigation -->
			<!-- Slide Menu -->
			<aside class="slide-bar">
				<div class="offset-sidebar">
					<button class="slide-bar-close ml--30"><i class="fal fa-times"></i></button>
					<div class="offset-widget offset-logo mb-30">
						<a href="index.html">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-sticky.png" alt="logo">
						</a>
					</div>
				</div>
				<!-- side-mobile-menu start -->
				<nav class="side-mobile-menu side-mobile-menu1">
					<ul id="mobile-menu-active" class="metismenu">
						<li class="has-dropdown firstlvl">
							<a class="mm-link" href="index.html">Home</a>
						</li>
						<li><a class="mm-link" href="about.html">About</a></li>
						<li class="has-dropdown firstlvl">
							<a class="mm-link" href="index.html">GOAT Calculator</a>
						</li>
						<li class="has-dropdown firstlvl">
							<a class="mm-link" href="news-details.html">News </a>
						</li>
					</ul>
				</nav>
				<!-- side-mobile-menu end -->
				<div class="side-bar-social-links">
					<a href="#0" class="platform"><i class="fab fa-youtube"></i></a>
				</div>
			</aside>
			<!-- Banner -->
			<section class="banner">
				<div class="banner__single">
					<div class="video-section-inner text-center">
						<div class="play-video">
							<a class="popup-video" href="https://www.youtube.com/watch?v=G4t6TqG5LM8"><i class="fas fa-play"></i></a>
						</div>
					</div>
					<div class="container">
						<div class="banner-content">
							<div class="flex-wrap d-flex">
								<span class="news-catagory-tag">BASKETBALLL</span>
							</div>
							<h1 class="banner-heading">The World Cup 2023
								What to Expect ourfrom france</h1>
		
							<div class="banner-btn-area">
								<a href="blog-details.html" class="more-btn blog-details-btn one">WATCH HIGHLIGHTS</a>
								<a href="blog-details.html" class="more-btn blog-details-btn">LEARN MORE</a>
							</div>
						</div>
					</div>
				</div>
            
			</section><!-- .Banner -->
		</header><!-- .Header -->