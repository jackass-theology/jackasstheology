<?php

/**
 * Style template.
 *
 */

if (!defined("TD_THEME_NAME")) {
    return; // do not run on other themes...
}

if ( TD_DEPLOY_MODE == 'dev' ) {
    // compile the css
    require_once 'external/td_node_less/td_less_compiler.php';
    $response = td_less_compiler::compile_less_file(AMP__DIR__ . '/templates/less/amp_main.less', AMP__DIR__ . '/templates/css/amp_main.css' );
}

$plugin_url = plugins_url('', __FILE__);

echo '
    @font-face {
      font-family: \'newspaper\';
      src: url(\'' . $plugin_url . '/images/icons/newspaper.eot?8\');
      src: url(\'' . $plugin_url . '/images/icons/newspaper.eot?8#iefix\') format(\'embedded-opentype\'), 
      url(\'' . $plugin_url . '/images/icons/newspaper.woff?8\') format(\'woff\'), 
      url(\'' . $plugin_url . '/images/icons/newspaper.ttf?8\') format(\'truetype\'), 
      url(\'' . $plugin_url . '/images/icons/newspaper.svg?7#newspaper\') format(\'svg\');
      font-weight: normal;
      font-style: normal;
    }
';

echo '
    /*
     COMPILED amp_main.less
    */
';

$compiled_less = file_get_contents(AMP__DIR__ . '/templates/css/amp_main.css' );
echo $compiled_less;

echo '
    /*
     AMP custom CSS
    */
';

$td_amp_custom_css = "
    <style>
    
        /* @theme_color_amp */
        a,
        .td-post-author-name a,
        .footer-email-wrap a,
        .td-search-query,
        .td-page-content blockquote p,
        .td-post-content blockquote p {
            color: @theme_color_amp;
        }
    
        .td-rating-bar-wrap div,
        .td-page-content .dropcap,
        .td-post-content .dropcap,
        .comment-content .dropcap,
        .td_wrapper_video_playlist .td_video_controls_playlist_wrapper,
        .td_default_btn,
        .td_round_btn {
            background-color: @theme_color_amp;
        }
    
        .td_quote_box,
        .td_wrapper_video_playlist .td_video_currently_playing:after {
            border-color: @theme_color_amp;
        }
        
        /* @menu_background_amp */
        .td-header-wrap {
            background-color: @menu_background_amp;
        }
        
        /* @menu_icon_color_amp */
        .td-search-icon .td-icon-search {
            color: @menu_icon_color_amp;
        }
        
        /* @footer_background_amp */
        .td-footer-wrap {
            background-color: @footer_background_amp;
        }
         /* @footer_text_color_amp */
        .td-footer-wrap,
        .td-footer-wrap a,
        .td-footer-wrap .block-title span {
            color: @footer_text_color_amp;
        }
    
        /* @sub_footer_background_amp */
        .td-sub-footer-wrap {
            background-color: @sub_footer_background_amp;
        }
    
        /* @sub_footer_text_color_amp */
        .td-sub-footer-wrap,
        .td-sub-footer-wrap a {
            color: @sub_footer_text_color_amp;
        }
    
    </style>
";

$td_css_compiler = new td_css_compiler($td_amp_custom_css);

// theme color
$td_css_compiler->load_setting('theme_color_amp');

// menu color
$td_css_compiler->load_setting('menu_background_amp');
$td_css_compiler->load_setting('menu_icon_color_amp');

// footer color
$td_css_compiler->load_setting('footer_background_amp');
$td_css_compiler->load_setting('footer_text_color_amp');

// sub-footer color
$td_css_compiler->load_setting('sub_footer_background_amp');
$td_css_compiler->load_setting('sub_footer_text_color_amp');

echo $td_css_compiler->compile_css();

?>

