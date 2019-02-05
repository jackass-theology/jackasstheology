<div id="td-header-menu" role="navigation">
    <div id="td-top-mobile-toggle"><a href="#"><i class="td-icon-font td-icon-mobile"></i></a></div>
    <div class="td-main-menu-logo td-logo-in-menu">
        <?php
        if (td_util::get_option('tds_logo_menu_upload') == '') {
            locate_template('parts/header/logo-h1.php', true, false);
        } else {
            locate_template('parts/header/logo-mobile-h1.php', true, false);
        }?>
    </div>
    <?php
    wp_nav_menu(array(
        'theme_location' => 'header-menu',
        'menu_class'=> 'sf-menu',
        'fallback_cb' => 'td_wp_page_menu',
        'walker' => new td_tagdiv_walker_nav_menu()
    ));


    //if no menu
    function td_wp_page_menu() {
        //this is the default menu
        echo '<ul class="sf-menu">';
        echo '<li class="menu-item-first"><a href="' . esc_url(home_url( '/' )) . 'wp-admin/nav-menus.php?action=locations">Click here - to select or create a menu</a></li>';
        echo '</ul>';
    }
    ?>
</div>

<?php
//check to see if we show the socials from our theme or from wordpress
if(td_util::get_option('td_social_networks_menu_show') == 'show') {
    echo '<div class="td-header-menu-social">';
    //get the socials that are set by user
    $td_get_social_network = td_options::get_array('td_social_networks');

    if (!empty($td_get_social_network)) {
        foreach ($td_get_social_network as $social_id => $social_link) {
            if (!empty($social_link)) {
                echo td_social_icons::get_icon($social_link, $social_id, true);
            }
        }
    }
    echo '</div>';
}
?>

<?php
//check to see if we show the search form default = '' - main menu
if(td_util::get_option('tds_search_placement') == '') { ?>
    <div class="header-search-wrap">
        <div class="td-search-btns-wrap">
            <a id="td-header-search-button" href="#" role="button" class="dropdown-toggle " data-toggle="dropdown"><i class="td-icon-search"></i></a>
            <a id="td-header-search-button-mob" href="#" role="button" class="dropdown-toggle " data-toggle="dropdown"><i class="td-icon-search"></i></a>
        </div>

        <div class="td-drop-down-search" aria-labelledby="td-header-search-button">
            <form method="get" class="td-search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
                <div role="search" class="td-head-form-search-wrap">
                    <input id="td-header-search" type="text" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" /><input class="wpb_button wpb_btn-inverse btn" type="submit" id="td-header-search-top" value="<?php _etd('Search', TD_THEME_NAME)?>" />
                </div>
            </form>
            <div id="td-aj-search"></div>
        </div>
    </div>
<?php } else { ?>
    <div class="td-search-wrapper">
        <div id="td-top-search">
            <!-- Search -->
            <div class="header-search-wrap">
                <div class="dropdown header-search">
                    <a id="td-header-search-button-mob" href="#" role="button" class="dropdown-toggle " data-toggle="dropdown"><i class="td-icon-search"></i></a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>