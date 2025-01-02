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
       

        <!-- Article Content -->
        <article class="news-article">
          
            <!-- Content -->
            <section class="news-content">
                <?php
                
                the_content();
                ?>
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