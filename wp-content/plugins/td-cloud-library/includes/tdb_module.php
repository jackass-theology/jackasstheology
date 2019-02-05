<?php

abstract class tdb_module {

    var $post;
    var $title_attribute;
    var $title;
    var $href;

    private $module_atts = array();

    protected $td_review;
    protected $is_review = false;

    protected $post_thumb_id = NULL;

    function __construct( $post_data_array, $module_atts = array() ) {

        $this->module_atts     = $module_atts;
        $this->post            = $post_data_array;
        $this->title           = $this->post['post_title'];
        $this->title_attribute = $this->post['post_title_attribute'];
        $this->href            = $this->post['post_link'];

        if ( has_post_thumbnail( $this->post['post_id'] ) ) {
            $tmp_get_post_thumbnail_id = get_post_thumbnail_id( $this->post['post_id'] );
            if ( !empty( $tmp_get_post_thumbnail_id ) ) {
                $this->post_thumb_id = $tmp_get_post_thumbnail_id;
            }
        }

        //get the review metadata
        //$this->td_review = get_post_meta($this->post->ID, 'td_review', true); @todo $this->td_review variable name must be replaced and the 'get_quotes_on_blocks', 'get_category' methods also
        $this->td_review = td_util::get_post_meta_array($this->post['post_id'], 'td_post_theme_settings');

        //var_dump($this->post);

        if (!empty($this->td_review['has_review']) and (
                !empty($this->td_review['p_review_stars']) or
                !empty($this->td_review['p_review_percents']) or
                !empty($this->td_review['p_review_points'])
            )
        ) {
            $this->is_review = true;
        }
    }


    function get_module_classes( $additional_classes_array = '' ) {
        //add the wrap and module id class
        $buffy = get_class( $this );


	    // each module setting has a 'class' key to customize css
	    $module_class = td_api_module::get_key( get_class( $this ), 'class' );

	    if ( $module_class != '' ) {
		    $buffy .= ' ' . $module_class;
	    }


        //show no thumb only if no thumb is detected and image placeholders are disabled
        if ( is_null( $this->post_thumb_id ) and td_util::get_option( 'tds_hide_featured_image_placeholder' ) == 'hide_placeholder' ) {
            $buffy .= ' td_module_no_thumb';
        }

        // fix the meta info space when all options are off
        if ( td_util::get_option('tds_m_show_author_name') == 'hide' and td_util::get_option( 'tds_m_show_date' ) == 'hide' and td_util::get_option( 'tds_m_show_comments' ) == 'hide' ) {
            $buffy .= ' td-meta-info-hide';
        }

	    if ( $additional_classes_array != '' && is_array( $additional_classes_array ) ) {
		    $buffy .= ' ' . implode( ' ', $additional_classes_array );
	    }

        return $buffy;
    }

    function get_author_photo() {
        $buffy = '';

        $buffy .= '<a href="' . $this->post['post_author_url'] . '" class="tdb-author-photo">' . get_avatar( $this->post['post_author_email'], '96' ) . '</a>';

        return $buffy;
    }

    function get_author() {
        $buffy = '';

        if (td_util::get_option('tds_m_show_author_name') != 'hide') {
            $buffy .= '<span class="td-post-author-name">';
                $buffy .= '<a href="' . $this->post['post_author_url'] . '">' . $this->post['post_author_name'] . '</a>';
                if (td_util::get_option('tds_m_show_author_name') != 'hide' and td_util::get_option('tds_m_show_date') != 'hide') {
                    $buffy .= ' <span>-</span> ';
                }
            $buffy .= '</span>';
        }

        return $buffy;
    }

    function get_date() {
        $visibility_class = '';
        if ( td_util::get_option('tds_m_show_date') == 'hide' ) {
            $visibility_class = ' td-visibility-hidden';
        }

        $buffy = '';

        if (td_util::get_option('tds_m_show_date') != 'hide') {
            $buffy .= '<span class="td-post-date">';
                $buffy .= '<time class="entry-date updated td-module-date' . $visibility_class . '" datetime="' . date(DATE_W3C, $this->post['post_date_unix']) . '" >' . $this->post['post_date'] . '</time>';
            $buffy .= '</span>';
        }

        return $buffy;
    }

    function get_review() {
        $buffy = '';

        if ($this->is_review and td_util::get_option('tds_m_show_review') != 'hide' ) {
            $buffy .= '<div class="entry-review-stars">';
                $buffy .= td_review::render_stars($this->td_review);
            $buffy .= '</div>';
        }

        return $buffy;
    }

