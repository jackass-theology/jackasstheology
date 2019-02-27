<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://jasonyingling.me
 * @since      1.0.0
 *
 * @package    Easy_Pull_Quotes
 * @subpackage Easy_Pull_Quotes/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Easy_Pull_Quotes
 * @subpackage Easy_Pull_Quotes/admin
 * @author     Jason Yingling <yingling017@gmail.com>
 */
class Easy_Pull_Quotes_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

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
		 * defined in Easy_Pull_Quotes_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Easy_Pull_Quotes_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/easy-pull-quotes-admin.css', array(), $this->version, 'all' );

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
		 * defined in Easy_Pull_Quotes_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Easy_Pull_Quotes_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

	}


	function epq_add_tinymce_button() {
	    // check user permissions
	    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
	    	return;
	    }
	    // check if WYSIWYG is enabled
	    if ( get_user_option('rich_editing') == 'true') {
	        add_filter('mce_external_plugins', array( $this, 'epq_add_tinymce_plugin' ));
	        add_filter('mce_buttons', array( $this, 'epq_register_tinymce_button' ));
	    }
	}

	function epq_add_tinymce_plugin($plugin_array) {
	    $plugin_array['epq_tinymce_button'] = plugins_url( 'js/easy-pull-quotes-tinymce.js', __FILE__ ); // CHANGE THE BUTTON SCRIPT HERE
	    return $plugin_array;
	}

	function epq_register_tinymce_button($buttons) {
		array_push($buttons, 'epq_tinymce_button');
		return $buttons;
	}

}
