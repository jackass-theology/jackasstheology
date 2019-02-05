<?php
/**
 * Created by ra.
 * Date: 4/14/2016
 */


// Ready to load the shortcodes
require_once('tdc_util.php');
require_once('tdc_state.php');
require_once('tdc_ajax.php');
require_once('tdc_guttenberg.php');

if ( tdc_guttenberg::is_gutenberg() or substr( get_bloginfo('version'), 0, 1) > 4 )
    new tdc_guttenberg();

// shortcodes
require_once('tdc_composer_block.php' );
require_once('shortcodes/vc_row.php' );
require_once('shortcodes/vc_row_inner.php' );
require_once('shortcodes/vc_column.php' );
require_once('shortcodes/vc_column_inner.php' );
require_once('shortcodes/vc_column_text.php' );
require_once('shortcodes/vc_raw_html.php' );
require_once('shortcodes/vc_empty_space.php' );
require_once('shortcodes/vc_widget_sidebar.php' );
require_once('shortcodes/vc_single_image.php' );
require_once('shortcodes/vc_separator.php' );
require_once('shortcodes/vc_wp_recentcomments.php' );



// mapper and internal map
require_once('tdc_mapper.php');
require_once('tdc_map.php');



/**
 * WP-admin - Edit page with tagDiv composer
 */
add_action('admin_bar_menu', 'tdc_on_admin_bar_menu', 100);
function tdc_on_admin_bar_menu() {
	global $wp_admin_bar, $post;

    $is_bbpress = $is_buddypress = false;

    // bbpress
    if ( is_plugin_active( 'bbpress/bbpress.php') ) {
        if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
            $is_bbpress = true;
        }
    }

    // buddypress
    if ( is_plugin_active( 'buddypress/bp-loader.php') ) {
        if ( function_exists( 'is_buddypress' ) && is_buddypress() ) {
            $is_buddypress = true;
        }
    }

	if (
	        is_user_logged_in() &&
            current_user_can('publish_pages') &&
            is_admin_bar_showing() &&
            is_page() &&
            ! $is_bbpress &&
            ! $is_buddypress
    ) {
	    $wp_admin_bar->add_menu( array(
            'id'    => 'tdc_edit',
            'meta'  => array(
                'title' => 'Edit with TD Composer'
            ),
            'title' => 'Edit with TD Composer',
            'href'  => admin_url( 'post.php?post_id=' . $post->ID . '&td_action=tdc&tdbTemplateType=page&prev_url=' . rawurlencode( tdc_util::get_current_url() ) )
        ) );
	}
}



// Set the tdc_state
$tdcPageSettings = tdc_util::get_get_val( 'tdc-page-settings' );
if ( 'post' === basename($_SERVER["SCRIPT_FILENAME"], '.php') && false !== $tdcPageSettings ) {
	add_action('admin_head', 'on_admin_head_add_page_settings');
	function on_admin_head_add_page_settings() {
		?>
		<style>
			#wpcontent {
			    margin-left: 0;
				margin-top: -30px;
			}

			#nav-menus-frame {
				margin-top: 0;
			}

			#wpadminbar,
			#screen-meta,
			#screen-meta-links,
			#adminmenumain,
			#wpfooter,
			.wrap > h1,
			.wrap > h2,
			.wrap > .manage-menus,
			.menu-save,
			.delete-action,
			.error,
			.update-nag,
			.major-publishing-actions,

			.page-title-action,
			.notice,
			#submitdiv,
			#postimagediv,
			#post-body-content,

            #td_mobile_wp_editor_content_meta_box,

            .edit-post-visual-editor,
            .edit-post-header,
            .edit-post-layout .components-notice-list,
            .edit-post-layout .components-panel__header,
            .edit-post-layout .components-panel__body.edit-post-post-status,
            .edit-post-layout .components-panel__body.edit-post-last-revision__panel {
				display: none !important;
			}

			#wpbody-content {
				padding-bottom: 0;
			}

            .edit-post-layout {
                padding-top: 0 !important;
            }

            .edit-post-sidebar {
                top: 0;
            }


		</style>

		<script>
			(function(){

				jQuery(window).load(function() {
					var $wpbodyContent = jQuery( '#wpbody-content' ),
						$wrap = $wpbodyContent.children( '.wrap' ),
						$normalSortables = $wpbodyContent.find( '#normal-sortables' );


					$wrap.siblings().hide();
					$wrap.children( 'form' ).siblings().hide();

					$normalSortables.children().each(function(index, el) {
						var $el = jQuery(el),
							elId = $el.attr( 'id' );

						if ( 'td_homepage_loop_metabox' !== elId && 'td_page_metabox' !== elId ) {
							$el.hide();
						}
					});

				});

			})();
		</script>
		<?php

//		// Disables all the updates notifications regarding plugins, themes & WordPress completely.
//		tdc_disable_notification();
	}
}





