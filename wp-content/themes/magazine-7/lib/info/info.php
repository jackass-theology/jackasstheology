<?php
/**
 * Info setup
 *
 * @package Magazine 7
 */

if ( ! function_exists( 'magazine_7_details_setup' ) ) :

	/**
	 * Info setup.
	 *
	 * @since 1.0.0
	 */
	function magazine_7_details_setup() {

		$config = array(

			// Welcome content.
			'welcome-texts' => sprintf( esc_html__( 'Howdy %1$s, we would like to thank you for installing and activating %2$s theme for your precious site. All of the features provided by the theme are now ready to use; Here, we have gathered all of the essential details and helpful links for you and your better experience with %2$s. Once again, Thanks for using our theme!', 'magazine-7' ), get_bloginfo('name'), 'Magazine 7' ),

			// Tabs.
			'tabs' => array(
				'getting-started' => esc_html__( 'Getting Started', 'magazine-7' ),
				'support'         => esc_html__( 'Support', 'magazine-7' ),
				'useful-plugins'  => esc_html__( 'Useful Plugins', 'magazine-7' ),
				'demo-content'    => esc_html__( 'Demo Content', 'magazine-7' ),
				'upgrade-to-pro'  => esc_html__( 'Upgrade to Pro', 'magazine-7' ),
				),

			// Quick links.
			'quick_links' => array(
				'theme_url' => array(
					'text' => esc_html__( 'Theme Details', 'magazine-7' ),
					'url'  => 'https://afthemes.com/products/magazine-7/',
					),
				'demo_url' => array(
					'text' => esc_html__( 'View Demo', 'magazine-7' ),
					'url'  => 'https://demo.afthemes.com/magazine-7/',
					),
				'documentation_url' => array(
					'text' => esc_html__( 'View Documentation', 'magazine-7' ),
					'url'  => 'https://docs.afthemes.com/themes/magazine-7/',
					),
				'rating_url' => array(
					'text' => esc_html__( 'Rate This Theme','magazine-7' ),
					'url'  => 'https://wordpress.org/support/theme/magazine-7/reviews/#new-post',
					),
				),

			// Getting started.
			'getting_started' => array(
				'one' => array(
					'title'       => esc_html__( 'Theme Documentation', 'magazine-7' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'magazine-7' ),
					'button_text' => esc_html__( 'View Documentation', 'magazine-7' ),
					'button_url'  => 'https://docs.afthemes.com/themes/magazine-7/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
				'two' => array(
					'title'       => esc_html__( 'Static Front Page', 'magazine-7' ),
					'icon'        => 'dashicons dashicons-admin-generic',
					'description' => esc_html__( 'To achieve custom home page other than blog listing, you need to create and set static front page.', 'magazine-7' ),
					'button_text' => esc_html__( 'Static Front Page', 'magazine-7' ),
					'button_url'  => admin_url( 'customize.php?autofocus[section]=static_front_page' ),
					'button_type' => 'primary',
					),
				'three' => array(
					'title'       => esc_html__( 'Theme Options', 'magazine-7' ),
					'icon'        => 'dashicons dashicons-admin-customizer',
					'description' => esc_html__( 'Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'magazine-7' ),
					'button_text' => esc_html__( 'Customize', 'magazine-7' ),
					'button_url'  => wp_customize_url(),
					'button_type' => 'primary',
					),
				'four' => array(
					'title'       => esc_html__( 'Widgets', 'magazine-7' ),
					'icon'        => 'dashicons dashicons-welcome-widgets-menus',
					'description' => esc_html__( 'Theme uses Wedgets API for widget options. Using the Widgets you can easily customize different aspects of the theme.', 'magazine-7' ),
                    'button_text' => esc_html__( 'Widgets', 'magazine-7' ),
                    'button_url'  => admin_url('widgets.php'),
                    'button_type' => 'primary',
					),
				'five' => array(
					'title'       => esc_html__( 'Demo Content', 'magazine-7' ),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf( esc_html__( 'To import sample demo content, %1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'magazine-7' ), esc_html__( 'One Click Demo Import', 'magazine-7' ) ),
					'button_text' => esc_html__( 'Demo Content', 'magazine-7' ),
					'button_url'  => admin_url( 'themes.php?page=magazine-7-info&tab=demo-content' ),
					'button_type' => 'secondary',
					),
				'six' => array(
					'title'       => esc_html__( 'Theme Preview', 'magazine-7' ),
					'icon'        => 'dashicons dashicons-welcome-view-site',
					'description' => esc_html__( 'You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized.', 'magazine-7' ),
					'button_text' => esc_html__( 'View Demo', 'magazine-7' ),
					'button_url'  => 'https://demo.afthemes.com/magazine-7/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
				),

			// Support.
			'support' => array(
				'one' => array(
					'title'       => esc_html__( 'Contact Support', 'magazine-7' ),
					'icon'        => 'dashicons dashicons-sos',
					'description' => esc_html__( 'Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'magazine-7' ),
					'button_text' => esc_html__( 'Contact Support', 'magazine-7' ),
					'button_url'  => 'https://wordpress.org/support/theme/magazine-7/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
				'two' => array(
					'title'       => esc_html__( 'Theme Documentation', 'magazine-7' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'magazine-7' ),
					'button_text' => esc_html__( 'View Documentation', 'magazine-7' ),
					'button_url'  => 'https://docs.afthemes.com/themes/magazine-7/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
				'three' => array(
					'title'       => esc_html__( 'Child Theme', 'magazine-7' ),
					'icon'        => 'dashicons dashicons-admin-tools',
					'description' => esc_html__( 'For advanced theme customization, it is recommended to use child theme rather than modifying the theme file itself. Using this approach, you wont lose the customization after theme update.', 'magazine-7' ),
					'button_text' => esc_html__( 'Learn More', 'magazine-7' ),
					'button_url'  => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
				),

			 //Useful plugins.
			'useful_plugins' => array(
				'description' => esc_html__( 'Theme supports some helpful WordPress plugins to enhance your site. But, please enable only those plugins which you need in your site. For example, enable WooCommerce only if you are using e-commerce.', 'magazine-7' ),
				),

			 //Demo content.
			'demo_content' => array(
				'description' => sprintf( esc_html__( 'To import demo content for this theme, %1$s plugin is needed. Please make sure plugin is installed and activated. After plugin is activated, you will see Import Demo Data menu under Appearance.', 'magazine-7' ), '<a href="https://wordpress.org/plugins/one-click-demo-import/" target="_blank">' . esc_html__( 'One Click Demo Import', 'magazine-7' ) . '</a>' ),
				),

			// Upgrade content.
			'upgrade_to_pro' => array(
				'description' => esc_html__( 'If you want more advanced features then you can upgrade to the premium version of the theme.', 'magazine-7' ),
				'button_text' => esc_html__( 'Upgrade Now', 'magazine-7' ),
				'button_url'  => 'https://afthemes.com/products/magazine-7-plus/',
				'button_type' => 'primary',
				'is_new_tab'  => true,
				),
			);

		Magazine_7_Info::init( $config );
	}

endif;

add_action( 'after_setup_theme', 'magazine_7_details_setup' );