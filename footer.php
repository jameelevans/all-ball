<?php
/**
 * * The template for displaying the footer
 *
 * @package your-wp-project
 */

?>
    <!--Footer-->
    <footer class="footer footer1 footer3">
        <div class="container">
            <?php if ( is_front_page() ) : ?>
                <div class="footer-topbar">
                    <div class="footer-logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-sticky.png" alt="footer-logo">
                    </div>
                    <ul class="social-links">
                        <li>
                            <a target="_blank" href="https://www.youtube.com/@RealAllBallSports?sub_confirmation=1" class="platform">
                                <?php echo svg_icon('platform-icon', 'youtube');?>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="footer-inner">
               
                <div class="footer-widget">
                    <h3 class="footer-widget-title"><span class="decorator"></span> ABOUT US</h3>

                    <p class="footer-text">All Ball Sports is your ultimate destination for in-depth analysis, game highlights, player profiles, and the latest news across basketball, football, and baseball. Dive into the stories that shape the sports world and fuel the passion of fans everywhere.</p>
                    <div class="social-links">
                        <a target="_blank" href="https://www.youtube.com/@RealAllBallSports?sub_confirmation=1" class="platform"><?php echo svg_icon('platform-icon', 'youtube');?></a>
                    </div>
                </div>     
            
                <div class="footer-widget">
                    <h3 class="footer-widget-title"><span class="decorator"></span> ESSENTIAL LINKS</h3>
                    <ul class="widget-items cata-widget">
                        <li class="widget-list-item"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                        <li class="widget-list-item"><a href="<?php echo esc_url(site_url('/goat-calculator/')); ?>">Goat Calculator</a></li>
                        <li class="widget-list-item"><a href="<?php echo esc_url(site_url('/news/')); ?>">News</a></li>
                        <li class="widget-list-item"><a href="<?php echo esc_url(site_url('/about-us/')); ?>">About</a></li>
                        <li class="widget-list-item"><a href="<?php echo esc_url(site_url('/contact-us/')); ?>">Contact</a></li>
                    </ul>
                </div>
            
                <div class="footer-widget news-widget">
                    <h3 class="footer-widget-title">
                        <span class="decorator"></span> POST GALLERY
                    </h3>

                    <?php
                    // WP Query to fetch the latest 6 posts
                    $footer_gallery_posts = new WP_Query(array(
                        'posts_per_page' => 6, // Limit to 6 posts
                        'post_status' => 'publish', // Only published posts
                    ));

                    if ($footer_gallery_posts->have_posts()) :
                        $count = 0; // Counter to track rows
                        while ($footer_gallery_posts->have_posts()) : $footer_gallery_posts->the_post();
                            $count++;

                            // Open the 'recent-post' div for the first and fourth posts
                            if ($count === 1 || $count === 4) {
                                echo '<div class="recent-post' . ($count === 4 ? ' post2' : '') . '">';
                            }
                            ?>
                            <div class="picture">
                                <a href="<?php the_permalink(); ?>">
                                <img 
                                src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'small' ) ); ?>" 
                                alt="<?php the_title_attribute(); ?>"
                                >
                                </a>
                            </div>
                            <?php
                            // Close the 'recent-post' div after the third and sixth posts
                            if ($count === 3 || $count === 6) {
                                echo '</div>';
                            }
                        endwhile;
                        wp_reset_postdata(); // Reset query
                    else :
                        echo '<p>No recent posts available!</p>';
                    endif;
                    ?>
                </div>
              
            </div>
        </div>
        <div class="footer-bottom-area">
            <div class="container">
                <div class="bottom-area-inner">
                    <span class="copyright">
                        <?php 
                            // Fetch the site tagline from the WordPress customizer.
                            echo get_bloginfo( 'description' ); 
                        ?> 
                        <span class="brand">ALL BALL SPORTS</span>
                        <?php
                            // Dynamically output the current year.
                            echo date( 'Y' );
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </footer>
    <!-- -->
    <a class="scroll-top-btn" href="#top">
        <?php echo svg_icon('scroll-top-btn-icon', 'angle-up');?><?php echo svg_icon('scroll-top-btn-icon', 'circle-notch');?>
    </a>


    <?php wp_footer(); ?>
</body>
</html>