// Set the tdc_state
$tdcMenuSettings = tdc_util::get_get_val( 'tdc-menu-settings' );
if ( 'nav-menus' === basename($_SERVER["SCRIPT_FILENAME"], '.php') && false !== $tdcMenuSettings ) {
	add_action('admin_head', 'on_admin_head_add_menu_settings');
	function on_admin_head_add_menu_settings() {
		?>
		<style>
			#wpcontent {
			    margin-left: 0;
				margin-top: -30px;
			}

			#nav-menus-frame {
				margin-top: 0;
			}

			#wpadminbar,
			#screen-meta,
			#screen-meta-links,
			#screen-options-link-wrap,
			#adminmenumain,
			#wpfooter,
			.wrap > h1,
			.wrap > h2,
			.wrap > .manage-menus,
			.menu-save,
			.delete-action,
			.error,
			.update-nag,
			.major-publishing-actions,
			.menu-settings {
				display: none !important;
			}

			#wpbody-content {
				padding-bottom: 0;
			}

		</style>

		<script>
			(function(){

				jQuery(window).load(function() {
					var $wpbodyContent = jQuery( '#wpbody-content' );
						$wrap = $wpbodyContent.children( '.wrap' );


					$wrap.siblings().hide();

					$wrap.children().each(function(index, el) {
						var $el = jQuery(el),
							elId = $el.attr( 'id' );
						if ( 'nav-menus-frame' !== elId ) {
							$el.hide();
						}
					});

				});

			})();
		</script>
		<?php

		// Disables all the updates notifications regarding plugins, themes & WordPress completely.
		tdc_disable_notification();
	}
}





/**
 * edit with td composer
 */
if ( is_user_logged_in() && current_user_can('publish_pages') && 'page' === tdc_util::get_get_val('post_type') ) {
	add_filter( 'page_row_actions', 'tdc_on_page_row_actions', 10, 2 );
	function tdc_on_page_row_actions( $actions, $post ) {
	    if ( $post->ID === (int) get_option( 'page_for_posts' ) ) {
	        $actions['edit_tdc_composer'] = '<a href="#">TD Composer is disabled on Posts Page</a>';
	    } else {
	        $actions['edit_tdc_composer'] = '<a href="' . admin_url( 'post.php?post_id=' . $post->ID . '&td_action=tdc&tdbTemplateType=page&prev_url='  . rawurlencode(tdc_util::get_current_url()) ) . '">Edit with TD Composer</a>';
        }
		return $actions;
	}
}




/**
 * Disables all the updates notifications regarding plugins, themes & WordPress completely.
 */
function tdc_disable_notification() {
	add_filter( 'pre_site_transient_update_core','tdc_on_remove_core_updates' );
	add_filter( 'pre_site_transient_update_plugins','tdc_on_remove_core_updates' );
	add_filter( 'pre_site_transient_update_themes','tdc_on_remove_core_updates' );

	function tdc_on_remove_core_updates(){
		global $wp_version;
		return (object) array('last_checked'=> time(),'version_checked'=> $wp_version);
	}
}



// Remove the auto added paragraphs - as VC does
// Important! Remove from 'page' and from 'tdb_templates' (custom post type used by template builder)
add_filter( 'the_content', 'tdc_on_remove_wpautop', 9 );
function tdc_on_remove_wpautop($content) {
	global $post;
	if ( ( 'page' === get_post_type() || 'tdb_templates' === get_post_type() ) && td_util::is_pagebuilder_content( $post ) ) {
		remove_filter( 'the_content', 'wpautop' );
	}
	return $content;
}






/**
 * load font icons
 */
add_action( 'wp_enqueue_scripts', 'tdc_on_load_font_icon' ); // load them last
function tdc_on_load_font_icon() {

	$icon_fonts = array();

	// Filter used to modify the post checked for icon fonts
	$post_id = apply_filters( 'tdc_filter_icon_fonts_post_id', get_the_ID() );

	$post_icon_fonts = get_post_meta( $post_id, 'tdc_icon_fonts', true );

//	echo '<pre>';
//	var_dump($tdc_icon_fonts);
//	echo '</pre>';

	if ( ! empty( $post_icon_fonts ) && is_array( $post_icon_fonts ) ) {
		foreach ( $post_icon_fonts as $font_id => $font_settings ) {
			$icon_fonts[ $font_id ] = $font_settings;
		}
	}

	// Get font icons for footer

	$tds_footer_page = td_util::get_option('tds_footer_page');
	if ( intval($tds_footer_page) !== $post_id ) {
		$footer_icon_fonts = get_post_meta( $tds_footer_page, 'tdc_icon_fonts', true );

		if ( ! empty( $footer_icon_fonts ) && is_array( $footer_icon_fonts ) ) {
			foreach ( $footer_icon_fonts as $font_id => $font_settings ) {
				if ( ! isset( $icon_fonts[ $font_id ] ) ) {
					$icon_fonts[ $font_id ] = $font_settings;
				}
			}
		}
	}

	foreach ( $icon_fonts as $font_id => $font_settings ) {
		if ( isset( $font_settings['theme_font'] ) ) {
			continue;
		}
		wp_enqueue_style( $font_id, TDC_URL . $font_settings['css_file'], false, TD_COMPOSER );
	}
}



