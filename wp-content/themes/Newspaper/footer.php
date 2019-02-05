<!-- Instagram -->

<?php if (td_util::get_option('tds_footer_instagram') == 'show') { ?>

    <div class="td-main-content-wrap td-footer-instagram-container td-container-wrap <?php echo td_util::get_option('td_full_footer_instagram'); ?>">
        <?php
        //get the instagram id from the panel
        $tds_footer_instagram_id = td_instagram::strip_instagram_user(td_util::get_option('tds_footer_instagram_id'));
        ?>

        <div class="td-instagram-user">
            <h4 class="td-footer-instagram-title">
                <?php echo  __td('Follow us on Instagram', TD_THEME_NAME); ?>
                <a class="td-footer-instagram-user-link" href="https://www.instagram.com/<?php echo $tds_footer_instagram_id ?>" target="_blank">@<?php echo $tds_footer_instagram_id ?></a>
            </h4>
        </div>

        <?php
        //get the other panel seetings
        $tds_footer_instagram_nr_of_row_images = intval(td_util::get_option('tds_footer_instagram_on_row_images_number'));
        $tds_footer_instagram_nr_of_rows = intval(td_util::get_option('tds_footer_instagram_rows_number'));
        $tds_footer_instagram_img_gap = td_util::get_option('tds_footer_instagram_image_gap');
        $tds_footer_instagram_header = td_util::get_option('tds_footer_instagram_header_section');

        //show the insta block
        echo td_global_blocks::get_instance('td_block_instagram')->render(
            array(
                'instagram_id' => $tds_footer_instagram_id,
                'instagram_header' => /*td_util::get_option('tds_footer_instagram_header_section')*/ 1,
                'instagram_images_per_row' => $tds_footer_instagram_nr_of_row_images,
                'instagram_number_of_rows' => $tds_footer_instagram_nr_of_rows,
                'instagram_margin' => $tds_footer_instagram_img_gap
            )
        );

        ?>
    </div>

<?php } ?>

<?php

$tds_footer_page = td_util::get_option('tds_footer_page');
$footer_page = null;

if ($tds_footer_page !== '' && intval($tds_footer_page) !== get_the_ID()) {
	$footer_page = get_post( $tds_footer_page );
}

if ( $footer_page instanceof WP_Post ) {

	?>

	<div class="td-footer-wrapper td-footer-page td-container-wrap">
	<?php

		// This action must be removed, because it's added by TagDiv Composer, and it affects footers with custom content
		remove_action( 'the_content', 'tdc_on_the_content', 10000 );

		$content = apply_filters( 'the_content', $footer_page->post_content );
		$content = str_replace( ']]>', ']]&gt;', $content );

	//bbpress removes all the filters
	//if is bbpress template run do_shortcode()
	if (td_global::$current_template == 'bbpress') {
		echo do_shortcode($content);
	}
	else {
		echo $content;
	}
		wp_reset_query();

	?>
	</div>

<?php

} else { ?>


	<!-- Footer -->
	<?php
	if ( td_util::get_option( 'tds_footer' ) != 'no' ) {
		td_api_footer_template::_helper_show_footer();
	}
	?>

	<!-- Sub Footer -->
	<?php
	if ( td_util::get_option( 'tds_sub_footer' ) != 'no' ) {
		td_api_sub_footer_template::_helper_show_sub_footer();
	}
}
?>


</div><!--close td-outer-wrap-->

<?php wp_footer(); ?>

</body>
</html>