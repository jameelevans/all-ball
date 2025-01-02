<?php
/**
 * * The template for displaying the Resources page
 *
 * @package your-wp-project
 */

 get_header();

?>
	<div id="news">
		<main class="news-main">
			<article class="news-feed-area">
			
        <div class="error-area">
          <div class="container">
              <div class="section-inner">
                  <div class="page-title">
                      <span class="text">4</span>
                      <span class="text zero">0</span>
                      <span class="text">4</span>
                  </div>
                  <div class="title">
                      <h2 class="sub-title">Opps! Page not found</h2>
                      <h3 class="sect-title">Sorry, we couldn't find the page you where looking for. We suggest that <br> you return to homepage.</h3>
                  </div>
                  <div class="section-button">
                      <a class="btn" href="<?php echo esc_url(home_url('/')); ?>"><i class="fal fa-long-arrow-left"></i> Go To Homepage</a>
                  </div>
              </div>
          </div>
      </div>
				
			</article>
		</main>

		<aside class="news-sidebar">
			<div class="news-sidebar-wrapper">
				<?php dynamic_sidebar('sidebar-1'); ?>
			</div>
		</aside>
	</div>
<?php get_footer(); ?>