    function get_comments() {
        $buffy = '';
        if ( td_util::get_option('tds_m_show_comments') != 'hide' ) {
            $buffy .= '<div class="td-module-comments">';
                $buffy .= '<a href="' . $this->post['post_comments_link'] . '">';
                    $buffy .= $this->post['post_comments_no'];
                $buffy .= '</a>';
            $buffy .= '</div>';
        }

        return $buffy;
    }

    function get_title( $cut_at = '' ) {
        $buffy = '';
        $buffy .= '<h3 class="entry-title td-module-title">';
        $buffy .='<a href="' . $this->href . '" rel="bookmark" title="' . $this->title_attribute . '">';

        //see if we have to cut the title and if we have the title lenght in the panel for ex: td_module_6__title_excerpt
        if ( $cut_at != '' ) {
            //cut at the hard coded size
            $buffy .= td_util::excerpt( $this->title, $cut_at, 'show_shortcodes' );

        } else {
            $current_module_class = get_class( $this );

            //see if we have a default setting for this module, and if so only apply it if we don't get other things form theme panel.
            if ( td_api_module::_helper_check_excerpt_title( $current_module_class ) ) {
                $db_title_excerpt = td_util::get_option($current_module_class . '_title_excerpt');
                if ( $db_title_excerpt != '' ) {
                    //cut from the database settings
                    $buffy .= td_util::excerpt( $this->title, $db_title_excerpt, 'show_shortcodes' );
                } else {
                    //cut at the default size
                    $module_api = td_api_module::get_by_id( $current_module_class );
                    $buffy .= td_util::excerpt( $this->title, $module_api['excerpt_title'], 'show_shortcodes' );
                }
            } else {
                /**
                 * no $cut_at provided and no setting in td_config -> return the full title
                 * @see td_global::$modules_list
                 */
                $buffy .= $this->title;
            }

        }
        $buffy .='</a>';
        $buffy .= '</h3>';
        return $buffy;
    }

