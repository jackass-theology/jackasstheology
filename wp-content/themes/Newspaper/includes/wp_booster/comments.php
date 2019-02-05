<?php

//removing the comments sidewide
if ((td_util::get_option('tds_disable_comments_sidewide') == '') && post_type_supports(get_post_type(), 'comments')) {

    if (post_password_required()) {
        return;
    }
    ?>
	<div class="comments" id="comments">
        <?php
        if (have_comments()) {

	        // on Newspaper the css class 'td-pb-padding-side' is not applied
	        $td_css_cls_pb_padding_side = '';
	        $td_css_cls_block_title = '';
            $global_block_template_id = td_options::get('tds_global_block_template', 'td_block_template_1');

	        if ('Newsmag' == TD_THEME_NAME) {
		        $td_css_cls_pb_padding_side = 'td-pb-padding-side ';
	        } else if ('Newspaper' == TD_THEME_NAME) {
		        $td_css_cls_block_title = 'td-block-title';

                if ($global_block_template_id === 'td_block_template_1') {
                    $td_css_cls_block_title = 'block-title';
                }
	        }

	        $num_comments = get_comments_number(); // get_comments_number returns only a numeric value
	        if ($num_comments > 1) {
		        $td_comments_no_text = $num_comments . ' ' . __td('COMMENTS', TD_THEME_NAME);
	        } else {
		        $td_comments_no_text = __td('1 COMMENT', TD_THEME_NAME);
	        }
	        ?>

            <div class="td-comments-title-wrap <?php echo $td_css_cls_pb_padding_side . $global_block_template_id?>">
                <h4 class="td-comments-title <?php echo $td_css_cls_block_title?>"><span><?php echo $td_comments_no_text?></span></h4>
            </div>

		        <ol class="comment-list <?php echo $td_css_cls_pb_padding_side ?>">
                    <?php wp_list_comments(array('callback' => 'td_comment')); ?>
                </ol>
                <div class="comment-pagination">
                    <?php previous_comments_link(); ?>
                    <?php next_comments_link(); ?>
                </div>

            <?php }

	        if (!comments_open() and (get_comments_number() > 0)) { ?>
	            <p class="td-pb-padding-side"><?php _etd( 'Comments are closed.', TD_THEME_NAME ); ?></p>
	        <?php }

            $commenter = wp_get_current_commenter();
            $req = get_option( 'require_name_email' );
            $aria_req = ( $req ? " aria-required='true'" : '' );

            $user = wp_get_current_user();
            $user_identity = $user->exists() ? $user->display_name : '';
            $consent  = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
	        $fields = array(
		        'author' =>
			        '<div class="comment-form-input-wrap td-form-author">
			            <input class="" id="author" name="author" placeholder="' . __td('Name:', TD_THEME_NAME) . ( $req ? '*' : '' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" ' . $aria_req . ' />
			            <div class="td-warning-author">' . __td('Please enter your name here', TD_THEME_NAME) . '</div>
			         </div>',

		        'email'  =>
			        '<div class="comment-form-input-wrap td-form-email">
			            <input class="" id="email" name="email" placeholder="' . __td('Email:', TD_THEME_NAME) . ( $req ? '*' : '' ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" ' . $aria_req . ' />
			            <div class="td-warning-email-error">' . __td('You have entered an incorrect email address!', TD_THEME_NAME) . '</div>
			            <div class="td-warning-email">' . __td('Please enter your email address here', TD_THEME_NAME) . '</div>
			         </div>',

		        'url' =>
			        '<div class="comment-form-input-wrap td-form-url">
			            <input class="" id="url" name="url" placeholder="' . __td('Website:', TD_THEME_NAME) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />
                     </div>',
                'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
                    '<label for="wp-comment-cookies-consent">' . __td( 'Save my name, email, and website in this browser for the next time I comment.' ) . '</label></p>',
            );

		    $defaults = array('fields' => apply_filters('comment_form_default_fields', $fields));
		    $defaults['comment_field'] =
			    '<div class="clearfix"></div>
				<div class="comment-form-input-wrap td-form-comment">
					<textarea placeholder="' . __td('Comment:', TD_THEME_NAME) . '" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
					<div class="td-warning-comment">' . __td('Please enter your comment!', TD_THEME_NAME) . '</div>
				</div>
		        ';

		    $defaults['comment_notes_before'] = '';
		    $defaults['comment_notes_after'] = '';
		    $defaults['title_reply'] = __td('LEAVE A REPLY', TD_THEME_NAME);
		    $defaults['label_submit'] = __td('Post Comment', TD_THEME_NAME);
		    $defaults['cancel_reply_link'] = __td('Cancel reply', TD_THEME_NAME);

		    // login with our login modal when you want to write a comment

	        if (td_util::get_option('tds_login_sign_in_widget') == 'show') {
		        $url = '#login-form';
	        } else {
		        $post_id = get_the_ID();
		        $url = wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) );
	        }
            $defaults['must_log_in'] = '<p class="must-log-in td-login-comment"><a class="td-login-modal-js" data-effect="mpf-td-login-effect" href="' . $url .'">' . __td('Log in to leave a comment', TD_THEME_NAME) . ' </a></p>';

            $defaults['logged_in_as'] = '<p class="logged-in-as">' . sprintf(
                    /* 1: edit user link, 2: accessibility text, 3: user name, 4: logout URL */
                    '<a href="%1$s" aria-label="%2$s">' . __td('Logged in as', TD_THEME_NAME) . ' %3$s</a>. <a href="%4$s">' . __td('Log out?', TD_THEME_NAME) . '</a>',
                    get_edit_user_link(),
                    /* %s: user name */
                    esc_attr( sprintf( __td( 'Logged in as %s. Edit your profile.' , TD_THEME_NAME), $user_identity ) ),
                    $user_identity,
                    wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) )
                ) . '</p>';

            comment_form($defaults);
            //comment_form();

        ?>
    </div> <!-- /.content -->
<?php
}


//end removing the comments sidewide
/**
 * Custom callback for outputting comments
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

                    <?php edit_comment_link( __td('Edit', TD_THEME_NAME)) ?>
                    
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
?>