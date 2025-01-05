<?php
/**
 * Custom Functions
 *
 * Overview:
 * 1. Enqueues styles and scripts, including Font Awesome
 * 2. Asynchronously loads scripts for speed optimization
 * 3. Adds custom logo support
 * 4. Enables custom-sized post thumbnails
 * 5. Adds custom styles and links to the login screen
 * 6. Adds footer text setting to the WordPress Customizer
 * 7. Inline SVG icon support
 * 8. GOAT Calculator functionality
 * 9. Breadcrumbs functionality
 */

// * --------| Actions and Filters |-------- *
add_action('wp_enqueue_scripts', 'allball_enqueue_assets');
add_action('after_setup_theme', 'allball_theme_setup');
add_action('login_enqueue_scripts', 'allball_login_css');
add_filter('login_headerurl', 'allball_header_url');
add_filter('login_headertitle', 'allball_login_title');
add_filter('clean_url', 'allball_async_scripts', 11, 1);
add_action('customize_register', 'allball_customize_register');


// * --------| Functions |-------- *

/**
 * 1. Enqueue Styles and Scripts
 */
function allball_enqueue_assets() {
    wp_enqueue_script('allball-bundled-js', get_template_directory_uri() . '/assets/js/scripts-bundled.js#asyncload', array(), '1.0.0', true);
    wp_enqueue_style('allball-main-styles', get_stylesheet_uri());
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/fonts/all.min.css', array(), null);
}

