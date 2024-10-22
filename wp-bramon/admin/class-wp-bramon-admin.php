<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://bramonmeteor.org
 * @since      1.0.0
 *
 * @package    Wp_Bramon
 * @subpackage Wp_Bramon/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Bramon
 * @subpackage Wp_Bramon/admin
 * @author     Thiago Paes <thiago@bramonmeteor.org>
 */
class Wp_Bramon_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $Wp_Bramon    The ID of this plugin.
	 */
	private $Wp_Bramon;

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
	 * @param      string    $Wp_Bramon       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $Wp_Bramon, $version ) {

		$this->Wp_Bramon = $Wp_Bramon;
		$this->version = $version;

        add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Bramon_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Bramon_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->Wp_Bramon, plugin_dir_url( __FILE__ ) . 'css/wp-bramon-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Bramon_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Bramon_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->Wp_Bramon, plugin_dir_url( __FILE__ ) . 'js/wp-bramon-admin.js', array( 'jquery' ), $this->version, false );

	}

    public function create_plugin_settings_page() {
        $page_title = $this->Wp_Bramon;
        $menu_title = 'WP BRAMON';
        $capability = 'manage_options';
        $slug = 'wp-bramon-config';
        $callback = array( $this, 'plugin_settings_page_content' );

        register_setting( 'bramon-api-group', 'bramon_api_key', ['default' => 'bramon-api-secret-key'] );
        register_setting( 'bramon-api-group', 'bramon_api_pagination_limit', ['default' => 15] );

        add_submenu_page( 'options-general.php', $page_title, $menu_title, $capability, $slug, $callback );
    }

    public function plugin_settings_page_content() {
        return include_once __DIR__ . '/partials/wp-bramon-admin-display.php';
    }
}
