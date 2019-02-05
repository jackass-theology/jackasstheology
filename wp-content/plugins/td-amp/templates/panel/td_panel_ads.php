<?php echo td_panel_generator::box_start('Ads', false); ?>

<!-- Header AD -->
<div class="td-box-section-title">Header Ad</div>

<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Ad type</span>
        <p>Select the ad type you want for this ad spot.</p>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::dropdown(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_header_ad_type',
            'values' => array(
                array(
                    'val' => 'custom-banner',
                    'text' => 'Custom banner'
                ),
                array(
                    'val' => 'google-adsense',
                    'text' => 'Google AdSense'
                )
            )
        ));
        ?>
    </div>
</div>

<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">AdSense ad settings</span>
        <p>For adsense type use these settings to configure it.</p>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_header_adsense_ad_publisher_id',
            'placeholder' => '- data-ad-client -',
        ));
        ?>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_header_adsense_ad_unit_id',
            'placeholder' => '- data-ad-slot -',
        ));
        ?>
    </div>

    <div class="td-box-control-full" style="float: right">
        <?php
        echo td_panel_generator::dropdown(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_header_adsense_ad_size',
            'values' => array(
                array(
                    'val' => 'responsive',
                    'text' => 'responsive'
                ),
                array(
                    'val' => 'fixed-height',
                    'text' => 'fixed height - 100px'
                )
            )
        ));
        ?>
    </div>
</div>

<div class="td-box-row" style="clear: both">
    <div class="td-box-description">
        <span class="td-box-title">Custom ad</span>
        <p>For custom ad type add your ad code in the text area.</p>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::textarea(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_header'
        ));
        ?>
    </div>
</div>

<div class="td-box-section-separator"></div>

<!-- Footer top AD -->
<div class="td-box-section-title">Footer Top Ad</div>

<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Ad type</span>
        <p>Select the ad type you want for this ad spot.</p>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::dropdown(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_footer_top_ad_type',
            'values' => array(
                array(
                    'val' => 'custom-banner',
                    'text' => 'Custom banner'
                ),
                array(
                    'val' => 'google-adsense',
                    'text' => 'Google AdSense'
                )
            )
        ));
        ?>
    </div>
</div>

<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">AdSense ad settings</span>
        <p>For adsense type use these settings to configure it.</p>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_footer_top_adsense_ad_publisher_id',
            'placeholder' => '- data-ad-client -',
        ));
        ?>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_footer_top_adsense_ad_unit_id',
            'placeholder' => '- data-ad-slot -',
        ));
        ?>
    </div>

    <div class="td-box-control-full" style="float: right">
        <?php
        echo td_panel_generator::dropdown(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_footer_top_adsense_ad_size',
            'values' => array(
                array(
                    'val' => 'responsive',
                    'text' => 'responsive'
                ),
                array(
                    'val' => 'fixed-height',
                    'text' => 'fixed height - 100px'
                )
            )
        ));
        ?>
    </div>
</div>

<div class="td-box-row" style="clear: both">
    <div class="td-box-description">
        <span class="td-box-title">Custom ad</span>
        <p>For custom ad type add your ad code in the text area.</p>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::textarea(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_footer_top'
        ));
        ?>
    </div>
</div>

<div class="td-box-section-separator"></div>

<!-- Article top AD -->
<div class="td-box-section-title">Article Top Ad</div>

<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Ad type</span>
        <p>Select the ad type you want for this ad spot.</p>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::dropdown(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_content_top_ad_type',
            'values' => array(
                array(
                    'val' => 'custom-banner',
                    'text' => 'Custom banner'
                ),
                array(
                    'val' => 'google-adsense',
                    'text' => 'Google AdSense'
                )
            )
        ));
        ?>
    </div>
</div>

