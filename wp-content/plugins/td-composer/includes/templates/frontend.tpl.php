<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 11.02.2016
 * Time: 13:04
 */

/*
 * frontend.tpl.php can't be used without 'tdc' class
 */


global $post;

$post = tdc_state::get_post();

// check if we have a post set in the state.
if (empty($post)) {
    echo "Invalid post ID, or permission denied";
	die;
}



add_thickbox();
wp_enqueue_media( array( 'post' => $post->ID ) );

require_once( ABSPATH . 'wp-admin/admin-header.php' );

//$postContent = str_replace( '\'', '\\\'', $post->post_content );
$postContent = $post->post_content;

/*
 * Important!
 * 'vc_column_text' and 'td_block_with_title' are not self enclosed shortcodes, having their contents inside of them.
 * So, because this content has \r,\n or \r\n characters inside, it can't be used as it is for window.tdcPostSettings.postContent. It needs to be formatted as wordpress does,
 * changing these characters to paragraphs.
 */
function td_replace_vc_column_text($matches) {
    return '[vc_column_text' . $matches[1] . ']' . base64_encode( $matches[2] ) . '[/vc_column_text]';
    //return '[vc_column_text' . $matches[1] . ']' . base64_encode( wpautop( preg_replace( '/<\/?p\>/', "\n", $matches[2] ) ) ) . '[/vc_column_text]';
    //return '[vc_column_text' . $matches[1] . ']' . wpautop( htmlentities( preg_replace( '/<\/?p\>/', "\n", $matches[2] ) . "\n", ENT_QUOTES, "UTF-8" ) ) . '[/vc_column_text]';
	//return '[vc_column_text' . $matches[1] . ']' . wpautop( preg_replace( '/<\/?p\>/', "\n", $matches[2] ) . "\n" ) . '[/vc_column_text]';
}

if ( shortcode_exists( 'vc_column_text' ) && has_shortcode( $postContent, 'vc_column_text' ) ) {

    // Double regex instead of one regex (preg_match and preg_replace_callback) - with one regex we need to parse content for replacing text, to supply what does the second regex
    // This first regex check is to allow second regex replacement to apply only when 'vc_column_text' has content
    preg_match("/\[vc_column_text(.*)\](.*)\[\/vc_column_text\]/sU", $postContent, $matches);
    if ( is_array( $matches ) && count( $matches ) ) {
	    $postContent = preg_replace_callback( "/\[vc_column_text(.*)\](.*)\[\/vc_column_text\]/sU", 'td_replace_vc_column_text', $postContent );
    }
}

function td_replace_td_block_text_with_title($matches) {
    return '[td_block_text_with_title' . $matches[1] . ']' . base64_encode( $matches[2] ) . '[/td_block_text_with_title]';
    //return '[td_block_text_with_title' . $matches[1] . ']' . base64_encode(wpautop( preg_replace( '/<\/?p\>/', "\n", $matches[2] ) ) ) . '[/td_block_text_with_title]';
    //return '[td_block_text_with_title' . $matches[1] . ']' . wpautop( htmlentities( preg_replace( '/<\/?p\>/', "\n", $matches[2] ) . "\n", ENT_QUOTES, "UTF-8" ) ) . '[/td_block_text_with_title]';
	//return '[td_block_text_with_title' . $matches[1] . ']' . wpautop( preg_replace( '/<\/?p\>/', "\n", $matches[2] ) . "\n" ) . '[/td_block_text_with_title]';
}

if ( shortcode_exists( 'td_block_text_with_title' ) && has_shortcode( $postContent, 'td_block_text_with_title' ) ) {

    // Double regex instead of one regex (preg_match and preg_replace_callback) - with one regex we need to parse content for replacing text, to supply what does the second regex
    // This first regex check is to allow second regex replacement to apply only when 'td_block_text_with_title' has content
    preg_match("/\[td_block_text_with_title(.*)\](.*)\[\/td_block_text_with_title\]/sU", $postContent, $matches);
    if ( is_array( $matches ) && count( $matches ) ) {
        $postContent = preg_replace_callback("/\[td_block_text_with_title(.*)\](.*)\[\/td_block_text_with_title\]/sU", 'td_replace_td_block_text_with_title', $postContent);
    }
}



$postContent = str_replace( array( "\r\n", "\n", "\r" ), array( "\r\n'+'" ), $postContent );


//@todo - refactorizare aici json_encode
//<link rel="stylesheet" href="http://basehold.it/22">

// Add shortcodes name to be displayed into sidebar panel
$shortcodes = array();
foreach (tdc_mapper::get_mapped_shortcodes() as $mapped_shortcode ) {
	$shortcodes[ $mapped_shortcode[ 'base' ] ] = $mapped_shortcode[ 'name' ];
}

//var_dump(wp_get_sidebars_widgets());





function get_data_shortcode_settings( $mapped_shortcode) {
	$data_shortcode_settings = '';

	if ( isset( $mapped_shortcode['tdc_start_values'] ) ) {
		$data_shortcode_settings .= 'data-start-values="' . $mapped_shortcode['tdc_start_values'] . '" ';
	}
	if ( isset( $mapped_shortcode['tdc_row_start_values'] ) ) {
		$data_shortcode_settings .= ' data-row-start-values="' . $mapped_shortcode['tdc_row_start_values'] . '" ';
	}
	return $data_shortcode_settings;
}

/**
 * Get the url in format //domain.com/.. without 'http' and 'https', because url of iframe does not redirect from http to https
 *
 * @param $post_id
 *
 * @return mixed
 */
function get_post_url( $post_id ) {
	 return str_replace( array( 'http:', 'https:' ), '', get_permalink( $post_id ) );
}





