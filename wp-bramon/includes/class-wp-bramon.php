<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://bramonmeteor.org
 * @since      1.0.0
 *
 * @package    Wp_Bramon
 * @subpackage Wp_Bramon/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wp_Bramon
 * @subpackage Wp_Bramon/includes
 * @author     Your Name <email@bramonmeteor.org>
 */
class Wp_Bramon {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wp_Bramon_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $Wp_Bramon    The string used to uniquely identify this plugin.
	 */
	protected $Wp_Bramon;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'Wp_Bramon_VERSION' ) ) {
			$this->version = Wp_Bramon_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->Wp_Bramon = 'wp-bramon';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Wp_Bramon_Loader. Orchestrates the hooks of the plugin.
	 * - Wp_Bramon_i18n. Defines internationalization functionality.
	 * - Wp_Bramon_Admin. Defines all hooks for the admin area.
	 * - Wp_Bramon_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-bramon-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-bramon-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-bramon-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wp-bramon-public.php';

        /**
         * The class responsible for contact the API
         */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-bramon-api.php';

		$this->loader = new Wp_Bramon_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wp_Bramon_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Wp_Bramon_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Wp_Bramon_Admin( $this->get_Wp_Bramon(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Wp_Bramon_Public( $this->get_Wp_Bramon(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_Wp_Bramon() {
		return $this->Wp_Bramon;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Wp_Bramon_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

    /**
     * @return string
     */
    public function show_stations() {
	    $stations = (new Wp_Bramon_Api(BRAMON_API_KEY))->get_stations();

	    $list = '
        <form method="get" action="' . get_permalink(get_the_ID())  . '">
            <ul class="station_list">';

	    foreach ($stations as $station) {
	        $list .= '
            <li>
                <label for="station_' . $station['id'] . '">
                    <input type="checkbox" id="station_' . $station['id'] . '" name="station[]" value="' . $station['id'] . '"> ' . $station['name'] . '
                </label>
            </li>';
        }

	    $list .= '
            </ul>
            
            <br style="clear: both">
            
            <label for="capture_date" class="capture_date">
                <input type="date" name="capture_date" id="capture_date">
            </label>
            
            <br style="clear: both">
            
            <input type="submit" value="Buscar">
        </form>
        ';

	    return $list;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function show_captures() {
	    $list = '<ul class="captures_list">';

	    $captures = (new Wp_Bramon_Api(BRAMON_API_KEY))->get_captures();
	    $captures_list = $captures['data'];

	    foreach ($captures_list as $capture) {
            $imagem = array_filter($capture['files'], function($file) {
                return preg_match('/T\.jpg$/i', $file['filename']);
            });

            if (!array_key_exists(0, $imagem) || empty($imagem)) {
                continue;
            }

            $list .= '
            <li>
                <a href="' . str_replace('T.jpg', 'P.jpg', $imagem[0]['url']) . '" target="_blank">
                    <img src="' . $imagem[0]['url'] . '" alt="' . $imagem[0]['filename'] . '">                
                </a><br>
                ' . ($capture['class'] ?? 'Não analisado') . '<br>
                ' . $capture['station']['name'] . ' <br> 
                ' . (new DateTime($capture['captured_at']))->format('d/m/Y H:i:s') . '
            </li>';
        }

	    $list .= '</ul>';

        return $list;
    }
}
