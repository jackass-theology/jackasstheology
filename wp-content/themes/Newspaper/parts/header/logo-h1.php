<?php
/**
 * Created by PhpStorm.
 * User: ra
 * Date: 4/22/14
 * Time: 10:08 AM
 */

//read the logo + retina logo
$td_customLogo = td_util::get_option('tds_logo_upload');
$td_customLogoR = td_util::get_option('tds_logo_upload_r');

$td_logo_alt = td_util::get_option('tds_logo_alt');
$td_logo_title = td_util::get_option('tds_logo_title');

if (!empty($td_logo_title)) {
    $td_logo_title = ' title="' . $td_logo_title . '"';
}

// H1 on logo when there's no title with H1 in page
// So, H1 is on logo when:
// 1. For index.php template because the content should not have any H1
// 2. For 'page-pagebuilder-latest.php' template, because the the content does not output any page title
// 3. For any tdc or vc content, and not the 'page-pagebuilder-title.php' is used
$td_use_h1_logo = false;
if (is_home()) {
    $td_use_h1_logo = true;
} else if (is_page()) {

    global $post;
    $_wp_page_template = get_post_meta($post->ID, '_wp_page_template', true );

    if ('page-pagebuilder-title.php' === $_wp_page_template) {
        $td_use_h1_logo = false;
    } else if ('page-pagebuilder-latest.php' === $_wp_page_template) {
        $td_use_h1_logo = true;
    } else if ( td_util::is_pagebuilder_content($post)) {
        $td_use_h1_logo = true;
    }
}

if (!empty($td_customLogoR)) { // if retina
    if($td_use_h1_logo === true) {
        echo '<h1 class="td-logo">';
    };
    ?>
        <a class="td-main-logo" href="<?php echo esc_url(home_url( '/' )); ?>">
            <img class="td-retina-data" data-retina="<?php echo esc_attr($td_customLogoR) ?>" src="<?php echo $td_customLogo?>" alt="<?php echo $td_logo_alt ?>"<?php echo $td_logo_title ?>/>
            <span class="td-visual-hidden"><?php bloginfo('name'); ?></span>
        </a>
    <?php
    if($td_use_h1_logo === true) {
        echo '</h1>';
    };
} else { // not retina
    if (!empty($td_customLogo)) {
        if($td_use_h1_logo === true) {
            echo '<h1 class="td-logo">';
        };
        ?>
            <a class="td-main-logo" href="<?php echo esc_url(home_url( '/' )); ?>">
                <img src="<?php echo $td_customLogo?>" alt="<?php echo $td_logo_alt ?>"<?php echo $td_logo_title ?>/>
                <span class="td-visual-hidden"><?php bloginfo('name'); ?></span>
            </a>
        <?php
        if($td_use_h1_logo === true) {
            echo '</h1>';
        };
    }
}