// Set the tdc_state
$td_action = tdc_util::get_get_val( 'td_action' );
if ( false === $td_action ) {
	tdc_state::set_is_live_editor_iframe( false );
} else {
	tdc_state::set_is_live_editor_iframe( true );
}

$tmpJobId = tdc_util::get_get_val( 'uuid' );
if ( false === $tmpJobId ) {
	tdc_state::set_is_live_editor_ajax( false );
} else {
	tdc_state::set_is_live_editor_ajax( true );
}




if ( ! tdc_state::is_live_editor_iframe() && ! tdc_state::is_live_editor_ajax() ) {

	// All hooks necessary for tdb

	add_action( 'admin_head', 'tdc_on_admin_head_for_tbm' );
	function tdc_on_admin_head_for_tbm() {

	    $is_page_for_posts = false;

	    global $post;
	    if ( ! is_null( $post )) {
	        $is_page_for_posts = $post->ID == get_option( 'page_for_posts' );
        }

		$tdc_admin_settings = array(
			'adminUrl' => admin_url(),
			'hasUserRights' => is_user_logged_in() && current_user_can('publish_pages'),
            'isPageForPosts' => $is_page_for_posts,
		);

		ob_start();
		?>
		<script>
			window.tdcAdminSettings = <?php echo json_encode( $tdc_admin_settings );?>;
			//console.log(window.tdcAdminSettings);
		</script>
		<?php
		$buffer = ob_get_clean();
		echo $buffer;
	}


	add_action( 'admin_enqueue_scripts', 'tdc_on_admin_enqueue_scripts_for_tbm' );
	function tdc_on_admin_enqueue_scripts_for_tbm() {

		// load the css
		if ( true === TDC_USE_LESS ) {
			wp_enqueue_style('tdc_wp_admin_main', TDC_URL . '/td_less_style.css.php?part=tdc_wp_admin_main', false, TD_COMPOSER );
		} else {
			wp_enqueue_style('tdc_wp_admin_main', TDC_URL . '/assets/css/tdc_wp_admin_main.css', false, TD_COMPOSER);
		}

		// load the js
	    if (TDC_DEPLOY_MODE == 'deploy') {
	        wp_enqueue_script('js_files_for_wp_admin', TDC_URL . '/assets/js/js_files_for_wp_admin.min.js', array('jquery', 'underscore'), TD_COMPOSER, true);
	    } else {
	        tdc_util::enqueue_js_files_array(tdc_config::$js_files_for_wp_admin, array('jquery', 'underscore'));
	    }
	}

	return;
}











// DO NOT CONTINUE IF COMPOSER IS NOT LIVE OR IN AJAX




/**
 * WP-admin - add js in header on all the admin pages (wp-admin and the iframe Wrapper. Does not run in the iframe)
 * It's on general, and not only for 'td-action=tdc' because it's also used on widgets' page.
 */