function enqueue_plyr_assets() {
    // Enqueue Plyr.js CSS
    wp_enqueue_style('plyr-css', 'https://cdn.plyr.io/3.7.8/plyr.css', [], null);

    // Enqueue Plyr.js JavaScript
    wp_enqueue_script('plyr-js', 'https://cdn.plyr.io/3.7.8/plyr.polyfilled.js', [], null, true);

    // Add custom JavaScript to handle the Plyr.js modal behavior
    wp_enqueue_script('custom-plyr-js', get_template_directory_uri() . '/assets/js/custom-plyr.js', ['plyr-js'], null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_plyr_assets');

/**
 * 2. Asynchronously Load Scripts
 */
function allball_async_scripts($url) {
    if (strpos($url, '#asyncload') === false) return $url;
    return is_admin() ? str_replace('#asyncload', '', $url) : str_replace('#asyncload', '', $url) . "' async='async";
}

/**
 * 3. Theme Setup (Custom Logo and Thumbnails)
 */
function allball_theme_setup() {
    // Support for custom logo
    add_theme_support('custom-logo', array(
        'height' => 38, 
        'width' => 38, 
        'flex-height' => true, 
        'flex-width' => true,
        'header-text' => array('All Ball', 'Sports News')
    ));

    // Support for post thumbnails
    add_theme_support('post-thumbnails');

    // Define custom image sizes with cropping enabled
    $sizes = array(
        'my-thumbnail' => [320, 180, true],   // Thumbnail (smallest, e.g., for grids or cards, cropped)
        'x-small' => [480, 270, true],       // Extra Small (cropped)
        'small' => [640, 360, true],         // Small size (cropped)
        'medium' => [1280, 720, true],       // Medium size (cropped)
        'large' => [1920, 1080, true]       // Large size (cropped)
    );

    // Register each size
    foreach ($sizes as $name => $dim) {
        add_image_size($name, $dim[0], $dim[1], $dim[2]); // Pass width, height, and crop settings
    }
}
add_action('after_setup_theme', 'allball_theme_setup');

/**
 * 4. Login Screen Customizations
 */
function allball_login_css() {
    wp_enqueue_style('allball-main-styles', get_stylesheet_uri());
}
function allball_header_url() {
    return esc_url(site_url('/'));
}
function allball_login_title() {
    return get_bloginfo('name');
}

/**
 * 5. Footer Text Customization in Customizer
 */
function allball_customize_register($wp_customize) {
    $wp_customize->add_section('allball_footer_section', array(
        'title' => __('Footer Settings', 'allball'), 
        'priority' => 200,
        'description' => 'Customize the footer text',
    ));
    $wp_customize->add_setting('allball_footer_text', array(
        'default' => '', 
        'sanitize_callback' => 'wp_kses_post', 
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('allball_footer_text_control', array(
        'label' => __('Footer Text', 'allball'), 
        'section' => 'allball_footer_section',
        'settings' => 'allball_footer_text', 
        'type' => 'textarea',
    ));
}

/**
 * Inline SVG Icon Support
 *
 * @param string $class Additional CSS classes for the <svg> element.
 * @param string $icon The name of the icon in the sprite file.
 * @return string The SVG icon HTML.
 */
function svg_icon($class, $icon) {
    $sprite_path = get_stylesheet_directory_uri() . '/assets/img/sprites.svg';
    
    // Ensure the 'icon' class is always included
    $all_classes = trim('icon ' . $class);

    return '<svg class="' . esc_attr($all_classes) . '" aria-hidden="true">
                <use xlink:href="' . esc_url($sprite_path . '#icon-' . esc_attr($icon)) . '"></use>
            </svg>';
}

/**
 * 7. Create Athletes Custom Post Type
 */
function create_athletes_post_type() {
    register_post_type('athletes', array(
        'labels' => array(
            'name'               => 'Athletes',
            'singular_name'      => 'Athlete',
            'menu_name'          => 'Athletes',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Athlete',
            'edit_item'          => 'Edit Athlete',
            'new_item'           => 'New Athlete',
            'view_item'          => 'View Athlete',
            'search_items'       => 'Search Athletes',
            'not_found'          => 'No athletes found',
            'not_found_in_trash' => 'No athletes found in Trash',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-awards', // Retain your current icon
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'comments', 'excerpt', 'revisions'),
        'taxonomies' => array('category', 'post_tag'), // Add category support for NBA and NBA GOATs
        'has_archive' => true, // Enable archive page
        'rewrite' => array('slug' => 'athletes'), // Custom URL slug
        'show_in_rest' => true, // Enable Gutenberg editor and REST API
    ));
}
add_action('init', 'create_athletes_post_type');




/**
 * 9. Breadcrumbs Functionality
 */
function custom_breadcrumbs() {
    // Don't display breadcrumbs on tag or search pages
    if (is_front_page() || is_tag() || is_search()) {
        return; // Exit the function
    }

    $separator = ' | '; // Separator with a space before and after the pipe
    echo '<nav class="breadcrumbs">';
    echo '<a href="' . esc_url(home_url('/')) . '">All Ball</a>'; // Home link

    if (is_home()) {
        // Blog posts index page (e.g., News page)
        echo $separator . '<span>' . esc_html(get_the_title(get_option('page_for_posts'))) . '</span>';
    } elseif (is_page()) {
        // Static pages
        global $post;
        if ($post->post_parent) {
            $parent_title = get_the_title($post->post_parent);
            $parent_link = get_permalink($post->post_parent);
            echo $separator . '<a href="' . esc_url($parent_link) . '">' . esc_html($parent_title) . '</a>';
        }
        if (!is_single()) {
            echo $separator . '<span>' . esc_html(get_the_title()) . '</span>';
        }
    } elseif (is_category()) {
        // Category archives
        echo $separator . '<span>' . esc_html(single_cat_title('', false)) . '</span>';
    } elseif (is_archive()) {
        // Custom post type or other archives
        $post_type = get_post_type();
        if ($post_type === 'athletes') {
            echo $separator . '<span>Athletes</span>'; // Add "Athletes" breadcrumb for athletes archive
        } else {
            echo $separator . '<span>' . post_type_archive_title('', false) . '</span>'; // Generic archive title
        }
    } elseif (is_single()) {
        // Single post or custom post type
        $post_type = get_post_type();
        if ($post_type === 'post') {
            // Standard post breadcrumbs
            $categories = get_the_category();
            if (!empty($categories)) {
                echo $separator . '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
            }
        } elseif ($post_type === 'athletes') {
            // Custom post type 'athletes' breadcrumbs
            echo $separator . '<a href="' . esc_url(get_post_type_archive_link('athletes')) . '">Athletes</a>';
            echo $separator . '<span>' . esc_html(get_the_title()) . '</span>';
        }
    }

    echo '</nav>';
}

/**
 * GOAT Calculator Functions
 */

// Display GOAT Calculator Controls (Shortcode)
if (!function_exists('display_goat_calculator_controls')) {
    function display_goat_calculator_controls() {
        // Default scoring criteria
        $default_criteria = [
            'nba_championships' => 4,
            'finals_mvp_awards' => 4,
            'mvp_awards' => 4,
            'nba_cup_championships' => 2,
            'nba_cup_finals_mvp' => 2,
            'defensive_poy_awards' => 1,
            'rookie_of_the_year' => 1, 
            'all_nba_first_team' => 1,
            'all_nba_second_team' => 0.5,
            'all_nba_third_team' => 0.25,
            'all_star_appearances' => 0.25,
            'all_defensive_first_team' => 0.5,
            'all_defensive_second_team' => 0.25,
            'most_improved_player' => 0.25, 
            'sixth_man_of_the_year' => 0.25, 
            'finals_appearances' => 0.25,
            'career_points' => 0.01,
            'career_rebounds' => 0.02,
            'career_assists' => 0.03,
            'career_steals' => 0.05,
            'career_blocks' => 0.05,
            'per' => 0.1,
            'win_shares' => 0.05,
            'vorp' => 0.1,
        ];

        //echo '<h2>Customize Scoring Criteria</h2>';
        echo '<form id="goat-calculator-form">';
        

        foreach ($default_criteria as $key => $value) {
            $label = ucwords(str_replace('_', ' ', $key));
            echo '<div class="criteria-control">';
            echo '<label for="' . esc_attr($key) . '">' . esc_html($label) . ' Weight Points</label>';
            echo '<input type="number" id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '" step="0.01">';
            echo '</div>';
        }

        echo '</form>';
    }
    add_shortcode('goat_calculator_controls', 'display_goat_calculator_controls');
}

// Helper Function: Render GOAT Rankings
if (!function_exists('render_goat_rankings')) {
    function render_goat_rankings($players, $criteria) {
        $output = '<ol class="player-rankings">';

        foreach ($players as $index => $player) {
            $player_id = $player->ID;
            $player_name = get_the_title($player_id);
            $player_link = get_permalink($player_id);
            $featured_image = get_the_post_thumbnail_url($player_id, 'medium');
            $featured_image_alt = get_post_meta(get_post_thumbnail_id($player_id), '_wp_attachment_image_alt', true);

            $score = calculate_goat_score($player_id, $criteria);

            // Accolades and statistics to display (prioritized order)
            $accolades_to_display = [
                'nba_championships' => 'NBA Championships',
                'nba_cup_championships' => 'NBA Cup Championships',
                'mvp_awards' => 'MVP Awards',
                'finals_mvp_awards' => 'Finals MVP Awards',
                'nba_cup_finals_mvp' => 'NBA Cup Finals MVP',
                'rookie_of_the_year' => 'Rookie of the Year',
                'defensive_poy_awards' => 'Defensive Player of the Year',
                'all_nba_first_team' => 'All-NBA First Team',
                'all_nba_second_team' => 'All-NBA Second Team',
                'all_nba_third_team' => 'All-NBA Third Team',
                'all_defensive_first_team' => 'All-Defensive First Team',
                'all_defensive_second_team' => 'All-Defensive Second Team',
                'most_improved_player' => 'Most Improved Player',
                'sixth_man_of_the_year' => 'Sixth Man of the Year',
                'all_star_mvp' => 'All-Star MVP Awards',
                'all_star_appearances' => 'All-Star Appearances',
                'finals_appearances' => 'Finals Appearances',
                'career_points' => 'Career Points',
                'career_rebounds' => 'Career Rebounds',
                'career_assists' => 'Career Assists',
                'career_steals' => 'Career Steals',
                'career_blocks' => 'Career Blocks',
                'player_efficiency_rating' => 'PER',
                'win_shares' => 'Win Shares',
                'value_over_replacement_player' => 'VORP',
            ];

            // Filter out accolades with a value of 0 or not set
            $accolades = [];
            foreach ($accolades_to_display as $key => $label) {
                $value = get_field($key, $player_id);
                if ($value > 0) {
                    $accolades[] = '<li>' . esc_html($label) . ': ' . esc_html($value) . '</li>';
                }
            }

            // Player HTML structure
            $output .= '<li class="player">';
            $output .= '<div class="player-image">';
            if ($featured_image) {
                $output .= '<img src="' . esc_url($featured_image) . '" alt="' . esc_attr($featured_image_alt ?: $player_name) . '">';
            } else {
                $output .= '<img src="' . esc_url(get_template_directory_uri() . '/assets/img/default-player.png') . '" alt="' . esc_attr($player_name) . '">';
            }
            $output .= '</div>';
            $output .= '<div class="player-overlay">';
            $output .= '<div class="gradient"></div>';
            $output .= '<div class="player-content">';
            $output .= '<div class="player-details">';
            $output .= '<a href="' . esc_url($player_link) . '" title="Learn more about ' . esc_attr($player_name) . '" class="player-name">' . esc_html($player_name) . ' <sup>' . svg_icon('player-name-icon', 'link') . '</sup></a>';
            $output .= '<span class="player-score"> GOAT Score ' . esc_html($score) . '</span>';
            $output .= '</div>';
            $output .= '<ul class="player-accolades">' . implode('', $accolades) . '</ul>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</li>';
        }

        $output .= '</ol>';
        return $output;
    }
}

// GOAT Score Calculation
if (!function_exists('calculate_goat_score')) {
    function calculate_goat_score($player_id, $criteria = []) {
        $default_criteria = [
            'mvp_awards' => 4,
            'finals_mvp_awards' => 5,
            'all_nba_first_team' => 1,
            'all_nba_second_team' => 0.5,
            'all_nba_third_team' => 0.25,
            'all_star_appearances' => 0.25,
            'defensive_poy_awards' => 3,
            'all_defensive_first_team' => 0.5,
            'all_defensive_second_team' => 0.25,
            'nba_championships' => 5,
            'nba_cup_championships' => 2.5,
            'finals_appearances' => 0.25,
            'rookie_of_the_year' => 1,
            'career_points' => 0.01,
            'career_rebounds' => 0.02,
            'career_assists' => 0.03,
            'career_steals' => 0.05,
            'career_blocks' => 0.05,
            'per' => 0.1,
            'win_shares' => 0.05,
            'vorp' => 0.1,
        ];

        $criteria = array_merge($default_criteria, $criteria);

        // Fetch player data
        $fields = [
            'mvp_awards', 'finals_mvp_awards', 'all_nba_first_team',
            'all_nba_second_team', 'all_nba_third_team', 'all_star_appearances',
            'defensive_poy_awards', 'all_defensive_first_team', 'all_defensive_second_team',
            'nba_championships', 'nba_cup_championships', 'finals_appearances',
            'rookie_of_the_year', 'career_points', 'career_rebounds', 'career_assists', 'career_steals', 'career_blocks',
            'per', 'win_shares', 'vorp'
        ];

        $score = 0;

        foreach ($fields as $field) {
            $value = floatval(get_field($field, $player_id) ?: 0);
            if (isset($criteria[$field])) {
                $score += $value * $criteria[$field];
            }
        }

        return round($score, 2);
    }
}

// Shortcode to Display GOAT Rankings
if (!function_exists('display_goat_rankings')) {
    function display_goat_rankings($atts) {
        $criteria = [];
        foreach ($_GET as $key => $value) {
            $criteria[$key] = floatval($value);
        }

        // Fetch posts of type 'athletes' and tagged with 'NBA GOATs'
        $players = get_posts([
            'post_type' => 'athletes',
            'numberposts' => -1,
            'tax_query' => [
                [
                    'taxonomy' => 'category', // Assuming 'category' taxonomy is used for tagging
                    'field' => 'slug',
                    'terms' => 'nba-goats', // Replace with the actual slug for "NBA GOATs"
                ],
            ],
        ]);

        // Sort players by GOAT score
        usort($players, function ($a, $b) use ($criteria) {
            $scoreA = calculate_goat_score($a->ID, $criteria);
            $scoreB = calculate_goat_score($b->ID, $criteria);
            return $scoreB - $scoreA;
        });

        return render_goat_rankings($players, $criteria);
    }
    add_shortcode('goat_rankings', 'display_goat_rankings');
}

// AJAX Handler for Updating Rankings
if (!function_exists('update_goat_rankings')) {
    function update_goat_rankings() {
        $criteria = [];
        foreach ($_POST as $key => $value) {
            $criteria[$key] = floatval($value);
        }

        // Fetch posts of type 'athletes' and tagged with 'NBA GOATs'
        $players = get_posts([
            'post_type' => 'athletes',
            'numberposts' => -1,
            'tax_query' => [
                [
                    'taxonomy' => 'category', // Assuming 'category' taxonomy is used for tagging
                    'field' => 'slug',
                    'terms' => 'nba-goats', // Replace with the actual slug for "NBA GOATs"
                ],
            ],
        ]);

        // Sort players by GOAT score
        usort($players, function ($a, $b) use ($criteria) {
            $scoreA = calculate_goat_score($a->ID, $criteria);
            $scoreB = calculate_goat_score($b->ID, $criteria);
            return $scoreB - $scoreA;
        });

        $rankings_html = render_goat_rankings($players, $criteria);
        echo '<div id="goat-rankings">' . $rankings_html . '</div>';
        wp_die();
    }

    add_action('wp_ajax_update_goat_rankings', 'update_goat_rankings');
    add_action('wp_ajax_nopriv_update_goat_rankings', 'update_goat_rankings');
}

//Register Widgets
function my_theme_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'textdomain'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'textdomain'),
        'before_widget' => '<section class="widget">',
        'after_widget'  => '</div></section>',
        'before_title'  => '<div class="widget-title-box"><h4 class="widget-sub-title">',
        'after_title'   => '</h4></div><div class="widget-content">',
    ));
}
add_action('widgets_init', 'my_theme_widgets_init');

