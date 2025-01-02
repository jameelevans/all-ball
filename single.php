<?php
/**
 * The template for displaying single pages
 *
 * @package all-ball
 */

get_header();
?>
<section id="news">
    <main class="news-main news-single">
        <!-- Breadcrumbs -->
        <nav aria-label="Breadcrumbs">
            <?php custom_breadcrumbs(); ?>
        </nav>

        <!-- Article Content -->
        <article class="news-article">
            <!-- Header Section -->
            <header class="news-header-wrapper">
                <?php
                    // Check if the current post type is 'athletes'
                    if (get_post_type() === 'athletes') {
                        echo '<h1 class="news-header">Who is ' . esc_html(get_the_title()) . '?</h1>';
                    } else {
                        echo '<h1 class="news-header">' . esc_html(get_the_title()) . '</h1>';
                    }
                ?>
            </header>

            <!-- Excerpt -->
            <?php if (has_excerpt()) : ?>
                <p class="news-excerpt">
                    <?php echo esc_html(get_the_excerpt()); ?>
                </p>
            <?php endif; ?>

            <p class="news-reading-time"><?php echo get_reading_time(); ?></p>

            <!-- Metadata -->
            <div class="news-details">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="news-metadata">
                       
                        <?php echo display_news_top_section();?>
                        
                        
                    </div>
                <?php endwhile; endif; ?>
            </div>

            <!-- Featured Image -->
            <?php if (has_post_thumbnail()) : ?>
                <?php
                $alt_text = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); // Fetch the alt text
                ?>
                <figure class="post-thumbnail">
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr($alt_text); ?>">
                </figure>
            <?php endif; ?>
            <div class="news-share">
                <span>Share Our Story</span>    
                <?php echo do_shortcode('[social_share]'); ?>
            </div>
            <!-- Content -->
            <section class="news-content">
                <?php
                
                the_content();
                ?>
            </section>

            <!-- Related Tags and Social Share -->
            <section class="news-tags-share">
                <?php echo display_related_tags_and_social_share(); ?>
            </section>

            <!-- Pagination -->
            <nav class="news-pagination" aria-label="Post Navigation">
                <?php custom_posts_navigation(); ?>
            </nav>

            <!-- Comments Section -->
            <section class="news-comments" aria-label="Comments">
                <?php comments_template(); ?>
            </section>
        </article>
    </main>

    <!-- Sidebar -->
    <aside class="news-sidebar">
        <div class="news-sidebar-wrapper">
            <?php dynamic_sidebar('sidebar-1'); ?>
        </div>
    </aside>
</section>

<?php
get_footer();