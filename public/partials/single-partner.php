<?php

/**
 * The template for displaying single partner posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Your_Theme_or_Plugin_Name
 */
function get_youtube_embed_code($url)
{
    // Extract video ID from URL
    $parsed_url = parse_url($url);
    if (isset($parsed_url['query'])) {
        parse_str($parsed_url['query'], $query_params);
        if (isset($query_params['v'])) {
            $video_id = $query_params['v'];
            return $video_id;
        }
    }
    return false; // URL is not a valid YouTube URL
}
?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="wp-site-blocks">

        <?php
        // Start the loop.
        while (have_posts()) :
            the_post();
            // Retrieve custom fields
            $phone = get_field('phone');
            $email = get_field('email');
            $website = get_field('website');
            $opening_hours = get_field('partner_opening_hours', get_the_ID());
            $address_details = get_field('address_details');
            $video_link = get_field('video_link');
            $video_id = get_youtube_embed_code($video_link);
            $terms = get_the_terms(get_the_ID(), 'partner-tag');
            $partner_image_url = esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full'));

            include_once(plugin_dir_path(__FILE__) . 'content-partner.php');

        endwhile;
        // End of the loop.
        ?>

    </div>
    <?php wp_footer(); ?>

</body>

</html>