?>


	<script type="text/javascript">

		// Add 'td_composer' class to html element
		window.document.documentElement.className += ' td_composer';

		// "Starting in Chrome 51, a custom string will no longer be shown to the user. Chrome will still show a dialog to prevent users from losing data, but it’s contents will be set by the browser instead of the web page."
		// https://developers.google.com/web/updates/2016/04/chrome-51-deprecations?hl=en#remove-custom-messages-in-onbeforeload-dialogs
		window.onbeforeunload = function ( event) {
			if ( ! tdcMain.getContentModified() ) {
				return;
			}
			return 'Dialog text here';
		}

		window.tdcPostSettings = {
			postId: '<?php echo $post->ID; ?>',
			postUrl: '<?php echo get_post_url($post->ID); ?>',
            postContent: '<?php echo base64_encode( $postContent ) ?>',
			postMetaDirtyContent: '<?php echo get_post_meta( $post->ID, 'tdc_dirty_content', true ) ?>',
			postMetaVcJsStatus: '<?php echo get_post_meta( $post->ID, '_wpb_vc_js_status', true ) ?>',
			shortcodes: <?php echo json_encode( $shortcodes ) ?>,

            tdbLoadDataFromId: <?php echo json_encode(tdc_util::get_get_val('tdbLoadDataFromId')) ?>,
            tdbTemplateType: <?php echo json_encode(tdc_util::get_get_val('tdbTemplateType')) ?>,
       };

		// Set the local storage to show inline the iframe wrapper and the sidebar
		window.localStorage.setItem( 'tdc_live_iframe_wrapper_inline', 1 );

	</script>

	<?php
			// tdc-icon-sidebar-open is outside of the sidebar, because the sidebar has overflow hidden
	?>

	<!-- the composer sidebar -->

	<div class="tdc-sidebar-open" title="Show sidebar">
		<span class="tdc-icon-sidebar-open"></span>
	</div>

	<div id="tdc-sidebar" class="tdc-sidebar-inline">
		<div class="tdc-top-buttons">
			<div class="tdc-add-element" title="Add new element in the viewport">
				Add element
				<span class="tdc-icon-add"></span>
			</div>
			<?php
            // load the preview for the current content if we're editing a template with content
            $tdbLoadDataFromId = tdc_util::get_get_val('tdbLoadDataFromId');
            $tdbTemplateType = tdc_util::get_get_val('tdbTemplateType');

            $preview_url = '';

            if ( $tdbLoadDataFromId !== false ) {
                switch ( $tdbTemplateType ) {
                    case 'single':
                        $preview_url = get_permalink( $tdbLoadDataFromId );
                        break;

                    case 'category':
                        $preview_url = get_category_link( $tdbLoadDataFromId );
                        break;

                    case 'author':
                        $preview_url = get_author_posts_url( $tdbLoadDataFromId );
                        break;

                    case 'search':
                        $preview_url = get_search_link( $tdbLoadDataFromId );
                        break;

                    case 'date':
                        $preview_url = get_year_link( $tdbLoadDataFromId );
                        break;

                    case 'tag':
                        $preview_url = get_tag_link( $tdbLoadDataFromId );
                        break;

                    case 'attachment':
                        $preview_url = get_attachment_link( $tdbLoadDataFromId );
                        break;
                }

            } else {
                $preview_url = get_permalink($post->ID);
            }
            ?>
            <a class="tdc-view-page" href="<?php echo $preview_url ?>" target="_blank" title="View the page. Save the content before it">
				<span class="tdc-icon-view"></span>
			</a>
			<a class="tdc-save-page" href="#" title="Save the page content CTRL + S">
				<span class="tdc-icon-save"></span>
				</a>
			<a class="tdc-close-page" href="#" title="Close the composer and switch to backend">
				<span class="tdc-icon-close"></span>
			</a>
		</div>

        <div class="tdc-empty-sidebar">
			<div class="tdc-start-tips tdc-intro">
                <img src="<?php echo TDC_URL ?>/assets/images/sidebar/tagdiv-composer.png">
				<span>Welcome to <br>tagDiv Composer!</span>
				<p>Get started by adding elements, go to <span>Add Element</span> and begin dragging your items. You can edit by clicking on any element in the preview area.</p>
			</div>
			<div class="tdc-sidebar-w-button tdc-add-element" title="Add new element in the viewport">Add Element</div>

            <style>
                .tdb-template-meta {
                    position: absolute;
                    top: -3px;
                    box-sizing: border-box;
                    margin-left: 12px;
                    color: #fff;
                    font-size: 12px;
                }
                .tdb-template-meta span {
                    opacity: 0.7;
                }
                .tdb-template-meta-arrow {
                    margin: 0 2px 0 -3px;
                }
            </style>

            <?php

                // Temporarily remove Page Settings for not 'page' templates.
                // This option will be changed to work for templates, or rewritten.
                if ( 'page' !== $tdbTemplateType ) {
                    ?>

                    <style>
                        .tdc-main-menu {
                            display: none;
                        }
                    </style>

                    <?php
                }

                $current_post_type = get_post_type( $post );
                if ( false !== $tdbTemplateType ) {
                    $current_post_type = $tdbTemplateType;
                }

                $post_title = get_the_title( $post );
                if ( empty( $post_title ) ) {
                    $post_title = '"Empty title"';
                }
            ?>

            <div class="tdb-template-meta">
                <span class="tdb-template-meta-cat"><?php echo $current_post_type ?></span>
                <span class="tdb-template-meta-arrow tdc-breadcrumb-arrow"></span>
                <span id="tdb-template-name"><?php echo $post_title; ?></span>
                <a href="#" title="Edit page/template name" id="tdb-template-name-edit">Edit</a>
            </div>

            <?php do_action('tdc_welcome_panel_text')?>

		</div>


		<!-- the inspector -->
		<div class="tdc-inspector-wrap">
			<div class="tdc-inspector">
				<!-- breadcrumbs browser -->
				<div class="tdc-breadcrumbs">
					<div id="tdc-breadcrumb-row">
						<a class="tdc-breadcrumb-item" href="#" title="The parent row">row</a>
					</div>
					<div id="tdc-breadcrumb-column">
						<span class="tdc-breadcrumb-arrow"></span>
						<a class="tdc-breadcrumb-item" href="#" title="The parent column">column</a>
					</div>
					<div id="tdc-breadcrumb-inner-row">
						<span class="tdc-breadcrumb-arrow"></span>
						<a class="tdc-breadcrumb-item" href="#" title="The parent inner row">inner-row</a>
					</div>
					<div id="tdc-breadcrumb-inner-column">
						<span class="tdc-breadcrumb-arrow"></span>
						<a class="tdc-breadcrumb-item" href="#" title="The parent inner column">inner-column</a>
					</div>
				</div>
				<div class="tdc-current-element-head" title="This is the type (shortcode) of the current selected element">
				</div>
				<div class="tdc-current-element-siblings">
				</div>
				<div class="tdc-tabs-wrapper">
				</div>
			</div>
		</div>


		<div class="tdc-sidebar-bottom">
			<div class="tdc-sidebar-bottom-button tdc-sidebar-close" title="Hide sidebar">
				<span class="tdc-icon-sidebar-close"></span>
			</div>
			<div class="tdc-sidebar-bottom-button tdc-bullet" title="On/Off full viewport">
				<span class="tdc-icon-bullet"></span>
			</div>
			<div class="tdc-sidebar-info"></div>
			<div class="tdc-extends">

                <div class="tdc-sidebar-bottom-button tdc-restore-undo" title="Restore content">
                    <span class="tdc-icon-restore-undo" title="Undo CTRL + Z"></span>
                </div>
                <div class="tdc-sidebar-bottom-button tdc-restore-redo" title="Restore content">
                    <span class="tdc-icon-restore-redo" title="Redo CTRL + SHIFT + Z"></span>
                </div>
				<?php
					// Extensions add button in sidebar (to open content)
					do_action( 'tdc_extension_sidebar_bottom' );
				?>

			</div>
            <?php if (current_user_can("switch_themes")) { ?>
			<div class="tdc-sidebar-bottom-button tdc-main-menu" title="Show site wide settings">
				<span class="tdc-icon-view"></span>
			</div>
            <?php } ?>
		</div>

		<div id="tdc-restore">
			Restore
		</div>

		<div id="tdc-restore-content">
		</div>

		<!-- modal window -->
		<div class="tdc-sidebar-modal tdc-sidebar-modal-elements" data-button_class="tdc-add-element">
			<div class="tdc-sidebar-modal-search" title="Search for elements in list">
				<input type="text" placeholder="Search" name="Search">
				<span class="tdc-modal-magnifier"></span>
			</div>
			<div class="tdc-sidebar-modal-content">
				<!-- sidebar elements list -->
				<div class="tdc-sidebar-elements">
					<?php

					$top_mapped_shortcodes = array();

					$block_mapped_shortcodes = array();
					$big_grids_mapped_shortcodes = array();
                    $header_mapped_shortcodes = array();
					$extended_mapped_shortcodes = array();
					$external_mapped_shortcodes = array();
					$multipurpose_mapped_shortcodes = array();
					$single_post_mapped_shortcodes = array();
                    $category_page_mapped_shortcodes = array();
                    $tag_page_mapped_shortcodes = array();
                    $author_page_mapped_shortcodes = array();
                    $archive_page_mapped_shortcodes = array();
                    $search_page_mapped_shortcodes = array();
                    $attachment_page_mapped_shortcodes = array();
                    $common_page_el_mapped_shortcodes = array();
					$template_shortcodes = array(
//						'template_1' => array(
//							'name' => 'Template 1',
//							'content' => base64_encode(json_encode('[vc_row full_width="stretch_row"][vc_column width="1/4"][vc_row_inner][vc_column_inner width="1/2"][td_block_2][/vc_column_inner][vc_column_inner width="1/2"][td_block_1][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/4"][/vc_column][vc_column width="1/4"][/vc_column][vc_column width="1/4"][/vc_column][/vc_row]')),
//						),
					);

					$template_shortcodes = apply_filters( 'tdc_template_shortcodes', $template_shortcodes );

					$mapped_shortcodes = tdc_mapper::get_mapped_shortcodes();

					foreach ($mapped_shortcodes as &$mapped_shortcode ) {

						$shortcode_base = $mapped_shortcode['base'];

						if ( 'vc_column' === $shortcode_base || 'vc_column_inner' === $shortcode_base ) {
							continue;
						}

						if ( 'vc_row' === $shortcode_base ||
						     'vc_row_inner' === $shortcode_base ||
						     'vc_empty_space' === $shortcode_base ) {
							$top_mapped_shortcodes[$shortcode_base] = $mapped_shortcode;

							continue;
						}

						if ( isset( $mapped_shortcode['tdc_category'] ) ) {
							switch( $mapped_shortcode['tdc_category'] ) {
								case 'Blocks':
									$block_mapped_shortcodes[] = $mapped_shortcode;
									break;
								case 'Big Grids':
									$big_grids_mapped_shortcodes[] = $mapped_shortcode;
									break;
                                case 'Header shortcodes':
                                    $header_mapped_shortcodes[] = $mapped_shortcode;
                                    break;
								case 'Extended':
									$extended_mapped_shortcodes[] = $mapped_shortcode;
									break;
								case 'Single post':
									$single_post_mapped_shortcodes[] = $mapped_shortcode;
									break;
                                case 'Category page':
                                    $category_page_mapped_shortcodes[] = $mapped_shortcode;
                                    break;
                                case 'Tag page':
                                    $tag_page_mapped_shortcodes[] = $mapped_shortcode;
                                    break;
                                case 'Author page':
                                    $author_page_mapped_shortcodes[] = $mapped_shortcode;
                                    break;
                                case 'Search page':
                                    $search_page_mapped_shortcodes[] = $mapped_shortcode;
                                    break;
                                case 'Attachment page':
                                    $attachment_page_mapped_shortcodes[] = $mapped_shortcode;
                                    break;
                                case 'Common page elements':
                                    $common_page_el_mapped_shortcodes[] = $mapped_shortcode;
                                    break;
								case 'Multipurpose':
									$multipurpose_mapped_shortcodes[] = $mapped_shortcode;
									break;
								case 'External':
									$external_mapped_shortcodes[] = $mapped_shortcode;
									break;
							}
						}
					}

					function tdc_sort_name( $mapped_shortcode_1, $mapped_shortcode_2 ) {
						return strcmp( $mapped_shortcode_1['name'], $mapped_shortcode_2['name'] );
					}

					usort( $extended_mapped_shortcodes, 'tdc_sort_name');
					usort( $external_mapped_shortcodes, 'tdc_sort_name');
					usort( $multipurpose_mapped_shortcodes, 'tdc_sort_name');


					// Row
					$data_shortcode_settings = get_data_shortcode_settings(  $top_mapped_shortcodes['vc_row'] );

					echo '<div class="tdc-sidebar-element tdc-row-temp" data-shortcode-name="' . $top_mapped_shortcodes['vc_row']['base'] . '" ' . $data_shortcode_settings . '>' .
							'<div class="tdc-element-ico tdc-ico-' . $top_mapped_shortcodes['vc_row']['base'] . '"></div>' .
							'<div class="tdc-element-id">' . $top_mapped_shortcodes['vc_row']['name'] . '</div>' .
				        '</div>';

					// Inner Row
					$data_shortcode_settings = get_data_shortcode_settings(  $top_mapped_shortcodes['vc_row_inner'] );

					echo
						'<div class="tdc-sidebar-element tdc-element-inner-row-temp" data-shortcode-name="' . $top_mapped_shortcodes['vc_row_inner']['base'] . '" ' . $data_shortcode_settings . '>' .
							'<div class="tdc-element-ico tdc-ico-' . $top_mapped_shortcodes['vc_row_inner']['base'] . '"></div>' .
							'<div class="tdc-element-id">' . $top_mapped_shortcodes['vc_row_inner']['name'] . '</div>' .
					    '</div>';

					// Empty space
					$data_shortcode_settings = get_data_shortcode_settings(  $top_mapped_shortcodes['vc_empty_space'] );

					echo
						'<div class="tdc-sidebar-element tdc-element" data-shortcode-name="' . $top_mapped_shortcodes['vc_empty_space']['base'] . '" ' . $data_shortcode_settings . '>' .
							'<div class="tdc-element-ico tdc-ico-' . $top_mapped_shortcodes['vc_empty_space']['base'] . '"></div>' .
							'<div class="tdc-element-id">' . $top_mapped_shortcodes['vc_empty_space']['name'] . '</div>' .
						'</div>';


					if ( ! empty( $block_mapped_shortcodes ) ) {

						// Separator
						echo '<div class="tdc-sidebar-separator">Block shortcodes</div>';

						foreach ( $block_mapped_shortcodes as $mapped_shortcode ) {
							if ( isset( $mapped_shortcode['map_in_td_composer'] ) && true === $mapped_shortcode['map_in_td_composer'] ) {

								$data_row_start_values = '';

								if ( isset( $mapped_shortcode['tdc_in_row'] ) && true === $mapped_shortcode['tdc_in_row'] ) {
									$tdc_class = 'tdc-element-with-row tdc-row-temp';
								} else {
									$tdc_class = 'tdc-element';
								}

								$data_shortcode_settings = get_data_shortcode_settings( $mapped_shortcode );

								$buffer =
									'<div class="tdc-sidebar-element ' . $tdc_class . '" data-shortcode-name="' . $mapped_shortcode['base'] . '" ' . $data_shortcode_settings . '>' .
									'<div class="tdc-element-ico tdc-ico-' . $mapped_shortcode['base'] . '"></div>' .
									'<div class="tdc-element-id">' . $mapped_shortcode['name'] . '</div>' .
									'</div>';

								echo $buffer;
							}
						}
					}

					if ( ! empty( $big_grids_mapped_shortcodes ) ) {

						// Separator
						echo '<div class="tdc-sidebar-separator">Big Grid shortcodes</div>';

						foreach ( $big_grids_mapped_shortcodes as $mapped_shortcode ) {
							if ( isset( $mapped_shortcode['map_in_td_composer'] ) && true === $mapped_shortcode['map_in_td_composer'] ) {

								$data_row_start_values = '';

								if ( isset( $mapped_shortcode['tdc_in_row'] ) && true === $mapped_shortcode['tdc_in_row'] ) {
									$tdc_class = 'tdc-element-with-row tdc-row-temp';
									if ( isset( $mapped_shortcode['tdc_row_start_values'] ) ) {
										$data_row_start_values = ' data-row-start-values="' . $mapped_shortcode['tdc_row_start_values'] . '" ';
									}
								} else {
									$tdc_class = 'tdc-element';
								}

								$data_shortcode_settings = get_data_shortcode_settings( $mapped_shortcode );

								$buffer =
									'<div class="tdc-sidebar-element ' . $tdc_class . '" data-shortcode-name="' . $mapped_shortcode['base'] . '" ' . $data_shortcode_settings . '>' .
									'<div class="tdc-element-ico tdc-ico-' . $mapped_shortcode['base'] . '"></div>' .
									'<div class="tdc-element-id">' . $mapped_shortcode['name'] . '</div>' .
									'</div>';

								echo $buffer;
							}
						}
					}

