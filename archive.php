<?php
/**
 * The template for displaying the Resources page
 *
 * @package your-wp-project
 */

get_header();
?>

<div id="news">
    <main class="news-main">
        <article class="news-feed-area">
            <?php
            // WordPress default loop
            if (have_posts()) :
                while (have_posts()) : the_post();
            ?>
                    <div class="blog-item feed-blog-item">
                        <!-- Post Thumbnail -->
                        <a href="<?php the_permalink(); ?>" class="blog-picture">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/default-image.jpg" alt="Default image">
                            <?php endif; ?>
                        </a>

                        <div class="contents">
                            <div class="flex-wrapper">
                                <!-- Post Category -->
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    echo '<span class="catagory-tag">' . esc_html($categories[0]->name) . '</span>';
                                }
                                ?>
                            </div>

                            <!-- Post Title -->
                            <a href="<?php the_permalink(); ?>" class="blog-title"><?php the_title(); ?></a>

                            <!-- Post Excerpt -->
                            <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                        </div>
                    </div>
            <?php
                endwhile;
            else :
                echo '<p>No posts found.</p>';
            endif;
            ?>
        </article>

        <!-- Pagination -->
        <div class="pagination">
            <?php
            // Pagination logic
            echo paginate_links([
                'total'        => $wp_query->max_num_pages, // Get the total number of pages
                'current'      => max(1, get_query_var('paged')), // Current page number
                'mid_size'     => 2, // Number of page links to show on each side
                'prev_text'    => __('&laquo;', 'all-ball'), // Previous button icon
                'next_text'    => __('&raquo;', 'all-ball'), // Next button icon
                'type'         => 'plain', // Outputs plain <a> tags
            ]);
            ?>
        </div>

    </main>

    <aside class="news-sidebar">
        <div class="news-sidebar-wrapper">
            <?php dynamic_sidebar('sidebar-1'); ?>
        </div>
    </aside>
</div>

<?php get_footer(); ?>