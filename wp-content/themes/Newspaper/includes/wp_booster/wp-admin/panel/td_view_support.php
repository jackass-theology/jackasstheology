<?php

require_once "td_view_header.php";
?>
<div class="about-wrap td-admin-wrap">
    <h1><?php echo TD_THEME_NAME ?> support</h1>
    <div class="about-text" style="margin-bottom: 32px;">

        <p>We know what it’s like to need support. This is the reason why our customers are the top priority and we treat every issue with the utmost seriousness. The team is working hard to help every customer, to keep the theme’s documentation up to date, to produce video tutorials and to develop new ways to make everything easier.</p>
        <p>You can count on us, we are here for you!</p>

    </div>

    <hr/>



    <div style="margin-top: 26px;">
        <div class="td-admin-box-text td-admin-box-three">
            <?php echo td_api_text::get('welcome_support_forum') ?>
        </div>
        <div class="td-admin-box-text td-admin-box-three">
            <?php echo td_api_text::get('welcome_docs') ?>
        </div>
        <div class="td-admin-box-text td-admin-box-three td-admin-box-last">
            <?php echo td_api_text::get('welcome_video_tutorials') ?>
        </div>
    </div>


</div>