add_filter('use_widgets_block_editor', '__return_false');


/**
 * Customize the HTML structure of the WordPress search widget.
 */
function custom_search_widget_form($form) {
    // Start the custom search form structure
    $form = '
    <form class="widget-search" method="get" action="' . esc_url(home_url('/')) . '">
        <!-- Search input field -->
        <input type="text" name="s" placeholder="Keyword...">
        <!-- Submit button -->
        <button class="widget-btn">' . svg_icon('widget-btn-icon', 'search') . '</button>
    </form>';

    // Return the custom search form HTML
    return $form;
}

// Hook the custom function to replace the default WordPress search form
add_filter('get_search_form', 'custom_search_widget_form');


/**
 * Customize the category widget to remove post counts.
 *
 * @param string $output The HTML output of the category list.
 * @return string Modified HTML output without post counts.
 */
function customize_category_widget_output($output) {
    // Remove the post count format "(count)" entirely
    $output = preg_replace('/\s*\(\d+\)\s*/', '', $output);
    return $output;
}
add_filter('wp_list_categories', 'customize_category_widget_output');


/**
 * Modify the tag cloud widget to use a uniform font size and custom class.
 *
 * @param array $args Arguments for the tag cloud widget.
 * @return array Modified arguments for the tag cloud widget.
 */
