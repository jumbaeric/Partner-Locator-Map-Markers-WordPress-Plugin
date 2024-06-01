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
 * @author     Loxup <info@loxup.nl>
 */
class Loxup_Partners_Acf_Fields
{

    /**
     *
     * Register custom post type for Locations.
     *
     * @since    1.0.0
     */
    function register()
    {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }

        acf_add_local_field_group(array(
            'key' => 'group_661070f5c54ee',
            'title' => 'Partner Details',
            'fields' => array(
                array(
                    'key' => 'field_661071318a2c5',
                    'label' => 'Phone',
                    'name' => 'phone',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_6610715c8a2c6',
                    'label' => 'Email',
                    'name' => 'email',
                    'aria-label' => '',
                    'type' => 'email',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_6610717d8a2c7',
                    'label' => 'Website',
                    'name' => 'website',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_661c250e7db42',
                    'label' => 'Opening Hours',
                    'name' => 'partner_opening_hours',
                    'aria-label' => '',
                    'type' => 'group',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_661c26837db43',
                            'label' => 'Monday',
                            'name' => 'monday',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => 'Enter Opening Hours and Closing Hours in 24 Hours e.g 09:00 - 16:00',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '09:00 - 16:00',
                            'maxlength' => '',
                            'placeholder' => '09:00 - 16:00',
                            'prepend' => '',
                            'append' => '',
                        ),
                        array(
                            'key' => 'field_661c27bf7db44',
                            'label' => 'Tuesday',
                            'name' => 'tuesday',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => 'Enter Opening Hours and Closing Hours in 24 Hours e.g 09:00 - 16:00',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '09:00 - 16:00',
                            'maxlength' => '',
                            'placeholder' => '09:00 - 16:00',
                            'prepend' => '',
                            'append' => '',
                        ),
                        array(
                            'key' => 'field_661c27df7db45',
                            'label' => 'Wednesday',
                            'name' => 'wednesday',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => 'Enter Opening Hours and Closing Hours in 24 Hours e.g 09:00 - 16:00',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '09:00 - 16:00',
                            'maxlength' => '',
                            'placeholder' => '09:00 - 16:00',
                            'prepend' => '',
                            'append' => '',
                        ),
                        array(
                            'key' => 'field_661c27f47db46',
                            'label' => 'Thursday',
                            'name' => 'thursday',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => 'Enter Opening Hours and Closing Hours in 24 Hours e.g 09:00 - 16:00',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '09:00 - 16:00',
                            'maxlength' => '',
                            'placeholder' => '09:00 - 16:00',
                            'prepend' => '',
                            'append' => '',
                        ),
                        array(
                            'key' => 'field_661c28057db47',
                            'label' => 'Friday',
                            'name' => 'friday',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => 'Enter Opening Hours and Closing Hours in 24 Hours e.g 09:00 - 16:00',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '09:00 - 16:00',
                            'maxlength' => '',
                            'placeholder' => '09:00 - 16:00',
                            'prepend' => '',
                            'append' => '',
                        ),
                        array(
                            'key' => 'field_661c281b7db48',
                            'label' => 'Saturday',
                            'name' => 'saturday',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => 'Enter Opening Hours and Closing Hours in 24 Hours e.g 09:00 - 16:00',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => 'Closed',
                            'maxlength' => '',
                            'placeholder' => 'Closed',
                            'prepend' => '',
                            'append' => '',
                        ),
                        array(
                            'key' => 'field_661c28337db49',
                            'label' => 'Sunday',
                            'name' => 'sunday',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => 'Enter Opening Hours and Closing Hours in 24 Hours e.g 09:00 - 16:00',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => 'Closed',
                            'maxlength' => '',
                            'placeholder' => 'Closed',
                            'prepend' => '',
                            'append' => '',
                        ),
                    ),
                ),
                array(
                    'key' => 'field_6610719c8a2c8',
                    'label' => 'Address details',
                    'name' => 'address_details',
                    'aria-label' => '',
                    'type' => 'group',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_661a34572648f',
                            'label' => 'Longitude',
                            'name' => 'longitude',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                        ),
                        array(
                            'key' => 'field_661a347a26490',
                            'label' => 'Latitude',
                            'name' => 'latitude',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                        ),
                        array(
                            'key' => 'field_6612feb2b3d25',
                            'label' => 'Address',
                            'name' => 'address',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                        ),
                        array(
                            'key' => 'field_6612fec3b3d26',
                            'label' => 'Postal Code',
                            'name' => 'postal_code',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                        ),
                        array(
                            'key' => 'field_6612fed4b3d27',
                            'label' => 'City',
                            'name' => 'city',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                        ),
                        array(
                            'key' => 'field_6612fee2b3d28',
                            'label' => 'Country',
                            'name' => 'country',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                        ),
                    ),
                ),
                array(
                    'key' => 'field_661071e88a2ca',
                    'label' => 'Video Link',
                    'name' => 'video_link',
                    'aria-label' => '',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'partner',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        ));
    }


    // Add custom rule values for ACF location rules
    function loxup_add_custom_acf_rule_values($choices)
    {
        $choices['Post Type']['acf-options-post_type:partner'] = 'Partners';
        return $choices;
    }
}