<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">AdSense ad settings</span>
        <p>For adsense type use these settings to configure it.</p>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_content_top_adsense_ad_publisher_id',
            'placeholder' => '- data-ad-client -',
        ));
        ?>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_content_top_adsense_ad_unit_id',
            'placeholder' => '- data-ad-slot -',
        ));
        ?>
    </div>

    <div class="td-box-control-full" style="float: right">
        <?php
        echo td_panel_generator::dropdown(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_content_top_adsense_ad_size',
            'values' => array(
                array(
                    'val' => 'responsive',
                    'text' => 'responsive'
                ),
                array(
                    'val' => 'fixed-height',
                    'text' => 'fixed height - 100px'
                )
            )
        ));
        ?>
    </div>
</div>

<div class="td-box-row" style="clear: both">
    <div class="td-box-description">
        <span class="td-box-title">Custom ad</span>
        <p>For custom ad type add your ad code in the text area.</p>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::textarea(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_content_top'
        ));
        ?>
    </div>
</div>

<div class="td-box-section-separator"></div>

<!-- Article inline AD -->
<div class="td-box-section-title">Article Inline Ad</div>

<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Ad type</span>
        <p>Select the ad type you want for this ad spot.</p>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::dropdown(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_content_inline_ad_type',
            'values' => array(
                array(
                    'val' => 'custom-banner',
                    'text' => 'Custom banner'
                ),
                array(
                    'val' => 'google-adsense',
                    'text' => 'Google AdSense'
                )
            )
        ));
        ?>
    </div>
</div>

<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">AdSense ad settings</span>
        <p>For adsense type use these settings to configure it.</p>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_content_inline_adsense_ad_publisher_id',
            'placeholder' => '- data-ad-client -',
        ));
        ?>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_content_inline_adsense_ad_unit_id',
            'placeholder' => '- data-ad-slot -',
        ));
        ?>
    </div>

    <div class="td-box-control-full" style="float: right">
        <?php
        echo td_panel_generator::dropdown(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_content_inline_adsense_ad_size',
            'values' => array(
                array(
                    'val' => 'responsive',
                    'text' => 'responsive'
                ),
                array(
                    'val' => 'fixed-height',
                    'text' => 'fixed height - 100px'
                )
            )
        ));
        ?>
    </div>
</div>

<div class="td-box-row" style="clear: both">
    <div class="td-box-description">
        <span class="td-box-title">Custom ad</span>
        <p>For custom ad type add your ad code in the text area.</p>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::textarea(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_content_inline'
        ));
        ?>
    </div>
</div>

<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">After Paragraph:</span>
        <p>After how many paragraphs the ad will display. The ad will be placed after the selected number of paragraphs.</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_content_inline_ad_paragraph'
        ));
        ?>
    </div>
</div>

<div class="td-box-section-separator"></div>

<!-- Article bottom AD -->
<div class="td-box-section-title">Article Bottom Ad</div>

<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Ad type</span>
        <p>Select the ad type you want for this ad spot.</p>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::dropdown(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_content_bottom_ad_type',
            'values' => array(
                array(
                    'val' => 'custom-banner',
                    'text' => 'Custom banner'
                ),
                array(
                    'val' => 'google-adsense',
                    'text' => 'Google AdSense'
                )
            )
        ));
        ?>
    </div>
</div>

<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">AdSense ad settings</span>
        <p>For adsense type use these settings to configure it.</p>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_content_bottom_adsense_ad_publisher_id',
            'placeholder' => '- data-ad-client -',
        ));
        ?>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_content_bottom_adsense_ad_unit_id',
            'placeholder' => '- data-ad-slot -',
        ));
        ?>
    </div>

    <div class="td-box-control-full" style="float: right">
        <?php
        echo td_panel_generator::dropdown(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_content_bottom_adsense_ad_size',
            'values' => array(
                array(
                    'val' => 'responsive',
                    'text' => 'responsive'
                ),
                array(
                    'val' => 'fixed-height',
                    'text' => 'fixed height - 100px'
                )
            )
        ));
        ?>
    </div>
</div>

<div class="td-box-row" style="clear: both">
    <div class="td-box-description">
        <span class="td-box-title">Custom ad</span>
        <p>For custom ad type add your ad code in the text area.</p>
    </div>

    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::textarea(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_content_bottom'
        ));
        ?>
    </div>
</div>

<?php echo td_panel_generator::box_end();?>