add_action( 'admin_head', 'tdc_on_admin_head' );
function tdc_on_admin_head() {

	//map_not_registered_shortcodes();

	$mappedShortcodes = tdc_mapper::get_mapped_shortcodes();
	$mappedBlockTemplates = tdc_mapper::get_mapped_block_templates();

	global $wp_registered_sidebars;

	foreach ( $mappedShortcodes as &$mappedShortcode ) {

		if ( 'vc_widget_sidebar' === $mappedShortcode[ 'base' ] ) {
			foreach ( $mappedShortcode[ 'params' ] as &$param ) {
				if ( 'sidebar_id' === $param[ 'param_name' ] ) {

					$param[ 'value' ][ __( '- Please select a sidebar -', 'td_composer' ) ] = '';

					foreach ( $wp_registered_sidebars as $key => $val ) {
						$param[ 'value' ][ $val[ 'name' ] ] = $key;
					}
					break;
				}
			}
			continue;
		}

		// Replace the 'dropdown' params values with values of the 'tdc_value' index (because VC does not render well default values of dropdown params)
		if ( 'td_block_instagram' === $mappedShortcode[ 'base' ] ||
			 'td_block_exchange' === $mappedShortcode[ 'base' ] ) {
			foreach ( $mappedShortcode[ 'params' ] as &$param ) {
				if ( 'dropdown' === $param[ 'type' ] && isset($param['tdc_value'] ) ) {

					$param['value'] = $param['tdc_value'];
				}
			}
			continue;
		}
	}

	$globalStyle = array();
	$settingsStyle = array();

	$groups = array();

	foreach ( td_api_style::get_all() as $style_id => $style ) {
		$group_style = $style['group'];
		if ( ! in_array( $group_style, $groups ) ) {
			$groups[] = $group_style;

			$settingsStyle[ $group_style ] = td_api_style::get_styles_by_group( $group_style );
			$globalStyle[ $group_style ] = td_options::get( $group_style, $style_id );
		}
	}

	// the settings that we load in wp-admin and wrapper. We need json to be sure we don't get surprises with the encoding/escaping




    // save the previous url - used when the X in composer is pressed to close it down.
    if (tdc_util::get_get_val('prev_url') != '') {
        $previous_url = htmlspecialchars_decode ( tdc_util::get_get_val('prev_url') );
    } else {
        $previous_url = get_edit_post_link(get_the_ID(), '');
    }

	$mappedFontFamily = array();
	$mappedFontWeight = array();
	$mappedFontTransform = array();
	$mappedFontStyle = array();

	foreach ( $mappedShortcodes as &$element ) {

		foreach ( $element['params'] as &$param ) {
			if ( strpos( $param['param_name'], 'font_family' ) > 0 ) {
				if ( empty( $mappedFontFamily ) ) {
					$mappedFontFamily = $param['value'];
				}
				$param['value'] = '';

			} else if ( strpos( $param['param_name'], 'font_weight' ) > 0 ) {
				if ( empty( $mappedFontWeight ) ) {
					$mappedFontWeight = $param['value'];
				}
				$param['value'] = '';

			} else if ( strpos( $param['param_name'], 'font_transform' ) > 0 ) {
				if ( empty( $mappedFontTransform ) ) {
					$mappedFontTransform = $param['value'];
				}
				$param['value'] = '';

			} else if ( strpos( $param['param_name'], 'font_style' ) > 0 ) {
				if ( empty( $mappedFontStyle ) ) {
					$mappedFontStyle = $param['value'];
				}
				$param['value'] = '';
			}
		}
	}

	foreach ( $settingsStyle as &$group ) {

		foreach ( $group as &$element ) {

			foreach ( $element['params'] as &$param ) {
				if ( strpos( $param['param_name'], 'font_family' ) > 0 ) {
					if ( empty( $mappedFontFamily ) ) {
						$mappedFontFamily = $param['value'];
					}
					$param['value'] = '';

				} else if ( strpos( $param['param_name'], 'font_weight' ) > 0 ) {
					if ( empty( $mappedFontWeight ) ) {
						$mappedFontWeight = $param['value'];
					}
					$param['value'] = '';

				} else if ( strpos( $param['param_name'], 'font_transform' ) > 0 ) {
					if ( empty( $mappedFontTransform ) ) {
						$mappedFontTransform = $param['value'];
					}
					$param['value'] = '';

				} else if ( strpos( $param['param_name'], 'font_style' ) > 0 ) {
					if ( empty( $mappedFontStyle ) ) {
						$mappedFontStyle = $param['value'];
					}
					$param['value'] = '';
				}
			}
		}
	}


	$tdc_admin_settings = array(
		'adminUrl' => admin_url(),
        'ABSPATH' => ABSPATH,
		'editPostUrl' => get_edit_post_link( get_the_ID(), '' ),
		'previousUrl' => $previous_url, //this is uesd to redirect to the previous url when the composer is closed
		'wpRestNonce' => wp_create_nonce('wp_rest'),
		'wpRestUrl' => rest_url(),
		'permalinkStructure' => get_option('permalink_structure'),
		'pluginUrl' => TDC_URL,
		'themeName' => TD_THEME_NAME,

		'mappedShortcodes' => $mappedShortcodes, // get ALL the mapped shortcodes / we should turn off pretty print

		'mappedFontFamily' => $mappedFontFamily,
		'mappedFontWeight' => $mappedFontWeight,
		'mappedFontTransform' => $mappedFontTransform,
		'mappedFontStyle' => $mappedFontStyle,

		'mappedBlockTemplates' => $mappedBlockTemplates, // get ALL the mapped block templates / we should turn off pretty print
		'customized' => array(
			'menus' => new stdClass()
		),
		'globalBlockTemplate' => td_options::get('tds_global_block_template', 'td_block_template_1'),
		'globalStyle' => $globalStyle,
		'settingsStyle' => $settingsStyle,
		'registeredSidebars' => $GLOBALS['wp_registered_sidebars'],
		'hasUserRights' => is_user_logged_in() && current_user_can('publish_pages'),
		'tdcSavings' => td_util::get_option( 'tdc_savings' ),
		'deployMode' => TDC_DEPLOY_MODE,
	);

	echo '<script>window.tdcAdminSettings = ' . json_encode( $tdc_admin_settings ) . '</script>';

	ob_start();
	?>
	<script>

		for ( var shortcode in window.tdcAdminSettings.mappedShortcodes ) {
			var params = window.tdcAdminSettings.mappedShortcodes[shortcode].params;
			for ( var param in params ) {

				if ( params[param].param_name.indexOf( 'font_family' ) > 0 && '' === params[param]['value'] ) {
					params[param]['value'] = window.tdcAdminSettings.mappedFontFamily;
				} else if ( params[param].param_name.indexOf( 'font_weight' ) > 0 && '' === params[param]['value'] ) {
					params[param]['value'] = window.tdcAdminSettings.mappedFontWeight;
				} else if ( params[param].param_name.indexOf( 'font_transform' ) > 0 && '' === params[param]['value'] ) {
					params[param]['value'] = window.tdcAdminSettings.mappedFontTransform;
				} else if ( params[param].param_name.indexOf( 'font_style' ) > 0 && '' === params[param]['value'] ) {
					params[param]['value'] = window.tdcAdminSettings.mappedFontStyle;
				}
			}
		}

		for ( var group in window.tdcAdminSettings.settingsStyle ) {
			for ( var style in window.tdcAdminSettings.settingsStyle[group] ) {
				var params = window.tdcAdminSettings.settingsStyle[group][style].params;
				for (var param in params) {

					if (params[param].param_name.indexOf('font_family') > 0 && '' === params[param]['value']) {
						params[param]['value'] = window.tdcAdminSettings.mappedFontFamily;
					} else if (params[param].param_name.indexOf('font_weight') > 0 && '' === params[param]['value']) {
						params[param]['value'] = window.tdcAdminSettings.mappedFontWeight;
					} else if (params[param].param_name.indexOf('font_transform') > 0 && '' === params[param]['value']) {
						params[param]['value'] = window.tdcAdminSettings.mappedFontTransform;
					} else if (params[param].param_name.indexOf('font_style') > 0 && '' === params[param]['value']) {
						params[param]['value'] = window.tdcAdminSettings.mappedFontStyle;
					}
				}
			}
		}


		// Code necessary to supply some vc functionality that VC does not register when tagDiv composer runs as frontend editor
		window.vc_user_access = function() {
		    return {
				editor: function ( editor ) {
					return false;
				},
				partAccess: function ( editor ) {
					return false;
				},
				check: function ( part, rule, custom, not_check_state ) {
					return false;
				},
				getState: function ( part ) {
					return false;
				},
				shortcodeAll: function ( shortcode ) {
					return false;
				},
				shortcodeEdit: function ( shortcode ) {
					return false;
				},
				shortcodeValidateOldMethod: function ( shortcode ) {
					return false;
				},
				updateMergedCaps: function ( rule ) {
					return false;
				}
			};
        };
		//console.log(window.tdcAdminSettings);
	</script>
	<?php
	$buffer = ob_get_clean();
	echo $buffer;
}


