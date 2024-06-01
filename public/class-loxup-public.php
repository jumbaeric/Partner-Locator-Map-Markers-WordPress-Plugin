<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://loxup.nl/noodhulp/
 * @since      1.0.0
 *
 * @package    Loxup
 * @subpackage Loxup/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Loxup
 * @subpackage Loxup/public
 * @author     Loxup <info@loxup.nl>
 */
class Loxup_Public
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	function set_custom_partner_template($template = 'single-partner')
	{
		if (is_singular('partner')) {
			$template = 'single-partner';
			$new_template = plugin_dir_path(__FILE__) . 'partials/' . $template . '.php';
			if ('' !== $new_template) {
				return $new_template;
			}
		}
		return $template;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{
		wp_enqueue_style($this->plugin_name . 'font-awesome', plugin_dir_url(__FILE__) . 'font-awesome/css/fontawesome.min.css', array(), null, 'all');
		wp_enqueue_style($this->plugin_name . 'font-awesome-brands', plugin_dir_url(__FILE__) . 'font-awesome/css/brands.min.css', array(), null, 'all');
		wp_enqueue_style($this->plugin_name . 'font-awesome-solid', plugin_dir_url(__FILE__) . 'font-awesome/css/solid.min.css', array(), null, 'all');
		wp_enqueue_style($this->plugin_name . 'font-awesome-v5', plugin_dir_url(__FILE__) . 'font-awesome/css/v5-font-face.min.css', array(), null, 'all');
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/loxup-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{
		// Generate a nonce for AJAX security
		$nonce = wp_create_nonce('loxup_ajax_nonce_action');

		wp_enqueue_script('loxup-maps', plugin_dir_url(__FILE__) . 'js/loxup-public.js', array('jquery'), $this->version, true);

		wp_localize_script('loxup-maps', 'loxup_google_maps_vars', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'location' => $this->get_business_location_callback(),
			'nonce'    => $nonce // Nonce for AJAX security
		));
		$google_maps_api_key = get_option('loxup_google_maps');
		//  AIzaSyDGlbtwyXQ0ntaVAHbrV0-OwQ8i2GT6N6g
		wp_enqueue_script('google-maps-api', 'https://maps.googleapis.com/maps/api/js?key=' . $google_maps_api_key['loxup_api_key'] . '&callback=initMap', array(), null, true);
	}

	// Function to retrieve partner locations
	function get_partner_locations()
	{
		// Verify nonce for security
		$nonce = $_POST['security'];
		if (!wp_verify_nonce($nonce, 'loxup_ajax_nonce_action')) {
			wp_send_json_error('Invalid nonce');
		}

		$args = array(
			'post_type' => 'partner',
			'posts_per_page' => -1,
			// Add additional parameters for querying partner information
		);

		$partners = new WP_Query($args);
		$locations = array();

		// Loop through each partner and extract latitude and longitude
		if ($partners->have_posts()) {
			while ($partners->have_posts()) {
				$partners->the_post();
				$address_details = get_field('address_details');
				$longitude = $address_details['longitude']; //get_field('address_details_longitude');
				$latitude = $address_details['latitude']; //get_field('address_details_latitude');
				$title = get_the_title();
				$phone = get_field('phone');
				$link = get_the_permalink();
				$city = $address_details['city'];
				$terms = get_the_terms(get_the_ID(), 'partner-tag');
				$tags = '';
				foreach ($terms as $term) :
					$tags .= $term->name . ', ';
				endforeach;
				if ($longitude && $latitude) {
					$locations[] = array(
						'title' => $title,
						'phone' => $phone,
						'latitude' => $latitude,
						'longitude' => $longitude,
						'link' => $link,
						'city' => $city,
						'tags' => $tags,
					);
				}
			}
			wp_reset_postdata();
		}

		wp_send_json_success($locations);
		wp_die();
	}

	// Create a shortcode to render Google Maps tool
	public function loxup_render_map_shortcode($atts, $content = "")
	{
		$template = plugin_dir_path(dirname(__FILE__)) . 'public/partials/content-map.php';

		if (!file_exists($template)) {
			// Template file not found
			return 'Template file not found.';
		}

		$args = array(
			'post_type' => 'partner',
			'post_status' => 'publish',
			'post_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC',
		);

		$partners = new WP_Query($args);

		ob_start();

		include $template;

		return ob_get_clean();
	}

	function register_shortcodes()
	{
		add_shortcode('loxup_map', array($this, 'loxup_render_map_shortcode'));
	}

	function filter_partners()
	{
		$terms = $_POST['terms'];
		$args = array(
			'post_type' => 'partner',
		);

		// Check if any terms are selected
		if (!empty($terms)) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'partner-tag',
					'field' => 'slug',
					'terms' => $terms
				)
			);
		}
		$partners = new WP_Query($args);
		ob_start();
		if ($partners->have_posts()) :
			while ($partners->have_posts()) : $partners->the_post();
				$city = get_field('city', get_the_ID());
				$terms = get_the_terms(get_the_ID(), 'partner-tag');
				$address_details = get_field('address_details');
