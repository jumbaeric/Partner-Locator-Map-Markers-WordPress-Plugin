<?php

/**
 * Fired during plugin activation
 *
 * @link       https://loxup.nl
 * @since      1.0.0
 *
 * @package    Loxup
 * @subpackage Loxup/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Loxup
 * @subpackage Loxup/includes
 * @author     Eric jumba kedogo <jumbaeric@gmail.com>
 */
class Loxup_Partners_Cpt
{

    /**
     *
     * Register custom post type for Partners.
     *
     * @since    1.0.0
     */
    function register()
    {
        $labels = array(
            'name' => 'Partners',
            'singular_name' => 'Partner',
            'menu_name' => 'Partners',
            'all_items' => 'All Partners',
            'edit_item' => 'Edit Partner',
            'view_item' => 'View Partner',
            'view_items' => 'View Partners',
            'add_new_item' => 'Add New Partner',
            'add_new' => 'Add New Partner',
            'new_item' => 'New Partner',
            'parent_item_colon' => 'Parent Partner:',
            'search_items' => 'Search Partners',
            'not_found' => 'No partners found',
            'not_found_in_trash' => 'No partners found in Trash',
            'archives' => 'Partner Archives',
            'attributes' => 'Partner Attributes',
            'insert_into_item' => 'Insert into partner',
            'uploaded_to_this_item' => 'Uploaded to this partner',
            'filter_items_list' => 'Filter partners list',
            'filter_by_date' => 'Filter partners by date',
            'items_list_navigation' => 'Partners list navigation',
            'items_list' => 'Partners list',
            'item_published' => 'Partner published.',
            'item_published_privately' => 'Partner published privately.',
            'item_reverted_to_draft' => 'Partner reverted to draft.',
            'item_scheduled' => 'Partner scheduled.',
            'item_updated' => 'Partner updated.',
            'item_link' => 'Partner Link',
            'item_link_description' => 'A link to a partner.',
        );

        $args = array(
            'labels'             => $labels,
            'public' => true,
            'show_in_rest' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-store',
            'supports' => array(
                0 => 'title',
                1 => 'author',
                2 => 'comments',
                3 => 'editor',
                4 => 'excerpt',
                5 => 'thumbnail',
            ),
            'delete_with_user' => false,
            'has_archive' => true,
            'rewrite'          => array('slug' => 'partners'),
        );

        register_post_type('partner', $args);
    }

    function loxup_add_partner_endpoint()
    {
        add_rewrite_endpoint('partners', EP_ALL);
    }
}
