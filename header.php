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



	<body class="<?php echo is_front_page() ? 'front-page' : 'general'; ?>">
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
							<a href="https://www.youtube.com/@RealAllBallSports?sub_confirmation=1" class="subscribe-btn" target="_blank"><?php echo svg_icon('subscribe-icon', 'youtube');?> SUBSCRIBE</a>
							<a href="<?php echo esc_url(home_url('/')); ?>" class="<?php echo is_front_page() ? 'logo' : 'logo-general'; ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="Site Logo"></a>
							
							<a href="<?php echo esc_url(home_url('/')); ?>" class="logo2"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-sticky.png" alt="Site Logo"></a>
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
							<a href="<?php echo esc_url(home_url('/')); ?>" class="logo-sticky"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-sticky-2.png" alt="Site Logo"></a>
							<nav class="nav">
								<ul class="nav__menu">
									<li><a class="nav__item<?php if (is_front_page()) echo ' current-page'; ?>" href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
									<li><a class="nav__item<?php if (is_page('goat-calculator')) echo ' current-page'; ?>" href="<?php echo esc_url(site_url('/goat-calculator/')); ?>">GOAT Calculator</a></li>
									<li><a class="nav__item<?php if (is_home() || is_singular('post')) echo ' current-page'; ?>" href="<?php echo esc_url(site_url('/news/')); ?>">News</a></li>
									<li><a class="nav__item<?php if (is_page('about-us')) echo ' current-page'; ?>" href="<?php echo esc_url(site_url('/about-us')); ?>">About</a></li>
									<li><a class="nav__item<?php if (is_page('contact-us')) echo ' current-page'; ?>" href="<?php echo esc_url(site_url('/contact-us')); ?>">Contact</a></li>
								</ul>
							</nav>

							<div class="search-part">
								<form class="search-input-div" method="get" action="<?php echo esc_url(home_url('/')); ?>">
									<?php echo svg_icon('search-input-div-icon', 'search');?>
									<input
										type="text"
										name="s"
										placeholder="SEARCH HERE...."
										class="search-input"
									/>
								</form>
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
					<button class="slide-bar-close"><?php echo svg_icon('slide-bar-close-icon', 'times');?></button>
					<div class="offset-widget offset-logo mb-30">
						<a href="index.html">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-sticky.png" alt="logo">
						</a>
					</div>
				</div>
				<!-- side-mobile-menu start -->
				<nav class="side-mobile-menu">
					<ul id="mobile-menu-active" class="metismenu">
						<li class="firstlvl">
							<a class="mm-link<?php if (is_front_page()) echo ' current-page'; ?>" href="<?php echo esc_url(home_url('/')); ?>">Home</a>
						</li>
						
						<li class="firstlvl">
							<a class="mm-link<?php if (is_page('goat-calculator')) echo ' current-page'; ?>" href="<?php echo esc_url(site_url('/goat-calculator/')); ?>">GOAT Calculator</a>
						</li>
						<li class="firstlvl">
							<a class="mm-link<?php if (is_home() || is_singular('post')) echo ' current-page'; ?>" href="<?php echo esc_url(site_url('/news/')); ?>">News </a>
						</li>
						<li class="firstlvl">
							<a class="mm-link<?php if (is_page('about-us') ) echo ' current-page'; ?>" href="<?php echo esc_url(site_url('/about-us/')); ?>">About</a>
						</li>
						<li class="firstlvl">
							<a class="mm-link<?php if (is_page('contact-us') ) echo ' current-page'; ?>" href="<?php echo esc_url(site_url('/contact-us/')); ?>">Contact</a>
						</li>
					</ul>
				</nav>
				<!-- side-mobile-menu end -->
				<div class="side-bar-social-links">
					<a href="https://www.youtube.com/@RealAllBallSports?sub_confirmation=1" class="platform" target="_blank"><?php echo svg_icon('platform-icon', 'youtube');?></a>
				</div>
			</aside>
			<!-- Video Modal -->
			<div id="videoModal" class="video-modal" style="display: none;">
				<div class="video-modal-content">
					<button class="close-modal" onclick="closeVideo()">X</button>
					<div class="plyr__video-embed" id="player">
						<iframe
							id="player"
							src=""
							frameborder="0"
							allowfullscreen
							allow="autoplay; fullscreen">
						</iframe>
					</div>
				</div>
			</div>
			<?php if (!is_singular(['post', 'athletes'])): ?>
			<!-- Banner -->
			<section class="banner">
				<div class="banner__single">
				<?php 
					if (is_front_page()) :
						$home_id = get_option('page_on_front');
						$youtube_link = get_field('banner_youtube_link', $home_id);

						if ($youtube_link) : 
							$embed_link = str_replace('watch?v=', 'embed/', $youtube_link);
					?>
							<div class="video-section-inner text-center">
								<div class="play-video">
									<a class="popup-video" href="#" data-video="<?php echo esc_url($embed_link); ?>">
										<?php echo svg_icon('popup-video-icon', 'play'); ?>
									</a>
								</div>
							</div>
					<?php 
						endif;
					endif; 
					?>
					<div class="container">
						<div class="banner-content">
							<div class="flex-wrap d-flex">
								<?php if (is_front_page()) : ?>
									<span class="news-catagory-tag">
										<?php
										$banner_category = get_field('banner_category', $home_id);
										if ($banner_category) {
											echo esc_html($banner_category);
										} else {
											echo 'No banner category found';
										}
										?>
									</span>
								<?php elseif (is_category()) : ?>
									<span class="news-catagory-tag">
										<?php echo single_cat_title('', false); ?>
									</span>
								<?php endif; ?>
							</div>
							<?php
								if (is_front_page()) {
									echo '<h1 class="sr-only">' . esc_html(get_bloginfo('name')) . '</h1>';
									echo '<h2 class="banner-heading mw-600">';
									$banner_heading = get_field('banner_heading', $home_id);
									if ($banner_heading) {
										echo esc_html($banner_heading);
									} else {
										echo 'Welcome to All Ball Sports';
									}
									echo '</h2>';
								} else {
									echo '<h1 class="banner-heading">';
									if (is_home()) {
										echo get_the_title(get_option('page_for_posts'));
									} elseif (is_search()) {
										echo 'Search Results for: ' . esc_html(get_search_query());
									} elseif (is_category()) {
										echo single_cat_title('', false);
									} elseif (is_tag()) {
										echo 'Tag: ' . single_tag_title('', false);
									} elseif (is_singular()) {
										echo get_the_title();
									} else {
										echo 'Welcome to All Ball Sports';
									}
									echo '</h1>';
								}
							?>
							<?php if (is_front_page()) : ?>
								<div class="banner-btn-area">
									<?php
									$button_one = get_field('banner_red_cta', $home_id);
									$button_two = get_field('banner_white_learn_more', $home_id);
									if ($button_one && isset($button_one['url'], $button_one['title'])) : ?>
										<a href="<?php echo esc_url($button_one['url']); ?>" class="more-btn blog-details-btn one">
											<?php echo esc_html($button_one['title']); ?>
										</a>
									<?php endif; ?>
									<?php if ($button_two && isset($button_two['url'], $button_two['title'])) : ?>
										<a href="<?php echo esc_url($button_two['url']); ?>" class="more-btn blog-details-btn">
											<?php echo esc_html($button_two['title']); ?>
										</a>
									<?php endif; ?>
								</div>
							<?php else : ?>
								<!-- Breadcrumbs for other pages -->
								<?php custom_breadcrumbs(); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section><!-- .Banner -->
		<?php endif; ?>
		</header><!-- .Header -->