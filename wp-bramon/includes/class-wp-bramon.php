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
 * @author     Thiago Paes <thiago@bramonmeteor.org>
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
     * @return array
     */
	public function get_radiants() {
	    $radiants_list = file_get_contents( __DIR__  . '/../resources/radiants.txt');
	    $radiants_collection = explode(PHP_EOL, $radiants_list);
	    $radiants_final = [];

	    foreach ($radiants_collection as $radiant) {
            $tmp = explode(':', $radiant);

            $radiants_final[ $tmp[0] ] = $tmp[1];
        }

	    return $radiants_final;
    }

    /**
     * @return string
     */
    public function show_stations() {
        $radiants = (new self)->get_radiants();
	    $stations = (new Wp_Bramon_Api(get_option( 'bramon_api_key' )))->get_stations();
	    $stations = $stations['data'];

	    $list = '
        <form method="get" action="' . get_page_link(get_the_ID())  . '" class="captures_form">
            <input type="hidden" name="page_id" value="' . get_the_ID() . '">
            
            <ul class="station_list">';

	    foreach ($stations as $station) {
	        $list .= '
            <li class="check-estacao">
                <label for="station_' . $station['id'] . '">
                    <input type="checkbox" id="station_' . $station['id'] . '" name="station[]" value="' . $station['id'] . '" ' .  (array_key_exists('station', $_GET) && in_array($station['id'], $_GET['station']) ? 'checked="checked"' : '') . '> 
                    ' . $station['name'] . '
                </label>
            </li>';
        }

	    $radiants_options = '<option value=""></option>';

	    foreach ($radiants as $radiant_id => $radiant_name) {
	        $radiants_options .= '<option value="' . $radiant_id . '"' .  (array_key_exists('capture_radiant', $_GET) && $_GET['capture_radiant'] == $radiant_id ? 'selected="selected"' : '') . '>' . $radiant_id . ' - ' . $radiant_name . '</option>';
        }

	    $list .= '
            </ul>
            
            <br style="clear: both">
            
            <label for="capture_date" class="filter_bottom">
                <span>Data da captura:</span> 
                <input type="date" name="capture_date" id="capture_date" value="' . $_GET['capture_date'] . '">
            </label>
            
            <label for="capture_radiant" class="filter_bottom">
                <span>Radiante:</span> 
                <select name="capture_radiant" id="capture_radiant">' . $radiants_options . '</select>
            </label>
            
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
        global $wp;

        $filters = [];
        $page = 1;
        $limit = get_option( 'bramon_api_pagination_limit' );

        if (!empty($_GET['capture_date'])) {
            $filters['filter[captured_at]'] = $_GET['capture_date'];
        }

        if (!empty($_GET['capture_page'])) {
            $page = (int) $_GET['capture_page'];
        }

        if (!empty($_GET['capture_limit'])) {
            $limit = (int) $_GET['capture_limit'];
        }

        if (!empty($_GET['station'])) {
            foreach ($_GET['station'] as $station) {
                $filters['filter[station]'][] = $station;
            }
        }

        if (!empty($_GET['capture_radiant'])) {
            $filters['filter[class]'] = $_GET['capture_radiant'];
        }

	    $list = '<ul class="captures_list row">';

	    $captures = (new Wp_Bramon_Api(get_option( 'bramon_api_key' )))->get_captures($filters, $page, $limit);
	    $captures_list = $captures['data'];

	    foreach ($captures_list as $capture) {
            $imagem = array_filter($capture['files'], function($file) {
                return substr_count($file['filename'], 'T.jpg') !== 0;
            });
            $imagem = array_pop($imagem);

            $list .= '
            <li class="col-sm-6 col-md-3 col-lg-2">
	            <div class="bramon-captura">
	                <a href="' . str_replace('T.jpg', 'P.jpg', $imagem['url']) . '" data-lightbox="roadtrip">
	                    <img src="' . $imagem['url'] . '" alt="' . $imagem['filename'] . '">
	                </a>
	                ' . ($capture['class'] ?? '<span class="bramon-analisado">Não analisado</span>') . '<br>
	                <span class="bramon-estacao">' . $capture['station']['name'] . '</span><br> 
	                <span class="bramon-captured">' . (new DateTime($capture['captured_at']))->format('d/m/Y H:i:s') . '</span>
	            </div>
            </li>
            ';
        }

	    $list .= '</ul>';

	    $current_url = add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ) );
	    $current_url = remove_query_arg( 'capture_page', $current_url);

	    $pagination = '
	    <br style="clear: both">

        <div class="pagination">
            <nav class="navigation" role="navigation" aria-label="Posts">
                <div class="nav-links" id="capturas-pag">';
                    if ( $captures['current_page'] > 1 ) {
                        $pagination .= '<a class="previous page-numbers" href="' . add_query_arg('capture_page', 1, $current_url) . '" data-page="1">Primeira</a>
                        <a class="previous page-numbers" href="' . add_query_arg('capture_page', ($captures['current_page']-1), $current_url) . '" data-page="' . ($captures['current_page']-1) . '">&lt;</a>';
                    }
                    $pagination .= '<span aria-current="page" class="page-numbers current">' . $captures['current_page'] . '</span>';
                    if ( $captures['current_page'] < $captures['last_page'] ) {
                        $pagination .= '<a class="next page-numbers" href="' . add_query_arg('capture_page', ($captures['current_page']+1), $current_url) . '" data-page="' . ($captures['current_page']+1) . '">&gt;</a>';
                        $pagination .= '<a class="next page-numbers" href="' . add_query_arg('capture_page', ($captures['last_page']), $current_url) . '" data-page="' . $captures['last_page'] . '">Última</a>';
                    }
        $pagination .= '
                </div>
            </nav>
        </div>';

        return $list . '<br>' . $pagination;
    }
}