function customize_tag_cloud_widget_uniform_size($args) {
    $args['smallest'] = 1.2; // Set minimum font size to 1.2rem
    $args['largest'] = 1.2;  // Set maximum font size to 1.2rem
    $args['unit'] = 'rem';   // Use 'rem' for font size unit
    $args['format'] = 'flat'; // Use flat format for tags
    return $args;
}
add_filter('widget_tag_cloud_args', 'customize_tag_cloud_widget_uniform_size');

// Custom Post Navigation Function
function custom_posts_navigation() {
    if (is_search()) {
        // Custom navigation for search results page
        ?>
        <nav class="navigation posts-navigation" role="navigation">
            <h2 class="screen-reader-text">Posts navigation</h2>
            <div class="nav-links">
                <div class="nav-previous">
                    <?php previous_posts_link('Older Posts'); ?>
                </div>
                <div class="nav-icon-area">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/icons/grid-shape.svg'); ?>" alt="Navigation Icon">
                </div>
                <div class="nav-next">
                    <?php next_posts_link('Newer Posts'); ?>
                </div>
            </div>
        </nav>
        <?php
    } elseif (is_single()) {
        // Custom navigation for single post pages
        $prev_post = get_previous_post();
        $next_post = get_next_post();
        ?>
        <nav class="navigation posts-navigation" role="navigation">
            <h2 class="screen-reader-text">Post Navigation</h2>
            <div class="nav-links news">
                <div class="nav-previous">
                    <?php if ($prev_post) : ?>
                        <h3>Previous Post</h3>
                        <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>"><?php echo esc_html($prev_post->post_title); ?></a>
                    <?php endif; ?>
                </div>
                <div class="nav-icon-area">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/icons/grid-shape.svg'); ?>" alt="Navigation Icon">
                </div>
                <div class="nav-next">
                    <?php if ($next_post) : ?>
                        <h3>Next Post</h3>
                        <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>"><?php echo esc_html($next_post->post_title); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
        <?php
    }
}

