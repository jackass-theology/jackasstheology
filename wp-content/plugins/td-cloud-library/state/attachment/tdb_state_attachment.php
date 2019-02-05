<?php


/**
 * Class tdb_state_attachment
 * @property tdb_method title
 * @property tdb_method attachment_breadcrumbs
 * @property tdb_method attachment_image
 * @property tdb_method attachment_description
 * @property tdb_method attachment_date
 * @property tdb_method attachment_image_links
 * @property tdb_method attachment_pag_prev
 * @property tdb_method attachment_pag_next
 *
 */
class tdb_state_attachment extends tdb_state_base {

    private $attachment_wp_query = '';

    /**
     * @param WP_Query $wp_query
     */
    function set_wp_query( $wp_query ) {

        parent::set_wp_query( $wp_query );
        $this->attachment_wp_query = $this->get_wp_query();
    }



    public function __construct() {

        // attachment page title
        $this->title = function ( $atts ) {

            $dummy_data_array = array(
                'title' => 'Attachment Page Sample Title',
                'class' => 'tdb-attachment-title'
            );

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $title = get_the_title( $this->attachment_wp_query->post->ID );

            $data_array = array(
                'title' => $title,
                'class' => 'tdb-attachment-title'
            );

            if( $title == '' ) {
                if ( tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax() ) {
                    return $dummy_data_array;
                }
            }

            return $data_array;
        };

        // attachment page breadcrumbs
        $this->attachment_breadcrumbs = function ( $atts ) {

            $dummy_data_array = array();
            $show_parent_post = ( $atts['show_parent_post'] != '' ) ? true : false;

            $a_custom_title = ( $atts['attachment_custom_title'] != '' ) ? $atts['attachment_custom_title'] : 'Attachment Sample Title';
            $a_custom_title_att = ( $atts['attachment_custom_title_att'] != '' ) ? $atts['attachment_custom_title_att'] : '';
            $a_custom_link = ( $atts['attachment_custom_link'] != '' ) ? $atts['attachment_custom_link'] : '';

            if ( $show_parent_post ) {
                $dummy_data_array[] = array(
                    'title_attribute' => '',
                    'url' => '',
                    'display_name' => 'Parent Post Sample Title'
                );
            }

            $dummy_data_array[] = array(
                'title_attribute' => $a_custom_title_att,
                'url' => $a_custom_link,
                'display_name' => $a_custom_title
            );

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $parent_post_id = $this->attachment_wp_query->post->post_parent;

            $attachment_custom_title = ( $atts['attachment_custom_title'] != '' ) ? $atts['attachment_custom_title'] : get_the_title( $this->attachment_wp_query->post->ID );
            $attachment_custom_link = ( $atts['attachment_custom_link'] != '' ) ? $atts['attachment_custom_link'] : '';
            $attachment_custom_title_att = ( $atts['attachment_custom_title_att'] != '' ) ? $atts['attachment_custom_title_att'] : get_the_title( $this->attachment_wp_query->post->ID );

            $data_array = array();

            if ( !empty( $parent_post_id ) ) {
                $data_array[] = array(
                    'title_attribute' => get_the_title( $parent_post_id ),
                    'url' => esc_url( get_permalink( $parent_post_id ) ),
                    'display_name' => get_the_title( $parent_post_id )
                );
            }

            $data_array[] = array(
                'title_attribute' => $attachment_custom_title_att,
                'url' => $attachment_custom_link,
                'display_name' => $attachment_custom_title
            );

            return $data_array;

        };

        // attachment page image navigation
        $this->attachment_image_links = function ( $atts ) {

            $no_thumb_placeholder = TDB_URL . '/assets/images/td_meta_replacement_small.png';

            $dummy_data_array = array(
                'previous_image_link' => '<a href="#"><img width="150" height="150" src="' . $no_thumb_placeholder . '" class="attachment-thumbnail size-thumbnail"></a>',
                'next_image_link'     => '<a href="#"><img width="150" height="150" src="' . $no_thumb_placeholder . '" class="attachment-thumbnail size-thumbnail"></a>'
            );

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            global $wp_query;
            $template_wp_query = $wp_query;

            $wp_query = $this->attachment_wp_query;
            $wp_query->rewind_posts();
            the_post();

            ob_start();
            previous_image_link();
            $data_array['previous_image_link'] = ob_get_clean();

            ob_start();
            next_image_link();
            $data_array['next_image_link'] = ob_get_clean();

            $wp_query = $template_wp_query;
            $wp_query->rewind_posts();
            the_post();

            return $data_array;
        };

        // attachment page image navigation
        $this->attachment_pag_prev = function ( $atts ) {

            $no_thumb_placeholder = TDB_URL . '/assets/images/td_meta_replacement_small.png';

            $dummy_data_array = array(
                'previous_image_link' => '<a href="#"><img width="150" height="150" src="' . $no_thumb_placeholder . '" class="attachment-thumbnail size-thumbnail"></a>'
            );

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            global $wp_query;
            $template_wp_query = $wp_query;

            $wp_query = $this->attachment_wp_query;
            $wp_query->rewind_posts();
            the_post();

            ob_start();
            previous_image_link();
            $data_array['previous_image_link'] = ob_get_clean();

            $wp_query = $template_wp_query;
            $wp_query->rewind_posts();
            the_post();

            return $data_array;
        };

        // attachment page image navigation
        $this->attachment_pag_next = function ( $atts ) {

            $no_thumb_placeholder = TDB_URL . '/assets/images/td_meta_replacement_small.png';

            $dummy_data_array = array(
                'next_image_link' => '<a href="#"><img width="150" height="150" src="' . $no_thumb_placeholder . '" class="attachment-thumbnail size-thumbnail"></a>'
            );

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            global $wp_query;
            $template_wp_query = $wp_query;

            $wp_query = $this->attachment_wp_query;
            $wp_query->rewind_posts();
            the_post();

            ob_start();
            next_image_link();
            $data_array['next_image_link'] = ob_get_clean();

            $wp_query = $template_wp_query;
            $wp_query->rewind_posts();
            the_post();

            return $data_array;
        };


        // attachment image
        $this->attachment_image = function ( $atts ) {

            $no_thumb_placeholder = TDB_URL . '/assets/images/td_meta_replacement.png';

            $dummy_data_array = array(
                'is_image' => true,
                'att_url' => '#',
                'att_title' => 'attachment img sample title',
                'src' => $no_thumb_placeholder,
                'alt' => 'attachment img sample alt'
            );

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $is_image = wp_attachment_is_image( $this->attachment_wp_query->post->ID );

            $data_array = array(
                'is_image' => $is_image,
                'att_url' => '',
                'att_title' => '',
                'src' => '',
                'alt' => '',
            );

            if ( $is_image === true ) {

                $att_image = wp_get_attachment_image_src( $this->attachment_wp_query->post->ID, 'full' );

                if ( !empty( $att_image[0] ) ) {
                    $data_array['src'] = $att_image[0];
                }

                $image_data = td_util::get_image_attachment_data( $this->attachment_wp_query->post->post_parent );

                if ( !empty( $image_data->alt )) {
                    $data_array['alt'] = $image_data->alt;
                }

                $data_array['att_url'] = wp_get_attachment_url( $this->attachment_wp_query->post->ID );
                $data_array['att_title'] = get_the_title( $this->attachment_wp_query->post->ID );

            }

            return $data_array;
        };

        // attachment desription
        $this->attachment_description = function ( $atts ) {

            $dummy_data_array = array(
                'description' => 'Sample attachment description.'
            );

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $data_array = array(
                'description' =>   $this->attachment_wp_query->post->post_content
            );

            if( $data_array['description'] == '' ) {
                if ( tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax() ) {
                    return $dummy_data_array;
                }
            }

            return $data_array;

        };

        // attachment date
        $this->attachment_date = function () {

            $current_time = current_time( 'timestamp' );

            $dummy_data_array = array(
                'date'            => date( DATE_W3C, time() ),
                'time'            => date( get_option( 'date_format' ), time() ),
                'human_time_diff' => human_time_diff( strtotime(date( DATE_W3C, strtotime("-1 week") ) ), $current_time ),
            );

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $data_array = array(
                'date' => date( DATE_W3C, get_the_time( 'U', $this->attachment_wp_query->post->ID ) ),
                'time' => get_the_time( get_option( 'date_format' ), $this->attachment_wp_query->post->ID ),
                'human_time_diff' => ''
            );

            $post_time_u  = get_the_time('U', $this->attachment_wp_query->ID );
            $diff = (int) abs( $current_time - $post_time_u );
            if ( $diff < WEEK_IN_SECONDS ) {
                $data_array['human_time_diff'] = human_time_diff( $post_time_u, $current_time );
            }

            return $data_array;

        };

        parent::lock_state_definition();
    }

}