<?php

/**
 * Class td_single_comments
 */

class tdb_single_comments extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>
                
                /* @auth_color */
                .$unique_block_class cite a {
                    color: @auth_color;
                }
                /* @auth_h_color */
                .$unique_block_class cite a:hover {
                    color: @auth_h_color;
                }
                /* @meta_color */
                .$unique_block_class .comment-link {
                    color: @meta_color;
                }
                /* @meta_h_color */
                .$unique_block_class .comment-link:hover {
                    color: @meta_h_color;
                }
                /* @descr_color */
                .$unique_block_class .comment-content {
                    color: @descr_color;
                }
                /* @reply_color */
                .$unique_block_class .comment-reply-link {
                    color: @reply_color;
                }
                /* @reply_h_color */
                .$unique_block_class .comment-reply-link:hover,
                .$unique_block_class #cancel-comment-reply-link:hover,
                .$unique_block_class .logged-in-as a:hover {
                    color: @reply_h_color;
                }
                /* @sep_color */
                .$unique_block_class .comment {
                    border-bottom-color: @sep_color;
                }
                .$unique_block_class .comment .children {
                    border-top-color: @sep_color;
                }
                
                
                
                /* @form_title_color */
                .$unique_block_class .comment-reply-title {
                    color: @form_title_color;
                }
                /* @bg_color */
                .$unique_block_class input[type=text],
                .$unique_block_class textarea {
                    background-color: @bg_color;
                }
                /* @bg_f_color */
                .$unique_block_class input[type=text]:active,
                .$unique_block_class textarea:active {
                    background-color: @bg_f_color;
                }
                /* @input_color */
                .$unique_block_class input[type=text],
                .$unique_block_class textarea {
                    color: @input_color;
                }
                /* @placeholder_color */
                .$unique_block_class input[type=text]::placeholder,
                .$unique_block_class textarea::placeholder {
                    color: @placeholder_color;
                }
                .$unique_block_class input[type=text]:-ms-input-placeholder,
                .$unique_block_class textarea:-ms-input-placeholder {
                    color: @placeholder_color !important;
                }
                /* @input_border_size */
                .$unique_block_class input,
                .$unique_block_class textarea {
                    border-width: @input_border_size !important;
                }
                /* @input_border_color */
                .$unique_block_class input,
                .$unique_block_class textarea {
                    border-color: @input_border_color !important;
                }
                /* @input_border_f_color */
                .$unique_block_class input[type=text]:focus,
                .$unique_block_class textarea:focus {
                    border-color: @input_border_f_color !important;
                }
                /* @input_border_radius */
                .$unique_block_class input,
                .$unique_block_class textarea {
                    border-radius: @input_border_radius;
                }
                /* @btn_txt_color */
                .$unique_block_class .comment-form .submit {
                    color: @btn_txt_color;
                }
                /* @btn_bg_color */
                .$unique_block_class .comment-form .submit {
                    background-color: @btn_bg_color;
                }
                /* @btn_txt_h_color */
                .$unique_block_class .comment-form .submit:hover {
                    color: @btn_txt_h_color;
                }
                /* @btn_bg_h_color */
                .$unique_block_class .comment-form .submit:hover {
                    background-color: @btn_bg_h_color;
                }
				/* @btn_radius */
				.$unique_block_class .comment-form .submit {
					border-radius: @btn_radius;
				}
				


				/* @f_header */
				.$unique_block_class .td-block-title a,
				.$unique_block_class .td-block-title span {
					@f_header
				}
				/* @f_auth */
				.$unique_block_class cite {
					@f_auth
				}
				/* @f_meta */
				.$unique_block_class .comment-link {
					@f_meta
				}
				/* @f_descr */
				.$unique_block_class .comment-content p {
					@f_descr
				}
				/* @f_reply */
				.$unique_block_class .comment-reply-link {
					@f_reply
				}
				/* @f_frm_title */
				.$unique_block_class .comment-reply-title {
					@f_frm_title
				}
				/* @f_input */
				.$unique_block_class input[type=text],
                .$unique_block_class textarea {
					@f_input
				}
				/* @f_btn */
				.$unique_block_class .comment-form .submit {
					@f_btn
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        /*-- COMMENTS -- */
        $res_ctx->load_settings_raw( 'auth_color', $res_ctx->get_shortcode_att('auth_color') );
        $res_ctx->load_settings_raw( 'auth_h_color', $res_ctx->get_shortcode_att('auth_h_color') );
        $res_ctx->load_settings_raw( 'meta_color', $res_ctx->get_shortcode_att('meta_color') );
        $res_ctx->load_settings_raw( 'meta_h_color', $res_ctx->get_shortcode_att('meta_h_color') );
        $res_ctx->load_settings_raw( 'descr_color', $res_ctx->get_shortcode_att('descr_color') );
        $res_ctx->load_settings_raw( 'reply_color', $res_ctx->get_shortcode_att('reply_color') );
        $res_ctx->load_settings_raw( 'reply_h_color', $res_ctx->get_shortcode_att('reply_h_color') );
        $res_ctx->load_settings_raw( 'sep_color', $res_ctx->get_shortcode_att('sep_color') );



        /*-- FORM -- */
        $res_ctx->load_settings_raw( 'form_title_color', $res_ctx->get_shortcode_att('form_title_color') );

        // input border size
        $input_border_size = $res_ctx->get_shortcode_att('input_border_size');
        if( $input_border_size != '' && is_numeric( $input_border_size ) ) {
            $res_ctx->load_settings_raw( 'input_border_size', $input_border_size . 'px' );
        }
        // input border colors
        $res_ctx->load_settings_raw( 'input_border_color', $res_ctx->get_shortcode_att('input_border_color') );
        $res_ctx->load_settings_raw( 'input_border_f_color', $res_ctx->get_shortcode_att('input_border_f_color') );
        // input border radius
        $input_border_radius = $res_ctx->get_shortcode_att('input_border_radius');
        $res_ctx->load_settings_raw( 'input_border_radius', $input_border_radius );
        if( $input_border_radius != '' && is_numeric( $input_border_radius ) ) {
            $res_ctx->load_settings_raw( 'input_border_radius', $input_border_radius . 'px' );
        }

        $res_ctx->load_settings_raw( 'bg_color', $res_ctx->get_shortcode_att('bg_color') );
        $res_ctx->load_settings_raw( 'bg_f_color', $res_ctx->get_shortcode_att('bg_f_color') );

        $res_ctx->load_settings_raw( 'input_color', $res_ctx->get_shortcode_att('input_color') );
        $res_ctx->load_settings_raw( 'placeholder_color', $res_ctx->get_shortcode_att('placeholder_color') );

        $res_ctx->load_settings_raw( 'btn_txt_color', $res_ctx->get_shortcode_att('btn_txt_color') );
        $res_ctx->load_settings_raw( 'btn_bg_color', $res_ctx->get_shortcode_att('btn_bg_color') );
        $res_ctx->load_settings_raw( 'btn_txt_h_color', $res_ctx->get_shortcode_att('btn_txt_h_color') );
        $res_ctx->load_settings_raw( 'btn_bg_h_color', $res_ctx->get_shortcode_att('btn_bg_h_color') );
        $btn_radius = $res_ctx->get_shortcode_att('btn_radius');
        $res_ctx->load_settings_raw( 'btn_radius', $btn_radius );
        if( $btn_radius != '' && is_numeric( $btn_radius ) ) {
            $res_ctx->load_settings_raw( 'btn_radius', $btn_radius . 'px' );
        }




        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_header' );
        $res_ctx->load_font_settings( 'f_auth' );
        $res_ctx->load_font_settings( 'f_meta' );
        $res_ctx->load_font_settings( 'f_descr' );
        $res_ctx->load_font_settings( 'f_reply' );
        $res_ctx->load_font_settings( 'f_frm_title' );
        $res_ctx->load_font_settings( 'f_input' );
        $res_ctx->load_font_settings( 'f_btn' );

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

        $post_comments_data = $tdb_state_single->post_comments->__invoke();

        $additional_classes = array();

        $form_layout = $this->get_att('form_layout');
        if( !empty( $form_layout ) ) {
            $additional_classes[] = 'tdb-comm-layout' . $form_layout;
        }


        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes($additional_classes) . '" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';

                $post_comments_number = $post_comments_data['post_comments_number'];

                if( $this->get_att('block_template_id') != '' ) {
                    $global_block_template_id = $this->get_att('block_template_id');
                } else {
                    $global_block_template_id = td_options::get( 'tds_global_block_template', 'td_block_template_1' );
                }
                $td_css_cls_block_title = 'td-block-title';

                if ( $global_block_template_id === 'td_block_template_1' ) {
                    $td_css_cls_block_title = 'block-title';
                }

                $fields = array(
                    'author' => '<div class="comment-form-input-wrap td-form-author">
                                    <input 
                                        class="" 
                                        id="author" 
                                        name="author" 
                                        placeholder="' . __td( 'Name:', TD_THEME_NAME) . ( $post_comments_data['require_name_email'] ? '*' : '' ) . '" 
                                        type="text" 
                                        value="' . esc_attr( $post_comments_data['current_commenter']['comment_author'] ) . '" 
                                        size="30" ' . $post_comments_data['aria_req'] . ' 
                                    />
                                    <div class="td-warning-author">' . __td('Please enter your name here', TD_THEME_NAME) . '</div>
                                </div>',
                    'email' => '<div class="comment-form-input-wrap td-form-email">
                                    <input 
                                        class="" 
                                        id="email" 
                                        name="email" 
                                        placeholder="' . __td( 'Email:', TD_THEME_NAME) . ( $post_comments_data['require_name_email'] ? '*' : '' ) . '" 
                                        type="text" 
                                        value="' . esc_attr(  $post_comments_data['current_commenter']['comment_author_email'] ) . '" 
                                        size="30" ' . $post_comments_data['aria_req'] . ' 
                                    />
                                    <div class="td-warning-email-error">' . __td( 'You have entered an incorrect email address!', TD_THEME_NAME ) . '</div>
                                    <div class="td-warning-email">' . __td( 'Please enter your email address here', TD_THEME_NAME ) . '</div>
                                </div>',
                    'url' => '<div class="comment-form-input-wrap td-form-url">
                                <input 
                                    class="" 
                                    id="url" 
                                    name="url" 
                                    placeholder="' . __td( 'Website:', TD_THEME_NAME ) . '" 
                                    type="text" 
                                    value="' . esc_attr( $post_comments_data['current_commenter']['comment_author_url'] ) . '" 
                                    size="30" 
                                />
                             </div>',
                    'cookies' => '<p class="comment-form-cookies-consent">
                                <input 
                                    id="wp-comment-cookies-consent" 
                                    name="wp-comment-cookies-consent" 
                                    type="checkbox" 
                                    value="yes"
                                    ' . $post_comments_data['consent'] . ' 
                                />
                                <label for="wp-comment-cookies-consent">' . __td( 'Save my name, email, and website in this browser for the next time I comment.', TD_THEME_NAME ) . '</label>
                              </p>',
                );

                $defaults = array();
                $defaults['fields']               = apply_filters( 'comment_form_default_fields', $fields ) ;
                $defaults['comment_field']        = '<div class="clearfix"></div><div class="comment-form-input-wrap td-form-comment">
                                                        <textarea 
                                                            placeholder="' . __td( 'Comment:', TD_THEME_NAME ) . '" 
                                                            id="comment" 
                                                            name="comment" 
                                                            cols="45" 
                                                            rows="8" 
                                                            aria-required="true"
                                                        ></textarea>
                                                        <div class="td-warning-comment">' . __td( 'Please enter your comment!', TD_THEME_NAME ) . '</div>
                                                    </div>';
                $defaults['comment_notes_before'] = '';
                $defaults['comment_notes_after']  = '';
                $defaults['title_reply']          = __td( 'LEAVE A REPLY', TD_THEME_NAME );
                $defaults['label_submit']         = __td( 'Post Comment', TD_THEME_NAME );
                $defaults['cancel_reply_link']    = __td( 'Cancel reply', TD_THEME_NAME );

                // login with theme login modal
                if ( td_util::get_option( 'tds_login_sign_in_widget' ) == 'show' ) {
                    $url = '#login-form';
                } else {
                    $url = wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_comments_data['post_id'] ) ) );
                }

                $defaults['must_log_in']          = '<p class="must-log-in td-login-comment">
                                                        <a 
                                                            class="td-login-modal-js" 
                                                            data-effect="mpf-td-login-effect" 
                                                            href="' . $url .'"
                                                        >' . __td( 'Log in to leave a comment', TD_THEME_NAME ) . ' 
                                                        </a>
                                                    </p>';
                $defaults['logged_in_as']         = '<p class="logged-in-as">' .
                    sprintf(
                    /* 1: edit user link, 2: accessibility text, 3: user name, 4: logout URL */
                        '<a href="%1$s" aria-label="%2$s">' . __td( 'Logged in as', TD_THEME_NAME ) . ' %3$s</a>. <a href="%4$s">' . __td( 'Log out?', TD_THEME_NAME ) . '</a>',
                        get_edit_user_link(),
                        /* %s: user name */
                        esc_attr( sprintf( __td( 'Logged in as %s. Edit your profile.' , TD_THEME_NAME), $post_comments_data['user_identity'] ) ),
                        $post_comments_data['user_identity'],
                        wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_comments_data['post_id'] ) ) )
                    ) .
                    '</p>';


                $buffy .= '<div class="comments" id="comments">';

                    if ( $post_comments_number > 0 ) {

                        if ( $post_comments_number > 1 ) {
                            $post_comments_no_text = $post_comments_number . ' ' . __td( 'COMMENTS', TD_THEME_NAME );
                        } else {
                            $post_comments_no_text = __td( '1 COMMENT', TD_THEME_NAME );
                        }

                        $buffy .= '<div class="td-comments-title-wrap ' . $global_block_template_id . '">';
                            $buffy .= '<h4 class="td-comments-title ' . $td_css_cls_block_title . '"><span>' . $post_comments_no_text . '</span></h4>';
                        $buffy .= '</div>';

                        $buffy .= '<ol class="comment-list">';
                        $buffy .= wp_list_comments(
                            array(
                                'callback' => array( $this, "td_comment" ),
                                'echo'     => false
                            ),
                            $post_comments_data['post_comments']
                        );

                        $buffy .= '</ol>';
                    }

                    if ( 'open' != $post_comments_data['post_comments_status'] and $post_comments_number > 0 ) {
                        $buffy .= '<p class="td-pb-padding-side">' . _etd( 'Comments are closed.', TD_THEME_NAME ) . '</p>';
                    } else {

                        if ( tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe() ) {

                            $stored_current_user = wp_get_current_user();
                            wp_set_current_user( 0 );

                            ob_start();
                            comment_form( $defaults, $post_comments_data['post_id'] );
                            $buffy .= ob_get_clean();

                            wp_set_current_user( $stored_current_user->ID );

                        } else {
                            ob_start();
                            comment_form( $defaults, $post_comments_data['post_id'] );
                            $buffy .= ob_get_clean();
                        }
                    }

                $buffy .= '</div>';
            $buffy .= '</div>';


        $buffy .= '</div>';

        return $buffy;
    }

    /**
    * Callback for outputting comments
    *
    * @return void
    * @author tagdiv
    */
    function td_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;

    $td_isPingTrackbackClass = '';

    if($comment->comment_type == 'pingback') {
    $td_isPingTrackbackClass = 'pingback';
    }

    if($comment->comment_type == 'trackback') {
    $td_isPingTrackbackClass = 'trackback';
    }

    if (!empty($comment->comment_author_email)) {
    $td_comment_auth_email = $comment->comment_author_email;
    } else {
    $td_comment_auth_email = '';
    }

    $td_article_date_unix = @strtotime("{$comment->comment_date_gmt} GMT");
    //print_r($td_article_date_unix);


    ?>