// Code necessary to remove some vc functionality that interfere with tagDiv composer
if ( class_exists( 'Vc_Manager' ) && method_exists( 'Vc_Manager', 'getInstance' ) ) {
    $vc_instance = Vc_Manager::getInstance();

    remove_action( 'init', array(
        $vc_instance,
        'init',
    ), 9 );
}


add_action( 'after_setup_theme', 'tdc_on_register_external_shortcodes' );
function tdc_on_register_external_shortcodes() {

	if ( tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax() ) {
		register_external_shortcodes();
	} else {
		wrap_external_shortcodes();
	}
}




/**
 * Registers the js script:
 */
add_action( 'admin_enqueue_scripts', 'tdc_on_admin_enqueue_scripts' );
function tdc_on_admin_enqueue_scripts() {

	// load the css
	if ( true === TDC_USE_LESS ) {
		wp_enqueue_style('tdc_wp_admin_main', TDC_URL . '/td_less_style.css.php?part=tdc_wp_admin_main', false, TD_COMPOSER );
	} else {
		wp_enqueue_style('tdc_wp_admin_main', TDC_URL . '/assets/css/tdc_wp_admin_main.css', false, TD_COMPOSER);
	}



	// load the js
    if (TDC_DEPLOY_MODE == 'deploy') {
        wp_enqueue_script('js_files_for_wp_admin', TDC_URL . '/assets/js/js_files_for_wp_admin.min.js', array('jquery', 'underscore'), TD_COMPOSER, true);
    } else {
        tdc_util::enqueue_js_files_array(tdc_config::$js_files_for_wp_admin, array('jquery', 'underscore'));
    }

	// Disable the confirmation messages at leaving pages
	if ( tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax() ) {
		wp_dequeue_script( 'autosave' );
		wp_deregister_script( 'ace-editor' );
	}



//remove_action( 'vc-settings-render-tab-vc-custom_css', 'vc_page_settings_custom_css_load' );

}