    /**
     * refactored 12.10.2018 - removed the css image parameter and the classic <img> tag type images, now all tdb modules use css images
     * @param $thumbType
     * @return string
     */
    function get_image( $thumbType ) {

        $buffy = '';

            if ( !is_null( $this->post_thumb_id ) ) {

                if ( td_util::get_option( 'tds_thumb_' . $thumbType ) != 'yes' and $thumbType != 'thumbnail' ) {

                    //the thumb is disabled, show a placeholder thumb from the theme with the "thumb disabled" message
                    global $_wp_additional_image_sizes;

                    if ( empty( $_wp_additional_image_sizes[$thumbType]['width'] ) ) {
                        $td_temp_image_url[1] = '';
                    } else {
                        $td_temp_image_url[1] = $_wp_additional_image_sizes[$thumbType]['width'];
                    }

                    if ( empty( $_wp_additional_image_sizes[$thumbType]['height'] ) ) {
                        $td_temp_image_url[2] = '';
                    } else {
                        $td_temp_image_url[2] = $_wp_additional_image_sizes[$thumbType]['height'];
                    }

                    // For custom WordPress sizes (not 'thumbnail', 'medium', 'medium_large' or 'large'), get the image path using the api (no_image_path)
                    $thumb_disabled_path = td_global::$get_template_directory_uri;

                    if ( strpos( $thumbType, 'td_') === 0 ) {
                        $thumb_disabled_path = td_api_thumb::get_key( $thumbType, 'no_image_path' );
                    }

                    $td_temp_image_url[0] = $thumb_disabled_path . '/images/thumb-disabled/' . $thumbType . '.png';

                } else {

                    // the thumb is enabled from the panel, it's time to show the real thumb
                    $td_temp_image_url = wp_get_attachment_image_src( $this->post_thumb_id, $thumbType );

                    if ( empty( $td_temp_image_url[0] ) ) {
                        $td_temp_image_url[0] = '';
                    }

                    if ( empty( $td_temp_image_url[1] ) ) {
                        $td_temp_image_url[1] = '';
                    }

                    if ( empty( $td_temp_image_url[2] ) ) {
                        $td_temp_image_url[2] = '';
                    }

                }

            } else {

                //we have no thumb use the placeholder
                global $_wp_additional_image_sizes;

                if ( empty( $_wp_additional_image_sizes[$thumbType]['width'] ) ) {
                    $td_temp_image_url[1] = '';
                } else {
                    $td_temp_image_url[1] = $_wp_additional_image_sizes[$thumbType]['width'];
                }

                if ( empty( $_wp_additional_image_sizes[$thumbType]['height'] ) ) {
                    $td_temp_image_url[2] = '';
                } else {
                    $td_temp_image_url[2] = $_wp_additional_image_sizes[$thumbType]['height'];
                }

                /**
                 * get thumb height and width via api
                 * first we check the global in case a custom thumb is used
                 *
                 * The api thumb is checked only for additional sizes registered and if at least one of the settings (width or height) is empty.
                 * This should be enough to avoid getting a non existing id using api thumb.
                 */
                if ( !empty( $_wp_additional_image_sizes ) && array_key_exists( $thumbType, $_wp_additional_image_sizes ) && ( $td_temp_image_url[1] == '' || $td_temp_image_url[2] == '' ) ) {
                    $td_thumb_parameters = td_api_thumb::get_by_id( $thumbType );
                    $td_temp_image_url[1] = $td_thumb_parameters['width'];
                    $td_temp_image_url[2] = $td_thumb_parameters['height'];
                }

                /**
                 * for custom wp sizes (not 'thumbnail', 'medium', 'medium_large' or 'large'), get the image path using the api (no_image_path)
                 */
                $no_thumb_path = td_global::$get_template_directory_uri;

                if ( strpos( $thumbType, 'td_' ) === 0 ) {
                    $no_thumb_path = rtrim( td_api_thumb::get_key( $thumbType, 'no_image_path' ), '/');
                }

                $td_temp_image_url[0] = $no_thumb_path . '/images/no-thumb/' . $thumbType . '.png';
            }

            $buffy .= '<div class="td-module-thumb">';

            // the edit link
            if ( $this->post['post_type'] === 'sample' ) {
                if ( current_user_can( 'edit_published_posts' ) ) {
                    $buffy .= '<a class="td-admin-edit" href="#">edit</a>';
                }
            } else {
                if ( current_user_can( 'edit_published_posts' ) ) {
                    $buffy .= '<a class="td-admin-edit" href="' . get_edit_post_link( $this->post['post_id'] ) . '">edit</a>';
                }
            }

            $buffy .= '<a href="' . $this->href . '" rel="bookmark" class="td-image-wrap" title="' . $this->title_attribute . '">';

            $tds_animation_stack = td_util::get_option('tds_animation_stack');

            // if we have the lazy loading animation on and the we're not on a wp ajax request or on tdc editor iframe or ajax call
            if ( empty( $tds_animation_stack ) && !wp_doing_ajax() && ! td_util::tdc_is_live_editor_ajax() && ! td_util::tdc_is_live_editor_iframe() ) {

            // retina image
            $retina_image = '';

            // here we treat the normal img_tag retina ver
            if ( td_util::get_option('tds_thumb_' . $thumbType . '_retina') == 'yes' && !empty( $td_temp_image_url[1] ) ) {
                $retina_url = wp_get_attachment_image_src( $this->post_thumb_id, $thumbType . '_retina' );
                if ( !empty( $retina_url[0] ) ) {
                    $retina_image = 'data-img-retina-url="' . $retina_url[0] . '"';
                }
            }

            $buffy .= '<span class="entry-thumb td-thumb-css" data-type="css_image" data-img-url="' . $td_temp_image_url[0] . '" ' . $retina_image . '></span>';

        } else {

            // unique id for setting the retina image via style attr
            $retina_uuid = '';

            if ( td_util::get_option('tds_thumb_' . $thumbType . '_retina') == 'yes' && !empty( $td_temp_image_url[1] ) ) {

                $retina_uuid = td_global::td_generate_unique_id();
                $retina_url = wp_get_attachment_image_src( $this->post_thumb_id, $thumbType . '_retina' );

                if ( !empty( $retina_url[0] ) ) {
                    $buffy .= '
                        <style>
                              @media ( -webkit-max-device-pixel-ratio: 2 ) {
                                  .td-thumb-css.' . $retina_uuid . ' {
                                      background-image: url(' . $retina_url[0] . ');
                                  }
                              }
                        </style>';
                }
            }

            $buffy .= '<span class="entry-thumb td-thumb-css ' . $retina_uuid . '" style="background-image: url(' . $td_temp_image_url[0] . ')"></span>';
        }

            // on videos add the play icon
            if ( get_post_format( $this->post['post_id'] ) == 'video' ) {

                $use_small_post_format_icon_size = false;

                // search in all the thumbs for the one that we are currently using here and see if it has post_format_icon_size = small
                foreach ( td_api_thumb::get_all() as $thumb_from_thumb_list ) {
                    if ( $thumb_from_thumb_list['name'] == $thumbType and $thumb_from_thumb_list['post_format_icon_size'] == 'small' ) {
                        $use_small_post_format_icon_size = true;
                        break;
                    }
                }

                // load the small or medium play icon
                if ( $use_small_post_format_icon_size === true ) {
                    $buffy .= '<span class="td-video-play-ico td-video-small"><img width="20" height="20" class="td-retina" src="' . td_global::$get_template_directory_uri . '/images/icons/video-small.png' . '" alt="video"/></span>';
                } else {
                    $buffy .= '<span class="td-video-play-ico"><img width="40" height="40" class="td-retina" src="' . td_global::$get_template_directory_uri . '/images/icons/ico-video-large.png' . '" alt="video"/></span>';
                }
            } // end on video if

            $buffy .= '</a>';
            $buffy .= '</div>'; //end wrapper

        return $buffy;
    }

