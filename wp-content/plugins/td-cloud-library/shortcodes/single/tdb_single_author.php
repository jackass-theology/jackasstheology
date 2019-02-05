<?php

/**
 * Class tdb_single_author
 */

class tdb_single_author extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @float_right */
                .$unique_block_class {
                    float: right;
                }
                /* @make_inline */
                .$unique_block_class {
                    display: inline-block;
                }

                /* @photo_size */
                .$unique_block_class .avatar {
                    width: @photo_size;
                    height: @photo_size;
                }
                /* @photo_space */
                .$unique_block_class .avatar {
                    margin-right: @photo_space;
                }
                /* @photo_radius */
                .$unique_block_class .avatar {
                    border-radius: @photo_radius;
                }
                

                /* @author_by_color */
				.$unique_block_class .tdb-author-by {
					color: @author_by_color;
				}
                /* @author_color */
				.$unique_block_class .tdb-author-name {
					color: @author_color;
				}
                /* @author_h_color */
				.$unique_block_class .tdb-author-name:hover {
					color: @author_h_color;
				}
				


				/* @f_auth_by */
				.$unique_block_class .tdb-author-by {
					@f_auth_by
				}
				/* @f_auth_name */
				.$unique_block_class .tdb-author-name {
					@f_auth_name
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // float right
        $res_ctx->load_settings_raw( 'float_right', $res_ctx->get_shortcode_att('float_right') );
        $res_ctx->load_settings_raw( 'make_inline', $res_ctx->get_shortcode_att('make_inline') );



        /*-- AUTHOR PHOTO -- */
        // author photo size
        $photo_size = $res_ctx->get_shortcode_att('photo_size');
        $res_ctx->load_settings_raw( 'photo_size', '20px' );
        if( $photo_size != '' && is_numeric( $photo_size ) ) {
            $res_ctx->load_settings_raw( 'photo_size', $photo_size . 'px' );
        }

        // author photo space
        $photo_space = $res_ctx->get_shortcode_att('photo_space');
        $res_ctx->load_settings_raw( 'photo_space', '6px' );
        if( $photo_space != '' && is_numeric( $photo_space ) ) {
            $res_ctx->load_settings_raw( 'photo_space', $photo_space . 'px' );
        }

        // author photo radius
        $photo_radius = $res_ctx->get_shortcode_att('photo_radius');
        $res_ctx->load_settings_raw( 'photo_radius', $photo_radius );
        if( $photo_radius != '' ) {
            if( is_numeric( $photo_radius ) ) {
                $res_ctx->load_settings_raw( 'photo_radius', $photo_radius . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'photo_radius', '50%' );
        }



        /*-- COLORS -- */
        // author by text color
        $res_ctx->load_settings_raw( 'author_by_color', $res_ctx->get_shortcode_att('author_by_color') );

        // author name color
        $author_color = $res_ctx->get_shortcode_att('author_color');
        $res_ctx->load_settings_raw( 'author_color', $res_ctx->get_shortcode_att('author_color') );
        if( $author_color != '' ) {
            $res_ctx->load_settings_raw( 'author_color', $author_color );
        } else {
            $res_ctx->load_settings_raw( 'author_color', '#000' );
        }

        // author name hover color
        $res_ctx->load_settings_raw( 'author_h_color', $res_ctx->get_shortcode_att('author_h_color') );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_auth_by' );
        $res_ctx->load_font_settings( 'f_auth_name' );

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

        $post_author_data = $tdb_state_single->post_author->__invoke();

        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes() . ' tdb-post-meta" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';
                if( $this->get_att( 'author_photo' ) != '' ) {
                    $buffy .= '<a class="tdb-author-photo"  href="' . $post_author_data['author_url'] . '">' . $post_author_data['author_avatar'] . '</a>';
                }

                $buffy .= '<span class="tdb-author-by">' . $this->get_att( 'author_by' ) . '</span> ';

                $buffy .= '<a class="tdb-author-name" href="' . $post_author_data['author_url'] . '">' . $post_author_data['author_name'] . '</a>';
            $buffy .= '</div>';

        $buffy .= '</div>';

        return $buffy;
    }

}