<?php
/**
 * * The template for displaying the front page
 *
 * @package your-wp-project
 */

get_header();

?>

	<div class="goat">
		<main id="goat-content">

			<section>
				<?php
				// Display content added through the block editor
				if (have_posts()) :
					while (have_posts()) : the_post();
						the_content();
					endwhile;
				endif;
				?>
			</section>

			<section id="goat-calculator-tool">

				<!-- Scoring Criteria Adjustment Form -->
				<div id="criteria-adjustments">
					<h2 class="wp-block-heading">Adjust Scoring Criteria</h2>
					<?php echo do_shortcode('[goat_calculator_controls]'); ?>
				</div>
				<!-- Display GOAT Rankings -->
				<h2 class="wp-block-heading">GOAT Rankings</h2>
				<div id="goat-rankings">
					
					<?php echo do_shortcode('[goat_rankings]'); ?>
				</div>
				<?php comments_template();?>
				
				
				
				
			</section>

			

			<script>
				document.addEventListener("DOMContentLoaded", function () {
					const form = document.getElementById("goat-calculator-form");
					const updateButton = document.getElementById("update-calculator");
					const rankingsContainer = document.getElementById("goat-rankings");

					updateButton.addEventListener("click", () => {
						const inputs = form.querySelectorAll("input[type='number']");
						let updatedCriteria = {};

						// Collect the updated criteria values
						inputs.forEach(input => {
							updatedCriteria[input.name] = parseFloat(input.value) || 0;
						});

						// Make an AJAX request to update rankings dynamically (placeholder for future development)
						console.log("Updated Criteria:", updatedCriteria);

						// Placeholder: Refresh the rankings dynamically
						// Example of server call logic to refresh data can go here
					});
				});
			</script>
		</main>

		<aside class="news-sidebar">
			<div class="news-sidebar-wrapper">
				<?php dynamic_sidebar('sidebar-1'); ?>
			</div>
		</aside>
	</div>
<?php get_footer(); ?>