// Function to track post views using transients
function track_post_views($post_id) {
    if (!is_single() || empty($post_id)) return; // Only track views for single posts/pages

    $transient_key = 'post_views_' . $post_id; // Transient key for the post
    $views = get_transient($transient_key); // Check if the transient exists

    // If no transient exists, fetch the current view count from the database
    if ($views === false) {
        $views = get_post_meta($post_id, 'post_views_count', true); 
        $views = $views ? $views : 0; // Default to 0 if no view count exists
    }

    $views++; // Increment the view count
    set_transient($transient_key, $views, HOUR_IN_SECONDS); // Cache the new count for 1 hour
}

// Function to periodically update the database with cached views
function update_post_views_database() {
    global $wpdb;

    // Get all transients related to post views
    $transients = $wpdb->get_results("SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE '_transient_post_views_%'");

    foreach ($transients as $transient) {
        $transient_key = str_replace('_transient_', '', $transient->option_name);
        $post_id = intval(str_replace('post_views_', '', $transient_key));

        if ($post_id) {
            $views = get_transient($transient_key); // Get the cached view count
            if ($views !== false) {
                // Update the database
                update_post_meta($post_id, 'post_views_count', $views);
                delete_transient($transient_key); // Remove the transient after updating
            }
        }
    }
}

