<?php
/**
 * Comments template part.
 *
 */
?>

<?php
//removing the comments sidewide
if ((td_util::get_option('tds_disable_comments_sidewide') == '') && post_type_supports(get_post_type(), 'comments')) { ?>

	<div class="comments td-container" id="comments">
        <?php if (post_password_required()) { ?>

        <?php } else {
	        $num_comments = get_comments_number(); // get_comments_number returns only a numeric value
	        if ($num_comments == 0) {
		        if (comments_open()) {
			        $td_comments_no_text = __td( 'NO COMMENTS', TD_THEME_NAME );
		        } else {
			        $td_comments_no_text = '';
		        }
	        } elseif ($num_comments > 1) {
		        $td_comments_no_text = $num_comments . ' ' . __td('COMMENTS', TD_THEME_NAME);
	        } else {
		        $td_comments_no_text = __td('1 COMMENT', TD_THEME_NAME);
	        }
	        ?>

            <div class="td-comments-title-wrap">
                <h4 class="block-title"><span><?php echo $td_comments_no_text?></span></h4>
            </div>

            <?php

            global $wp_query;

            $comment_args = array(
                'orderby'       => 'comment_date_gmt',
                'order'         => 'ASC',
                'status'        => 'approve',
                'post_id'       => $this->post->ID,
                'no_found_rows' => FALSE,
            );

            $comments = new WP_Comment_Query( array_merge( $comment_args,  $comment_query_args = array() ) );

            /**
             * Filters the comments array.
             *
             * @see comments_template
             *
             * @param array $comments Array of comments supplied to the comments template.
             * @param int   $post_ID  Post ID.
             */
            $comments_list = apply_filters( 'comments_array', $comments->comments, $this->post->ID );

            // Save comments list to comments property of the main query to enable wordpress core
            // function such as get_next_comments_link works in comments page
            $wp_query->comments = $comments_list;

                ?>

		        <ol class="comment-list">
                    <?php wp_list_comments(
                            array('callback' => 'td_comment')
                    ); ?>
                </ol>
                <div class="comment-pagination">
                    <?php previous_comments_link(); ?>
                    <?php next_comments_link(); ?>
	                <div class="clearfix"></div>
                </div>

            <?php

	        if (!comments_open() and (get_comments_number() > 0)) { ?>
	            <p><?php _etd( 'Comments are closed.', TD_THEME_NAME ); ?></p>
	        <?php } ?>

            <?php
            $comments_link_url = $this->get( 'comments_link_url' );

             if ( $comments_link_url ) {
                 $comments_link_text = $this->get( 'comments_link_text' ); ?>

                 <div class="add-comment-div">
                     <a class="add-comment" href="<?php echo esc_url( $comments_link_url ); ?>">
                         <?php echo esc_html( $comments_link_text ); ?>
                     </a>
                 </div>

          <?php } ?>

     <?php } ?>
    </div> <!-- /.comments -->
<?php
}


/**
 * Custom callback for outputting comments
 *
 * @return void
 * @author tagdiv
 */
function td_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;


    if (!empty($comment->comment_author_email)) {
        $td_comment_auth_email = $comment->comment_author_email;
    } else {
        $td_comment_auth_email = '';
    }

	?>
        <li class="comment" id="comment-<?php comment_ID() ?>">
			<article>
	            <header>
                    <?php echo td_sanitize_image(get_avatar($td_comment_auth_email, 50)); ?>
                    <cite class="comment-author"><?php comment_author_link() ?></cite>

                    <a class="comment-link" href="#comment-<?php comment_ID() ?>">
                        <time class="comment-published"><?php comment_date() ?> at <?php comment_time() ?></time>
                    </a>
                </header>

	            <div class="comment-content">
                    <?php if ($comment->comment_approved == '0') { ?>
                        <em><?php __td('Your comment is awaiting moderation', TD_THEME_NAME); ?></em>
                    <?php } ?>
                    <?php

                    $comm_id = get_comment_ID();
                    $comm = get_comment( $comm_id );
                    $comm_text = get_comment_text( $comm );

                    echo td_sanitize_image( $comm_text ); ?>

                </div>
            </article>
    <?php
}
?>