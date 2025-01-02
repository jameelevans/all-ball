<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package all-ball
 */

get_header();
?>
<div id="news">
	<main class="news-main">
		<?php if ( have_posts() ) : ?>
			

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				// Include the search result content template.
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			// Add custom pagination for posts.
			custom_posts_navigation();
			?>
		<?php else : ?>
			<header class="search-header">
				<h1 class="search-title"><?php esc_html_e( 'Nothing Found', 'all-ball' ); ?></h1>
			</header><!-- .search-header -->
			<div class="no-results">
				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'all-ball' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .no-results -->
		<?php endif; ?>
	</main><!-- #main -->

	<aside class="news-sidebar">
		<div class="news-sidebar-wrapper">
			<?php dynamic_sidebar('sidebar-1'); ?>
		</div>
	</aside>
</div>

<?php
get_footer();