<li class="comment <?php echo $td_isPingTrackbackClass ?>" id="comment-<?php comment_ID() ?>">
    <article>
        <footer>
            <?php
            //echo get_template_directory_uri() . "/images/avatar.jpg";
            //echo get_avatar($td_comment_auth_email, 50, get_template_directory_uri() . "/images/avatar.jpg");
            echo get_avatar($td_comment_auth_email, 50);
            ?>
            <cite><?php comment_author_link() ?></cite>

            <a class="comment-link" href="#comment-<?php comment_ID() ?>">
                <time pubdate="<?php echo $td_article_date_unix ?>"><?php comment_date() ?> at <?php comment_time() ?></time>
            </a>
        </footer>

        <div class="comment-content">
            <?php if ($comment->comment_approved == '0') { ?>
                <em><?php echo __td('Your comment is awaiting moderation', TD_THEME_NAME); ?></em>
            <?php }
            comment_text(); ?>
        </div>

        <div class="comment-meta" id="comment-<?php comment_ID() ?>">
            <?php comment_reply_link(array_merge( $args, array(
                'depth' => $depth,
                'max_depth' => $args['max_depth'],
                'reply_text' => __td('Reply', TD_THEME_NAME),
                'login_text' =>  __td('Log in to leave a comment', TD_THEME_NAME)
            )))
            ?>
        </div>
    </article>
    <?php

}

}