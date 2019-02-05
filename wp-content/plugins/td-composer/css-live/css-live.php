<?php

// 'plugin.php' is necessary for calling 'is_plugin_active'
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( ! function_exists( 'load_css_live' ) ) {
	function load_css_live() {

		//define('TD_LIVE_CSS_URL', plugins_url('css-live'));
		define('TD_LIVE_CSS_VERSION', '1.1');

		if ( is_plugin_active( 'td-composer/td-composer.php' ) ) {
			define('TD_LIVE_CSS_EXTENSION_URL', plugins_url( 'td-composer' ) . '/css-live' );
		}

		require_once "includes/td_live_css_ajax.php";
		require_once "includes/td_live_css_storage.php";
		require_once "includes/td_live_css_util.php";

		require_once "includes/td_live_css_composer.php";



		global $load_in_composer;
		global $load_in_composer_iframe;

		// Initialize globals
		$load_in_composer = false;
		$load_in_composer_iframe = false;

		$get_action = @$_GET['td_action'];
		if ( isset( $get_action ) && ('tdc_edit' === $get_action || 'tdc' === $get_action ) ) {
			$load_in_composer = true;

			if ( 'tdc_edit' === $get_action ) {
				$load_in_composer_iframe = true;
			}
		}



		add_action( 'tdc_extension_settings', 'td_on_extension_settings' );
		function td_on_extension_settings() {
			ob_start();
			?>

				<input type="hidden" name="compiled_css" id="tdc-compiled-css" value="">
				<input type="hidden" name="less_input" id="tdc-less-input" value="">

			<?php
			echo ob_get_clean();
		}

		add_action( 'tdc_extension_content', 'td_on_extension_content' );
		function td_on_extension_content() {
			td_live_css_composer::render_editor();
		}


		add_action( 'tdc_extension_sidebar_bottom', 'td_on_extension_sidebar_bottom' );
		function td_on_extension_sidebar_bottom() {
			ob_start();
			?>

			<div class="tdc-sidebar-bottom-button tdc-live-css" title="Show or hide the Live CSS editor">
				<span class="tdc-icon-view" title="Open CSS Editor"></span>
			</div>

			<script>
				jQuery(window).ready(function(){
					jQuery( '.tdc-live-css' ).click(function(event) {

						var $this = jQuery( this );
		                $this.toggleClass( 'tdc-window-open' );

//		                jQuery( '.tdc-sidebar-modal' ).each(function(index, element) {
//		                    var $element = jQuery( element ),
//		                        dataButtonClass = $element.data( 'button_class' );
//
//		                    if ( $element.hasClass( 'tdc-sidebar-modal-live-css' ) ) {
//
//			                    if ( tdLiveCssMainTdc.$_editorWrapper.hasClass( 'tdw-css-writer-expand' ) ) {
//				                    tdLiveCssMainTdc.$_editorWrapper.toggleClass( 'tdw-css-writer-expand-hidden' );
//									$element.removeClass( 'tdc-modal-open' );
//			                    } else {
//									$element.toggleClass( 'tdc-modal-open' );
//								}
//
//		                    } else {
//		                        $element.removeClass( 'tdc-modal-open' );
//
//		                        if ( 'undefined' !== typeof dataButtonClass && '' !== dataButtonClass ) {
//		                            var $button = jQuery( '.' + dataButtonClass );
//		                            if ( $button.length ) {
//		                                $button.removeClass( 'tdc-window-open' );
//		                            }
//		                        }
//		                    }
//		                });




						// The live css panel can stay as draggable modal window when it's outside of sidebar
						var $tdcSidebarModalLiveCss = jQuery( '.tdc-sidebar-modal.tdc-sidebar-modal-live-css' );
						if ( $tdcSidebarModalLiveCss.hasClass( 'tdw-sidebar-modal-hidden' ) ) {

							if ( tdLiveCssMainTdc.$_editorWrapper.hasClass( 'tdw-css-writer-expand' ) ) {
			                    tdLiveCssMainTdc.$_editorWrapper.toggleClass( 'tdw-css-writer-expand-hidden' );

								if ( tdLiveCssMainTdc.$_editorWrapper.hasClass( 'tdw-css-writer-expand-hidden' ) ) {
									tdcWindowFrame.unsetWindowFrame( tdLiveCssMainTdc.$_editorWrapper );
								} else {
									tdcWindowFrame.setWindowFrame( tdLiveCssMainTdc.$_editorWrapper );
								}
								$tdcSidebarModalLiveCss.removeClass( 'tdc-modal-open' );

		                    } else {
								$tdcSidebarModalLiveCss.toggleClass( 'tdc-modal-open' );
							}

						} else {

							jQuery( '.tdc-sidebar-modal' ).each(function(index, element) {
			                    var $element = jQuery( element ),
			                        dataButtonClass = $element.data( 'button_class' );

			                    if ( $element.hasClass( 'tdc-sidebar-modal-live-css' ) ) {

				                    if ( tdLiveCssMainTdc.$_editorWrapper.hasClass( 'tdw-css-writer-expand' ) ) {
					                    tdLiveCssMainTdc.$_editorWrapper.toggleClass( 'tdw-css-writer-expand-hidden' );
										$element.removeClass( 'tdc-modal-open' );
				                    } else {
										$element.toggleClass( 'tdc-modal-open' );
									}

			                    } else {
			                        $element.removeClass( 'tdc-modal-open' );

				                    if ( 'undefined' !== typeof dataButtonClass && '' !== dataButtonClass ) {
			                            var $button = jQuery( '.' + dataButtonClass );
			                            if ( $button.length ) {
			                                $button.removeClass( 'tdc-window-open' );
			                            }
			                        }
			                    }
			                });
						}



						setTimeout(function(){
							window.editor.focus();
						}, 100);
					});
				});
			</script>

			<?php
			echo ob_get_clean();
		}


		// 100000 priority to be the last in header
		add_action( 'wp_head', 'td_live_css_inject_css', 100000 );
		function td_live_css_inject_css() {
			$css_buffer = td_live_css_css_storage::get( 'css' );

//			if ( !empty( $css_buffer ) ) {
//				echo '	<style id="tdw-css-placeholder">' . $css_buffer . '</style>';
//			}
			echo '	<style id="tdw-css-placeholder">' . $css_buffer . '</style>';
		}


		add_action( 'tdc_extension_save', 'td_on_extension_save', 10, 1 );
		function td_on_extension_save( WP_REST_Request $request ) {
			td_live_css_on_ajax_save_css( $request );
		}




		if ( $load_in_composer_iframe ) {

			// 100000 priority to be the last
			add_action( 'wp_footer', 'tdc_on_add_css_live_components', 100000 );

		} else {

			// 100000 priority to be the last
			add_action( 'wp_footer', 'tdc_on_live_css_inject_editor', 100000 );
		}


		/**
		 * This function will be executed only in iframe of the composer, to add '.tdw-css-writer-editor' and '#tdw-css-writer' components in page.
		 * These components are used by the live css extension.
		 */
		function tdc_on_add_css_live_components() {
			?>

				<textarea class="tdw-css-writer-editor"></textarea>
				<style id="tdw-css-placeholder"></style>

			<script>

				(function() {

					if ( 'undefined' !== typeof window.parent ) {

						// Everything must be done onLoad, to be sure that all live css components are in loaded.
						jQuery( window ).load(function(){

							if ( 'undefined' !== typeof window.parent.editorChangeHandler ) {

								setTimeout(function(){

									// tdLiveCssInject must be reinitialized because '.tdw-css-writer-editor' and '#tdw-css-writer' components are new in page
									window.parent.tdLiveCssInject.reinit();

									// The 'change' callback function of window.editor, is called here. We did it to apply the existing css to the new page content received from server.
									window.parent.editorChangeHandler();

									// Hide the '#tdc-wpeditor' tdc window frame, because the new content has new objects (The wp editor opened for an existing block, can not longer be used in page. It must be reopened from sidebar!)
									var openedWindows = window.parent.document.getElementsByClassName( window.parent.tdcWindowFrame._markerCssClass );

									for ( var i = 0; i < openedWindows.length; i++ ) {
										var $openedWindow = jQuery( openedWindows[i] );
										if ( 'tdc-wpeditor' === $openedWindow.attr( 'id' ) ) {

											// We just trigger 'click' event, because on close button are bound more handlers (some native and some from tdcWindowFrame js library)
											$openedWindow.find( '.tdc-iframe-close-button').trigger( 'click' );
											break;
										}
									}

								}, 500);
							}
						});
					}

				})();

			</script>

			<?php
		}


		/**
		 * This function is also called standalone in render_editor @see td_live_css_composer.php
		 */
		function tdc_on_live_css_inject_editor() {
			global $load_in_composer;

			?>


			<div id="tdw-css-writer" style="display: none" class="tdw-drag-dialog tdc-window-sidebar">
				<header>

				<?php
				if ( ! $load_in_composer ) {
				?>

					<a title="Editor" class="tdw-tab tdc-tab-active" href="#" data-tab-content="tdw-tab-editor">Edit with Live CSS</a>
					<div class="tdw-less-info" title="This will be red when errors are detected in your CSS and LESS"></div>
				<?php
				} else {
				?>

					<div class="tdw-dialog-title">
                        Live Css Editor
                    </div>

					<div class="tdw-close"></div>
					<div class="tdw-expand-collapse"></div>

				<?php
				}
				?>

				</header>
				<div class="tdw-content">

					<?php

					$new_editor_uid = td_live_css_util::td_generate_unique_id();

					?>

					<div class="tdw-tabs-content tdw-tab-editor tdc-tab-content-active">


						<script>

							(function(jQuery, undefined) {

								jQuery(window).ready(function() {

									if ( 'undefined' !== typeof tdcAdminIFrameUI ) {
										var $liveIframe  = tdcAdminIFrameUI.getLiveIframe();

										if ( $liveIframe.length ) {
											$liveIframe.load(function() {
												$liveIframe.contents().find( 'body').append( '<textarea class="tdw-css-writer-editor" style="display: none"></textarea>' );
											});
										}
									}

								});

							})(jQuery);

						</script>


						<textarea class="tdw-css-writer-editor <?php echo $new_editor_uid?>"><?php echo td_live_css_css_storage::get( 'less' ) ?></textarea>
						<div id="<?php echo $new_editor_uid ?>" class="td-code-editor"></div>


						<script>
							jQuery(window).load(function (){

								if ( 'undefined' !== typeof tdLiveCssInject ) {

									tdLiveCssInject.init();


									var editor_textarea = jQuery('.<?php echo $new_editor_uid ?>');
									var languageTools = ace.require("ace/ext/language_tools");
									var tdcCompleter = {
										getCompletions: function (editor, session, pos, prefix, callback) {
											if (prefix.length === 0) {
												callback(null, []);
												return
											}

											if ('undefined' !== typeof tdcAdminIFrameUI) {

												var data = {
													error: undefined,
													getShortcode: ''
												};

												tdcIFrameData.getShortcodeFromData(data);

												if (!_.isUndefined(data.error)) {
													tdcDebug.log(data.error);
												}

												if (!_.isUndefined(data.getShortcode)) {

													var regex = /el_class=\"([A-Za-z0-9_-]*\s*)+\"/g,
														results = data.getShortcode.match(regex);

													var elClasses = {};

													for (var i = 0; i < results.length; i++) {
														var currentClasses = results[i]
															.replace('el_class="', '')
															.replace('"', '')
															.split(' ');

														for (var j = 0; j < currentClasses.length; j++) {
															if (_.isUndefined(elClasses[currentClasses[j]])) {
																elClasses[currentClasses[j]] = '';
															}
														}
													}

													var arrElClasses = [];

													for (var prop in elClasses) {
														arrElClasses.push(prop);
													}

													callback(null, arrElClasses.map(function (item) {
														return {
															name: item,
															value: item,
															meta: 'in_page'
														}
													}));
												}
											}
										}
									};
									languageTools.addCompleter(tdcCompleter);

									window.editor = ace.edit("<?php echo $new_editor_uid ?>");
                                    window.editor.$blockScrolling = Infinity;

                                    // 'change' handler is written as function because it's called by tdc_on_add_css_live_components (of wp_footer hook)
									// We did it to reattach the existing compiled css to the new content received from server.
									window.editorChangeHandler = function () {
										//tdwState.lessWasEdited = true;

										window.onbeforeunload = function () {
											if (tdwState.lessWasEdited) {
												return "You have attempted to leave this page. Are you sure?";
											}
											return false;
										};

										var editorValue = editor.getSession().getValue();

										editor_textarea.val(editorValue);

										if ('undefined' !== typeof tdcAdminIFrameUI) {
											tdcAdminIFrameUI.getLiveIframe().contents().find('.tdw-css-writer-editor:first').val(editorValue);

											// Mark the content as modified
											// This is important for showing info when composer closes
                                            tdcMain.setContentModified();
										}

										tdLiveCssInject.less();
									};

									editor.getSession().setValue(editor_textarea.val());
									editor.getSession().on('change', editorChangeHandler);

									editor.setTheme("ace/theme/textmate");
									editor.setShowPrintMargin(false);
									editor.getSession().setMode("ace/mode/less");
                                    editor.getSession().setUseWrapMode(true);
									editor.setOptions({
										enableBasicAutocompletion: true,
										enableSnippets: true,
										enableLiveAutocompletion: false
									});

								}

							});
						</script>

					</div>
				</div>

				<footer>

					<?php
					if ( ! $load_in_composer ) {
					?>

						<a href="#" class="tdw-save-css">Save</a>
						<div class="tdw-more-info-text">Write CSS OR LESS and hit save. CTRL + SPACE for auto-complete.</div>

					<?php
					} else {
					?>

					<div class="tdw-less-info" title="This will be red when errors are detected in your CSS and LESS"></div>

					<?php
					}
					?>

					<div class="tdw-resize"></div>
				</footer>
			</div>
			<?php
		}




		/**
		 * WP-admin - add js in header on all the admin pages (wp-admin and the iframe Wrapper. Does not run in the iframe)
		 */
		add_action( 'wp_head', 'td_live_css_on_wp_head' );
		add_action( 'admin_head', 'td_live_css_on_wp_head' );
		function td_live_css_on_wp_head() {


			// the settings that we load in wp-admin and wrapper. We need json to be sure we don't get surprises with the encoding/escaping
			$td_live_css_blobal = array(
				'adminUrl' => admin_url(),
				'wpRestNonce' => wp_create_nonce('wp_rest'),
				'wpRestUrl' => rest_url(),
				'permalinkStructure' => get_option('permalink_structure'),
			);

			ob_start();
			?>
			<script>
				window.tdwGlobal = <?php echo json_encode( $td_live_css_blobal );?>;
			</script>
			<?php
			$buffer = ob_get_clean();
			echo $buffer;
		}



		if ( ! $load_in_composer_iframe && is_user_logged_in() && current_user_can('publish_pages') ) {
			add_action( 'wp_enqueue_scripts', 'td_live_css_load_plugin_css' );
			add_action( 'wp_enqueue_scripts', 'td_live_css_load_plugin_js' );
		}

		if ( $load_in_composer ) {
			if ( $load_in_composer_iframe ) {
				add_action( 'wp_enqueue_scripts', 'td_live_css_load_plugin_css' );
			}
			add_action( 'admin_enqueue_scripts', 'td_live_css_load_admin_css' );
			add_action( 'admin_enqueue_scripts', 'td_live_css_load_admin_js' );
		}


		function td_live_css_load_plugin_css() {
		    if ( defined('TDC_USE_LESS') && TDC_USE_LESS === true ) { // we use defined because this can run without that constant when td-composer is inactive
                wp_enqueue_style( 'td_live_css_frontend', TDC_URL . '/td_less_style.css.php?part=td_live_css_frontend', false, TD_COMPOSER );
            } else {
                wp_enqueue_style( 'td_live_css_frontend', TDC_URL . '/css-live/assets/css/td_live_css_frontend.css', false, TD_COMPOSER );
            }
		}

		function td_live_css_load_plugin_js() {

			wp_enqueue_script('js_files_for_ace', TDC_URL . '/css-live/assets/external/ace/ace.js', array('jquery', 'underscore'), TD_COMPOSER, true);
	        wp_enqueue_script('js_files_for_ace_ext_language_tools', TDC_URL . '/css-live/assets/external/ace/ext-language_tools.js', array( 'js_files_for_ace' ), TD_COMPOSER, true);
            wp_enqueue_script('js_files_for_ace_ext_searchbox', TDC_URL . '/css-live/assets/external/ace/ext-searchbox.js', array( 'js_files_for_ace' ), TD_COMPOSER, true);

            // load the js
		    if ( defined( 'TDC_DEPLOY_MODE' ) && TDC_DEPLOY_MODE == 'deploy' ) {
			    wp_enqueue_script('js_files_for_live_css', TDC_URL . '/assets/js/js_files_for_live_css.min.js', array( 'js_files_for_ace_ext_language_tools' ), TD_COMPOSER, true);
		        wp_enqueue_script('js_files_for_plugin_live_css', TDC_URL . '/assets/js/js_files_for_plugin_live_css.min.js', array( 'js_files_for_live_css' ), TD_COMPOSER, true);
		    } else {
			    tdc_util::enqueue_js_files_array( tdc_config::$js_files_for_live_css, array( 'js_files_for_ace_ext_language_tools' ) );
			    tdc_util::enqueue_js_files_array( tdc_config::$js_files_for_plugin_live_css );
		    }
		}

		function td_live_css_load_admin_css() {

            if ( defined('TDC_USE_LESS') && TDC_USE_LESS === true ) { // we use defined because this can run without that constant when td-composer is inactive
                wp_enqueue_style( 'td_live_css_composer', TDC_URL . '/td_less_style.css.php?part=td_live_css_composer', false, TD_COMPOSER );
            } else {
                wp_enqueue_style( 'td_live_css_composer', TDC_URL . '/css-live/assets/css/td_live_css_composer.css', false, TD_COMPOSER );
            }
		}

		function td_live_css_load_admin_js() {

			wp_enqueue_script('js_files_for_ace', TDC_URL . '/css-live/assets/external/ace/ace.js', array('jquery', 'underscore'), TD_COMPOSER, true);
	        wp_enqueue_script('js_files_for_ace_ext_language_tools', TDC_URL . '/css-live/assets/external/ace/ext-language_tools.js', array( 'js_files_for_ace' ), TD_COMPOSER, true);
	        wp_enqueue_script('js_files_for_ace_ext_searchbox', TDC_URL . '/css-live/assets/external/ace/ext-searchbox.js', array( 'js_files_for_ace' ), TD_COMPOSER, true);

			// load the js
		    if ( defined( 'TDC_DEPLOY_MODE' ) && TDC_DEPLOY_MODE == 'deploy' ) {
			    wp_enqueue_script('js_files_for_live_css', TDC_URL . '/assets/js/js_files_for_live_css.min.js', array( 'js_files_for_ace_ext_language_tools' ), TD_COMPOSER, true);
		        wp_enqueue_script('js_files_for_extension_live_css', TDC_URL . '/assets/js/js_files_for_extension_live_css.min.js', array( 'js_files_for_live_css' ), TD_COMPOSER, true);
		    } else {
			    tdc_util::enqueue_js_files_array( tdc_config::$js_files_for_live_css, array( 'js_files_for_ace_ext_language_tools' ) );
			    tdc_util::enqueue_js_files_array( tdc_config::$js_files_for_extension_live_css );
		    }
		}







		add_action( 'admin_bar_menu', 'td_live_css_admin_bar_button', 9999 );
		function td_live_css_admin_bar_button() {
			global $wp_admin_bar;
			if (!is_super_admin() || !is_admin_bar_showing() || is_admin()) {
				return;
			}

			$wp_admin_bar->add_menu( array(
				'id'   => 'td_live_css_css_writer',
				'meta' => array('title' => 'Live CSS'),
				'title' => 'Live CSS',
				'href' => '#' ));

		}


//		function cyb_activation_redirect( $plugin ) {
//			if( $plugin == plugin_basename( __FILE__ ) ) {
//				exit( wp_redirect( admin_url( 'tools.php?page=td_live_css_admin' ) ) );
//			}
//		}
//		add_action( 'activated_plugin', 'cyb_activation_redirect' );

	}
	load_css_live();
}





