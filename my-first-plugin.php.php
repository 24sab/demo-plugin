<?php
/*
Plugin Name: Recent Posts with Thumbnails
Description: Displays recent posts with featured images via shortcode [recent_posts]
Version: 1.0
Author: Your Name
*/

// Security check
defined('ABSPATH') or die('No direct access!');

function recent_posts_with_thumbnails($atts) {
    // Set default attributes
    $atts = shortcode_atts(array(
        'count' => 5,
        'category' => '',
        'show_date' => true
    ), $atts);

    // Query arguments
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => absint($atts['count']),
        'post_status' => 'publish'
    );

    // Add category filter if specified
    if (!empty($atts['category'])) {
        $args['category_name'] = sanitize_text_field($atts['category']);
    }

    // The query
    $recent_posts = new WP_Query($args);

    // Start output buffering
    ob_start();

    if ($recent_posts->have_posts()) : ?>
        <div class="recent-posts-container">
            <?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                <div class="recent-post">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </a>
                    <?php endif; ?>
                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <?php if ($atts['show_date']) : ?>
                        <p class="post-date"><?php echo get_the_date(); ?></p>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
        
        <!-- Basic styling -->
        <style>
            .recent-posts-container {
                display: grid;
                gap: 20px;
            }
            .recent-post {
                display: flex;
                gap: 15px;
                align-items: center;
            }
            .recent-post img {
                width: 80px;
                height: 80px;
                object-fit: cover;
            }
            .post-date {
                font-size: 0.8em;
                color: #666;
                margin: 5px 0 0 0;
            }
        </style>
    <?php endif;

    // Reset post data
    wp_reset_postdata();

    // Return the buffered content
    return ob_get_clean();
}
add_shortcode('recent_posts', 'recent_posts_with_thumbnails');