<?php
/**
 * * The template for displaying the front page
 *
 * @package your-wp-project
 */

get_header();

?>
	<main id="main-content">
		
		<!-- Trending News Section -->
		<section class="trending-news">
			<div class="container">
				<div class="section-title-area section-ttile-area2">
					<h2 class="section-title"><a href="<?php echo esc_url(site_url('/news/')); ?>">TRENDING NEWS <sup><?php echo svg_icon('section-title-icon', 'link');?></sup></a></h2>
				</div>
				<div class="grid">
					<?php
					// WP Query to fetch the latest 6 posts
					$trending_posts = new WP_Query( array(
						'posts_per_page' => 6, // Show only 6 posts
					) );

					if ( $trending_posts->have_posts() ) :
						// Get the total number of posts returned by this query
						$total_posts = $trending_posts->post_count;

						// Counter to track current post position
						$count = 0;

						// Loop through the retrieved posts
						while ( $trending_posts->have_posts() ) :
							$trending_posts->the_post();
							$count++; // Increment counter for each post
							?>
							
							<div class="post<?php
								// Only add 'first' and 'last' classes if there are more than 3 posts total
								if ( $total_posts > 3 ) {
									if ( $count === 1 ) {
										echo ' first';
									}
									// Since 'posts_per_page' is 6, if we actually get 6 posts, this will mark the 6th as 'last'
									if ( $count === 6 ) {
										echo ' last';
									}
								}
								?>">
								<!-- Featured Image -->
								<div class="post-image">
									<?php if ( has_post_thumbnail() ) : ?>
										<img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="<?php the_title_attribute(); ?>">
									<?php else : ?>
										<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/default-thumbnail.jpg' ); ?>" alt="Default Thumbnail">
									<?php endif; ?>
								</div>
								<!-- /Featured Image -->

								<!-- Overlay with content -->
								<div class="post-overlay">
									<div class="gradient"></div>
									<div class="post-content">
										<!-- Post Category -->
										<?php
										$categories = get_the_category();
										if ( ! empty( $categories ) ) :
											?>
											<span class="post-category"><?php echo esc_html( $categories[0]->name ); ?></span>
										<?php endif; ?>

										<!-- Post Date -->
										<span class="post-date"><?php echo get_the_date(); ?></span>

										<!-- Post Title -->
										<div class="post-title-wrapper">
											<a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
										</div>

										<!-- Read More Link -->
										<a href="<?php the_permalink(); ?>" class="post-link">Read More</a>
									</div>
								</div>
								<!-- /Overlay with content -->
							</div>
							<!-- /post -->
							
						<?php
						endwhile;
						// Reset global post data to avoid conflicts
						wp_reset_postdata();
					else :
						?>
						<p>No trending posts found!</p>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<section class="goat-section video-section-2">
			<div class="container">
				<div class="video-section-inner text-center">
					<h3 class="title">TRY THE NBA GOAT CALCULATOR</h3>
					<a href="<?php echo esc_url(site_url('/goat-calculator/')); ?>" class="btn">TRY IT HERE <?php echo svg_icon('btn-icon', 'arrow-right');?></a>
				</div>
			</div>
		</section>
	</main>
<?php get_footer(); ?>