// Hook to track views when the post is viewed
add_action('wp_head', function() {
    if (is_single()) {
        track_post_views(get_the_ID());
    }
});

// Schedule the database update hourly
if (!wp_next_scheduled('update_post_views_event')) {
    wp_schedule_event(time(), 'hourly', 'update_post_views_event');
}
add_action('update_post_views_event', 'update_post_views_database');

// Cleanup scheduled event upon plugin/theme deactivation
register_deactivation_hook(__FILE__, function() {
    wp_clear_scheduled_hook('update_post_views_event');
});

/**
 * Display the "news top" section with views, comments, and post date.
 *
 * @return string The generated HTML for the "news top" section.
 */
function display_news_top_section() {
    global $post;

    // Fetch the view count for the current post
    $views = get_post_meta($post->ID, 'post_views_count', true);
    $views = $views ? $views : 0; // Default to 0 if no views are recorded



    ob_start(); // Start output buffering
    ?>
        <span class="author"><?php echo svg_icon('author-icon', 'user');?>By <strong><em><?php echo esc_html(get_the_author()); ?></em></strong> on
        <?php echo esc_html(get_the_date('F j, Y')); ?></span>
        <span class="viewers"><?php echo svg_icon('viewers-icon', 'eye');?> <?php echo esc_html($views); ?> Views</span>
        <span class="comments"><?php echo svg_icon('comments-icon', 'comments');?> 
            <hyvor-talk-comment-count page-id="<?php echo esc_attr($post->ID); ?>"></hyvor-talk-comment-count>
        </span>

    <?php
    return ob_get_clean(); // Return the buffered content
}

/// Display related tags and social share section

