<?php
class td_block_author extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @photo_size */
				.$unique_block_class .avatar {
					width: @photo_size;
				}
                /* @photo_radius */
				.$unique_block_class .avatar {
					border-radius: @photo_radius;
				}
				
				
				/* @author_name_color */
				.$unique_block_class .td-author-name a {
					color: @author_name_color;
                }
				/* @author_description_color */
				.$unique_block_class .td-author-description {
					color: @author_description_color;
				}
				


				/* @f_header */
				.$unique_block_class .td-block-title a,
				.$unique_block_class .td-block-title span {
					@f_header
				}
				/* @f_name */
				.$unique_block_class .td-author-name {
					@f_name
				}
				/* @f_descr */
				.$unique_block_class .td-author-description {
					@f_descr
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        /*-- IMAGE -- */
        // author image size
        $author_photo_size = $res_ctx->get_shortcode_att('photo_size');
        $res_ctx->load_settings_raw( 'photo_size', $author_photo_size );
        if( $author_photo_size != '' && is_numeric( $author_photo_size ) ) {
            $res_ctx->load_settings_raw( 'photo_size', $author_photo_size . 'px' );
        }

        // author image radius
        $author_photo_radius = $res_ctx->get_shortcode_att('photo_radius');
        $res_ctx->load_settings_raw( 'photo_radius', $author_photo_radius );
        if( $author_photo_radius != '' && is_numeric( $author_photo_radius ) ) {
            $res_ctx->load_settings_raw( 'photo_radius', $author_photo_radius . 'px' );
        }



        /*-- TEXT -- */
        // author name color
        $res_ctx->load_settings_raw( 'author_name_color', $res_ctx->get_shortcode_att('author_name_color') );

        // author description color
        $res_ctx->load_settings_raw( 'author_description_color', $res_ctx->get_shortcode_att('author_description_color') );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_header' );
        $res_ctx->load_font_settings( 'f_name' );
        $res_ctx->load_font_settings( 'f_descr' );

    }


    function render($atts, $content = null) {

        parent::render($atts);

        extract(shortcode_atts(
            array(
                'author_id' => '1', // ID 1 for admin
                'author_url_text' => '',
                'author_url' => '',
                'open_in_new_window' => ''
            ), $atts));

        $td_target = '';
        if (!empty($open_in_new_window)) {
            $td_target = ' target="_blank"';
        }

        $td_author = get_user_by( 'id', $author_id );

	    if ( false === $td_author ) {
		    $buffy = '';
		    $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';
			    $buffy .= '<div class="td_author_wrap td-fix-index">';
				    $buffy .= '<a href="#">' . get_avatar('', '196') . '</a>';

				    $buffy .= '<div class="item-details">';
					    $buffy .= '<div class="td-author-name">';
				        $buffy .= '<a href="#">Author name</a>';
					    $buffy .= '</div>';
				    $buffy .= '</div>';
			    $buffy .= '</div>';
		    $buffy .= '</div>';
		    return $buffy;
	    }




        $buffy = '';
        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';


        //get the block css
        $buffy .= $this->get_block_css();

        // block title wrap
        $buffy .= '<div class="td-block-title-wrap">';
            $buffy .= $this->get_block_title(); //get the block title
            $buffy .= $this->get_pull_down_filter();
        $buffy .= '</div>';


        $buffy .= '<div class="td_author_wrap td-fix-index">';
        $buffy .= '<a href="' . get_author_posts_url($td_author->ID) . '">' . get_avatar($td_author->user_email, '196') . '</a>';
        $buffy .= '<div class="item-details">';

        $buffy .= '<div class="td-author-name">';
        $buffy .= '<a href="' . get_author_posts_url($td_author->ID) . '">' . $td_author->display_name . '</a>';
        $buffy .= '</div>';

        $buffy .= '<div class="td-author-description">';
        $buffy .= $td_author->description;
        $buffy .= '</div>';

        if(!empty($author_url_text)) {
            $buffy .= '<div class="td-author-page">';
            $buffy .= '<a href="' . $author_url . '"' . $td_target . '>' . $author_url_text . '</a>';
            $buffy .= '</div>';
        }

        $buffy .= '</div>';

        $buffy .= '</div>';

        $buffy .= '</div>';


        return $buffy;

    }
}