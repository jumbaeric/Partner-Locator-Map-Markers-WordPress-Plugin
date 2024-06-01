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
class Loxup_Location_Taxonomy
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
            'name' => 'Locations',
            'singular_name' => 'Location',
            'menu_name' => 'Locations',
            'all_items' => 'All Locations',
            'edit_item' => 'Edit Location',
            'view_item' => 'View Location',
            'update_item' => 'Update Location',
            'add_new_item' => 'Add New Location',
            'new_item_name' => 'New Location Name',
            'parent_item' => 'Parent Location',
            'parent_item_colon' => 'Parent Location:',
            'search_items' => 'Search Locations',
            'not_found' => 'No locations found',
            'no_terms' => 'No locations',
            'filter_by_item' => 'Filter by location',
            'items_list_navigation' => 'Locations list navigation',
            'items_list' => 'Locations list',
            'back_to_items' => '← Go to locations',
            'item_link' => 'Location Link',
            'item_link_description' => 'A link to a location',
        );

        $args = array(
            'public' => true,
            'labels'  => $labels,
            'hierarchical' => true,
            'show_in_menu' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
        );

        register_taxonomy('location', 'partner', $args);
    }
}