function display_related_tags_and_social_share() {
    global $post;

    // Get tags for the current post
    $tags = get_the_tags($post->ID);

    // Base URL for sharing links
    $permalink = urlencode(get_permalink($post->ID));
    $title = urlencode(get_the_title($post->ID));

    ob_start(); // Start output buffering
    ?>
    <div class="news-bottom">
       
        <div class="news-tags">
            <h3>Related Tags</h3>
            <ul>
                <?php if ($tags) : ?>
                    <?php foreach ($tags as $tag) : ?>
                        <li><a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"><?php echo esc_html($tag->name); ?></a></li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li>No related tags available.</li>
                <?php endif; ?>
            </ul>
        </div>
        
        <div class="social-share">
            <h3>Social Share</h3>
            <ul>
                <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $permalink; ?>" target="_blank" rel="noopener noreferrer"><?php echo svg_icon('social-share-icon', 'facebook');?></a></li>
                <li><a href="https://twitter.com/intent/tweet?url=<?php echo $permalink; ?>&text=<?php echo $title; ?>" target="_blank" rel="noopener noreferrer"><?php echo svg_icon('social-share-icon', 'twitter');?></a></li>
                <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $permalink; ?>&title=<?php echo $title; ?>" target="_blank" rel="noopener noreferrer"><?php echo svg_icon('social-share-icon', 'linkedin');?></a></li>
                <li><a href="https://www.tumblr.com/share/link?url=<?php echo $permalink; ?>&name=<?php echo $title; ?>" target="_blank" rel="noopener noreferrer"><?php echo svg_icon('social-share-icon', 'tumblr');?></a></li>
            </ul>
        </div>
       
    </div>
    <?php
    return ob_get_clean(); // Return the buffered content
}

/**
 * Social Share Shortcode
 *
 * Usage: [social_share]
 */
function social_share_shortcode() {
    if ( is_singular() ) {
        $permalink = get_permalink();
        $title = get_the_title();
    } else {
        $permalink = home_url();
        $title = get_bloginfo( 'name' );
    }

    ob_start(); // Start output buffering
    ?>
    <div class="social-share">
        <ul class="flex-start">
            <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( $permalink ); ?>" target="_blank" rel="noopener noreferrer"><?php echo svg_icon('social-share-icon', 'facebook');?></a></li>
            <li><a href="https://twitter.com/intent/tweet?url=<?php echo esc_url( $permalink ); ?>&text=<?php echo esc_attr( $title ); ?>" target="_blank" rel="noopener noreferrer"><?php echo svg_icon('social-share-icon', 'twitter');?></a></li>
            <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( $permalink ); ?>&title=<?php echo esc_attr( $title ); ?>" target="_blank" rel="noopener noreferrer"><?php echo svg_icon('social-share-icon', 'linkedin');?></a></li>
            <li><a href="https://www.tumblr.com/share/link?url=<?php echo esc_url( $permalink ); ?>&name=<?php echo esc_attr( $title ); ?>" target="_blank" rel="noopener noreferrer"><?php echo svg_icon('social-share-icon', 'tumblr');?></a></li>
        </ul>
    </div>
    <?php
    return ob_get_clean(); // Return the buffered content
}
add_shortcode( 'social_share', 'social_share_shortcode' );


/**
 * Calculate and return the estimated reading time for a post.
 *
 * @param int $post_id The ID of the post (default is current post).
 * @return string Estimated reading time in minutes, formatted with parentheses.
 */
function get_reading_time($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $content = get_post_field('post_content', $post_id); // Get the post content
    $word_count = str_word_count(strip_tags($content)); // Count the number of words
    $reading_speed = 200; // Average reading speed (words per minute)
    $reading_time = ceil($word_count / $reading_speed); // Calculate reading time

    return sprintf(
        __('%s Minute Read', 'all-ball'),
        $reading_time
    );
}


/**
 * Include 'athletes' custom post type in tag archive queries.
 *
 * @param WP_Query $query The main query object.
 */
function add_athletes_to_tags($query) {
    // Check if it's not the admin dashboard, the main query, and a tag archive page.
    if (!is_admin() && $query->is_main_query() && $query->is_tag()) {
        // Add 'athletes' custom post type to the query.
        $query->set('post_type', array('post', 'athletes'));
    }
}
add_action('pre_get_posts', 'add_athletes_to_tags');

/**
 * Include 'athletes' custom post type in category archive queries.
 *
 * @param WP_Query $query The main query object.
 */
function add_athletes_to_categories($query) {
    // Check if it's not the admin dashboard, the main query, and a category archive page.
    if (!is_admin() && $query->is_main_query() && $query->is_category()) {
        // Add 'athletes' custom post type to the query.
        $query->set('post_type', array('post', 'athletes'));
    }
}
add_action('pre_get_posts', 'add_athletes_to_categories');