<?php

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
 */
class Rgsg_Plugin {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

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
		if ( defined( 'RGSG_VERSION' ) ) {
			$this->version = RGSG_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'regenerate-slug';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_hook_or_initialize();

	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
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
	 * Define the locale for this plugin for internationalization.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

	}
	
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'regenerate-slug',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

	/**
	 * Include files.
	 *
	 * @return void
	 */
	private function load_dependencies() {

	}

	/**
	 * Defines hook or initializes any class.
	 *
	 * @return void
	 */
	public function define_hook_or_initialize() {

		//Admin enqueue script
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );

		add_filter( 'get_sample_permalink_html', array($this, 'add_regenerate_button'), 10, 5 );
	}



	/**
	 * Adds regenerate button beside edit slug button.
	 *
	 * @param string  $html    Sample permalink HTML markup.
	 * @param int     $post_id   Post ID.
	 * @param string  $new_title New sample permalink title.
	 * @param string  $new_slug  New sample permalink slug.
	 * @param WP_Post $post      Post object.
	 */
	public function add_regenerate_button($html, $post_id, $new_title, $new_slug, $post) {
		$regex = '/<button.*class="edit-slug.*<\/button>/';
		$found = preg_match($regex, $html, $matched);
		if ( $found && is_array($matched) && count($matched) ) {

			return preg_replace($regex, $matched[0].'<button style="margin-left: 5px;" type="button" class="button button-small regen-slug">'.esc_html__( 'Regenerate', 'regenerate-slug' ).'</button>', $html);
		}
		
		return $html;
	}

	/**
	 * Enqueue admin assets.
	 *
	 * @return void
	 */
	public function admin_scripts() {
		wp_enqueue_script( 'regenerate-slug-admin', RGSG_ASSETS_URL . 'dist/js/admin.min.js', array( 'jquery' ), RGSG_ASSETS_VERSION, true );
		wp_enqueue_style( 'regenerate-slug-admin', RGSG_ASSETS_URL . 'dist/css/admin.min.css', array(), RGSG_ASSETS_VERSION );
	}

}