if (!empty($td_action)) {

	// $_GET['post_id'] is requiered from now on
	$post_id = tdc_util::get_get_val( 'post_id' );
	if (empty($post_id)) {
	    echo 'No post_id received via GET';
		die;
	}


	switch ($td_action) {

		case 'tdc':
			// Wrapper edit page
			$current_post = get_post($post_id);
			do_action_ref_array( 'the_post', array( &$current_post ) );

			tdc_state::set_post($current_post);



			/**
			 *  on wrap body class
			 */
			add_filter( 'admin_body_class', 'on_admin_body_class_wrap');
			function on_admin_body_class_wrap( $classes ) {
			    $classes .= ' tdc';

			    global $post;
			    $current_post_type = get_post_type( $post );
			    $tdbTemplateType = tdc_util::get_get_val('tdbTemplateType');

			    if ( false !== $tdbTemplateType ) {
                    $current_post_type = $tdbTemplateType;
                }

                $classes .= ' tdb-template-type-' . $current_post_type;

				return $classes;
			}


			/**
			 * on wrapper current_screen
			 */
			add_action( 'current_screen', 'on_current_screen_load_wrap');
			function on_current_screen_load_wrap() {

				// @todo The 'tiny_mce' doesn't work as dependency. That's why it was independently loaded
				wp_enqueue_script( 'tiny_mce', includes_url( '/js/tinymce/tinymce.min.js' ) );
				//wp_enqueue_script( 'tiny_mce', '//tinymce.cachefly.net/4.1/tinymce.min.js' );



                if (TDC_DEPLOY_MODE == 'deploy') {
                    wp_enqueue_script('js_files_for_wrapper', TDC_URL . '/assets/js/js_files_for_wrapper.min.js', array(
                        'jquery',
                        'backbone',
                        'underscore',
	                    'shortcode' // the parser depends of wp.shortcode (shortcode.js wp file)
                    ), TD_COMPOSER, true);
                } else {
                    tdc_util::enqueue_js_files_array(tdc_config::$js_files_for_wrapper, array(
                        'jquery',
                        'backbone',
                        'underscore',
	                    'shortcode' // the parser depends of wp.shortcode (shortcode.js wp file)
                    ));
                }

				if ( true === TDC_USE_LESS ) {
					wp_enqueue_style('td_composer_edit', TDC_URL . '/td_less_style.css.php?part=wrap_main', false, TD_COMPOSER);
				} else {
					wp_enqueue_style('td_composer_edit', TDC_URL . '/assets/css/wrap_main.css', false, TD_COMPOSER);
				}


				remove_all_actions('admin_notices');
				remove_all_actions('network_admin_notices');

				// Disables all the updates notifications regarding plugins, themes & WordPress completely.
				tdc_disable_notification();

				require_once('templates/frontend.tpl.php');
				die;
			}

			/**
			 * admin enqueue scripts
			 */
			add_action( 'admin_enqueue_scripts', 'on_admin_enqueue_scripts'); // load them last
			function on_admin_enqueue_scripts() {
				foreach ( tdc_config::$font_settings as $font_id => $font_settings ) {

					if ( $font_id === 'font_newspaper' && 'Newsmag' === TD_THEME_NAME ) {
						continue;
					}

					if ( isset( $font_settings['theme_font'] ) ) {
						wp_enqueue_style( $font_id, get_stylesheet_directory_uri() . $font_settings['css_file'], false, TD_THEME_VERSION );
						continue;
					}

					wp_enqueue_style( $font_id, TDC_URL . $font_settings['css_file'], false, TD_COMPOSER );

					$file_path = plugin_dir_path( __FILE__ ) . 'templates/' . $font_settings['template_file'];
					$handle_file = fopen( $file_path, 'w+');

					//check response
			        if ( $handle_file !== false && filesize( $file_path ) ) {
				        $response[ $font_id ]['output'] = fread( $handle_file, filesize( $file_path ) );
				        fclose( $handle_file );
			        } else {
				        switch ( $font_settings['name'] ) {
					        case 'Font Awesome':
					        case 'Typicons':
					        case 'Open Iconic':
					        case 'tagDiv Multi-purpose':

						        $json_font_response = td_remote_http::get_page( TDC_URL . $font_settings['css_file'], __CLASS__);

								if ( false === $json_font_response ) {
									td_log::log(__FILE__, __FUNCTION__, 'Failed to get font icons', $json_font_response);
								} else {
									preg_match_all("/\.tdc-font-" . $font_settings['family_class'] . "-(.*)\:before/", $json_font_response, $output_array);

									if ( is_array( $output_array ) && count( $output_array ) ) {
								        $response[$font_id]['classes'] = $output_array[1];

								        $span_icons = '';

								        foreach ( $response[$font_id]['classes'] as $font_class ) {
									        $css_class = 'tdc-font-' . $font_settings['family_class'] . ' tdc-font-' . $font_settings['family_class'] . '-' . $font_class;
									        $span_icons .= '<span data-font_class="' . $css_class . '"><i class="' . $css_class . '"></i></span>' . PHP_EOL;
								        }
										fwrite( $handle_file , $span_icons );
										clearstatcache();
										fclose( $handle_file );
							        }
								}
					        break;
				        }
			        }
				}
			}

			break;


		case 'tdc_edit':

			// Iframe content post
			add_filter( 'show_admin_bar', '__return_false' );

			add_filter( 'body_class', 'tdc_on_body_class' );
			function tdc_on_body_class( $classes ) {
				$classes[] = 'tdc-theme-' . TD_THEME_NAME;
				return $classes;
			}

			add_filter( 'the_content', 'tdc_on_the_content', 10000, 1 );
			function tdc_on_the_content( $content ) {

				if ( isset( $_POST['tdc_content'] ) ) {

					//echo $_POST['tdc_content'];die;
					//return $_POST['tdc_content'];
					return do_shortcode( stripslashes ( $_POST['tdc_content'] ) );
				}

				return $content;
			}

			add_filter( 'get_post_metadata', 'tdc_on_get_post_metadata', 10, 4 );
			function tdc_on_get_post_metadata( $value, $object_id, $meta_key, $single ) {

				tdc_state::set_customized_settings();

				if ( 'td_mega_menu_cat' === $meta_key || 'td_mega_menu_page_id' === $meta_key ) {
					// Look inside of the customized menu settings

					$customized_menu_settings = tdc_state::get_customized_menu_settings();

					if ( false !== $customized_menu_settings ) {
						foreach ( $customized_menu_settings as $key_menu_settings => $value_menu_settings ) {
							if ( isset($value_menu_settings[ $meta_key .'[' . $object_id . ']' ] ) ) {
								return $value_menu_settings[ $meta_key .'[' . $object_id . ']' ];
							}
						}
					}

				} else if ( 'td_homepage_loop' === $meta_key || 'td_page' === $meta_key ) {
					// Look inside of the customized page settings

					$customized_page_settings = tdc_state::get_customized_page_settings();

					if ( false !== $customized_page_settings ) {
						return array( $customized_page_settings[ $meta_key ] );
					}

				} else if ( '_wp_page_template' === $meta_key ) {
					$customized_page_settings = tdc_state::get_customized_page_settings();

					if ( false !== $customized_page_settings ) {
						return array( $customized_page_settings[ 'page_template' ] );
					}
				}
				return $value;
			}

			add_filter( 'wp_get_nav_menu_items', 'tdc_on_wp_get_nav_menu_items', 10, 3 );
			function tdc_on_wp_get_nav_menu_items( $items, $menu, $args ) {

				//var_dump($menu);

				tdc_state::set_customized_settings();
				$menu_settings = tdc_state::get_customized_menu_settings( $menu->term_id );

				if ( false !== $menu_settings ) {

					//var_dump($menu_settings);
					//return $items;

					$new_items = array();

					foreach ( $menu_settings as $key => $value) {

						if ( 0 === strpos( $key, 'menu-item-db-id' ) ) {

							$item = new stdClass();

							$item->ID = $value;
							$item->post_type = 'nav_menu_item';

							if ( isset($menu_settings[ "menu-item-object-id[$value]" ] ) ) {
								$item->object_id = $menu_settings[ "menu-item-object-id[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-object[$value]" ] ) ) {
								$item->object = $menu_settings[ "menu-item-object[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-parent-id[$value]" ] ) ) {
								$item->menu_item_parent = $menu_settings[ "menu-item-parent-id[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-type[$value]" ] ) ) {
								$item->type = $menu_settings[ "menu-item-type[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-title[$value]" ] ) ) {
								$item->title = $menu_settings[ "menu-item-title[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-url[$value]" ] ) ) {
								$item->url = $menu_settings[ "menu-item-url[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-title[$value]" ] ) ) {
								$item->title = $menu_settings[ "menu-item-title[$value]" ];
								$item->post_title = $item->title;
							}

							if ( isset($menu_settings[ "menu-item-attr-title[$value]" ] ) ) {
								$item->attr_title = $menu_settings[ "menu-item-attr-title[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-description[$value]" ] ) ) {
								$item->description = $menu_settings[ "menu-item-description[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-classes[$value]" ] ) ) {
								$item->classes = $menu_settings[ "menu-item-classes[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-xfn[$value]" ] ) ) {
								$item->xfn = $menu_settings[ "menu-item-xfn[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-position[$value]" ] ) ) {
								$item->menu_order = $menu_settings[ "menu-item-position[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-db-id[$value]" ] ) ) {
								$item->db_id = $menu_settings[ "menu-item-db-id[$value]" ];
							}

							if ( isset($menu_settings[ "td_mega_menu_cat[$value]" ] ) ) {
								$item->td_mega_menu_cat = $menu_settings[ "td_mega_menu_cat[$value]" ];
							}

							if ( isset($menu_settings[ "td_mega_menu_page_id[$value]" ] ) ) {
								$item->td_mega_menu_page_id = $menu_settings[ "td_mega_menu_page_id[$value]" ];
							}



							// CODE SECTION FROM wp customizer >>>

							$post = new WP_Post( (object) $item );

							if ( empty( $post->post_author ) ) {
								$post->post_author = get_current_user_id();
							}

							if ( ! isset( $post->type_label ) ) {
								if ( 'post_type' === $post->type ) {
									$object = get_post_type_object( $post->object );
									if ( $object ) {
										$post->type_label = $object->labels->singular_name;
									} else {
										$post->type_label = $post->object;
									}
								} elseif ( 'taxonomy' == $post->type ) {
									$object = get_taxonomy( $post->object );
									if ( $object ) {
										$post->type_label = $object->labels->singular_name;
									} else {
										$post->type_label = $post->object;
									}
								} else {
									$post->type_label = __( 'Custom Link' );
								}
							}

							/** This filter is documented in wp-includes/nav-menu.php */
							$post->attr_title = apply_filters( 'nav_menu_attr_title', $post->attr_title );

							/** This filter is documented in wp-includes/nav-menu.php */
							$post->description = apply_filters( 'nav_menu_description', wp_trim_words( $post->description, 200 ) );

							/** This filter is documented in wp-includes/nav-menu.php */
							$post = apply_filters( 'wp_setup_nav_menu_item', $post );

							// <<< CODE SECTION FROM wp customizer

							$new_items[] = $post;
						}
					}

					// CODE SECTION FROM wp customizer >>>
					foreach ( $new_items as $item ) {
						foreach ( get_object_vars( $item ) as $key => $value ) {
							$item->$key = $value;
						}
					}
					// <<< CODE SECTION FROM wp customizer

					//print_r($new_items);

					return $new_items;
				}
				return $items;
			}

			/**
			 * iframe enqueue scripts
			 */
			add_action( 'wp_enqueue_scripts', 'on_wp_enqueue_scripts_iframe', 1010); // load them last
			function on_wp_enqueue_scripts_iframe() {

                if (TDC_DEPLOY_MODE == 'deploy') {
                    wp_enqueue_script('js_files_for_iframe', TDC_URL . '/assets/js/js_files_for_iframe.min.js', array(
                        'jquery',
                        'underscore'
                    ), TD_COMPOSER, true);
                } else {
                    tdc_util::enqueue_js_files_array(tdc_config::$js_files_for_iframe, array(
                        'jquery',
                        'underscore'
                    ));
                }




				if ( true === TDC_USE_LESS ) {
					wp_enqueue_style('td_composer_iframe_main', TDC_URL . '/td_less_style.css.php?part=iframe_main', false, TD_COMPOSER);
				} else {
					wp_enqueue_style('td_composer_iframe_main', TDC_URL . '/assets/css/iframe_main.css', false, TD_COMPOSER);
				}
			}


			/**
			 * Load all fonts in iframe, to be sure we have all fonts when a do_job callback finishes
			 */
			add_action( 'get_footer', 'on_get_footer_load_all_fonts' );
			function on_get_footer_load_all_fonts() {

				foreach ( tdc_config::$font_settings as $font_id => $font_settings ) {
					if ( isset( $font_settings['theme_font'] ) ) {
						continue;
					}
					wp_enqueue_style( $font_id, TDC_URL . $font_settings['css_file'], false, TD_COMPOSER );
				}

				if ( td_util::get_check_installed_plugins() ) {

					ob_start();
					?>
					<script>

						setTimeout(function() {

							window.top.tdConfirm.modal({
								caption: 'Did you disable any TagDiv plugins?',
								htmlInfoContent: "We've got some errors at loading API files. It could happen because of a disabled TagDiv plugin!",
								textYes: 'Ok',
								callbackYes: function () {
									window.top.tb_remove();
								},
								hideNoButton: true
							});

						}, 3000);

					</script>
					<?php

					echo ob_get_clean();
				}
			}





			// This stops 'td_animation_stack' library to be applied
			// @todo - trebuie sa fie din thema?
			td_options::update_temp('tds_animation_stack', 'lorem ipsum ..');
			break;



		default:
			// Unknown td_action - kill execution
            echo 'Unknown td_action received: ' . $td_action;
			die;
	}
}







