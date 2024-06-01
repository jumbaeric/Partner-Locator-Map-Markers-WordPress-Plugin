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
class Loxup_Partner_Tag_Taxonomy
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
            'name' => 'Tags',
            'singular_name' => 'Tag',
            'menu_name' => 'Partner Tags',
            'all_items' => 'All Partner Tags',
            'edit_item' => 'Edit Partner Tag',
            'view_item' => 'View Partner Tag',
            'update_item' => 'Update Partner Tag',
            'add_new_item' => 'Add New Partner Tag',
            'new_item_name' => 'New Partner Tag Name',
            'search_items' => 'Search Partner Tags',
            'popular_items' => 'Popular Partner Tags',
            'separate_items_with_commas' => 'Separate partner tags with commas',
            'add_or_remove_items' => 'Add or remove partner tags',
            'choose_from_most_used' => 'Choose from the most used partner tags',
            'not_found' => 'No partner tags found',
            'no_terms' => 'No partner tags',
            'items_list_navigation' => 'Partner Tags list navigation',
            'items_list' => 'Partner Tags list',
            'back_to_items' => '← Go to partner tags',
            'item_link' => 'Partner Tag Link',
            'item_link_description' => 'A link to a partner tag',
        );

        $args = array(
            'public' => true,
            'show_in_menu' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
        );

        register_taxonomy('partner-tag', 'partner', $args);
    }
}
