<?php
/* Template Name: Pagebuilder + latest articles + pagination */

get_header();

td_global::$current_template = 'page-homepage-loop';

global $paged, $loop_module_id, $loop_sidebar_position, $post, $more; //$more is a hack to fix the read more loop
$td_page = (get_query_var('page')) ? get_query_var('page') : 1; //rewrite the global var
$td_paged = (get_query_var('paged')) ? get_query_var('paged') : 1; //rewrite the global var


//paged works on single pages, page - works on homepage
if ($td_paged > $td_page) {
    $paged = $td_paged;
} else {
    $paged = $td_page;
}


$list_custom_title_show = true; //show the article list title by default




/*
    read the settings for the loop
---------------------------------------------------------------------------------------- */
if (!empty($post->ID)) {
    td_global::load_single_post($post);

    //read the metadata for the post
	//
	// the $td_homepage_loop is used instead
    //$td_homepage_loop_filter = get_post_meta($post->ID, 'td_homepage_loop_filter', true); //it's send to td_data_source
    $td_homepage_loop = td_util::get_post_meta_array($post->ID, 'td_homepage_loop');


    if (!empty($td_homepage_loop['td_layout'])) {
        $loop_module_id = $td_homepage_loop['td_layout'];
    }

    if (!empty($td_homepage_loop['td_sidebar_position'])) {
        $loop_sidebar_position = $td_homepage_loop['td_sidebar_position'];
    }

	// sidebar position used to align the breadcrumb on sidebar left + sidebar first on mobile issue
	$td_sidebar_position = '';
	if($loop_sidebar_position == 'sidebar_left') {
		$td_sidebar_position = 'td-sidebar-left';
	}

    if (!empty($td_homepage_loop['td_sidebar'])) {
        td_global::$load_sidebar_from_template = $td_homepage_loop['td_sidebar'];
    }

    if (!empty($td_homepage_loop['list_custom_title'])) {
        $td_list_custom_title = $td_homepage_loop['list_custom_title'];
    } else {
        $td_list_custom_title =__td('LATEST ARTICLES', TD_THEME_NAME);
    }


    if (!empty($td_homepage_loop['list_custom_title_show'])) {
        $list_custom_title_show = false;
    }

    $el_class = '';
    if (!empty($td_homepage_loop['el_class'])) {
        $el_class = $td_homepage_loop['el_class'];
    }
}


/**
 * detect the page builder
 */
$td_use_page_builder = td_global::is_page_builder_content();
?>

<div class="td-main-content-wrap td-main-page-wrap td-container-wrap">

<?php
/*
the first part of the page (built with the page builder)  - empty($paged) or $paged < 2 = first page
---------------------------------------------------------------------------------------- */
//td_global::$cur_single_template_sidebar_pos = 'no_sidebar';
if(!empty($post->post_content)) { //show this only when we have content
    if (empty($paged) or $paged < 2) { //show this only on the first page
        if (have_posts()) { ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <div class="<?php if ((!td_util::tdc_is_installed()) or (!$td_use_page_builder)) { echo 'td-container '; } ?>tdc-content-wrap">
                    <?php the_content(); ?>
                </div>

            <?php endwhile; ?>
        <?php }
    }
} else if ( td_util::tdc_is_live_editor_iframe() ) {
	// The content needs to be shown (Maybe we have a previewed content, and we need the 'the_content' hook !)
	?>
	<div class="tdc-content-wrap">
		<?php the_content(); ?>
	</div>
	<?php
}
?>


<div class="td-container td-pb-article-list <?php echo $el_class; ?>">
    <div class="td-pb-row">
        <?php
        // set the $cur_single_template_sidebar_pos - for gallery and video playlist
        td_global::$cur_single_template_sidebar_pos = $loop_sidebar_position;

        // The main content header style is from 'tds_global_block_template'
        $global_block_template_id = td_options::get('tds_global_block_template', 'td_block_template_1');
        $global_block_template_instance = new $global_block_template_id(
            array(
                'atts' => array(
                    'custom_title' => $td_list_custom_title,
                ),
			)
        );

        $main_content_title = '<div class="td-block-title-wrap">' . $global_block_template_instance->get_block_title() . '</div>';

        //the default template
        switch ($loop_sidebar_position) {
            default: //sidebar right
                ?>
                    <div class="td-pb-span8 td-main-content" role="main">
                        <div class="td-ss-main-content <?php echo $global_block_template_id ?>">
                            <?php if ((empty($paged) or $paged < 2) and $list_custom_title_show === true) {
	                            echo $main_content_title;
                            }

                            //query_posts(td_data_source::metabox_to_args($td_homepage_loop_filter, $paged));
                            query_posts(td_data_source::metabox_to_args($td_homepage_loop, $paged));
                            locate_template('loop.php', true);
                            td_page_generator::get_pagination();
                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                    <div class="td-pb-span4 td-main-sidebar" role="complementary">
                        <div class="td-ss-main-sidebar">
                            <?php get_sidebar(); ?>
                        </div>
                    </div>
                <?php
                break;

            case 'sidebar_left':
                ?>
                <div class="td-pb-span8 td-main-content <?php echo $td_sidebar_position; ?>-content" role="main">
                    <div class="td-ss-main-content <?php echo $global_block_template_id ?>">
                        <?php if ((empty($paged) or $paged < 2) and $list_custom_title_show === true) {
                            echo $main_content_title;
                        }

                        //query_posts(td_data_source::metabox_to_args($td_homepage_loop_filter, $paged));
                        query_posts(td_data_source::metabox_to_args($td_homepage_loop, $paged));
                        locate_template('loop.php', true);
                        td_page_generator::get_pagination();
                        wp_reset_query();
                        ?>
                    </div>
                </div>
	            <div class="td-pb-span4 td-main-sidebar" role="complementary">
		            <div class="td-ss-main-sidebar">
			            <?php get_sidebar(); ?>
		            </div>
	            </div>
                <?php
                break;

            case 'no_sidebar':
                //td_global::$load_featured_img_from_template = 'art-slide-big';
                td_global::$load_featured_img_from_template = 'full';
                ?>
                <div class="td-pb-span12 td-main-content" role="main">
                    <div class="td-ss-main-content <?php echo $global_block_template_id ?>">
                        <?php if ((empty($paged) or $paged < 2) and $list_custom_title_show === true) {
                            echo $main_content_title;
                        }

                        //query_posts(td_data_source::metabox_to_args($td_homepage_loop_filter, $paged));
                        query_posts(td_data_source::metabox_to_args($td_homepage_loop, $paged));
                        locate_template('loop.php', true);
                        td_page_generator::get_pagination();
                        wp_reset_query();
                        ?>
                    </div>
                </div>
                <?php
                break;

        }
        ?>
    </div> <!-- /.td-pb-row -->
</div> <!-- /.td-container -->
</div> <!-- /.td-main-content-wrap -->

<?php

get_footer();