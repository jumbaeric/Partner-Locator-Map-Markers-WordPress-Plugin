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
 * @subpackage Loxup/admin
 * @author     Eric jumba kedogo <jumbaeric@gmail.com>
 */
class Loxup_Partner_Options
{

    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;
    // Hook to add settings page
    function loxup_add_settings_page()
    {
        add_options_page(
            'Partner Locator Map Markers Settings', // Page title
            'Partner Locator Map Markers',          // Menu title
            'manage_options',                       // Capability
            'options-loxup',                        // Menu slug
            array($this, 'loxup_render_settings_page')          // Callback function
        );
    }

    // Render the settings page
    function loxup_render_settings_page()
    {
?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                settings_errors('loxup_settings_group_errors');
                settings_fields('loxup_settings_group');
                do_settings_sections('options-loxup');
                submit_button('Save Settings');
                ?>
            </form>
        </div>
    <?php
    }

    function loxup_register_settings()
    {
        // Register a new setting for "loxup" page
        register_setting(
            'loxup_settings_group',
            'loxup_google_maps',
            array($this, 'Sanitize')
        ); // Sanitize)

        // Add a new section in the "loxup" page
        add_settings_section(
            'loxup_settings_section',              // Section ID
            'Google Maps API Key Settings',       // Title
            array($this, 'loxup_settings_section_callback'),     // Callback
            'options-loxup'                       // Page
        );

        // Add a new section in the "loxup" page
        add_settings_section(
            'loxup_settings_map_center_section',              // Section ID
            'Business Service Location',       // Title
            array($this, 'loxup_settings_map_center_section_callback'),     // Callback
            'options-loxup'                       // Page
        );

        // Add a new field in the "loxup_settings_section" section, inside the "loxup" page
        add_settings_field(
            'loxup_api_key',           // Field ID
            'Google Maps API Key',                // Title
            array($this, 'loxup_google_maps_api_key_callback'),  // Callback
            'options-loxup',                      // Page
            'loxup_settings_section'               // Section
        );

        add_settings_field(
            'loxup_location',           // Field ID
            'Business Location',                // Title
            array($this, 'loxup_location_callback'),  // Callback
            'options-loxup',                      // Page
            'loxup_settings_map_center_section'               // Section
        );
    }

    function loxup_settings_section_callback()
    {
        echo '<p>Enter your Google Maps API Key below:</p>';
    }

    function loxup_settings_map_center_section_callback()
    {
        echo '<p>Enter your Business Location: (City, Country)</p>';
    }

    function loxup_google_maps_api_key_callback()
    {
        // Get the value of the setting
        $google_maps_api_key = (array) get_option('loxup_google_maps');
    ?>
        <label>
            <input type="text" name="loxup_google_maps[loxup_api_key]" value="<?php echo isset($google_maps_api_key['loxup_api_key']) ?  esc_attr($google_maps_api_key['loxup_api_key']) : ''; ?>" class="regular-text" />
        </label>
    <?php
    }

    function loxup_location_callback()
    {
        // Get the value of the setting
        $google_maps_api_key = (array) get_option('loxup_google_maps');
    ?>
        <label>
            <input type="text" name="loxup_google_maps[loxup_location]" value="<?php echo isset($google_maps_api_key['loxup_location']) ?  esc_attr($google_maps_api_key['loxup_location']) : ''; ?>" class="regular-text" />
        </label>
        <?php if (isset($google_maps_api_key['latitude']) && !empty($google_maps_api_key['latitude'])) : ?>
            <label>
                <input type="text" name="loxup_google_maps[latitude]" value="<?php echo esc_attr($google_maps_api_key['latitude']); ?>">
            </label>
            <label>
                <input type="text" name="loxup_google_maps[longitude]" value="<?php echo esc_attr($google_maps_api_key['longitude']); ?>">
            </label>
<?php
        endif;
    }


    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize($input)
    {
        if (isset($input['loxup_api_key']))
            $input['loxup_api_key'] = sanitize_text_field($input['loxup_api_key']);

        if (isset($input['loxup_location'])) {
            $input['loxup_location'] = sanitize_text_field($input['loxup_location']);
            $location = urlencode($input['loxup_location']);
            $url = "https://geocode.maps.co/search?q=$location&api_key=665ab77bcffc4091051201dnb446c6e";
            $response = wp_remote_get($url);
            if (!is_wp_error($response)) {
                $body = wp_remote_retrieve_body($response);
                $data = json_decode($body);
                if ($data && !empty($data[0])) {
                    $input['latitude'] = $data[0]->lat;
                    $input['longitude'] = $data[0]->lon;
                }
            } else {
                $input['latitude'] = '51.5663922';
                $input['longitude'] = '5.0866496';
            }

            return $input;
        }
    }
}
