<!-- Analitycs -->
<?php echo td_panel_generator::box_start('Google Analytics and JavaScript Codes'); ?>

    <!-- GOOGLE ASYNCHRONOUS ADS -->
    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">Header script code</span>
            <p>
                The code will be placed before the <code>&lt;/head&gt;</code> tag on all the site's pages. Please include the &lt;script&gt; &lt;/script&gt; tags.
            </p>
        </div>
    </div>


    <!-- paste your code here -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">PASTE YOUR CODE HERE</span>
            <p>
                Analytics and/or JavaScript Code
	            <?php td_util::tooltip_html('
                        <h3>Google Analytics:</h3>
                         <p>
                         The Analytics code must have this form:  
                                                  <pre>
&#x26;#60;script&#x26;#62;
(function(i,s,o,g,r,a,m)
{i[&#x27;GoogleAnalyticsObject&#x27;]=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new 
Date();a=s.createElement(o),m=s.getElementsByTagName(o)
[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,&#x27;script&#x27;,&#x27;
https://www.google-analytics.com/analytics.js&#x27;,&#x27;ga&#x27;);

ga(&#x27;create&#x27;, &#x27;UA-XXXXX-Y&#x27;, &#x27;auto&#x27;);
ga(&#x27;send&#x27;, &#x27;pageview&#x27;);
&#x26;#60;/script&#x26;#62;

</pre>

</p>
                ', 'right')?>
            </p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::textarea(array(
                'ds' => 'td_option',
                'option_id' => 'td_analytics',
            ));
            ?>
        </div>
    </div>

<div class="td-box-section-separator"></div>

<div class="td-box-row">
    <div class="td-box-description td-box-full">
        <span class="td-box-title">Footer script Code</span>
        <p>
            This code will be placed before the <code>&lt;/body&gt;</code> tag in HTML. Please include the &lt;script&gt; &lt;/script&gt; tags.
        </p>
    </div>
</div>


<!-- paste your code here -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">PASTE YOUR CODE HERE</span>
        <p>
            Footer JavaScript code
            <?php td_util::tooltip_html('
                        <h3>Add the code before the end of body tag</h3>
                        <p>Your code will be placed in the footer, before the end of body tag on all the site\'s pages.</p>
                ', 'right')?>
        </p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::textarea(array(
            'ds' => 'td_option',
            'option_id' => 'td_footer_code',
        ));
        ?>
    </div>
</div>


<?php echo td_panel_generator::box_end();?>

