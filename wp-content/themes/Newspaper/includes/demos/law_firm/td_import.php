<?php
/**
 * Created by ra on 5/14/2015.
 */



/*  ---------------------------------------------------------------------------
    top menu - MENUS MUST HAVE THE FOLLOWING NAMES:
    td-demo-top-menu
    td-demo-header-menu
    td-demo-footer-menu
*/
//main menu
$td_demo_header_menu_id = td_demo_menus::create_menu('td-demo-header-menu', 'header-menu');



/*  ----------------------------------------------------------------------------
    background - leave empty if you want to make sure that there is NO background on the demo - td_demo_misc::update_background('');
 */
td_demo_misc::update_background('');



/*  ----------------------------------------------------------------------------
    logo
 */
td_demo_misc::update_logo(array(
    'normal' => 'td_logo_header',
    'retina' => 'td_logo_header_retina',
));

/*  ----------------------------------------------------------------------------
    footer text
 */


/*  ----------------------------------------------------------------------------
    socials
 */
td_demo_misc::add_social_buttons(array(
    'facebook' => '#',
    'googleplus' => '#',
    'linkedin' => '#',
    'twitter' => '#',
));


/*  ----------------------------------------------------------------------------
    ads
 */
td_demo_misc::clear_all_ads();


/*  ----------------------------------------------------------------------------
    sidebars
 */

//default sidebar
td_demo_widgets::remove_widgets_from_sidebar('default');

//remove footer widgets > remove existing widgets from footer widgets areas
td_demo_widgets::remove_widgets_from_sidebar('footer-1');
td_demo_widgets::remove_widgets_from_sidebar('footer-2');



/*  ---------------------------------------------------------------------------
    categories
*/


/*  ----------------------------------------------------------------------------
    pages
 */
//homepage
$td_homepage_id = td_demo_content::add_page(array(
    'title' => 'Home',
    'file' => td_global::$get_template_directory . '/includes/demos/law_firm/pages/homepage.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => true
));
//menu page
$td_ourPeoplePage_id = td_demo_content::add_page(array(
    'title' => 'Our people',
    'file' => td_global::$get_template_directory . '/includes/demos/law_firm/pages/our-people.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => false
));
//blog page
$td_ourExpertisePage_id = td_demo_content::add_page(array(
    'title' => 'Our expertise',
    'file' => td_global::$get_template_directory . '/includes/demos/law_firm/pages/our-expertise.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => false
));
//about page
$td_letsConnectPage_id = td_demo_content::add_page(array(
    'title' => 'Let\'s connect',
    'file' => td_global::$get_template_directory . '/includes/demos/law_firm/pages/lets-connect.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => false
));
//footer template
$td_footerTemplate_id = td_demo_content::add_page(array(
    'title' => 'footer-template',
    'file' => td_global::$get_template_directory . '/includes/demos/law_firm/pages/footer-template.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => false
));
td_util::update_option( 'tds_footer_page', $td_footerTemplate_id);

/*  ----------------------------------------------------------------------------
    menu
 */

//add the homepage to the menu
td_demo_menus::add_page(array(
    'title' => 'Home',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_homepage_id,
    'parent_id' => ''
));
//add the menu page to the menu
td_demo_menus::add_page(array(
    'title' => 'Our people',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_ourPeoplePage_id,
    'parent_id' => ''
));
//add the blog page to the menu
td_demo_menus::add_page(array(
    'title' => 'Our expertise',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_ourExpertisePage_id,
    'parent_id' => ''
));
//add the blog page to the menu
td_demo_menus::add_page(array(
    'title' => 'Let\'s connect',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_letsConnectPage_id,
    'parent_id' => ''
));


/*  ---------------------------------------------------------------------------
    posts
*/