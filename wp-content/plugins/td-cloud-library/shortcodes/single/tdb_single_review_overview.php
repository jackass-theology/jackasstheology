<?php

/**
 * Class tdb_single_review_overview
 */

class tdb_single_review_overview extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @label_padding */
                .$unique_block_class .td-review-row-stars .td-review-desc {
                    padding: @label_padding;
                }
                /* @rating_padding */
                .$unique_block_class .td-review-row-stars .td-review-stars {
                    padding: @rating_padding;
                }

                /* @bg_color */
                .$unique_block_class .td-review-row-stars {
                    background-color: @bg_color;
                }
                /* @bg_h_color */
                .$unique_block_class .td-review-row-stars:hover {
                    background-color: @bg_h_color;
                }
                
                /* @feat_color */
                .$unique_block_class .td-review-row-stars .td-review-desc {
                    color: @feat_color;
                }
                /* @feat_h_color */
                .$unique_block_class .td-review-row-stars:hover .td-review-desc {
                    color: @feat_h_color;
                }
                /* @stars_size */
                .$unique_block_class .td-review-stars i {
                    font-size: @stars_size;
                }
                /* @stars_space */
                .$unique_block_class .td-review-stars i {
                    margin-right: @stars_space;
                }
                .$unique_block_class .td-review-stars i:last-child {
                    margin-right: 0;
                }
                /* @stars_color */
                .$unique_block_class .td-review-stars i {
                    color: @stars_color;
                }
                /* @stars_h_color */
                .$unique_block_class .td-review-row-stars:hover .td-review-stars i {
                    color: @stars_h_color;
                }
                
                /* @label_horiz_align_center */
                .$unique_block_class .td-review-row-stars .td-review-desc {
                    text-align: center;
                }
                /* @label_horiz_align_right */
                .$unique_block_class .td-review-row-stars .td-review-desc {
                    text-align: right;
                }
                /* @rating_horiz_align_left */
                .$unique_block_class .td-review-row-stars .td-review-stars {
                    text-align: left;
                }
                /* @rating_horiz_align_right */
                .$unique_block_class .td-review-row-stars .td-review-stars {
                    text-align: right;
                }
                
                /* @all_border_size */
                .$unique_block_class.tdb-review-overview-stars .td-review {
                    border-width: @all_border_size;
                    border-style: solid;
                }
                /* @row_border_size */
                .$unique_block_class .td-review-row-stars {
                    border-bottom-width: @row_border_size;
                    border-bottom-style: solid;
                }
                /* @sep_border_size */
                .$unique_block_class .td-review-row-stars .td-review-desc {
                    border-right-width: @sep_border_size;
                    border-right-style: solid;
                }
                /* @all_border_color */
                .$unique_block_class.tdb-review-overview-stars .td-review,
                .$unique_block_class .td-review-row-star,
                .$unique_block_class .td-review-row-stars .td-review-desc {
                    border-color: @all_border_color;
                }
                
                
                /* @pp_padding */
                .$unique_block_class .td-review-row-bars td {
                    padding: @pp_padding;
                }
                
                /* @feat_pp_color */
                .$unique_block_class .td-review-row-bars .td-review-desc {
                    color: @feat_pp_color;
                }
                /* @val_color */
                .$unique_block_class .td-review-row-bars .td-review-percent {
                    color: @val_color;
                }
                
                /* @bar_height */
                .$unique_block_class .td-rating-bar-wrap div {
                    height: @bar_height;
                }
                /* @bar_color */
                .$unique_block_class .td-rating-bar-wrap div {
                    background-color: @bar_color;
                }
                /* @bar_gradient */
                .$unique_block_class .td-rating-bar-wrap div {
                    @bar_gradient
                }
                /* @bar_bg_color */
                .$unique_block_class .td-rating-bar-wrap {
                    background-color: @bar_bg_color;
                }
                /* @bar_bg_gradient */
                .$unique_block_class .td-rating-bar-wrap {
                    @bar_bg_gradient
                }
                
                /* @all_pp_border_size */
                .$unique_block_class.tdb-review-overview-pp .td-review {
                    border-width: @all_pp_border_size;
                    border-style: solid;
                }
                /* @pp_row_border_size */
                .$unique_block_class .td-review-row-bars {
                    border-bottom-width: @pp_row_border_size;
                    border-bottom-style: solid;
                }
                /* @all_pp_border_color */
                .$unique_block_class.tdb-review-overview-pp .td-review,
                .$unique_block_class .td-review-row-bars {
                    border-color: @all_pp_border_color;
                }
				


				/* @f_feat */
				.$unique_block_class .td-review-row-stars .td-review-desc {
					@f_feat
				} 
				/* @f_pp_feat */
				.$unique_block_class .td-review-row-bars .td-review-desc {
					@f_pp_feat
				} 
				/* @f_val */
				.$unique_block_class .td-review-row-bars .td-review-percent {
					@f_val
				} 
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        /*-- STARS -- */
        // label padding
        $label_padding = $res_ctx->get_shortcode_att('label_padding');
        $res_ctx->load_settings_raw( 'label_padding', $label_padding );
        if( $label_padding != '' && is_numeric( $label_padding ) ) {
            $res_ctx->load_settings_raw( 'label_padding', $label_padding . 'px' );
        }
        // rating padding
        $rating_padding = $res_ctx->get_shortcode_att('rating_padding');
        $res_ctx->load_settings_raw( 'rating_padding', $rating_padding );
        if( $rating_padding != '' && is_numeric( $rating_padding ) ) {
            $res_ctx->load_settings_raw( 'rating_padding', $rating_padding . 'px' );
        }

        // rows background color
        $res_ctx->load_settings_raw( 'bg_color', $res_ctx->get_shortcode_att('bg_color') );
        // rows background hover color
        $res_ctx->load_settings_raw( 'bg_h_color', $res_ctx->get_shortcode_att('bg_h_color') );

        // features name color
        $res_ctx->load_settings_raw( 'feat_color', $res_ctx->get_shortcode_att('feat_color') );
        // features name hover color
        $res_ctx->load_settings_raw( 'feat_h_color', $res_ctx->get_shortcode_att('feat_h_color') );

        // label horizontal align
        $label_align_horiz = $res_ctx->get_shortcode_att('label_align_horiz');
        if ( $label_align_horiz == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'label_horiz_align_center', 1 );
        } else if ( $label_align_horiz == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'label_horiz_align_right', 1 );
        }
        // rating horizontal align
        $rating_align_horiz = $res_ctx->get_shortcode_att('rating_align_horiz');
        if ( $rating_align_horiz == 'content-horiz-left' ) {
            $res_ctx->load_settings_raw( 'rating_horiz_align_left', 1 );
        } else if ( $rating_align_horiz == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'rating_horiz_align_right', 1 );
        }


        // stars size
        $stars_size = $res_ctx->get_shortcode_att('stars_size');
        if( $stars_size != '' && is_numeric( $stars_size ) ) {
            $res_ctx->load_settings_raw( 'stars_size', $stars_size . 'px' );
        }
        // stars space
        $stars_space = $res_ctx->get_shortcode_att('stars_space');
        if( $stars_space != '' && is_numeric( $stars_space ) ) {
            $res_ctx->load_settings_raw( 'stars_space', $stars_space . 'px' );
        }
        // stars color
        $res_ctx->load_settings_raw( 'stars_color', $res_ctx->get_shortcode_att('stars_color') );
        // stars hover color
        $res_ctx->load_settings_raw( 'stars_h_color', $res_ctx->get_shortcode_att('stars_h_color') );

        // box border size
        $all_border_size = $res_ctx->get_shortcode_att('all_border_size');
        $res_ctx->load_settings_raw( 'all_border_size', '1px' );
        if( $all_border_size != '' && is_numeric( $all_border_size ) ) {
            $res_ctx->load_settings_raw( 'all_border_size', $all_border_size . 'px' );
        }
        // row border size
        $row_border_size = $res_ctx->get_shortcode_att('row_border_size');
        $res_ctx->load_settings_raw( 'row_border_size', '1px' );
        if( $row_border_size != '' && is_numeric( $row_border_size ) ) {
            $res_ctx->load_settings_raw( 'row_border_size', $row_border_size . 'px' );
        }
        // separator border size
        $sep_border_size = $res_ctx->get_shortcode_att('sep_border_size');
        $res_ctx->load_settings_raw( 'sep_border_size', '1px' );
        if( $sep_border_size != '' && is_numeric( $sep_border_size ) ) {
            $res_ctx->load_settings_raw( 'sep_border_size', $sep_border_size . 'px' );
        }
        // borders color
        $all_border_color = $res_ctx->get_shortcode_att('all_border_color');
        $res_ctx->load_settings_raw( 'all_border_color', '#ededed' );
        if( $all_border_color != '' ) {
            $res_ctx->load_settings_raw( 'all_border_color', $all_border_color );
        }



        /*-- PERCENTAGES & POINTS -- */
        // row padding
        $pp_padding = $res_ctx->get_shortcode_att('pp_padding');
        $res_ctx->load_settings_raw( 'pp_padding', $pp_padding );
        if( $pp_padding != '' && is_numeric( $pp_padding ) ) {
            $res_ctx->load_settings_raw( 'pp_padding', $pp_padding . 'px' );
        }

        // features name color
        $res_ctx->load_settings_raw( 'feat_pp_color', $res_ctx->get_shortcode_att('feat_pp_color') );
        // values text color
        $res_ctx->load_settings_raw( 'val_color', $res_ctx->get_shortcode_att('val_color') );

        // bar height
        $bar_height = $res_ctx->get_shortcode_att('bar_height');
        $res_ctx->load_settings_raw( 'bar_height', $bar_height );
        if( $bar_height != '' && is_numeric( $bar_height ) ) {
            $res_ctx->load_settings_raw( 'bar_height', $bar_height . 'px' );
        }
        // bar color
        $res_ctx->load_color_settings( 'bar_color', 'bar_color', 'bar_gradient', '', '' );
        // bar background color
        $res_ctx->load_color_settings( 'bar_bg_color', 'bar_bg_color', 'bar_bg_gradient', '', '' );

        // box border size
        $all_pp_border_size = $res_ctx->get_shortcode_att('all_pp_border_size');
        $res_ctx->load_settings_raw( 'all_pp_border_size', '1px' );
        if( $all_pp_border_size != '' && is_numeric( $all_pp_border_size ) ) {
            $res_ctx->load_settings_raw( 'all_pp_border_size', $all_pp_border_size . 'px' );
        }
        // row border size
        $pp_row_border_size = $res_ctx->get_shortcode_att('pp_row_border_size');
        $res_ctx->load_settings_raw( 'pp_row_border_size', $pp_row_border_size );
        if( $pp_row_border_size != '' ) {
            if( is_numeric( $pp_row_border_size ) ) {
                $res_ctx->load_settings_raw( 'pp_row_border_size', $pp_row_border_size . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'pp_row_border_size', '1px' );
        }
        // borders color
        $all_pp_border_color = $res_ctx->get_shortcode_att('all_pp_border_color');
        $res_ctx->load_settings_raw( 'all_pp_border_color', '#ededed' );
        if( $all_pp_border_color != '' ) {
            $res_ctx->load_settings_raw( 'all_pp_border_color', $all_pp_border_color );
        }



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_feat' );
        $res_ctx->load_font_settings( 'f_pp_feat' );
        $res_ctx->load_font_settings( 'f_val' );

    }

    /**
     * Disable loop block features. This block does not use a loop and it doesn't need to run a query.
     */
    function __construct() {
        parent::disable_loop_block_features();
    }


    function render( $atts, $content = null ) {
        parent::render( $atts ); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        global $tdb_state_single;

        $post_review_data = $tdb_state_single->post_review->__invoke();

        // additional classes
        $additional_classes = array();
        if( $post_review_data['review_meta'] == 'rate_stars' ) {
            $additional_classes[] = 'tdb-review-overview-stars';
        } else if( $post_review_data['review_meta'] == 'rate_percent' || $post_review_data['review_meta'] == 'rate_point' ) {
            $additional_classes[] = 'tdb-review-overview-pp';
        }

        $buffy = ''; //output buffer


        if( $post_review_data['review_meta'] != '' ) {
            $buffy .= '<div class="' . $this->get_block_classes($additional_classes) . '" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();

            $buffy .= '<table class="td-review td-fix-index">';

            switch ( $post_review_data['review_meta'] ) {
                case 'rate_stars' :
                    foreach ( $post_review_data['review_meta_stars'] as $section ) {
                        if ( !empty( $section['desc'] ) and !empty( $section['rate'] ) ) {
                            $buffy .= '<tr class="td-review-row-stars">';
                                $buffy .= '<td class="td-review-desc">';
                                    $buffy .= $section['desc'];
                                $buffy .= '</td>';

                                $buffy .= '<td class="td-review-stars">';
                                    $buffy .= $this->number_to_stars( $section['rate'] );
                                $buffy .= '</td>';
                            $buffy .= '</tr>';
                        }
                    }
                    break;

                case 'rate_percent' :
                    foreach ( $post_review_data['review_meta_percents'] as $section ) {
                        if ( !empty( $section['desc'] ) and !empty( $section['rate'] ) ) {
                            $buffy .= '<tr class="td-review-row-bars">';
                                $buffy .= '<td colspan="2">';
                                    $buffy .= '<div class="td-review-details">';
                                        $buffy .= '<div class="td-review-desc">' . $section['desc'] . '</div>';
                                        $buffy .= '<div class="td-review-percent">' . $section['rate'] . ' %</div>';
                                    $buffy .= '</div>';

                                    $buffy .= $this->number_to_bars( $section['rate'] );
                                $buffy .= '</td>';
                            $buffy .= '</tr>';
                        }
                    }
                    break;

                case 'rate_point' :
                    foreach ( $post_review_data['review_meta_points'] as $section ) {
                        if ( !empty( $section['desc'] ) and !empty( $section['rate'] ) ) {
                            $buffy .= '<tr class="td-review-row-bars">';
                                $buffy .= '<td colspan="2">';
                                    $buffy .= '<div class="td-review-details">';
                                        $buffy .= '<div class="td-review-desc">' . $section['desc'] . '</div>';;
                                        $buffy .= '<div class="td-review-percent">' . $section['rate'] . '</div>';
                                    $buffy .= '</div>';

                                    $buffy .= $this->number_to_bars( $section['rate'] * 10 );
                                $buffy .= '</td>';
                            $buffy .= '</tr>';
                        }
                    }
                    break;

                default:
                    $buffy .= '<tr>';
                    $buffy .= '<td>';
                    $buffy .= '</td>';
                    $buffy .= '</tr>';
            }

            $buffy .= '</table>';

            $buffy .= '</div>';
        }


        return $buffy;
    }


    //converts 0 - 5 to stars
    function number_to_stars( $total_stars ) {

        $star_integer = intval( $total_stars );

        $buffy = '';

        // this echo full stars
        for ($i = 0; $i < $star_integer; $i++) {
            $buffy .= '<i class="td-icon-star"></i>';
        }

        $star_rest = $total_stars - $star_integer;

        // this echo full star or half or empty star
        if ( $star_rest >= 0.25 and $star_rest < 0.75 ) {
            $buffy .= '<i class="td-icon-star-half"></i>';
        } else if ( $star_rest >= 0.75 ) {
            $buffy .= '<i class="td-icon-star"></i>';
        } else if ( $total_stars != 5 ) {
            $buffy .= '<i class="td-icon-star-empty"></i>';
        }

        // this echo empty star
        for ( $i = 0; $i < 4-$star_integer; $i++ ) {
            $buffy .= '<i class="td-icon-star-empty"></i>';
        }

        return $buffy;
    }

    //draws the bars
    private static function number_to_bars( $percent_rating ) {

        $buffy = '';
        $buffy .= '<div class="td-rating-bar-wrap">';
        $buffy .= '<div style="width:' . $percent_rating . '%"></div>';
        $buffy .= '</div>';

        return $buffy;
    }

}