//                    if ( ! empty( $header_mapped_shortcodes ) ) {
//
//                        // Separator
//                        echo '<div class="tdc-sidebar-separator">Header shortcodes</div>';
//
//                        foreach ( $header_mapped_shortcodes as $mapped_shortcode ) {
//                            if ( isset( $mapped_shortcode['map_in_td_composer'] ) && true === $mapped_shortcode['map_in_td_composer'] ) {
//
//                                $data_row_start_values = '';
//
//                                if ( isset( $mapped_shortcode['tdc_in_row'] ) && true === $mapped_shortcode['tdc_in_row'] ) {
//                                    $tdc_class = 'tdc-element-with-row tdc-row-temp';
//                                    if ( isset( $mapped_shortcode['tdc_row_start_values'] ) ) {
//                                        $data_row_start_values = ' data-row-start-values="' . $mapped_shortcode['tdc_row_start_values'] . '" ';
//                                    }
//                                } else {
//                                    $tdc_class = 'tdc-element';
//                                }
//
//                                $data_shortcode_settings = get_data_shortcode_settings( $mapped_shortcode );
//
//                                $buffer =
//                                    '<div class="tdc-sidebar-element ' . $tdc_class . '" data-shortcode-name="' . $mapped_shortcode['base'] . '" ' . $data_shortcode_settings . '>' .
//                                    '<div class="tdc-element-ico tdc-ico-' . $mapped_shortcode['base'] . '"></div>' .
//                                    '<div class="tdc-element-id">' . $mapped_shortcode['name'] . '</div>' .
//                                    '</div>';
//
//                                echo $buffer;
//                            }
//                        }
//                    }

					if ( ! empty( $single_post_mapped_shortcodes ) && 'single' === $tdbTemplateType ) {

						// Separator
						echo '<div class="tdc-sidebar-separator">Single Post shortcodes</div>';

						// Here will be displayed the extended shortcodes
						foreach ( $single_post_mapped_shortcodes as $mapped_shortcode ) {

							$data_row_start_values = '';

							if ( isset( $mapped_shortcode['tdc_in_row'] ) && true === $mapped_shortcode['tdc_in_row'] ) {
								$tdc_class = 'tdc-element-with-row tdc-row-temp';
								if ( isset( $mapped_shortcode['tdc_row_start_values'] ) ) {
									$data_row_start_values = ' data-row-start-values="' . $mapped_shortcode['tdc_row_start_values'] . '" ';
								}
							} else {
								$tdc_class = 'tdc-element';
							}

							$data_shortcode_settings = get_data_shortcode_settings( $mapped_shortcode );

							$buffer =
								'<div class="tdc-sidebar-element ' . $tdc_class . '" data-shortcode-name="' . $mapped_shortcode['base'] . '" ' . $data_shortcode_settings . '>' .
								'<div class="tdc-element-ico tdc-ico-' . $mapped_shortcode['base'] . '"></div>' .
								'<div class="tdc-element-id">' . $mapped_shortcode['name'] . '</div>' .
								'</div>';

							echo $buffer;
						}
					}

                    if ( ! empty( $category_page_mapped_shortcodes ) && 'category' === $tdbTemplateType ) {

                        // Separator
                        echo '<div class="tdc-sidebar-separator">Category Page shortcodes</div>';

                        // Here will be displayed the extended shortcodes
                        foreach ( $category_page_mapped_shortcodes as $mapped_shortcode ) {

                            $data_row_start_values = '';

                            if ( isset( $mapped_shortcode['tdc_in_row'] ) && true === $mapped_shortcode['tdc_in_row'] ) {
                                $tdc_class = 'tdc-element-with-row tdc-row-temp';
                                if ( isset( $mapped_shortcode['tdc_row_start_values'] ) ) {
                                    $data_row_start_values = ' data-row-start-values="' . $mapped_shortcode['tdc_row_start_values'] . '" ';
                                }
                            } else {
                                $tdc_class = 'tdc-element';
                            }

                            $data_shortcode_settings = get_data_shortcode_settings( $mapped_shortcode );

                            $buffer =
                                '<div class="tdc-sidebar-element ' . $tdc_class . '" data-shortcode-name="' . $mapped_shortcode['base'] . '" ' . $data_shortcode_settings . '>' .
                                '<div class="tdc-element-ico tdc-ico-' . $mapped_shortcode['base'] . '"></div>' .
                                '<div class="tdc-element-id">' . $mapped_shortcode['name'] . '</div>' .
                                '</div>';

                            echo $buffer;
                        }
                    }

                    if ( ! empty( $tag_page_mapped_shortcodes ) && 'tag' === $tdbTemplateType ) {

                        // Separator
                        echo '<div class="tdc-sidebar-separator">Tag Page shortcodes</div>';

                        // Here will be displayed the extended shortcodes
                        foreach ( $tag_page_mapped_shortcodes as $mapped_shortcode ) {

                            $data_row_start_values = '';

                            if ( isset( $mapped_shortcode['tdc_in_row'] ) && true === $mapped_shortcode['tdc_in_row'] ) {
                                $tdc_class = 'tdc-element-with-row tdc-row-temp';
                                if ( isset( $mapped_shortcode['tdc_row_start_values'] ) ) {
                                    $data_row_start_values = ' data-row-start-values="' . $mapped_shortcode['tdc_row_start_values'] . '" ';
                                }
                            } else {
                                $tdc_class = 'tdc-element';
                            }

                            $data_shortcode_settings = get_data_shortcode_settings( $mapped_shortcode );

                            $buffer =
                                '<div class="tdc-sidebar-element ' . $tdc_class . '" data-shortcode-name="' . $mapped_shortcode['base'] . '" ' . $data_shortcode_settings . '>' .
                                '<div class="tdc-element-ico tdc-ico-' . $mapped_shortcode['base'] . '"></div>' .
                                '<div class="tdc-element-id">' . $mapped_shortcode['name'] . '</div>' .
                                '</div>';

                            echo $buffer;
                        }
                    }

                    if ( ! empty( $author_page_mapped_shortcodes ) && 'author' === $tdbTemplateType ) {

                        // Separator
                        echo '<div class="tdc-sidebar-separator">Author Page shortcodes</div>';

                        // Here will be displayed the author page shortcodes
                        foreach ( $author_page_mapped_shortcodes as $mapped_shortcode ) {

                            $data_row_start_values = '';

                            if ( isset( $mapped_shortcode['tdc_in_row'] ) && true === $mapped_shortcode['tdc_in_row'] ) {
                                $tdc_class = 'tdc-element-with-row tdc-row-temp';
                                if ( isset( $mapped_shortcode['tdc_row_start_values'] ) ) {
                                    $data_row_start_values = ' data-row-start-values="' . $mapped_shortcode['tdc_row_start_values'] . '" ';
                                }
                            } else {
                                $tdc_class = 'tdc-element';
                            }

                            $data_shortcode_settings = get_data_shortcode_settings( $mapped_shortcode );

                            $buffer =
                                '<div class="tdc-sidebar-element ' . $tdc_class . '" data-shortcode-name="' . $mapped_shortcode['base'] . '" ' . $data_shortcode_settings . '>' .
                                '<div class="tdc-element-ico tdc-ico-' . $mapped_shortcode['base'] . '"></div>' .
                                '<div class="tdc-element-id">' . $mapped_shortcode['name'] . '</div>' .
                                '</div>';

                            echo $buffer;
                        }
                    }

                    if ( ! empty( $search_page_mapped_shortcodes ) && 'search' === $tdbTemplateType ) {

                        // Separator
                        echo '<div class="tdc-sidebar-separator">Search Page shortcodes</div>';

                        // Here will be displayed the search page shortcodes
                        foreach ( $search_page_mapped_shortcodes as $mapped_shortcode ) {

                            $data_row_start_values = '';

                            if ( isset( $mapped_shortcode['tdc_in_row'] ) && true === $mapped_shortcode['tdc_in_row'] ) {
                                $tdc_class = 'tdc-element-with-row tdc-row-temp';
                                if ( isset( $mapped_shortcode['tdc_row_start_values'] ) ) {
                                    $data_row_start_values = ' data-row-start-values="' . $mapped_shortcode['tdc_row_start_values'] . '" ';
                                }
                            } else {
                                $tdc_class = 'tdc-element';
                            }

                            $data_shortcode_settings = get_data_shortcode_settings( $mapped_shortcode );

                            $buffer =
                                '<div class="tdc-sidebar-element ' . $tdc_class . '" data-shortcode-name="' . $mapped_shortcode['base'] . '" ' . $data_shortcode_settings . '>' .
                                '<div class="tdc-element-ico tdc-ico-' . $mapped_shortcode['base'] . '"></div>' .
                                '<div class="tdc-element-id">' . $mapped_shortcode['name'] . '</div>' .
                                '</div>';

                            echo $buffer;
                        }
                    }

                    if ( ! empty( $attachment_page_mapped_shortcodes ) && 'attachment' === $tdbTemplateType ) {

                        // Separator
                        echo '<div class="tdc-sidebar-separator">Attachment Page shortcodes</div>';

                        // Here will be displayed the search page shortcodes
                        foreach ( $attachment_page_mapped_shortcodes as $mapped_shortcode ) {

                            $data_row_start_values = '';

                            if ( isset( $mapped_shortcode['tdc_in_row'] ) && true === $mapped_shortcode['tdc_in_row'] ) {
                                $tdc_class = 'tdc-element-with-row tdc-row-temp';
                                if ( isset( $mapped_shortcode['tdc_row_start_values'] ) ) {
                                    $data_row_start_values = ' data-row-start-values="' . $mapped_shortcode['tdc_row_start_values'] . '" ';
                                }
                            } else {
                                $tdc_class = 'tdc-element';
                            }

                            $data_shortcode_settings = get_data_shortcode_settings( $mapped_shortcode );

                            $buffer =
                                '<div class="tdc-sidebar-element ' . $tdc_class . '" data-shortcode-name="' . $mapped_shortcode['base'] . '" ' . $data_shortcode_settings . '>' .
                                '<div class="tdc-element-ico tdc-ico-' . $mapped_shortcode['base'] . '"></div>' .
                                '<div class="tdc-element-id">' . $mapped_shortcode['name'] . '</div>' .
                                '</div>';

                            echo $buffer;
                        }
                    }

                    if ( ! empty( $common_page_el_mapped_shortcodes ) && ! empty( $tdbTemplateType ) && 'page' !== $tdbTemplateType ) {

                        // Separator
                        echo '<div class="tdc-sidebar-separator">Common Page Elements shortcodes</div>';

                        // Here will be displayed the common page shortcodes
                        foreach ( $common_page_el_mapped_shortcodes as $mapped_shortcode ) {

                            if ( 'single' === $tdbTemplateType && ( $mapped_shortcode['base'] === 'tdb_loop' || $mapped_shortcode['base'] === 'tdb_loop_2' ) )
                                continue;

                            $data_row_start_values = '';

                            if ( isset( $mapped_shortcode['tdc_in_row'] ) && true === $mapped_shortcode['tdc_in_row'] ) {
                                $tdc_class = 'tdc-element-with-row tdc-row-temp';
                                if ( isset( $mapped_shortcode['tdc_row_start_values'] ) ) {
                                    $data_row_start_values = ' data-row-start-values="' . $mapped_shortcode['tdc_row_start_values'] . '" ';
                                }
                            } else {
                                $tdc_class = 'tdc-element';
                            }

                            $data_shortcode_settings = get_data_shortcode_settings( $mapped_shortcode );

                            $buffer =
                                '<div class="tdc-sidebar-element ' . $tdc_class . '" data-shortcode-name="' . $mapped_shortcode['base'] . '" ' . $data_shortcode_settings . '>' .
                                '<div class="tdc-element-ico tdc-ico-' . $mapped_shortcode['base'] . '"></div>' .
                                '<div class="tdc-element-id">' . $mapped_shortcode['name'] . '</div>' .
                                '</div>';

                            echo $buffer;
                        }
                    }


					if ( ! empty( $extended_mapped_shortcodes ) ) {

						// Separator
						echo '<div class="tdc-sidebar-separator">Extended shortcodes</div>';

						// Here will be displayed the extended shortcodes
						foreach ( $extended_mapped_shortcodes as $mapped_shortcode ) {

							$data_row_start_values = '';

							if ( isset( $mapped_shortcode['tdc_in_row'] ) && true === $mapped_shortcode['tdc_in_row'] ) {
								$tdc_class = 'tdc-element-with-row tdc-row-temp';
								if ( isset( $mapped_shortcode['tdc_row_start_values'] ) ) {
									$data_row_start_values = ' data-row-start-values="' . $mapped_shortcode['tdc_row_start_values'] . '" ';
								}
							} else {
								$tdc_class = 'tdc-element';
							}

							$data_shortcode_settings = get_data_shortcode_settings( $mapped_shortcode );

							$buffer =
								'<div class="tdc-sidebar-element ' . $tdc_class . '" data-shortcode-name="' . $mapped_shortcode['base'] . '" ' . $data_shortcode_settings . '>' .
								'<div class="tdc-element-ico tdc-ico-' . $mapped_shortcode['base'] . '"></div>' .
								'<div class="tdc-element-id">' . $mapped_shortcode['name'] . '</div>' .
								'</div>';

							echo $buffer;
						}
					}


					if ( ! empty( $external_mapped_shortcodes ) ) {

						// Separator
						echo '<div class="tdc-sidebar-separator">External shortcodes</div>';

						if ( 'page' === $tdbTemplateType ) {
                            foreach ( $common_page_el_mapped_shortcodes as $common_page_el_mapped_shortcode ) {
                                if ( $common_page_el_mapped_shortcode['base'] === 'tdb_loop' || $common_page_el_mapped_shortcode['base'] === 'tdb_loop_2' ) {
                                    $external_mapped_shortcodes[] = $common_page_el_mapped_shortcode;
                                }
                            }
                        }

						// Here will be displayed the external shortcodes
						foreach ( $external_mapped_shortcodes as $mapped_shortcode ) {

							$data_row_start_values = '';

							if ( isset( $mapped_shortcode['tdc_in_row'] ) && true === $mapped_shortcode['tdc_in_row'] ) {
								$tdc_class = 'tdc-element-with-row tdc-row-temp';
							} else {
								$tdc_class = 'tdc-element';
							}

							$data_shortcode_settings = get_data_shortcode_settings( $mapped_shortcode );

							$buffer =
								'<div class="tdc-sidebar-element ' . $tdc_class . '" data-shortcode-name="' . $mapped_shortcode['base'] . '" ' . $data_shortcode_settings . '>' .
								'<div class="tdc-element-ico tdc-ico-' . $mapped_shortcode['base'] . '"></div>' .
								'<div class="tdc-element-id">' . $mapped_shortcode['name'] . '</div>' .
								'</div>';

							echo $buffer;
						}
					}


					if ( ! empty( $multipurpose_mapped_shortcodes ) ) {

						// Separator
						echo '<div class="tdc-sidebar-separator">Multipurpose shortcodes</div>';

						// Here will be displayed the multipurpose shortcodes
						foreach ( $multipurpose_mapped_shortcodes as $mapped_shortcode ) {

							$data_row_start_values = '';

							if ( isset( $mapped_shortcode['tdc_in_row'] ) && true === $mapped_shortcode['tdc_in_row'] ) {
								$tdc_class = 'tdc-element-with-row tdc-row-temp';
							} else {
								$tdc_class = 'tdc-element';
							}

							$data_shortcode_settings = get_data_shortcode_settings( $mapped_shortcode );

							$buffer =
								'<div class="tdc-sidebar-element ' . $tdc_class . '" data-shortcode-name="' . $mapped_shortcode['base'] . '" ' . $data_shortcode_settings . '>' .
								'<div class="tdc-element-ico tdc-ico-' . $mapped_shortcode['base'] . '"></div>' .
								'<div class="tdc-element-id">' . $mapped_shortcode['name'] . '</div>' .
								'</div>';

							echo $buffer;
						}
					}


					if ( ! empty( $template_shortcodes ) ) {

						// Separator
						echo '<div class="tdc-sidebar-separator">Template shortcodes</div>';

						// Here will be displayed the template shortcodes
						foreach ( $template_shortcodes as $template_id => $template_shortcode ) {

							$buffer =
								'<div class="tdc-sidebar-element tdc-row-temp" data-template-content="' . $template_shortcode['content'] . '" data-shortcode-name="vc_row">' .
								'<div class="tdc-element-ico tdc-ico-template"></div>' .
								'<div class="tdc-element-id">' . $template_shortcode['name'] . '</div>' .
								'</div>';

							echo $buffer;
						}
					}

					// Separator
					echo '<div class="tdc-sidebar-separator tdc-sidebar-saved-shortcodes">Saved shortcodes</div>';

					?>
				</div>
			</div>
		</div>


		<!-- modal window -->
		<div class="tdc-sidebar-modal tdc-sidebar-modal-menu" data-button_class="tdc-main-menu">
			<div class="tdc-sidebar-modal-content">
				<div id="tdc-theme-panel">
					<?php
						require_once( plugin_dir_path( __FILE__ ) . '../panel/tdc_header.php');
					?>
				</div>
			</div>
		</div>

		<div id="tdc-icon-selector">
			<div class="tdc-icon-selector-head">
				<select class="tdc-icon-selector-lib"><option value="">All</option>

					<?php
					foreach ( tdc_config::$font_settings as $font_id => $font_settings ) {
						if ( 'Newspaper' !== TD_THEME_NAME && 'font_newspaper' == $font_id ) {
							continue;
						}
						echo '<option value="' . $font_id . '">' . $font_settings['name'] . '</option>';
					}
					?>

				</select>
				<div class="tdc-icon-selector-wrap">
					<input class="tdc-icon-selector-filter" placeholder="Search icon..." type="text"/>
				</div>
			</div>
			<div class="tdc-icon-selector-content-wrap">
				<div class="tdc-icon-selector-content">

					<?php
					$buffer = '';

					foreach ( tdc_config::$font_settings as $font_id => $font_settings ) {
						if ( 'Newspaper' !== TD_THEME_NAME && 'font_newspaper' == $font_id ) {
							continue;
						}
						$buffer .= '<div class="tdc-font-separator" data-font_id="' . $font_id . '">' . $font_settings['name'] . '</div>';

						ob_start();
							include_once( $font_settings['template_file'] );
						$buffer .= ob_get_clean();
					}

					echo $buffer;
					?>

				</div>
			</div>
		</div>

		<div id="tdc-palette">
			<input type="text" val="" id="tdc-palette-color-picker"/>
		</div>

		<div id="tdc-gradient">
			<input type="text" val="" id="tdc-gradient-color-picker"/>
		</div>

		<div id="tdc-font-list">
		</div>

		<?php

		// Extensions add content
		do_action( 'tdc_extension_content' );

		?>

	</div>

	<div id="tdc-context-menu">
		<ul>
			<li class="tdc-current-type separator"></li>
            <li class="tdc-cut-shortcode">Cut<span>CTRL + X</span></li>
			<li class="tdc-copy-shortcode">Copy<span>CTRL + C</span></li>
			<li class="tdc-paste-shortcode-before">Paste Before<span>CTRL + SHIFT + V</span></li>
			<li class="tdc-paste-shortcode-after separator space">Paste After<span>CTRL + C</span></li>
			<li class="tdc-copy-style active">Copy Style</li>
			<li class="tdc-paste-style separator space">Paste Style</li>
			<li class="tdc-reset-style separator space">Reset Style</li>
			<li class="tdc-save-shortcode">Save as Element<span>SHIFT + S</span></li>
			<li class="tdc-delete-shortcode">Delete<span>DEL</span></li>
			<li class="tdc-clone-shortcode">Duplicate<span>CTRL + D</span></li>
			<li class="tdc-clear-shortcode">Clear</li>
		</ul>
	</div>


	<!-- The live iFrame loads in this wrapper :) -->
	<div id="tdc-live-iframe-wrapper" class="tdc-live-iframe-wrapper-inline"></div>

	<div id="tdc-iframe-cover"></div>

	<div style="height: 1px; visibility: hidden; overflow: hidden;">

		<?php
		//$is_IE = false;   // used by wp-admin/edit-form-advanced.php
		//require_once ABSPATH . 'wp-admin/edit-form-advanced.php';
		?>

	</div>


	<div id="tdc-menu-settings">
		<header>
			<div class="title"></div>
			<div class="tdc-iframe-close-button"></div>
		</header>
		<div class="content"></div>
		<footer>
			<div class="tdc-iframe-apply-button"></div>
			<div class="tdc-iframe-ok-button"></div>
		</footer>
	</div>

	<div id="tdc-wpeditor">
		<header>
			<div id="title">WP Editor</div>
			<div class="tdc-iframe-close-button"></div>
		</header>
		<div class="content"></div>
	</div>

	<div id="tdc-page-settings">
		<header>
			<div class="title"></div>
			<div class="tdc-iframe-close-button"></div>
		</header>
		<div class="content"></div>
		<footer>
			<div class="tdc-iframe-apply-button"></div>
			<div class="tdc-iframe-ok-button"></div>
		</footer>
	</div>




<?php
require_once( ABSPATH . 'wp-admin/admin-footer.php' );