?>
				<div class="dealer flex" style="transition-delay: 0s;">
					<button title="<?php the_title() ?>" class="dealer-link flex-column flex-grow-1">
						<div>
							<b class="ellipsis">
								<font style="vertical-align: inherit;">
									<a href="<?php the_permalink() ?>">
										<?php the_title() ?>
									</a>
								</font>
							</b>
						</div>
						<div class="flex mt-05" style="flex-wrap: wrap; flex-direction: column;">
							<span class="small">
								<font style="vertical-align: inherit;">
									<?php echo $address_details['city'] ?>
								</font>
							</span>

							<span class="small">
								<p>
									<?php foreach ($terms as $term) : ?>
										<font style="vertical-align: inherit;"><?php echo $term->name ?>,</font>
									<?php endforeach; ?>
								</p>
							</span>
							<div class="flex-grow-1"></div>
							<!---->
						</div>
						<!---->
					</button>
					<a href="tel:<?php echo get_field('phone') ?>" class="text-button">
						<i class="fa-solid fa-phone icons8-phone pink--text"></i></i>
					</a>
					<i class="fa-solid fa-angle-right icons8-right pink--text show-on-hover"></i>
				</div>
<?php
			endwhile;
			wp_reset_postdata();
		else :
			echo 'No partners found';
		endif;
		$response = ob_get_clean();
		echo $response;
		wp_die();
	}

	// Function to filter partners' markers based on selected taxonomy terms
	function filter_partners_markers()
	{
		// Check if the AJAX request is coming from a valid source
		check_ajax_referer('loxup_ajax_nonce_action', 'security');

		// Get selected taxonomy terms
		$selected_terms = $_POST['terms'];

		// Query partners based on selected taxonomy terms
		$args = array(
			'post_type' => 'partner', // Adjust post type if necessary
			'posts_per_page' => -1, // Retrieve all posts
			'orderby' => 'title',
			'order' => 'ASC',
		);

		if (!empty($selected_terms)) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'partner-tag',
					'field'    => 'slug',
					'terms'    => $selected_terms,
					'operator' => 'IN',
				),
			);
		}
		// Initialize an empty array to store the filtered markers
		$filtered_markers = array();

		$query = new WP_Query($args);

		// Loop through the query results and store marker information
		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();

				// Get partner details
				$partner_id = get_the_ID();
				$address_details = get_field('address_details', $partner_id);
				$longitude = $address_details['longitude']; //get_field('address_details_longitude');
				$latitude = $address_details['latitude']; //get_field('address_details_latitude');
				$title = get_the_title($partner_id);
				$phone = get_field('phone', $partner_id);
				$link = get_the_permalink($partner_id);
				$city = $address_details['city'];
				$terms = get_the_terms($partner_id, 'partner-tag');
				$tags = '';
				foreach ($terms as $term) :
					$tags .= $term->name . ', ';
				endforeach;

				// Add marker information to the filtered markers array
				$filtered_markers[] = array(
					'title' => $title,
					'phone' => $phone,
					'latitude' => $latitude,
					'longitude' => $longitude,
					'link' => $link,
					'city' => $city,
					'tags' => $tags,
				);
			}
		}

		// Reset post data
		wp_reset_postdata();

		// Return the filtered markers as JSON
		wp_send_json($filtered_markers);

		// Always exit to avoid further execution
		exit;
	}

	function get_business_location_callback()
	{
		$google_maps = (array) get_option('loxup_google_maps');

		return array(
			'latitude' => esc_attr($google_maps['latitude']),
			'longitude' => esc_attr($google_maps['longitude']),
		);
	}
}
