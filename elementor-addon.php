<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/sayedhossainup/Anber-Elamantor-Addon
 * @since             1.0.0
 * @package           Anber_Ea
 *
 * @wordpress-plugin
 * Plugin Name:       Anber Elementor Addon
 * Plugin URI:        https://github.com/sayedhossainup/Anber-Elamantor-Addon
 * Description:       Custom widgets for Elementor
 * Version:           1.0.0
 * Author:            Md Yeasir Arafat
 * Author URI:        https://github.com/sayedhossainup
 * License:           GPLv3
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       anber-ea
 * Domain Path:       /languages
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/* ---------------------------------------------------------------    */

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ANBER_EA_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-yeasfi-ea-activator.php
 */
function activate_yeasfi_ea() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-anber-ea-activator.php';
	Anber_Ea_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-yeasfi-ea-deactivator.php
 */
function deactivate_yeasfi_ea() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-anber-ea-deactivator.php';
	Anber_Ea_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_yeasfi_ea' );
register_deactivation_hook( __FILE__, 'deactivate_yeasfi_ea' );



// Check if Elementor is installed and activated
add_action('admin_init', 'check_for_elementor');

function check_for_elementor() {
    // Check if Elementor is not active
    if (!did_action('elementor/loaded')) {
        // Add an admin notice if Elementor is not active
        add_action('admin_notices', 'elementor_missing_notice');
        return;
    }
}

function elementor_missing_notice() {
    // Display the admin notice
    ?>
    <div class="notice notice-error">
        <p><?php esc_html_e('Anber Elementor Addon Plugin requires Elementor to be installed and activated.', 'anber-ea'); ?></p>
    </div>
    <?php
}

// Function to dynamically include and register widgets
function include_widgets($widgets_manager) {
    $widgets = [];

    // Loop through all files in the widgets directory
    foreach (glob(__DIR__ . '/widgets/*') as $file) {
        $widget_name = basename($file); // Get the folder name of the widget
        if ($widget_name != 'index.php') {
            $widgets[] = $widget_name;
        }
    }

    // Filter out empty or irrelevant entries
    if (is_array($widgets)) {
        $widgets = array_filter($widgets);

        foreach ($widgets as $widget) {
            $widget_dir = __DIR__ . '/widgets/' . $widget . '/index.php';

            // Check if it's a WooCommerce-related widget and if WooCommerce is active
            if (strpos($widget, 'woo') !== false) {
                if (class_exists('WooCommerce')) {
                    // Load the WooCommerce widget
                    require_once $widget_dir;
                }
            } else {
                // Load the regular widget
                require_once $widget_dir;
            }

            // Register the widget with Elementor if it exists
            $widget_class = '\Elementor\\' . str_replace('-', '_', ucwords($widget, '-'));
            if (class_exists($widget_class)) {
                $widgets_manager->register(new $widget_class());
            }
        }
    }
}

// Hook into Elementor’s widget registration action
add_action('elementor/widgets/register', 'include_widgets');

function add_elementor_widget_categories($elements_manager) {

    $elements_manager->add_category(
            'anbar-category',
            [
                'title' => esc_html__('Anber Addon', 'anber-ea'),
                'icon' => 'fa fa-plug',
            ]
    );
}

add_action('elementor/elements/categories_registered', 'add_elementor_widget_categories');




function elementor_aea_widgets_dependencies() {

	/* Scripts */
	//wp_register_script( 'menu-script', plugins_url( 'assets/js/menu-script.js', __FILE__ ) );        
        wp_register_script( 'anber-carousel', plugins_url( 'assets/js/anber-carousel.js', __FILE__ ) );
        wp_register_script( 'anber-carousel-script', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/owl.carousel.min.js' );
        wp_register_script( 'anber-magnific-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js' );   
	

	/* Styles */
	wp_register_style( 'adon-comon-style', plugins_url( 'assets/css/adon-comon-style.css', __FILE__ ) );
        wp_register_style( 'anber-carousel-style', plugins_url( 'assets/css/anber-carousel-style.css', __FILE__ ) );
        wp_register_style( 'anber-carousel',  'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css', );
        wp_register_style( 'anber-magnific-popup',  'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css', );
        
	

}
add_action( 'wp_enqueue_scripts', 'elementor_aea_widgets_dependencies' );

