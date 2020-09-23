<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://bramonmeteor.org
 * @since      1.0.0
 *
 * @package    Wp_Bramon
 * @subpackage Wp_Bramon/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Bramon
 * @subpackage Wp_Bramon/public
 * @author     Thiago Paes <thiago@bramonmeteor.org>
 */
class Wp_Bramon_Public {

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
	 * @param      string    $Wp_Bramon       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $Wp_Bramon, $version ) {

		$this->Wp_Bramon = $Wp_Bramon;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->Wp_Bramon, plugin_dir_url( __FILE__ ) . 'css/wp-bramon-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->Wp_Bramon, plugin_dir_url( __FILE__ ) . 'css/lightbox.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->Wp_Bramon, plugin_dir_url( __FILE__ ) . 'js/wp-bramon-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->Wp_Bramon, plugin_dir_url( __FILE__ ) . 'js/lightbox.js', array( 'jquery' ), $this->version, false );

	}

}