add_action('admin_head', 'on_admin_head_add_tdc_loader');
function on_admin_head_add_tdc_loader() {
	if (!tdc_state::is_live_editor_iframe()) {
		return;
	}
	?>
	<style>
		.tdc-fullscreen-loader-wrap {
			opacity: 1 !important;
		}
	</style>


	<div class="tdc-fullscreen-loader-wrap" style=""></div>

	<?php
}




// Add the necessary scripts for css tab on widgets
add_action( 'load-widgets.php', 'tdc_load_widget' );
function tdc_load_widget() {

	if (td_util::tdc_is_installed()) {

	    if (TDC_DEPLOY_MODE === 'deploy') {
            wp_enqueue_script('js_files_for_widget', TDC_URL . '/assets/js/js_files_for_widget.min.js', array(
                'jquery',
                'underscore',
                'backbone'
            ), TD_COMPOSER, true);
        } else {
            // Load tdc js scripts needed for the css tab in the widget panel of the theme
            tdc_util::enqueue_js_files_array(tdc_config::$js_files_for_widget, array('jquery', 'underscore', 'backbone'));

//            wp_enqueue_script( 'tdcAdminIFrameUI', TDC_URL . '/assets/js/tdcAdminIFrameUI.js', array( 'underscore', 'backbone' ) );
//            wp_enqueue_script( 'tdcCssEditor', TDC_URL . '/assets/js/tdcCssEditor.js', array( 'underscore' ) );
//            wp_enqueue_script( 'tdcSidebarPanel', TDC_URL . '/assets/js/tdcSidebarPanel.js' );
//            wp_enqueue_script( 'tdcUtil', TDC_URL . '/assets/js/tdcUtil.js' );
//            wp_enqueue_script( 'tdcJobManager', TDC_URL . '/assets/js/tdcJobManager.js' );
        }


        // Add viewport intervals
        td_js_buffer::add_variable('td_viewport_interval_list', td_global::$td_viewport_intervals);

        // Load media
        add_action( 'admin_enqueue_scripts', 'on_load_widget_admin_enqueue_scripts' );
        function on_load_widget_admin_enqueue_scripts() {
            wp_enqueue_media();
        }

	}
}