<?php echo td_panel_generator::box_start('Analytics', false); ?>

    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">GOOGLE ANALYTICS CODE</span>
            <p>
	            Google analytics helps track your site traffic

            </p>
        </div>
    </div>

    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">PASTE YOUR CODE HERE</span>
            <p>
	            Google Analytics code
	            <?php td_util::tooltip_html('
                        <h3>Google analytics tracking code:</h3>
                        <p>Paste here the Universal Analytics tracking code for this property.</p>
                        <p>
                        The analytics <b>json configuration code</b> has to be of this form: 
                            <pre>
        {
            "vars":{
                "account":"UA-123456789-1"
            },
            "triggers":{
                "trackPageview":{
                    "on":"visible",
                    "request":"pageview"
                }
            }
        }
                            </pre>
                        </p>
                ', 'right')?>
            </p>
        </div>
        <div class="td-box-control-full td-amp-analytics-textarea">
            <?php
            echo td_panel_generator::textarea(array(
                'ds' => 'td_option',
                'option_id' => 'td_amp_analytics',
            ));
            ?>
        </div>
    </div>

<?php echo td_panel_generator::box_end();?>