    function get_excerpt( $cut_at = '' ) {

        //If the user supplied the excerpt in the post excerpt custom field, we just return that
        if ( $this->post['post_excerpt'] != '' ) {
            return $this->post['post_excerpt'];
        }

        $buffy = '';
        if ($cut_at != '') {
            // simple, $cut_at and return
            $buffy .= td_util::excerpt($this->post['post_content'], $cut_at);
        } else {
            $current_module_class = get_class($this);

            //see if we have a default setting for this module, and if so only apply it if we don't get other things form theme panel.
            if ( td_api_module::_helper_check_excerpt_content( $current_module_class ) ) {
                $db_content_excerpt = td_util::get_option($current_module_class . '_content_excerpt');
                if ( $db_content_excerpt != '' ) {
                    //cut from the database settings
                    $buffy .= td_util::excerpt($this->post['post_content'], $db_content_excerpt);
                } else {
                    //cut at the default size
                    $module_api = td_api_module::get_by_id( $current_module_class );
                    $buffy .= td_util::excerpt($this->post['post_content'], $module_api['excerpt_content']);
                }
            } else {
                /**
                 * no $cut_at provided and no setting in td_config -> return the full $this->post->post_content
                 * @see td_global::$modules_list
                 */
                $buffy .= $this->post['post_content'];
            }
        }
        return $buffy;
    }

    function get_category() {

        $buffy = '';
            $selected_category_obj = '';
            $selected_category_obj_id = '';
            $selected_category_obj_name = '';

            //read the post meta to get the custom primary category
            $post_theme_settings = $this->post['post_theme_settings'];

            if ( !empty( $post_theme_settings['td_primary_cat'] ) ) {
                //we have a custom category selected
                $selected_category_obj = get_category( $post_theme_settings['td_primary_cat'] );
            } else {
                //get one auto
                $categories = get_the_category( $this->post['post_id'] );

                if ( is_category() ) {
                    foreach ( $categories as $category ) {
                        if ( $category->term_id == get_query_var('cat') ) {
                            $selected_category_obj = $category;
                            break;
                        }
                    }
                }

                if ( empty( $selected_category_obj ) and !empty( $categories[0] ) ) {
                    if ( $categories[0]->name === TD_FEATURED_CAT and !empty( $categories[1] ) ) {
                        $selected_category_obj = $categories[1];
                    } else {
                        $selected_category_obj = $categories[0];
                    }
                }
            }

            if ( !empty( $selected_category_obj ) ) {
                $selected_category_obj_id = $selected_category_obj->cat_ID;
                $selected_category_obj_name = $selected_category_obj->name;
            }

            if ( !empty( $selected_category_obj_id ) && !empty( $selected_category_obj_name ) ) { //@todo catch error here
                $buffy .= '<a href="' . get_category_link( $selected_category_obj_id ) . '" class="td-post-category">'  . $selected_category_obj_name . '</a>' ;
            }

        return $buffy;
    }

    function get_quotes_on_blocks() {

        //get quotes data from post theme settings
        $post_theme_settings = $this->post['post_theme_settings'];

        if( !empty( $post_theme_settings['td_quote_on_blocks'] ) ) {
            return '<div class="td_quote_on_blocks">' . $post_theme_settings['td_quote_on_blocks'] . '</div>';
        }

        return '';
    }

    function get_shortcode_att( $att_name ) {
        // returns '' if not set - for loops and other places where modules are not in blocks

        if ( empty( $this->module_atts ) ) {
            return '';
        }

        if ( !isset( $this->module_atts[$att_name] ) ) {
            td_util::error(__FILE__, $att_name . ' - Is not mapped in the shortcode that uses this module ( <strong>' . get_class($this) . '</strong>)', $this->module_atts);
            die;
        }

        return $this->module_atts[$att_name];
    }
}