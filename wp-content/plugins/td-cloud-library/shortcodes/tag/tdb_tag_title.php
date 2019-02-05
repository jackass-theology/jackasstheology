<?php


/**
 * Class tdb_tag_title
 */

class tdb_tag_title extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @title_color_solid */
				.$unique_block_class .tdb-single-tag-text {
					color: @title_color_solid;
				}
				/* @title_color_gradient */
				.$unique_block_class .tdb-single-tag-text {
					@title_color_gradient
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;
				}
				.td-md-is-ios .$unique_block_class .tdb-single-tag-text {
					-webkit-text-fill-color: initial;
				}
				html[class*='ie'] .$unique_block_class .tdb-single-tag-text,
				.td-md-is-ios .$unique_block_class .tdb-search-query {
				    background: none;
					color: @title_color_gradient_1;
				}
				/* @add_text_color_solid */
				.$unique_block_class .tdb-add-text {
					color: @add_text_color_solid;
				}
				/* @add_text_color_gradient */
				.$unique_block_class .tdb-add-text {
					@add_text_color_gradient
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;
				}
				.td-md-is-ios .$unique_block_class .tdb-add-text {
					-webkit-text-fill-color: initial;
				}
				html[class*='ie'] .$unique_block_class .tdb-add-text,
				.td-md-is-ios .$unique_block_class .tdb-add-text {
				    background: none;
					color: @add_text_color_gradient_1;
				}
				/* @style_bg */
				.$unique_block_class .tdb-single-tag-text  {
					-webkit-text-fill-color: initial;
					background: @style_bg;
					-webkit-box-decoration-break: clone;
					box-decoration-break: clone;
					padding: 5px 16px;
					display: inline;
				}
				/* @style_bg_gradient */
				.$unique_block_class .ttdb-single-tag-text  {
					-webkit-text-fill-color: initial;
					background: @style_bg_gradient;
					-webkit-box-decoration-break: clone;
					box-decoration-break: clone;
					padding: 5px 16px;
					display: inline;
				}
				/* @style_bg_space */
				.$unique_block_class .tdb-single-tag-text  {
					padding: @style_bg_space;
				}
				/* @line_width */
				.$unique_block_class .tdb-title-line  {
				    display: table;
					width: @line_width;
				}
				/* @line_height */
				.$unique_block_class .tdb-title-line:after  {
					height: @line_height;
				}
				/* @line_space */
				.$unique_block_class .tdb-title-line  {
					height: @line_space;
				}
				/* @line_alignment */
				.$unique_block_class .tdb-title-line:after   {
					bottom: @line_alignment;
				}
				/* @line_color */
				.$unique_block_class .tdb-title-line:after {
					background: @line_color;
				}
				/* @line_color_gradient */
				.$unique_block_class .tdb-title-line:after {
					@line_color_gradient
				}
				/* @align_center */
				.td-theme-wrap .$unique_block_class {
					text-align: center;
				}
				.$unique_block_class .tdb-first-letter {
					left: 0;
					right: 0;
				}
				.$unique_block_class .tdb-title-line {
					margin-left: auto;
					margin-right: auto;
				}
				/* @align_right */
				.td-theme-wrap .$unique_block_class {
					text-align: right;
				}	
				.$unique_block_class .tdb-first-letter {
					left: auto0;
					right: -0.36em;
				}
				.$unique_block_class .tdb-title-line {
					margin-left: auto;
				}
				/* @align_left */
				.td-theme-wrap .$unique_block_class {
					text-align: left;
				}
				.$unique_block_class .tdb-first-letter {
					left: -0.36em;
					right: auto;
				}
				/* @f_title */
				.$unique_block_class .tdb-single-tag-text {
					@f_title
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // title color
        $res_ctx->load_color_settings( 'title_color', 'title_color_solid', 'title_color_gradient', 'title_color_gradient_1', '' );

        // additional text color
        $res_ctx->load_color_settings( 'add_text_color', 'add_text_color_solid', 'add_text_color_gradient', 'add_text_color_gradient_1', '' );

        // content align
        $content_align = $res_ctx->get_shortcode_att('content_align_horizontal');
        if ( $content_align == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'align_center', 1 );
        } else if ( $content_align == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'align_right', 1 );
        } else if ( $content_align == 'content-horiz-left' ) {
            $res_ctx->load_settings_raw( 'align_left', 1 );
        }

        /*-- LINE -- */
        // line width
        $line_width = $res_ctx->get_shortcode_att('line_width');
        $res_ctx->load_settings_raw( 'line_width', $line_width );
        if( $line_width != '' && is_numeric( $line_width ) ) {
            $res_ctx->load_settings_raw( 'line_width', $line_width . 'px' );
        }

        // line height
        $line_height = $res_ctx->get_shortcode_att('line_height');
        $res_ctx->load_settings_raw( 'line_height', '2px' );
        if( $line_height != '' ) {
            if( is_numeric( $line_height ) ) {
                $res_ctx->load_settings_raw( 'line_height', $line_height . 'px' );
            }
        }

        // line space
        $line_space = $res_ctx->get_shortcode_att('line_space');
        $res_ctx->load_settings_raw( 'line_space', '50px' );
        if( $line_space != '' ) {
            if( is_numeric( $line_space ) ) {
                $res_ctx->load_settings_raw( 'line_space', $line_space . 'px' );
            }
        }

        // line alignment
        $line_alignment = $res_ctx->get_shortcode_att( 'line_alignment' );
        if( is_numeric( $line_alignment ) ) {
            $res_ctx->load_settings_raw( 'line_alignment', $line_alignment . '%' );
        }

        // style_bg
        $res_ctx->load_color_settings( 'style_bg', 'style_bg', 'style_bg_gradient', '', '' );
        // style_bg_space
        $style_bg_space = $res_ctx->get_shortcode_att( 'style_bg_space' );
        $res_ctx->load_settings_raw( 'style_bg_space', $style_bg_space );
        if( $style_bg_space != '' && is_numeric( $style_bg_space ) ) {
            $res_ctx->load_settings_raw( 'style_bg_space', $style_bg_space . 'px' );
        }

        // line color
        $res_ctx->load_color_settings( 'line_color', 'line_color', 'line_color_gradient', '', '' );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_title' );

    }


    // disable loop block features. This block does not use a loop and it doesn't need to run a query.
    function __construct() {
        parent::disable_loop_block_features();
    }


    function render( $atts, $content = null ) {
        parent::render( $atts ); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        global $tdb_state_tag;
        $tag_title_data = $tdb_state_tag->title->__invoke( $atts );

        // title line
        $title_line_position = $this->get_att( 'line_position' );
        $title_tag = $this->get_att( 'title_tag' );

        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';
                if( $title_line_position == 'above' ) {
                    $buffy .= '<div class="tdb-title-line"></div>';
                }

                $buffy .= '<' . $title_tag . ' class="tdb-single-tag-text"><span class="tdb-add-text">' . $this->get_att('add_text') . '</span> ' . $tag_title_data['title'] . '</' . $title_tag . '>';

                if( $title_line_position == '' ) {
                    $buffy .= '<div class="tdb-title-line"></div>';
                }
            $buffy .= '</div>';

        $buffy .= '</div>';

        return $buffy;
    }

}