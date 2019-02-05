<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 16.09.2016
 * Time: 15:00
 */

define('WP_USE_THEMES', false);

$td_path = realpath($_GET['wp_path']);
require_once( $td_path . '/wp-load.php' );

if ( ! is_user_logged_in()) {
	return;
}

// 'screen.php' is required by woo, which calls get_current_screen()
require_once (ABSPATH . "wp-admin/includes/screen.php");

//<link rel="stylesheet"  href="../wp-admin/load-styles.php?c=1&dir=ltr&load%5B%5D=dashicons,admin-bar,buttons,media-views,common,forms,admin-menu,dashboard,list-tables,edit,revisions,media,themes,about,nav-menu&load%5B%5D=s,widgets,site-icon,l10n,wp-auth-check,wp-color-picker&ver=4.6.1" type="text/css" >

?>

<html>
	<head>

		<?php

			wp_enqueue_style( 'common' );
			wp_enqueue_style( 'forms' );

			wp_enqueue_style( 'td-wp-admin-td-panel-2', td_global::$get_template_directory_uri . '/includes/wp_booster/wp-admin/css/wp-admin.css', false, TD_THEME_VERSION, 'all' );

			wp_enqueue_script( 'td_confirm', td_global::$get_template_directory_uri . '/includes/wp_booster/wp-admin/js/tdConfirm.js', array( 'jquery' ) );

		?>

		<script>

			// mini detector from td_js_generator
			(function(){
	            var htmlTag = document.getElementsByTagName("html")[0];

	            if ( navigator.userAgent.indexOf("MSIE 10.0") > -1 ) {
	                htmlTag.className += ' ie10';
	            }

	            if ( !!navigator.userAgent.match(/Trident.*rv\:11\./) ) {
	                htmlTag.className += ' ie11';
	            }

				if ( navigator.userAgent.indexOf("Edge") > -1 ) {
	                htmlTag.className += ' ieEdge';
	            }

	            if ( /(iPad|iPhone|iPod)/g.test(navigator.userAgent) ) {
	                htmlTag.className += ' td-md-is-ios';
	            }

	            var user_agent = navigator.userAgent.toLowerCase();
	            if ( user_agent.indexOf("android") > -1 ) {
	                htmlTag.className += ' td-md-is-android';
	            }

	            if ( -1 !== navigator.userAgent.indexOf('Mac OS X')  ) {
	                htmlTag.className += ' td-md-is-os-x';
	            }

	            if ( /chrom(e|ium)/.test(navigator.userAgent.toLowerCase()) ) {
	               htmlTag.className += ' td-md-is-chrome';
	            }

	            if ( -1 !== navigator.userAgent.indexOf('Firefox') ) {
	                htmlTag.className += ' td-md-is-firefox';
	            }

	            if ( -1 !== navigator.userAgent.indexOf('Safari') && -1 === navigator.userAgent.indexOf('Chrome') ) {
	                htmlTag.className += ' td-md-is-safari';
	            }

	            if( -1 !== navigator.userAgent.indexOf('IEMobile') ){
	                htmlTag.className += ' td-md-is-iemobile';
	            }

	        })();

		</script>

		<style>

            .tdc-wpeditor {
                display: flex;
                flex-direction: column;
                height: calc(100% - 69px) !important;
            }

            .tdc-wpeditor #tdc-wpeditor_ifr {
                height: calc(100% - 98px) !important;
            }

            .tdc-one-column .tdc-wpeditor #tdc-wpeditor_ifr {
                height: calc(100% - 175px) !important;
            }

            .tdc-two-column .tdc-wpeditor #tdc-wpeditor_ifr {
                height: calc(100% - 139px) !important;
            }

            .td-md-is-firefox .tdc-wpeditor #tdc-wpeditor_ifr {
                height: 100% !important;
            }

            .td-md-is-firefox .tdc-wpeditor .mce-tinymce {
                height: calc(100% - 98px) !important;
            }

            .td-md-is-firefox .tdc-one-column .tdc-wpeditor .mce-tinymce {
                height: calc(100% - 140px) !important;
            }

            #wp-tdc-wpeditor-wrap {
                display: flex;
                flex-direction: column;
                flex: 1;
            }

            #wp-tdc-wpeditor-editor-container {
                display: flex;
                flex-direction: column;
                flex: 1;
            }

            #wp-tdc-wpeditor-editor-container textarea {
                height: 100% !important;
            }

            #qt_tdc-wpeditor_toolbar {
                min-height: auto;
            }

			.tdc-wpeditor {
				position: absolute;
				top: 50%;
				left: 50%;
				margin-right: -50%;
				transform: translate(-50%, -50%)
			}

			.mce-fullscreen .tdc-wpeditor {
				position: static !important;
				top: auto !important;;
				left: auto !important;;
				margin-right: auto !important;;
				transform: none !important;
			}

		</style>

        <?php

        if ( is_plugin_active( 'td-test-composer/td-test-composer.php' ) ) {
            ob_start();
            ?>

            <style>
                .media-menu > .media-menu-item,
                .media-router > .media-menu-item:first-child,
                .uploader-inline,
                .edit-attachment,
                .delete-attachment {
                    display: none !important;
                }

            </style>

            <?php

            echo ob_get_clean();
        }

        ?>

		<script>
			window.loadIframe = function() {


			    var $body = jQuery( 'body' ),
					$tdcWpeditor = jQuery( '.tdc-wpeditor' ),
					$outerDocument = jQuery( window.parent.document ),
					$tdcIframeWpeditor = $outerDocument.find( '#tdc-iframe-wpeditor' ),
					modelId = $tdcIframeWpeditor.data( 'model_id' ),
					model = window.parent.tdcIFrameData.getModel( modelId ),
					editorWidth = model.get( 'cssWidth' ),
					mappedParameterName = $tdcIframeWpeditor.data( 'mapped_parameter_name' ),
					mappedParameterValue = model.get('attrs')[mappedParameterName];

			    function b64EncodeUnicode(str) {
                    // first we use encodeURIComponent to get percent-encoded UTF-8,
                    // then we convert the percent encodings into raw bytes which
                    // can be fed into btoa.
                    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
                        function toSolidBytes(match, p1) {
                            return String.fromCharCode('0x' + p1);
                    }));
                }

                function b64DecodeUnicode(str) {
                    // Going backwards: from bytestream, to percent-encoding, to original string.
                    return decodeURIComponent(atob(str).split('').map(function(c) {
                        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                    }).join(''));
                }

				// Add $tdcIframeWpeditor css classes to its body element (it's used to properly render the wpeditor and its textarea)
				var tdcIframeWpeditorClass = $tdcIframeWpeditor.attr( 'class' );
				if ( 'undefined' !== typeof tdcIframeWpeditorClass ) {
					var bodyClass = $body.attr( 'class' );
					if ( 'undefined' !== typeof bodyClass ) {
						$body.attr( 'class', bodyClass + ' ' + tdcIframeWpeditorClass );
					} else {
						$body.attr( 'class', tdcIframeWpeditorClass );
					}
				}

				$tdcIframeWpeditor.parent().removeClass( 'tdc-dropped-wpeditor' );

				$tdcWpeditor.width( editorWidth + 50 );
				$outerDocument.find( '#tdc-wpeditor' ).width( editorWidth + 120 );

				var editor = window.tinymce.activeEditor;

				// The editor should not be null
				if ( _.isNull( editor ) ) {
					tdcDebug.log( 'editor null' );
				} else {

					// Timeout used especially for IE or any browser where the editor is not already built at body 'onload'
					// (no reliable event has been found for setting the content)
					setTimeout(function() {
						if ( 'undefined' !== typeof mappedParameterValue ) {

						    // Detect base64 encoding
                            try {

                                var decodedValue = b64DecodeUnicode( mappedParameterValue );
                                editor.setContent( decodedValue );

                            } catch( e ) {
                                editor.setContent( _.unescape( mappedParameterValue ) );
                            }

							// The content must be unescaped because 'htmlentities' php function was used to encode editor content

							//editor.setContent( _.unescape( mappedParameterValue ) );
							//editor.setContent( mappedParameterValue );
						}
					}, 100);

					editor.on( 'keyup undo change', function( event ) {

						var currentValue = editor.getContent(),

						// @todo This should be the content before change
							previousValue = currentValue;

						window.parent.tdcSidebarController.onUpdate (
							model,
							'content',    // the name of the parameter
							previousValue,                  // the old value
							currentValue                    // the new value
						);

					}).on( 'mousedown', function(event) {

						// Send the event to the #tdc-wpeditor component (to be activated)
						window.parent.parent.jQuery( '#tdc-wpeditor' ).trigger( event );
					});

					$body.on( 'keyup change', '#tdc-wpeditor', function(event) {

						// @todo This should be the content before change
						var previousValue = jQuery(this).val();

						// Make the active editor to update its formatted content (We need the formatted and not the raw content!)
						editor.load();

						// Get the formatted content
						var currentValue = editor.getContent();

						window.parent.tdcSidebarController.onUpdate (
							model,
							'content',    // the name of the parameter
							previousValue,                  // the old value
							currentValue                    // the new value
						);

					// Update the model with the new content.
					// In the editor, the new content is not present immediately, so we use a timeout function.
					// The 'click' event can't be used.
					}).on( 'mouseup', '.media-toolbar button', function(event) {

						setTimeout(function() {

							var currentValue = editor.getContent({format: 'html'}),

							// @todo This should be the content before change
								previousValue = currentValue;

							window.parent.tdcSidebarController.onUpdate (
								model,
								'content',    // the name of the parameter
								previousValue,                  // the old value
								currentValue                    // the new value
							);

						}, 200);


					}).on( 'mousedown', function(event) {

						// Send the event to the #tdc-wpeditor component (to be activated)
						window.parent.jQuery( '#tdc-wpeditor' ).trigger( event );
					});

				}
			}
		</script>



	</head>
	<body onload="loadIframe()">

		<div class="tdc-wpeditor">

			<?php

			// The editor id
			global $wpeditorId;
			$wpeditorId = 'tdc-wpeditor';



			// Preset the 'visual' editor tab (This make the js editor to be instantiated - it's not null)
            add_filter( 'wp_default_editor', 'tdc_wp_default_editor' );
            function tdc_wp_default_editor() {
                return "tmce";
            }


            // Add custom style to editor iframe content
			add_filter('tiny_mce_before_init','tdc_tiny_mce_before_init');
			function tdc_tiny_mce_before_init( $mceInit ) {

				global $wpeditorId;

				// Remove the css loaded in the wp editor
				$styles = 'body.' . $wpeditorId . ' { word-wrap: normal !important;} ' .
					'body.mceContentBody{ max-width: 100% !important; background: none !important} ' .
					'body.mceContentBody:after{ content: none !important}';

				if ( isset( $mceInit['content_style'] ) ) {
					$mceInit['content_style'] .= ' ' . $styles . ' ';
				} else {
					$mceInit['content_style'] = $styles . ' ';
				}

				if ( 'deploy' === TDC_DEPLOY_MODE ) {
					require_once get_template_directory() . '/includes/wp_booster/td_api.php';
				} else {
					require_once get_template_directory() . '/includes/wp_booster/td_api_tinymce_formats.php';
				}

				td_api_tinymce_formats::_helper_get_tinymce_format();

				return $mceInit;
			}


			// Add editor extensions as they are in theme
			require_once get_template_directory() . '/includes/wp_booster/wp-admin/tinymce/tinymce.php';

			add_filter( 'mce_external_plugins', 'fb_add_tinymce_plugin' );
			// Add to line 1 form WP TinyMCE
			add_filter( 'mce_buttons', 'td_add_tinymce_button' );


			// Render the editor
			wp_editor(
				'',
				$wpeditorId,
				array(
					'teeny' => false,
					'tinymce' => array(
		                'content_css' => get_stylesheet_directory_uri() . '/editor-style.css'
		            )
				)
			);

			?>

		</div>

		<?php

		// Dialog internal linking
		_WP_Editors::enqueue_scripts();
		do_action('admin_print_footer_scripts');
		do_action( 'admin_footer' );
		_WP_Editors::editor_js();

		?>

    <script type="text/javascript" src="<?php echo includes_url() ?>/js/mce-view.js"></script>
    <script type="text/javascript" src="<?php echo includes_url() ?>/js/tinymce/plugins/compat3x/plugin.js"></script>

	</body>
</html>
