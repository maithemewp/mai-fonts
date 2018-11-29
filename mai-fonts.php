<?php

/**
 * Plugin Name:     Mai Fonts
 * Plugin URI:      https://maitheme.com/
 * Description:     Customize fonts in Mai Theme powered websites.
 *
 * Version:         0.1.0
 *
 * GitHub URI:      maithemewp/mai-fonts
 *
 * Author:          MaiTheme.com
 * Author URI:      https://maitheme.com
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Main Mai_Fonts Class.
 *
 * @since 0.1.0
 */
final class Mai_Fonts {

	/**
	 * @var Mai_Fonts The one true Mai_Fonts
	 * @since 0.1.0
	 */
	private static $instance;

	/**
	 * Main Mai_Fonts Instance.
	 *
	 * Insures that only one instance of Mai_Fonts exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since   0.1.0
	 * @static  var array $instance
	 * @uses    Mai_Fonts::setup_constants() Setup the constants needed.
	 * @uses    Mai_Fonts::includes() Include the required files.
	 * @uses    Mai_Fonts::setup() Activate, deactivate, etc.
	 * @see     Mai_Fonts()
	 * @return  object | Mai_Fonts The one true Mai_Fonts
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			// Setup the setup
			self::$instance = new Mai_Fonts;
			// Methods
			self::$instance->setup_constants();
			self::$instance->includes();
			self::$instance->setup();
		}
		return self::$instance;
	}

	/**
	 * Throw error on object clone.
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since   0.1.0
	 * @access  protected
	 * @return  void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'mai-fonts' ), '1.0' );
	}

	/**
	 * Disable unserializing of the class.
	 *
	 * @since   0.1.0
	 * @access  protected
	 * @return  void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'mai-fonts' ), '1.0' );
	}

	/**
	 * Setup plugin constants.
	 *
	 * @access  private
	 * @since   0.1.0
	 * @return  void
	 */
	private function setup_constants() {

		// Plugin version.
		if ( ! defined( 'MAI_FONTS_VERSION' ) ) {
			define( 'MAI_FONTS_VERSION', '0.1.0' );
		}

		// Plugin Folder Path.
		if ( ! defined( 'MAI_FONTS_PLUGIN_DIR' ) ) {
			define( 'MAI_FONTS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Includes Path.
		if ( ! defined( 'MAI_FONTS_INCLUDES_DIR' ) ) {
			define( 'MAI_FONTS_INCLUDES_DIR', MAI_FONTS_PLUGIN_DIR . 'includes/' );
		}

		// Plugin Folder URL.
		if ( ! defined( 'MAI_FONTS_PLUGIN_URL' ) ) {
			define( 'MAI_FONTS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Root File.
		if ( ! defined( 'MAI_FONTS_PLUGIN_FILE' ) ) {
			define( 'MAI_FONTS_PLUGIN_FILE', __FILE__ );
		}

		// Plugin Base Name
		if ( ! defined( 'MAI_FONTS_BASENAME' ) ) {
			define( 'MAI_FONTS_BASENAME', dirname( plugin_basename( __FILE__ ) ) );
		}

	}

	/**
	 * Include required files.
	 *
	 * @access  private
	 * @since   0.1.0
	 * @return  void
	 */
	private function includes() {
		include_once MAI_FONTS_INCLUDES_DIR . 'vendor/class-kirki-installer-section.php';
		// foreach ( glob( MAI_FONTS_INCLUDES_DIR . '*.php' ) as $file ) { include $file; }
	}

	public function setup() {
		add_action( 'plugins_loaded', array( $this, 'updater' ) );
		add_action( 'init',           array( $this, 'settings' ) );
	}

	/**
	 * Setup the updater.
	 *
	 * @uses    https://github.com/YahnisElsts/plugin-update-checker/
	 *
	 * @return  void
	 */
	public function updater() {
		if ( ! is_admin() ) {
			return;
		}
		if ( ! class_exists( 'Puc_v4_Factory' ) ) {
			require_once MAI_FONTS_INCLUDES_DIR . 'vendor/plugin-update-checker/plugin-update-checker.php'; // 4.4
		}
		$updater = Puc_v4_Factory::buildUpdateChecker( 'https://github.com/maithemewp/mai-fonts/', __FILE__, 'mai-fonts' );
	}

	/**
	 * Register the customizer settings..
	 *
	 * @return  void
	 */
	function settings() {

		if ( ! class_exists( 'Kirki' ) ) {
			return;
		}

		$config_id      = 'mai_fonts';
		$panel_id       = 'mai_fonts';
		$settings_field = 'mai_fonts';

		Kirki::add_config( $config_id, array(
			'capability'  => 'edit_theme_options',
			'option_type' => 'option',
			'option_name' => $settings_field,
		) );

		/**
		 * Mai Fonts
		 */
		Kirki::add_panel( $panel_id, array(
			'title'       => esc_attr__( 'Mai Fonts', 'mai-fonts' ),
			// 'description' => esc_attr__( '', 'mai-fonts' ),
			'priority'    => 56,
		) );

		// Defaults.
		include_once 'configs/defaults.php';

		// Navigation.
		// include_once 'configs/navigation.php';

		// Header & Footer.
		include_once 'configs/header-footer.php';

		// Content.
		// include_once 'configs/content.php';

		// WooCommerce.
		// if ( class_exists( 'WooCommerce' ) ) {
			// include_once 'configs/woocommerce.php';
		// }

	}


}

/**
 * The main function for that returns Mai_Fonts
 *
 * The main function responsible for returning the one true Mai_Fonts
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $plugin = Mai_Fonts(); ?>
 *
 * @since 0.1.0
 *
 * @return object|Mai_Fonts The one true Mai_Fonts Instance.
 */
function Mai_Fonts() {
	return Mai_Fonts::instance();
}

// Get Mai_Fonts Running.
Mai_Fonts();
